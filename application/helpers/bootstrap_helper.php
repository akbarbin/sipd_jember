<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/* ================================================================================================ */
/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 * 
 * Herper to general tag html
 */

/**
 * 
 * @param array $option
 * @return string
 */
function bootstrap_attribute($attribute = array()) {
  $output = '';
  foreach ($attribute as $key => $val) {
    $output .= $key . '="' . $val . '" ';
  }
  return $output;
}

/**
 * 
 * @param string $tag_open
 * @param array $attribute
 * @return string
 */
function bootstrap_tag_open($tag_open = NULL, $attribute = array()) {
  return '<' . $tag_open . ' ' . bootstrap_attribute($attribute) . '>';
}

/**
 * 
 * @return string
 */
function bootstrap_tag_close($tag_close = NULL) {
  return '</' . $tag_close . '>';
}

function bootstrap_tag($tag = NULL, $value = NULL, $attribute = array()) {
  $output = bootstrap_tag_open($tag, $attribute);
  $output .= $value;
  $output .= bootstrap_tag_close($tag);
  return $output;
}

/* ================================================================================================ */

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 * 
 * Herper to create jquery
 */
function bootstrap_jquery_document_ready($action = NULL) {
  return '$(document).ready(function() {' . $action . '});';
}

/* ================================================================================================ */
/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 * 
 * Herper to create form which use bootstrap css
 */

/**
 * 
 * @return string
 */
function bootstrap_form_control_group() {
  return '<div class="control-group">';
}

/**
 * 
 * @return string
 */
function bootstrap_form_controls() {
  return '<div class="controls">';
}

/**
 * 
 * @param string $name
 * @param array $option
 * @return string
 */
function bootstrap_form_control_label($name = NULL, $option = array()) {
  $output = '';
  if (isset($option['label']) && $option['label'] != FALSE) {
    $label = !empty($option['label']) ? $option['label'] : ucwords($name);
    $output = '<label class="control-label" for="' . $name . '">' . $label . '</label>';
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
 * @param string $name
 * @param array $option
 * @return string
 */
function bootstrap_form_before($name = NULL, $option = array()) {
  $output = bootstrap_form_control_group();
  $output .= bootstrap_form_control_label($name, $option);
  $output .= bootstrap_form_controls();
  return $output;
}

/**
 * 
 * @return string
 */
function bootstrap_form_after() {
  $output = bootstrap_tag_close('div');
  $output .= bootstrap_tag_close('div');
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
function bootstrap_form_build($type = NULL, $name = NULL, $value = NULL, $option = array()) {
  $form_helper_output = '';

  /**
   * @todo Make standarization
   * checked
   */
  $checked = FALSE;
  if (isset($option['checked']) && $option['checked']) {
    $checked = TRUE;
    unset($option['checked']);
  }

  /**
   * @todo Make standarization
   * option list
   */
  $list = array();
  if (isset($option['list']) && !empty($option['list'])) {
    $checked = $option['list'];
    unset($option['list']);
  }

  /**
   * @todo Make standarization
   * before value
   */
  $before = '';
  if (isset($option['before'])) {
    $after = $option['before'];
    unset($option['before']);
  }

  /**
   * @todo Make standarization
   * after value
   */
  $after = '';
  if (isset($option['after'])) {
    $after = $option['after'];
    unset($option['after']);
  }

  /**
   * @todo Make standarization
   * label
   */
  $attribute = $option;
  if (isset($attribute['label'])) {
    unset($attribute['label']);
  }

  switch ($type) {
    case 'input':
      $form_helper_output = form_input($name, set_value($name, $value), bootstrap_attribute($attribute));
      break;
    case 'password':
      $form_helper_output = form_password($name, set_value($name, $value), bootstrap_attribute($attribute));
      break;
    case 'hidden':
      $form_helper_output = form_hidden($name, set_value($name, $value), bootstrap_attribute($attribute));
      break;
    case 'textarea':
      $form_helper_output = form_textarea($name, set_value($name, $value), bootstrap_attribute($attribute));
      break;
    case 'checkbox':
      $form_helper_output = form_checkbox($name, set_value($name, $value), $checked, bootstrap_attribute($attribute));
      break;
    case 'radio':
      $form_helper_output = form_radio($name, set_value($name, $value), $checked, bootstrap_attribute($attribute));
      break;
    case 'dropdown':
      $form_helper_output = form_dropdown($name, $list, $value, bootstrap_attribute($attribute));
      break;
    case 'multiselect':
      $form_helper_output = form_multiselect($name, $list, $value, bootstrap_attribute($attribute));
      break;
    case 'button':
      $form_helper_output = form_button($name, $value, bootstrap_attribute($attribute));
      break;
    case 'reset':
      $form_helper_output = form_reset($name, $value, bootstrap_attribute($attribute));
      break;
    case 'submit':
      $form_helper_output = form_submit($name, $value, bootstrap_attribute($attribute));
      break;
    case 'upload':
      $form_helper_output = form_upload($name, $value, bootstrap_attribute($attribute));
      break;
  }
  $output = bootstrap_form_before($name, $option);
  $output .= $before;
  $output .= $form_helper_output;
  $output .= $after;
  $output .= bootstrap_form_after();
  return $output;
}

/**
 * 
 * @param string $name
 * @param string $value
 * @param array $option
 * @return string
 */
function bootstrap_form_input($name = NULL, $value = NULL, $option = array()) {
  return bootstrap_form_build('input', $name, $value, $option);
}

/**
 * 
 * @param string $name
 * @param string $value
 * @param array $option
 * @return string
 */
function bootstrap_form_password($name = NULL, $value = NULL, $option = array()) {
  return bootstrap_form_build('password', $name, $value, $option);
}

/**
 * 
 * @param string $name
 * @param string $value
 * @param array $option
 * @return string
 */
function bootstrap_form_hidden($name = NULL, $value = NULL, $option = array()) {
  return bootstrap_form_build('hidden', $name, $value, $option);
}

/**
 * 
 * @param string $name
 * @param string $value
 * @param array $option
 * @return string
 */
function bootstrap_form_textarea($name = NULL, $value = NULL, $option = array()) {
  return bootstrap_form_build('textarea', $name, $value, $option);
}

/**
 * 
 * @param string $name
 * @param string $value
 * @param array $option
 * @return string
 */
function bootstrap_form_checkbox($name = NULL, $value = NULL, $option = array()) {
  return bootstrap_form_build('checkbox', $name, $value, $option);
}

/**
 * 
 * @param string $name
 * @param string $value
 * @param array $option
 * @return string
 */
function bootstrap_form_radio($name = NULL, $value = NULL, $option = array()) {
  return bootstrap_form_build('checkbox', $name, $value, $option);
}

/**
 * 
 * @param string $name
 * @param array $value
 * @param array $option
 * @return string
 */
function bootstrap_form_dropdown($name = NULL, $value = array(), $option = array()) {
  return bootstrap_form_build('dropdown', $name, $value, $option);
}

/**
 * 
 * @param string $name
 * @param array $value
 * @param array $option
 * @return string
 */
function bootstrap_form_multiselect($name = NULL, $value = array(), $option = array()) {
  return bootstrap_form_build('multiselect', $name, $value, $option);
}

/**
 * 
 * @param string $name
 * @param string $value
 * @param array $option
 * @return string
 */
function bootstrap_form_button($name = NULL, $value = NULL, $option = array()) {
  return bootstrap_form_build('button', $name, $value, $option);
}

/**
 * 
 * @param string $name
 * @param string $value
 * @param array $option
 * @return string
 */
function bootstrap_form_reset($name = NULL, $value = NULL, $option = array()) {
  return bootstrap_form_build('reset', $name, $value, $option);
}

/**
 * 
 * @param string $name
 * @param string $value
 * @param array $option
 * @return string
 */
function bootstrap_form_submit($name = NULL, $value = NULL, $option = array()) {
  return bootstrap_form_build('submit', $name, $value, $option);
}

/**
 * 
 * @param string $name
 * @param string $value
 * @param array $option
 * @return string
 */
function bootstrap_form_upload($name = NULL, $value = NULL, $option = array()) {
  return bootstrap_form_build('upload', $name, $value, $option);
}

/* ================================================================================================ */

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 * 
 * Herper to create Error Message
 */
function bootstrap_alert_class($type) {
  $message = array(
      'warning' => array(
          'class' => 'alert',
          'message' => 'Warning!'),
      'success' => array(
          'class' => 'alert alert-success',
          'message' => 'Success!'),
      'error' => array(
          'class' => 'alert alert-error',
          'message' => 'Error!'),
      'info' => array(
          'class' => 'alert alert-info',
          'message' => 'Info!')
  );
  return $message[$type];
}

function bootstrap_alert_before($position = NULL, $uid = NULL) {
  $output = '<div id="error-message-' . $uid . '" style="display: none;">';
  $output .= '<div class="container-fluid">';
  switch ($position) {
    case 'center':
      $output .= '<div class="span3"></div><div class="span6">';
      break;
    case 'right':
      $output .= '<div class="span6 pull-right">';
      break;
    case 'left':
      $output .= '<div class="span6 pull-left">';
      break;
  }
  return $output;
}

function bootstrap_alert_after($uid = NULL) {
  $output = bootstrap_tag_close('div');
  $output .= bootstrap_tag_close('div');
  $output .= bootstrap_tag_close('div');
  $output .= bootstrap_tag_close('div');
  $output .= bootstrap_tag_open('script', array('type' => 'text/javascript'));
  $output .= bootstrap_jquery_document_ready('$("#error-message-' . $uid . '").slideDown(800).delay(8000).slideUp(800)');
  $output .= bootstrap_tag_close('script');
  return $output;
}

function bootstrap_alert($message = array(), $position = 'center', $alert_message = TRUE) {
  $output = '';
  if (!empty($message)) {
    $uid = rand(0, 1000);
    $alert = bootstrap_alert_class($message['alert']);
    $output = bootstrap_alert_before($position, $uid);
    $output .= '<div class="' . $alert['class'] . '">';
    $output .= '<button type="button" class="close" data-dismiss="alert">&times;</button>';
    $output .= ($alert_message) ? '<strong>' . $alert['message'] . '</strong> ' : '';
    $output .= $message['message'];
    $output .= bootstrap_alert_after($uid);
  }
  return $output;
}

/* ================================================================================================ */

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 * 
 * Herper to create breadcrumb
 */
function bootstrap_breadcrumb_name($subject = NULL, $search = '_', $replace = ' ') {
  return ucwords(str_replace($search, $replace, $subject));
}

function bootstrap_breadcrumb($controller = NULL, $action = NULL) {
  $output = bootstrap_tag_open('ul', array('class' => 'breadcrumb'));
  $output .= bootstrap_tag('li', bootstrap_tag('a', bootstrap_breadcrumb_name($controller), array('href' => base_url() . 'admin/' . $controller . '/index')) . ' ' . bootstrap_tag('span', '/', array('class' => 'divider')));
  $output .= bootstrap_tag('li', bootstrap_tag('a', bootstrap_breadcrumb_name($action), array('href' => base_url() . 'admin/' . $controller . '/' . $action)));
  $output .= bootstrap_tag_close('ul');
  return $output;
}

?>
