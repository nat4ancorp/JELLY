<?php
//global includes
require "../../../conf/props.php";

//make the properties
$properties = new properties();

$properties->setServerTime();

//include connect stuff
include "../../../conf/connect.php";

// you can access the values posted by jQuery.ajax
// through the global variable $_POST, like this:
/* RESET VARIABLES */
$value			= "";
$error_console	= "";
$canLogged		= 0;
$isAComment		= 0;
$isABadge		= 0;
$isABComment	= 0;

/* DETERMINE THE WEBSITE_URL */
if($_SERVER['HTTP_HOST']=="localhost"){$WEBSITE_URL=$properties->WEBSITE_TEST_URL;}else{$WEBSITE_URL=$properties->WEBSITE_REMO_URL;}

/* STEP 1: GET VARIABLES */
@$entryid=$_GET['entryid'];
@$type=$_GET['type'];
@$weburl=$_GET['weburl'];
@$uid=$_GET['uid'];
@$uip=$_GET['uip'];
@$page=$_GET['page'];
@$foruid=$_GET['foruid'];

/* CATCH IF ENTRY ID HAS A bid: ATTACHED ITEM */
if(strpos($entryid,"=")!=""){
	/* DECIDE IF IT IS FOR REGULAR OR A COMMENT ON BADGE */
	if(strpos($entryid,":")!=""){		
		/* THERE IS AN ITEM ATTACHED TO ENTRY ID WITH A BADGE COMMENT */
		$isABComment		= 1;
		$ENTRYID_LIST=explode(":",$entryid);
		$bid			= $ENTRYID_LIST[0];
		$bid			= substr($bid,4,1);
		$commentid		= $ENTRYID_LIST[1];		
		$isABadge		= 1; //turn off this to avoid conflicts
	} else {
		/* THERE IS AN ITEM ATTACHED TO ENTRY ID */
		$isABadge		= 1;
		$ENTRYID_LIST	= explode("=",$entryid);
		$bid			= $ENTRYID_LIST[1]; // ex. bid=1
		//$bid			= substr($bid,4,1);
		$isAComment		= 0; //turn off this to avoid conflicts
	}
} else {
	/* CATCH IF ENTRY ID HAS A : ATTACHED ITEM */
	if(strpos($entryid,":")!=""){
		/* THERE IS AN ITEM ATTACHED TO ENTRY ID */
		$isAComment		= 1;
		$ENTRYID_LIST=explode(":",$entryid);
		$entryid		= $ENTRYID_LIST[0];
		$commentid		= $ENTRYID_LIST[1];
		$isABadge		= 0; //turn off this to avoid conflicts
	}	
}



$todaydate=date("Y-m-d");

/* DETECT IF LOGGED IN */
if($uid!=0){
	/* LOGGED; GO BY UID */	
	/* DETERMINE IF COMMENT ID IS SET */
	if($isAComment==1){
		/* COMMENT ID SET; USER IS LIKING A COMMENT */
		/* FIND OUT IF UID HAS LIKED THE SAME ENTRYID WITHIN A 24-HOUR PERIOD */
		$CHECK_UID=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE onpage='$page' AND entryid='$entryid' AND uid='$uid' AND thumbitem='comment' AND commentid='$commentid'") or die(mysql_error());
		if(mysql_num_rows($CHECK_UID)<1){
			/* UID HAS NOT LIKED IT EVER; NOR HAS LIKED ANYTHING; DO INSERT */
			mysql_query("INSERT INTO {$properties->DB_PREFIX}thumbs (onpage,entryid,commentid,type,uid,ip,last_like,thumbitem,foruid) VALUES ('$page','$entryid','$commentid','$type','$uid','$uip','$todaydate','comment','$foruid')") or die(mysql_error());				
	
			/* GET THE NEW DATA VALUE FOR THE NUMBER */
			$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND entryid='$entryid' AND commentid='$commentid' AND thumbitem='comment'");
			if(mysql_num_rows($GET_VAL_LIKES)<1){
				$numberOfLikes=0;			
			} else {
				$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
			}
			$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND entryid='$entryid' AND commentid='$commentid' AND thumbitem='comment'");
			if(mysql_num_rows($GET_VAL_DISLIKES)<1){
				$numberOfDisLikes=0;			
			} else {
				$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
			}
			$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
			echo $value;
			
			if($foruid>0){
				if($uid!=$foruid){
					/* UID IS LIKING SOMETHING THAT IS NOT THERE OWN */
					/* FOR A USER */
					/* IF UID>1 THEN CHECK FOR A BADGE THAT AWARDS THEM FOR GETTING A LIKE FIRST THE FIRST TIME ON A COMMENT */
					$weburl=$WEBSITE_URL;
					/* FIND THE BID OF THE BADGE THAT HAS A REQUIREMENT OF 1likeoncomment */
					$REQUIREMENTS="Someone other than you must like one of your comments";
					$FIND_BID_OF_REQUIRE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}badges WHERE requirements='".$REQUIREMENTS."'");
					if(mysql_num_rows($FIND_BID_OF_REQUIRE)<1){
						/* SOMETHING WENT WRONG */
					} else {
						while($FETCH_BID_OF_REQUIRE=mysql_fetch_array($FIND_BID_OF_REQUIRE)){
							$theBID=$FETCH_BID_OF_REQUIRE['id'];
						}
						runAchievementCheck('firstCommentLiked',$properties,$foruid,$weburl);
					}
				} else {
					/* UID IS THE SAME AS THE UID OF THE COMMENT */	
				}
			}
		} else {
			/* UID HAS LIKED IT; CHECK TO SEE IF IT HAS BEEN 24 HOURS OR CHECK FOR OPPOSITE ACTION (if like = dislike; if dislike - like*/
			while($FETCH_UID=mysql_fetch_array($CHECK_UID)){
				$last_like=$FETCH_UID['last_like'];
				$lldate=$FETCH_UID['last_like'];
				$indbtype=$FETCH_UID['type'];
			}
			if($type==$indbtype){
				/* SAME TYPE; CHECK LAST DATE */
				/* 2013-06-24 = TODAY */
				/* 0123456789 		  */
				/* BREAK THE DATES APART */
				$todaydate_y=substr($todaydate,0,4);
				$todaydate_m=substr($todaydate,5,2);
				$todaydate_d=substr($todaydate,8,2);
				
				$lldate_y=substr($lldate,0,4);
				$lldate_m=substr($lldate,5,2);
				$lldate_d=substr($lldate,8,2);
				
				$dif_btw_dates_days=0;
				
				$dif_btw_dates_y=$todaydate_y - $lldate_y; //2013
				/* CONVERT TO DAYS */
				$dif_btw_dates_days=$dif_btw_dates_days+($dif_btw_dates_y * 365);
				
				$dif_btw_dates_m=$todaydate_m - $lldate_m;
				/* CONVERT TO DAYS */
				$dif_btw_dates_days=$dif_btw_dates_days+(($dif_btw_dates_m * 4.34812) * 7);
				
				$dif_btw_dates_d=$todaydate_d - $lldate_d;
				/* CONVERT TO DAYS */
				$dif_btw_dates_days=$dif_btw_dates_days+$dif_btw_dates_d;
				
				if($dif_btw_dates_days<1){/* SAME DAY */$canLogged=0;}else{/* GREATER THAN A DAY; GOOD TO GO */$canLogged=1;}
				
				if($canLogged==1){
					/* DO IT */
					mysql_query("INSERT INTO {$properties->DB_PREFIX}thumbs (onpage,entryid,commentid,type,uid,ip,last_like,thumbitem,foruid) VALUES ('$page','$entryid','$commentid','$type','$uid','$uip','$todaydate','comment','$foruid')") or die(mysql_error());
		
					/* GET THE NEW DATA VALUE FOR THE NUMBER */
					$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND entryid='$entryid' AND commentid='$commentid' AND thumbitem='comment'");
					if(mysql_num_rows($GET_VAL_LIKES)<1){
						$numberOfLikes=0;			
					} else {
						$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
					}
					$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND entryid='$entryid' AND commentid='$commentid' AND thumbitem='comment'");
					if(mysql_num_rows($GET_VAL_DISLIKES)<1){
						$numberOfDisLikes=0;			
					} else {
						$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
					}
					$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
					echo $value;
					
				} else if($canLogged==0) {
					/* NO GO */
					/* GET THE NEW DATA VALUE FOR THE NUMBER */
					$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND entryid='$entryid' AND commentid='$commentid' AND thumbitem='comment'");
					if(mysql_num_rows($GET_VAL_LIKES)<1){
						$numberOfLikes=0;			
					} else {
						$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
					}
					$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND entryid='$entryid' AND commentid='$commentid' AND thumbitem='comment'");
					if(mysql_num_rows($GET_VAL_DISLIKES)<1){
						$numberOfDisLikes=0;			
					} else {
						$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
					}
					$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
					echo $value;
				}
			} else {
				/* SAME DATE; OPPOSITE TYPE; THEY ARE GOING FOR THE SWITCH-A-ROO */
				mysql_query("UPDATE {$properties->DB_PREFIX}thumbs SET type='$type' WHERE onpage='$page' AND entryid='$entryid' AND commentid='$commentid' AND uid='$uid' AND last_like='$todaydate' AND thumbitem='comment'");
				
				/* GET THE NEW DATA VALUE FOR THE NUMBER */
				$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND entryid='$entryid' AND commentid='$commentid' AND thumbitem='comment'");
				if(mysql_num_rows($GET_VAL_LIKES)<1){
					$numberOfLikes=0;			
				} else {
					$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
				}
				$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND entryid='$entryid' AND commentid='$commentid' AND thumbitem='comment'");
				if(mysql_num_rows($GET_VAL_DISLIKES)<1){
					$numberOfDisLikes=0;			
				} else {
					$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
				}
				$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
				echo $value;
			}		
		}
	}
	if($isABadge==1){
		/* DECIDE IF IT IS FOR A COMMENT ON A BADGE OR IF IT IS FOR THE BADGE ITSELF */
		if($isABComment==1){
			/* BADGE COMMENT */
			/* BADGE ID SET; USER IS LIKING A BADGE */
			/* FIND OUT IF UID HAS LIKED THE SAME ENTRYID WITHIN A 24-HOUR PERIOD */
			$CHECK_UID=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE onpage='$page' AND uid='$uid' AND thumbitem='badge' AND badgeid='$bid' AND commentid='$commentid'") or die(mysql_error());
			if(mysql_num_rows($CHECK_UID)<1){
				/* UID HAS NOT LIKED IT EVER; NOR HAS LIKED ANYTHING; DO INSERT */
				mysql_query("INSERT INTO {$properties->DB_PREFIX}thumbs (onpage,entryid,commentid,type,uid,ip,last_like,thumbitem,foruid,badgeid) VALUES ('$page','0','$commentid','$type','$uid','$uip','$todaydate','badge','$foruid','$bid')") or die(mysql_error());
		
				/* GET THE NEW DATA VALUE FOR THE NUMBER */
				$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND badgeid='$bid' AND thumbitem='badge' AND commentid='$commentid'");
				if(mysql_num_rows($GET_VAL_LIKES)<1){
					$numberOfLikes=0;			
				} else {
					$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
				}
				$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND badgeid='$bid' AND thumbitem='badge' AND commentid='$commentid'");
				if(mysql_num_rows($GET_VAL_DISLIKES)<1){
					$numberOfDisLikes=0;			
				} else {
					$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
				}
				$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
				echo $value;
				
				if($foruid>0){
					if($uid!=$foruid){
						/* UID IS LIKING SOMETHING THAT IS NOT THERE OWN */
						/* FOR A USER */
						/* IF UID>1 THEN CHECK FOR A BADGE THAT AWARDS THEM FOR GETTING A LIKE FIRST THE FIRST TIME ON A COMMENT */
						$weburl=$WEBSITE_URL;
						/* FIND THE BID OF THE BADGE THAT HAS A REQUIREMENT OF 1likeoncomment */
						$REQUIREMENTS="Someone other than you must like one of your comments";
						$FIND_BID_OF_REQUIRE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}badges WHERE requirements='".$REQUIREMENTS."'");
						if(mysql_num_rows($FIND_BID_OF_REQUIRE)<1){
							/* SOMETHING WENT WRONG */
						} else {
							while($FETCH_BID_OF_REQUIRE=mysql_fetch_array($FIND_BID_OF_REQUIRE)){
								$theBID=$FETCH_BID_OF_REQUIRE['id'];
							}
							runAchievementCheck('firstCommentLiked',$properties,$foruid,$weburl);
						}
					} else {
						/* UID IS THE SAME AS THE UID OF THE COMMENT */	
					}
				}
			} else {
				/* UID HAS LIKED IT; CHECK TO SEE IF IT HAS BEEN 24 HOURS OR CHECK FOR OPPOSITE ACTION (if like = dislike; if dislike - like*/
				while($FETCH_UID=mysql_fetch_array($CHECK_UID)){
					$last_like=$FETCH_UID['last_like'];
					$lldate=$FETCH_UID['last_like'];
					$indbtype=$FETCH_UID['type'];
				}
				if($type==$indbtype){
					/* SAME TYPE; CHECK LAST DATE */
					/* 2013-06-24 = TODAY */
					/* 0123456789 		  */
					/* BREAK THE DATES APART */
					$todaydate_y=substr($todaydate,0,4);
					$todaydate_m=substr($todaydate,5,2);
					$todaydate_d=substr($todaydate,8,2);
					
					$lldate_y=substr($lldate,0,4);
					$lldate_m=substr($lldate,5,2);
					$lldate_d=substr($lldate,8,2);
					
					$dif_btw_dates_days=0;
					
					$dif_btw_dates_y=$todaydate_y - $lldate_y; //2013
					/* CONVERT TO DAYS */
					$dif_btw_dates_days=$dif_btw_dates_days+($dif_btw_dates_y * 365);
					
					$dif_btw_dates_m=$todaydate_m - $lldate_m;
					/* CONVERT TO DAYS */
					$dif_btw_dates_days=$dif_btw_dates_days+(($dif_btw_dates_m * 4.34812) * 7);
					
					$dif_btw_dates_d=$todaydate_d - $lldate_d;
					/* CONVERT TO DAYS */
					$dif_btw_dates_days=$dif_btw_dates_days+$dif_btw_dates_d;
					
					if($dif_btw_dates_days<1){/* SAME DAY */$canLogged=0;}else{/* GREATER THAN A DAY; GOOD TO GO */$canLogged=1;}
					
					if($canLogged==1){
						/* DO IT */
						mysql_query("INSERT INTO {$properties->DB_PREFIX}thumbs (onpage,entryid,commentid,type,uid,ip,last_like,thumbitem,foruid,badgeid) VALUES ('$page','0','$commentid','$type','$uid','$uip','$todaydate','badge','$foruid','$bid')") or die(mysql_error());
			
						/* GET THE NEW DATA VALUE FOR THE NUMBER */
						$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND badgeid='$bid' AND thumbitem='badge' AND commentid='$commentid'");
						if(mysql_num_rows($GET_VAL_LIKES)<1){
							$numberOfLikes=0;			
						} else {
							$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
						}
						$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND badgeid='$bid' AND thumbitem='badge' AND commentid='$commentid'");
						if(mysql_num_rows($GET_VAL_DISLIKES)<1){
							$numberOfDisLikes=0;			
						} else {
							$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
						}
						$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
						echo $value;
						
					} else if($canLogged==0) {
						/* NO GO */
						/* GET THE NEW DATA VALUE FOR THE NUMBER */
						$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND badgeid='$bid' AND thumbitem='badge' AND commentid='$commentid'");
						if(mysql_num_rows($GET_VAL_LIKES)<1){
							$numberOfLikes=0;			
						} else {
							$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
						}
						$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND badgeid='$bid' AND thumbitem='badge' AND commentid='$commentid'");
						if(mysql_num_rows($GET_VAL_DISLIKES)<1){
							$numberOfDisLikes=0;			
						} else {
							$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
						}
						$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
						echo $value;
					}
				} else {
					/* SAME DATE; OPPOSITE TYPE; THEY ARE GOING FOR THE SWITCH-A-ROO */
					mysql_query("UPDATE {$properties->DB_PREFIX}thumbs SET type='$type' WHERE onpage='$page' AND badgeid='$bid' AND uid='$uid' AND last_like='$todaydate' AND thumbitem='badge' AND commentid='$commentid'") or die(mysql_error()." on line 277 of doThumb.php");
					
					/* GET THE NEW DATA VALUE FOR THE NUMBER */
					$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND badgeid='$bid' AND thumbitem='badge' AND commentid='$commentid'");
					if(mysql_num_rows($GET_VAL_LIKES)<1){
						$numberOfLikes=0;			
					} else {
						$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
					}
					$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND badgeid='$bid' AND thumbitem='badge' AND commentid='$commentid'");
					if(mysql_num_rows($GET_VAL_DISLIKES)<1){
						$numberOfDisLikes=0;			
					} else {
						$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
					}
					$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
					echo $value;
				}		
			}
		} else {
			/* REGULAR BADGE LIKE */
			/* BADGE ID SET; USER IS LIKING A BADGE */
			/* FIND OUT IF UID HAS LIKED THE SAME ENTRYID WITHIN A 24-HOUR PERIOD */
			$CHECK_UID=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE onpage='$page' AND uid='$uid' AND thumbitem='badge' AND badgeid='$bid' AND commentid='0'") or die(mysql_error());
			if(mysql_num_rows($CHECK_UID)<1){
				/* UID HAS NOT LIKED IT EVER; NOR HAS LIKED ANYTHING; DO INSERT */
				mysql_query("INSERT INTO {$properties->DB_PREFIX}thumbs (onpage,entryid,commentid,type,uid,ip,last_like,thumbitem,foruid,badgeid) VALUES ('$page','0','0','$type','$uid','$uip','$todaydate','badge','$foruid','$bid')") or die(mysql_error());
		
				/* GET THE NEW DATA VALUE FOR THE NUMBER */
				$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND badgeid='$bid' AND thumbitem='badge' AND commentid='0'");
				if(mysql_num_rows($GET_VAL_LIKES)<1){
					$numberOfLikes=0;			
				} else {
					$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
				}
				$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND badgeid='$bid' AND thumbitem='badge' AND commentid='0'");
				if(mysql_num_rows($GET_VAL_DISLIKES)<1){
					$numberOfDisLikes=0;			
				} else {
					$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
				}
				$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
				echo $value;
			} else {
				/* UID HAS LIKED IT; CHECK TO SEE IF IT HAS BEEN 24 HOURS OR CHECK FOR OPPOSITE ACTION (if like = dislike; if dislike - like*/
				while($FETCH_UID=mysql_fetch_array($CHECK_UID)){
					$last_like=$FETCH_UID['last_like'];
					$lldate=$FETCH_UID['last_like'];
					$indbtype=$FETCH_UID['type'];
				}
				if($type==$indbtype){
					/* SAME TYPE; CHECK LAST DATE */
					/* 2013-06-24 = TODAY */
					/* 0123456789 		  */
					/* BREAK THE DATES APART */
					$todaydate_y=substr($todaydate,0,4);
					$todaydate_m=substr($todaydate,5,2);
					$todaydate_d=substr($todaydate,8,2);
					
					$lldate_y=substr($lldate,0,4);
					$lldate_m=substr($lldate,5,2);
					$lldate_d=substr($lldate,8,2);
					
					$dif_btw_dates_days=0;
					
					$dif_btw_dates_y=$todaydate_y - $lldate_y; //2013
					/* CONVERT TO DAYS */
					$dif_btw_dates_days=$dif_btw_dates_days+($dif_btw_dates_y * 365);
					
					$dif_btw_dates_m=$todaydate_m - $lldate_m;
					/* CONVERT TO DAYS */
					$dif_btw_dates_days=$dif_btw_dates_days+(($dif_btw_dates_m * 4.34812) * 7);
					
					$dif_btw_dates_d=$todaydate_d - $lldate_d;
					/* CONVERT TO DAYS */
					$dif_btw_dates_days=$dif_btw_dates_days+$dif_btw_dates_d;
					
					if($dif_btw_dates_days<1){/* SAME DAY */$canLogged=0;}else{/* GREATER THAN A DAY; GOOD TO GO */$canLogged=1;}
					
					if($canLogged==1){
						/* DO IT */
						mysql_query("INSERT INTO {$properties->DB_PREFIX}thumbs (onpage,entryid,commentid,type,uid,ip,last_like,thumbitem,foruid,badgeid) VALUES ('$page','0','0','$type','$uid','$uip','$todaydate','badge','$foruid','$bid')") or die(mysql_error());
			
						/* GET THE NEW DATA VALUE FOR THE NUMBER */
						$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND badgeid='$bid' AND thumbitem='badge'");
						if(mysql_num_rows($GET_VAL_LIKES)<1){
							$numberOfLikes=0;			
						} else {
							$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
						}
						$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND badgeid='$bid' AND thumbitem='badge'");
						if(mysql_num_rows($GET_VAL_DISLIKES)<1){
							$numberOfDisLikes=0;			
						} else {
							$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
						}
						$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
						echo $value;
						
					} else if($canLogged==0) {
						/* NO GO */
						/* GET THE NEW DATA VALUE FOR THE NUMBER */
						$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND badgeid='$bid' AND thumbitem='badge' AND commentid='0'");
						if(mysql_num_rows($GET_VAL_LIKES)<1){
							$numberOfLikes=0;			
						} else {
							$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
						}
						$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND badgeid='$bid' AND thumbitem='badge' AND commentid='0'");
						if(mysql_num_rows($GET_VAL_DISLIKES)<1){
							$numberOfDisLikes=0;			
						} else {
							$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
						}
						$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
						echo $value;
					}
				} else {
					/* SAME DATE; OPPOSITE TYPE; THEY ARE GOING FOR THE SWITCH-A-ROO */
					mysql_query("UPDATE {$properties->DB_PREFIX}thumbs SET type='$type' WHERE onpage='$page' AND badgeid='$bid' AND uid='$uid' AND last_like='$todaydate' AND thumbitem='badge' AND commentid='0'") or die(mysql_error()." on line 277 of doThumb.php");
					
					/* GET THE NEW DATA VALUE FOR THE NUMBER */
					$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND badgeid='$bid' AND thumbitem='badge' AND commentid='0'");
					if(mysql_num_rows($GET_VAL_LIKES)<1){
						$numberOfLikes=0;			
					} else {
						$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
					}
					$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND badgeid='$bid' AND thumbitem='badge' AND commentid='0'");
					if(mysql_num_rows($GET_VAL_DISLIKES)<1){
						$numberOfDisLikes=0;			
					} else {
						$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
					}
					$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
					echo $value;
				}		
			}
		}
	} 
	if($isABadge==0 && $isAComment==0){
		/* COMMENT OR BADGE ID NOT SET; USER IS LIKING AN ENTRY */
		/* FIND OUT IF UID HAS LIKED THE SAME ENTRYID WITHIN A 24-HOUR PERIOD */
		$CHECK_UID=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE onpage='$page' AND entryid='$entryid' AND uid='$uid' AND thumbitem='entry' AND commentid='0'") or die(mysql_error());
		if(mysql_num_rows($CHECK_UID)<1){
			/* UID HAS NOT LIKED IT EVER; NOR HAS LIKED ANYTHING; DO INSERT */
			mysql_query("INSERT INTO {$properties->DB_PREFIX}thumbs (onpage,entryid,commentid,type,uid,ip,last_like,thumbitem,foruid) VALUES ('$page','$entryid','0','$type','$uid','$uip','$todaydate','entry','$foruid')") or die(mysql_error());
	
			/* GET THE NEW DATA VALUE FOR THE NUMBER */
			$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND entryid='$entryid' AND commentid='0' AND thumbitem='entry'");
			if(mysql_num_rows($GET_VAL_LIKES)<1){
				$numberOfLikes=0;			
			} else {
				$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
			}
			$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND entryid='$entryid' AND commentid='0' AND thumbitem='entry'");
			if(mysql_num_rows($GET_VAL_DISLIKES)<1){
				$numberOfDisLikes=0;			
			} else {
				$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
			}
			$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
			echo $value;
		} else {
			/* UID HAS LIKED IT; CHECK TO SEE IF IT HAS BEEN 24 HOURS OR CHECK FOR OPPOSITE ACTION (if like = dislike; if dislike - like*/
			while($FETCH_UID=mysql_fetch_array($CHECK_UID)){
				$last_like=$FETCH_UID['last_like'];
				$lldate=$FETCH_UID['last_like'];
				$indbtype=$FETCH_UID['type'];
			}
			if($type==$indbtype){
				/* SAME TYPE; CHECK LAST DATE */
				/* 2013-06-24 = TODAY */
				/* 0123456789 		  */
				/* BREAK THE DATES APART */
				$todaydate_y=substr($todaydate,0,4);
				$todaydate_m=substr($todaydate,5,2);
				$todaydate_d=substr($todaydate,8,2);
				
				$lldate_y=substr($lldate,0,4);
				$lldate_m=substr($lldate,5,2);
				$lldate_d=substr($lldate,8,2);
				
				$dif_btw_dates_days=0;
				
				$dif_btw_dates_y=$todaydate_y - $lldate_y; //2013
				/* CONVERT TO DAYS */
				$dif_btw_dates_days=$dif_btw_dates_days+($dif_btw_dates_y * 365);
				
				$dif_btw_dates_m=$todaydate_m - $lldate_m;
				/* CONVERT TO DAYS */
				$dif_btw_dates_days=$dif_btw_dates_days+(($dif_btw_dates_m * 4.34812) * 7);
				
				$dif_btw_dates_d=$todaydate_d - $lldate_d;
				/* CONVERT TO DAYS */
				$dif_btw_dates_days=$dif_btw_dates_days+$dif_btw_dates_d;
				
				if($dif_btw_dates_days<1){/* SAME DAY */$canLogged=0;}else{/* GREATER THAN A DAY; GOOD TO GO */$canLogged=1;}
				
				if($canLogged==1){
					/* DO IT */
					mysql_query("INSERT INTO {$properties->DB_PREFIX}thumbs (onpage,entryid,commentid,type,uid,ip,last_like,thumbitem,foruid) VALUES ('$page','$entryid','0','$type','$uid','$uip','$todaydate','entry','$foruid')") or die(mysql_error());
		
					/* GET THE NEW DATA VALUE FOR THE NUMBER */
					$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND entryid='$entryid' AND commentid='0' AND thumbitem='entry'");
					if(mysql_num_rows($GET_VAL_LIKES)<1){
						$numberOfLikes=0;			
					} else {
						$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
					}
					$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND entryid='$entryid' AND commentid='0' AND thumbitem='entry'");
					if(mysql_num_rows($GET_VAL_DISLIKES)<1){
						$numberOfDisLikes=0;			
					} else {
						$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
					}
					$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
					echo $value;
					
				} else if($canLogged==0) {
					/* NO GO */
					/* GET THE NEW DATA VALUE FOR THE NUMBER */
					$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND entryid='$entryid' AND thumbitem='entry' AND commentid='0'");
					if(mysql_num_rows($GET_VAL_LIKES)<1){
						$numberOfLikes=0;			
					} else {
						$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
					}
					$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND entryid='$entryid' AND thumbitem='entry' AND commentid='0'");
					if(mysql_num_rows($GET_VAL_DISLIKES)<1){
						$numberOfDisLikes=0;			
					} else {
						$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
					}
					$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
					echo $value;
				}
			} else {
				/* SAME DATE; OPPOSITE TYPE; THEY ARE GOING FOR THE SWITCH-A-ROO */
				mysql_query("UPDATE {$properties->DB_PREFIX}thumbs SET type='$type' WHERE onpage='$page' AND entryid='$entryid' AND uid='$uid' AND last_like='$todaydate' AND thumbitem='entry' AND commentid='0'");
				
				/* GET THE NEW DATA VALUE FOR THE NUMBER */
				$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND entryid='$entryid' AND thumbitem='entry' AND commentid='0'");
				if(mysql_num_rows($GET_VAL_LIKES)<1){
					$numberOfLikes=0;			
				} else {
					$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
				}
				$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND entryid='$entryid' AND thumbitem='entry' AND commentid='0'");
				if(mysql_num_rows($GET_VAL_DISLIKES)<1){
					$numberOfDisLikes=0;			
				} else {
					$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
				}
				$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
				echo $value;
			}		
		}
	}
} else {
	/* NOT LOGGED; GUEST; GO BY UIP */	
	/* DETERMINE IF COMMENT ID IS SET */
	if($isAComment==1){
		/* COMMENT ID SET; USER IS LIKING A COMMENT */
		/* FIND OUT IF UIP HAS LIKED THE SAME ENTRYID WITHIN A 24-HOUR PERIOD */
		$CHECK_UIP=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE onpage='$page' AND entryid='$entryid' AND ip='$uip' AND thumbitem='comment' AND commentid='$commentid' AND uid='0'") or die(mysql_error()." on line 560 of doThumb.php");
		if(mysql_num_rows($CHECK_UIP)<1){
			/* UIP HAS NOT LIKED IT EVER; NOR HAS LIKED ANYTHING; DO INSERT */
			mysql_query("INSERT INTO {$properties->DB_PREFIX}thumbs (onpage,entryid,commentid,type,uid,ip,last_like,thumbitem,foruid) VALUES ('$page','$entryid','$commentid','$type','0','$uip','$todaydate','comment','$foruid')") or die(mysql_error()." on line 563 of doThumb.php");
	
			/* GET THE NEW DATA VALUE FOR THE NUMBER */
			$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND entryid='$entryid' AND commentid='$commentid' AND thumbitem='comment' AND uid='0'") or die(mysql_error()." on line 566 of doThumb.php");
			if(mysql_num_rows($GET_VAL_LIKES)<1){
				$numberOfLikes=0;			
			} else {
				$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
			}
			$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND entryid='$entryid' AND commentid='$commentid' AND thumbitem='comment' AND uid='0'") or die(mysql_error()." on line 572 of doThumb.php");
			if(mysql_num_rows($GET_VAL_DISLIKES)<1){
				$numberOfDisLikes=0;			
			} else {
				$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
			}
			$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
			echo $value;
			
			if($foruid>0){				
				/* UID IS LIKING SOMETHING THAT IS NOT THERE OWN */
				/* FOR A USER */
				/* IF UID>1 THEN CHECK FOR A BADGE THAT AWARDS THEM FOR GETTING A LIKE FIRST THE FIRST TIME ON A COMMENT */
				$weburl=$WEBSITE_URL;
				/* FIND THE BID OF THE BADGE THAT HAS A REQUIREMENT OF 1likeoncomment */
				$REQUIREMENTS="Someone other than you must like one of your comments";
				$FIND_BID_OF_REQUIRE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}badges WHERE requirements='".$REQUIREMENTS."'");
				if(mysql_num_rows($FIND_BID_OF_REQUIRE)<1){
					/* SOMETHING WENT WRONG */
				} else {
					while($FETCH_BID_OF_REQUIRE=mysql_fetch_array($FIND_BID_OF_REQUIRE)){
						$theBID=$FETCH_BID_OF_REQUIRE['id'];
					}
					runAchievementCheck('firstCommentLiked',$properties,$foruid,$weburl);
				}
			}
		} else {
			/* UIP HAS LIKED IT; CHECK TO SEE IF IT HAS BEEN 24 HOURS OR CHECK FOR OPPOSITE ACTION (if like = dislike; if dislike - like*/
			while($FETCH_UIP=mysql_fetch_array($CHECK_UIP)){
				$last_like=$FETCH_UIP['last_like'];
				$lldate=$FETCH_UIP['last_like'];
				$indbtype=$FETCH_UIP['type'];
			}
			if($type==$indbtype){
				/* SAME TYPE; CHECK LAST DATE */
				/* 2013-06-24 = TODAY */
				/* 0123456789 		  */
				/* BREAK THE DATES APART */
				$todaydate_y=substr($todaydate,0,4);
				$todaydate_m=substr($todaydate,5,2);
				$todaydate_d=substr($todaydate,8,2);
				
				$lldate_y=substr($lldate,0,4);
				$lldate_m=substr($lldate,5,2);
				$lldate_d=substr($lldate,8,2);
				
				$dif_btw_dates_days=0;
				
				$dif_btw_dates_y=$todaydate_y - $lldate_y; //2013
				/* CONVERT TO DAYS */
				$dif_btw_dates_days=$dif_btw_dates_days+($dif_btw_dates_y * 365);
				
				$dif_btw_dates_m=$todaydate_m - $lldate_m;
				/* CONVERT TO DAYS */
				$dif_btw_dates_days=$dif_btw_dates_days+(($dif_btw_dates_m * 4.34812) * 7);
				
				$dif_btw_dates_d=$todaydate_d - $lldate_d;
				/* CONVERT TO DAYS */
				$dif_btw_dates_days=$dif_btw_dates_days+$dif_btw_dates_d;
				
				if($dif_btw_dates_days<1){/* SAME DAY */$canLogged=0;}else{/* GREATER THAN A DAY; GOOD TO GO */$canLogged=1;}
				
				if($canLogged==1){
					/* DO IT */
					mysql_query("INSERT INTO {$properties->DB_PREFIX}thumbs (onpage,entryid,commentid,type,uid,ip,last_like,thumbitem,foruid) VALUES ('$page','$entryid','$commentid','$type','0','$uip','$todaydate','comment','$foruid')") or die(mysql_error()." on line 618 of doThumb.php");
		
					/* GET THE NEW DATA VALUE FOR THE NUMBER */
					$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND entryid='$entryid' AND commentid='$commentid' AND thumbitem='comment' AND uid='0'") or die(mysql_error()." on line 621 of doThumb.php");
					if(mysql_num_rows($GET_VAL_LIKES)<1){
						$numberOfLikes=0;			
					} else {
						$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
					}
					$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND entryid='$entryid' AND commentid='$commentid' AND thumbitem='comment' AND uid='0'") or die(mysql_error()." on line 627 of doThumb.php");
					if(mysql_num_rows($GET_VAL_DISLIKES)<1){
						$numberOfDisLikes=0;			
					} else {
						$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
					}
					$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
					echo $value;
					
				} else if($canLogged==0) {
					/* NO GO */
					/* GET THE NEW DATA VALUE FOR THE NUMBER */
					$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND entryid='$entryid' AND commentid='$commentid' AND thumbitem='comment' AND uid='0'") or die(mysql_error()." on line 639 of doThumb.php");
					if(mysql_num_rows($GET_VAL_LIKES)<1){
						$numberOfLikes=0;			
					} else {
						$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
					}
					$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND entryid='$entryid' AND commentid='$commentid' AND thumbitem='comment' AND uid='0'") or die(mysql_error()." on line 645 of doThumb.php");
					if(mysql_num_rows($GET_VAL_DISLIKES)<1){
						$numberOfDisLikes=0;			
					} else {
						$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
					}
					$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
					echo $value;
				}
			} else {
				/* SAME DATE; OPPOSITE TYPE; THEY ARE GOING FOR THE SWITCH-A-ROO */
				mysql_query("UPDATE {$properties->DB_PREFIX}thumbs SET type='$type' WHERE onpage='$page' AND entryid='$entryid' AND commentid='$commentid' AND ip='$uip' AND last_like='$todaydate' AND thumbitem='comment' AND uid='0'") or die(mysql_error()." on line 656 of doThumb.php");
				
				/* GET THE NEW DATA VALUE FOR THE NUMBER */
				$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND entryid='$entryid' AND commentid='$commentid' AND thumbitem='comment' AND uid='0'") or die(mysql_error()." on line 659 of doThumb.php");
				if(mysql_num_rows($GET_VAL_LIKES)<1){
					$numberOfLikes=0;			
				} else {
					$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
				}
				$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND entryid='$entryid' AND commentid='$commentid' AND thumbitem='comment' AND uid='0'") or die(mysql_error()." on line 665 of doThumb.php");
				if(mysql_num_rows($GET_VAL_DISLIKES)<1){
					$numberOfDisLikes=0;			
				} else {
					$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
				}
				$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
				echo $value;
			}		
		}
	}
	if($isABadge==1){
		/* DECIDE IF IT IS FOR A COMMENT ON A BADGE OR IF IT IS FOR THE BADGE ITSELF */
		if($isABComment==1){
			/* BADGE COMMENT */
			/* BADGE ID SET; USER IS LIKING A BADGE */
			/* FIND OUT IF UIP HAS LIKED THE SAME ENTRYID WITHIN A 24-HOUR PERIOD */
			$CHECK_UIP=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE onpage='$page' AND ip='$uip' AND thumbitem='badge' AND badgeid='$bid' AND commentid='$commentid' AND uid='0'") or die(mysql_error()." on line 682 of doThumb.php");
			if(mysql_num_rows($CHECK_UIP)<1){
				/* UIP HAS NOT LIKED IT EVER; NOR HAS LIKED ANYTHING; DO INSERT */
				mysql_query("INSERT INTO {$properties->DB_PREFIX}thumbs (onpage,entryid,commentid,type,uid,ip,last_like,thumbitem,foruid,badgeid) VALUES ('$page','0','$commentid','$type','0','$uip','$todaydate','badge','$foruid','$bid')") or die(mysql_error()." on line 685 of doThumb.php");
		
				/* GET THE NEW DATA VALUE FOR THE NUMBER */
				$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND badgeid='$bid' AND thumbitem='badge' AND commentid='$commentid' AND uid='0'") or die(mysql_error()." on line 688 of doThumb.php");
				if(mysql_num_rows($GET_VAL_LIKES)<1){
					$numberOfLikes=0;			
				} else {
					$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
				}
				$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND badgeid='$bid' AND thumbitem='badge' AND commentid='$commentid' AND uid='0'") or die(mysql_error()." on line 694 of doThumb.php");
				if(mysql_num_rows($GET_VAL_DISLIKES)<1){
					$numberOfDisLikes=0;			
				} else {
					$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
				}
				$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
				echo $value;
				
				if($foruid>0){
					/* UID IS LIKING SOMETHING THAT IS NOT THERE OWN */
					/* FOR A USER */
					/* IF UID>1 THEN CHECK FOR A BADGE THAT AWARDS THEM FOR GETTING A LIKE FIRST THE FIRST TIME ON A COMMENT */
					$weburl=$WEBSITE_URL;
					/* FIND THE BID OF THE BADGE THAT HAS A REQUIREMENT OF 1likeoncomment */
					$REQUIREMENTS="Someone other than you must like one of your comments";
					$FIND_BID_OF_REQUIRE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}badges WHERE requirements='".$REQUIREMENTS."'");
					if(mysql_num_rows($FIND_BID_OF_REQUIRE)<1){
						/* SOMETHING WENT WRONG */
					} else {
						while($FETCH_BID_OF_REQUIRE=mysql_fetch_array($FIND_BID_OF_REQUIRE)){
							$theBID=$FETCH_BID_OF_REQUIRE['id'];
						}
						runAchievementCheck('firstCommentLiked',$properties,$foruid,$weburl);
					}
				}
			} else {
				/* UIP HAS LIKED IT; CHECK TO SEE IF IT HAS BEEN 24 HOURS OR CHECK FOR OPPOSITE ACTION (if like = dislike; if dislike - like*/
				while($FETCH_UIP=mysql_fetch_array($CHECK_UIP)){
					$last_like=$FETCH_UIP['last_like'];
					$lldate=$FETCH_UIP['last_like'];
					$indbtype=$FETCH_UIP['type'];
				}
				if($type==$indbtype){
					/* SAME TYPE; CHECK LAST DATE */
					/* 2013-06-24 = TODAY */
					/* 0123456789 		  */
					/* BREAK THE DATES APART */
					$todaydate_y=substr($todaydate,0,4);
					$todaydate_m=substr($todaydate,5,2);
					$todaydate_d=substr($todaydate,8,2);
					
					$lldate_y=substr($lldate,0,4);
					$lldate_m=substr($lldate,5,2);
					$lldate_d=substr($lldate,8,2);
					
					$dif_btw_dates_days=0;
					
					$dif_btw_dates_y=$todaydate_y - $lldate_y; //2013
					/* CONVERT TO DAYS */
					$dif_btw_dates_days=$dif_btw_dates_days+($dif_btw_dates_y * 365);
					
					$dif_btw_dates_m=$todaydate_m - $lldate_m;
					/* CONVERT TO DAYS */
					$dif_btw_dates_days=$dif_btw_dates_days+(($dif_btw_dates_m * 4.34812) * 7);
					
					$dif_btw_dates_d=$todaydate_d - $lldate_d;
					/* CONVERT TO DAYS */
					$dif_btw_dates_days=$dif_btw_dates_days+$dif_btw_dates_d;
					
					if($dif_btw_dates_days<1){/* SAME DAY */$canLogged=0;}else{/* GREATER THAN A DAY; GOOD TO GO */$canLogged=1;}
					
					if($canLogged==1){
						/* DO IT */
						mysql_query("INSERT INTO {$properties->DB_PREFIX}thumbs (onpage,entryid,commentid,type,uid,ip,last_like,thumbitem,foruid,badgeid) VALUES ('$page','0','$commentid','$type','0','$uip','$todaydate','badge','$foruid','$bid')") or die(mysql_error()." on line 740 of doThumb.php");
			
						/* GET THE NEW DATA VALUE FOR THE NUMBER */
						$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND badgeid='$bid' AND thumbitem='badge' AND commentid='$commentid' AND uid='0'") or die(mysql_error()." on line 743 of doThumb.php");
						if(mysql_num_rows($GET_VAL_LIKES)<1){
							$numberOfLikes=0;			
						} else {
							$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
						}
						$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND badgeid='$bid' AND thumbitem='badge' AND commentid='$commentid' AND uid='0'") or die(mysql_error()." on line 749 of doThumb.php");
						if(mysql_num_rows($GET_VAL_DISLIKES)<1){
							$numberOfDisLikes=0;			
						} else {
							$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
						}
						$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
						echo $value;
						
					} else if($canLogged==0) {
						/* NO GO */
						/* GET THE NEW DATA VALUE FOR THE NUMBER */
						$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND badgeid='$bid' AND thumbitem='badge' AND commentid='$commentid' AND uid='0'") or die(mysql_error()." on line 761 of doThumb.php");
						if(mysql_num_rows($GET_VAL_LIKES)<1){
							$numberOfLikes=0;			
						} else {
							$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
						}
						$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND badgeid='$bid' AND thumbitem='badge' AND commentid='$commentid' AND uid='0'") or die(mysql_error()." on line 767 of doThumb.php");
						if(mysql_num_rows($GET_VAL_DISLIKES)<1){
							$numberOfDisLikes=0;			
						} else {
							$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
						}
						$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
						echo $value;
					}
				} else {
					/* SAME DATE; OPPOSITE TYPE; THEY ARE GOING FOR THE SWITCH-A-ROO */
					mysql_query("UPDATE {$properties->DB_PREFIX}thumbs SET type='$type' WHERE onpage='$page' AND badgeid='$bid' AND ip='$uip' AND last_like='$todaydate' AND thumbitem='badge' AND commentid='$commentid' AND uid='0'") or die(mysql_error()." on line 778 of doThumb.php");
					
					/* GET THE NEW DATA VALUE FOR THE NUMBER */
					$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND badgeid='$bid' AND thumbitem='badge' AND commentid='$commentid' AND uid='0'") or die(mysql_error()." on line 781 of doThumb.php");
					if(mysql_num_rows($GET_VAL_LIKES)<1){
						$numberOfLikes=0;			
					} else {
						$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
					}
					$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND badgeid='$bid' AND thumbitem='badge' AND commentid='$commentid' AND uid='0'") or die(mysql_error()." on line 787 of doThumb.php");
					if(mysql_num_rows($GET_VAL_DISLIKES)<1){
						$numberOfDisLikes=0;			
					} else {
						$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
					}
					$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
					echo $value;
				}		
			}
		} else {
			/* REGULAR BADGE LIKE */
			/* BADGE ID SET; USER IS LIKING A BADGE */
			/* FIND OUT IF UIP HAS LIKED THE SAME ENTRYID WITHIN A 24-HOUR PERIOD */
			$CHECK_UIP=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE onpage='$page' AND ip='$uip' AND thumbitem='badge' AND badgeid='$bid' AND commentid='0' AND uid='0'") or die(mysql_error()." on line 801 of doThumb.php");
			if(mysql_num_rows($CHECK_UIP)<1){
				/* UIP HAS NOT LIKED IT EVER; NOR HAS LIKED ANYTHING; DO INSERT */
				mysql_query("INSERT INTO {$properties->DB_PREFIX}thumbs (onpage,entryid,commentid,type,uid,ip,last_like,thumbitem,foruid,badgeid) VALUES ('$page','0','0','$type','0','$uip','$todaydate','badge','$foruid','$bid')") or die(mysql_error()." on line 804 of doThumb.php");
		
				/* GET THE NEW DATA VALUE FOR THE NUMBER */
				$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND badgeid='$bid' AND thumbitem='badge' AND commentid='0' AND uid='0'") or die(mysql_error()." on line 807 of doThumb.php");
				if(mysql_num_rows($GET_VAL_LIKES)<1){
					$numberOfLikes=0;			
				} else {
					$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
				}
				$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND badgeid='$bid' AND thumbitem='badge' AND commentid='0' AND uid='0'") or die(mysql_error()." on line 813 of doThumb.php");
				if(mysql_num_rows($GET_VAL_DISLIKES)<1){
					$numberOfDisLikes=0;			
				} else {
					$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
				}
				$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
				echo $value;
			} else {
				/* UIP HAS LIKED IT; CHECK TO SEE IF IT HAS BEEN 24 HOURS OR CHECK FOR OPPOSITE ACTION (if like = dislike; if dislike - like*/
				while($FETCH_UIP=mysql_fetch_array($CHECK_UIP)){
					$last_like=$FETCH_UIP['last_like'];
					$lldate=$FETCH_UIP['last_like'];
					$indbtype=$FETCH_UIP['type'];
				}
				if($type==$indbtype){
					/* SAME TYPE; CHECK LAST DATE */
					/* 2013-06-24 = TODAY */
					/* 0123456789 		  */
					/* BREAK THE DATES APART */
					$todaydate_y=substr($todaydate,0,4);
					$todaydate_m=substr($todaydate,5,2);
					$todaydate_d=substr($todaydate,8,2);
					
					$lldate_y=substr($lldate,0,4);
					$lldate_m=substr($lldate,5,2);
					$lldate_d=substr($lldate,8,2);
					
					$dif_btw_dates_days=0;
					
					$dif_btw_dates_y=$todaydate_y - $lldate_y; //2013
					/* CONVERT TO DAYS */
					$dif_btw_dates_days=$dif_btw_dates_days+($dif_btw_dates_y * 365);
					
					$dif_btw_dates_m=$todaydate_m - $lldate_m;
					/* CONVERT TO DAYS */
					$dif_btw_dates_days=$dif_btw_dates_days+(($dif_btw_dates_m * 4.34812) * 7);
					
					$dif_btw_dates_d=$todaydate_d - $lldate_d;
					/* CONVERT TO DAYS */
					$dif_btw_dates_days=$dif_btw_dates_days+$dif_btw_dates_d;
					
					if($dif_btw_dates_days<1){/* SAME DAY */$canLogged=0;}else{/* GREATER THAN A DAY; GOOD TO GO */$canLogged=1;}
					
					if($canLogged==1){
						/* DO IT */
						mysql_query("INSERT INTO {$properties->DB_PREFIX}thumbs (onpage,entryid,commentid,type,uid,ip,last_like,thumbitem,foruid,badgeid) VALUES ('$page','0','0','$type','0','$uip','$todaydate','badge','$foruid','$bid')") or die(mysql_error()." on line 859 of doThumb.php");
			
						/* GET THE NEW DATA VALUE FOR THE NUMBER */
						$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND badgeid='$bid' AND thumbitem='badge' AND uid='0'") or die(mysql_error()." on line 862 of doThumb.php");
						if(mysql_num_rows($GET_VAL_LIKES)<1){
							$numberOfLikes=0;			
						} else {
							$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
						}
						$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND badgeid='$bid' AND thumbitem='badge' AND uid='0'") or die(mysql_error()." on line 868 of doThumb.php");
						if(mysql_num_rows($GET_VAL_DISLIKES)<1){
							$numberOfDisLikes=0;			
						} else {
							$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
						}
						$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
						echo $value;
						
					} else if($canLogged==0) {
						/* NO GO */
						/* GET THE NEW DATA VALUE FOR THE NUMBER */
						$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND badgeid='$bid' AND thumbitem='badge' AND commentid='0' AND uid='0'") or die(mysql_error()." on line 880 of doThumb.php");
						if(mysql_num_rows($GET_VAL_LIKES)<1){
							$numberOfLikes=0;			
						} else {
							$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
						}
						$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND badgeid='$bid' AND thumbitem='badge' AND commentid='0' AND uid='0'") or die(mysql_error()." on line 886 of doThumb.php");
						if(mysql_num_rows($GET_VAL_DISLIKES)<1){
							$numberOfDisLikes=0;			
						} else {
							$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
						}
						$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
						echo $value;
					}
				} else {
					/* SAME DATE; OPPOSITE TYPE; THEY ARE GOING FOR THE SWITCH-A-ROO */
					mysql_query("UPDATE {$properties->DB_PREFIX}thumbs SET type='$type' WHERE onpage='$page' AND badgeid='$bid' AND ip='$uip' AND last_like='$todaydate' AND thumbitem='badge' AND commentid='0' AND uid='0'") or die(mysql_error()." on line 277 of doThumb.php") or die(mysql_error()." on line 897 of doThumb.php");
					
					/* GET THE NEW DATA VALUE FOR THE NUMBER */
					$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND badgeid='$bid' AND thumbitem='badge' AND commentid='0' AND uid='0'") or die(mysql_error()." on line 900 of doThumb.php");

					if(mysql_num_rows($GET_VAL_LIKES)<1){
						$numberOfLikes=0;			
					} else {
						$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
					}
					$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND badgeid='$bid' AND thumbitem='badge' AND commentid='0' AND uid='0'") or die(mysql_error()." on line 907 of doThumb.php");
					if(mysql_num_rows($GET_VAL_DISLIKES)<1){
						$numberOfDisLikes=0;			
					} else {
						$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
					}
					$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
					echo $value;
				}		
			}
		}
	} 
	if($isABadge==0 && $isAComment==0){
		/* COMMENT OR BADGE ID NOT SET; USER IS LIKING AN ENTRY */
		/* FIND OUT IF UIP HAS LIKED THE SAME ENTRYID WITHIN A 24-HOUR PERIOD */
		$CHECK_UIP=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE onpage='$page' AND entryid='$entryid' AND ip='$uip' AND thumbitem='entry' AND commentid='0' AND uid='0'") or die(mysql_error()." on line 922 of doThumb.php");
		if(mysql_num_rows($CHECK_UIP)<1){
			/* UIP HAS NOT LIKED IT EVER; NOR HAS LIKED ANYTHING; DO INSERT */
			mysql_query("INSERT INTO {$properties->DB_PREFIX}thumbs (onpage,entryid,commentid,type,uid,ip,last_like,thumbitem,foruid) VALUES ('$page','$entryid','0','$type','0','$uip','$todaydate','entry','$foruid')") or die(mysql_error()." on line 925 of doThumb.php");
	
			/* GET THE NEW DATA VALUE FOR THE NUMBER */
			$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND entryid='$entryid' AND commentid='0' AND thumbitem='entry' AND uid='0'") or die(mysql_error()." on line 928 of doThumb.php");
			if(mysql_num_rows($GET_VAL_LIKES)<1){
				$numberOfLikes=0;			
			} else {
				$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
			}
			$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND entryid='$entryid' AND commentid='0' AND thumbitem='entry' AND uid='0'") or die(mysql_error()." on line 934 of doThumb.php");
			if(mysql_num_rows($GET_VAL_DISLIKES)<1){
				$numberOfDisLikes=0;			
			} else {
				$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
			}
			$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
			echo $value;
		} else {
			/* UIP HAS LIKED IT; CHECK TO SEE IF IT HAS BEEN 24 HOURS OR CHECK FOR OPPOSITE ACTION (if like = dislike; if dislike - like*/
			while($FETCH_UIP=mysql_fetch_array($CHECK_UIP)){
				$last_like=$FETCH_UIP['last_like'];
				$lldate=$FETCH_UIP['last_like'];
				$indbtype=$FETCH_UIP['type'];
			}
			if($type==$indbtype){
				/* SAME TYPE; CHECK LAST DATE */
				/* 2013-06-24 = TODAY */
				/* 0123456789 		  */
				/* BREAK THE DATES APART */
				$todaydate_y=substr($todaydate,0,4);
				$todaydate_m=substr($todaydate,5,2);
				$todaydate_d=substr($todaydate,8,2);
				
				$lldate_y=substr($lldate,0,4);
				$lldate_m=substr($lldate,5,2);
				$lldate_d=substr($lldate,8,2);
				
				$dif_btw_dates_days=0;
				
				$dif_btw_dates_y=$todaydate_y - $lldate_y; //2013
				/* CONVERT TO DAYS */
				$dif_btw_dates_days=$dif_btw_dates_days+($dif_btw_dates_y * 365);
				
				$dif_btw_dates_m=$todaydate_m - $lldate_m;
				/* CONVERT TO DAYS */
				$dif_btw_dates_days=$dif_btw_dates_days+(($dif_btw_dates_m * 4.34812) * 7);
				
				$dif_btw_dates_d=$todaydate_d - $lldate_d;
				/* CONVERT TO DAYS */
				$dif_btw_dates_days=$dif_btw_dates_days+$dif_btw_dates_d;
				
				if($dif_btw_dates_days<1){/* SAME DAY */$canLogged=0;}else{/* GREATER THAN A DAY; GOOD TO GO */$canLogged=1;}
				
				if($canLogged==1){
					/* DO IT */
					mysql_query("INSERT INTO {$properties->DB_PREFIX}thumbs (onpage,entryid,commentid,type,uid,ip,last_like,thumbitem,foruid) VALUES ('$page','$entryid','0','$type','0','$uip','$todaydate','entry','$foruid')") or die(mysql_error()." on line 980 of doThumb.php");
		
					/* GET THE NEW DATA VALUE FOR THE NUMBER */
					$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND entryid='$entryid' AND commentid='0' AND thumbitem='entry' AND uid='0'") or die(mysql_error()." on line 983 of doThumb.php");
					if(mysql_num_rows($GET_VAL_LIKES)<1){
						$numberOfLikes=0;			
					} else {
						$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
					}
					$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND entryid='$entryid' AND commentid='0' AND thumbitem='entry' AND uid='0'") or die(mysql_error()." on line 989 of doThumb.php");
					if(mysql_num_rows($GET_VAL_DISLIKES)<1){
						$numberOfDisLikes=0;			
					} else {
						$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
					}
					$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
					echo $value;
					
				} else if($canLogged==0) {
					/* NO GO */
					/* GET THE NEW DATA VALUE FOR THE NUMBER */
					$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND entryid='$entryid' AND thumbitem='entry' AND commentid='0' AND uid='0'") or die(mysql_error()." on line 1001 of doThumb.php");
					if(mysql_num_rows($GET_VAL_LIKES)<1){
						$numberOfLikes=0;			
					} else {
						$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
					}
					$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND entryid='$entryid' AND thumbitem='entry' AND commentid='0' AND uid='0'") or die(mysql_error()." on line 1007 of doThumb.php");
					if(mysql_num_rows($GET_VAL_DISLIKES)<1){
						$numberOfDisLikes=0;			
					} else {
						$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
					}
					$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
					echo $value;
				}
			} else {
				/* SAME DATE; OPPOSITE TYPE; THEY ARE GOING FOR THE SWITCH-A-ROO */
				mysql_query("UPDATE {$properties->DB_PREFIX}thumbs SET type='$type' WHERE onpage='$page' AND entryid='$entryid' AND ip='$uip' AND last_like='$todaydate' AND thumbitem='entry' AND commentid='0' AND uid='0'") or die(mysql_error()." on line 1018 of doThumb.php");
				
				/* GET THE NEW DATA VALUE FOR THE NUMBER */
				$GET_VAL_LIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='like' AND entryid='$entryid' AND thumbitem='entry' AND commentid='0' AND uid='0'") or die(mysql_error()." on line 1021 of doThumb.php");
				if(mysql_num_rows($GET_VAL_LIKES)<1){
					$numberOfLikes=0;			
				} else {
					$numberOfLikes=mysql_num_rows($GET_VAL_LIKES);
				}
				$GET_VAL_DISLIKES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE type='dislike' AND entryid='$entryid' AND thumbitem='entry' AND commentid='0' AND uid='0'") or die(mysql_error()." on line 1027 of doThumb.php");
				if(mysql_num_rows($GET_VAL_DISLIKES)<1){
					$numberOfDisLikes=0;			
				} else {
					$numberOfDisLikes=mysql_num_rows($GET_VAL_DISLIKES);
				}
				$value=$type.":".$numberOfLikes.":".$numberOfDisLikes;
				echo $value;
			}		
		}
	}
}
?>