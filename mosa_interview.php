<?php
	error_reporting(0);
	session_start();
	ob_start();
	require('inc/class.phpmailer.php');
	require('inc/fieldmap.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
	<HEAD>
		<TITLE> MOSA&trade; Lite </TITLE>
		<link rel="stylesheet" href="style.css" media="screen">
		<script type="text/javascript" src="/jQuery/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="/jQuery/jquery-ui-1.8.2.custom.min.js"></script>
		<link rel="stylesheet" href="/jQuery/css/black-tie/jquery-ui-1.8.2.custom.css" media="screen">
	</HEAD>
	<BODY>
   <?php include 'inc/header.html'; ?>
   <div id='main'>
		<div id='interior'>
   <?php
   // The first Item in each array can be set to a Title/Heading for that page
    $interviewPages = array( 
		 1 => array('','page_1.php')
		, 2 => array('','page_2.php')
		, 3 => array('','page_3.php')
		, 4 => array('','page_4.php')
		, 5 => array('', 'page_5.php')
		, 6 => array('', 'page_6.php')
		, 7 => array('','page_7.php')
		, 8 => array('','page_8.php')
		, 9 => array('', 'page_9.php')
		, 10 => array('', 'page_10.php')
		, 11 => array('', 'page_11.php')
		, 12 => array('', 'page_12.php')
		, 13 => array('', 'page_13.php')
		, 14 => array('', 'page_14.php')
		, 15 => array('', 'page_15.php')
		, 16 => array('','page_16.php')
		, 17 => array('','page_17.php')
		, 18 => array('','page_18.php')
		, 19 => array('','page_19.php')
		, 20 => array('','score_page.php'));

// [companyid] and [auditid] are different so they don't pull in form values automatically
// the initial array element is the Page Number, 
//   the array inside that has the updates needed for that page

/*
  update t590_audit set 
   TVS1="#ts1#"
  ,TVS1P1="#ts2#"
  ,TVS1P2="#ts3#"
  ,TVS2="#ts4#"
  ,TVS2P1="#ts5#"
  ,TVS2P2="#ts6#"
  ,TVS3="#ts7#"
  ,TVS3P1="#ts8#"
  ,TVS3P2="#ts9#"
  ,TVS4="#ts10#"
  ,TVS4P1="#ts11#"
  ,TVS4P2="#ts12#"
  ,TVS5="#ts13#"
  ,TVS5P1="#ts14#"
  ,TVS5P2="#ts15#"
   where audit_id=[] and company_id=[];

  update RALI_Audit set 
  States="'+RALI_StatesBox.GetStates+'" 
  where audit_id=[] and company_id=[];
  */
    // Prevent Session Injection for case of register_globals = off
	if (isset($_REQUEST['_SESSION'])) die("Get lost Muppet!"); 
	require('inc/settings.php');
	require('inc/functions.php');
	$db = connectDB('ml_design');
	$company_id = $_SESSION['company_id'];
	$totalPages = count($interviewPages);
	if (isset($_POST['startover'])) {
		$_SESSION['page'] = 1;
	}
	// POC on forcing the correct page to serve for multipage test
	$aid = isCompanyAudit($company_id, $db);
	//Force Page for testing
	//$_SESSION['page'] = 3;

	// Putting this here for debugging:
	if (array_key_exists('c', $_GET)) {
			try {
				$c = base64_decode($_GET['c']);
			} catch (Exception $ex) {
				// Not an encoded command, ignore it.
				$c = '';
			}
			echo('<!-- c: ' . $c . ' -->');
			if ($c == 'reload') {
				// Trigger the retrieval of values from the DB for the given page:
				$blnLoadValues = true;
			}
		}

	if (!isset($_SESSION['page'])) {	// if we don't have a session page then this is a jumpin, 
										// but let's verify it needs loaded
		$page = getCompanyAuditPage($aid, $db);
		if ($page == 0) {
			$page = 1;
		}
		$_SESSION['page'] = $page;
		$blnLoadValues = false;
		// This is where the Page check and load should go:

	} else {
		if (isset($_POST['exit'])) {
			$blnExit = true;
			echo('<!--  Exit -->');
		} else {
			$blnExit = false;
		}
		if ((isset($_POST['submit'])) || ($blnExit)) {
			if ($_POST['page'] == $_SESSION['page']) {
				// Write Answers to DB here
				$currentPage = $_POST['page'];
				$updates = createUpdateFromForm($currentPage, $aid);
				foreach ($updates as $updateSQL) {
					//echo($updateSQL . '<br/>');
					
					if (mysql_query($updateSQL, $db)) {
						//	echo('Success<br/>');
					} else {
						reportError('mosa_interview:1', mysql_error($db));
					}
				}
				
				if (!$blnExit) { // Don't increment the page if we're going to exit.
					$_SESSION['page'] ++;
					while (doPage($_SESSION['page'], $aid, $db) == false) {
						$_SESSION['page'] ++; // Skip pages that we don't need even if they're consecutive
					}
				}
			}
			if ($_SESSION['page'] > $totalPages) {	// don't allow us past final page for any reason
				$_SESSION['page'] = $totalPages;
			}
		}
	}
	//exit();
	if ($blnExit) {
		$cmd = base64_encode('save&exit');
		header("Location:index.php?c=" . $cmd);
	}

	if ($_SESSION['page'] < $totalPages) {
		$pageNext = 'Continue on page ' . ($_SESSION['page']+1);
	} else {
		$pageNext = 'Finish';
	}
	$pageNum = $_SESSION['page']; // Use this local variable to output the correct questions:
	//echo("You're on page: " . $_SESSION['page']);
	setCompanyAuditPage($aid, $pageNum, $db);
	$progressPercent = floor($pageNum * (100/20));
  ?>
					

		     			
					<form action="mosa_interview.php" method="post" id="mosa_interview">
						
				  <?php
						if ($pageNum < 20) {	// Don't show buttons for Score_Page
					?>
	  				<input type="submit" id="saveExit" value="" name="exit" />
					<?php
						} else {  // Content for below ScorePage ... or add it to the bottom of score_page
 
						}
					?>
          <!-- <h2><?php //echo($interviewPages[$page][0]) ?></h2> -->
					<?php 
						if ($blnLoadValues) {
							echo('<!-- load form values -->');
							$formValues = selectFormFromDB($aid, $pageNum, $db);
						} else {
							$formValues = array();
						}
						require('pages/' . $interviewPages[$pageNum][1]); 
					?>
					<br/>
					<?php
						if ($pageNum < 20) {	// Don't show buttons for Score_Page
					?>
					<input type="hidden" name="page" value="<?php echo($_SESSION['page'])?>" />
					<input type="submit" id="continue" value="" name="submit" />&nbsp;
					<?php
						} else {  // Content for below ScorePage ... or add it to the bottom of score_page
 
						}
					?>
					<br/>	
					<div id="percentDisplay" style="margin-left:50%"></div>
					<div id="progressbar" style="height:20px"></div>
				</form>
				<script language="Javascript" type="text/javascript">
					$(document).ready(function() {
					$("#progressbar").progressbar({ value: <?php echo($progressPercent); ?> });
					});
					$("#percentDisplay").html('<span><?php echo($progressPercent); ?>%</span>');
				</script>
			</div>
		</div>
	</BODY>
</HTML>
<?php
  ob_end_flush();
?>