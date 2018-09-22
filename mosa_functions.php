<?php
// functions to be used with Mosa Light
// function updateUserLogin($uid, $ip, $firstlogin, $db) // void
//		Updates user record with the lastlogin and lastip for records
// function userExists($username, $db) // boolean
//		Checks if a username is already in the DB
// function registerNewUser($companyName, $address, $address2,
//			$city, $state, $zip, $nmls, $phone, $email, $db) // boolean
//		inserts Company info and gets ID, inserts user info and cid
// function connectDB($dbname)
//		returns useable db connection to database named $dbname, defaults to "mosa"
// createPassword($mask)
//		Mask Rules
//		# - digit
//		C - Caps Character (A-Z)
//		c - Small Character (a-z)
//		X - Mixed Case Character (a-zA-Z)
//		! - Custom Extended Characters
// sendEmail($from, $to, $subject, $message) // boolean

// 7.27.2011
function updateUserLogin($uid, $ip, $firstlogin, $db) {
	if ($firstlogin 3== '') {
		$ip = $_SERVER["REMOTE_ADDR"]; // IIS method of getting IP address
		$sql = 'update users set firstlogin = NOW(), lastlogin = NOW(), lastip = "' . $ip . '" where id = ' . $uid;
		$rs = mysql_query($sql, $db);
		if (mysql_errno()) {
			reportError('updateUserLogin:1', mysql_error($db) . ' ' . $sql);
		}
	} else {
		$ip = $_SERVER["REMOTE_ADDR"]; // IIS method of getting IP address
		$sql = 'update users set lastlogin = NOW(), lastip = "' . $ip . '" where id = ' . $uid;
		$rs = mysql_query($sql, $db);
		if (mysql_errno()) {
			reportError('updateUserLogin:2', mysql_error($db) . ' ' . $sql);
		}
	}
}

// 7.27.2011
function userExists($username, $db) // boolean
{
	$name = mysql_real_escape_string($_POST['clientName']);
	$sql = 'Select id from users where username like "' . $username . '"';
	$result = mysql_query($sql, $db);
	if ($result) {
		$row = mysql_fetch_array($result);
		if ($row) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

// 7.27.2011
// Send in all the user information and it registers you and returns true or false
function registerNewUser($name, $companyName, $address, $address2, $city, $state, $zip, $nmls, $phone, $email, $db) // boolean
{
	$name = mysql_real_escape_string($name);
	$companyName = mysql_real_escape_string($companyName);
	$address = mysql_real_escape_string($address);
	$address2 = mysql_real_escape_string($address2);
	$city = mysql_real_escape_string($city);
	$state = mysql_real_escape_string($state);
	$zip = mysql_real_escape_string($zip);
	$nmls = mysql_real_escape_string($nmls);
	$phone = mysql_real_escape_string($phone);
	$email = mysql_real_escape_string($email);
	$sql = 'insert into companies (name, address, address_2, city, state, zip, nmls, phone, email) values ("' . $companyName .'", "' . $address . '", "' . $address2 . '", "' . $city . '", "' . $state . '", "' . $zip . '", "' . $nmls . '", "' . $phone . '", "' . $email . '")';
	$result = mysql_query($sql, $db);
	if ($result) {
		$cid = mysql_insert_id($db);
		$newpw = createPassword('XXX###');
		$sql = 'insert into users (`username`, `password`, `clearance`, `cid`, `firstlogin`, `range`) values ("' . $name . '", "' . $newpw . '", "user", ' . $cid . ', CURRENT_DATE(), 30)';

		$result = mysql_query($sql, $db);
		$message = "Thank you for your registration,\r\n Your username is: $name \r\n Your password is: $newpw";
		if (sendEmail('admin@priestongroup.com', $email, 'Mosa Registration', $message)) {

		} else {
			// Hmm... should do something about this
			// TODO: figure out what to do if we know the email didn't go out
		}
		return true;
	} else { // oops, something went wrong
		reportError('registerNewUser', mysql_error($db) . ' ' . $sql);
		return false;
	}
}

// derrived from t's code 'registerNewUser' above
// 9.15.2011 -r
function registerNewClient($name, $companyName, $address, $address2, $city, $state, $zip, $nmls, $phone, $email, $db) // boolean
{
	$name = mysql_real_escape_string($name);
	$companyName = mysql_real_escape_string($companyName);
	$address = mysql_real_escape_string($address);
	$address2 = mysql_real_escape_string($address2);
	$city = mysql_real_escape_string($city);
	$state = mysql_real_escape_string($state);
	$zip = mysql_real_escape_string($zip);
	$nmls = mysql_real_escape_string($nmls);
	$phone = mysql_real_escape_string($phone);
	$email = mysql_real_escape_string($email);
	$sql = 'insert into companies (name, address, address_2, city, state, zip, nmls, phone, email) values ("' . $companyName .'", "' . $address . '", "' . $address2 . '", "' . $city . '", "' . $state . '", "' . $zip . '", "' . $nmls . '", "' . $phone . '", "' . $email . '")';
	$result = mysql_query($sql, $db);
	if ($result) {
		$cid = mysql_insert_id($db);
		$newpw = createPassword('XXX###');
		$sql = 'insert into users (`username`, `password`, `clearance`, `cid`, `firstlogin`, `range`) values ("' . $name . '", "' . $newpw . '", "user", ' . $cid . ', CURRENT_DATE(), 30)';

		$result = mysql_query($sql, $db);
		$message = "Thank you for your registration,\r\n Your username is: $name \r\n Your password is: $newpw";
		if (sendEmail('admin@priestongroup.com', $email, 'Mosa Registration', $message)) {

		} else {
			// Hmm... should do something about this
			// TODO: figure out what to do if we know the email didn't go out
			// Can't add reportError here in case the sendMail function is failing, viscious cycle
		}
		return true;
	} else { // oops, something went wrong
		reportError('registerNewClient', mysql_error($db) . ' ' . $sql);
		return false;
	}
}

// Mask Rules
// # - digit
// C - Caps Character (A-Z)
// c - Small Character (a-z)
// X - Mixed Case Character (a-zA-Z)
// ! - Custom Extended Characters
function createPassword($mask) {
	try {
		$extended_chars = "!@#$%^&*()";
		$length = strlen($mask);
		$pwd = '';
		for ($c=0;$c<$length;$c++) {
		$ch = $mask[$c];
		switch ($ch) {
		  case '#':
			$p_char = rand(0,9);
			break;
		  case 'C':
			$p_char = chr(rand(65,90));
			break;
		  case 'c':
			$p_char = chr(rand(97,122));
			break;
		  case 'X':
			do {
			  $p_char = rand(65,122);
			} while ($p_char > 90 && $p_char < 97);
			$p_char = chr($p_char);
			break;
		  case '!':
			$p_char = $extended_chars[rand(0,strlen($extended_chars)-1)];
			break;
		}
		$pwd .= $p_char;
		}
	} catch (Exception $ex) {
		$error = print_r($ex->getMessage(), true) . ' mask: ' . $mask;
		reportError('createPassword', $error);
	}
  return $pwd;
}

// 7.27.2011
function connectDB($dbname)
{
	if ($dbname == '') {
		$dbname = 'ml_design';
	}
	$conn = mysql_connect(DBHOST, DBUSER, DBPASS);
	if (!$conn) {
		reportError('connectDB', mysql_error() . ' dbname: ' . $dbname);
		die ('Error connecting to mysql');
	}
	$db = mysql_select_db($dbname);
	return $conn;
}

// 7.27.2011
function sendEmail($from, $to, $subject, $message) // boolean
{
	//invoicing@priestongroup.com / smtp.googlemail.com / pass=Greyhawk1
	$mail = new PHPMailer();
	$mail->IsSMTP(); // send via SMTP
	$mail->SMTPAuth = true; // turn on SMTP authentication
	$mail->Username = "noreply@priestongroup.com"; // SMTP username
	$mail->Password = "pr13st0n"; // SMTP password
	$webmaster_email = "noreply@priestongroup.com"; //Reply to this email ID
	$email=$to; // Recipients email ID
	$name=$to; // Recipient's name
	$mail->From = $from;
	$mail->FromName = "Mosa";
	$mail->AddAddress($email,$name);
	$mail->AddReplyTo($webmaster_email,"Webmaster");
	$mail->WordWrap = 50; // set word wrap
	$mail->IsHTML(false); // send as plain text
	$mail->Subject = $subject;
	$mail->Body = $message;
	if (!$mail->Send()) {
		// don't show errors
		//echo "Mailer Error: " . $mail->ErrorInfo;
		// Can't add error reporting here or we'll get a viscious cycle
	} else {
		//echo "Message has been sent";
	}
}

// 8.7.2011
function getCompanyOptions($currentSelection, $db) {
	$opts = '';
	$sql = 'select * from companies where company_id not in (26,27,28) order by name';
	$rs = mysql_query($sql, $db);
	if ($rs) {
		while ($row = mysql_fetch_assoc($rs)) {
			$cid = $row['company_id'];
			$opts .= '<option value="' . $cid . '"';
			if ($cid == $currentSelection) {
				$opts .= ' selected="selected" ';
			}
			$opts .= '>' . $row['name'] . '</option>';
		}
	} else {
		reportError('getCompanyOptions', mysql_error($db) . ' ' . $sql);
	}
	return $opts;
}

// 8.7.2011
function getReportOptions($currentSelection, $companyId, $db) {
	$opts = '';
	$sql  = "select * from audits where company_id=" . $companyId . " and audit_id not in(35,65,66,67)";
	$rs = mysql_query($sql, $db);
	if ($rs) {
		while ($row = mysql_fetch_assoc($rs)) {
			$rid = $row['audit_id'];
			$opts .= '<option value="' . $rid . '"';
			if ($rid == $currentSelection) {
				$opts .= ' selected="selected" ';
			}
			$opts .= '>' . $aid . '&nbsp;(' . $row['audit_date'] . ')</option>';
		}
	} else {
		reportError('getReportOptions', mysql_error($db) . ' ' . $sql);
	}
	return $opts;
}

// 8.7.2011
function getReportOptionsJSON($companyId, $db) {
	$opts = '[';
	$sql  = "select * from audits where company_id=" . $companyId . " and audit_id not in(35,65,66,67)";
	$rs = mysql_query($sql, $db);
	if ($rs) {
		while ($row = mysql_fetch_assoc($rs)) {
			$aid = $row['audit_id'];
			$opts .= '{"optionValue": "' . $aid . '", "optionDisplay": "' . $aid . '&nbsp;(' . $row['audit_date'] . ')"}, ';
		}
	} else {
		reportError('getReportOptionsJSON', mysql_error($db) . ' ' . $sql);
	}
	$opts = trim($opts, ", ");
	$opts .= ']';
	return $opts;
}

// 8.8.2011 	- Depricated in favor of getScatterScoreChartByIndex
function getScatterScoreChartByDate($startDate, $endDate, $cid, $aid, $db) {
	$chart = '<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn("date", "Date");
        data.addColumn("number", "Other Scores");
		data.addColumn("number", "Your Score");
	';

	$sql = "select * from scores where company_id = " . $cid . " and audit_id = " . $aid;
	$yourScore = 80; // Default in case we can't find their Audit.
	if ($rs = mysql_query($sql, $db)) {
		if ($row = mysql_fetch_assoc($rs)) {
			$yourScore = round($row['mosa_score']);
		}
	}
	$sql  = "select * from scores where `date` between '" . $startDate . "' AND '" . $endDate . "'";
	if ($rs = mysql_query($sql, $db)) {
		$dataRows = '';
		$numRows = 0;
		$maxValue = 0;
		$minValue = 1000;
		while ($row = mysql_fetch_assoc($rs)) {

			$arrDate = explode("-", $row['date']);
			$score = round($row['mosa_score']);
			if (($score > 0) && ($score < 800)) {
				$dataRows .= 'data.addRow([new Date(' . $arrDate[0] . ', ' . $arrDate[1] . ', ' . $arrDate[2] . '), ' . $score . ', null]);' . "\r\n";
				if ($score < $minValue) { $minValue = $score; }
				if ($score > $maxValue) { $maxValue = $score; }
				$numRows ++;
			}
		}
		$arrDate = explode("-", $startDate);
		$d = mktime(0,0,0,$arrDate[1],$arrDate[2],$arrDate[0]);
		$dif = dateDiff($startDate, $endDate);
		$midDate = date("Y-m-d",strtotime("+" . round($dif/2) . " days",$d));
		$arrDate = explode("-", $midDate);
		$dataRows .= 'data.addRow([new Date(' . $arrDate[0] . ', ' . $arrDate[1] . ', ' . $arrDate[2] .'), null, ' . $yourScore . ']);' . "\r\n";
		$chart .= $dataRows;
	}
	$chart .= '
	    var chart = new google.visualization.ScatterChart(document.getElementById("chart_div"));
        chart.draw(data, {width: 640, height: 480,
                          title: "Score Comparison",
                          hAxis: {title: "Date"},
                          vAxis: {title: "Score", minValue: ' . $minValue . ' , maxValue: ' . $maxValue . '},
                          legend: "none"
                         });
      }
    </script>
	';
	return $chart;
}
// 8.8.2011
function getScatterScoreChartByIndex($startDate, $endDate, $cid, $aid, $db) {
	$chart = '<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn("number", "Index");
        data.addColumn("number", "Other Scores");
		data.addColumn("number", "Your Score");
	';

	$sql = "select * from scores where company_id = " . $cid . " and audit_id = " . $aid;
	$yourScore = 80; // Default in case we can't find their Audit.
	if ($rs = mysql_query($sql, $db)) {
		if ($row = mysql_fetch_assoc($rs)) {
			$yourScore = round($row['mosa_score']);
		}
	} else {
		reportError('getScatterScoreChartByIndex:1', mysql_error($db) . ' ' . $sql);
	}
	$db2 = connectDB('mosa');
	$sql  = "select * from scores where `date` between '" . $startDate . "' AND '" . $endDate . "'";
	if ($rs = mysql_query($sql, $db2)) {
		$dataRows = '';
		$numRows = 0;
		$maxValue = 0;
		$minValue = 1000;
		while ($row = mysql_fetch_assoc($rs)) {

			$arrDate = explode("-", $row['date']);
			$score = round($row['mosa_score']);
			if (($score > 0) && ($score < 800)) {
				$dataRows .= 'data.addRow([' . $numRows . ', ' . $score . ', null]);' . "\r\n";
				if ($score < $minValue) { $minValue = $score; }
				if ($score > $maxValue) { $maxValue = $score; }
				$numRows ++;
			}
		}
		$dataRows .= 'data.addRow([' . round($numRows/2) . ', null, ' . $yourScore . ']);' . "\r\n";
		$chart .= $dataRows;
	} else {
		reportError('getScatterScoreChartByIndex:2', mysql_error($db2) . ' ' . $sql);
	}
	$chart .= '
	    var chart = new google.visualization.ScatterChart(document.getElementById("chart_div"));
        chart.draw(data, {width: 640, height: 480,
                          title: "Score Comparison",
                          hAxis: {title: "Index", titleTextStyle: {color: \'#FFFFFF\'}, textStyle: {color: \'#FFFFFF\'}},
                          vAxis: {title: "Score", minValue: ' . $minValue . ' , maxValue: ' . $maxValue . '},
                          legend: "right",
						  enableInteractivity: "false"
                         });
      }
    </script>
	';
	return $chart;
}
// 8.8.2011
function dateDiff($start, $end) {
	try {
	    $start_ts = strtotime($start);
	    $end_ts = strtotime($end);
	    $diff = $end_ts - $start_ts;
	} catch (Exception $ex) {
		$error = print_r($ex->getMessage(), true) . ' start: ' . $start . ' end: ' . $end;
		reportError('dateDiff', $error);
	}
	return round($diff / 86400);
}


// 8.11.2011
function isCompanyAudit($cid, $db) {
	$company_id = mysql_real_escape_string($cid);
	$sql = 'Select max(audit_id) from audits where company_id = ' . $company_id;
	$rs = mysql_query($sql, $db);
	if ($rs) {
		if ($row = mysql_fetch_array($rs)) {
			return $row[0];
		} else {
			return 0;
		}
	} else {
		return 0;
	}
}

// 8.11.2011
function getCompanyAuditPage($aid, $db) {
	$audit_id = mysql_real_escape_string($aid);
	$sql = 'Select page from audits where audit_id = ' . $audit_id;
	$rs = mysql_query($sql, $db);
	if ($rs) {
		if ($row = mysql_fetch_array($rs)) {
			return $row[0];
		} else {
			return 0;
		}
	} else {
		return 0;
	}
}

// 8.11.2011
function setCompanyAuditPage($aid, $page, $db) {
	$audit_id = mysql_real_escape_string($aid);
	$page_num = mysql_real_escape_string($page);
	$sql = 'update audits set page = ' . $page_num . ' where audit_id = ' . $aid;
	$rs = mysql_query($sql, $db);
	if ($rs) {
		return true;
	} else {
		return false;
	}
}

// 8.11.2011 		-Returns blank string for success (I know, not pretty)
function initiateAudit($cid, $db) {
	$ErrorMessage = '';
	$company_id = mysql_real_escape_string($cid);
	$sql = 'insert into audits (company_id, audit_date, page) values (' . $company_id . ', CURDATE(), 0)';
	$rs = mysql_query($sql, $db);
	if ($rs) {
		$aid = mysql_insert_id($db);
		$audit_id = mysql_real_escape_string($aid);
		$tables = array('aapr_audit','ampr_audit','atpr_audit','awla_audit','bag_audit','bam_audit','cam_audit','ca_audit','ceo_audit','cm_audit','corag_audit','eoi_audit','fi_audit','fp_audit','gseaa_audit','hrd_audit','invrefs_audit','isr_audit','opchk_audit','pboccg_audit','pc_audit','qcppp_audit','qc_audit','rali_audit','reph_audit','susrej_audit','t590_audit','uw_audit','fr_audit','overall_comments');
		foreach ($tables as $table) {
			$sql = 'insert into ' . $table . ' (company_id, audit_id) values (' . $company_id . ', ' . $audit_id . ')';
			if (!$rs = mysql_query($sql, $db)) {
				$ErrorMessage .= 'Unable to initiate: ' . $table . '<br/>';
				reportError('initiateAudit:1', mysql_error($db) . ' ' . $sql);
			}
		}
	} else {
		$ErrorMessage .= 'Unable to initiate Audit<br/>';
		reportError('initiateAudit:2', mysql_error($db));
	}
	return $ErrorMessage;
}

// 8.18.2011   - Returns a SQL command created from filling a SQL Template with values from the POST
function fillSqlTemplateFromForm($db, $sqlTemplate, $audit_id) {
	//echo('<br/>Sql Template: ' . $sqlTemplate);
	try {
		while (preg_match('/#(\w+)#/', $sqlTemplate, $matches)) {
			$templateMarker = $matches[0];
			$formFieldName = $matches[1];
			if (is_array($_POST[$formFieldName])) {
				$formValue = implode('|', $_POST[$formFieldName]);
			} else {
				$formValue = $_POST[$formFieldName];
			}
			$sqlTemplate = str_replace($templateMarker, mysql_real_escape_string($formValue), $sqlTemplate);
		}
		$sqlTemplate = str_replace('[auditid]', $audit_id, $sqlTemplate);
		//reportError('Mosa Light Debug Output', 'sqlTemplate: ' . $sqlTemplate);
	} catch (Exception $ex) {
		$error = print_r($ex->getMessage(), true) . ' sqlTemplate = ' . $sqlTemplate . ' audit_id = ' . $audit_id;
		reportError('fillSqlTemplateFromForm', $error);
	}
	return $sqlTemplate;
}
// 9.25.2011  Returns an array of SQL commands dynamically created from array of fields
function createUpdateFromForm($page, $auditid) {
		global $fieldMap;
		//print_r($_POST);
		//echo('<br/>Page: ' . $page . '<br/>');
		$fields = $fieldMap[$page];
		$updates = array();
		$sqlCount = 0;
		foreach ($fields as $tKey => $uFields) {
			$sql = 'update ' . $tKey . ' set ';
			foreach ($uFields as $fKey => $formFieldName) {
				if (is_array($_POST[$formFieldName])) {
					$formValue = implode('|', $_POST[$formFieldName]);
				} else {
					$formValue = $_POST[$formFieldName];
				}
				$sql .= $fKey . ' = "' . $formValue . '", ';
				//echo($fKey . ' = ' . $formFieldName . ' = ' . $_POST[$formFieldName] . '<br/>');
			}

			$sql = substr($sql, 0, strlen($sql)-2);
			$sql .= ' where audit_id = ' . $auditid;
			$updates[$sqlCount] = $sql;
			$sqlCount ++;
		}
		return $updates;
	}
// 9.22.2011  Checks flags from database to see if particular pages should be shown.
//   current rules are:  page 9 = false if page 8 field 4 = ""
//						 page 10 = false if page 8 field 5 = ""
function doPage($pageNum, $aid, $db) {
	if ($pageNum == 9) {
		$sql = 'select Broker from RALI_Audit where audit_id = ' . $aid;
		$rs = mysql_query($sql, $db);
		if ($rs) {
			$row = mysql_fetch_array($rs);
			$Page8Field4 = $row[0];
			if ($Page8Field4 == "") {
				return false;
			}
		} else {
			reportError('doPage:1', mysql_error($db));
		}
	}
	if ($pageNum == 10) {
		$sql = 'select Corr from RALI_Audit where audit_id = ' . $aid;
		$rs = mysql_query($sql, $db);
		if ($rs) {
			$row = mysql_fetch_array($rs);
			$Page8Field4 = $row[0];
			if ($Page8Field4 == "") {
				return false;
			}
		} else {
			reportError('doPage:2', mysql_error($db));
		}
	}
	if ($pageNum == 14) {
		$sql = 'select Checklist from aapr_audit where audit_id = ' . $aid;
		$rs = mysql_query($sql, $db);
		if ($rs) {
			$row = mysql_fetch_array($rs);
			$Page13Field2 = $row[0];
			if ($Page13Field2 == "no") {
				return false;
			}
		} else {
			reportError('doPage:3', mysql_error($db));
		}
	}
	if ($pageNum == 15) {
		$sql = 'select Checklist from aapr_audit where audit_id = ' . $aid;
		$rs = mysql_query($sql, $db);
		if ($rs) {
			$row = mysql_fetch_array($rs);
			$Page13Field2 = $row[0];
			if ($Page13Field2 == "no") {
				return false;
			}
		} else {
			reportError('doPage:4', mysql_error($db));
		}
	}
	return true;
}

// 9.22.2011  Error Reporting Email
function reportError($subject, $data) {
	//echo($subject . '<br/>' . $data);
	//sendEmail('admin@priestongroup.com', 'travis@cfm2asp.com', 'TPGD Error: ' . $subject, $data);
	//sendEmail('admin@priestongroup.com', 'rafe@magnusontech.net', 'TPGD Error: ' . $subject, $data);
}

// 9.23.2011  Load values from DB for Save&Exit function
function loadPageValues($page, $db) {
	global $pageSQL;
	$formValues = array();
	echo('<!--');
	//print_r($pageSQL[$page]);
	echo(' page num' . $page);
	switch ($page) {
    case 1:

        break;
    case 2:
        //update invrefs_audit set Ref1Name="#ir1#",Ref1Contact="#ir2#",Ref1Email="#ir3#"  ,Ref1Phone="#ir4#",Ref2Name="#ir5#",Ref2Contact="#ir6#",Ref2Email="#ir7#",Ref2Phone="#ir8#"  ,Ref3Name="#ir9#",Ref3Contact="#ir10#",Ref3Email="#ir11#",Ref3Phone="#ir12#" ,Ref4Name="#ir13#",Ref4Contact="#ir14#",Ref4Email="#ir15#",Ref4Phone="#ir16#"  ,Ref5Name="#ir17#",Ref5Contact="#ir18#",Ref5Email="#ir19#",Ref5Phone="#ir20#" where audit_id=[auditid]


        break;
    case 3:
        echo "i equals 2";
        break;
	}
}

function selectFormFromDB($auditid, $page, $db) {
	global $fieldMap;
	$fields = $fieldMap[$page];
	$formFields = array();
	foreach ($fields as $tKey => $uFields) {
		$sql = 'select * from ' . $tKey . ' where audit_id = ' . $auditid;
		$rs = mysql_query($sql, $db);
		if ($rs) {
			$row = mysql_fetch_assoc($rs);
			foreach ($uFields as $fKey => $formField) {
				$data = $row[$fKey];
				if (strpos($data,'|') !== false) {
					$arrData = explode('|', $data);
					$formFields[$formField] = $arrData;
					$data = $arrData;
				}
				$formFields[$formField] = $data;
			}
		}
	}
	return $formFields;
}

function isChecked($arr, $field, $value) {
	if (is_array($arr)) {
		if (array_key_exists($field, $arr)) {
			if (is_array($arr[$field])) {
				if (in_array($value, $arr[$field])) { echo ' checked '; }
			} else {
				if ($arr[$field] == $value) { echo ' checked '; }
			}
		}
	}
}

function isSelected($arr, $field, $value) {
	if (is_array($arr)) {
		if (array_key_exists($field, $arr)) {
			if (is_array($arr[$field])) {
				if (in_array($value, $arr[$field])) { echo ' selected '; }
			} else {
				if ($arr[$field] == $value) { echo ' selected '; }
			}
		}
	}
}

function getValue($arr, $field) {
	if (is_array($arr)) {
		if (array_key_exists($field, $arr)) {
			echo($arr[$field]);
		}
	}
}
?>
