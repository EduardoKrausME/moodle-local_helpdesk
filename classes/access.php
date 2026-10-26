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
 * Ticket read/write authorisation helpers.
 *
 * @package   local_helpdesk
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk;

use context;
use local_helpdesk\model\ticket;

/**
 * Keep read-only access separate from all ticket mutations.
 */
final class access {
    /**
     * Can list and read tickets belonging to other users.
     *
     * @param context $context Relevant Moodle context.
     * @param int|null $userid User to check, or the current user.
     * @return bool
     */
    public static function can_view_all(context $context, ?int $userid = null): bool {
        return has_capability("local/helpdesk:ticketmanage", $context, $userid)
            || has_capability("local/helpdesk:viewall", $context, $userid);
    }

    /**
     * Read a particular ticket.
     *
     * @param ticket $ticket Ticket.
     * @param context $context Ticket context.
     * @param int|null $userid User to check, or the current user.
     * @return bool
     */
    public static function can_view_ticket(ticket $ticket, context $context, ?int $userid = null): bool {
        global $USER;

        if (self::can_view_all($context, $userid)) {
            return true;
        }
        $userid = $userid ?? (int)$USER->id;
        return (int)$ticket->get_userid() === $userid
            && has_capability("local/helpdesk:view", $context, $userid);
    }

    /**
     * Creating a ticket is never implied by read-only viewall.
     *
     * @param context $context Context.
     * @param int|null $userid User to check, or the current user.
     * @return bool
     */
    public static function can_create(context $context, ?int $userid = null): bool {
        return has_capability("local/helpdesk:ticketmanage", $context, $userid)
            || has_capability("local/helpdesk:view", $context, $userid);
    }

    /**
     * Support agents may reply to any ticket; ordinary users may reply to their own.
     *
     * @param ticket $ticket Ticket.
     * @param context $context Context.
     * @param int|null $userid User to check, or the current user.
     * @return bool
     */
    public static function can_reply(ticket $ticket, context $context, ?int $userid = null): bool {
        global $USER;

        if (has_capability("local/helpdesk:ticketmanage", $context, $userid)) {
            return true;
        }
        $userid = $userid ?? (int)$USER->id;
        return (int)$ticket->get_userid() === $userid
            && has_capability("local/helpdesk:view", $context, $userid);
    }
}
