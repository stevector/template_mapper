<?php

/**
 * @file
 * Contains Drupal\template_mapper\Entity\TemplateMapper.
 */

namespace Drupal\template_mapper\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\template_mapper\TemplateMapperInterface;

/**
 * Defines the Template mapper entity.
 *
 * @ConfigEntityType(
 *   id = "template_mapper",
 *   label = @Translation("Template mapper"),
 *   handlers = {
 *     "list_builder" = "Drupal\template_mapper\TemplateMapperListBuilder",
 *     "form" = {
 *       "add" = "Drupal\template_mapper\Form\TemplateMapperForm",
 *       "edit" = "Drupal\template_mapper\Form\TemplateMapperForm",
 *       "delete" = "Drupal\template_mapper\Form\TemplateMapperDeleteForm"
 *     }
 *   },
 *   config_prefix = "template_mapper",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/template_mapper/{template_mapper}",
 *     "edit-form" = "/admin/structure/template_mapper/{template_mapper}/edit",
 *     "delete-form" = "/admin/structure/template_mapper/{template_mapper}/delete",
 *     "collection" = "/admin/structure/visibility_group"
 *   }
 * )
 */
class TemplateMapper extends ConfigEntityBase implements TemplateMapperInterface {
  /**
   * The Template mapper ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Template mapper label.
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
      $exploded = explode(":", trim($mapping));
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
