<?php

/**
* Provides a field type of TimeField
*
* @FieldType(
*   id = "timefield",
*   label = @Translation("Time field"),
* )
*/

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

class TimeField extends FieldItemBase implements FieldItemInterface {

    /**
     * {@inheritdoc}
     */
    public static function schema(FieldStorageDefinitionInterface $field_definition) {
        return array(
            'columns' => array(
                'value' => array(
                    'type' => 'timestamp',
                    'not null' => TRUE,
                ),
            ),
        );
    }

    /**
     * {@inheritdoc}
     */
    public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
        $properties['value'] = DataDefinition::create('string');

        return $properties;
    }

}
