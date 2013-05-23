<html>
<head>
<title>Help!</title>
<script type="text/javascript">
window.onunload = refreshParent;
function refreshParent(){
	window.opener.location.reload();
}
</script>
</head>
<body>
<h1>Need help?</h1>
<p>See if you can find out from one of the FAQs below:</p>
<hr>
<p>
<b>When I login, I get a "...is already logged in." message, what do I do?</b>
<br />
If you are trying to access your account and you stumble upon a message that reads "<i>your_username</i> is already loggedin." and you do not think you are logged in - chances are you forgot to log out the last time you were on this site which could have been on a different computer. 
<br /><br />
<b>Explanation:</b> The reason we do this is because of the way our highly secure system works. We are attempting to limit or prevent hacking by using a 3-key system. Not going to go into too much code junk but the three-key system matches data in our database to your computer.
<br /><br />

<b>Solution:</b> To log yourself out, please use the form below:
<center>
<form action="" method="post">
<label>Username</label>
<input type="text" name="uname" value="">
<label>Password</label>
<input type="password" name="upass" value="">
<input type="submit" name="logout" value="Fix it!">
</form>
</center>
NOTE: This will potentially log anyone out who is using this account. Hopefully that is not the case since you keep your password secret just like a good keeper-of-passwords. If this isn't the case and you believe someone has access to your account, you may request to reset your password <a href="forgotpassword" class="white">here</a>
</p>
<hr />
</body>
</html>