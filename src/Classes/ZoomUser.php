<?php

namespace Mr687\ZoomMeeting\Classes;

use Mr687\ZoomMeeting\Supports\Request;

class ZoomUser extends Request
{
  public function listUsers()
  {
    return $this->path('users')
      ->get();
  }

  public function createUser(array $data)
  {
    // Only for Zoom PRO or Higher Plan
    return $this->path('users')
      ->fields($data)
      ->post();
  }

  public function listMeetings(string $userId)
  {
    return $this->path("users/{$userId}/meetings")
      ->get();
  }

  public function createMeeting(string $userId, array $data)
  {
    return $this->path("users/{$userId}/meetings")
      ->fields($data)
      ->post();
  }
}
