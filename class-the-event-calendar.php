<?php

namespace WPSL\TheEventCalendar;

use wpCloud\StatelessMedia\Compatibility;
use wpCloud\StatelessMedia\Utility;

/**
 * @todo make testable and test
 */
class TheEventCalendar extends Compatibility {
  protected $id = 'theeventcalendar';
  protected $title = 'TheEventCalendar';
  protected $constant = 'WP_STATELESS_COMPATIBILITY_THEEVENTCALENDAR';
  protected $description = 'Ensures compatibility with TheEventCalendar.';
  protected $plugin_file = [ 'the-events-calendar/the-events-calendar.php' ];
  protected $sm_mode_not_supported = [ 'stateless' ];

  /**
   * @param $sm
   */
  public function module_init( $sm ) {
    add_filter( 'stateless_skip_cache_busting', array( $this, 'skip_cache_busting' ), 10, 2 );
  }

    /**
     * skip cache busting for template file name.
     * @param $return
     * @param $filename
     * @return mixed
     */

  public function skip_cache_busting( $return, $filename ) {
    $info = pathinfo( $filename );
    $backtrace = debug_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS, 8 );
    /* /wp-content/plugins/the-events-calendar/common/src/modules/icons/link.svg */
    if( empty( $info[ 'extension' ] ) && strpos( $backtrace[ 6 ][ 'file' ], '/the-events-calendar/' ) !== false ) {
      return $filename;
    }
    return $return;
  }
}
