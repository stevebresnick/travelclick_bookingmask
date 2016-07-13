<?php

/**
 * @file
 * Contains \Drupal\travelclick_bookingmask\Form\BookingForm.
 */

namespace Drupal\travelclick_bookingmask\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Routing\TrustedRedirectResponse;

/**
 * Class BookingForm.
 *
 * @package Drupal\travelclick_bookingmask\Form
 */
class BookingForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'travelclick_bookingmask_booking_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['datein'] = array(
      '#type' => 'date',
      '#title' => $this->t('Check-in Date'),
      '#description' => $this->t('Check-in Date'),
    );
    $form['dateout'] = array(
      '#type' => 'date',
      '#title' => $this->t('Check-out Date'),
      '#description' => $this->t('Check-out Date'),

    );
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Check Rates'),
      '#button_type' => 'primary',
    );

    return $form;
  }


  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

    if (!$form_state->isValueEmpty('datein')) {
      $form['datein'] = $form_state->getValue('datein');
    } else {
      $form_state->setErrorByName('datein', t ('Please enter check-in date'));
    }

    if (!$form_state->isValueEmpty('dateout')) {
      $form['dateout'] = $form_state->getValue('dateout');
    } else {
      $form_state->setErrorByName('dateout', t ('Please enter check-out date'));
    }

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $form_state->setResponse($this->buildResponse($form_state->getValue('datein'), $form_state->getValue('dateout')));

  }

  protected function buildResponse($datein, $dateout){

    $config = $this->config('travelclick_bookingmask.ihotelier');

    $hotelid = $config->get('hotelid');
    $endpointurl = $config->get('endpointurl');

    //Convert dates to the correct m/d/Y format
    $checkin = date('m/d/Y', strtotime($datein));
    $checkout = date('m/d/Y', strtotime($dateout));

    $uri =  $endpointurl . '&hotelid=' . $hotelid . '&datein=' .$checkin . '&dateout=' .$checkout;

    return new TrustedRedirectResponse($uri);

  }

}
