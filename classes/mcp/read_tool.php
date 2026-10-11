<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.

/**
 * Read-only MCP tools for Helpdesk.
 *
 * @package local_helpdesk
 * @copyright 2026 Eduardo Kraus
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace local_helpdesk\mcp;

use context;
use context_system;
use local_helpdesk\model\ticket;
use local_mcp\exception\api_exception;
use local_mcp\read\tool_interface;
use local_mcp\security\authenticated_identity;

/**
 * Each instance is an independently discoverable MCP read tool.
 */
final class read_tool implements tool_interface {
    /** @var string */
    private string $operation;

    /**
     * Construct the tool.
     *
     * @param string $operation Parameter value.
     */
    public function __construct(string $operation) {
        $this->operation = $operation;
    }

    /**
     * Return the MCP tool name.
     *
     * @return string Result.
     */
    public function get_name(): string {
        return 'helpdesk_' . $this->operation;
    }

    /**
     * Return the tool title.
     *
     * @return string Result.
     */
    public function get_title(): string {
        $names = [
            'list_tickets' => 'List Helpdesk tickets',
            'get_ticket' => 'Get Helpdesk ticket and replies',
            'list_categories' => 'List Helpdesk categories',
            'list_articles' => 'Search Helpdesk knowledge-base articles',
            'ticket_stats' => 'Get Helpdesk ticket statistics',
        ];
        return $names[$this->operation];
    }

    /**
     * Explain the MCP operation.
     *
     * @return string Result.
     */
    public function get_description(): string {
        $descriptions = [
            'list_tickets' => 'Search paginated tickets. Non-support users only see their own tickets; '
                . 'support users may filter by user, category, priority and status.',
            'get_ticket' => 'Get one ticket by database ID or public idkey, including message history. '
                . 'Only its owner or Helpdesk support may read it.',
            'list_categories' => 'Return the available ticket and knowledge-base categories.',
            'list_articles' => 'Read or search Helpdesk knowledge-base articles, optionally by category.',
            'ticket_stats' => 'Aggregate ticket counts by status and priority for Helpdesk support.',
        ];
        return $descriptions[$this->operation];
    }

    /**
     * Return the input JSON schema.
     *
     * @return array Result.
     */
    public function get_input_schema(): array {
        $page = [
            'limit' => ['type' => 'integer', 'minimum' => 1, 'maximum' => 100],
            'offset' => ['type' => 'integer', 'minimum' => 0],
        ];
        switch ($this->operation) {
            case 'list_tickets':
                $properties = $page + [
                    'status' => ['type' => 'string', 'enum' => ['open', 'progress', 'resolved', 'closed']],
                    'priority' => ['type' => 'string', 'enum' => ['low', 'medium', 'high', 'urgent']],
                    'categoryid' => ['type' => 'integer', 'minimum' => 1],
                    'userid' => ['type' => 'integer', 'minimum' => 1,
                        'description' => 'Support users only.'],
                    'search' => ['type' => 'string', 'maxLength' => 255],
                ];
                break;
            case 'get_ticket':
                $properties = ['ticketid' => ['type' => 'integer', 'minimum' => 1,
                    'description' => 'Numeric database ID or public idkey.'],
                    'response_limit' => ['type' => 'integer', 'minimum' => 1, 'maximum' => 100],
                    'response_offset' => ['type' => 'integer', 'minimum' => 0]];
                break;
            case 'list_articles':
                $properties = $page + [
                    'articleid' => ['type' => 'integer', 'minimum' => 1],
                    'categoryid' => ['type' => 'integer', 'minimum' => 1],
                    'search' => ['type' => 'string', 'maxLength' => 255],
                ];
                break;
            default:
                $properties = [];
                break;
        }
        return [
            'type' => 'object',
            'properties' => (object)$properties,
            'required' => $this->operation === 'get_ticket' ? ['ticketid'] : [],
            'additionalProperties' => false,
        ];
    }

    /**
     * Return the required Moodle capability.
     *
     * @return string Result.
     */
    public function get_required_capability(): string {
        return $this->operation === 'ticket_stats' ? 'local/helpdesk:ticketmanage' : 'local/helpdesk:view';
    }

    /**
     * Resolve the Moodle permission context.
     *
     * @param array $arguments Validated input arguments.
     * @return context Result.
     */
    public function resolve_context(array $arguments): context {
        return context_system::instance();
    }

    /**
     * Run the authenticated MCP operation.
     *
     * @param array $arguments Validated input arguments.
     * @param authenticated_identity $identity Authenticated MCP user.
     * @return array Result.
     */
    public function execute(array $arguments, authenticated_identity $identity): array {
        switch ($this->operation) {
            case 'list_tickets':
                return $this->list_tickets($arguments, $identity);
            case 'get_ticket':
                return $this->get_ticket($arguments, $identity);
            case 'list_categories':
                return $this->list_categories();
            case 'list_articles':
                return $this->list_articles($arguments);
            case 'ticket_stats':
                return $this->ticket_stats();
        }
        throw new \coding_exception('Unknown Helpdesk MCP tool.');
    }

    /**
     * Enforce ticket owner, support and course permissions.
     *
     * @param int $ownerid Parameter value.
     * @param authenticated_identity $identity Authenticated MCP user.
     * @param int $courseid Parameter value.
     * @return void Result.
     */
    public static function assert_ticket_access(int $ownerid, authenticated_identity $identity,
            int $courseid = 0): void {
        $support = $ownerid !== $identity->userid;
        if ($support && !has_capability('local/helpdesk:ticketmanage',
                context_system::instance(), $identity->userid)) {
            throw new api_exception('permission_denied', 403);
        }
        if ($courseid) {
            $context = \context_course::instance($courseid, MUST_EXIST);
            $capability = $support ? 'local/helpdesk:ticketmanage' : 'local/helpdesk:view';
            if (!has_capability($capability, $context, $identity->userid)) {
                throw new api_exception('permission_denied', 403);
            }
        }
    }

    /**
     * Resolve bounded pagination parameters.
     *
     * @param array $arguments Validated input arguments.
     * @return array Result.
     */
    private static function pagination(array $arguments): array {
        return [
            min(100, max(1, (int)($arguments['limit'] ?? 25))),
            max(0, (int)($arguments['offset'] ?? 0)),
        ];
    }

    /**
     * List tickets visible to the connected user.
     *
     * @param array $arguments Validated input arguments.
     * @param authenticated_identity $identity Authenticated MCP user.
     * @return array Result.
     */
    private function list_tickets(array $arguments, authenticated_identity $identity): array {
        global $DB;
        [$limit, $offset] = self::pagination($arguments);
        $support = has_capability('local/helpdesk:ticketmanage', context_system::instance(), $identity->userid);
        $where = [];
        $params = [];
        if (!$support) {
            if (isset($arguments['userid']) && (int)$arguments['userid'] !== $identity->userid) {
                throw new api_exception('permission_denied', 403);
            }
            $where[] = 't.userid = :ownerid';
            $params['ownerid'] = $identity->userid;
        } else if (isset($arguments['userid'])) {
            $where[] = 't.userid = :userid';
            $params['userid'] = (int)$arguments['userid'];
        }
        foreach (['status', 'priority', 'categoryid'] as $field) {
            if (isset($arguments[$field])) {
                $where[] = "t.$field = :$field";
                $params[$field] = $arguments[$field];
            }
        }
        if (!empty($arguments['search'])) {
            $search = '%' . $DB->sql_like_escape(trim($arguments['search'])) . '%';
            $where[] = '(' . $DB->sql_like('t.subject', ':subject') .
                ' OR ' . $DB->sql_like('t.description', ':description') . ')';
            $params['subject'] = $search;
            $params['description'] = $search;
        }
        $sqlwhere = $where ? ' WHERE ' . implode(' AND ', $where) : '';
        $total = $DB->count_records_sql('SELECT COUNT(*) FROM {local_helpdesk_ticket} t' . $sqlwhere, $params);
        $records = $DB->get_records_sql(
            'SELECT t.id, t.idkey, t.userid, t.courseid, t.categoryid, t.subject, t.status, '
            . 't.priority, t.createdat, t.updatedat, t.answeredat, t.resolvedat, t.closedat '
            . 'FROM {local_helpdesk_ticket} t' . $sqlwhere . ' ORDER BY t.updatedat DESC, t.id DESC',
            $params, $offset, $limit
        );
        $tickets = [];
        foreach ($records as $record) {
            $tickets[] = (array)$record;
        }
        return ['total' => (int)$total, 'offset' => $offset, 'limit' => $limit, 'tickets' => $tickets];
    }

    /**
     * Read the requested ticket and its replies.
     *
     * @param array $arguments Validated input arguments.
     * @param authenticated_identity $identity Authenticated MCP user.
     * @return array Result.
     */
    private function get_ticket(array $arguments, authenticated_identity $identity): array {
        global $DB;
        $item = ticket::get_by_id((int)$arguments['ticketid']);
        if (!$item) {
            throw new api_exception('ticket_not_found', 404);
        }
        self::assert_ticket_access((int)$item->get_userid(), $identity, (int)$item->get_courseid());
        $responseoffset = max(0, (int)($arguments['response_offset'] ?? 0));
        $responselimit = min(100, max(1, (int)($arguments['response_limit'] ?? 100)));
        $responsetotal = $DB->count_records('local_helpdesk_response', ['ticketid' => $item->get_id()]);
        $responses = [];
        $records = $DB->get_records('local_helpdesk_response', ['ticketid' => $item->get_id()],
            'createdat ASC, id ASC', 'id, userid, type, message, createdat', $responseoffset, $responselimit);
        foreach ($records as $record) {
            $responses[] = (array)$record;
        }
        return [
            'id' => (int)$item->get_id(),
            'idkey' => (int)$item->get_idkey(),
            'userid' => (int)$item->get_userid(),
            'courseid' => (int)$item->get_courseid(),
            'categoryid' => (int)$item->get_categoryid(),
            'subject' => $item->get_subject(),
            'description' => $item->get_description(),
            'status' => $item->get_status(),
            'priority' => $item->get_priority(),
            'createdat' => (int)$item->get_createdat(),
            'updatedat' => (int)$item->get_updatedat(),
            'answeredat' => (int)$item->get_answeredat(),
            'resolvedat' => (int)$item->get_resolvedat(),
            'closedat' => (int)$item->get_closedat(),
            'responses' => $responses,
            'response_total' => (int)$responsetotal,
            'response_offset' => $responseoffset,
            'response_limit' => $responselimit,
        ];
    }

    /**
     * List ticket categories.
     *
     * @return array Result.
     */
    private function list_categories(): array {
        global $DB;
        $categories = [];
        foreach ($DB->get_records('local_helpdesk_category', null, 'name ASC',
                'id, name, description, createdat') as $category) {
            $categories[] = (array)$category;
        }
        return ['categories' => $categories];
    }

    /**
     * Return knowledge-base articles.
     *
     * @param array $arguments Validated input arguments.
     * @return array Result.
     */
    private function list_articles(array $arguments): array {
        global $DB;
        if (!empty($arguments['articleid'])) {
            $article = $DB->get_record('local_helpdesk_knowledgebase',
                ['id' => (int)$arguments['articleid']], '*', IGNORE_MISSING);
            if (!$article) {
                throw new api_exception('article_not_found', 404);
            }
            return ['articles' => [(array)$article], 'total' => 1];
        }
        [$limit, $offset] = self::pagination($arguments);
        $where = [];
        $params = [];
        if (isset($arguments['categoryid'])) {
            $where[] = 'a.categoryid = :categoryid';
            $params['categoryid'] = (int)$arguments['categoryid'];
        }
        if (!empty($arguments['search'])) {
            $search = '%' . $DB->sql_like_escape(trim($arguments['search'])) . '%';
            $where[] = '(' . $DB->sql_like('a.title', ':title') .
                ' OR ' . $DB->sql_like('a.description', ':description') . ')';
            $params['title'] = $search;
            $params['description'] = $search;
        }
        $sqlwhere = $where ? ' WHERE ' . implode(' AND ', $where) : '';
        $total = $DB->count_records_sql('SELECT COUNT(*) FROM {local_helpdesk_knowledgebase} a' .
            $sqlwhere, $params);
        $records = $DB->get_records_sql(
            'SELECT a.id, a.title, a.description, a.categoryid, a.userid, a.createdat, a.updatedat '
            . 'FROM {local_helpdesk_knowledgebase} a' . $sqlwhere . ' ORDER BY a.id DESC',
            $params, $offset, $limit
        );
        return ['articles' => array_values(array_map(static function($r) {
            return (array)$r;
        }, $records)), 'total' => (int)$total, 'offset' => $offset, 'limit' => $limit];
    }

    /**
     * Aggregate ticket counts.
     *
     * @return array Result.
     */
    private function ticket_stats(): array {
        global $DB;
        $statuscounts = [];
        $prioritycounts = [];
        foreach ($DB->get_records_sql('SELECT status, COUNT(*) AS counttickets '
                . 'FROM {local_helpdesk_ticket} GROUP BY status') as $row) {
            $statuscounts[$row->status] = (int)$row->counttickets;
        }
        foreach ($DB->get_records_sql('SELECT priority, COUNT(*) AS counttickets '
                . 'FROM {local_helpdesk_ticket} GROUP BY priority') as $row) {
            $prioritycounts[$row->priority] = (int)$row->counttickets;
        }
        return ['total' => (int)$DB->count_records('local_helpdesk_ticket'),
            'by_status' => (object)$statuscounts, 'by_priority' => (object)$prioritycounts];
    }
}
