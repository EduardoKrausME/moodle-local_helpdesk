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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Confirmable write tools for Helpdesk.
 *
 * @package local_helpdesk
 * @copyright 2026 Eduardo Kraus
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace local_helpdesk\mcp;

use context;
use context_course;
use context_system;
use local_helpdesk\mail\ticket_mail;
use local_helpdesk\model\knowledgebase;
use local_helpdesk\model\response;
use local_helpdesk\model\ticket;
use local_mcp\exception\api_exception;
use local_mcp\security\authenticated_identity;
use local_mcp\write\tool\base_tool;

/**
 * Discrete operations with independent MCP schemas, permissions and confirmations.
 */
final class write_tool extends base_tool {
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
            'create_ticket' => 'Create Helpdesk ticket',
            'reply_ticket' => 'Reply to Helpdesk ticket',
            'update_ticket' => 'Change Helpdesk ticket status, priority or category',
            'create_article' => 'Create Helpdesk knowledge-base article',
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
            'create_ticket' => 'Open a Helpdesk ticket as the connected user, with optional course ID. '
                . 'Triggers the same notification emails as the Helpdesk form.',
            'reply_ticket' => 'Add a message as the connected user to an open ticket that they own or manage. '
                . 'Automatically advances the first support reply to in progress and sends emails.',
            'update_ticket' => 'Support users can change status, priority or category. '
                . 'Status and priority updates use Helpdesk model audit history.',
            'create_article' => 'Create a knowledge-base article as an administrator with HTML content.',
        ];
        return $descriptions[$this->operation];
    }

    /**
     * Return the required Moodle capability.
     *
     * @return string Result.
     */
    public function get_required_capability(): string {
        switch ($this->operation) {
            case 'create_ticket':
            case 'reply_ticket':
                return 'local/helpdesk:view';
            case 'update_ticket':
                return 'local/helpdesk:ticketmanage';
            case 'create_article':
                return 'moodle/site:config';
        }
        throw new \coding_exception('Unknown Helpdesk MCP tool.');
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
     * Return the input JSON schema.
     *
     * @return array Result.
     */
    public function get_input_schema(): array {
        switch ($this->operation) {
            case 'create_ticket':
                return $this->object_schema([
                    'categoryid' => ['type' => 'integer', 'minimum' => 1],
                    'courseid' => ['type' => 'integer', 'minimum' => 0, 'description' => 'Optional related course.'],
                    'subject' => ['type' => 'string', 'minLength' => 1, 'maxLength' => 255],
                    'description' => ['type' => 'string', 'minLength' => 1,
                        'description' => 'Ticket description; sanitized HTML is allowed.'],
                    'priority' => ['type' => 'string', 'enum' => ['low', 'medium', 'high', 'urgent']],
                ], ['categoryid', 'subject', 'description']);
            case 'reply_ticket':
                return $this->object_schema([
                    'ticketid' => ['type' => 'integer', 'minimum' => 1],
                    'message' => ['type' => 'string', 'minLength' => 1,
                        'description' => 'Response text; sanitized HTML is allowed.'],
                ], ['ticketid', 'message']);
            case 'update_ticket':
                return $this->object_schema([
                    'ticketid' => ['type' => 'integer', 'minimum' => 1],
                    'status' => ['type' => 'string', 'enum' => ['open', 'progress', 'resolved', 'closed']],
                    'priority' => ['type' => 'string', 'enum' => ['low', 'medium', 'high', 'urgent']],
                    'categoryid' => ['type' => 'integer', 'minimum' => 1],
                ], ['ticketid']);
            case 'create_article':
                return $this->object_schema([
                    'categoryid' => ['type' => 'integer', 'minimum' => 1],
                    'title' => ['type' => 'string', 'minLength' => 1, 'maxLength' => 255],
                    'description' => ['type' => 'string', 'minLength' => 1,
                        'description' => 'Sanitized HTML article content.'],
                ], ['categoryid', 'title', 'description']);
        }
        throw new \coding_exception('Unknown Helpdesk MCP tool.');
    }

    /**
     * Whether previews are supported.
     *
     * @return bool Result.
     */
    public function supports_dry_run(): bool {
        return true;
    }

    /**
     * Preview the requested write operation without changes.
     *
     * @param array $arguments Validated input arguments.
     * @param authenticated_identity $identity Authenticated MCP user.
     * @return array Result.
     */
    public function preview(array $arguments, authenticated_identity $identity): array {
        $this->validate_input($arguments, $identity);
        $result = ['operation' => $this->get_name(), 'requires_confirmation' => true];
        foreach (['ticketid', 'categoryid', 'courseid', 'status', 'priority', 'subject', 'title'] as $field) {
            if (isset($arguments[$field])) {
                $result[$field] = $arguments[$field];
            }
        }
        $result['will_send_notifications'] = in_array($this->operation,
            ['create_ticket', 'reply_ticket'], true);
        return $result;
    }

    /**
     * Run the authenticated MCP operation.
     *
     * @param array $arguments Validated input arguments.
     * @param authenticated_identity $identity Authenticated MCP user.
     * @return array Result.
     */
    public function execute(array $arguments, authenticated_identity $identity): array {
        $this->validate_input($arguments, $identity);
        switch ($this->operation) {
            case 'create_ticket':
                return $this->create_ticket($arguments, $identity);
            case 'reply_ticket':
                return $this->reply_ticket($arguments, $identity);
            case 'update_ticket':
                return $this->update_ticket($arguments);
            case 'create_article':
                return $this->create_article($arguments, $identity);
        }
        throw new \coding_exception('Unknown Helpdesk MCP tool.');
    }

    /**
     * Verify inputs and enforce additional permissions.
     *
     * @param array $arguments Validated input arguments.
     * @param authenticated_identity $identity Authenticated MCP user.
     * @return void Result.
     */
    private function validate_input(array $arguments, authenticated_identity $identity): void {
        global $DB;

        if (in_array($this->operation, ['create_ticket', 'create_article'], true)) {
            $categoryid = (int)($arguments['categoryid'] ?? 0);
            if (!$categoryid || !$DB->record_exists('local_helpdesk_category', ['id' => $categoryid])) {
                throw new api_exception('invalid_category', 400);
            }
            $titlefield = $this->operation === 'create_ticket' ? 'subject' : 'title';
            $title = trim(clean_param((string)($arguments[$titlefield] ?? ''), PARAM_TEXT));
            if ($title === '' || strlen($title) > 255) {
                throw new api_exception('invalid_title', 400);
            }
            if (trim(strip_tags((string)($arguments['description'] ?? ''))) === '') {
                throw new api_exception('invalid_description', 400);
            }
        }

        if ($this->operation === 'create_ticket') {
            self::assert_priority($arguments['priority'] ?? 'medium');
            $courseid = (int)($arguments['courseid'] ?? 0);
            if ($courseid) {
                $coursecontext = context_course::instance($courseid, MUST_EXIST);
                if (!has_capability('moodle/course:view', $coursecontext, $identity->userid)) {
                    throw new api_exception('permission_denied', 403);
                }
            }
        }

        if (in_array($this->operation, ['reply_ticket', 'update_ticket'], true)) {
            $item = self::require_ticket((int)($arguments['ticketid'] ?? 0));
            if ($this->operation === 'reply_ticket') {
                read_tool::assert_ticket_access((int)$item->get_userid(), $identity, (int)$item->get_courseid());
                if ($item->get_status() === ticket::STATUS_CLOSED) {
                    throw new api_exception('ticket_closed', 409);
                }
                if (trim(strip_tags((string)($arguments['message'] ?? ''))) === '') {
                    throw new api_exception('invalid_message', 400);
                }
            } else {
                if ($item->get_courseid() && !has_capability('local/helpdesk:ticketmanage',
                        context_course::instance((int)$item->get_courseid(), MUST_EXIST), $identity->userid)) {
                    throw new api_exception('permission_denied', 403);
                }
                if (!isset($arguments['status']) && !isset($arguments['priority']) &&
                        !isset($arguments['categoryid'])) {
                    throw new api_exception('no_changes', 400);
                }
                if (isset($arguments['status']) && !in_array($arguments['status'],
                        ['open', 'progress', 'resolved', 'closed'], true)) {
                    throw new api_exception('invalid_status', 400);
                }
                if (isset($arguments['priority'])) {
                    self::assert_priority($arguments['priority']);
                }
                if (isset($arguments['categoryid']) &&
                        !$DB->record_exists('local_helpdesk_category',
                        ['id' => (int)$arguments['categoryid']])) {
                    throw new api_exception('invalid_category', 400);
                }
            }
        }
    }

    /**
     * Fetch an existing ticket.
     *
     * @param int $ticketid Parameter value.
     * @return ticket Result.
     */
    private static function require_ticket(int $ticketid): ticket {
        $item = $ticketid > 0 ? ticket::get_by_id($ticketid) : null;
        if (!$item) {
            throw new api_exception('ticket_not_found', 404);
        }
        return $item;
    }

    /**
     * Validate the ticket priority.
     *
     * @param string $priority Parameter value.
     * @return void Result.
     */
    private static function assert_priority(string $priority): void {
        if (!in_array($priority, ['low', 'medium', 'high', 'urgent'], true)) {
            throw new api_exception('invalid_priority', 400);
        }
    }

    /**
     * Create a new ticket and send notifications.
     *
     * @param array $arguments Validated input arguments.
     * @param authenticated_identity $identity Authenticated MCP user.
     * @return array Result.
     */
    private function create_ticket(array $arguments, authenticated_identity $identity): array {
        $now = time();
        $item = new ticket([
            'userid' => $identity->userid,
            'courseid' => (int)($arguments['courseid'] ?? 0),
            'categoryid' => (int)$arguments['categoryid'],
            'subject' => trim(clean_param($arguments['subject'], PARAM_TEXT)),
            'description' => clean_param($arguments['description'], PARAM_CLEANHTML),
            'status' => ticket::STATUS_OPEN,
            'priority' => $arguments['priority'] ?? ticket::PRIORITY_MEDIUM,
            'createdat' => $now,
            'updatedat' => $now,
        ]);
        $item->save();
        (new ticket_mail())->send_ticket($item);
        return ['id' => (int)$item->get_id(), 'idkey' => (int)$item->get_idkey(),
            'status' => $item->get_status(), 'created' => true];
    }

    /**
     * Add a reply with the normal ticket lifecycle.
     *
     * @param array $arguments Validated input arguments.
     * @param authenticated_identity $identity Authenticated MCP user.
     * @return array Result.
     */
    private function reply_ticket(array $arguments, authenticated_identity $identity): array {
        $item = self::require_ticket((int)$arguments['ticketid']);
        read_tool::assert_ticket_access((int)$item->get_userid(), $identity, (int)$item->get_courseid());
        if ($item->get_status() === ticket::STATUS_CLOSED) {
            throw new api_exception('ticket_closed', 409);
        }
        $now = time();
        $issupport = (int)$item->get_userid() !== $identity->userid &&
            has_capability('local/helpdesk:ticketmanage', context_system::instance(), $identity->userid);
        if ($issupport && !$item->get_answeredat()) {
            $item->set_answeredat($now);
            $item->set_updatedat($now);
            $item->save();
        }
        if ($issupport && $item->get_status() === ticket::STATUS_OPEN) {
            $item->change_status(ticket::STATUS_PROGRESS);
        }
        $reply = new response([
            'ticketid' => $item->get_id(),
            'userid' => $identity->userid,
            'type' => response::TYPE_MESSAGE,
            'message' => clean_param($arguments['message'], PARAM_CLEANHTML),
            'createdat' => $now,
        ]);
        $reply->save($item);
        $item->set_updatedat($now);
        $item->save();
        (new ticket_mail())->send_response($item, $reply);
        return ['id' => (int)$reply->get_id(), 'ticketid' => (int)$item->get_id(),
            'status' => $item->get_status(), 'created' => true];
    }

    /**
     * Apply ticket changes with audit history.
     *
     * @param array $arguments Validated input arguments.
     * @return array Result.
     */
    private function update_ticket(array $arguments): array {
        global $DB;
        $item = self::require_ticket((int)$arguments['ticketid']);
        $transaction = $DB->start_delegated_transaction();
        $changed = [];
        if (isset($arguments['status']) && $item->change_status($arguments['status'])) {
            $changed[] = 'status';
        }
        if (isset($arguments['priority']) && $item->change_priority($arguments['priority'])) {
            $changed[] = 'priority';
        }
        if (isset($arguments['categoryid']) &&
                (int)$item->get_categoryid() !== (int)$arguments['categoryid']) {
            $item->set_categoryid((int)$arguments['categoryid']);
            $item->set_updatedat(time());
            $item->save();
            $category = $item->get_category();
            response::create_status($item, get_string('lognewcategory', 'local_helpdesk',
                s($category->get_name())));
            $changed[] = 'categoryid';
        }
        $transaction->allow_commit();
        return ['id' => (int)$item->get_id(), 'idkey' => (int)$item->get_idkey(),
            'status' => $item->get_status(), 'priority' => $item->get_priority(),
            'categoryid' => (int)$item->get_categoryid(), 'changed' => $changed];
    }

    /**
     * Create a knowledge-base article.
     *
     * @param array $arguments Validated input arguments.
     * @param authenticated_identity $identity Authenticated MCP user.
     * @return array Result.
     */
    private function create_article(array $arguments, authenticated_identity $identity): array {
        $now = time();
        $article = new knowledgebase([
            'title' => trim(clean_param($arguments['title'], PARAM_TEXT)),
            'description' => clean_param($arguments['description'], PARAM_CLEANHTML),
            'categoryid' => (int)$arguments['categoryid'],
            'userid' => $identity->userid,
            'createdat' => $now,
            'updatedat' => $now,
        ]);
        $article->save();
        return ['id' => (int)$article->get_id(), 'title' => $article->get_title(), 'created' => true];
    }
}
