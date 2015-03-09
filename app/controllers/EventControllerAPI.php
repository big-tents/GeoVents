<?php

class EventControllerApi extends EventController{
    
    /**
      * (GET/API) Events :: Return view 
      *
      * @return to events page
      */
    public function getEvents()
    {
        return View::make('event.events')
            ->with('title', 'Events');
    }




    /**
      * (GET/API) Event Types :: It suggests a list of event types that are stored into the database.
      *
      * @param string    $input
      *
      * @return Response found event types as JSON
      */
    public function getEventTypes($input)
    {
        //Get event types
        $event_types = EventType::where('type', 'LIKE', '%' . $input . '%')->get();
        
        //Return event types as JSON data
        return Response::json($event_types);

    }




    /**
      * (GET/API) Events :: Filter Events
      *
      * @param string $input   
      *
      * @return Response found events as JSON
      */
    public function getFilterEvents($input = '')
    {
        //Get events
        // $events = DB::table('events')
        $events = EEvent::join('event_types', 'events.etype_id', '=', 'event_types.id')
        // ->leftjoin('joined_events', 'joined_events.event_id', '=', 'events.id')
        ->select(
            [
                'events.id',
                'type', 
                'audience', 
                'e_name',
                'e_date',
                'e_endDate',
                'e_description',
                'e_location',
                'total_attendees',
                'e_lat',
                'e_lng',
                'events.created_at',
                // '*',
                DB::raw('events.user_id = ' . Auth::user()->id . ' as hosting'),
                // DB::raw('joined_events.attendee_id = ' . Auth::user()->id . ' && events.id = joined_events.event_id as joined')
            ]
        )
        ->where('e_name', 'LIKE', '%' . $input . '%')
        ->orWhere('e_location', 'LIKE', '%' . $input . '%')
        ->orWhere('type', 'LIKE', '%' . $input . '%')
        ->get();

        // return pretty JSON result
        return Response::json($events, 200, array(), JSON_PRETTY_PRINT);
    }

}