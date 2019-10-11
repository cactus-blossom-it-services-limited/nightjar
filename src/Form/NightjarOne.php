<?php

namespace Drupal\nightjar\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * A relatively simple AJAX demonstration form.
 */
class NightjarOne extends FormBase
{
  /**
   * @inheritDoc
   */
  public function getFormId()
  {
    return 'nightjar_one';
  }

  /**
   * @inheritDoc
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $form['changethis'] = [
      '#title' => $this->t("A common name for the nightjar is:"),
      '#type' => 'select',
      '#options' => [
        'bugeaters' => 'bugeaters',
        'honeysuckers' => 'honeysuckers',
        'goatsuckers' => 'goatsuckers',
        'swoopers'  =>  'swoopers',
      ]
    ];
    return $form;
  }
  /**
   * @inheritDoc
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    // TODO: Implement submitForm() method.
  }
}
