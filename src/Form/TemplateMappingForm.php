<?php

/**
 * @file
 * Contains Drupal\template_mapper\Form\TemplateMappingForm.
 */

namespace Drupal\template_mapper\Form;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class TemplateMappingForm.
 *
 * @package Drupal\template_mapper\Form
 */
class TemplateMappingForm extends EntityForm {
  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $template_mapping = $this->entity;
    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $template_mapping->label(),
      '#description' => $this->t("Label for the Template mapping."),
      '#required' => TRUE,
    );

    $form['id'] = array(
      '#type' => 'machine_name',
      '#default_value' => $template_mapping->id(),
      '#machine_name' => array(
        'exists' => '\Drupal\template_mapper\Entity\TemplateMapping::load',
      ),
      '#disabled' => !$template_mapping->isNew(),
    );


    $form['mappings'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Mappings'),
      '#default_value' => $template_mapping->getMappings(),
    );

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $template_mapping = $this->entity;
    $status = $template_mapping->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Template mapping.', [
          '%label' => $template_mapping->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Template mapping.', [
          '%label' => $template_mapping->label(),
        ]));
    }
    $form_state->setRedirectUrl($template_mapping->urlInfo('collection'));
  }

}
