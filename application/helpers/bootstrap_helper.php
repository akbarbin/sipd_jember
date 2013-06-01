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

function bootstrap_index_page() {
  $index = index_page();
  return (!empty($index)) ? $index . '/' : '';
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
  return form_error($name, '<br/><span class="label label-important">', '</span>');
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
    $list = $option['list'];
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
  $output .= bootstrap_form_error($name);
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
  $output .= bootstrap_tag('li', bootstrap_tag('a', '<i class="icon-home"></i> SIPD Jember', array('href' => base_url() . bootstrap_index_page() . 'admin/dashboard/index')) . ' ' . bootstrap_tag('span', '/', array('class' => 'divider')));
  if ($action != 'index') {
    $output .= bootstrap_tag('li', bootstrap_tag('a', bootstrap_breadcrumb_name($controller), array('href' => base_url() . bootstrap_index_page() . 'admin/' . $controller . '/index')) . ' ' . bootstrap_tag('span', '/', array('class' => 'divider')));
    $output .= bootstrap_tag('li', bootstrap_breadcrumb_name($action), array('class' => 'active'));
  } else {
    $output .= bootstrap_tag('li', bootstrap_breadcrumb_name($controller), array('class' => 'active'));
  }
  $output .= bootstrap_tag_close('ul');
  return $output;
}

function bootstrap_table_tr($data = array(), $option = NULL) {
  $output = bootstrap_tag_open('tr');
  foreach ($data as $key => $value) {
    $output .= bootstrap_tag($option, $value);
  }
  $output .= bootstrap_tag_close('tr');
  return $output;
}

function bootstrap_table_head($data = array()) {
  $output = bootstrap_tag_open('thead');
  $output .= bootstrap_table_tr($data, 'th');
  $output .= bootstrap_tag_close('thead');
  return $output;
}

function bootstrap_table_body($data = array()) {
  $output = bootstrap_tag_open('tbody');
  foreach ($data as $key => $value) {
    $output .= bootstrap_table_tr($value, 'td');
  }
  $output .= bootstrap_tag_close('tbody');
  return $output;
}

function bootstrap_table_view($data) {
  $output = bootstrap_tag_open('table', array('class' => 'table bg-white'));
  foreach ($data as $row) {
    $output .= bootstrap_tag('tr', bootstrap_tag('th', $row[0], array('width' => '20%')) . bootstrap_tag('td', ': ' . $row[1]));
  }
  $output .= bootstrap_tag_close('table');
  return $output;
}

function bootstrap_table_nav_dropdown($title = NULL, $controller = NULL, $actions = array(), $dir = 'admin') {
  $icon_action = array(
      'add' => 'icon-plus-sign',
      'refresh' => 'icon-refresh',
      'generate' => 'icon-circle-arrow-down',
      'export-excel' => 'icon-file',
      'export-pdf' => 'icon-file',
      'import-excel' => 'icon-circle-arrow-up',
      'search' => 'icon-search'
  );

  $search = '';
  if (isset($actions['search'])) {
    $search .= bootstrap_tag_open('form', array('class' => 'navbar-form pull-right', 'method' => 'get', 'action' => base_url() . bootstrap_index_page() . $dir . '/' . $controller . '/' . $actions['search']['action']));
    $search .= form_input('search', NULL, 'placeholder="Masukkan Kata Kunci"');
    $search .= bootstrap_tag('button', bootstrap_tag('i', '', array('class' => $icon_action['search'] . ' icon-white')) . ' ' . $actions['search']['name'], array('class' => 'btn btn-primary'));
    $search .= bootstrap_tag_close('form');
    unset($actions['search']);
  }

  $output = bootstrap_tag_open('div', array('class' => 'navbar navbar-inverse'));
  $output .= bootstrap_tag_open('div', array('class' => 'navbar-inner'));
  $output .= bootstrap_tag_open('div', array('class' => 'container'));
  $output .= bootstrap_tag_open('a', array('class' => 'btn btn-navbar', 'data-toggle' => 'collapse', 'data-target' => '.nav-collapse'));
  $output .= bootstrap_tag('span', NULL, array('class' => 'icon-bar'));
  $output .= bootstrap_tag('span', NULL, array('class' => 'icon-bar'));
  $output .= bootstrap_tag('span', NULL, array('class' => 'icon-bar'));
  $output .= bootstrap_tag_close('a');
  $output .= bootstrap_tag('a', $title, array('class' => 'brand'));
  $output .= bootstrap_tag_open('div', array('class' => 'nav-collapse'));
  $output .= bootstrap_tag_open('ul', array('class' => 'nav'));
  $output .= bootstrap_tag_open('li', array('class' => 'dropdown'));
  $output .= bootstrap_tag('a', bootstrap_tag('i', '', array('class' => 'icon-tasks icon-white')) . ' Task ' . bootstrap_tag('b', NULL, array('class' => 'caret')), array('data-toggle' => 'dropdown', 'class' => 'dropdown-toggle', 'href' => '#'));
  $output .= bootstrap_tag_open('ul', array('class' => 'dropdown-menu'));
  foreach ($actions as $key => $value) {
    $output .= bootstrap_tag('li', bootstrap_tag('a', bootstrap_tag('i', '', array('class' => $icon_action[$key])) . ' ' . $value['name'], array('href' => base_url() . bootstrap_index_page() . $dir . '/' . $controller . '/' . $value['action'])));
  }
  $output .= bootstrap_tag_close('ul');
  $output .= bootstrap_tag_close('li');
  $output .= bootstrap_tag_close('ul');
  $output .= $search;
  $output .= bootstrap_tag_close('div');
  $output .= bootstrap_tag_close('div');
  $output .= bootstrap_tag_close('div');
  $output .= bootstrap_tag_close('div');
  return $output;
}

function bootstrap_table_action_dropdown($controller = NULL, $actions = array(), $dir = 'admin') {
  $icon_action = array(
      'view' => 'icon-align-justify',
      'add' => 'icon-plus-sign',
      'edit' => 'icon-pencil',
      'delete' => 'icon-trash'
  );
  $output = bootstrap_tag_open('div', array('class' => 'btn-group'));
  if (isset($actions['view'])) {
    $output .= bootstrap_tag('a', bootstrap_tag('i', '', array('class' => $icon_action['view'] . ' icon-white')) . ' ' . $actions['view']['name'], array('class' => 'btn btn-primary', 'href' => base_url() . bootstrap_index_page() . $dir . '/' . $controller . '/' . $actions['view']['action']));
    unset($actions['view']);
  }elseif (isset ($actions['add'])) {
    $output .= bootstrap_tag('a', bootstrap_tag('i', '', array('class' => $icon_action['add'] . ' icon-white')) . ' ' . $actions['add']['name'], array('class' => 'btn btn-primary', 'href' => base_url() . bootstrap_index_page() . $dir . '/' . $controller . '/' . $actions['add']['action']));
    unset($actions['add']);
  }
  $output .= bootstrap_tag('a', bootstrap_tag('span', '', array('class' => 'caret')), array('class' => 'btn btn-primary dropdown-toggle', 'href' => '#', 'data-toggle' => 'dropdown'));
  $output .= bootstrap_tag_open('ul', array('class' => 'dropdown-menu'));
  foreach ($actions as $key => $value) {
    $output .= bootstrap_tag('li', bootstrap_tag('a', bootstrap_tag('i', '', array('class' => $icon_action[$key])) . ' ' . $value['name'], array('href' => base_url() . bootstrap_index_page() . $dir . '/' . $controller . '/' . $value['action'])));
  }
  $output .= bootstrap_tag_close('ul');
  $output .= bootstrap_tag_close('div');
  return $output;
}


function bootstrap_table_title($title = NULL) {
  $output = bootstrap_tag_open('div', array('class' => 'navbar navbar-inverse'));
  $output .= bootstrap_tag_open('div', array('class' => 'navbar-inner'));
  $output .= bootstrap_tag_open('div', array('class' => 'container'));
  $output .= bootstrap_tag('a', $title, array('class' => 'brand'));
  $output .= bootstrap_tag_close('div');
  $output .= bootstrap_tag_close('div');
  $output .= bootstrap_tag_close('div');
  return $output;
}

function bootstrap_control_group($name = NULL, $value = NULL, $option = NULL, $before = NULL, $after = NULL) {
  $output = bootstrap_form_before($name, $option);
  $output .= $before . $value . $after;
  $output .= bootstrap_form_after();
  return $output;
}

function bootstrap_text_important($string = ' *') {
  return bootstrap_tag('span', $string, array('class' => 'text-error'));
}

?>
