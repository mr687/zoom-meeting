<?php

namespace Mr687\ZoomMeeting\Classes;

use Mr687\ZoomMeeting\Supports\Request;

class ZoomMeeting extends Request
{
  public function retrieve(string $meetingId)
  {
    return $this->path("meetings/{$meetingId}")
      ->get();
  }

  public function delete(string $meetingId, array $data)
  {
    return $this->path("meetings/{$meetingId}")
      ->delete();
  }

  public function update(string $meetingId, array $data)
  {
    return $this->path("meetings/{$meetingId}")
      ->fields($data)
      ->patch();
  }

  public function updateStatus(string $meetingId, $action)
  {
    return $this->path("meetings/{$meetingId}")
    ->fields(['action' => $action])
    ->put();
  }

  public function getInvitation(string $meetingId)
  {
    return $this->path("meetings/{$meetingId}/invitation")
      ->get();
  }
}
