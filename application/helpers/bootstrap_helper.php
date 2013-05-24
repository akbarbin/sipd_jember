<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 * 
 * Herper to create form which use bootstrap css
 */

/**
 * 
 * @return string
 */
function bootstrap_control_group() {
  return '<div class="control-group">';
}

/**
 * 
 * @return string
 */
function bootstrap_controls() {
  return '<div class="controls">';
}

/**
 * 
 * @param string $name
 * @param array $option
 * @return string
 */
function bootstrap_control_label($name = NULL, $option = array()) {
  $output = '';
  if (isset($option['label']) && $option['label'] != FALSE) {
    $output = '<label class="control-label" for="' . $name . '">' . !empty($option['label']) ? $option['label'] : ucwords($name) . '</label>';
  }
  return $output;
}

/**
 * 
 * @param string $name
 * @return string
 */
function bootstrap_form_error($name = NULL) {
  return form_error($name, '<span class="label label-important">', 'Important</span>');
}

/**
 * 
 * @param array $option
 * @return string
 */
function form_attribute($option = array()) {
  $output = '';
  if (isset($option['label'])) {
    unset($option['label']);
  }
  foreach ($option as $key => $val) {
    $output .= $key . '="' . $val . '" ';
  }
  return $output;
}

/**
 * 
 * @return string
 */
function div_close() {
  return '</div>';
}

/**
 * 
 * @param string $name
 * @param array $option
 * @return string
 */
function bootstrap_before($name = NULL, $option = array()) {
  $output = bootstrap_control_group();
  $output .= bootstrap_control_label($name, $option);
  $output .= bootstrap_controls();
  return $option;
}

/**
 * 
 * @return string
 */
function bootstrap_after() {
  $output = div_close();
  $output .= div_close();
  return $output;
}

/**
 * 
 * @param string $type
 * @param string $name
 * @param string/array $value
 * @param array $option
 * @return string
 */
function bootstrap_build($type = NULL, $name = NULL, $value = NULL, $option = array()) {
  $form_helper_output = '';
  
  /**
   * 
   */
  $checked = FALSE;
  if (isset($option['checked']) && $option['checked']) {
    $checked = TRUE;
    unset($option['checked']);
  }
  
  /**
   * 
   */
  $list = array();
  if (isset($option['list']) && !empty($option['list'])) {
    $checked = $option['list'];
    unset($option['list']);
  }
  switch ($type) {
    case 'input':
      $form_helper_output = form_input($name, set_value($name, $value), form_attribute($option));
      break;
    case 'password':
      $form_helper_output = form_password($name, set_value($name, $value), form_attribute($option));
      break;
    case 'hidden':
      $form_helper_output = form_hidden($name, set_value($name, $value), form_attribute($option));
      break;
    case 'textarea':
      $form_helper_output = form_textarea($name, set_value($name, $value), form_attribute($option));
      break;
    case 'checkbox':
      $form_helper_output = form_checkbox($name, set_value($name, $value), $checked, form_attribute($option));
      break;
    case 'radio':
      $form_helper_output = form_radio($name, set_value($name, $value), $checked, form_attribute($option));
      break;
    case 'dropdown':
      $form_helper_output = form_dropdown($name, $list, $value, form_attribute($option));
      break;
    case 'multiselect':
      $form_helper_output = form_multiselect($name, $list, $value, form_attribute($option));
      break;
    case 'button':
      $form_helper_output = form_button($name, $value, form_attribute($option));
      break;
    case 'reset':
      $form_helper_output = form_reset($name, $value, form_attribute($option));
      break;
    case 'submit':
      $form_helper_output = form_submit($name, $value, form_attribute($option));
      break;
    case 'upload':
      $form_helper_output = form_upload($name, $value, form_attribute($option));
      break;
  }
  $output = bootstrap_before($name, $option);
  $output .= $form_helper_output;
  $output .= bootstrap_after();
  return $output;
}

/**
 * 
 * @param string $name
 * @param string $value
 * @param array $option
 * @return string
 */
function bootstrap_input($name = NULL, $value = NULL, $option = array()) {
  return bootstrap_build('input', $name, $value, $option);
}

/**
 * 
 * @param string $name
 * @param string $value
 * @param array $option
 * @return string
 */
function bootstrap_password($name = NULL, $value = NULL, $option = array()) {
  return bootstrap_build('password', $name, $value, $option);
}

/**
 * 
 * @param string $name
 * @param string $value
 * @param array $option
 * @return string
 */
function bootstrap_hidden($name = NULL, $value = NULL, $option = array()) {
  return bootstrap_build('hidden', $name, $value, $option);
}

/**
 * 
 * @param string $name
 * @param string $value
 * @param array $option
 * @return string
 */
function bootstrap_textarea($name = NULL, $value = NULL, $option = array()) {
  return bootstrap_build('textarea', $name, $value, $option);
}

/**
 * 
 * @param string $name
 * @param string $value
 * @param array $option
 * @return string
 */
function bootstrap_checkbox($name = NULL, $value = NULL, $option = array()) {
  return bootstrap_build('checkbox', $name, $value, $option);
}

/**
 * 
 * @param string $name
 * @param string $value
 * @param array $option
 * @return string
 */
function bootstrap_radio($name = NULL, $value = NULL, $option = array()) {
  return bootstrap_build('checkbox', $name, $value, $option);
}

/**
 * 
 * @param string $name
 * @param array $value
 * @param array $option
 * @return string
 */
function bootstrap_dropdown($name = NULL, $value = array(), $option = array()) {
  return bootstrap_build('dropdown', $name, $value, $option);
}

/**
 * 
 * @param string $name
 * @param array $value
 * @param array $option
 * @return string
 */
function bootstrap_multiselect($name = NULL, $value = array(), $option = array()) {
  return bootstrap_build('multiselect', $name, $value, $option);
}

/**
 * 
 * @param string $name
 * @param string $value
 * @param array $option
 * @return string
 */
function bootstrap_button($name = NULL, $value = NULL, $option = array()) {
  return bootstrap_build('button', $name, $value, $option);
}

/**
 * 
 * @param string $name
 * @param string $value
 * @param array $option
 * @return string
 */
function bootstrap_reset($name = NULL, $value = NULL, $option = array()) {
  return bootstrap_build('reset', $name, $value, $option);
}

/**
 * 
 * @param string $name
 * @param string $value
 * @param array $option
 * @return string
 */
function bootstrap_submit($name = NULL, $value = NULL, $option = array()) {
  return bootstrap_build('submit', $name, $value, $option);
}

/**
 * 
 * @param string $name
 * @param string $value
 * @param array $option
 * @return string
 */
function bootstrap_upload($name = NULL, $value = NULL, $option = array()) {
  return bootstrap_build('upload', $name, $value, $option);
}

?>
