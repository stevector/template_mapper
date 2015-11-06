<?php

/**
 * @file
 * Contains Drupal\template_mapper\Entity\TemplateMapping.
 */

namespace Drupal\template_mapper\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\template_mapper\TemplateMappingInterface;

/**
 * Defines the Template mapping entity.
 *
 * @ConfigEntityType(
 *   id = "template_mapping",
 *   label = @Translation("Template mapping"),
 *   handlers = {
 *     "list_builder" = "Drupal\template_mapping\TemplateMappingListBuilder",
 *     "form" = {
 *       "add" = "Drupal\template_mapping\Form\TemplateMappingForm",
 *       "edit" = "Drupal\template_mapping\Form\TemplateMappingForm",
 *       "delete" = "Drupal\template_mapping\Form\TemplateMappingDeleteForm"
 *     }
 *   },
 *   config_prefix = "template_mapping",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/template_mapping/{template_mapping}",
 *     "edit-form" = "/admin/structure/template_mapping/{template_mapping}/edit",
 *     "delete-form" = "/admin/structure/template_mapping/{template_mapping}/delete",
 *     "collection" = "/admin/structure/visibility_group"
 *   }
 * )
 */
class TemplateMapping extends ConfigEntityBase implements TemplateMappingInterface {
  /**
   * The Template mapping ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Template mapping label.
   *
   * @var string
   */
  protected $label;


  protected $mappings;



  /**
   * {@inheritdoc}
   */
  public function getMappings() {
    return $this->mappings;
  }

  /**
   * {@inheritdoc}
   */
  public function setMappings($mappings) {
    $this->weight = $mappings;
  }

  public function getMappingsArray() {

    $return = array();
    $mappings = explode("/", $this->mappings);
    foreach ($mappings as $mapping) {
      $exploded = explode("|", trim($mapping));
      $return[trim($exploded[0])] = trim($exploded[1]);
    }
    return $return;
  }


  public function performMapping($existing_suggestions) {

    $replacements = $this->getMappingsArray();

    $new_suggestions = array();
    foreach ($existing_suggestions as $suggestion) {

      if (array_key_exists($suggestion, $replacements)) {
        $new_suggestions[] = $replacements[$suggestion];
      }
      else {
        $new_suggestions[] = $suggestion;
      }

    }
    return $new_suggestions;
  }

}
