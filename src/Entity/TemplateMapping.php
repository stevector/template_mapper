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
 *     "list_builder" = "Drupal\template_mapper\TemplateMappingListBuilder",
 *     "form" = {
 *       "add" = "Drupal\template_mapper\Form\TemplateMappingForm",
 *       "edit" = "Drupal\template_mapper\Form\TemplateMappingForm",
 *       "delete" = "Drupal\template_mapper\Form\TemplateMappingDeleteForm"
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


  protected $mapping;

  /**
   * {@inheritdoc}
   */
  public function getMapping() {
    return $this->mapping;
  }

  /**
   * {@inheritdoc}
   */
  public function setMapping($mapping) {
    $this->weight = $mapping;
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



}
