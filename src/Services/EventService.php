<?php

namespace Drupal\event_block\Services;

use DateTime;

/**
 * Class EventService.
 */
class EventService {

  /**
   * Constructs a new EventService object.
   */
  public function __construct() {
  }

  public function daysUntilEvent($date) {
    $today = new DateTime(date("Y-m-d"));
    $event_date = new DateTime($date);
    $interval = $event_date->diff($today);

    if ($event_date<$today) {
      return -1;
    }

    return $interval->days;
  }
}
