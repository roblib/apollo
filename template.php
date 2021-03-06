<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 */

/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
function apollo_preprocess_maintenance_page(&$variables, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  apollo_preprocess_html($variables, $hook);
  apollo_preprocess_page($variables, $hook);
}
*/

/**
 * Override or insert variables into the region page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
function apollo_process_region(&$variables) {

  if (theme_get_setting('apollo_logo_path')) {
    $variables['apollo_logo_path'] = l($variables['logo_img'], theme_get_setting('apollo_logo_path'),
      array('attributes' => array(
        'rel' => 'ext',
        'title' => theme_get_setting('apollo_logo_title') ? check_plain(theme_get_setting('apollo_logo_title')) : check_plain($variables['site_name'])),
      'html' => TRUE));
  } else {
    $variables['apollo_logo_path'] = l($variables['logo_img'], '<front>',
    array(
      'attributes' => array(
        'rel' => 'home',
        'title' => check_plain($variables['site_name'])),
      'html' => TRUE));
  }

  if (theme_get_setting('apollo_slogan_path')) {
    $variables['site_slogan'] = l($variables['site_slogan'], theme_get_setting('apollo_slogan_path'),
      array('attributes' => array(
        'rel' => 'ext',
        'title' => theme_get_setting('apollo_slogan_title') ? check_plain(theme_get_setting('apollo_slogan_title')) : check_plain($variables['site_name'])),
      'html' => TRUE));
  } else {
    $variables['apollo_slogan_path'] = $variables['site_slogan'];
  }

  $variables['linked_logo_img'] = $variables['logo'] ? $variables['apollo_logo_path'] : '';
}

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
function apollo_preprocess_html(&$variables, $hook) {
  global $theme_key;

  if ((theme_get_setting('apollo_main_menu')) && (theme_get_setting('toggle_main_menu'))) {
    if (module_exists('roblib_responsive_menu')) {
      drupal_add_js(drupal_get_path('module', 'roblib_responsive_menu') .'/js/jquery.mobilemenu.js',
        array(
          'scope' => 'footer',
          'weight' => 6
          )
        );
    } else {
      drupal_add_js(drupal_get_path('theme', $theme_key) .'/js/jquery.mobilemenu.js',
        array(
          'scope' => 'footer',
          'weight' => 6
          )
        );
    }

    drupal_add_js('jQuery(function(){jQuery(\'#primary\').mobileMenu({menuID:999,combine:false,prependTo:\'div.main-menu-inner\'}); });',
          array(
            'type' => 'inline',
            'scope' => 'footer',
            'weight' => 7
            )
          );
    // Then load the media queries.
    drupal_add_css(drupal_get_path('theme', $theme_key) . '/css/menu/apollo-responsive-select-menu-mq.css',
      array(
        'group' => CSS_THEME,
        'every_page' => FALSE,
        'media' => 'screen and (max-width: ' . theme_get_setting('apollo_resp_main_menu_width') . ')',
        'preprocess' => FALSE,
        'weight' => '0',
      )
    );
    drupal_add_css(drupal_get_path('theme', $theme_key) . '/css/menu/apollo-responsive-select-menu.css',
      array(
        'group' => CSS_THEME,
        'preprocess' => TRUE,
        'every_page' => TRUE,
        'weight' => '1',
      )
    );
  }

  // The body tag's classes are controlled by the $classes_array variable. To
  // remove a class from $classes_array, use array_diff().
}


/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
/* -- Delete this line if you want to use this function
function apollo_preprocess_page(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}


/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function apollo_preprocess_node(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // apollo_preprocess_node_page() or apollo_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}
*/

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function apollo_preprocess_comment(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
*/

/**
 * Override or insert variables into the region templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
/* -- Delete this line if you want to use this function
function apollo_preprocess_region(&$variables, $hook) {
}
*/

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function apollo_preprocess_block(&$variables, $hook) {
  // Add a count to all the blocks in the region.
  // $variables['classes_array'][] = 'count-' . $variables['block_id'];

  // By default, aether will use the block--no-wrapper.tpl.php for the main
  // content. This optional bit of code undoes that:
}
*/
