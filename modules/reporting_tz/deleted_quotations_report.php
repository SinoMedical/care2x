<?php
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
error_reporting($ErrorLevel);

$lang_tables[]='date_time.php';
$lang_tables[]='reporting.php';
require($root_path.'include/core/inc_front_chain_lang.php');
#Load and create paginator object
require_once($root_path.'include/care_api_classes/class_tz_reporting.php');
/**
 * getting summary of OPD...
 */
$rep_obj = new selianreport();

require_once($root_path.'include/care_api_classes/class_tz_billing.php');

$bill_obj=new Bill;

require_once('include/core/inc_timeframe.php');
/**
 * Getting the timeframe...
 */
 $debug=FALSE;
 $PRINTOUT=FALSE;
if (empty($_GET['printout'])) {
	if (empty($_POST['month']) && empty($_POST['year']) && empty($_POST['pricelist_no'])) {
			if ($debug) echo "no time value is set, we're using now the current month<br>";
			$month=date("n",time());
			$year=date("Y",time());
			$start_timeframe = mktime (0,0,0,$month, 1, $year);
			$end_timeframe = mktime (0,0,0,$month+1, 0, $year); // Last day of requested month
			$pricelist=1;

		} else { // month and year are given...
			if ($debug) echo "Getting an new time range...<br>";
			$start_timeframe = mktime (0,0,0,$_POST['month'], 1, $_POST['year']);
			$end_timeframe = mktime (0,0,0,$_POST['month']+1, 0, $_POST['year']);
			$pricelist = $_POST['pricelist_no'];

	} // end of if (empty($_POST['month']) && empty($_POST['year']))
} else {
	$PRINTOUT=TRUE;
} // end of if (empty($_GET['printout']))

require_once('gui/gui_deleted_quotations.php');
?>
