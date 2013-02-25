<br />
<center class="splashlinks">
<?php
if($_SERVER['HTTP_HOST']=="localhost"){
?>

<?php
} else {
?>
[ <a href="/cpanel" title="To control EVERY single aspect of this server!" target="_new">Admin's CPanel</a> ]
<?php
}
?>

<?php
//get necessary stuff
$ip=$_SERVER['REMOTE_ADDR'];
@$logged_session=$_COOKIE['nat4an_beta_session'];

//check for logged in status
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
if(mysql_num_rows($CHECK_LOGIN)<1){
if(getGlobalVars($properties,'mode') == "closed" || "closedbeta"){/* ON A PAGE WHERE CONTROL IS NOT ACCESSIBLE */?>[ <a href="control" title="">Control</a> ]<?php }else{}
}
?>

<?php
if($_SERVER['HTTP_HOST']=="localhost"){
?>
[ <a href="/library.php" target="_new" title="A library of my works in HTML/CSS/PHP/ETC">Library</a> ]
<?php
}
?>

<?php
if($_SERVER['HTTP_HOST']=="localhost"){
?>
[ <a href="http://www.nat4an.com" title="Goto the ONLINE version instantly!">There's no place like nat4an.com!</a> ]
<?php	
} else {
?>
[ <a href="http://localhost" title="Goto the localhost without having to type it, don't know why I did this, but you must be on my computer to access. :P">There's no place like 127.0.0.1!</a> ]

<?php	
}
?>

<?php
if($_SERVER['HTTP_HOST']=="localhost"){
?>

<h2>Projects</h2>
[ <a href="http://localhost/projects/witll-cms/" target="_blank" title="An on-going project that was created to be a Web Interface to Learn &amp; to Love. This is my first official attempt at creating a CMS that everyone will love!">WITLL</a> ]
<?php	
} else {
?>

<?php	
}
?>

<?php
if($_SERVER['HTTP_HOST']=="localhost"){

} else {
?>
<h2>ProjPages</h2>
<?php
if($_SERVER['HTTP_HOST']=="localhost"){
?>

<?php	
} else {
?>
[ <a href="http://www.witll.net" target="_blank" title="An on-going project that was created to be a Web Interface to Learn &amp; to Love. This is my first official attempt at creating a CMS that everyone will love!">WITLL</a> ]
<?php	
}
?>
<h2>Repositories</h2>
<?php
if($_SERVER['HTTP_HOST']=="localhost"){
?>

<?php	
} else {
?>
[<a href="https://github.com/nat4ancorp/witll.git" target="_blank" title="Want to enlist in developing the entirety of the ginormous content management system known as WITLL? No? Just want to take a look at some of the code that makes up it? Well look no further than here. This Repo is the entire WITLL System packed up into one tiny repo.">WITLL</a> ]
<?php	
}
?>
<?php
}
?>
</center>