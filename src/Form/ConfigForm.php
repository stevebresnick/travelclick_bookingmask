<?php

/**
 * @file
 * Contains \Drupal\travelclick_bookingmask\Form\ConfigForm.
 */

namespace Drupal\travelclick_bookingmask\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ConfigForm.
 *
 * @package Drupal\travelclick_bookingmask\Form
 */
class ConfigForm extends ConfigFormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form = parent::buildForm($form, $form_state);
    $config = $this->config('travelclick_bookingmask.ihotelier');

    $form['hotelid'] = array(
      '#type' => 'number',
      '#title' => $this->t('Hotel ID'),
      '#description' => $this->t('Unique Hotel ID'),
      '#default_value' => $config->get('hotelid'),
    );
    $form['url_endpoint'] = array(
      '#type' => 'url',
      '#title' => $this->t('URL Endpoint'),
      '#description' => $this->t('Endpoint URL for the ihotelier booking mask engine'),
      '#default_value' => $config->get('endpointurl'),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $values = $form_state->getValues();
    $config = $this->config('travelclick_bookingmask.ihotelier');
    $config->set('hotelid', $values['hotelid'])->save();
    $config->set('endpointurl', $values['url_endpoint'])->save();

    return parent::submitForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {

    return ['travelclick_bookingmask.ihotelier'];

  }

}
