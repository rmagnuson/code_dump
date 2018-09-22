<?php

//session_start();



$testing=0;

if ($testing != 0) {
	error_reporting(1);
} else {
	error_reporting(0);
}

$company_id = $_SESSION['company_id'];
$audit_id = isCompanyAudit($company_id, $db);

// set demo record for testing
//	$company_id = 7; // set earlier in code
//	$audit_id	= $aid;

if ($testing != 0) {
	echo "Company ID: ". $company_id . "<br>";
	echo "Audit ID: ". $audit_id . "<br><br>";
}

// first load up everything from the db

	$dbhost = 'localhost:3308';
	$dbuser = 'root';
	$dbpass = 'T3rminal7';
	$dbname = 'ml_design';

	$opendb   = mysql_connect($dbhost, $dbuser, $dbpass) or die("Unable to connect to MySQL");
	$selectdb = mysql_select_db($dbname, $opendb) or die("Could not select clients: $selectdb");


	$rali_audit = 'SELECT '
	.'rali_audit.Summary as RALI_Summary,'
	.'rali_audit.Unit as RALI_unit,'
	.'rali_audit.Cash as RALI_cash,'
	.'rali_audit.Retail as RALI_retail,'
	.'rali_audit.Broker as RALI_broker,'
	.'rali_audit.Corr as RALI_corr,'
	.'rali_audit.UnitPriYr as RALI_UnitPriYr,'
	.'rali_audit.CashPriYr as RALI_CashPriYr,'
	.'rali_audit.RetailPriYr as RALI_RetailPriYr,'
	.'rali_audit.BrokerPriYr as RALI_BrokerPriYr,'
	.'rali_audit.CorrPriYr as RALI_CorrPriYr,'
	.'rali_audit.States as RALI_states,'
	.'rali_audit.FullDocPer as RALI_FullDocPer,'
	.'rali_audit.StatedDocPer as RALI_StatedDocPer,'
	.'rali_audit.NIVDocPer as RALI_NIVDocPer,'
	.'rali_audit.NINADocPer as RALI_NINADocPer,'
	.'rali_audit.LTV as RALI_ltv,'
	.'rali_audit.CLTV as RALI_cltv,'
	.'rali_audit.AvgFico as RALI_avgfico,'
	.'rali_audit.AvgLoanBalance as RALI_AvgLoanBalance,'
	.'rali_audit.FirstLienPer as RALI_FirstLienPer,'
	.'rali_audit.SecondLienPer as RALI_SecondLienPer,'
	.'rali_audit.PiggySecPer as RALI_PiggySecPer,'
	.'rali_audit.CIR as RALI_cir,'
	.'rali_audit.LTV1324 as RALI_ltv1324,'
	.'rali_audit.CLTV1324 as RALI_cltv1324,'
	.'rali_audit.AvgFico1324 as RALI_avgfico1324,'
	.'rali_audit.AvgLoanBalance1324 as RALI_AvgLoanBalance1324,'
	.'rali_audit.FirstLienPer1324 as RALI_FirstLienPer1324,'
	.'rali_audit.SecondLienPer1324 as RALI_SecondLienPer1324,'
	.'rali_audit.PiggySecPer1324 as RALI_PiggySecPer1324,'
	.'rali_audit.CIR1324 as RALI_cir1324,'
	.'rali_audit.FullDocPer1324 as RALI_FullDocPer1324,'
	.'rali_audit.StatedDocPer1324 as RALI_StatedDocPer1324,'
	.'rali_audit.NIVDocPer1324 as RALI_NIVDocPer1324,'
	.'rali_audit.NINADocPer1324 as RALI_NINADocPer1324,'
	.'rali_audit.AsOfDate as RALI_asofdate,'
	.'rali_audit.FNMA as RALI_fnma,'
	.'rali_audit.FHLMC as RALI_fhlmc,'
	.'rali_audit.FHA as RALI_fha,'
	.'rali_audit.VA as RALI_va,'
	.'rali_audit.USDA as RALI_usda'
	.' from rali_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($rali_audit);
	$row = mysql_fetch_assoc($result);

	$RALI_Summary			= $row['RALI_Summary'];
	$RALI_unit				= $row['RALI_unit'];
	$RALI_cash				= $row['RALI_cash'];
	$RALI_retail			= $row['RALI_retail'];
	$RALI_broker			= $row['RALI_broker'];
	$RALI_corr				= $row['RALI_corr'];
	$RALI_UnitPriYr			= $row['RALI_UnitPriYr'];
	$RALI_CashPriYr			= $row['RALI_CashPriYr'];
	$RALI_RetailPriYr		= $row['RALI_RetailPriYr'];
	$RALI_BrokerPriYr		= $row['RALI_BrokerPriYr'];
	$RALI_CorrPriYr			= $row['RALI_CorrPriYr'];
	$RALI_states			= $row['RALI_states'];
	$RALI_FullDocPer		= $row['RALI_FullDocPer'];
	$RALI_StatedDocPer		= $row['RALI_StatedDocPer'];
	$RALI_NIVDocPer			= $row['RALI_NIVDocPer'];
	$RALI_NINADocPer		= $row['RALI_NINADocPer'];
	$RALI_ltv				= $row['RALI_ltv'];
	$RALI_cltv				= $row['RALI_cltv'];
	$RALI_avgfico			= $row['RALI_avgfico'];
	$RALI_AvgLoanBalance	= $row['RALI_AvgLoanBalance'];
	$RALI_FirstLienPer		= $row['RALI_FirstLienPer'];
	$RALI_SecondLienPer		= $row['RALI_SecondLienPer'];
	$RALI_PiggySecPer		= $row['RALI_PiggySecPer'];
	$RALI_cir				= $row['RALI_cir'];
	$RALI_ltv1324			= $row['RALI_ltv1324'];
	$RALI_cltv1324			= $row['RALI_cltv1324'];
	$RALI_avgfico1324		= $row['RALI_avgfico1324'];
	$RALI_AvgLoanBalance1324= $row['RALI_AvgLoanBalance1324'];
	$RALI_FirstLienPer1324	= $row['RALI_FirstLienPer1324'];
	$RALI_SecondLienPer1324	= $row['RALI_SecondLienPer1324'];
	$RALI_PiggySecPer1324	= $row['RALI_PiggySecPer1324'];
	$RALI_cir1324			= $row['RALI_cir1324'];
	$RALI_FullDocPer1324	= $row['RALI_FullDocPer1324'];
	$RALI_StatedDocPer1324	= $row['RALI_StatedDocPer1324'];
	$RALI_NIVDocPer1324		= $row['RALI_NIVDocPer1324'];
	$RALI_NINADocPer1324	= $row['RALI_NINADocPer1324'];
	$RALI_asofdate			= $row['RALI_asofdate'];
	$RALI_fnma				= $row['RALI_fnma'];
	$RALI_fhlmc				= $row['RALI_fhlmc'];
	$RALI_fha				= $row['RALI_fha'];
	$RALI_va				= $row['RALI_va'];
	$RALI_usda				= $row['RALI_usda'];

	$awla_audit = 'select awla_audit.wl1 as awla_wl1,'
	.'awla_audit.aa1 as awla_aa1,'
	.'awla_audit.nal1 as awla_nal1,'
	.'awla_audit.cal1 as awla_cal1,'
	.'awla_audit.wl2 as awla_wl2,'
	.'awla_audit.aa2 as awla_aa2,'
	.'awla_audit.nal2 as awla_nal2,'
	.'awla_audit.cal2 as awla_cal2,'
	.'awla_audit.wl3 as awla_wl3,'
	.'awla_audit.aa3 as awla_aa3,'
	.'awla_audit.nal3 as awla_nal3,'
	.'awla_audit.cal3 as awla_cal3,'
	.'awla_audit.exception as awla_exception,'
	.'awla_audit.wlb as awla_wlb,'
	.'awla_audit.whl1date as awla_whl1date,'
	.'awla_audit.whl2date as awla_whl2date,'
	.'awla_audit.whl3date as awla_whl3date,'
	.'awla_audit.wlb2 as awla_wlb2,'
	.'awla_audit.wlb3 as awla_wlb3,'
	.'awla_audit.wl4 as awla_wl4,'
	.'awla_audit.aa4 as awla_aa4,'
	.'awla_audit.nal4 as awla_nal4,'
	.'awla_audit.cal4 as awla_cal4,'
	.'awla_audit.wlb4 as awla_wlb4,'
	.'awla_audit.whl4date as awla_whl4date,'
	.'awla_audit.wl5 as awla_wl5,'
	.'awla_audit.aa5 as awla_aa5,'
	.'awla_audit.nal5 as awla_nal5,'
	.'awla_audit.cal5 as awla_cal5,'
	.'awla_audit.wlb5 as awla_wlb5,'
	.'awla_audit.whl5date as awla_whl5date'
	.' from awla_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($awla_audit);
	$row = mysql_fetch_assoc($result);

	$awla_wl1		= $row['awla_wl1'];
	$awla_aa1		= $row['awla_aa1'];
	$awla_nal1		= $row['awla_nal1'];
	$awla_cal1		= $row['awla_cal1'];
	$awla_wl2		= $row['awla_wl2'];
	$awla_aa2		= $row['awla_aa2'];
	$awla_nal2		= $row['awla_nal2'];
	$awla_cal2		= $row['awla_cal2'];
	$awla_wl3		= $row['awla_wl3'];
	$awla_aa3		= $row['awla_aa3'];
	$awla_nal3		= $row['awla_nal3'];
	$awla_cal3		= $row['awla_cal3'];
	$awla_exception = $row['awla_exception'];
	$awla_wlb		= $row['awla_wlb'];
	$awla_whl1date	= $row['awla_whl1date'];
	$awla_whl2date	= $row['awla_whl2date'];
	$awla_whl3date	= $row['awla_whl3date'];
	$awla_wlb2		= $row['awla_wlb2'];
	$awla_wlb3		= $row['awla_wlb3'];
	$awla_wl4		= $row['awla_wl4'];
	$awla_aa4		= $row['awla_aa4'];
	$awla_nal4		= $row['awla_nal4'];
	$awla_cal4		= $row['awla_cal4'];
	$awla_wlb4		= $row['awla_wlb4'];
	$awla_whl4date	= $row['awla_whl4date'];
	$awla_wl5		= $row['awla_wl5'];
	$awla_aa5		= $row['awla_aa5'];
	$awla_nal5		= $row['awla_nal5'];
	$awla_cal5		= $row['awla_cal5'];
	$awla_wlb5		= $row['awla_wlb5'];
	$awla_whl5date	= $row['awla_whl5date'];

	$aapr_audit = 'select aapr_audit.OpeningComments as aapr_OpeningComments,'
	.'aapr_audit.Checklist as aapr_Checklist,'
	.'aapr_audit.VerifyLicense as aapr_VerifyLicense,'
	.'aapr_audit.TrackLicense as aapr_TrackLicense,'
	.'aapr_audit.SearchVertical as aapr_SearchVertical,'
	.'aapr_audit.ExcLists as aapr_ExcLists,'
	.'aapr_audit.RevResumes as aapr_RevResumes,'
	.'aapr_audit.ReqRefs as aapr_ReqRefs,'
	.'aapr_audit.ContactRefs as aapr_ContactRefs,'
	.'aapr_audit.EO as aapr_eo,'
	.'aapr_audit.VerifyEO as aapr_VerifyEO,'
	.'aapr_audit.TrackEO as aapr_trackeo,'
	.'aapr_audit.DiscPRA as aapr_DiscPRA,'
	.'aapr_audit.DiscPCA as aapr_DiscPCA,'
	.'aapr_audit.ZeroTolerance as aapr_ZeroTolerance,'
	.'aapr_audit.CheckMari as aapr_CheckMari,'
	.'aapr_audit.MonAV as aapr_monav,'
	.'aapr_audit.MonRD as aapr_monrd,'
	.'aapr_audit.QC as aapr_qc,'
	.'aapr_audit.MonDocs as aapr_mondocs,'
	.'aapr_audit.ResToExecs as aapr_ResToExecs,'
	.'aapr_audit.Thresh as aapr_thresh,'
	.'aapr_audit.Freq as aapr_freq'
	.' from aapr_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($aapr_audit);
	$row = mysql_fetch_assoc($result);

	$aapr_OpeningComments	= $row['aapr_OpeningComments'];
	$aapr_Checklist			= $row['aapr_Checklist'];
	$aapr_VerifyLicense		= $row['aapr_VerifyLicense'];
	$aapr_TrackLicense		= $row['aapr_TrackLicense'];
	$aapr_SearchVertical	= $row['aapr_SearchVertical'];
	$aapr_ExcLists			= $row['aapr_ExcLists'];
	$aapr_RevResumes		= $row['aapr_RevResumes'];
	$aapr_ReqRefs			= $row['aapr_ReqRefs'];
	$aapr_ContactRefs		= $row['aapr_ContactRefs'];
	$aapr_eo				= $row['aapr_eo'];
	$aapr_VerifyEO			= $row['aapr_VerifyEO'];
	$aapr_trackeo			= $row['aapr_trackeo'];
	$aapr_DiscPRA			= $row['aapr_DiscPRA'];
	$aapr_DiscPCA			= $row['aapr_DiscPCA'];
	$aapr_ZeroTolerance		= $row['aapr_ZeroTolerance'];
	$aapr_CheckMari			= $row['aapr_CheckMari'];
	$aapr_monav				= $row['aapr_monav'];
	$aapr_monrd				= $row['aapr_monrd'];
	$aapr_qc				= $row['aapr_qc'];
	$aapr_mondocs			= $row['aapr_mondocs'];
	$aapr_ResToExecs		= $row['aapr_ResToExecs'];
	$aapr_thresh			= $row['aapr_thresh'];
	$aapr_freq				= $row['aapr_freq'];

	$ampr_audit = 'select ampr_audit.ConTrans as ampr_contrans,'
	.'ampr_audit.CommonPart as ampr_CommonPart,'
	.'ampr_audit.TurnTimes as ampr_TurnTimes,'
	.'ampr_audit.HighRiskGeo as ampr_HighRiskGeo,'
	.'ampr_audit.AdeqRevHighRisk as ampr_AdeqRevHighRisk,'
	.'ampr_audit.RedFlags as ampr_redflags,'
	.'ampr_audit.AddressAVM as ampr_AddressAVM,'
	.'ampr_audit.AddressFieldRevs as ampr_AddressFieldRevs,'
	.'ampr_audit.BankWide as ampr_bankwide,'
	.'ampr_audit.ConTrans as ampr_ConTrans,'
	.'ampr_audit.CommonPart as ampr_CommonPart,'
	.'ampr_audit.TurnTimes as ampr_TurnTimes,'
	.'ampr_audit.HighRiskGeo as ampr_HighRiskGeo,'
	.'ampr_audit.AdeqRevHighRisk as ampr_AdeqRevHighRisk,'
	.'ampr_audit.RedFlags as ampr_RedFlags,'
	.'ampr_audit.AddressAVM as ampr_AddressAVM,'
	.'ampr_audit.AddressFieldRevs as ampr_AddressFieldRevs,'
	.'ampr_audit.BankWide as ampr_BankWide,'
	.'ampr_audit.ApprovalMethod as ampr_ApprovalMethod'
	.' from ampr_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($ampr_audit);
	$row = mysql_fetch_assoc($result);

	$ampr_contrans			= $row['ampr_contrans'];
	$ampr_CommonPart		= $row['ampr_CommonPart'];
	$ampr_TurnTimes			= $row['ampr_TurnTimes'];
	$ampr_HighRiskGeo		= $row['ampr_HighRiskGeo'];
	$ampr_AdeqRevHighRisk	= $row['ampr_AdeqRevHighRisk'];
	$ampr_redflags			= $row['ampr_redflags'];
	$ampr_AddressAVM		= $row['ampr_AddressAVM'];
	$ampr_AddressFieldRevs	= $row['ampr_AddressFieldRevs'];
	$ampr_bankwide			= $row['ampr_bankwide'];
	$ampr_ConTrans			= $row['ampr_ConTrans'];
	$ampr_CommonPart		= $row['ampr_CommonPart'];
	$ampr_TurnTimes			= $row['ampr_TurnTimes'];
	$ampr_HighRiskGeo		= $row['ampr_HighRiskGeo'];
	$ampr_AdeqRevHighRisk	= $row['ampr_AdeqRevHighRisk'];
	$ampr_RedFlags			= $row['ampr_RedFlags'];
	$ampr_AddressAVM		= $row['ampr_AddressAVM'];
	$ampr_AddressFieldRevs	= $row['ampr_AddressFieldRevs'];
	$ampr_BankWide			= $row['ampr_BankWide'];
	$ampr_ApprovalMethod	= $row['ampr_ApprovalMethod'];

	$cm_audit ='select cm_audit.ManName as cm_ManName,'
	.'cm_audit.ManTimeInMBI as CM_ManTimeInMBI,'
	.'cm_audit.ManTenure as CM_ManTenure,'
	.'cm_audit.ManReportsTo as CM_ManReportsTo,'
	.'cm_audit.FullTimers as CM_FullTimers,'
	.'cm_audit.AvgTenure as CM_AvgTenure,'
	.'cm_audit.AvgMBI as CM_AvgMBI,'
	.'cm_audit.PreHudSent as cm_prehudsent,'
	.'cm_audit.ClosersRevPreHud as cm_ClosersRevPreHud,'
	.'cm_audit.RevEvid as cm_RevEvid,'
	.'cm_audit.RevConcessions as cm_RevConcessions,'
	.'cm_audit.RevPayoffsExist as cm_RevPayoffsExist,'
	.'cm_audit.RevPayoffsNon as cm_RevPayoffsNon,'
	.'cm_audit.RevTaxesFees as cm_RevTaxesFees,'
	.'cm_audit.RevCommissions as cm_RevCommissions,'
	.'cm_audit.RevMatchLiens as cm_RevMatchLiens,'
	.'cm_audit.HudReReview as cm_HudReReview,'
	.'cm_audit.QuestionsProcedure as cm_QuestionsProcedure'
	.' from cm_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($cm_audit);
	$row = mysql_fetch_assoc($result);

	$cm_ManName				= $row['cm_ManName'];
	$CM_ManTimeInMBI		= $row['CM_ManTimeInMBI'];
	$CM_ManTenure			= $row['CM_ManTenure'];
	$CM_ManReportsTo		= $row['CM_ManReportsTo'];
	$CM_FullTimers			= $row['CM_FullTimers'];
	$CM_AvgTenure			= $row['CM_AvgTenure'];
	$CM_AvgMBI				= $row['CM_AvgMBI'];
	$cm_prehudsent			= $row['cm_prehudsent'];
	$cm_ClosersRevPreHud	= $row['cm_ClosersRevPreHud'];
	$cm_RevEvid				= $row['cm_RevEvid'];
	$cm_RevConcessions		= $row['cm_RevConcessions'];
	$cm_RevPayoffsExist		= $row['cm_RevPayoffsExist'];
	$cm_RevPayoffsNon		= $row['cm_RevPayoffsNon'];
	$cm_RevTaxesFees		= $row['cm_RevTaxesFees'];
	$cm_RevCommissions		= $row['cm_RevCommissions'];
	$cm_RevMatchLiens		= $row['cm_RevMatchLiens'];
	$cm_HudReReview			= $row['cm_HudReReview'];
	$cm_QuestionsProcedure	= $row['cm_QuestionsProcedure'];

	$qc_audit ='select qc_audit.ManName as QC_ManName,'
	.'qc_audit.TimeInMBI as QC_TimeInMBI,'
	.'qc_audit.ManTenure as QC_ManTenure,'
	.'qc_audit.ReportsTo as QC_ReportsTo,'
	.'qc_audit.FullTimers as QC_FullTimers,'
	.'qc_audit.PartTimers as QC_PartTimers,'
	.'qc_audit.AvgTenure as QC_AvgTenure,'
	.'qc_audit.AvgYears as QC_AvgYears,'
	.'qc_audit.AvgFilesPerDay as QC_AvgFilesPerDay,'
	.'qc_audit.AvgFilesPerMonth as QC_AvgFilesPerMonth,'
	.'qc_audit.ClosedAudMonthly as qc_ClosedAudMonthly,'
	.'qc_audit.SamplingMethod as qc_SamplingMethod,'
	.'qc_audit.OutsourceVendor as qc_OutsourceVendor,'
	.'qc_audit.TrackFindings as qc_TrackFindings,'
	.'qc_audit.CurrentClosing as qc_CurrentClosing,'
	.'qc_audit.RevEarlyPay as qc_RevEarlyPay,'
	.'qc_audit.PrimReason as qc_PrimReason,'
	.'qc_audit.RevIncomingPurchaseDemands as qc_RevIncomingPurchaseDemands,'
	.'qc_audit.ReasonForRepurchase as qc_ReasonForRepurchase,'
	.'qc_audit.HandleFraudInv as qc_HandleFraudInv,'
	.'qc_audit.PrimaryRiskEval as qc_PrimaryRiskEval,'
	.'qc_audit.LocationsRisk as qc_LocationsRisk,'
	.'qc_audit.ProductTypeRisk as qc_ProductTypeRisk,'
	.'qc_audit.OriginationRisk as qc_OriginationRisk,'
	.'qc_audit.DataTrackingMethod as qc_DataTrackingMethod,'
	.'qc_audit.AuditServicing as qc_AuditServicing,'
	.'qc_audit.FollowHUD as qc_FollowHUD,'
	.'qc_audit.BeyondHUD as qc_BeyondHUD,'
	.'qc_audit.BeyondHUDAreas as qc_BeyondHUDAreas,'
	.'qc_audit.ReferFraud as qc_ReferFraud,'
	.'qc_audit.BranchAuditLocation as qc_BranchAuditLocation,'
	.'qc_audit.ProblemBranches as qc_ProblemBranches,'
	.'qc_audit.ReceiverLoanDetails as qc_ReceiverLoanDetails,'
	.'qc_audit.FindingsToExecs as qc_FindingsToExecs,'
	.'qc_audit.MeetWithExecs as qc_MeetWithExecs,'
	.'qc_audit.AnalyzeExceptionCause as qc_AnalyzeExceptionCause,'
	.'qc_audit.TrendExceptions as qc_TrendExceptions'
	.' from qc_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($qc_audit);
	$row = mysql_fetch_assoc($result);

	$QC_ManName						= $row['QC_ManName'];
	$QC_TimeInMBI					= $row['QC_TimeInMBI'];
	$QC_ManTenure					= $row['QC_ManTenure'];
	$QC_ReportsTo					= $row['QC_ReportsTo'];
	$QC_FullTimers					= $row['QC_FullTimers'];
	$QC_PartTimers					= $row['QC_PartTimers'];
	$QC_AvgTenure					= $row['QC_AvgTenure'];
	$QC_AvgYears					= $row['QC_AvgYears'];
	$QC_AvgFilesPerDay				= $row['QC_AvgFilesPerDay'];
	$QC_AvgFilesPerMonth			= $row['QC_AvgFilesPerMonth'];
	$qc_ClosedAudMonthly			= $row['qc_ClosedAudMonthly'];
	$qc_SamplingMethod				= $row['qc_SamplingMethod'];
	$qc_OutsourceVendor				= $row['qc_OutsourceVendor'];
	$qc_TrackFindings				= $row['qc_TrackFindings'];
	$qc_CurrentClosing				= $row['qc_CurrentClosing'];
	$qc_RevEarlyPay					= $row['qc_RevEarlyPay'];
	$qc_PrimReason					= $row['qc_PrimReason'];
	$qc_RevIncomingPurchaseDemands	= $row['qc_RevIncomingPurchaseDemands'];
	$qc_ReasonForRepurchase			= $row['qc_ReasonForRepurchase'];
	$qc_HandleFraudInv				= $row['qc_HandleFraudInv'];
	$qc_PrimaryRiskEval				= $row['qc_PrimaryRiskEval'];
	$qc_LocationsRisk				= $row['qc_LocationsRisk'];
	$qc_ProductTypeRisk				= $row['qc_ProductTypeRisk'];
	$qc_OriginationRisk				= $row['qc_OriginationRisk'];
	$qc_DataTrackingMethod			= $row['qc_DataTrackingMethod'];
	$qc_AuditServicing				= $row['qc_AuditServicing'];
	$qc_FollowHUD					= $row['qc_FollowHUD'];
	$qc_BeyondHUD					= $row['qc_BeyondHUD'];
	$qc_BeyondHUDAreas				= $row['qc_BeyondHUDAreas'];
	$qc_ReferFraud					= $row['qc_ReferFraud'];
	$qc_BranchAuditLocation			= $row['qc_BranchAuditLocation'];
	$qc_ProblemBranches				= $row['qc_ProblemBranches'];
	$qc_ReceiverLoanDetails			= $row['qc_ReceiverLoanDetails'];
	$qc_FindingsToExecs				= $row['qc_FindingsToExecs'];
	$qc_MeetWithExecs				= $row['qc_MeetWithExecs'];
	$qc_AnalyzeExceptionCause		= $row['qc_AnalyzeExceptionCause'];
	$qc_TrendExceptions				= $row['qc_TrendExceptions'];

	$susrej_audit ='select susrej_audit.Rejected as susrej_Rejected,'
	.'susrej_audit.Applic as susrej_Applic,'
	.'susrej_audit.Reasons as susrej_Reasons'
	.' from susrej_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($susrej_audit);
	$row = mysql_fetch_assoc($result);

	$susrej_Rejected	= $row['susrej_Rejected'];
	$susrej_Applic		= $row['susrej_Applic'];
	$susrej_Reasons		= $row['susrej_Reasons'];

	$bag_audit = 'select bag_audit.LimitLiability as bag_LimitLiability,'
	.'bag_audit.bar as bag_bar,'
	.'bag_audit.InvestorScorecard as bag_InvestorScorecard'
	.' from bag_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($bag_audit);
	$row = mysql_fetch_assoc($result);

	$bag_LimitLiability		= $row['bag_LimitLiability'];
	$bag_bar				= $row['bag_bar'];
	$bag_InvestorScorecard	= $row['bag_InvestorScorecard'];

	$fi_audit = 'select fi_audit.FBC as fi_FBC,'
	.'fi_audit.Name as FI_Name,'
	.'fi_audit.Address as FI_Address,'
	.'fi_audit.Amount as FI_Amount,'
	.'fi_audit.Term as fi_Term,'
	.'fi_audit.PolicyNum as fi_PolicyNum'
	.' from fi_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($fi_audit);
	$row = mysql_fetch_assoc($result);

	$fi_FBC			= $row['fi_FBC'];
	$FI_Name		= $row['FI_Name'];
	$FI_Address		= $row['FI_Address'];
	$FI_Amount		= $row['FI_Amount'];
	$fi_Term		= $row['fi_Term'];
	$fi_PolicyNum	= $row['fi_PolicyNum'];

	$isr_audit = 'select isr_audit.Provider as isr_Provider,'
	.'isr_audit.SusItems as isr_SusItems,'
	.'isr_audit.RepItems as isr_RepItems,'
	.'isr_audit.DelItems as isr_DelItems,'
	.'isr_audit.Issues as isr_Issues,'
	.'isr_audit.EarlyPay as isr_EarlyPay'
	.' from isr_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($isr_audit);
	$row = mysql_fetch_assoc($result);

	$isr_Provider	= $row['isr_Provider'];
	$isr_SusItems	= $row['isr_SusItems'];
	$isr_RepItems	= $row['isr_RepItems'];
	$isr_DelItems	= $row['isr_DelItems'];
	$isr_Issues		= $row['isr_Issues'];
	$isr_EarlyPay	= $row['isr_EarlyPay'];

	$qcppp_audit = 'select qcppp_audit.MeetInd as qcppp_MeetInd,'
	.'qcppp_audit.ExecSum as qcppp_ExecSum,'
	.'qcppp_audit.LoansStopped as qcppp_LoansStopped,'
	.'qcppp_audit.AvoidToExecs as qcppp_AvoidToExecs'
	.' from qcppp_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($qcppp_audit);
	$row = mysql_fetch_assoc($result);

	$qcppp_MeetInd		= $row['qcppp_MeetInd'];
	$qcppp_ExecSum		= $row['qcppp_ExecSum'];
	$qcppp_LoansStopped = $row['qcppp_LoansStopped'];
	$qcppp_AvoidToExecs = $row['qcppp_AvoidToExecs'];

	$t590_audit = 'select t590_audit.TVS1 as t590_TVS1,'
	.'t590_audit.TVS1P1 as t590_TVS1P1,'
	.'t590_audit.TVS1C1 as t590_TVS1C1,'
	.'t590_audit.TVS1P2 as t590_TVS1P2,'
	.'t590_audit.TVS1C2 as t590_TVS1C2,'
	.'t590_audit.TVS2 as t590_TVS2,'
	.'t590_audit.TVS2P1 as t590_TVS2P1,'
	.'t590_audit.TVS2C1 as t590_TVS2C1,'
	.'t590_audit.TVS2P2 as t590_TVS2P2,'
	.'t590_audit.TVS2C2 as t590_TVS2C2,'
	.'t590_audit.TVS3 as t590_TVS3,'
	.'t590_audit.TVS3P1 as t590_TVS3P1,'
	.'t590_audit.TVS3C1 as t590_TVS3C1,'
	.'t590_audit.TVS3P2 as t590_TVS3P2,'
	.'t590_audit.TVS3C2 as t590_TVS3C2,'
	.'t590_audit.TVS4 as t590_TVS4,'
	.'t590_audit.TVS4P1 as t590_TVS4P1,'
	.'t590_audit.TVS4C1 as t590_TVS4C1,'
	.'t590_audit.TVS4P2 as t590_TVS4P2,'
	.'t590_audit.TVS4C2 as t590_TVS4C2,'
	.'t590_audit.TVS5 as t590_TVS5,'
	.'t590_audit.TVS5P1 as t590_TVS5P1,'
	.'t590_audit.TVS5C1 as t590_TVS5C1,'
	.'t590_audit.TVS5P2 as t590_TVS5P2,'
	.'t590_audit.TVS5C2 as t590_TVS5C2'
	.' from t590_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($t590_audit);
	$row = mysql_fetch_assoc($result);

	$t590_TVS1		= $row['t590_TVS1'];
	$t590_TVS1P1	= $row['t590_TVS1P1'];
	$t590_TVS1C1	= $row['t590_TVS1C1'];
	$t590_TVS1P2	= $row['t590_TVS1P2'];
	$t590_TVS1C2	= $row['t590_TVS1C2'];
	$t590_TVS2		= $row['t590_TVS2'];
	$t590_TVS2P1	= $row['t590_TVS2P1'];
	$t590_TVS2C1	= $row['t590_TVS2C1'];
	$t590_TVS2P2	= $row['t590_TVS2P2'];
	$t590_TVS2C2	= $row['t590_TVS2C2'];
	$t590_TVS3		= $row['t590_TVS3'];
	$t590_TVS3P1	= $row['t590_TVS3P1'];
	$t590_TVS3C1	= $row['t590_TVS3C1'];
	$t590_TVS3P2	= $row['t590_TVS3P2'];
	$t590_TVS3C2	= $row['t590_TVS3C2'];
	$t590_TVS4		= $row['t590_TVS4'];
	$t590_TVS4P1	= $row['t590_TVS4P1'];
	$t590_TVS4C1	= $row['t590_TVS4C1'];
	$t590_TVS4P2	= $row['t590_TVS4P2'];
	$t590_TVS4C2	= $row['t590_TVS4C2'];
	$t590_TVS5		= $row['t590_TVS5'];
	$t590_TVS5P1	= $row['t590_TVS5P1'];
	$t590_TVS5C1	= $row['t590_TVS5C1'];
	$t590_TVS5P2	= $row['t590_TVS5P2'];
	$t590_TVS5C2	= $row['t590_TVS5C2'];

	$bam_audit = 'select bam_audit.PullCredRep as bam_PullCredRep,'
	.'bam_audit.SearchVert as bam_SearchVert,'
	.'bam_audit.RevExc as bam_RevExc,'
	.'bam_audit.RevResumes as bam_RevResumes,'
	.'bam_audit.RevRefs as bam_RevRefs,'
	.'bam_audit.RevFin as bam_RevFin,'
	.'bam_audit.RevEO as bam_RevEO,'
	.'bam_audit.DiscRegAct as bam_DiscRegAct,'
	.'bam_audit.DiscCivAct as bam_DiscCivAct,'
	.'bam_audit.ZeroTol as bam_ZeroTol,'
	.'bam_audit.MonPTR as bam_MonPTR,'
	.'bam_audit.MonEPD as bam_MonEPD,'
	.'bam_audit.MonEP as bam_MonEP,'
	.'bam_audit.MonRD as bam_MonRD,'
	.'bam_audit.MonQC as bam_MonQC,'
	.'bam_audit.MonDoc as bam_MonDoc,'
	.'bam_audit.ResToExecs as bam_ResToExecs,'
	.'bam_audit.Thresh as bam_Thresh,'
	.'bam_audit.Freq as bam_Freq'
	.' from bam_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($bam_audit);
	$row = mysql_fetch_assoc($result);

	$bam_PullCredRep	= $row['bam_PullCredRep'];
	$bam_SearchVert		= $row['bam_SearchVert'];
	$bam_RevExc			= $row['bam_RevExc'];
	$bam_RevResumes		= $row['bam_RevResumes'];
	$bam_RevRefs		= $row['bam_RevRefs'];
	$bam_RevFin			= $row['bam_RevFin'];
	$bam_RevEO			= $row['bam_RevEO'];
	$bam_DiscRegAct		= $row['bam_DiscRegAct'];
	$bam_DiscCivAct		= $row['bam_DiscCivAct'];
	$bam_ZeroTol		= $row['bam_ZeroTol'];
	$bam_MonPTR			= $row['bam_MonPTR'];
	$bam_MonEPD			= $row['bam_MonEPD'];
	$bam_MonEP			= $row['bam_MonEP'];
	$bam_MonRD			= $row['bam_MonRD'];
	$bam_MonQC			= $row['bam_MonQC'];
	$bam_MonDoc			= $row['bam_MonDoc'];
	$bam_ResToExecs		= $row['bam_ResToExecs'];
	$bam_Thresh			= $row['bam_Thresh'];
	$bam_Freq			= $row['bam_Freq'];

	$fp_audit = 'select fp_audit.ManName as FP_ManName,'
	.'fp_audit.TimeInIndustry as FP_TimeInIndustry,'
	.'fp_audit.ManTenure as FP_ManTenure,'
	.'fp_audit.ReportsTo as FP_ReportsTo,'
	.'fp_audit.FullTimers as FP_FullTimers,'
	.'fp_audit.AvgTenure as FP_AvgTenure,'
	.'fp_audit.AvgYears as FP_AvgYears,'
	.'fp_audit.AvgFilesPerDay as FP_AvgFilesPerDay,'
	.'fp_audit.FilesAvgMonth as FP_FilesAvgMonth,'
	.'fp_audit.TrackFindings as FP_TrackFindings,'
	.'fp_audit.RevEarlyPay as FP_RevEarlyPay,'
	.'fp_audit.ReasonForDefault as FP_ReasonForDefault,'
	.'fp_audit.ReviewDemands as FP_ReviewDemands,'
	.'fp_audit.RelativeReasons as FP_RelativeReasons,'
	.'fp_audit.PrimeRisk as FP_PrimeRisk,'
	.'fp_audit.RiskLocale as FP_RiskLocale,'
	.'fp_audit.RiskOrigination as FP_RiskOrigination,'
	.'fp_audit.ProbBranchesRec as FP_ProbBranchesRec,'
	.'fp_audit.ProbBranchesDet as FP_ProbBranchesDet,'
	.'fp_audit.FindToExecs as FP_FindToExecs,'
	.'fp_audit.MeetWithExecs as FP_MeetWithExecs,'
	.'fp_audit.ReportsIncRecs as FP_ReportsIncRecs,'
	.'fp_audit.FindingsTrended as FP_FindingsTrended,'
	.'fp_audit.PreventionTools as FP_PreventionTools,'
	.'fp_audit.ReferralProcess as FP_ReferralProcess,'
	.'fp_audit.ReferralsMonth as FP_ReferralsMonth,'
	.'fp_audit.ProcFraudChklst as FP_ProcFraudChklst,'
	.'fp_audit.UnderFraudChklst as FP_UnderFraudChklst,'
	.'fp_audit.CloserFraudChklist as FP_CloserFraudChklist,'
	.'fp_audit.ProvideFraudTraining as FP_ProvideFraudTraining,'
	.'fp_audit.TrainingLastTwelve as FP_TrainingLastTwelve,'
	.'fp_audit.OpenPositions as FP_OpenPositions,'
	.'fp_audit.ReceivesFFReports as FP_ReceivesFFReports,'
	.'fp_audit.RiskPT as FP_RiskPT'
	.' from fp_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($fp_audit);
	$row = mysql_fetch_assoc($result);

	$FP_ManName					= $row['FP_ManName'];
	$FP_TimeInIndustry			= $row['FP_TimeInIndustry'];
	$FP_ManTenure				= $row['FP_ManTenure'];
	$FP_ReportsTo				= $row['FP_ReportsTo'];
	$FP_FullTimers				= $row['FP_FullTimers'];
	$FP_AvgTenure				= $row['FP_AvgTenure'];
	$FP_AvgYears				= $row['FP_AvgYears'];
	$FP_AvgFilesPerDay			= $row['FP_AvgFilesPerDay'];
	$FP_FilesAvgMonth			= $row['FP_FilesAvgMonth'];
	$FP_TrackFindings			= $row['FP_TrackFindings'];
	$FP_RevEarlyPay				= $row['FP_RevEarlyPay'];
	$FP_ReasonForDefault		= $row['FP_ReasonForDefault'];
	$FP_ReviewDemands			= $row['FP_ReviewDemands'];
	$FP_RelativeReasons			= $row['FP_RelativeReasons'];
	$FP_PrimeRisk				= $row['FP_PrimeRisk'];
	$FP_RiskLocale				= $row['FP_RiskLocale'];
	$FP_RiskOrigination			= $row['FP_RiskOrigination'];
	$FP_ProbBranchesRec			= $row['FP_ProbBranchesRec'];
	$FP_ProbBranchesDet			= $row['FP_ProbBranchesDet'];
	$FP_FindToExecs				= $row['FP_FindToExecs'];
	$FP_MeetWithExecs			= $row['FP_MeetWithExecs'];
	$FP_ReportsIncRecs			= $row['FP_ReportsIncRecs'];
	$FP_FindingsTrended			= $row['FP_FindingsTrended'];
	$FP_PreventionTools			= $row['FP_PreventionTools'];
	$FP_ReferralProcess			= $row['FP_ReferralProcess'];
	$FP_ReferralsMonth			= $row['FP_ReferralsMonth'];
	$FP_ProcFraudChklst			= $row['FP_ProcFraudChklst'];
	$FP_UnderFraudChklst		= $row['FP_UnderFraudChklst'];
	$FP_CloserFraudChklist		= $row['FP_CloserFraudChklist'];
	$FP_ProvideFraudTraining	= $row['FP_ProvideFraudTraining'];
	$FP_TrainingLastTwelve		= $row['FP_TrainingLastTwelve'];
	$FP_OpenPositions			= $row['FP_OpenPositions'];
	$FP_ReceivesFFReports		= $row['FP_ReceivesFFReports'];
	$FP_RiskPT					= $row['FP_RiskPT'];

	$opchk_audit = 'select opchk_audit.ContainVVOE as opchk_ContainVVOE,'
	.'opchk_audit.BizLic as opchk_BizLic,'
	.'opchk_audit.4506T as opchk_4506T,'
	.'opchk_audit.HUD1 as opchk_HUD1,'
	.'opchk_audit.CredRep as opchk_CredRep,'
	.'opchk_audit.SeasonFunds as opchk_SeasonFunds,'
	.'opchk_audit.Ineligible as opchk_Ineligible,'
	.'opchk_audit.CH180 as opchk_CH180,'
	.'opchk_audit.NoteIncrease as opchk_NoteIncrease,'
	.'opchk_audit.PrevTransProp as opchk_PrevTransProp,'
	.'opchk_audit.PrevTransBorrower as opchk_PrevTransBorrower,'
	.'opchk_audit.AgentAcceptFunds as opchk_AgentAcceptFunds,'
	.'opchk_audit.AgentAccept1003 as opchk_AgentAccept1003,'
	.'opchk_audit.Exception as opchk_Exception'
	.' from opchk_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($opchk_audit);
	$row = mysql_fetch_assoc($result);

	$opchk_ContainVVOE			= $row['opchk_ContainVVOE'];
	$opchk_BizLic				= $row['opchk_BizLic'];
	$opchk_4506T				= $row['opchk_4506T'];
	$opchk_HUD1					= $row['opchk_HUD1'];
	$opchk_CredRep				= $row['opchk_CredRep'];
	$opchk_SeasonFunds			= $row['opchk_SeasonFunds'];
	$opchk_Ineligible			= $row['opchk_Ineligible'];
	$opchk_CH180				= $row['opchk_CH180'];
	$opchk_NoteIncrease			= $row['opchk_NoteIncrease'];
	$opchk_PrevTransProp		= $row['opchk_PrevTransProp'];
	$opchk_PrevTransBorrower	= $row['opchk_PrevTransBorrower'];
	$opchk_AgentAcceptFunds		= $row['opchk_AgentAcceptFunds'];
	$opchk_AgentAccept1003		= $row['opchk_AgentAccept1003'];
	$opchk_Exception			= $row['opchk_Exception'];

	$atpr_audit = 'select atpr_audit.SpecProc as atpr_SpecProc,'
	.'atpr_audit.TermParams as atpr_TermParams,'
	.'atpr_audit.ProdAuth as atpr_ProdAuth,'
	.'atpr_audit.TermCommun as atpr_TermCommun'
	.' from atpr_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($atpr_audit);
	$row = mysql_fetch_assoc($result);

	$atpr_SpecProc		= $row['atpr_SpecProc'];
	$atpr_TermParams	= $row['atpr_TermParams'];
	$atpr_ProdAuth		= $row['atpr_ProdAuth'];
	$atpr_TermCommun	= $row['atpr_TermCommun'];

	$ca_audit = 'select ca_audit.ManName as CA_ManName,'
	.'ca_audit.TimeInMBI as CA_TimeInMBI,'
	.'ca_audit.Tenure as CA_Tenure,'
	.'ca_audit.ReportsTo as CA_ReportsTo,'
	.'ca_audit.FullTimers as CA_FullTimers,'
	.'ca_audit.TeamFuncs as ca_TeamFuncs,'
	.'ca_audit.AvgTenure as CA_AvgTenure,'
	.'ca_audit.AvgYearsMBI as CA_AvgYearsMBI,'
	.'ca_audit.PartTimers as CA_PartTimers,'
	.'ca_audit.LicApp as ca_LicApp,'
	.'ca_audit.AppAppProc as ca_AppAppProc,'
	.'ca_audit.ProceduresObtained as ca_ProceduresObtained,'
	.'ca_audit.HowManyApp as ca_HowManyApp,'
	.'ca_audit.SysControls as ca_SysControls,'
	.'ca_audit.ProdAuth as ca_ProdAuth,'
	.'ca_audit.AppraisalOrder as ca_AppraisalOrder,'
	.'ca_audit.TrackTrans as ca_TrackTrans,'
	.'ca_audit.HighVol as ca_HighVol,'
	.'ca_audit.TrackAdditionalPart as ca_TrackAdditionalPart,'
	.'ca_audit.DiscoveredConcentrations as ca_DiscoveredConcentrations,'
	.'ca_audit.AvgCompletionTime as ca_AvgCompletionTime,'
	.'ca_audit.IdentHighRiskMarkets as ca_IdentHighRiskMarkets,'
	.'ca_audit.HighRiskMarkets as ca_HighRiskMarkets,'
	.'ca_audit.HighRiskAppTypes as ca_HighRiskAppTypes,'
	.'ca_audit.AppTypeParams as ca_AppTypeParams,'
	.'ca_audit.ProdAuthority as ca_ProdAuthority,'
	.'ca_audit.AppRevChk as ca_AppRevChk,'
	.'ca_audit.SpecDutiesReview as ca_SpecDutiesReview,'
	.'ca_audit.SpecDutiesDetail as ca_SpecDutiesDetail,'
	.'ca_audit.AppLocHandling as ca_AppLocHandling,'
	.'ca_audit.FullAppAvgRevs as ca_FullAppAvgRevs,'
	.'ca_audit.FilesAutoRevs as ca_FilesAutoRevs,'
	.'ca_audit.ProdSignoff as ca_ProdSignoff,'
	.'ca_audit.InvestorPreApp as ca_InvestorPreApp,'
	.'ca_audit.TrackExceptions as ca_TrackExceptions,'
	.'ca_audit.ExceptDetail as ca_ExceptDetail,'
	.'ca_audit.WhoApprovesGuide as ca_WhoApprovesGuide,'
	.'ca_audit.TrainingReceived as ca_TrainingReceived,'
	.'ca_audit.AccessFraudTools as ca_AccessFraudTools,'
	.'ca_audit.FraudToolsDetail as ca_FraudToolsDetail,'
	.'ca_audit.CanTrain as ca_CanTrain,'
	.'ca_audit.FraudChecklists as ca_FraudChecklists,'
	.'ca_audit.RevRedFlags as ca_RevRedFlags,'
	.'ca_audit.FlagAutoManual as ca_FlagAutoManual,'
	.'ca_audit.ChecklistDetail as ca_ChecklistDetail,'
	.'ca_audit.CheckIneligible as ca_CheckIneligible,'
	.'ca_audit.IneligibleDoc as ca_IneligibleDoc,'
	.'ca_audit.ListsFormat as ca_ListsFormat,'
	.'ca_audit.UsingAVM as ca_UsingAVM,'
	.'ca_audit.AVMParams as ca_AVMParams,'
	.'ca_audit.AVMTesting as ca_AVMTesting,'
	.'ca_audit.RelianceOnAVM as ca_RelianceOnAVM,'
	.'ca_audit.AVMHowOften as ca_AVMHowOften,'
	.'ca_audit.VendorOrInternalAVM as ca_VendorOrInternalAVM,'
	.'ca_audit.RealTimeDev as ca_RealTimeDev,'
	.'ca_audit.MSADev as ca_MSADev,'
	.'ca_audit.MSADevNotified as ca_MSADevNotified,'
	.'ca_audit.ImpactAllVendors as ca_ImpactAllVendors,'
	.'ca_audit.Analytics as ca_Analytics,'
	.'ca_audit.FieldRevParms as ca_FieldRevParms,'
	.'ca_audit.ObtainBPO as ca_ObtainBPO,'
	.'ca_audit.ParamsBPO as ca_ParamsBPO,'
	.'ca_audit.TrackDG as ca_TrackDG,'
	.'ca_audit.EffectDG as ca_EffectDG,'
	.'ca_audit.BankWideRep as ca_BankWideRep,'
	.'ca_audit.SampleRep as ca_SampleRep,'
	.'ca_audit.RepReccs as ca_RepReccs,'
	.'ca_audit.VarInfo as ca_VarInfo,'
	.'ca_audit.RepAppInfo as ca_RepAppInfo,'
	.'ca_audit.RepRevProc as ca_RepRevProc,'
	.'ca_audit.TrackRepApp as ca_TrackRepApp,'
	.'ca_audit.MonLic as ca_MonLic,'
	.'ca_audit.UpdateLicProc as ca_UpdateLicProc,'
	.'ca_audit.AppTermProc as ca_AppTermProc,'
	.'ca_audit.ProdAuthDeg as ca_ProdAuthDeg,'
	.'ca_audit.SysProhibit as ca_SysProhibit,'
	.'ca_audit.InternalComm as ca_InternalComm,'
	.'ca_audit.ImpactReps as ca_ImpactReps,'
	.'ca_audit.ScoreUpdFreq as ca_ScoreUpdFreq,'
	.'ca_audit.ScorEffectTerm as ca_ScorEffectTerm,'
	.'ca_audit.ModAnalytics as ca_ModAnalytics,'
	.'ca_audit.PortScorCreat as ca_PortScorCreat,'
	.'ca_audit.AdjMod as ca_AdjMod,'
	.'ca_audit.AppBlack as ca_AppBlack,'
	.'ca_audit.TwoApp as ca_TwoApp,'
	.'ca_audit.TwoAppMark as ca_TwoAppMark,'
	.'ca_audit.TransHist as ca_TransHist,'
	.'ca_audit.TransHistTools as ca_TransHistTools,'
	.'ca_audit.FraudRefProc as ca_FraudRefProc,'
	.'ca_audit.InLightofHVCC as ca_InLightofHVCC'
	.' from ca_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($ca_audit);
	$row = mysql_fetch_assoc($result);

	$CA_ManName						= $row['CA_ManName'];
	$CA_TimeInMBI					= $row['CA_TimeInMBI'];
	$CA_Tenure						= $row['CA_Tenure'];
	$CA_ReportsTo					= $row['CA_ReportsTo'];
	$CA_FullTimers					= $row['CA_FullTimers'];
	$ca_TeamFuncs					= $row['ca_TeamFuncs'];
	$CA_AvgTenure					= $row['CA_AvgTenure'];
	$CA_AvgYearsMBI					= $row['CA_AvgYearsMBI'];
	$CA_PartTimers					= $row['CA_PartTimers'];
	$ca_LicApp						= $row['ca_LicApp'];
	$ca_AppAppProc					= $row['ca_AppAppProc'];
	$ca_ProceduresObtained			= $row['ca_ProceduresObtained'];
	$ca_HowManyApp					= $row['ca_HowManyApp'];
	$ca_SysControls					= $row['ca_SysControls'];
	$ca_ProdAuth					= $row['ca_ProdAuth'];
	$ca_AppraisalOrder				= $row['ca_AppraisalOrder'];
	$ca_TrackTrans					= $row['ca_TrackTrans'];
	$ca_HighVol						= $row['ca_HighVol'];
	$ca_TrackAdditionalPart			= $row['ca_TrackAdditionalPart'];
	$ca_DiscoveredConcentrations	= $row['ca_DiscoveredConcentrations'];
	$ca_AvgCompletionTime			= $row['ca_AvgCompletionTime'];
	$ca_IdentHighRiskMarkets		= $row['ca_IdentHighRiskMarkets'];
	$ca_HighRiskMarkets				= $row['ca_HighRiskMarkets'];
	$ca_HighRiskAppTypes			= $row['ca_HighRiskAppTypes'];
	$ca_AppTypeParams				= $row['ca_AppTypeParams'];
	$ca_ProdAuthority				= $row['ca_ProdAuthority'];
	$ca_AppRevChk					= $row['ca_AppRevChk'];
	$ca_SpecDutiesReview			= $row['ca_SpecDutiesReview'];
	$ca_SpecDutiesDetail			= $row['ca_SpecDutiesDetail'];
	$ca_AppLocHandling				= $row['ca_AppLocHandling'];
	$ca_FullAppAvgRevs				= $row['ca_FullAppAvgRevs'];
	$ca_FilesAutoRevs				= $row['ca_FilesAutoRevs'];
	$ca_ProdSignoff					= $row['ca_ProdSignoff'];
	$ca_InvestorPreApp				= $row['ca_InvestorPreApp'];
	$ca_TrackExceptions				= $row['ca_TrackExceptions'];
	$ca_ExceptDetail				= $row['ca_ExceptDetail'];
	$ca_WhoApprovesGuide			= $row['ca_WhoApprovesGuide'];
	$ca_TrainingReceived			= $row['ca_TrainingReceived'];
	$ca_AccessFraudTools			= $row['ca_AccessFraudTools'];
	$ca_FraudToolsDetail			= $row['ca_FraudToolsDetail'];
	$ca_CanTrain					= $row['ca_CanTrain'];
	$ca_FraudChecklists				= $row['ca_FraudChecklists'];
	$ca_RevRedFlags					= $row['ca_RevRedFlags'];
	$ca_FlagAutoManual				= $row['ca_FlagAutoManual'];
	$ca_ChecklistDetail				= $row['ca_ChecklistDetail'];
	$ca_CheckIneligible				= $row['ca_CheckIneligible'];
	$ca_IneligibleDoc				= $row['ca_IneligibleDoc'];
	$ca_ListsFormat					= $row['ca_ListsFormat'];
	$ca_UsingAVM					= $row['ca_UsingAVM'];
	$ca_AVMParams					= $row['ca_AVMParams'];
	$ca_AVMTesting					= $row['ca_AVMTesting'];
	$ca_RelianceOnAVM				= $row['ca_RelianceOnAVM'];
	$ca_AVMHowOften					= $row['ca_AVMHowOften'];
	$ca_VendorOrInternalAVM			= $row['ca_VendorOrInternalAVM'];
	$ca_RealTimeDev					= $row['ca_RealTimeDev'];
	$ca_MSADev						= $row['ca_MSADev'];
	$ca_MSADevNotified				= $row['ca_MSADevNotified'];
	$ca_ImpactAllVendors			= $row['ca_ImpactAllVendors'];
	$ca_Analytics					= $row['ca_Analytics'];
	$ca_FieldRevParms				= $row['ca_FieldRevParms'];
	$ca_ObtainBPO					= $row['ca_ObtainBPO'];
	$ca_ParamsBPO					= $row['ca_ParamsBPO'];
	$ca_TrackDG						= $row['ca_TrackDG'];
	$ca_EffectDG					= $row['ca_EffectDG'];
	$ca_EffectDG					= $row['ca_BankWideRep'];
	$ca_SampleRep					= $row['ca_SampleRep'];
	$ca_RepReccs					= $row['ca_RepReccs'];
	$ca_VarInfo						= $row['ca_VarInfo'];
	$ca_RepAppInfo					= $row['ca_RepAppInfo'];
	$ca_RepRevProc					= $row['ca_RepRevProc'];
	$ca_TrackRepApp					= $row['ca_TrackRepApp'];
	$ca_MonLic						= $row['ca_MonLic'];
	$ca_UpdateLicProc				= $row['ca_UpdateLicProc'];
	$ca_AppTermProc					= $row['ca_AppTermProc'];
	$ca_ProdAuthDeg					= $row['ca_ProdAuthDeg'];
	$ca_SysProhibit					= $row['ca_SysProhibit'];
	$ca_InternalComm				= $row['ca_InternalComm'];
	$ca_ImpactReps					= $row['ca_ImpactReps'];
	$ca_ScoreUpdFreq				= $row['ca_ScoreUpdFreq'];
	$ca_ScorEffectTerm				= $row['ca_ScorEffectTerm'];
	$ca_ModAnalytics				= $row['ca_ModAnalytics'];
	$ca_PortScorCreat				= $row['ca_PortScorCreat'];
	$ca_AdjMod						= $row['ca_AdjMod'];
	$ca_AppBlack					= $row['ca_AppBlack'];
	$ca_TwoApp						= $row['ca_TwoApp'];
	$ca_TwoAppMark					= $row['ca_TwoAppMark'];
	$ca_TransHist					= $row['ca_TransHist'];
	$ca_TransHistTools				= $row['ca_TransHistTools'];
	$ca_FraudRefProc				= $row['ca_FraudRefProc'];
	$ca_InLightofHVCC				= $row['ca_InLightofHVCC'];

	$invrefs_audit = 'select invrefs_audit.ref1name as invrefs_ref1name,'
	.'invrefs_audit.ref1contact as invrefs_ref1contact,'
	.'invrefs_audit.ref1email as invrefs_ref1email,'
	.'invrefs_audit.ref1phone as invrefs_ref1phone,'
	.'invrefs_audit.ref2name as invrefs_ref2name,'
	.'invrefs_audit.ref2contact as invrefs_ref2contact,'
	.'invrefs_audit.ref2email as invrefs_ref2email,'
	.'invrefs_audit.ref2phone as invrefs_ref2phone,'
	.'invrefs_audit.ref3name as invrefs_ref3name,'
	.'invrefs_audit.ref3contact as invrefs_ref3contact,'
	.'invrefs_audit.ref3email as invrefs_ref3email,'
	.'invrefs_audit.ref3phone as invrefs_ref3phone,'
	.'invrefs_audit.ref4name as invrefs_ref4name,'
	.'invrefs_audit.ref4contact as invrefs_ref4contact,'
	.'invrefs_audit.ref4email as invrefs_ref4email,'
	.'invrefs_audit.ref4phone as invrefs_ref4phone,'
	.'invrefs_audit.ref5name as invrefs_ref5name,'
	.'invrefs_audit.ref5contact as invrefs_ref5contact,'
	.'invrefs_audit.ref5email as invrefs_ref5email,'
	.'invrefs_audit.ref5phone as invrefs_ref5phone'
	.' from invrefs_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($invrefs_audit);
	$row = mysql_fetch_assoc($result);

	$invrefs_ref1name		= $row['invrefs_ref1name'];
	$invrefs_ref1contact	= $row['invrefs_ref1contact'];
	$invrefs_ref1email		= $row['invrefs_ref1email'];
	$invrefs_ref1phone		= $row['invrefs_ref1phone'];
	$invrefs_ref2name		= $row['invrefs_ref2name'];
	$invrefs_ref2contact	= $row['invrefs_ref2contact'];
	$invrefs_ref2email		= $row['invrefs_ref2email'];
	$invrefs_ref2phone		= $row['invrefs_ref2phone'];
	$invrefs_ref3name		= $row['invrefs_ref3name'];
	$invrefs_ref3contact	= $row['invrefs_ref3contact'];
	$invrefs_ref3email		= $row['invrefs_ref3email'];
	$invrefs_ref3phone		= $row['invrefs_ref3phone'];
	$invrefs_ref4name		= $row['invrefs_ref4name'];
	$invrefs_ref4contact	= $row['invrefs_ref4contact'];
	$invrefs_ref4email		= $row['invrefs_ref4email'];
	$invrefs_ref4phone		= $row['invrefs_ref4phone'];
	$invrefs_ref5name		= $row['invrefs_ref5name'];
	$invrefs_ref5contact	= $row['invrefs_ref5contact'];
	$invrefs_ref5email		= $row['invrefs_ref5email'];
	$invrefs_ref5phone		= $row['invrefs_ref5phone'];

	$corag_audit = 'select corag_audit.LimitLiability as corag_LimitLiability'
	.' from corag_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($corag_audit);
	$row = mysql_fetch_assoc($result);

	$corag_LimitLiability = $row['corag_LimitLiability'];

	$fr_audit = 'select fr_audit.VVOECompliance as FR_VVOECompliance,'
	.'fr_audit.VVOEPerformed as FR_VVOEPerformed,'
	.'fr_audit.VVOESource as FR_VVOESource,'
	.'fr_audit.BizLicense as FR_BizLicense,'
	.'fr_audit.CreditRepComp as FR_CreditRepComp,'
	.'fr_audit.FTCComp as FR_FTCComp,'
	.'fr_audit.HUD1Comp as FR_HUD1Comp,'
	.'fr_audit.SellerOwnerComp as FR_SellerOwnerComp,'
	.'fr_audit.IEComp as FR_IEComp,'
	.'fr_audit.4506TComp as FR_4506TComp,'
	.'fr_audit.CIComp as FR_CIComp,'
	.'fr_audit.180TComp as FR_180TComp,'
	.'fr_audit.25Percent as FR_25Percent,'
	.'fr_audit.BTRANComp as FR_BTRANComp,'
	.'fr_audit.PTRANComp as FR_PTRANComp,'
	.'fr_audit.AssetsComp as FR_AssetsComp,'
	.'fr_audit.FilesRev as FR_FilesRev,'
	.'fr_audit.TransactionType as FR_TransactionType,'
	.'fr_audit.RateTerm as FR_RateTerm,'
	.'fr_audit.StreamLine as FR_StreamLine,'
	.'fr_audit.Cashout as FR_Cashout,'
	.'fr_audit.OwnerOccupied as FR_OwnerOccupied,'
	.'fr_audit.SecondHome as FR_SecondHome,'
	.'fr_audit.Investment as FR_Investment,'
	.'fr_audit.Retail as FR_Retail,'
	.'fr_audit.Wholesale as FR_Wholesale,'
	.'fr_audit.Correspondent as FR_Correspondent,'
	.'fr_audit.Documentation as FR_Documentation,'
	.'fr_audit.StreamFHA as FR_StreamFHA,'
	.'fr_audit.SISA as FR_SISA,'
	.'fr_audit.NINA as FR_NINA,'
	.'fr_audit.SIVA as FR_SIVA,'
	.'fr_audit.NIVA as FR_NIVA,'
	.'fr_audit.AvgFICO as FR_AvgFICO,'
	.'fr_audit.AvgLTV as FR_AvgLTV,'
	.'fr_audit.AvgCLTV as FR_AvgCLTV,'
	.'fr_audit.FirstLien as FR_FirstLien,'
	.'fr_audit.StatedDoc as FR_StatedDoc,'
	.'fr_audit.SRFC as FR_SRFC,'
	.'fr_audit.Acceptable as FR_Acceptable,'
	.'fr_audit.Elevated as FR_Elevated,'
	.'fr_audit.Significant as FR_Significant'
	.' from fr_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($fr_audit);
	$row = mysql_fetch_assoc($result);

	$FR_VVOECompliance		= $row['FR_VVOECompliance'];
	$FR_VVOEPerformed		= $row['FR_VVOEPerformed'];
	$FR_VVOESource			= $row['FR_VVOESource'];
	$FR_BizLicense			= $row['FR_BizLicense'];
	$FR_CreditRepComp		= $row['FR_CreditRepComp'];
	$FR_FTCComp				= $row['FR_FTCComp'];
	$FR_HUD1Comp			= $row['FR_HUD1Comp'];
	$FR_SellerOwnerComp		= $row['FR_SellerOwnerComp'];
	$FR_IEComp				= $row['FR_IEComp'];
	$FR_4506TComp			= $row['FR_4506TComp'];
	$FR_CIComp				= $row['FR_CIComp'];
	$FR_180TComp			= $row['FR_180TComp'];
	$FR_25Percent			= $row['FR_25Percent'];
	$FR_BTRANComp			= $row['FR_BTRANComp'];
	$FR_PTRANComp			= $row['FR_PTRANComp'];
	$FR_AssetsComp			= $row['FR_AssetsComp'];
	$FR_FilesRev			= $row['FR_FilesRev'];
	$FR_TransactionType		= $row['FR_TransactionType'];
	$FR_RateTerm			= $row['FR_RateTerm'];
	$FR_StreamLine			= $row['FR_StreamLine'];
	$FR_Cashout				= $row['FR_Cashout'];
	$FR_OwnerOccupied		= $row['FR_OwnerOccupied'];
	$FR_SecondHome			= $row['FR_SecondHome'];
	$FR_Investment			= $row['FR_Investment'];
	$FR_Retail				= $row['FR_Retail'];
	$FR_Wholesale			= $row['FR_Wholesale'];
	$FR_Correspondent		= $row['FR_Correspondent'];
	$FR_Documentation		= $row['FR_Documentation'];
	$FR_StreamFHA			= $row['FR_StreamFHA'];
	$FR_SISA				= $row['FR_SISA'];
	$FR_NINA				= $row['FR_NINA'];
	$FR_SIVA				= $row['FR_SIVA'];
	$FR_NIVA				= $row['FR_NIVA'];
	$FR_AvgFICO				= $row['FR_AvgFICO'];
	$FR_AvgLTV				= $row['FR_AvgLTV'];
	$FR_AvgCLTV				= $row['FR_AvgCLTV'];
	$FR_FirstLien			= $row['FR_FirstLien'];
	$FR_StatedDoc			= $row['FR_StatedDoc'];
	$FR_SRFC				= $row['FR_SRFC'];
	$FR_Acceptable			= $row['FR_Acceptable'];
	$FR_Elevated			= $row['FR_Elevated'];
	$FR_Significant			= $row['FR_Significant'];

	$reph_audit = 'select reph_audit.24M as REPH_24M,'
	.'reph_audit.EPD as REPH_EPD,'
	.'reph_audit.RD08 as REPH_RD08,'
	.'reph_audit.RD07 as REPH_RD07,'
	.'reph_audit.FMR07 as REPH_FMR07,'
	.'reph_audit.CIR as REPH_CIR,'
	.'reph_audit.CIR2 as REPH_CIR2,'
	.'reph_audit.Other as REPH_OTHER'
	.' from reph_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($reph_audit);
	$row = mysql_fetch_assoc($result);

	$REPH_24M		= $row['REPH_24M'];
	$REPH_EPD		= $row['REPH_EPD'];
	$REPH_RD08		= $row['REPH_RD08'];
	$REPH_RD07		= $row['REPH_RD07'];
	$REPH_FMR07		= $row['REPH_FMR07'];
	$REPH_CIR		= $row['REPH_CIR'];
	$REPH_CIR2		= $row['REPH_CIR2'];
	$REPH_OTHER		= $row['REPH_OTHER'];

	$uw_audit = 'select uw_audit.ManName as UW_ManName,'
	.'uw_audit.TimeInMBI as UW_TimeInMBI,'
	.'uw_audit.ManTenure as UW_ManTenure,'
	.'uw_audit.ReportsTo as UW_ReportsTo,'
	.'uw_audit.FullTimers as UW_FullTimers,'
	.'uw_audit.PartTimers as UW_PartTimers,'
	.'uw_audit.AvgYears as UW_AvgYears,'
	.'uw_audit.AvgTenure as UW_AvgTenure,'
	.'uw_audit.MaintOutline as UW_MaintOutline,'
	.'uw_audit.Handling as UW_Handling,'
	.'uw_audit.AvgAutoFiles as UW_AvgAutoFiles,'
	.'uw_audit.AvgFilesDay as UW_AvgFilesDay,'
	.'uw_audit.BlackoutPeriod as UW_BlackoutPeriod,'
	.'uw_audit.LengthBlack as UW_LengthBlack,'
	.'uw_audit.DelUWAuth as UW_DelUWAuth,'
	.'uw_audit.ProdSignOff as UW_ProdSignOff,'
	.'uw_audit.PreAppInvest as UW_PreAppInvest,'
	.'uw_audit.TrackExceptPer as UW_TrackExceptPer,'
	.'uw_audit.ExceptAvg as uw_ExceptAvg,'
	.'uw_audit.GuidExcAuth as uw_GuidExcAuth,'
	.'uw_audit.AcceptCompFact as uw_AcceptCompFact,'
	.'uw_audit.CodesCompFact as uw_CodesCompFact,'
	.'uw_audit.TrainingForUW as uw_TrainingForUW,'
	.'uw_audit.AccessFraudDetTools as uw_AccessFraudDetTools,'
	.'uw_audit.FraudDetTools as uw_FraudDetTools,'
	.'uw_audit.ComfortTrain as uw_ComfortTrain,'
	.'uw_audit.FraudDetChklists as uw_FraudDetChklists,'
	.'uw_audit.ComparsOwn as uw_ComparsOwn,'
	.'uw_audit.ComparsDoc as uw_ComparsDoc,'
	.'uw_audit.ChkIL as uw_ChkIL,'
	.'uw_audit.ILChecking as uw_ILChecking,'
	.'uw_audit.MethMaintIL as uw_MethMaintIL,'
	.'uw_audit.CompResEmp as uw_CompResEmp,'
	.'uw_audit.ActionOnDisc as uw_ActionOnDisc,'
	.'uw_audit.VerbVerif as uw_VerbVerif,'
	.'uw_audit.SourceEmpVer as uw_SourceEmpVer,'
	.'uw_audit.SepVVOEForm as uw_SepVVOEForm,'
	.'uw_audit.JobFuncVVOE as uw_JobFuncVVOE,'
	.'uw_audit.SelfEmpDoc as uw_SelfEmpDoc,'
	.'uw_audit.Signed4506T as uw_Signed4506T,'
	.'uw_audit.AUSorManual as uw_AUSorManual,'
	.'uw_audit.AUSSystems as uw_AUSSystems,'
	.'uw_audit.AUSPercentCautions as uw_AUSPercentCautions,'
	.'uw_audit.ProcSuspectRef as uw_ProcSuspectRef'
	.' from uw_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($uw_audit);
	$row = mysql_fetch_assoc($result);

	$UW_ManName					= $row['UW_ManName'];
	$UW_TimeInMBI				= $row['UW_TimeInMBI'];
	$UW_ManTenure				= $row['UW_ManTenure'];
	$UW_ReportsTo				= $row['UW_ReportsTo'];
	$UW_FullTimers				= $row['UW_FullTimers'];
	$UW_PartTimers				= $row['UW_PartTimers'];
	$UW_AvgYears				= $row['UW_AvgYears'];
	$UW_AvgTenure				= $row['UW_AvgTenure'];
	$UW_MaintOutline			= $row['UW_MaintOutline'];
	$UW_Handling				= $row['UW_Handling'];
	$UW_AvgAutoFiles			= $row['UW_AvgAutoFiles'];
	$UW_AvgFilesDay				= $row['UW_AvgFilesDay'];
	$UW_BlackoutPeriod			= $row['UW_BlackoutPeriod'];
	$UW_LengthBlack				= $row['UW_LengthBlack'];
	$UW_DelUWAuth				= $row['UW_DelUWAuth'];
	$UW_ProdSignOff				= $row['UW_ProdSignOff'];
	$UW_PreAppInvest			= $row['UW_PreAppInvest'];
	$UW_TrackExceptPer			= $row['UW_TrackExceptPer'];
	$uw_ExceptAvg				= $row['uw_ExceptAvg'];
	$uw_GuidExcAuth				= $row['uw_GuidExcAuth'];
	$uw_AcceptCompFact			= $row['uw_AcceptCompFact'];
	$uw_CodesCompFact			= $row['uw_CodesCompFact'];
	$uw_TrainingForUW			= $row['uw_TrainingForUW'];
	$uw_AccessFraudDetTools		= $row['uw_AccessFraudDetTools'];
	$uw_FraudDetTools			= $row['uw_FraudDetTools'];
	$uw_ComfortTrain			= $row['uw_ComfortTrain'];
	$uw_FraudDetChklists		= $row['uw_FraudDetChklists'];
	$uw_ComparsOwn				= $row['uw_ComparsOwn'];
	$uw_ComparsDoc				= $row['uw_ComparsDoc'];
	$uw_ChkIL					= $row['uw_ChkIL'];
	$uw_ILChecking				= $row['uw_ILChecking'];
	$uw_MethMaintIL				= $row['uw_MethMaintIL'];
	$uw_CompResEmp				= $row['uw_CompResEmp'];
	$uw_ActionOnDisc			= $row['uw_ActionOnDisc'];
	$uw_VerbVerif				= $row['uw_VerbVerif'];
	$uw_SourceEmpVer			= $row['uw_SourceEmpVer'];
	$uw_SepVVOEForm				= $row['uw_SepVVOEForm'];
	$uw_JobFuncVVOE				= $row['uw_JobFuncVVOE'];
	$uw_SelfEmpDoc				= $row['uw_SelfEmpDoc'];
	$uw_Signed4506T				= $row['uw_Signed4506T'];
	$uw_AUSorManual				= $row['uw_AUSorManual'];
	$uw_AUSSystems				= $row['uw_AUSSystems'];
	$uw_AUSPercentCautions		= $row['uw_AUSPercentCautions'];
	$uw_ProcSuspectRef			= $row['uw_ProcSuspectRef'];

	$cam_audit = 'select cam_audit.PullCredit as cam_PullCredit,'
	.'cam_audit.SearchVert as cam_SearchVert,'
	.'cam_audit.RevExc as cam_RevExc,'
	.'cam_audit.RevRes as cam_RevRes,'
	.'cam_audit.RevRef as cam_RevRef,'
	.'cam_audit.RevFS as cam_RevFS,'
	.'cam_audit.RevEO as cam_RevEO,'
	.'cam_audit.DiscRegAct as cam_DiscRegAct,'
	.'cam_audit.DiscCivAct as cam_DiscCivAct,'
	.'cam_audit.ZeroTol as cam_ZeroTol,'
	.'cam_audit.MonPTR as cam_MonPTR,'
	.'cam_audit.MonEPD as cam_MonEPD,'
	.'cam_audit.MonEP as cam_MonEP,'
	.'cam_audit.MonRD as cam_MonRD,'
	.'cam_audit.MonQC as cam_MonQC,'
	.'cam_audit.MonDoc as cam_MonDoc,'
	.'cam_audit.ResToExecs as cam_ResToExecs,'
	.'cam_audit.Thresh as cam_Thresh,'
	.'cam_audit.Freq as cam_Freq'
	.' from cam_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($cam_audit);
	$row = mysql_fetch_assoc($result);

	$cam_PullCredit		= $row['cam_PullCredit'];
	$cam_SearchVert		= $row['cam_SearchVert'];
	$cam_RevExc			= $row['cam_RevExc'];
	$cam_RevRes			= $row['cam_RevRes'];
	$cam_RevRef			= $row['cam_RevRef'];
	$cam_RevFS			= $row['cam_RevFS'];
	$cam_RevEO			= $row['cam_RevEO'];
	$cam_DiscRegAct		= $row['cam_DiscRegAct'];
	$cam_DiscCivAct		= $row['cam_DiscCivAct'];
	$cam_ZeroTol		= $row['cam_ZeroTol'];
	$cam_MonPTR			= $row['cam_MonPTR'];
	$cam_MonEPD			= $row['cam_MonEPD'];
	$cam_MonEP			= $row['cam_MonEP'];
	$cam_MonRD			= $row['cam_MonRD'];
	$cam_MonQC			= $row['cam_MonQC'];
	$cam_MonDoc			= $row['cam_MonDoc'];
	$cam_ResToExecs		= $row['cam_ResToExecs'];
	$cam_Thresh			= $row['cam_Thresh'];
	$cam_Freq			= $row['cam_Freq'];

	$eoi_audit = 'select eoi_audit.Carrier as eoi_Carrier,'
	.'eoi_audit.Name as EOI_Name,'
	.'eoi_audit.Address as EOI_Address,'
	.'eoi_audit.Amount as EOI_Amount,'
	.'eoi_audit.Term as EOI_Term,'
	.'eoi_audit.PolicyNum as EOI_PolicyNum'
	.' from eoi_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($eoi_audit);
	$row = mysql_fetch_assoc($result);

	$eoi_Carrier	= $row['eoi_Carrier'];
	$EOI_Name		= $row['EOI_Name'];
	$EOI_Address	= $row['EOI_Address'];
	$EOI_Amount		= $row['EOI_Amount'];
	$EOI_Term		= $row['EOI_Term'];
	$EOI_PolicyNum	= $row['EOI_PolicyNum'];

	$gseaa_audit = 'select gseaa_audit.FanNum as gseaa_FanNum,'
	.'gseaa_audit.FanApp as gseaa_FanApp,'
	.'gseaa_audit.FredNum as gseaa_FredNum,'
	.'gseaa_audit.FredApp as gseaa_FredApp,'
	.'gseaa_audit.HUDNum as gseaa_HUDNum,'
	.'gseaa_audit.HUDApp as gseaa_HUDApp,'
	.'gseaa_audit.VANum as gseaa_VANum,'
	.'gseaa_audit.VAApp as gseaa_VAApp'
	.' from gseaa_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($gseaa_audit);
	$row = mysql_fetch_assoc($result);

	$gseaa_FanNum	= $row['gseaa_FanNum'];
	$gseaa_FanApp	= $row['gseaa_FanApp'];
	$gseaa_FredNum	= $row['gseaa_FredNum'];
	$gseaa_FredApp	= $row['gseaa_FredApp'];
	$gseaa_HUDNum	= $row['gseaa_HUDNum'];
	$gseaa_HUDApp	= $row['gseaa_HUDApp'];
	$gseaa_VANum	= $row['gseaa_VANum'];
	$gseaa_VAApp	= $row['gseaa_VAApp'];

	$pboccg_audit = 'select pboccg_audit.RetailAvgFICO as pboccg_RetailAvgFICO,'
	.'pboccg_audit.RetailAltFICO as pboccg_RetailAltFICO,'
	.'pboccg_audit.RetailSubFICO as pboccg_RetailSubFICO,'
	.'pboccg_audit.RetailFHA as pboccg_RetailFHA,'
	.'pboccg_audit.RetailPrimeLTV as pboccg_RetailPrimeLTV,'
	.'pboccg_audit.RetailAltLTV as pboccg_RetailAltLTV,'
	.'pboccg_audit.RetailSubLTV as pboccg_RetailSubLTV,'
	.'pboccg_audit.RetailFHALTV as pboccg_RetailFHALTV,'
	.'pboccg_audit.BrokerPrimeFICO as pboccg_BrokerPrimeFICO,'
	.'pboccg_audit.BrokerAltFICO as pboccg_BrokerAltFICO,'
	.'pboccg_audit.BrokerSubFICO as pboccg_BrokerSubFICO,'
	.'pboccg_audit.BrokerFHAFICO as pboccg_BrokerFHAFICO,'
	.'pboccg_audit.BrokerPrimeLTV as pboccg_BrokerPrimeLTV,'
	.'pboccg_audit.BrokerAltLTV as pboccg_BrokerAltLTV,'
	.'pboccg_audit.BrokerSubLTV as pboccg_BrokerSubLTV,'
	.'pboccg_audit.BrokerFHALTV as pboccg_BrokerFHALTV,'
	.'pboccg_audit.CorrPrimeFICO as pboccg_CorrPrimeFICO,'
	.'pboccg_audit.CorrAltFICO as pboccg_CorrAltFICO,'
	.'pboccg_audit.CorrSubFICO as pboccg_CorrSubFICO,'
	.'pboccg_audit.CorrFHAFICO as pboccg_CorrFHAFICO,'
	.'pboccg_audit.CorrPrimeLTV as pboccg_CorrPrimeLTV,'
	.'pboccg_audit.CorrAltLTV as pboccg_CorrAltLTV,'
	.'pboccg_audit.CorrSubLTV as pboccg_CorrSubLTV,'
	.'pboccg_audit.CorrFHALTV as pboccg_CorrFHALTV'
	.' from pboccg_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($pboccg_audit);
	$row = mysql_fetch_assoc($result);

	$pboccg_RetailAvgFICO		= $row['pboccg_RetailAvgFICO'];
	$pboccg_RetailAltFICO		= $row['pboccg_RetailAltFICO'];
	$pboccg_RetailSubFICO		= $row['pboccg_RetailSubFICO'];
	$pboccg_RetailFHA			= $row['pboccg_RetailFHA'];
	$pboccg_RetailPrimeLTV		= $row['pboccg_RetailPrimeLTV'];
	$pboccg_RetailAltLTV		= $row['pboccg_RetailAltLTV'];
	$pboccg_RetailSubLTV		= $row['pboccg_RetailSubLTV'];
	$pboccg_RetailFHALTV		= $row['pboccg_RetailFHALTV'];
	$pboccg_BrokerPrimeFICO		= $row['pboccg_BrokerPrimeFICO'];
	$pboccg_BrokerAltFICO		= $row['pboccg_BrokerAltFICO'];
	$pboccg_BrokerSubFICO		= $row['pboccg_BrokerSubFICO'];
	$pboccg_BrokerFHAFICO		= $row['pboccg_BrokerFHAFICO'];
	$pboccg_BrokerPrimeLTV		= $row['pboccg_BrokerPrimeLTV'];
	$pboccg_BrokerAltLTV		= $row['pboccg_BrokerAltLTV'];
	$pboccg_BrokerSubLTV		= $row['pboccg_BrokerSubLTV'];
	$pboccg_BrokerFHALTV		= $row['pboccg_BrokerFHALTV'];
	$pboccg_CorrPrimeFICO		= $row['pboccg_CorrPrimeFICO'];
	$pboccg_CorrAltFICO			= $row['pboccg_CorrAltFICO'];
	$pboccg_CorrSubFICO			= $row['pboccg_CorrSubFICO'];
	$pboccg_CorrFHAFICO			= $row['pboccg_CorrFHAFICO'];
	$pboccg_CorrPrimeLTV		= $row['pboccg_CorrPrimeLTV'];
	$pboccg_CorrAltLTV			= $row['pboccg_CorrAltLTV'];
	$pboccg_CorrSubLTV			= $row['pboccg_CorrSubLTV'];
	$pboccg_CorrFHALTV			= $row['pboccg_CorrFHALTV'];

	$ceo_audit = 'select ceo_audit.Name as CEO_Name,'
	.'ceo_audit.TimeInMBI as CEO_TimeInMBI,'
	.'ceo_audit.TimeInBusiness as CEO_TimeInBusiness,'
	.'ceo_audit.Holdings as ceo_Holdings,'
	.'ceo_audit.LegalStruct as ceo_LegalStruct,'
	.'ceo_audit.Board as ceo_Board,'
	.'ceo_audit.NetWorth as ceo_NetWorth,'
	.'ceo_audit.VolumeUpDown as ceo_VolumeUpDown,'
	.'ceo_audit.NewGeoMarkets as ceo_NewGeoMarkets,'
	.'ceo_audit.MarketsDetail as ceo_MarketsDetail,'
	.'ceo_audit.PlanForMarket as ceo_PlanForMarket,'
	.'ceo_audit.MarketsToGrow as ceo_MarketsToGrow,'
	.'ceo_audit.ChangeMix as ceo_ChangeMix,'
	.'ceo_audit.TargetChannel as ceo_TargetChannel,'
	.'ceo_audit.HasCounsel as ceo_HasCounsel,'
	.'ceo_audit.PendingAction as ceo_PendingAction,'
	.'ceo_audit.ActionExplanation as ceo_ActionExplanation,'
	.'ceo_audit.Defendant as ceo_Defendant,'
	.'ceo_audit.DefExplanation as ceo_DefExplanation,'
	.'ceo_audit.NewGeoDetail as ceo_NewGeoDetail'
	.' from ceo_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($ceo_audit);
	$row = mysql_fetch_assoc($result);

	$CEO_Name				= $row['CEO_Name'];
	$CEO_TimeInMBI			= $row['CEO_TimeInMBI'];
	$CEO_TimeInBusiness		= $row['CEO_TimeInBusiness'];
	$ceo_Holdings			= $row['ceo_Holdings'];
	$ceo_LegalStruct		= $row['ceo_LegalStruct'];
	$ceo_Board				= $row['ceo_Board'];
	$ceo_NetWorth			= $row['ceo_NetWorth'];
	$ceo_VolumeUpDown		= $row['ceo_VolumeUpDown'];
	$ceo_NewGeoMarkets		= $row['ceo_NewGeoMarkets'];
	$ceo_MarketsDetail		= $row['ceo_MarketsDetail'];
	$ceo_PlanForMarket		= $row['ceo_PlanForMarket'];
	$ceo_MarketsToGrow		= $row['ceo_MarketsToGrow'];
	$ceo_ChangeMix			= $row['ceo_ChangeMix'];
	$ceo_TargetChannel		= $row['ceo_TargetChannel'];
	$ceo_HasCounsel			= $row['ceo_HasCounsel'];
	$ceo_PendingAction		= $row['ceo_PendingAction'];
	$ceo_ActionExplanation	= $row['ceo_ActionExplanation'];
	$ceo_Defendant			= $row['ceo_Defendant'];
	$ceo_DefExplanation		= $row['ceo_DefExplanation'];
	$ceo_NewGeoDetail		= $row['ceo_NewGeoDetail'];

	$hrd_audit = 'select hrd_audit.DirectorName as hr_DirectorName,'
	.'hrd_audit.Tenure as hr_Tenure,'
	.'hrd_audit.ReportsTo as hr_ReportsTo,'
	.'hrd_audit.FullTimers as hr_Fulltimers,'
	.'hrd_audit.DoesTraining as hr_DoesTraining,'
	.'hrd_audit.FraudTolerance as hr_FraudTolerance,'
	.'hrd_audit.BackgroundCheck as hr_BackgroundCheck,'
	.'hrd_audit.TurnoverRate as hr_TurnoverRate,'
	.'hrd_audit.TurnRelAELO as hr_TurnRelAELO,'
	.'hrd_audit.TurnRelExec as hr_TurnRelExec,'
	.'hrd_audit.Terminations as hr_Terminations'
	.' from hrd_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($hrd_audit);
	$row = mysql_fetch_assoc($result);

	$hr_DirectorName		= $row['hr_DirectorName'];
	$hr_Tenure				= $row['hr_Tenure'];
	$hr_ReportsTo			= $row['hr_ReportsTo'];
	$hr_Fulltimers			= $row['hr_Fulltimers'];
	$hr_DoesTraining		= $row['hr_DoesTraining'];
	$hr_FraudTolerance		= $row['hr_FraudTolerance'];
	$hr_BackgroundCheck		= $row['hr_BackgroundCheck'];
	$hr_TurnoverRate		= $row['hr_TurnoverRate'];
	$hr_TurnRelAELO			= $row['hr_TurnRelAELO'];
	$hr_TurnRelExec			= $row['hr_TurnRelExec'];
	$hr_Terminations		= $row['hr_Terminations'];

	$pc_audit = 'select pc_audit.ManName as PC_ManName,'
	.'pc_audit.TimeInMBI as PC_TimeInMBI,'
	.'pc_audit.ManTenure as PC_ManTenure,'
	.'pc_audit.ReportsTo as PC_ReportsTo,'
	.'pc_audit.FullTimers as PC_FullTimers,'
	.'pc_audit.AvgYears as PC_AvgYears,'
	.'pc_audit.AvgTenure as PC_AvgTenure,'
	.'pc_audit.PartTimers as PC_PartTimers,'
	.'pc_audit.AvgFilesPerDay as PC_AvgFilesPerDay,'
	.'pc_audit.PostClosFuncs as pc_PostClosFuncs,'
	.'pc_audit.AvgClosDeliv as pc_AvgClosDeliv,'
	.'pc_audit.SuspenMonth as pc_SuspenMonth,'
	.'pc_audit.Handling as pc_Handling,'
	.'pc_audit.HighKicks as pc_HighKicks,'
	.'pc_audit.MostCommon as pc_MostCommon,'
	.'pc_audit.InvolveUW as pc_InvolveUW,'
	.'pc_audit.MonthlyReps as pc_MonthlyReps,'
	.'pc_audit.AvgRcvdMonth as pc_AvgRcvdMonth,'
	.'pc_audit.SpecBrands as pc_SpecBrands,'
	.'pc_audit.TrackAge as pc_TrackAge,'
	.'pc_audit.HMDAReps as pc_HMDAReps'
	.' from pc_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($pc_audit);
	$row = mysql_fetch_assoc($result);

	$PC_ManName			= $row['PC_ManName'];
	$PC_TimeInMBI		= $row['PC_TimeInMBI'];
	$PC_ManTenure		= $row['PC_ManTenure'];
	$PC_ReportsTo		= $row['PC_ReportsTo'];
	$PC_FullTimers		= $row['PC_FullTimers'];
	$PC_AvgYears		= $row['PC_AvgYears'];
	$PC_AvgTenure		= $row['PC_AvgTenure'];
	$PC_PartTimers		= $row['PC_PartTimers'];
	$PC_AvgFilesPerDay	= $row['PC_AvgFilesPerDay'];
	$pc_PostClosFuncs	= $row['pc_PostClosFuncs'];
	$pc_AvgClosDeliv	= $row['pc_AvgClosDeliv'];
	$pc_SuspenMonth		= $row['pc_SuspenMonth'];
	$pc_Handling		= $row['pc_Handling'];
	$pc_HighKicks		= $row['pc_HighKicks'];
	$pc_MostCommon		= $row['pc_MostCommon'];
	$pc_InvolveUW		= $row['pc_InvolveUW'];
	$pc_MonthlyReps		= $row['pc_MonthlyReps'];
	$pc_AvgRcvdMonth	= $row['pc_AvgRcvdMonth'];
	$pc_SpecBrands		= $row['pc_SpecBrands'];
	$pc_TrackAge		= $row['pc_TrackAge'];
	$pc_HMDAReps		= $row['pc_HMDAReps'];

	/* =========================================== TO DO ========= 

	* Add check to see if we really need to worry about appraiser management scoring
		(If total units originated for the previous 12 months is less than 200, consider deselecting "Appraiser Management" under the Procedures menu.)
	* Check to see if info is even in the file review section:
		(Accepted, Elevated and Significant values under the File Review tab do not equal 100 percent.)
	* CheckTVS - top volume states .. not sure if this needs done as part of the core scoring algorithm, i
		think it was just a check for the desktop tool

	*/


	// assign vars

    $rh_score = 0;
    $wr_score = 0;
    $ch_score = 0;
    $or_score = 0;
    $ba_score = 0;

    // multipliers may change depending on weighting approach

    $uw_multiplier = 0.0870;
    $qc_multiplier = 0.1176;
    $fp_multiplier = 0.1429;
    $cm_multiplier = 0.2000;
    $hr_multiplier = 0.3333;
    $ca_multiplier = 0.0952;
    $pc_multiplier = 0.5000;
    $aa_multiplier = 0.1429;
    $qcp_multiplier = 1.0000;
    $cap_multiplier = 0.2500;
    $bap_multiplier = 0.2500;

	if ($testing != 0) {
		echo "Multipliers:<br><br>";
		echo "uw: $uw_multiplier<br>";
		echo "qc: $qc_multiplier<br>";
		echo "fp: $fp_multiplier<br>";
		echo "cm: $cm_multiplier<br>";
		echo "hr: $hr_multiplier<br>";
		echo "ca: $ca_multiplier<br>";
		echo "pc: $pc_multiplier<br>";
		echo "aa: $aa_multiplier<br>";
		echo "qcp: $qcp_multiplier<br>";
		echo "cap: $cap_multiplier<br>";
		echo "bap: $bap_multiplier<br>";
		echo "<br>";
	}

	// this section is for OPERATIONAL CONTROLS
	// after this gets scored, its like a base score, then the multipliers 
	// make the adjustments and get added to the overall score

	// score underwriting

	if ($testing != 0) {
		echo "Outputting individual scores:<br><br>";
	}


	$uw_score = 104; // according to original scoring info

	if ($testing != 0) {
		echo "base uw_score: $uw_score<br>";
	}

	if (strtolower($UW_TimeInMBI)				== '0-4 yrs')				{ $uw_score=$uw_score-2; }
	if (strtolower($UW_TimeInMBI)				== '0-4 years')				{ $uw_score=$uw_score-2; }
	if (strtolower($UW_ReportsTo)				== 'production')			{ $uw_score=$uw_score-3; }
	if (strtolower($UW_AvgYears)				== '0-5 yrs')				{ $uw_score=$uw_score-2; }
	if (strtolower($UW_AvgYears)				== '0-5 years')				{ $uw_score=$uw_score-2; }
	if (strtolower($UW_MaintOutline)			== 'no')					{ $uw_score=$uw_score-1; }
	if (strtolower($UW_Handling)				== 'branches')				{ $uw_score=$uw_score-3; }
	if (strtolower($UW_AvgAutoFiles)			== '7-8 full packages')		{ $uw_score=$uw_score-2; }
	if (strtolower($UW_AvgFilesDay)				== '11-12 full packages')	{ $uw_score=$uw_score-2; }
	if (strtolower($UW_BlackoutPeriod)			== 'no')					{ $uw_score=$uw_score-1; }
	if (strtolower($UW_DelUWAuth)				== 'no')					{ $uw_score=$uw_score-1; }
	if (strtolower($UW_ProdSignOff)				== 'yes')					{ $uw_score=$uw_score-3; }
	if (strtolower($UW_ProdSignOff)				== 'partial')				{ $uw_score=$uw_score-2; }
	if (strtolower($UW_TrackExceptPer)			== 'no')					{ $uw_score=$uw_score-2; }
	if (strtolower($uw_ExceptAvg)				== '4-5%')					{ $uw_score=$uw_score-1; }
	if (strtolower($uw_ExceptAvg)				== '6-10%')					{ $uw_score=$uw_score-3; }
	if (strtolower($uw_ExceptAvg)				== 'greater than 10%')		{ $uw_score=$uw_score-2; }
	if (strtolower($uw_AcceptCompFact)			== 'no')					{ $uw_score=$uw_score-1; }
	if (strtolower($uw_TrainingForUW)			== 'internal staff meetings') { $uw_score=$uw_score-3; }
// uw_chk_ism == 265?????
	if (strtolower($uw_AccessFraudDetTools)		== 'no')					{ $uw_score=$uw_score-2; }
	if (strtolower($uw_FraudDetChklists)		== 'no')					{ $uw_score=$uw_score-3; }
	if (strtolower($uw_ComparsOwn)				== 'no')					{ $uw_score=$uw_score-1; }
	if (strtolower($uw_ChkIL)					== 'no')					{ $uw_score=$uw_score-3; }
	if (strtolower($uw_CompResEmp)				== 'no')					{ $uw_score=$uw_score-3; }
	if (strtolower($uw_VerbVerif)				== 'no')					{ $uw_score=$uw_score-3; }
	if (strtolower($uw_SourceEmpVer)			== 'no')					{ $uw_score=$uw_score-3; }
	if (strtolower($uw_SelfEmpDoc)				== 'no')					{ $uw_score=$uw_score-3; }
	if (strtolower($uw_Signed4506T)				== 'no')					{ $uw_score=$uw_score-3; }
	
	$interims = $uw_score;

	$uw_score = $uw_score * $uw_multiplier;

	if ($testing != 0) {
		echo "uw_score ($interims * $uw_multiplier): $uw_score<br>";
	}

	// score qc

	$qc_score = 84;

	if ($testing != 0) {
		echo "base qc_score: $qc_score<br>";
	}

	if (strtolower($QC_TimeInMBI)					== '0-4 yrs')		{ $qc_score=$qc_score-2; }
	if (strtolower($QC_TimeInMBI)					== '0-4 years')		{ $qc_score=$qc_score-2; }
	if (strtolower($QC_ReportsTo)					== 'chief credit officer') { $qc_score=$qc_score-1; }
	if (strtolower($QC_ReportsTo)					== 'cfo')			{ $qc_score=$qc_score-1; }
	if (strtolower($QC_ReportsTo)					== 'secondary marketing') { $qc_score=$qc_score-1; }
	if (strtolower($QC_ReportsTo)					== 'production')	{ $qc_score=$qc_score-3; }
	if (strtolower($QC_AvgYears)					== '0-4 yrs')		{ $qc_score=$qc_score-2; }
	if (strtolower($QC_AvgYears)					== '0-4 years')		{ $qc_score=$qc_score-2; }
	if (strtolower($QC_AvgFilesPerDay)				== '7-8 files')		{ $qc_score=$qc_score-2; }
	if (strtolower($QC_AvgFilesPerDay)				== '9+ files')		{ $qc_score=$qc_score-2; }
	if (strtolower($qc_ClosedAudMonthly)				== 'no')		{ $qc_score=$qc_score-3; }
	if (strtolower($qc_CurrentClosing)				== 'no')			{ $qc_score=$qc_score-3; }
	if (strtolower($qc_RevEarlyPay)					== 'no')			{ $qc_score=$qc_score-3; }
	if (strtolower($qc_RevIncomingPurchaseDemands)	== 'no')			{ $qc_score=$qc_score-3; }
	if (strtolower($qc_RevIncomingPurchaseDemands)	== 'no / not reviewed') { $qc_score=$qc_score-3; }
	if (strtolower($qc_FollowHUD)					== 'no')			{ $qc_score=$qc_score-2; }
	if (strtolower($qc_ReferFraud)					== 'no')			{ $qc_score=$qc_score-3; }
	if (strtolower($qc_BranchAuditLocation)			== 'no')			{ $qc_score=$qc_score-3; }
	if (strtolower($qc_FindingsToExecs)				== 'no')			{ $qc_score=$qc_score-2; }
	if (strtolower($qc_MeetWithExecs)				== 'no')			{ $qc_score=$qc_score-3; }
	if (strtolower($qc_AnalyzeExceptionCause)		== 'no')			{ $qc_score=$qc_score-3; }
	if (strtolower($qc_TrendExceptions)				== 'no')			{ $qc_score=$qc_score-3; }		
	
	$interims = $qc_score;

	$qc_score = $qc_score * $qc_multiplier;

	if ($testing != 0) {
		echo "qc_score ($interims * $qc_multiplier): $qc_score<br>";
	}

	// score Fraud Prevention

	$fp_score = 72;

	if ($testing != 0) {
		echo "base fp_score: $fp_score<br>";
	}

	if (strtolower($FP_TimeInIndustry)			== '0-4 years')				{ $fp_score=$fp_score-2; }
	if (strtolower($FP_TimeInIndustry)			== '0-4 yrs')				{ $fp_score=$fp_score-2; }
	if (strtolower($FP_ReportsTo)				== 'chief credit officer')	{ $fp_score=$fp_score-1; }
	if (strtolower($FP_ReportsTo)				== 'cfo')					{ $fp_score=$fp_score-1; }
	if (strtolower($FP_ReportsTo)				== 'secondary marketing')	{ $fp_score=$fp_score-1; }
	if (strtolower($FP_ReportsTo)				== 'production')			{ $fp_score=$fp_score-3; }
	if (strtolower($FP_AvgTenure)				== '0-4 years')				{ $fp_score=$fp_score-2; }
	if (strtolower($FP_AvgTenure)				== '0-4 yrs')				{ $fp_score=$fp_score-2; }
	if (strtolower($FP_AvgFilesPerDay)			== '7-8 files')				{ $fp_score=$fp_score-2; }
	if (strtolower($FP_AvgFilesPerDay)			== '9+ files')				{ $fp_score=$fp_score-2; }
	if (strtolower($FP_FindToExecs)				== 'no')					{ $fp_score=$fp_score-3; }
	if (strtolower($FP_MeetWithExecs)			== 'no')					{ $fp_score=$fp_score-3; }
	if (strtolower($FP_ReportsIncRecs)			== 'no')					{ $fp_score=$fp_score-3; }
	if (strtolower($FP_FindingsTrended)			== 'no')					{ $fp_score=$fp_score-3; }
	if (strtolower($FP_PreventionTools)			== 'none')					{ $fp_score=$fp_score-2; }
	if (strtolower($FP_ReferralProcess)			== 'no referral process')	{ $fp_score=$fp_score-3; }
	if (strtolower($FP_ProcFraudChklst)			== 'no')					{ $fp_score=$fp_score-3; }
	if (strtolower($FP_CloserFraudChklist)		== 'no')					{ $fp_score=$fp_score-3; }
	
	$interims = $fp_score;

    $fp_score = $fp_score * $fp_multiplier;

	if ($testing != 0) {
		echo "fp_score ($interims * $fp_multiplier): $fp_score<br>";
	}

	// score Closing

	$cm_score = 40;

	if ($testing != 0) {
		echo "base cm_score: $cm_score<br>";
	}

	if (strtolower($CM_ManTimeInMBI)		== '0-4 yrs')	{ $cm_score=$cm_score-2; }
	if (strtolower($CM_ManTimeInMBI)		== '0-4 years') { $cm_score=$cm_score-2; }
	if (strtolower($cm_prehudsent)			== 'no') { $cm_score=$cm_score-3; }
	if (strtolower($cm_ClosersRevPreHud)	== 'no') { $cm_score=$cm_score-3; }
	if (strtolower($cm_RevConcessions)		== 'no') { $cm_score=$cm_score-2; }
	if (strtolower($cm_RevPayoffsExist)		== 'no') { $cm_score=$cm_score-3; }
	if (strtolower($cm_RevPayoffsNon)		== 'no') { $cm_score=$cm_score-3; }
	if (strtolower($cm_RevCommissions)		== 'no') { $cm_score=$cm_score-2; }
	if (strtolower($cm_RevMatchLiens)		== 'no') { $cm_score=$cm_score-3; }
	if (strtolower($cm_HudReReview)			== 'no') { $cm_score=$cm_score-1; }
	if (strtolower($cm_QuestionsProcedure)	== 'agent is asked to remove the item from the hud-1') { $cm_score=$cm_score-1; }

	$interims = $cm_score;

	$cm_score = $cm_score * $cm_multiplier;

	if ($testing != 0) {
		echo "cm_score ($interims * $cm_multiplier): $cm_score<br>";
	}

	// score HR

	$hr_score = 24;

	if ($testing != 0) {
		echo "base hr_score: $hr_score<br>";
	}

	if (strtolower($hr_FraudTolerance)	== 'no')			{ $hr_score=$hr_score-2; }
	if (strtolower($hr_BackgroundCheck) == 'no')			{ $hr_score=$hr_score-3; }
	if (strtolower($hr_TurnoverRate)	== '31-40')			{ $hr_score=$hr_score-2; }
	if (strtolower($hr_TurnRelAELO)		== '31-40')			{ $hr_score=$hr_score-2; }
	if (strtolower($hr_TurnRelExec)		== '21-30')			{ $hr_score=$hr_score-2; }
	if (strtolower($hr_Terminations)	== '4-5 people')	{ $hr_score=$hr_score-3; }	

	$interims = $hr_score;

	$hr_score = $hr_score * $hr_multiplier;

	if ($testing != 0) {
		echo "hr_score ($interims * $hr_multiplier): $hr_score<br>";
	}

	// score Chief Appraiser

	$ca_score = 108;

	if ($testing != 0) {
		echo "base ca_score: $ca_score<br>";
	}

	if (strtolower($CA_TimeInMBI			) == '0-4 yrs')		{ $ca_score=$ca_score-2; }
	if (strtolower($CA_TimeInMBI			) == '0-4 years')	{ $ca_score=$ca_score-2; }
	if (strtolower($CA_ReportsTo			) == 'production')	{ $ca_score=$ca_score-3; }
	if (strtolower($CA_AvgYearsMBI			) == '0-4 yrs')		{ $ca_score=$ca_score-2; }
	if (strtolower($CA_AvgYearsMBI			) == '0-4 years')	{ $ca_score=$ca_score-2; }
	if (strtolower($ca_HowManyApp			) == '0')			{ $ca_score=$ca_score-3; }
	if (strtolower($ca_HowManyApp			) == '1')			{ $ca_score=$ca_score-3; }
	if (strtolower($ca_HowManyApp			) == '2')			{ $ca_score=$ca_score-2; }
	if (strtolower($ca_HowManyApp			) == '3')			{ $ca_score=$ca_score-1; }
	if (strtolower($ca_HowManyApp			) == '')			{ $ca_score=$ca_score-4; }
	if (strtolower($ca_SysControls			) == 'no')			{ $ca_score=$ca_score-3; }
	if (strtolower($ca_AppRevChk			) == 'no')			{ $ca_score=$ca_score-3; }
	if (strtolower($ca_AppLocHandling		) == 'branches')	{ $ca_score=$ca_score-3; }
	if (strtolower($ca_FullAppAvgRevs		) == '7-8 full packages')	{ $ca_score=$ca_score-2; }
	if (strtolower($ca_FilesAutoRevs		) == '11-12 full packages') { $ca_score=$ca_score-2; }
	if (strtolower($ca_ProdSignoff			) == 'yes')			{ $ca_score=$ca_score-3; }
	if (strtolower($ca_ProdSignoff			) == 'partially')	{ $ca_score=$ca_score-2; }
	if (strtolower($ca_TrackExceptions		) == 'no')			{ $ca_score=$ca_score-1; }
	if (strtolower($ca_ExceptDetail			) == '4-5')			{ $ca_score=$ca_score-1; }
	if (strtolower($ca_ExceptDetail			) == '6-10')		{ $ca_score=$ca_score-2; }
	if (strtolower($ca_ExceptDetail			) == 'greater than 10')		{ $ca_score=$ca_score-3; }
	if (strtolower($ca_TrainingReceived		) == 'no')			{ $ca_score=$ca_score-3; }
	if (strtolower($ca_AccessFraudTools		) == 'no')			{ $ca_score=$ca_score-2; }
	if (strtolower($ca_FraudChecklists		) == 'no')			{ $ca_score=$ca_score-3; }
	if (strtolower($ca_CheckIneligible		) == 'no')			{ $ca_score=$ca_score-3; }
	if (strtolower($ca_RepReccs				) == 'no')			{ $ca_score=$ca_score-3; }
	if (strtolower($ca_VarInfo				) == 'no')			{ $ca_score=$ca_score-1; }
	if (strtolower($ca_SysProhibit			) == 'no')			{ $ca_score=$ca_score-3; }
	if (strtolower($ca_InLightofHVCC		) == 'production orders the appraisal') { $ca_score=$ca_score-3; }				

	$interims = $ca_score;

	$ca_score = $ca_score * $ca_multiplier;

	if ($testing != 0) {
		echo "ca_score ($interims * $ca_multiplier): $ca_score<br>";
	}

	// score post closing

	$pc_score = 16;

	if ($testing != 0) {
		echo "base pc_score: $pc_score<br>";
	}

	if (strtolower($PC_TimeInMBI		) == '0-4 yrs')				{ $pc_score=$pc_score-2; }
	if (strtolower($PC_TimeInMBI		) == '0-4 years')			{ $pc_score=$pc_score-2; }
	if (strtolower($PC_ReportsTo		) == 'production')			{ $pc_score=$pc_score-3; }
	if (strtolower($PC_AvgTenure		) == '0-4 yrs')				{ $pc_score=$pc_score-3; }
	if (strtolower($PC_AvgTenure		) == '0-4 years')			{ $pc_score=$pc_score-3; }
	if (strtolower($PC_AvgFilesPerDay	) == '7-8 full packages')	{ $pc_score=$pc_score-2; }

	$interims = $pc_score;

	$pc_score = $pc_score * $pc_multiplier;

	if ($testing != 0) {
		echo "pc_score ($interims * $pc_multiplier): $pc_score<br>";
	}

	// score QC Plan

	$qcp_score = 16;

	if ($testing != 0) {
		echo "base qcp_score: $qcp_score<br>";
	}

	if (strtolower($qcppp_MeetInd		) == 'no') { $qcp_score=$qcp_score-3; }
	if (strtolower($qcppp_ExecSum		) == 'no') { $qcp_score=$qcp_score-3; }
	if (strtolower($qcppp_LoansStopped	) == 'no') { $qcp_score=$qcp_score-3; }
	if (strtolower($qcppp_AvoidToExecs	) == 'no') { $qcp_score=$qcp_score-1; }

	$interims = $qcp_score;

	$qcp_score = $qcp_score * $qcp_multiplier;

	if ($testing != 0) {
		echo "qcp_score ($interims * $qcp_multiplier): $qcp_score<br>";
	}

	// score Correspondent Approval

	$cap_score = 52;

	if ($testing != 0) {
		echo "base cap_score: $cap_score<br>";
	}

	if (strtolower($cam_PullCredit		) == 'no')	{ $cap_score=$cap_score-2; }
	if (strtolower($cam_SearchVert		) == 'no')	{ $cap_score=$cap_score-1; }
	if (strtolower($cam_RevExc			) == 'no')	{ $cap_score=$cap_score-3; }
	if (strtolower($cam_RevRes			) == 'no')	{ $cap_score=$cap_score-2; }
	if (strtolower($cam_RevRef			) == 'no')	{ $cap_score=$cap_score-1; }
	if (strtolower($cam_RevFS			) == 'no')	{ $cap_score=$cap_score-2; }
	if (strtolower($cam_RevEO			) == 'no')	{ $cap_score=$cap_score-2; }
	if (strtolower($cam_DiscRegAct		) == 'no')	{ $cap_score=$cap_score-2; }
	if (strtolower($cam_DiscCivAct		) == 'no')	{ $cap_score=$cap_score-2; }
	if (strtolower($cam_ZeroTol			) == 'no')	{ $cap_score=$cap_score-3; }
	if (strtolower($cam_MonDoc			) == 'no')	{ $cap_score=$cap_score-3; }
	if (strtolower($cam_Thresh			) == 'no')	{ $cap_score=$cap_score-2; }
	if (strtolower($corag_LimitLiability) == 'yes') { $cap_score=$cap_score-3; }

	// score Broker Approval

	$interims = $cap_score;

	$cap_score = $cap_score * $cap_multiplier;

	if ($testing != 0) {
		echo "cap_score ($interims * $cap_multiplier): $cap_score<br>";
	}

	$bap_score = 52;

	if ($testing != 0) {
		echo "base bap_score: $bap_score<br>";
	}

	if (strtolower($bam_PullCredRep		) == 'no')	{ $bap_score=$bap_score-2; }
	if (strtolower($bam_SearchVert		) == 'no')	{ $bap_score=$bap_score-1; }
	if (strtolower($bam_RevExc			) == 'no')	{ $bap_score=$bap_score-3; }
	if (strtolower($bam_RevResumes		) == 'no')	{ $bap_score=$bap_score-2; }
	if (strtolower($bam_RevRefs			) == 'no')	{ $bap_score=$bap_score-1; }
	if (strtolower($bam_RevFin			) == 'no')	{ $bap_score=$bap_score-2; }
	if (strtolower($bam_RevEO			) == 'no')	{ $bap_score=$bap_score-2; }
	if (strtolower($bam_DiscRegAct		) == 'no')	{ $bap_score=$bap_score-2; }
	if (strtolower($bam_DiscCivAct		) == 'no')	{ $bap_score=$bap_score-2; }
	if (strtolower($bam_ZeroTol			) == 'no')	{ $bap_score=$bap_score-3; }
	if (strtolower($bam_MonPTR			) == 'no')	{ $bap_score=$bap_score-3; }
	if (strtolower($bam_Thresh			) == 'no')	{ $bap_score=$bap_score-2; }
	if (strtolower($bag_LimitLiability	) == 'yes') { $bap_score=$bap_score-3; }

	$interims = $bap_score;

	$bap_score = $bap_score * $bap_multiplier;

	if ($testing != 0) {
		echo "bap_score ($interims * $bap_multiplier): $bap_score<br>";
	}

	// score Appraiser Approval

	$aa_score = 56;

	if ($testing != 0) {
		echo "base aa_score: $aa_score<br>";
	}

	if (strtolower($aapr_Checklist			) == 'no') { $aa_score=$aa_score-3; }
	if (strtolower($aapr_VerifyLicense		) == 'no') { $aa_score=$aa_score-3; }
	if (strtolower($aapr_TrackLicense		) == 'no') { $aa_score=$aa_score-2; }
	if (strtolower($aapr_SearchVertical		) == 'no') { $aa_score=$aa_score-1; }
	if (strtolower($aapr_ExcLists			) == 'no') { $aa_score=$aa_score-3; }
	if (strtolower($aapr_RevResumes			) == 'no') { $aa_score=$aa_score-2; }
	if (strtolower($aapr_ReqRefs			) == 'no') { $aa_score=$aa_score-1; }
	if (strtolower($aapr_ContactRefs		) == 'no') { $aa_score=$aa_score-1; }
	if (strtolower($aapr_eo					) == 'no') { $aa_score=$aa_score-2; }
	if (strtolower($aapr_DiscPRA			) == 'no') { $aa_score=$aa_score-2; }
	if (strtolower($aapr_DiscPCA			) == 'no') { $aa_score=$aa_score-2; }
	if (strtolower($aapr_ZeroTolerance		) == 'no') { $aa_score=$aa_score-3; }
	if (strtolower($aapr_mondocs			) == 'no') { $aa_score=$aa_score-3; }
	if (strtolower($aapr_thresh				) == 'no') { $aa_score=$aa_score-2; }

	$interims = $aa_score;

	$aa_score = $aa_score * $aa_multiplier;

	if ($testing != 0) {
		echo "aa_score ($interims * $aa_multiplier): $aa_score<br>";
	}

	$oc_score = $uw_score + $qc_score + $fp_score + $cm_score + $hr_score + $ca_score + $pc_score + $qcp_score + $cap_score + $bap_score + $aa_score;

	if ($testing != 0) {
		echo "<br>Overall Component Score (uw+qc+fp+cm+hr+ca+pc+qcp+cap+bap+aa) (OC): $oc_score";
	}
	// geo mix

	$gm_score = 8; // max possible based on ceo input below, then we add the bad states if there are any

	if ($testing != 0) {
		echo "<br><br>Base GM_Score: $gm_score<br>";
	}

	if (strtolower($ceo_MarketsDetail) == 'yes') { $gm_score=$gm_score-2; }

	$States_Array	= explode("|",$RALI_states);
	$TotalStates	= count($States_Array); 

	$bad_states = 0;
	$Current_State = '';
	$i = 0;
	while ($i <= $TotalStates - 1) { // -1 because the first element is always undefined in this db (compatibility with desktop app)
		$Current_State = $States_Array[$i];
		if ($Current_State == 'California')	{ $bad_states = $bad_states + 1; }
		if ($Current_State == 'Florida')	{ $bad_states = $bad_states + 1; }
		if ($Current_State == 'Georgia')	{ $bad_states = $bad_states + 1; }
		if ($Current_State == 'Illinois')	{ $bad_states = $bad_states + 1; }
		if ($Current_State == 'Indiana')	{ $bad_states = $bad_states + 1; }
		if ($Current_State == 'Michigan')	{ $bad_states = $bad_states + 1; }
		if ($Current_State == 'Minnesota')	{ $bad_states = $bad_states + 1; }
		if ($Current_State == 'New York')	{ $bad_states = $bad_states + 1; }
		if ($Current_State == 'Texas')		{ $bad_states = $bad_states + 1; }
		$i++;
	}
	if ($testing != 0) {
		echo "Total Bad States: ".$bad_states;
	}
	// bad states: California, Florida, Georgia, Illinois, Indiana, Michigan, Minnesota, New York, Texas
	// geo score is total bad states divided by total states

	$interims = $gm_score;

	$gm_score = $gm_score + (66 * ($bad_states / ($TotalStates - 1)));
	if ($testing != 0) {
		echo "<br>Geographic Mix Score ($interims + (66 * ($bad_states / $TotalStates - 1))): ".$gm_score;
	}
	// END OF GEO SCORE

	// CIR = number of REPURCHASES divided by total number of UNITS

	// RALI_unit - where we get total units

	/* 
	 EPD="#reph1#"
	,FMR07="#reph4#"
	,Other="#reph6#"

	$reph_audit = 'select reph_audit.24M as REPH_24M,'
	.'reph_audit.EPD as REPH_EPD,'
	.'reph_audit.RD08 as REPH_RD08,'
	.'reph_audit.RD07 as REPH_RD07,'
	.'reph_audit.FMR07 as REPH_FMR07,'
	.'reph_audit.CIR as REPH_CIR,'
	.'reph_audit.CIR2 as REPH_CIR2,'
	.'reph_audit.Other as REPH_OTHER'
	.' from reph_audit where company_id='.$company_id.' and audit_id='.$audit_id.';';

	$result = mysql_query($reph_audit);
	$row = mysql_fetch_assoc($result);

	$REPH_24M		= $row['REPH_24M'];
	$REPH_EPD		= $row['REPH_EPD'];
	$REPH_RD08		= $row['REPH_RD08'];
	$REPH_RD07		= $row['REPH_RD07'];
	$REPH_FMR07		= $row['REPH_FMR07'];
	$REPH_CIR		= $row['REPH_CIR'];
	$REPH_CIR2		= $row['REPH_CIR2'];
	$REPH_OTHER		= $row['REPH_OTHER'];
	*/

	$cir = (($REPH_EPD+$REPH_FMR07+$REPH_OTHER) / $RALI_unit);

	if ($testing != 0) {
		echo "<br><br>Calculate CIR:<br>";
		echo "((REPH_EPD($REPH_EPD)+REPH_FMR07($REPH_FMR07)+REPH_OTHER($REPH_OTHER)) / Rali_Unit($RALI_unit))";
	}

	$repcir1 = round($cir,3);
//	$repcir2 = round($REPH_CIR2,3);
	$rh_score = 8;
	$cirlow = 0.003;
	$cirhigh = 0.006;

	if ($testing != 0) {
		echo "<br><br>Base Repurchase History Score (RH): ".$rh_score;
		echo "<br>CIR Low=$cirlow, CIR High=$cirhigh";
		echo "<br>If calculated CIR is less than $cirhigh and greater than $cirlow then deduct 2 points from RH";
		echo "<br>If calculated CIR is greater than $cirhigh then deduct 3 points from RH";
	}

	if ($repcir1 < $cirhigh and $repcir1 > $cirlow) { $rh_score = $rh_score -2; }
	if ($repcir1 > $cirhigh) { $rh_score = $rh_score -3; }
	if ($testing != 0) {
		echo "<br>Repurchase Claim Incident Rate (CIR): ".$repcir1;
	}
//	if ($repcir2 < $cirhigh and $repcir2 > $cirlow) { $rh_score = $rh_score -2; }
//	if ($repcir2 > $cirhigh) { $rh_score = $rh_score -3; }
//	if ($testing != 0) {
//		echo "<br><br>Repurchase Claim Incidenet Rate 2 (CIR2): ".$repcir2;
//	}
	$rh_score = $rh_score * 16;
	if ($testing != 0) {
		echo "<br>Repurchase History Score (RH * 16): ".$rh_score;
	}
	// END OF REPURCHASE HISTORY SCORE

	$wr_score = 0;
	$WHBad10 = 0;
	$WHBad5  = 0;

	if ($testing != 0) {
		echo "<br><br>Base Warehouse score: ".$wr_score;
		echo "<br>Calculations follow for each of the 5 possible warehouse lines:<br><br>";
	}

    if ($awla_cal1/$awla_aa1 > .1 and $awla_cal1/$awla_aa1 < .5) { $WHBad10 = $WHBad10 + 1; }
    if ($awla_cal1/$awla_aa1 > .5) { $WHBad5 = $WHBad5 + 1; }

	if ($testing != 0) {
		echo "if ($awla_cal1/$awla_aa1 > .1 and $awla_cal1/$awla_aa1 < .5) { $WHBad10 = $WHBad10 + 1; }<br>";
		echo "if ($awla_cal1/$awla_aa1 > .5) { $WHBad5 = $WHBad5 + 1; }<br>";
	}

    if ($awla_cal2/$awla_aa2 > .1 and $awla_cal2/$awla_aa2 < .5) { $WHBad10 = $WHBad10 + 1; }
    if ($awla_cal2/$awla_aa2 > .5) { $WHBad5 = $WHBad5 + 1; }

	if ($testing != 0) {
		echo "if ($awla_cal2/$awla_aa2 > .1 and $awla_cal2/$awla_aa2 < .5) { $WHBad10 = $WHBad10 + 1; }<br>";
		echo "if ($awla_cal2/$awla_aa2 > .5) { $WHBad5 = $WHBad5 + 1; }<br>";
	}

    if ($awla_cal3/$awla_aa3 > .1 and $awla_cal3/$awla_aa3 < .5) { $WHBad10 = $WHBad10 + 1; }
    if ($awla_cal3/$awla_aa3 > .5) { $WHBad5 = $WHBad5 + 1; }

	if ($testing != 0) {
		echo "if ($awla_cal3/$awla_aa3 > .1 and $awla_cal3/$awla_aa3 < .5) { $WHBad10 = $WHBad10 + 1; }<br>";
		echo "if ($awla_cal3/$awla_aa3 > .5) { $WHBad5 = $WHBad5 + 1; }<br>";
	}

    if ($awla_cal4/$awla_aa4 > .1 and $awla_cal4/$awla_aa4 < .5) { $WHBad10 = $WHBad10 + 1; }
    if ($awla_cal4/$awla_aa4 > .5) { $WHBad5 = $WHBad5 + 1; }

	if ($testing != 0) {
		echo "if ($awla_cal4/$awla_aa4 > .1 and $awla_cal4/$awla_aa4 < .5) { $WHBad10 = $WHBad10 + 1; }<br>";
		echo "if ($awla_cal4/$awla_aa4 > .5) { $WHBad5 = $WHBad5 + 1; }<br>";
	}

    if ($awla_cal5/$awla_aa5 > .1 and $awla_cal5/$awla_aa5 < .5) { $WHBad10 = $WHBad10 + 1; }
    if ($awla_cal5/$awla_aa5 > .5) { $WHBad5 = $WHBad5 + 1; }

	if ($testing != 0) {
		echo "if ($awla_cal5/$awla_aa5 > .1 and $awla_cal5/$awla_aa5 < .5) { $WHBad10 = $WHBad10 + 1; }<br>";
		echo "if ($awla_cal5/$awla_aa5 > .5) { $WHBad5 = $WHBad5 + 1; }<br>";
	}

    if ($WHBad5 < 1 and $WHBad10 < 1) { $wr_score = 4; } else {
      if ($WHBad5 > 0) { $wr_score = 2; }
      if ($WHBad10 > 0) { $wr_score = 1; }
	}

    $wr_score = $wr_score * 30;
	if ($testing != 0) {
		echo "<br>First warehouse component: ".$WHBad10;
		echo "<br>Second warehouse component: ".$WHBad5;
		echo "<br>Total Warehouse Score (WR): ".$wr_score;
	}
	// END WAREHOUSE

	$w = 0;

    $w = 120 - ((60 * $RALI_broker) / 100);
    $w = $w - ((60 * $RALI_corr) / 100);
	if (strtolower($ceo_ChangeMix) == 'yes') { $ch_score = $ch_score + 2; } else { $ch_score = $ch_score + 4; }
	if ($w > 60 and $ch_score < 4) { $ch_score = $w - 20; } else { $ch_score = $w; }
	if ($testing != 0) {
		echo "<br><br>Broker/Correspondence Score: ".$w;
		echo "<br>Channel Score (CH): ".$ch_score;
	}
	// END CHANNEL

	$or_score = 24;

	if (strtolower($CEO_TimeInMBI) == '0-4 years' or strtolower($CEO_TimeInMBI) == '0-4 yrs') { $or_score = $or_score - 3; }
	if (strtolower($CEO_TimeInMBI) == '5-9 years' or strtolower($CEO_TimeInMBI) == '5-9 yrs') { $or_score = $or_score - 2; }
	if (strtolower($CEO_TimeInBusiness) == '0-4 years' or strtolower($CEO_TimeInBusiness) == '0-4 yrs') { $or_score = $or_score - 3; }
	if (strtolower($ceo_VolumeUpDown) == 'up 31-40') { $or_score = $or_score - 1; }
	if (strtolower($ceo_VolumeUpDown) == 'up 41-50') { $or_score = $or_score - 2; }
	if (strtolower($ceo_VolumeUpDown) == 'up more than 50') { $or_score = $or_score - 3; }
	if (strtolower($ceo_VolumeUpDown) == 'down 31-40') { $or_score = $or_score - 1; }
	if (strtolower($ceo_VolumeUpDown) == 'down 41-50') { $or_score = $or_score - 2; }
	if (strtolower($ceo_VolumeUpDown) == 'down more than 50') { $or_score = $or_score - 3; }
	if (strtolower($susrej_Rejected) == 'yes') { $or_score = $or_score - 3; }
	if (strtolower($ceo_HasCounsel) == 'no') { $or_score = $or_score - 1; }
	if (strtolower($ceo_PendingAction) == 'no') { $or_score = $or_score - 3; }
	if (strtolower($ceo_Defendant) == 'no') { $or_score = $or_score - 3; }

	$or_score = $or_score * 3.7143;
	if ($testing != 0) {
		echo "<br><br>Organization Score (OR): ".$or_score;
	}
	// END ORGANIZATION

	$wlbet = 0;
	$wlbet2 = 0;
	$wl_score = 74;

	$wlbet = $awla_wl1+$awla_wl2+$awla_wl3+$awla_wl4+$awla_wl5;
	$wlbet2 = $awla_aa1+$awla_aa2+$awla_aa3+$awla_aa4+$awla_aa5;
	$wl_score = 74 * (1-($wlbet/$wlbet2));
	if ($testing != 0) {
		echo "<br><br>Warehouse Lines Score (indepenent of warehouse above) (WL): ".$wl_score;
	}
	// END WAREHOUSE LINES (additional to wr)

	$ReducedDoc = 15 * ($RALI_StatedDocPer+$RALI_NIVDocPer+($RALI_NINADocPer / 100));
	
	$LTVComp = 0;

    if ($RALI_ltv < 80) { $LTVComp = 0; }
    if ($RALI_ltv > 80 and $RALI_ltv < 85) { $LTVComp = $LTVComp -3; }
    if ($RALI_ltv > 85 and $RALI_ltv < 90) { $LTVComp = $LTVComp -6; }
    if ($RALI_ltv > 90 and $RALI_ltv < 95) { $LTVComp = $LTVComp -9; }
    if ($RALI_ltv > 95 and $RALI_ltv < 100) { $LTVComp = $LTVComp -12; }
    if ($RALI_ltv >= 100) { $LTVComp = $LTVComp -15; }

	$FicoComp = 0;

	if ($RALI_avgfico < 680) { $FicoComp = $FicoComp -15; }
    if ($RALI_avgfico > 680 and $RALI_avgfico < 705) { $FicoComp = $FicoComp -10; }
    if ($RALI_avgfico > 705 and $RALI_avgfico < 720) { $FicoComp = $FicoComp -5; }
    if ($RALI_avgfico >= 720) { $FicoComp = 0; }

	$SecComp = ((($RALI_SecondLienPer+$RALI_PiggySecPer) / 100) * -14);

	$LBComp = 0;

    if ($RALI_AvgLoanBalance >= 250000) { $LBComp = $LBComp -15; }
    if ($RALI_AvgLoanBalance > 175000 and $RALI_AvgLoanBalance < 250000) { $LBComp = $LBComp -10; }
    if ($RALI_AvgLoanBalance > 100000 and $RALI_AvgLoanBalance < 175000) { $LBComp = $LBComp -5; }
    if ($RALI_AvgLoanBalance <= 100000) { $LBComp = 0; }

	$pm_score = 74 + ($ReducedDoc + $LTVComp + $FicoComp + $SecComp + $LBComp);
	if ($testing != 0) {
		echo "<br><br>Product Mix Score (PM): ".$pm_score;
	}
	// END PRODUCT MIX

	$subtotal_score = $oc_score + $rh_score + $wr_score + $ch_score + $or_score + $pm_score + $gm_score + $wl_score + $ba_score;
	if ($testing != 0) {
		echo "<br><br>Subtotal (OC+RH+WR+CH+OR+PM+GM+WL): ".$subtotal_score;
	}
	// END SUBTOTAL

	if ($testing != 0) {
		echo "<br><br>File review is maxed due to not being checked in MOSA Lite so the following will not change: ";
	}


    $e1_vvoe = 0.1;
    $e1_cr   = 0.1;
    $e1_ftc  = 0.1;
    $e1_hud  = 0.1;
    $e1_own  = 0.1;
    $e1_ie   = 0.15;
    $e1_4506 = 0.15;
    $e1_ci   = 0.2;

	$AvgCompRate = 0;

	$cr1 = 100; // maximum value for VVOE Performed
	$cr2 = 100; // maximum value for VVOE source
	$cr3 = 100; // maximum value for Business License

	//if ($FR_VVOEPerformed > 0) { $cr1 = $FR_VVOEPerformed; }
	//if ($FR_VVOESource > 0) { $cr2 = $FR_VVOESource; }
	//if ($FR_BizLicense > 0) { $cr3 = $FR_BizLicense; }

	$AvgCompRate = $AvgCompRate + ((($cr1/100)+($cr2/100)+($cr3/100)) * $e1_vvoe);

	if ($testing != 0) {
		echo "<br>Current AvgCompRate: ".$AvgCompRate;
	}
	
	$FR_CreditRepComp = 100; // maxed for ml
	
    if ($FR_CreditRepComp != '') { $AvgCompRate = $AvgCompRate + ($FR_CreditRepComp * $e1_cr); } else {
		$AvgCompRate = $AvgCompRate + (1 * $e1_cr); 
	  }

	if ($testing != 0) {
		echo "<br>Current AvgCompRate: ".$AvgCompRate;
	}

	$FR_FTCComp = 100; // maxed for ml

    if ($FR_FTCComp != '') { $AvgCompRate = $AvgCompRate + ($FR_FTCComp * $e1_ftc); } else {
		$AvgCompRate = $AvgCompRate + (1 * $e1_ftc); 
	  }

	if ($testing != 0) {
		echo "<br>Current AvgCompRate: ".$AvgCompRate;
	}

	$FR_HUD1Comp = 100; // maxed for ml

    if ($FR_HUD1Comp != '') { $AvgCompRate = $AvgCompRate + ($FR_HUD1Comp * $e1_hud); } else {
		$AvgCompRate = $AvgCompRate + (1 * $e1_hud); 
	  }

	if ($testing != 0) {
		echo "<br>Current AvgCompRate: ".$AvgCompRate;
	}

	$FR_SellerOwnerComp = 100; // maxed for ml

    if ($FR_SellerOwnerComp != '') { $AvgCompRate = $AvgCompRate + ($FR_SellerOwnerComp * $e1_own); } else {
		$AvgCompRate = $AvgCompRate + (1 * $e1_own); 
	  }

	if ($testing != 0) {
		echo "<br>Current AvgCompRate: ".$AvgCompRate;
	}

	$FR_IEComp = 100; // maxed for ml

    if ($FR_IEComp != '') { $AvgCompRate = $AvgCompRate + ($FR_IEComp * $e1_ie); } else {
		$AvgCompRate = $AvgCompRate + (1 * $e1_ie); 
	  }

	if ($testing != 0) {
		echo "<br>Current AvgCompRate: ".$AvgCompRate;
	}

	$FR_4506TComp = 100; // maxed for ml

    if ($FR_4506TComp != '') { $AvgCompRate = $AvgCompRate + ($FR_4506TComp * $e1_4506); } else {
		$AvgCompRate = $AvgCompRate + (1 * $e1_4506); 
	  }

	if ($testing != 0) {
		echo "<br>Current AvgCompRate: ".$AvgCompRate;
	}

	$FR_CIComp = 100; // maxed for ml

    if ($FR_CIComp != '') { $AvgCompRate = $AvgCompRate + ($FR_CIComp * $e1_ci); } else {
		$AvgCompRate = $AvgCompRate + (1 * $e1_ci); 
	  }

	if ($testing != 0) {
		echo "<br>Current AvgCompRate: ".$AvgCompRate;
	}

	$AvgCompRate = $AvgCompRate / 100;

	if ($testing != 0) {
		echo "<br><br>File Review Score: ".$AvgCompRate;
	}
	// END FILE REVIEW MULTIPLIERS

	$cirimpact = 0;

	if ($testing != 0) {
		echo "<br><br>Base CIR impact: $cirimpact";
	}


	$RALI_cir = (($REPH_EPD+$REPH_FMR07+$REPH_OTHER) / $RALI_unit);
	if ($testing != 0) {
		echo "<br>Claim Incident Rate (Same calculation parameters as above CIR calc):".$RALI_cir;
	}
	if ($RALI_cir == 0) { $cirimpact = $cirimpact + 20; }
	if ($testing != 0) {
		echo "<br>(If CIR = 0 then add 20 to CIR Impact) Current CIR Impact: ".$cirimpact;
	}
    if ($RALI_cir > 0      and $RALI_cir < 0.001) { $cirimpact = $cirimpact + 10; }
	if ($testing != 0) {
		echo "<br>(If CIR > 0 and < .001 then add 10 to CIR Impact) Current CIR Impact: ".$cirimpact;
	}
	if ($RALI_cir > 0.001  and $RALI_cir < 0.002) { $cirimpact = $cirimpact + 0; }
	if ($testing != 0) {
		echo "<br>(If CIR > .001 and < .002 then add 0 to CIR Impact) Current CIR Impact: ".$cirimpact;
	}
    if ($RALI_cir > 0.002  and $RALI_cir < 0.003) { $cirimpact = $cirimpact - 10; }
	if ($testing != 0) {
		echo "<br>(If CIR > .002 and < .003 then subtract 10 from CIR Impact) Current CIR Impact: ".$cirimpact;
	}
	if ($RALI_cir > 0.003) { $cirimpact = $cirimpact - 20; }
	if ($testing != 0) {
		echo "<br>(If CIR > .003 then subtract 20 from CIR Impact) Current CIR Impact: ".$cirimpact;
	}
	if ($testing != 0) {
		echo "<br>Final CIR Impact: ".$cirimpact;
	}

	// END CIR IMPACT

	$mosa_score = 0;

	$mosa_score = (($subtotal_score * $AvgCompRate) + $cirimpact);

	// this should never happen, but it did, so in case it does it again I'm forcing it to at least a sane number
	if ($mosa_score < 0) { $mosa_score = 0; }
	if ($mosa_score > 800) { $mosa_score = 800; }

	if ($testing != 0) {
		echo "<br><br>MOSA Score is ((subtotal score($subtotal_score) * AverageCompRate($AvgCompRate)) + CIR Impact($cirimpact))";
		echo "<br>MOSA Score: ".$mosa_score;

		echo "<br><br>Company ID: ". $company_id . "<br>";
		echo "Audit ID: ". $aid . "<br><br>";
	}
	// END MOSA SCORE

	$dbhost = 'localhost:3308';
	$dbuser = 'root';
	$dbpass = 'T3rminal7';
	$dbname = 'ml_design';

	$opendb   = mysql_connect($dbhost, $dbuser, $dbpass) or die("Unable to connect to MySQL");
	$selectdb = mysql_select_db($dbname, $opendb) or die("Could not select clients: $selectdb");
	$date = date("Y-m-d");
	$doinsert = "insert into scores (company_id, audit_id, mosa_score, date) values ($company_id,$audit_id,$mosa_score,$date)";
	mysql_query($doinsert);

?>
