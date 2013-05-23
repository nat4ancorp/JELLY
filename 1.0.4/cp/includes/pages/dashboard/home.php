<style type="text/css">
/* DASHX CONTAINER */
.dashx-container {
	display: table;
	width: 100%;
	text-align:center;
}
.dashx-container-row {
	display: table-row;	
}
/* END DASHX CONTAINER */

/* DASHX FULL CONTAINER */
.dashx-full-container {
	display: table;
	width: 100%;
	margin-left: 25px;
}
.dashx-full-container-row {
	display: table-row;
	cursor: pointer;
}
.dashx-full-container-row:hover {
	background: #09F;
	color: white;
}
.dashx-full-container-row-col {
	display: table-cell;
	border: #999 thin solid;
	padding: 10px;
	font-size: 20px;
}
/* END DASHX FULL CONTAINER */

/* DASHX INNER CONTAINER */
.dashx-inner-container {
	display: table;
	width: 100%;
	margin-left: 25px;
}
.dashx-inner-container-row {
	display: table-row;
}
.dashx-inner-container-row-col1 {
	display: table-cell;
	width: 30%;	
	padding-top: 50px;
	border: #999 thin solid;
}
.dashx-inner-container-row-col2 {
	display: table-cell;
	width: 30%;
	padding-top: 50px;
	border: #999 thin solid;
}
.dashx-inner-container-row-col3 {
	display: table-cell;
	width: 30%;
	padding-top: 50px;
	border: #999 thin solid;
}
.dashx-inner-counter {
	font-size: 72px;
	font-family: Arial, Helvetica, sans-serif;
}
.dashx-inner-details {
	font-size: 14px;
	line-height: 4em;
}
.dashx-inner-details-more {
	font-size: 14px;
}
.dashx-inner-details-more-data {
	font-size: 14px;
	color: #999;
}
/* END DASHX INNER CONTAINER */

/* MISC */
.strong {
	font-weight: bold;	
}
.left {
	text-align: left !important;	
}
.underline {
	text-decoration: underline;	
}
/* END MISC */
</style>
<?php
/* SYSTEMATIC PROCESSES */
/* CHECK FOR VISITORS */
$CHECK_UV=mysql_query("SELECT * FROM {$properties->DB_PREFIX}tempsystem");
$COUNT_CHECK_UV=mysql_num_rows($CHECK_UV);
if($COUNT_CHECK_UV==1){$dashx_visitors_ending="";}else{$dashx_visitors_ending="s";} 
$dashx_visitors=$COUNT_CHECK_UV;
if($dashx_visitors>999999999999){$dashx_visitors=$dashx_visitors / 1000000000000 . "Tril";}
if($dashx_visitors>999999999){$dashx_visitors=$dashx_visitors / 1000000000 . "Bil";}
if($dashx_visitors>999999){$dashx_visitors=$dashx_visitors / 1000000 . "M";}
if($dashx_visitors>9999){$dashx_visitors=$dashx_visitors / 1000 . "K";}

/* CHECK FOR PENDING COMMENTS */
$CHECK_WHAT_PC="blog,changelog,otherwork,pages_af_atoz,work,";
$CHECK_WHAT_PC_LIST=explode(",",$CHECK_WHAT_PC);
for($i=0; $i<count($CHECK_WHAT_PC_LIST); $i++){
	$CHECK_PC=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$CHECK_WHAT_PC_LIST[$i]."_comments WHERE status='Pending'");
	$COUNT_CHECK_PC+=mysql_num_rows($CHECK_PC);
	if($COUNT_CHECK_PC==1){$dashx_pendingcomments_ending="";}else{$dashx_pendingcomments_ending="s";} 
}
$dashx_pendingcomments=$COUNT_CHECK_PC;

/* CHECK FOR OPEN QUERIES */
$CHECK_WHAT_OQ="contact,report,tmm,";
$CHECK_WHAT_OQ_LIST=explode(",",$CHECK_WHAT_OQ);
for($i=0; $i<count($CHECK_WHAT_OQ_LIST); $i++){
	$CHECK_OQ=mysql_query("SELECT * FROM {$properties->DB_PREFIX}queries_".$CHECK_WHAT_OQ_LIST[$i]." WHERE status='Open'");
	$COUNT_CHECK_OQ+=mysql_num_rows($CHECK_OQ);
	if($COUNT_CHECK_OQ==1){$dashx_openqueries_ending="y";}else{$dashx_openqueries_ending="ies";} 
}
$dashx_openqueries=$COUNT_CHECK_OQ;

/* CHECK FOR ALL PAGE VIEWS */
$CHECK_APV=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages");
if(mysql_num_rows($CHECK_APV)<1){
	$COUNT_CHECK_APV=0;
} else {
	while($FETCH_CHECK_APV=mysql_fetch_array($CHECK_APV)){
		$COUNT_CHECK_APV+=$FETCH_CHECK_APV['visits'];
	}
}

$dashx_allpageviews=$COUNT_CHECK_APV;
if($dashx_allpageviews>999999999999999){$dashx_allpageviews=$dashx_allpageviews / 1000000000000000 . " Quadrillion";}
if($dashx_allpageviews>999999999999){$dashx_allpageviews=$dashx_allpageviews / 1000000000000 . " Trillion";}
if($dashx_allpageviews>999999999){$dashx_allpageviews=$dashx_allpageviews / 1000000000 . " Billion";}
if($dashx_allpageviews>999999){$dashx_allpageviews=$dashx_allpageviews / 1000000 . "M";}
if($dashx_allpageviews>9999){$dashx_allpageviews=$dashx_allpageviews / 1000 . "K";}

/* END SYSTEMATIC PROCESSES */
?>
<h1>Dashboard</h1>
<div class="dashx-container">
	<div class="dashx-container-row">
    	<div class="dashx-inner-container">
        	<div class="dashx-inner-container-row">
            	<div class="dashx-inner-container-row-col1">
					<div class="dashx-inner-counter"><?php echo $dashx_visitors;?></div>
                    <div class="dashx-inner-details">Unique Visitor<?php echo $dashx_visitors_ending;?></div>
                    <div class="dashx-inner-details-more strong underline">Newest Registered IPs</div>
                    <div class="dashx-inner-details-more">
                    <?php
					/* GET 5 NEW IPs */
					$CHECK_NEWIPs=mysql_query("SELECT * FROM {$properties->DB_PREFIX}tempsystem ORDER BY id LIMIT 5");
					if(mysql_num_rows($CHECK_NEWIPs)<1){
						echo "No new IPs...that was weird. :(";
					} else {
						while($FETCH_CHECK_NEWIPs=mysql_fetch_array($CHECK_NEWIPs)){
							echo "<span class=\"dashx-inner-details-more-data\">" . $FETCH_CHECK_NEWIPs['ip'] . " - " . $FETCH_CHECK_NEWIPs['temp_session'] . "</span><br />";
						}
					}
					?>
                    </div>
                    
                </div>
                <div class="dashx-inner-container-row-col2">
                	<div class="dashx-inner-counter"><?php echo $dashx_pendingcomments;?></div>
                    <div class="dashx-inner-details">Pending Comment<?php echo $dashx_pendingcomments_ending;?></div>
                    <div class="dashx-inner-details-more strong underline">Latest Comments</div>
                    <div class="dashx-inner-details-more">
                    	<?php
						/* GET LATEST COMMENTS */
						$NEWCOM_WHAT="blog,changelog,otherwork,pages_af_atoz,work,";
						$NEWCOM_WHAT_NAME="The Blog,Change Log,Other Work,AF: A-Z List Reviews,Work,";
						$NEWCOM_WHAT_LIST=explode(",",$NEWCOM_WHAT);
						$NEWCOM_WHAT_NAME_LIST=explode(",",$NEWCOM_WHAT_NAME);
						for($i=0; $i<count($NEWCOM_WHAT_LIST)-1; $i++){
							$CHECK_NEWCOM=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$NEWCOM_WHAT_LIST[$i]."_comments ORDER BY dateandtime DESC LIMIT 5");
							if(mysql_num_rows($CHECK_NEWCOM)<1){
								
							} else {
								while($FETCH_CHECK_NEWCOM=mysql_fetch_array($CHECK_NEWCOM)){
									if($FETCH_CHECK_NEWCOM['status'] == "Approved"){$dashx_newcom_status="<span style=\"color: green;\">[Approved]</span>";}
									if($FETCH_CHECK_NEWCOM['status'] == "Pending"){$dashx_newcom_status="<span style=\"color: orange;\">[Pending]</span>";}
									if($FETCH_CHECK_NEWCOM['status'] == "Denied"){$dashx_newcom_status="<span style=\"color: red;\">[Denied]</span>";}
									if($FETCH_CHECK_NEWCOM['status'] == "Deleted"){$dashx_newcom_status="<span style=\"color: gray;text-decoration: line-through;\">[Deleted]</span>";}
									if($FETCH_CHECK_NEWCOM['status'] == "Recovered"){$dashx_newcom_status="<span style=\"color: gray;\">[Recovered]</span>";}
									
									echo "<span class=\"dashx-inner-details-more-data\"><a href=\"".$WEBSITE_URL."?menu=comments\">".$dashx_newcom_status." <b>[".$NEWCOM_WHAT_NAME_LIST[$i]."]</b> &quot;".substr($FETCH_CHECK_NEWCOM['content'],0,50)."&quot; by ".$FETCH_CHECK_NEWCOM['yname']."</a></span><br />";
								}
							}
						}
						?>
                    </div>
                </div>
                <div class="dashx-inner-container-row-col3">
                	<div class="dashx-inner-counter"><?php echo $dashx_openqueries;?></div>
                    <div class="dashx-inner-details">Open Quer<?php echo $dashx_openqueries_ending;?></div>
                    <div class="dashx-inner-details-more strong underline">Latest Queries</div>
                    <div class="dashx-inner-details-more">
                    	<?php
						/* GET LATEST COMMENTS */
						$NEWQU_WHAT="contact,report,tmm,";
						$NEWQU_WHAT_NAME="Contact,Report,TMM Contact,";
						$NEWQU_WHAT_LIST=explode(",",$NEWQU_WHAT);
						$NEWQU_WHAT_NAME_LIST=explode(",",$NEWQU_WHAT_NAME);
						for($i=0; $i<count($NEWQU_WHAT_LIST)-1; $i++){
							$CHECK_NEWQU=mysql_query("SELECT * FROM {$properties->DB_PREFIX}queries_".$NEWQU_WHAT_LIST[$i]." ORDER BY dateandtime DESC LIMIT 5");
							if(mysql_num_rows($CHECK_NEWQU)<1){
								
							} else {
								while($FETCH_CHECK_NEWQU=mysql_fetch_array($CHECK_NEWQU)){
									if($FETCH_CHECK_NEWQU['status'] == "Open"){$dashx_newqu_status="<span style=\"color: green;\">[Open]</span>";}
									if($FETCH_CHECK_NEWQU['status'] == "Escalated"){$dashx_newqu_status="<span style=\"color: orange;\">[Escalated]</span>";}
									if($FETCH_CHECK_NEWQU['status'] == "Closed"){$dashx_newqu_status="<span style=\"color: red;\">[Closed]</span>";}
									if($FETCH_CHECK_NEWQU['status'] == "Deleted"){$dashx_newqu_status="<span style=\"color: gray;text-decoration: line-through;\">[Deleted]</span>";}
									if($FETCH_CHECK_NEWCOM['status'] == "Recovered"){$dashx_newcom_status="<span style=\"color: gray;\">[Recovered]</span>";}
									echo "<span class=\"dashx-inner-details-more-data\"><a href=\"".$WEBSITE_URL."?menu=feedbacks&page=queries\">".$dashx_newqu_status." <b>[".$NEWQU_WHAT_NAME_LIST[$i]."]</b> &quot;".substr($FETCH_CHECK_NEWQU['contact_message'],0,50)."&quot; from ".$FETCH_CHECK_NEWQU['contact_name']."</a></span><br />";
								}
							}
						}
						?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dashx-container-row left">
    	<h2>Page Visits (<?php echo $dashx_allpageviews;?>) | <?php if($_GET['order']=="pagename"){?><del>Page Name</del><?php }else{?><a href="?menu=dashboard&page=home&order=pagename">Page Name</a><?php }?> | <?php if($_GET['order']=="tophits"){?><del>Top Hits</del><?php }else{?><a href="?menu=dashboard&page=home&order=tophits">Top Hits</a><?php }?></h2>
        <div class="dashx-full-container">
    	        <?php
				/* DISPLAY ALL PAGE STATS */
				if(isset($_GET['order']) && $_GET['order']!=""){$DEFAULT_ORDER=$_GET['order'];}else{$DEFAULT_ORDER="page";}
				if($DEFAULT_ORDER=="pagename"){$DEFAULT_ORDER="page";}
				if($DEFAULT_ORDER=="tophits"){$DEFAULT_ORDER="visits DESC";}
				$CHECK_PAGES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages ORDER BY ".$DEFAULT_ORDER."");
				if(mysql_num_rows($CHECK_PAGES)<1){
					echo "There are no pages available to get stats from";	
				} else {
					while($FETCH_CHECK_PAGES=mysql_fetch_array($CHECK_PAGES)){
						echo "<div class=\"dashx-full-container-row\">";
							echo "<div class=\"dashx-full-container-row-col\">";
							if($FETCH_CHECK_PAGES['last_known_ip']==NULL){$dashx_last_known_ip="???";}else{$dashx_last_known_ip=$FETCH_CHECK_PAGES['last_known_ip'];}
							if($FETCH_CHECK_PAGES['lp']=="padmain"){$dashx_lp=$properties->PADMAIN;}
							if($FETCH_CHECK_PAGES['lp']=="pad1"){$dashx_lp=$properties->PAD1;}
							if($FETCH_CHECK_PAGES['lp']=="pad2"){$dashx_lp=$properties->PAD2;}
							if($FETCH_CHECK_PAGES['lp']=="pad3"){$dashx_lp=$properties->PAD3;}
							if($FETCH_CHECK_PAGES['lp']=="pad4"){$dashx_lp=$properties->PAD4;}
							echo $FETCH_CHECK_PAGES['pageNAME'] . " | PAD: ".$dashx_lp." | Page Views: " . $FETCH_CHECK_PAGES['visits'] . " | Last Known IP Access: " . $dashx_last_known_ip . " | ";
							echo "</div>";
						echo "</div>";
						echo "<br />";
					}
				}
				?>            
        </div>
    </div>
</div>