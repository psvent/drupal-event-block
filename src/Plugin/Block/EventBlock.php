<?php

namespace Drupal\event_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an 'Event' Block.
 *
 * @Block(
 *   id = "event_block",
 *   admin_label = @Translation("Event block"),
 *   category = @Translation("Events"),
 * )
 *
 *
 *
 *
 * Create a custom block which will be displayed in the sidebar on the event page.
 * The block should display how many days are left until the event starts,
 * example: ‘12 days left until event starts’.
 * If the event is going to happen on the current day display 'This event is happening today'.
 * If the event has ended, display ‘This event already passed.’.
 */
class EventBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Get Title of Block's parent Node.
    $node = \Drupal::routeMatch()->getParameter('node');
    $s = \Drupal::service('event_block.event_services');
    $d = $s->daysUntilEvent(date("Y-m-d", strtotime($node->get("field_event_date")->value)));

    switch ($d) {
      case -1:
        $text = "The event has already passed.";
        break;
      case 0:
        $text = "The event starts today.";
        break;
      case 1:
        $text = "1 day left until event starts.";
        break;
      default:
        $text = "$d days left until event starts.";
    }

    return [
      '#markup' => $this->t($text),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge() {
    return 0;
  }

}
