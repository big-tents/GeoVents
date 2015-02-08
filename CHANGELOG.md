# 07-02-2015

## Fixes
- [x] after_now & one_year validators

## Added
- [x] Hide Join button if the user has already joined.
- [x] Allow users to leave joined events
- [x] Prevent users to join a already full event
 
## Upcoming
- [] Add host name on event page
- [] Add a red text 'Host' on the event page if you're the host
- [] Joined attendees / Total Attendees
- [] Validation to prevent users to join an event that's already full
- [] Hide Private Events and Set password for restricted events
- [] Function/Method comments
- [] When event is over -> ???
- [] Add Event Description
- [] Kick/leave an event -> Delete entry
- [] Clean events every 24 hours using Cronjob(Unix) or Windows Task Scheduler

# 06-02-2015

## Added
- [x] Implemented web design. 

## Upcoming
- [] Function/Method comments
- [] Implement web design
- [] When event is over -> ???
- [] Add Event Description
- [] Kick/leave an event -> Delete entry
- [] Clean events every 24 hours using Cronjob(Unix) or Windows Task Scheduler

# 02-02-2015

## Fixes
- [x] Max. word count event_name = 50
- [x] Max. word count event_type = 20
- [x] Only allow to create an event within 1 year (31536000 seconds)
- [x] XSS :: Join Event page (Date)
- [x] XSS :: Profile Edit -> Img
- [x] Token:: Join
- [x] acc_type validation
- [x] Limit the amount of events an attendee can join
- [x] Limit the amount of events a host can create

## Upcoming
- [] Function/Method comments
- [] Implement web design
- [] When event is over -> ???
- [] Add Event Description
- [] Kick/leave an event -> Delete entry
- [] Clean events every 24 hours using Cronjob(Unix) or Windows Task Scheduler
- [] Recreate migration

# 01-02-2015

## Added
- Redirection route from 'event' to 'events'.

- Added 'joined_events' (id, attendee_id, host_id, event_id, status, created_at, updated_at).

- In progress of 'join event'. Added validation rules that:
	- A host cannot also be an attendee
	- Prevent antendees joining an event twice

- Added dashboard page for user to see their hosted/joined events.

- Added 'JoinedEvents' Model.

# 26-01-2015

## Fixes
- Javascript base url problem: Generate BASE_URL via PHP and store it into a meta tag, and then read the contents of the meta tag with Javascript. 

- Register Page: Added validation rules to Username input field that only allows letters, numbers, and dashes.

- Register Page: Added validation rules to Password input field that it must be alphanumeric.

- Profile Edit: Added validation rules to Image Url input field that only allows url format.

- Host Event: Added validation rules to Event Name input field that only allows character, number, space, period (.), comma (,), plus (+), single quote('), and dash (-)

- Host Event: Added validation rules to Event Date input field that the chosen date has to be greater than current time.

- Database::table->events: Dropped 'e_organizer_id' (Was supposed to be event organizer id) since it's redundant.