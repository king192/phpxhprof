<?php
namespace king192\phpxhprof;

class xhprof {
	public static function test() {
		echo 'test';
	}

	public static function enable(){
		// start profiling
		\xhprof_enable();
	}

	 public static function disable(){
 
		// stop profiler
		$xhprof_data = \xhprof_disable();

		//
		// Saving the XHProf run
		// using the default implementation of iXHProfRuns.
		//
		$XHPROF_ROOT = __DIR__;
		include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_lib.php";
		include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_runs.php";

		$xhprof_runs = new \XHProfRuns_Default();

		// Save the run under a namespace "xhprof_foo".
		//
		// **NOTE**:
		// By default save_run() will automatically generate a unique
		// run id for you. [You can override that behavior by passing
		// a run id (optional arg) to the save_run() method instead.]
		//
		$run_id = $xhprof_runs->save_run($xhprof_data, "xhprof_foo");
		$protocal = self::is_https() ? 'https://' : 'http://';
		$link = $protocal . $_SERVER['HTTP_HOST'] . "/vendor/king192/phpxhprof/src/xhprof_html/index.php?run=$run_id&source=xhprof_foo";
		// echo "---------------\n".
		// "Assuming you have set up the http based UI for \n".
		// "XHProf at some address, you can view run at \n".
		// "<a href='" . $link . "' target='_blank'>" . $link . "</a>\n".
		// "---------------\n";
		return $link;
	}

	public static function is_https() {
    if ( !empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
        return true;
    } elseif ( isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
        return true;
    } elseif ( !empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
        return true;
    }
    return false;
}
}