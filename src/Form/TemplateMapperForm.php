<?php

/**
 * @file
 * Contains Drupal\template_mapper\Form\TemplateMapperForm.
 */

namespace Drupal\template_mapper\Form;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class TemplateMapperForm.
 *
 * @package Drupal\template_mapper\Form
 */
class TemplateMapperForm extends EntityForm {
  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $template_mapper = $this->entity;
    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $template_mapper->label(),
      '#description' => $this->t("Label for the Template mapper."),
      '#required' => TRUE,
    );

    $form['id'] = array(
      '#type' => 'machine_name',
      '#default_value' => $template_mapper->id(),
      '#machine_name' => array(
        'exists' => '\Drupal\template_mapper\Entity\TemplateMapper::load',
      ),
      '#disabled' => !$template_mapper->isNew(),
    );


    $form['mappings'] = array(
      '#type' => 'textarea',
      '#default_value' => $template_mapper->getMappings(),
    );

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $template_mapper = $this->entity;
    $status = $template_mapper->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Template mapper.', [
          '%label' => $template_mapper->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Template mapper.', [
          '%label' => $template_mapper->label(),
        ]));
    }
    $form_state->setRedirectUrl($template_mapper->urlInfo('collection'));
  }

}
