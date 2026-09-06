# Kopere Helpdesk

**Kopere Helpdesk** is a complete support ticket system integrated directly into Software Moodle™. It allows students and other users to request help without leaving the learning environment, while support teams can organize, answer, prioritize and track every request from a single place.

**Documentation:** https://eduardokrausme.github.io/moodle-local_helpdesk/
**Source code:** https://github.com/EduardoKrausME/moodle-local_helpdesk
**Contact:** https://eduardokraus.com/contato

## Main features

Kopere Helpdesk brings the support workflow into Moodle and keeps the request, conversation and learning context together.

* Users can create and follow their own support tickets.
* Support staff can create tickets on behalf of other users.
* Tickets can be associated with a Moodle course.
* Tickets are organized by category, status and priority.
* Categories can have specific users responsible for answering requests.
* New tickets and replies generate email notifications.
* Attachments can be included in tickets and responses.
* Ticket history records changes made during the support process.
* Support teams can filter tickets by user, course, category, status and priority.
* Text search is available for ticket subjects and descriptions.
* A built-in knowledge base can be maintained alongside the ticket system.
* Tickets can be exported for analysis outside Moodle.
* Reports are provided through Kopere BI.
* Optional GeniAI integration can assist with writing replies and knowledge-base articles.
* Scheduled tasks remind support teams about unanswered tickets and automatically close resolved tickets after the configured workflow period.

## Ticket workflow

Each ticket has a status and a priority.

### Status

| Status          | Meaning                                                                   |
| --------------- | ------------------------------------------------------------------------- |
| **Open**        | The request has been created and is waiting for attention.                |
| **In Progress** | The support team is working on the request.                               |
| **Resolved**    | A solution has been provided and the ticket is waiting for final closure. |
| **Closed**      | The support cycle has been completed.                                     |

### Priority

| Priority   | Intended use                                      |
| ---------- | ------------------------------------------------- |
| **Urgent** | Requires immediate attention.                     |
| **High**   | Important request that should be handled quickly. |
| **Medium** | Normal support request.                           |
| **Low**    | Request with lower operational priority.          |

When replying to a ticket, support staff can keep the ticket active, mark it as resolved or close it. Changes to status, priority and category are recorded in the ticket history.

## Categories and support teams

Categories make it possible to organize the helpdesk according to the structure of the institution, for example:

* Technical Support
* Academic Office
* Student Support
* Course Administration

Each category can have users assigned to answer requests and receive notifications about new tickets in that category.

This makes it possible to route different types of requests to the appropriate team without creating separate support systems outside Moodle.

## Knowledge base

Kopere Helpdesk includes a knowledge base for publishing reusable support content.

Articles contain a title, content, author and optional category. They can be organized alongside ticket categories so recurring questions can be documented and reused by the support team.

When GeniAI is configured, the plugin can also assist with drafting knowledge-base content from instructions provided by the user.

## AI-assisted replies with GeniAI

The integration with **GeniAI** is optional.

When GeniAI is installed and configured with an API key, support staff can request a suggested response directly from the ticket reply form.

The generated text is not sent automatically. It is returned to the support workflow so the team can review, edit and decide whether to use it.

The integration can use the ticket content and conversation context to help prepare a more relevant reply.

GeniAI can also assist with drafting knowledge-base articles.

More information:

https://moodle.org/plugins/local_geniai

## Reports

Kopere Helpdesk integrates with **Kopere BI** and currently provides report definitions grouped into five areas:

1. **Tickets** — ticket creation and resolution over time.
2. **Categories** — demand and service indicators by category.
3. **Status and Priority** — distribution of tickets and service times.
4. **Users** — users generating the highest volume of support requests.
5. **Support activity** — participation in ticket responses.

These reports are intended to help support managers identify demand patterns, pending work and service performance.

More information about Kopere BI:

https://moodle.org/plugins/local_kopere_bi

## Export

Tickets can be exported for external analysis.

The export includes ticket information such as user, course, subject, description, status, priority, category and email. Ticket responses are also included so the conversation can be analyzed outside Moodle.

The export can be filtered by ticket status.

## Scheduled tasks

Kopere Helpdesk uses Moodle scheduled tasks. Moodle cron must therefore be configured correctly.

| Task                                    | Default schedule | Behaviour                                                                                                                         |
| --------------------------------------- | ---------------- | --------------------------------------------------------------------------------------------------------------------------------- |
| `\local_helpdesk\task\response_tickets` | Daily at 00:00   | Sends one reminder to the category support users when an open or in-progress ticket has been unanswered for more than three days. |
| `\local_helpdesk\task\close_tickets`    | Daily at 00:00   | Closes tickets that have remained in the resolved state for at least 48 hours.                                                    |

The schedule can be reviewed or changed through Moodle's scheduled task administration.

The reminder task records that the reminder was sent so the same unanswered-ticket reminder is not repeatedly sent for the same ticket.

After installation, verify that Moodle cron is running correctly because the reminder and automatic-closing workflows depend on scheduled tasks.

## Configuration

The main plugin setting is available under:

**Site administration → Plugins → Local plugins → Helpdesk**

The Helpdesk navigation can be configured as:

* **Do not show**
* **Show only inside the course**
* **Show throughout the system**

The default configuration displays the Helpdesk inside courses.

Support categories and their responsible users can then be managed from the Helpdesk interface.

## Permissions

The plugin currently defines the following Moodle capabilities:

| Capability                      | Purpose                                                 |
| ------------------------------- | ------------------------------------------------------- |
| `local/helpdesk:view`           | View Helpdesk tickets and create tickets for oneself.   |
| `local/helpdesk:ticketmanage`   | Manage tickets, including replying to and closing them. |
| `local/helpdesk:categorymanage` | Create and manage Helpdesk categories.                  |
| `local/helpdesk:categorydelete` | Delete Helpdesk categories.                             |

These capabilities can be assigned through normal Moodle roles.

## Contributing

Contributions are welcome.

If you find a bug, have a feature proposal or want to improve the plugin, open an issue or submit a pull request:

https://github.com/EduardoKrausME/moodle-local_helpdesk/issues

When reporting a problem, include the Moodle version, Helpdesk version, steps to reproduce the issue and any relevant error messages or logs.

## License

Kopere Helpdesk is licensed under the **GNU General Public License v3 or later**.

https://www.gnu.org/licenses/gpl-3.0.html

## Author and support

Developed by **Eduardo Kraus**.

For implementation, customization or professional Moodle support:

https://eduardokraus.com/contato

