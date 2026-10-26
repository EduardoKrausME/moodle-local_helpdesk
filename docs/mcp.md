# MCP auto-discovery

Kopere Helpdesk exposes tools to the optional `local_mcp` server using the same
convention as LearnLingo: `classes/mcp/provider.php` implements both provider
interfaces. Installing and enabling both plugins is sufficient; no callback in
`lib.php`, manual registration, new endpoint or Helpdesk API token is needed.
Use the OAuth or token authentication and READ/WRITE MCP endpoints supplied by
`local_mcp`. The connected Moodle user's permissions are used for every call.

## READ tools

| Tool | Purpose |
| --- | --- |
| `helpdesk_list_tickets` | Paginated, searchable tickets. Regular users only see their own. |
| `helpdesk_get_ticket` | Full ticket details and response history; owner or support only. |
| `helpdesk_list_categories` | Helpdesk categories. |
| `helpdesk_ticket_stats` | Aggregate ticket counts, support only. |

READ tools use `local/helpdesk:view`; aggregate statistics require
`local/helpdesk:ticketmanage`. Ticket reads additionally verify ownership
unless the connected user has support permission.

## WRITE tools

| Tool | Required capability | Purpose |
| --- | --- | --- |
| `helpdesk_create_ticket` | `local/helpdesk:view` | Open a ticket as the connected user and send standard notifications. |
| `helpdesk_reply_ticket` | `local/helpdesk:view` | Reply to own ticket or a ticket accessible to support; sends notifications. |
| `helpdesk_update_ticket` | `local/helpdesk:ticketmanage` | Update status, priority or category, retaining audit history. |

All writes require `local_mcp` confirmation and support a side-effect-free
preview. No tool accepts a forged author ID. Ticket and reply creation reuse the
Helpdesk models and mail notifications; HTML is sanitized before being saved.
No destructive/delete operation is exposed.

The MCP provider is intentionally optional: without `local_mcp`, the normal
Helpdesk UI, web service and cron tasks continue operating unchanged.

After deploying new PHP classes, complete Moodle's plugin upgrade and purge
Moodle caches if a previously cached tool list does not refresh.
