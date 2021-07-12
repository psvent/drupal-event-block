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
    $d2 = new DateTime($date);
    $interval = $d2->diff($today);

    if ($d2<$today) {
      return -1;
    }

    return $interval->days;
  }
}
