<?php
//global includes
require "../../../conf/props.php";

//make the properties
$properties = new properties();

//include connect stuff
include "../../../conf/connect.php";

// you can access the values posted by jQuery.ajax
// through the global variable $_POST, like this:
@$directive=$_GET['directive'];
@$uid=$_GET['uid'];
@$bid=$_GET['bid'];
@$setto=$_GET['setto'];
@$weburl=$_GET['weburl'];

mysql_query("UPDATE {$properties->DB_PREFIX}".$directive." SET status='".$setto."' WHERE uid='".$uid."' AND bid='".$bid."'") or die(mysql_error());

/* CHECK FOR OLDER MESSAGES */
$CHECK_FOR_BADGE_MESSAGES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$directive." WHERE uid='$uid' AND status='unread' ORDER BY date_received DESC LIMIT 1");
if(mysql_num_rows($CHECK_FOR_BADGE_MESSAGES)<1){
	echo "no more messages";
} else {
	/* GET THE NEXT AVAILABLE MESSAGE */
	while($FETCH_BADGE_MESSAGES=mysql_fetch_array($CHECK_FOR_BADGE_MESSAGES)){
		$message_bid=$FETCH_BADGE_MESSAGES['bid'];
		$message_dr=$FETCH_BADGE_MESSAGES['date_received'];
	}
	
	/* FIND THE BID DETAILS */
	$LOOKUP_BID=mysql_query("SELECT * FROM {$properties->DB_PREFIX}badges WHERE id='$bid'");
	if(mysql_num_rows($LOOKUP_BID)<1){
		/* SOMETHING WENT WRONG */	
	} else {
		while($FETCH_BID_DETAILS=mysql_fetch_array($LOOKUP_BID)){
			$message_bidname=$FETCH_BID_DETAILS['name'];
		}
	}
	
	/* DETERMINE HOW LONG AGO THEY WON THE ACHIEVEMENT */
	/* STEP 1: SET UP THE DATES */
	$todaydate		= date("Y-m-d");
	$receiveddate	= substr($message_dr,0,10);
	
	/* STEP 2: SEPARATE THE YEAR, MONTH, AND DAY */
	$todaydate_y	= substr($todaydate,0,4);
	$todaydate_m	= substr($todaydate,5,2);
	$todaydate_d	= substr($todaydate,8,2);
	
	$todaydate_h	= substr($todaydate,11,2);
	$todaydate_i	= substr($todaydate,14,2);
	$todaydate_s	= substr($todaydate,17,2);
			
	$receiveddate_y	= substr($receiveddate,0,4);
	$receiveddate_m	= substr($receiveddate,5,2);
	$receiveddate_d	= substr($receiveddate,8,2);
	
	$receiveddate_h	= substr($receiveddate,11,2);
	$receiveddate_i	= substr($receiveddate,14,2);
	$receiveddate_s	= substr($receiveddate,17,2);
	
				
	/* STEP 3: FIND OUT HOW MANY DAYS ARE BETWEEN THE DATES */
	$days=0;
	$days+=($todaydate_y - $receiveddate_y) * 365;
	$days+=(($todaydate_m - $receiveddate_m) * 4.34812) * 7;
	$days+=$todaydate_d - $receiveddate_d;
	
	$days=round($days,0);
	
	/* FIND OUT HOW MANY MINUTES ARE BETWEEN THE TIMES */
	$minutes=0;
	$minutes+=($todaydate_h - $receiveddate_h) * 60;
	$minutes+=$todaydate_i - $receiveddate_i;
		
	/* STEP 4: TWEAK UP */			
	if($days<1){$tense="have";$ending="s";}else if($days>0 && $days<2){$tense="had";$ending="";}else if($days>1){$tense="had";$ending="s";}									
	if($days>0){$the_real_ending_days="{$days} day{$ending} ago";}else{$the_real_ending_days="today";}
						
	//weeks
	$weeks=$days / 7;			
	$weeks=round($weeks,0);
	if($weeks<1){$ending="s";}else if($weeks>0 && $weeks<2){$ending="";}else if($weeks>1){$ending="s";}
	if($weeks>1){$the_real_ending_days="{$weeks} week{$ending} ago";}
	
	//months
	if($weeks>4.34812){$months=$weeks / 4.34812;$months=round($months,0);}
	if($months<1){$ending="s";}else if($months>0 && $months<2){$ending="";}else if($months>1){$ending="s";}
	if($months>=1){$the_real_ending_days="{$months} month{$ending} ago";}
	
	//months
	if($months>12){$years=$months / 12;$years=round($years,0);}
	if($years<1){$ending="s";}else if($years>0 && $years<2){$ending="";}else if($years>1){$ending="s";}
	if($years>=1){$the_real_ending_days="{$years} year{$ending} ago";}
	
	//days
	if($minutes<1){$ending="s";}else if($days>0 && $days<2){$ending="";}else if($days>1){$ending="s";}									
	if($days>0){/* NOT THE SAME DAY */} else {				
		if($minutes>0){
			$hours=0;
			if($hours==0){$hour_string="";}
			if($minutes > 59){
				/* HOUR MARK */
				$hours=$minutes / 60;
				/* FIND REMAINING MIN DECIMAL */
				$remain_min_decimal=substr($hours,strpos($hours,"."));
				$minutes=60 * $remain_min_decimal; //gets the remaining mins
				$minutes=round($minutes,0);
				$hours=round($hours,0);
				if($hours<1){$hours_ending="s";}else if($hours>0 && $hours<2){$hours_ending="";}else if($hours>1){$hours_ending="s";}
				$hour_string=$hours." hour{$hours_ending} ";
				if($minutes<1){/* NO MINUTES */}else{if($minutes>0 && $minutes<1){$minutes_ending="";}else if($minutes>1){$minutes_ending="s";}$minutes_string="and {$minutes} minute{$minutes_ending} ago";}
			} else {
				if($minutes<1){/* NO MINUTES */}else{if($minutes>0 && $minutes<1){$minutes_ending="";}else if($minutes>1){$minutes_ending="s";}$minutes_string="{$minutes} minute{$minutes_ending} ago";}
			}
			$the_real_ending_minutes=" (about {$hour_string}{$minutes_string})";
		} else {
			$the_real_ending_minutes=" (now)";
		}
	}
	
	/* STEP 4: DISPLAY */
	echo "ATTENTION! You have won the ".$message_bidname." achievement {$the_real_ending_days}! <a id=\"dismissClick\" onclick=\"actioncenter('users_achievements','".$uid."','".$message_bid."','read','".$weburl."')\" class=\"black-url\" style=\"color: black;cursor: pointer;\">Dismiss</a>";
	/* END FIND THE BID DETAILS */
	/* END GET THE NEXT AVAILABLE MESSAGE */
}

?>