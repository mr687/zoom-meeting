<?php

namespace Mr687\ZoomMeeting\Classes;

use Illuminate\Support\Collection;
use Mr687\ZoomMeeting\Supports\Request;

class ZoomUser extends Request
{
  public function list()
  {
    return $this->path('users')
      ->get();
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