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