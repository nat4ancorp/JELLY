<?php
/* WEB INTERFACE TO LEARN & TO LOVE (WITLL) SPLASHLINKS DYNAMIC INCLUDED FILE */
/* WITLL WAS DEVELOPED AND DEBUGGED BY NATHAN SMYTH AND IS AVAILABLE TO BE USED AS A FREEWARE */
/* SOFTWARE BY ANYONE WHO CAN DECYFER THE CODE. HA JK. ALL YOU NEED TO DO IS RUN THE INSTALL  */
/* AND USE IT JUST LIKE YOU WOULD WORDPRESS                                                   */

/* PLEASE LEAVE THIS COPYRIGHT OWNERSHIP INFO INTACT AS YOU USE THIS PIECE OF WEB SOFTWARE    */
/* YOU CAN ALWAYS GET PLUGINS, THEMES, AND MODULES FROM WITLL.NET!!!                          */

/* THIS SPECIFIC FILE WAS DEVELOPED TO HOLD ALL THE SPLASH LINKS THAT APPEAR ON THE CLOSED    */
/* AND CLOSED BETA PAGES. YOU CAN CUSTOMIZE THIS TO YOUR LIKING BY COPYING EVERYTHING IN      */
/* BETWEEN THE "<!-- SPLASH LINK -->" and "<!-- END SPLASH LINK -->" items and pasting them   */
/* TO A NEW LINE (AND CHANGING UP THE CONTENT OF COURSE).									  */

/* IF YOU HAVE NOT RAN THE INSTALLATION (MEANING THE INSTALL FOLDER IS NOT CALLED "INSTALL.   */
/* LOCK") THEN PLEASE DO NOT EDIT ANYTHING IN THIS FILE UNTIL YOU HAVE DONE SO.               */
/* WHY? BECAUSE I HAVE MADE A COMPREHENSIVE INSTALLATION SYSTEM THAT DOES ALL THE CHANGES TO  */
/* THIS CONFIGURATION FILE AUTO-MAGICALLY.                                                    */


/* ---------------------------- END OWNERSHIP INFO ------------------------------------------ */
?>
<!-- SPLASH LINK -->
<?php
//get necessary stuff
$ip=$_SERVER['REMOTE_ADDR'];
$logged_session=$_COOKIE['nat4an_beta_session'];

//check for logged in status
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
if(mysql_num_rows($CHECK_LOGIN)<1){
if(getGlobalVars($properties,'mode') == "closed" || "closedbeta"){/* ON A PAGE WHERE CONTROL IS NOT ACCESSIBLE */?>[ <a href="control" title="">Control</a> ]<?php }else{}
}
?>
<!-- END SPLASH LINK -->

<!-- SPLASH LINK -->
<?php
if($_SERVER['HTTP_HOST']=="localhost"){
?>
[ <a href="http://www.witll.net" title="Goto the ONLINE version instantly!">There's no place like WITLL.NET!</a> ]
<?php	
} else {
?>
[ <a href="http://localhost" title="Goto the localhost without having to type it, don't know why I did this, but you must be on my computer to access. :P">There's no place like 127.0.0.1!</a> ]

<?php	
}
?>
<!-- END SPLASH LINK -->