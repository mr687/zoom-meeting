<?php

namespace Mr687\ZoomMeeting\Facades;

use Illuminate\Support\Facades\Facade;

class ZoomMeetingFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'zoom-meeting';
    }
}
