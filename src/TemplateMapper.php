<?php

/**
 * @file
 * Contains Drupal\template_mapper\TemplateMapper.
 */

namespace Drupal\template_mapper;

/**
 * Defines the Template mapper service.
 *
 * @todo, make an interface.
 */
class TemplateMapper {

  public function performMapping($existing_suggestions, $hook) {
    // @todo, this service should not be calling \Drupal. That defeats the
    // purpose of a service.
    $TemplateMapper =  \Drupal\template_mapper\Entity\TemplateMapping::load($hook);
    // @todo Is there a better 'if' check to run?
    if ($TemplateMapper) {
      return $TemplateMapper->performMapping($existing_suggestions);
    }
    else {
      return $existing_suggestions;
    }
  }
}
