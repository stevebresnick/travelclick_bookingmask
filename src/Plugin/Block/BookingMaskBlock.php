<?php

/**
 * @file
 * Contains \Drupal\travelclick_bookingmask\Plugin\Block\BookingMaskBlock.
 */

namespace Drupal\travelclick_bookingmask\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'BookingMaskBlock' block.
 *
 * @Block(
 *  id = "bookingmask_block",
 *  admin_label = @Translation("TravelClick BookingMask Block"),
 * )
 */
class BookingMaskBlock extends BlockBase {


  /**
   * {@inheritdoc}
   */
  public function build() {

    return \Drupal::formBuilder()->getForm('Drupal\travelclick_bookingmask\Form\BookingForm');
  }

}
