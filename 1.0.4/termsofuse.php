<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Terms of Use</title>
</head>

<body>
<?php
if(isset($_GET['type'])){
	$type=$_GET['type'];
	switch($type){
		case 'admin':
			$beginning="an";
			?>
            <h1>Use of Nat4an.com</h1>
			<p>Nat4an.com is to be used as a tool for research, learning, socializing, building, and creating. In no way can, or will it be used for fraud, hacking, piracy, or other malicious forms of terroristic use.</p>
            <p>You are to use this access to test, debug, break, and report to us any problems with our website. Your reward is the ability to access a great site and it may involve future administrative access when the site goes public which is planned to reach millions (hopefully).</p>
			
            <h1>Pending Patents</h1>
            <p>Any and/or all of the ideas on this site are either patented or in the process of being patented.</p>
            
            <h1>Confidentiality Agreement</h1>
			<p>You agree as <?php echo $beginning;?> <b><?php echo $type?></b> you will <b>not</b> withdraw any and all of the information or ideas displayed on this website to the public.</p>
            
            <h1>Penalities of Breach of Contract</h1>
            <p>Any and all attempts to steal, withdraw, leak, or publicize any and/or all information contained in this website is grounds for immediate <b>Termination</b> of your contract with Nat4an Corp without word of warning or judiciary intervention. Once terminated or End of Contracted (EoC) you may <b>not</b> apply nor hold a position any time in the future with us.</p>
            
            <h1>MOST IMPORTANT RULE</h1>
            <p>As <?php echo $beginning;?> <?php echo $type;?> we hold you accountable to these standards as you roam this site freely and we monitor your activity with every page you go to (even while on the page) so <b>beware of the consequences for breaking our contract</b> and have a good time! If you do what you are suppose to do then you won't end up like &quot;that guy&quot;. Have fun!</p>
            <?php
		break;
		
		case 'beta':
			$beginning="an";
			?>
            <h1>Use of Nat4an.com</h1>
			<p>Nat4an.com is to be used as a tool for research, learning, socializing, building, and creating. In no way can, or will it be used for fraud, hacking, piracy, or other malicious forms of terroristic use.</p>
            <p>You are to use this access to test, debug, break, and report to us any problems with our website. Your reward is the ability to access a great site and it may involve future administrative access when the site goes public which is planned to reach millions (hopefully).</p>
			
            <h1>Pending Patents</h1>
            <p>Any and/or all of the ideas on this site are either patented or in the process of being patented.</p>
            
            <h1>Confidentiality Agreement</h1>
			<p>You agree as <?php echo $beginning;?> <b><?php echo $type?></b> you will <b>not</b> withdraw any and all of the information or ideas displayed on this website to the public.</p>
            
            <h1>Penalities of Breach of Contract</h1>
            <p>Any and all attempts to steal, withdraw, leak, or publicize any and/or all information contained in this website is grounds for immediate <b>Termination</b> of your contract with Nat4an Corp without word of warning or judiciary intervention. Once terminated or End of Contracted (EoC) you may <b>not</b> apply nor hold a position any time in the future with us.</p>
            
            <h1>MOST IMPORTANT RULE</h1>
            <p>As <?php echo $beginning;?> <?php echo $type;?> we hold you accountable to these standards as you roam this site freely and we monitor your activity with every page you go to (even while on the page) so <b>beware of the consequences for breaking our contract</b> and have a good time! If you do what you are suppose to do then you won't end up like &quot;that guy&quot;. Have fun!</p>
            <?php
		break;
		
		default:
			echo "Umm...something went wrong, and we have detected a hacking attempt. :(";	
		break;
	}
} else {
	echo "Umm...something went wrong, and we have detected a hacking attempt. :(";	
}
?>
</body>
</html>