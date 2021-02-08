<?php

/**
 * Plugin Name: WP-Stateless - The Event Calendar Addon
 * Plugin URI: https://github.com/Agilicus/wp-stateless-the-event-calendar
 * Description: Ensures compatibility with The Event Calendar. Skip .svg
 * Author: Agilicus Devs <dev@agilicus.com>
 * Version: 0.0.1
 * Text Domain: wpslea
 * Author URI: https://www.agilicus.com
 * License: MIT
 *
 * Copyright 2021 Agilicus Incorporated (email: dev@agilicus.com)
 */

namespace WPSL\TheEventCalendar;

add_action('plugins_loaded', function () {
  if (class_exists('wpCloud\StatelessMedia\Compatibility')) {
    require_once 'vendor/autoload.php';
    // Load
    return new TheEventCalendar();
  }

  add_filter('plugin_row_meta', function ($plugin_meta, $plugin_file, $_, $__) {
    if ($plugin_file !== join(DIRECTORY_SEPARATOR, [basename(__DIR__), basename(__FILE__)])) return $plugin_meta;
    $plugin_meta[] = sprintf('<span style="color:red;">%s</span>', __('This plugin requires WP-Stateless plugin to be installed and active.'));
    return $plugin_meta;
  }, 10, 4);
});
