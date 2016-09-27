<?php

/**
 * @file
 * Contains \Drupal\route_planner\Form\RoutePlannerSettingsForm.
 */

namespace Drupal\route_planner\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element;

class RoutePlannerSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}.
   */
  public function getEditableConfigNames() {
    return ['route_planner.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'route_planner_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->configFactory->getEditable('route_planner.settings');
    foreach (Element::children($form) as $fieldset) {
      foreach (Element::children($form[$fieldset]) as $variable) {
        $config->set($variable, $form_state->getValue($variable));
      }
    }
    $config->save();

    parent::submitForm($form, $form_state);
  }


  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['route_planner'] = array(
      '#type'  => 'fieldset',
      '#title' => t('Route Planner Settings'),
    );

    $form['route_planner']['route_planner_address'] = array(
      '#type'          => 'textfield',
      '#description'   => t('Your point of interesst or company address.'),
      '#title'         => t('Target address'),
      '#default_value' => \Drupal::config('route_planner.settings')->get('route_planner_address'),
    );
    $form['route_planner']['route_planner_address_end'] = array(
      '#type'          => 'checkbox',
      '#title'         => t('Show an end point field.'),
      '#description'   => t('If checked the address block will have a end point field with the default address from your POI above.'),
      '#default_value' => \Drupal::config('route_planner.settings')->get('route_planner_address_end'),
    );
    $form['route_planner']['route_planner_unitsystem'] = array(
      '#type'          => 'select',
      '#description'   => t('Select your preferred unit system IMPERIAL or METRIC.'),
      '#title'         => t('Unit System'),
      '#options'       => array(
        0 => t('metric'),
        1 => t('imperial'),
      ),
      '#default_value' => \Drupal::config('route_planner.settings')->get('route_planner_unitsystem'),
    );

    $form['map-settings'] = array(
      '#type'  => 'fieldset',
      '#title' => t('Map Settings'),
    );
    $form['map-settings']['route_planner_map_height'] = array(
      '#type'          => 'textfield',
      '#title'         => t('Map Height'),
      '#description'   => t('A fixed height for example 300px.'),
      '#size'          => 10,
      '#default_value' => \Drupal::config('route_planner.settings')->get('route_planner_map_height'),
    );
    $form['map-settings']['route_planner_map_width'] = array(
      '#type'          => 'textfield',
      '#title'         => t('Map Width'),
      '#description'   => t('A width value in % or px, for example 300px or 100%.'),
      '#size'          => 10,
      '#default_value' => \Drupal::config('route_planner.settings')->get('route_planner_map_width'),
    );
    $form['map-settings']['route_planner_map_zoom'] = array(
      '#type'          => 'textfield',
      '#title'         => t('Zoom Level'),
      '#description'   => t('A value between 1 and 100 (a normal value is around 10).'),
      '#size'          => 10,
      '#default_value' => \Drupal::config('route_planner.settings')->get('route_planner_map_zoom'),
    );
    $form['map-settings']['route_planner_map_defaultui'] = array(
      '#type'          => 'checkbox',
      '#title'         => t('Disable Default UI Controls'),
      '#description'   => t('Disables all UI Controls in the map.'),
      '#default_value' => \Drupal::config('route_planner.settings')->get('route_planner_map_defaultui'),
    );
    $form['map-settings']['route_planner_map_zoomcontrol'] = array(
      '#type'          => 'checkbox',
      '#title'         => t('Enable ZoomControl'),
      '#default_value' => \Drupal::config('route_planner.settings')->get('route_planner_map_zoomcontrol'),
    );
    $form['map-settings']['route_planner_map_scrollwheel'] = array(
      '#type'          => 'checkbox',
      '#title'         => t('Enable ScrollWheel'),
      '#default_value' => \Drupal::config('route_planner.settings')->get('route_planner_map_scrollwheel'),
    );
    $form['map-settings']['route_planner_map_maptypecontrol'] = array(
      '#type'          => 'checkbox',
      '#title'         => t('Enable Map Type Control'),
      '#default_value' => \Drupal::config('route_planner.settings')->get('route_planner_map_maptypecontrol'),
    );
    $form['map-settings']['route_planner_map_scalecontrol'] = array(
      '#type'          => 'checkbox',
      '#title'         => t('Enable Scale Control'),
      '#default_value' => \Drupal::config('route_planner.settings')->get('route_planner_map_scalecontrol'),
    );
    $form['map-settings']['route_planner_map_draggable'] = array(
      '#type'          => 'checkbox',
      '#title'         => t('Enable Mouse Drag'),
      '#default_value' => \Drupal::config('route_planner.settings')->get('route_planner_map_draggable'),
    );
    $form['map-settings']['route_planner_map_doubbleclick'] = array(
      '#type'          => 'checkbox',
      '#title'         => t('Disable Doubble Click Zoom'),
      '#default_value' => \Drupal::config('route_planner.settings')->get('route_planner_map_doubbleclick'),
    );
    $form['map-settings']['route_planner_map_streetviewcontrol'] = array(
      '#type'          => 'checkbox',
      '#title'         => t('Enable Streetview Control'),
      '#default_value' => \Drupal::config('route_planner.settings')->get('route_planner_map_streetviewcontrol'),
    );
    $form['map-settings']['route_planner_map_overviewmapcontrol'] = array(
      '#type'          => 'checkbox',
      '#title'         => t('Enable Overview Map'),
      '#default_value' => \Drupal::config('route_planner.settings')->get('route_planner_map_overviewmapcontrol'),
    );
    return parent::buildForm($form, $form_state);
  }
}
