<?php

namespace Drupal\nightjar\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormState;
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
    // This will be replaced by the AJAX
    $form['surround'] = [
      '#type' => 'container',
      '#attributes' => ['id' => 'kernel-surround'],
    ];
    // The kernel contains HTML markup that can be replaced on submit.
    $form['surround']['kernel'] = [
      '#type' => 'markup',
      // TODO: create conditional markup based on the selection
      '#markup' => '<h1>Nightjars have been commonly named:</h1>',
    ];

    $form['surround']['nightjar-name'] = [
      //'#title' => $this->t(""),
      '#type' => 'select',
      '#options' => [
        'bugeaters' => 'bugeaters',
        'honeysuckers' => 'honeysuckers',
        'goatsuckers' => 'goatsuckers',
        'swoopers'  =>  'swoopers',
      ]
    ];

    $form['surround']['submit'] = [
      '#type' => 'submit',
      // AJAX callback is going to call the callback
      // And will replace the page element with the id kernel-surround
      '#ajax' => [
        'callback' => '::nightjaroneCallback',
        'wrapper' => 'kernel-surround',
      ],
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }
  /**
   * @inheritDoc
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
  }

  /**
   * The callback for the submit
   * Select the 'kernel' element and change the markup in it
   * Return it as a renderable array
   * @return array
   *   Renderable array (the surround element)
   */
  public function nightjaroneCallback(array &$form, FormStateInterface $form_state) {
    $element = $form['surround'];
    $element ['kernel']['#markup'] = "<h2>Nightjars are not called <strong>{$form_state->getValue('nightjar-name')}</strong>.<br><p>Try again.</p></h2>";
    unset($element ['nightjar-name']);
    //unset($element ['submit']);

    $element ['submit'] = [
      '#type' => 'submit',
      // AJAX callback is going to call the callback
      // And will replace the page element with the id kernel-surround
      '#ajax' => [
        'callback' => '::nightjaroneCallback',
        'wrapper' => 'kernel-surround',
      ],
      '#value' => $this->t('Go Back'),
    ];

    return $element;
  }
}
