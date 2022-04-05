<?php

namespace Drupal\headless_vue\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class FormSubscribe extends FormBase{
    
  public function getFormId(){
      return "subscribe_form";
  }

  /**
   * Form constructor.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   The form structure.
   */
  public function buildForm(array $form, FormStateInterface $form_state){
      $form["first_name"] = array(
        '#type' => 'textfield',
        '#title' => $this->t('First Name'),
        '#size' => 60,
        '#maxlength' => 128,
        '#required' => TRUE,
      );

      $form["last_name"] = array(
        '#type' => 'textfield',
        '#title' => $this->t('Last Name'),
        '#size' => 60,
        '#maxlength' => 128,
        '#required' => TRUE,
      );

      $form['gender'] = [
        '#type' => 'select',
        '#title' => $this->t('Select gender'),
        '#options' => [
          "Male" => $this->t('Male'),
          "Female" => $this->t('Female'),
        ],
        '#required' => TRUE,
      ];

      $form['email'] = array(
        '#type' => 'email',
        '#title' => $this->t('Email'),
      );      

      $form['submit'] = array(
        '#type' => 'submit',
        '#value' => $this->t('Soumettre'),
      );

      return $form;
    }

  /**
   * Form validation handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function validateForm(array &$form, FormStateInterface $form_state){
      if (is_numeric($form_state->getValue('first_name'))) {
        $form_state->setErrorByName('first_name',$this->t('Error , The first name must be a string'));
      }
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state){
      drupal_set_message($this->t('Your firstname is: @first_name <br> lastname is: @last_name <br>
      gender is: @gender <br> email is: @email <br>
      ', [
        '@first_name' => $form_state->getValue('first_name'),
        '@last_name' => $form_state->getValue('last_name'),
        '@gender' => $form_state->getValue('gender'),
        '@email' => $form_state->getValue('email')
      ]));
  }

}