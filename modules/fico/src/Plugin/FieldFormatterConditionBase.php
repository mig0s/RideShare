<?php

namespace Drupal\fico\Plugin;

use Drupal\Component\Plugin\PluginBase;
use Drupal\field\FieldConfigInterface;

/**
 * Base class for Field formatter condition plugins.
 */
abstract class FieldFormatterConditionBase extends PluginBase implements FieldFormatterConditionInterface {

  /**
   * {@inheritdoc}
   */
  public function getDefinition($plugin_id, $exception_on_invalid = TRUE) {}

  /**
   * {@inheritdoc}
   */
  public function getDefinitions() {}

  /**
   * {@inheritdoc}
   */
  public function hasDefinition($plugin_id) {}

  /**
   * {@inheritdoc}
   */
  public function createInstance($plugin_id, array $configuration = []) {}

  /**
   * {@inheritdoc}
   */
  public function getInstance(array $options) {}

  /**
   * Alter the condition form.
   *
   * @param array $form
   *   Condition formular.
   * @param array $settings
   *   Settings array.
   */
  abstract public function alterForm(&$form, $settings);

  /**
   * Access control function.
   *
   * @param array $build
   *   The current build array.
   * @param string $field
   *   The current field name.
   * @param array $settings
   *   The current settings array.
   */
  abstract public function access(&$build, $field, $settings);

  /**
   * Return the summary string.
   *
   * @param array $settings
   *   The current settings array.
   */
  abstract public function summary($settings);

  /**
   * Load fields from a entity.
   *
   * @param string $entity_type
   *   Type of entity.
   * @param string $bundle
   *   Entity bundle.
   *
   * @return array
   *   Returns the field definitions.
   */
  protected function getEntityFields($entity_type, $bundle) {
    $fields = [];
    $entityManager = \Drupal::service('entity.manager');
    if (!empty($entity_type) && !empty($bundle)) {
      $fields = array_filter(
        $entityManager->getFieldDefinitions($entity_type, $bundle), function ($field_definition) {
          return $field_definition instanceof FieldConfigInterface;
        }
      );
    }

    return $fields;
  }

}
