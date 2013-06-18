-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 18, 2013 at 07:01 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mrnat4an_master`
--

-- --------------------------------------------------------

--
-- Table structure for table `h_about_slider`
--

CREATE TABLE IF NOT EXISTS `h_about_slider` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `h_achievement_check_actions`
--

CREATE TABLE IF NOT EXISTS `h_achievement_check_actions` (
  `action` varchar(255) NOT NULL,
  `content` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_achievement_check_actions`
--

INSERT INTO `h_achievement_check_actions` (`action`, `content`) VALUES
('firstCommentLiked', 'global $theBID;\r\n/* THIS WILL ESSENTIALLY FIRST CHECK TO SEE IF THE UID IS SET, THEN CHECK TO SEE IF THE UID HAS NOT WON THE BADGE/ACHIEVEMENT YET */\r\n$CHECK_FOR_ACH_WON=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users_achievements WHERE uid=''$uid'' AND bid=''$theBID''");\r\nif(mysql_num_rows($CHECK_FOR_ACH_WON)<1){\r\n	/* THEY HAVE NOT WON; AWARD THEM IT */\r\n	mysql_query("INSERT INTO {$properties->DB_PREFIX}users_achievements (uid,bid,date_received,status) VALUES (''".$uid."'',''".$theBID."'',''".date("Y-m-d H:i:s")."'',''unread'')");\r\n} else {\r\n	/* THEY HAVE ALREADY WON */\r\n}'),
('checkBadgeMessages', '$LOOK_FOR_ACH=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users_achievements WHERE uid=''$uid'' and status=''unread'' ORDER BY date_received DESC LIMIT 1");\r\nif(mysql_num_rows($LOOK_FOR_ACH)<1){\r\n	/* THEY HAVE NO ACHIEVEMENTS THAT THEY HAVE NOT READ */\r\n} else {\r\n	while($FETCH_ACH=mysql_fetch_array($LOOK_FOR_ACH)){\r\n		$aid			= $FETCH_ACH[''id''];\r\n		$bid			= $FETCH_ACH[''bid''];\r\n		$date_received	= $FETCH_ACH[''date_received'']; //ex. 0000-00-00 00:00:00\r\n													   //    0123456789012345678\r\n		\r\n		/* FIND BID DETAILS */\r\n		$FIND_BID_DETAILS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}badges WHERE id=''$bid''");\r\n		if(mysql_num_rows($FIND_BID_DETAILS)<1){\r\n			/* THIS IS BAD */	\r\n			$ach_name="(SOMETHING_WENT_WRONG)";\r\n		} else {\r\n			while($FETCH_BID_DETAILS=mysql_fetch_array($FIND_BID_DETAILS)){\r\n				$ach_name=$FETCH_BID_DETAILS[''name''];					\r\n			}\r\n		}\r\n		\r\n		/* DETERMINE HOW LONG AGO THEY WON THE ACHIEVEMENT */\r\n		/* STEP 1: SET UP THE DATES */\r\n		$todaydate		= date("Y-m-d H:i:s");\r\n		$receiveddate	= substr($date_received,0,19);\r\n		\r\n		/* STEP 2: SEPARATE THE YEAR, MONTH, AND DAY */\r\n		$todaydate_y	= substr($todaydate,0,4);\r\n		$todaydate_m	= substr($todaydate,5,2);\r\n		$todaydate_d	= substr($todaydate,8,2);\r\n		\r\n		$todaydate_h	= substr($todaydate,11,2);\r\n		$todaydate_i	= substr($todaydate,14,2);\r\n		$todaydate_s	= substr($todaydate,17,2);\r\n				\r\n		$receiveddate_y	= substr($receiveddate,0,4);\r\n		$receiveddate_m	= substr($receiveddate,5,2);\r\n		$receiveddate_d	= substr($receiveddate,8,2);\r\n		\r\n		$receiveddate_h	= substr($receiveddate,11,2);\r\n		$receiveddate_i	= substr($receiveddate,14,2);\r\n		$receiveddate_s	= substr($receiveddate,17,2);\r\n		\r\n					\r\n		/* STEP 3: FIND OUT HOW MANY DAYS ARE BETWEEN THE DATES */\r\n		$days=0;\r\n		$days+=($todaydate_y - $receiveddate_y) * 365;\r\n		$days+=(($todaydate_m - $receiveddate_m) * 4.34812) * 7;\r\n		$days+=$todaydate_d - $receiveddate_d;\r\n		\r\n		$days=round($days,0);\r\n		\r\n		/* FIND OUT HOW MANY MINUTES ARE BETWEEN THE TIMES */\r\n		$minutes=0;\r\n		$minutes+=($todaydate_h - $receiveddate_h) * 60;\r\n		$minutes+=$todaydate_i - $receiveddate_i;\r\n			\r\n		/* STEP 4: TWEAK UP */			\r\n		if($days<1){$tense="have";$ending="s";}else if($days>0 && $days<2){$tense="had";$ending="";}else if($days>1){$tense="had";$ending="s";}									\r\n		if($days>0){$the_real_ending_days="{$days} day{$ending} ago";}else{$the_real_ending_days="today";}\r\n							\r\n		//weeks\r\n		$weeks=$days / 7;			\r\n		$weeks=round($weeks,0);\r\n		if($weeks<1){$ending="s";}else if($weeks>0 && $weeks<2){$ending="";}else if($weeks>1){$ending="s";}\r\n		if($weeks>1){$the_real_ending_days="{$weeks} week{$ending} ago";}\r\n		\r\n		//months\r\n		if($weeks>4.34812){$months=$weeks / 4.34812;$months=round($months,0);}\r\n		if($months<1){$ending="s";}else if($months>0 && $months<2){$ending="";}else if($months>1){$ending="s";}\r\n		if($months>=1){$the_real_ending_days="{$months} month{$ending} ago";}\r\n		\r\n		//months\r\n		if($months>12){$years=$months / 12;$years=round($years,0);}\r\n		if($years<1){$ending="s";}else if($years>0 && $years<2){$ending="";}else if($years>1){$ending="s";}\r\n		if($years>=1){$the_real_ending_days="{$years} year{$ending} ago";}\r\n		\r\n		//days\r\n		if($minutes<1){$ending="s";}else if($days>0 && $days<2){$ending="";}else if($days>1){$ending="s";}									\r\n		if($days>0){/* NOT THE SAME DAY */} else {				\r\n			if($minutes>0){\r\n				$hours=0;\r\n				if($hours==0){$hour_string="";}\r\n				if($minutes > 59){\r\n					/* HOUR MARK */\r\n					$hours=$minutes / 60;\r\n					/* FIND REMAINING MIN DECIMAL */\r\n					$remain_min_decimal=substr($hours,strpos($hours,"."));\r\n					$minutes=60 * $remain_min_decimal; //gets the remaining mins\r\n					$minutes=round($minutes,0);\r\n					$hours=round($hours,0);\r\n					if($hours<1){$hours_ending="s";}else if($hours>0 && $hours<2){$hours_ending="";}else if($hours>1){$hours_ending="s";}\r\n					$hour_string=$hours." hour{$hours_ending} ";\r\n					if($minutes<1){/* NO MINUTES */}else{if($minutes>0 && $minutes<1){$minutes_ending="";}else if($minutes>1){$minutes_ending="s";}$minutes_string="and {$minutes} minute{$minutes_ending} ago";}\r\n				} else {\r\n					if($minutes<1){/* NO MINUTES */}else{if($minutes>0 && $minutes<1){$minutes_ending="";}else if($minutes>1){$minutes_ending="s";}$minutes_string="{$minutes} minute{$minutes_ending} ago";}\r\n				}\r\n				$the_real_ending_minutes=" (about {$hour_string}{$minutes_string})";\r\n			} else {\r\n				$the_real_ending_minutes=" (now)";\r\n			}\r\n		}\r\n		\r\n		/* STEP 5: DISPLAY */\r\n		echo "<div id=\\"topmessage-actioncenter\\" style=\\"display:none;\\"><div id=\\"ta-inner\\">ATTENTION! You {$tense} won the <A href=\\"".$weburl.$PADINFO."/blog/badges/".$bid."#top\\" class=\\"black-url\\" style=\\"color:black;\\"><b>{$ach_name}</b></a> achievement {$the_real_ending_days}{$the_real_ending_minutes}! <a id=\\"dismissClick\\" onclick=\\"actioncenter(''users_achievements'',''".$uid."'',''".$bid."'',''read'',''".$weburl."'')\\" class=\\"black-url\\" style=\\"color: black;cursor: pointer;\\">Dismiss</a></div></div>";\r\n	}\r\n}');

-- --------------------------------------------------------

--
-- Table structure for table `h_avatars`
--

CREATE TABLE IF NOT EXISTS `h_avatars` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `avail` enum('public','private') NOT NULL,
  `owner` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `h_avatars`
--

INSERT INTO `h_avatars` (`id`, `name`, `avail`, `owner`) VALUES
(1, 'Golf', 'public', 1),
(2, 'Power', 'public', 0),
(3, 'Puppy', 'public', 0),
(4, 'Soccer', 'public', 0),
(5, 'Subaru', 'public', 0),
(6, 'Computer', 'public', 0);

-- --------------------------------------------------------

--
-- Table structure for table `h_badges`
--

CREATE TABLE IF NOT EXISTS `h_badges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `not_description` longtext NOT NULL,
  `won_description` longtext NOT NULL,
  `bgcolor` varchar(6) NOT NULL,
  `overbgcolor` varchar(6) NOT NULL,
  `color` varchar(6) NOT NULL,
  `overcolor` varchar(6) NOT NULL,
  `titlefontsize` varchar(100) NOT NULL,
  `cuid` int(11) NOT NULL,
  `dateandtime` datetime NOT NULL,
  `requirements` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `h_badges`
--

INSERT INTO `h_badges` (`id`, `name`, `not_description`, `won_description`, `bgcolor`, `overbgcolor`, `color`, `overcolor`, `titlefontsize`, `cuid`, `dateandtime`, `requirements`) VALUES
(1, 'First Post!', 'you have posted for the first time on our system!', 'you have posted for the first time on our system! We would like to honor you with this badge that will be seen where ever your name appears. You deserve it.', '66CCFF', '3366FF', '000000', 'FFFFFF', '16px', 1, '2013-06-15 04:25:24', 'You must post an entry to this website. This requires you to have Write Permissions.'),
(2, 'Popular Kid', 'you have out done yourself by gathering up 100 followers. Congratulations! Have a drink on us.', 'you have 1000 people following you. You must be pretty amazing. We would like to award this badge to you to congratulate your victory on achieving such as high standard on this website. ', '66FF66', 'FF00FF', '000000', 'FFFFFF', '14px', 1, '2013-06-15 06:17:20', 'You must have 100 or more followers following you.'),
(3, 'Radiant Person', 'you have 1000 people following you.', 'you have 1000 people following you. Congratulations on this astonishing achievement! You must be an amazing person to have this many people following you. Keep rockin!', '66FF66', 'FF00FF', '000000', 'FFFFFF', '14px', 1, '2013-06-08 13:32:10', 'You must have 1000 or more followers following you.'),
(4, 'The 1K Club', 'you have liked 1000 times.', 'you have liked 1000 times. We would like to award you with this wonderful achievement for sticking around this site and being active on here. Keep up the good work!', '66FF66', 'FF00FF', '000000', 'FFFFFF', '14px', 1, '2013-06-14 09:15:30', 'You must like 1000 items.'),
(5, 'The Power', 'you will receive this when you share your first post on any number of social sites.', 'you will receive this when you share your first post on any number of social sites. Knowledge is power and you know how to share it so we would like to congratulate you with this very simple achievement! Keep sharing!', '99FFCC', 'FF0000', '000000', 'FFFFFF', '14px', 1, '2013-06-13 12:33:33', 'You must share an a post to at least one social site.'),
(6, 'I am Okay', 'someone has liked your comment.', 'someone has liked your comment. You must be excited to see someone liking something you said. We would like to award you with this achievement and urge you to continue to contribute.', '99FFCC', 'FF0000', '000000', 'FFFFFF', '14px', 1, '2013-06-15 10:29:33', 'Someone other than you must like one of your comments'),
(7, 'The Radical', 'you will receive this achievement when you join this website as a member.', 'you join this website as a member. Congratulations on joining one of the best blogging/VR Playground websites on the net! You have truly outdone yourself with this decision. We would like to present this award to yyou. Doesn''t it look good? You''re such a revolutionary.', 'FF0000', '0000FF', 'FFFFFF', 'FFFFFF', '14px', 1, '2013-06-15 08:20:19', 'You must join as a member.');

-- --------------------------------------------------------

--
-- Table structure for table `h_blog_categories`
--

CREATE TABLE IF NOT EXISTS `h_blog_categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `shortname` varchar(200) NOT NULL,
  `parentid` int(10) NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'yes',
  `status` enum('Active','Deleted','Recovered') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `h_blog_comments`
--

CREATE TABLE IF NOT EXISTS `h_blog_comments` (
  `id` int(100) NOT NULL,
  `userid` int(10) NOT NULL,
  `gender` enum('','male','female','other') NOT NULL,
  `yname` varchar(255) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `yemail` varchar(255) NOT NULL,
  `yweb` varchar(300) NOT NULL,
  `mood` int(10) NOT NULL,
  `title` varchar(30) NOT NULL,
  `content` longtext NOT NULL,
  `entry_id` int(10) NOT NULL,
  `dateandtime` datetime NOT NULL,
  `status` enum('Approved','Pending','Denied','Deleted','Recovered') NOT NULL,
  `comment_ticket_id` varchar(300) NOT NULL,
  `extra_notes` longtext NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'yes',
  `ctype` enum('regular','badge') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `h_blog_entries`
--

CREATE TABLE IF NOT EXISTS `h_blog_entries` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `author` int(10) NOT NULL,
  `category` int(100) NOT NULL,
  `tags` longtext NOT NULL,
  `dateandtime` datetime NOT NULL,
  `dateandtime_goingtostart` datetime NOT NULL,
  `date_year` int(4) NOT NULL,
  `date_month` enum('01','02','03','04','05','06','07','08','09','10','11','12') NOT NULL,
  `date_day` enum('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31') NOT NULL,
  `date_hour` enum('00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24') NOT NULL,
  `date_min` enum('00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','58','59','60') NOT NULL,
  `date_sec` enum('00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','58','59','60') NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'yes',
  `status` enum('Published','Drafted','On Hold','Deleted','Recovered') NOT NULL DEFAULT 'Drafted',
  `featured` enum('yes','no') NOT NULL DEFAULT 'no',
  `featured_image` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `h_blog_moods`
--

CREATE TABLE IF NOT EXISTS `h_blog_moods` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=126 ;

--
-- Dumping data for table `h_blog_moods`
--

INSERT INTO `h_blog_moods` (`id`, `name`, `is_searchable`) VALUES
(1, 'Happy', 'no'),
(2, 'Sad', 'no'),
(3, 'Mad', 'no'),
(4, 'Curious', 'no'),
(5, 'Bloggie', 'no'),
(6, 'Accepted', 'no'),
(7, 'Accomplished', 'no'),
(8, 'Aggravated', 'no'),
(9, 'Alone', 'no'),
(10, 'Amused', 'no'),
(11, 'Angry', 'no'),
(12, 'Annoyed', 'no'),
(13, 'Anxious', 'no'),
(14, 'Apathetic', 'no'),
(15, 'Ashamed', 'no'),
(16, 'Awake', 'no'),
(17, 'Bewildered', 'no'),
(18, 'Bitchy', 'no'),
(19, 'Bittersweet', 'no'),
(20, 'Blah', 'no'),
(21, 'Blank', 'no'),
(22, 'Blissful', 'no'),
(23, 'Bored', 'no'),
(24, 'Bouncy', 'no'),
(25, 'Calm', 'no'),
(26, 'Cheerful', 'no'),
(27, 'Chipper', 'no'),
(28, 'Cold', 'no'),
(29, 'Complacent', 'no'),
(30, 'Confused', 'no'),
(31, 'Content', 'no'),
(32, 'Cranky', 'no'),
(33, 'Crappy', 'no'),
(34, 'Crazy', 'no'),
(35, 'Crushed', 'no'),
(36, 'Curious', 'no'),
(37, 'Cynical', 'no'),
(38, 'Dark', 'no'),
(39, 'Depressed', 'no'),
(40, 'Determined', 'no'),
(41, 'Devious', 'no'),
(42, 'Dirty', 'no'),
(43, 'Disappointed', 'no'),
(44, 'Discontent', 'no'),
(45, 'Ditzy', 'no'),
(46, 'Dorky', 'no'),
(47, 'Drained', 'no'),
(48, 'Drunk', 'no'),
(49, 'Ecstatic', 'no'),
(50, 'Energetic', 'no'),
(51, 'Enraged', 'no'),
(52, 'Enthralled', 'no'),
(53, 'Envious', 'no'),
(54, 'Exanimate', 'no'),
(55, 'Excited', 'no'),
(56, 'Exhausted', 'no'),
(57, 'Flirty', 'no'),
(58, 'Frustrated', 'no'),
(59, 'Full', 'no'),
(60, 'Geeky', 'no'),
(61, 'Giddy', 'no'),
(62, 'Giggly', 'no'),
(63, 'Gloomy', 'no'),
(64, 'Good', 'no'),
(65, 'Grateful', 'no'),
(66, 'Groggy', 'no'),
(67, 'Grumpy', 'no'),
(68, 'Guilty', 'no'),
(69, 'High', 'no'),
(70, 'Hopeful', 'no'),
(71, 'Hot', 'no'),
(72, 'Hungry', 'no'),
(73, 'Hyper', 'no'),
(74, 'Impressed', 'no'),
(75, 'Indescribable', 'no'),
(76, 'Indifferent', 'no'),
(77, 'Infuriated', 'no'),
(78, 'Irate', 'no'),
(79, 'Irritated', 'no'),
(80, 'Jealous', 'no'),
(81, 'Jubilant', 'no'),
(82, 'Lazy', 'no'),
(83, 'Lethargic', 'no'),
(84, 'Listless', 'no'),
(85, 'Lonely', 'no'),
(86, 'Loved', 'no'),
(87, 'Melancholy', 'no'),
(88, 'Mellow', 'no'),
(89, 'Mischievous', 'no'),
(90, 'Moody', 'no'),
(91, 'Morose', 'no'),
(92, 'Naughty', 'no'),
(93, 'Nerdy', 'no'),
(94, 'Not Specified', 'no'),
(95, 'Numb', 'no'),
(96, 'Okay', 'no'),
(97, 'Optimistic', 'no'),
(98, 'Peaceful', 'no'),
(99, 'Pessimistic', 'no'),
(100, 'Pissed off', 'no'),
(101, 'Pleased', 'no'),
(102, 'Predatory', 'no'),
(103, 'Quixotic', 'no'),
(104, 'Recumbent', 'no'),
(105, 'Refreshed', 'no'),
(106, 'Rejected', 'no'),
(107, 'Rejuvenated', 'no'),
(108, 'Relaxed', 'no'),
(109, 'Relieved', 'no'),
(110, 'Restless', 'no'),
(111, 'Rushed', 'no'),
(112, 'Satisfied', 'no'),
(113, 'Shocked', 'no'),
(114, 'Sick', 'no'),
(115, 'Silly', 'no'),
(116, 'Sleepy', 'no'),
(117, 'Smart', 'no'),
(118, 'Stressed', 'no'),
(119, 'Surprised', 'no'),
(120, 'Sympathetic', 'no'),
(121, 'Thankful', 'no'),
(122, 'Tired', 'no'),
(123, 'Touched', 'no'),
(124, 'Uncomfortable', 'no'),
(125, 'Weird', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `h_cers_messages`
--

CREATE TABLE IF NOT EXISTS `h_cers_messages` (
  `message_indicator` varchar(500) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `content` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_cers_messages`
--

INSERT INTO `h_cers_messages` (`message_indicator`, `subject`, `content`) VALUES
('comment_posted', '(WEBSITE_URL_NAME) - Comment Posted', 'Hello (TO_WHOM_IT_MAY_CONCERN),<br /><br />We just want to write you to let you know that your comment posted on <a href="(WEBSITE_URL)(PADINFO)/(PNAME_URI)/permalink/(B_YEAR)/(B_MONTH)/(B_DAY)/(PNAME_TITLE_SAFE)">(PNAME_TITLE)</a> has been successfully posted on our website. If you did not authorize this comment post, then it looks like something must have happen and you can follow up with it by going to<br /><br /><a href="(WEBSITE_URL)(PADMAIN)/report">this link</a><br /><br />If this in fact was a terrible mistake then we sincerely apologize for this inconvience and we will work with you on this to make it right. However if it wasn''t a mistake, then this email is for your records to keep.<br /><br />(AUTORESPONDER_CLOSING_LINE)<br /><br />(WEBMASTER_NAME)<br />The (COMPANY_NAME) Staff<br />(WEBMASTER_TITLE)<br /><br />NOTE: This message was automatically generated. Please do not reply to this message, as this mailbox is not monitored.'),
('comment_submitted_for_review', '(WEBSITE_URL_NAME) - Comment Submitted for Review', 'Hello (TO_WHOM_IT_MAY_CONCERN),<br /><br />We just want to write you to let you know that your comment posted on <a href="(WEBSITE_URL)(PADINFO)/(PNAME_URI)/permalink/(B_YEAR)/(B_MONTH)/(B_DAY)/(PNAME_TITLE_SAFE)">(PNAME_TITLE)</a> has been successfully submitted to be reviewed by our moderators. This may take from 24 to 72 hours depending on the queue of comments and what your comment is about.<br /><br />You can check the status of this comment by going to <a href="(WEBSITE_URL)(PADINFO)/(PNAME_URI)/comment/checkstatus/(COMMENT_TICKET_ID)">comment/checkstatus</a>. If you did not authorize this comment post, then it looks like something must have happen and you can follow up with it by going to<br /><br /><a href="(WEBSITE_URL)(PADMAIN)/report">this link</a><br /><br />If this in fact was a terrible mistake then we sincerely apologize for this inconvience and we will work with you on this to make it right. However if it wasn''t a mistake, then this email is for your records to keep.<br /><br />(AUTORESPONDER_CLOSING_LINE)<br /><br />(WEBMASTER_NAME)<br />The (COMPANY_NAME) Staff<br />(WEBMASTER_TITLE)<br /><br />NOTE: This message was automatically generated. Please do not reply to this message, as this mailbox is not monitored.'),
('poc_notification_new_message', 'You have a message from someone who contacted us on (WEBSITE_URL_NAME)!', 'Hello (POC_NAME),<br /><br />We just wanted to let you know that someone has contacted us using our website and they specified they wanted to speak with you. This becomes a great opportunity for you to show this person that you (we) care about them by taking care of their needs. The details of the message to you are below:<br /><br />The reason for contact: (REASON_NAME)<br />Date and Time Stamp: (DATEANDTIME)<br />The Message: (YMESSAGE)<br />The ticket number (TICKET_ID)<br /><br />We do not encourage replying by direct emailing as the reason for not showing their email address in this message to you. Please login to your account to reply to this message. This method protects your email from being spammed by someone getting a hold of your email address.<br /><br />To access your account <a href="(WEBSITE_URL)(PADINFO)/account">click here</a> (NOTE: Due to the lack of functionality at the moment this portion of our website is not operational, we are working on this - this notice will disappear once it is operational.)<br /><br />If you would like to turn off notifications you can do so by logging into your account.<br /><br />This email is for your records to keep.<br /><br />(AUTORESPONDER_CLOSING_LINE)<br />(WEBMASTER_NAME)<br />The (COMPANY_NAME) Staff<br />(WEBMASTER_TITLE)<br /><br />NOTE: This message was automatically generated. Please do not reply to this message, as this mailbox is not monitored.'),
('thank_you_for_contacting', 'Thank you for contacting (WEBSITE_URL_NAME)!', 'Hello (TO_WHOM_IT_MAY_CONCERN),<br /><br />We just want to thank you for taking the time to contact us. We believe your message to us is very important so we will make it our efforts to help you out asap which should be in about 24 to 72 hours. The details of your message are below:<br /><br />Who you contacted: (POC_NAME)<br />Your reason for contacting us: (REASON_NAME)<br />Your Message: (YMESSAGE)<br />Your ticket numder: (TICKET_ID)<br /><br />You can check the status of ticket by going to: <a href="(WEBSITE_URL)(PADINFO)/(FORMNAME)/checkstatus/(TICKET_ID)">contact/checkstatus</a><br /><br />If you did not contact us, then it looks like something must have happen and you can follow up with it by <a href="(WEBSITE_URL)(PADINFO)/report">reporting it</a>.<br /><br />If this in fact was a terrible mistake then we sincerely apologize for this inconvience and we will work with you on this to make it right. However if it wasn''t a mistake, then this email is for your records to keep.<br /><br />(AUTORESPONDER_CLOSING_LINE)<br /><br />(WEBMASTER_NAME)<br />The (COMPANY_NAME) Staff<br />(WEBMASTER_TITLE)<br /><br />NOTE: This message was automatically generated. Please do not reply to this message, as this mailbox is not monitored.'),
('thank_you_for_contacting_tmm', 'Thank you for contacting (EXTRA_NAME) on (WEBSITE_URL_NAME)!', 'Hello (TO_WHOM_IT_MAY_CONCERN),<br /><br />We just want to thank you for taking the time to contact (EXTRA_NAME). We believe your message to us is very important so we will make it our efforts to help you out asap which should be in about 24 to 72 hours. The details of your message are below:<br /><br />Who you contacted: (POC_NAME)<br />Your reason for contacting us: (REASON_NAME)<br />Your Message: (YMESSAGE)<br />Your ticket numder: (TICKET_ID)<br /><br />You can check the status of ticket by going to: <a href="(WEBSITE_URL)(PADINFO)/(FORMNAME)/checkstatus/(TICKET_ID)">contact/checkstatus</a><br /><br />If you did not contact us, then it looks like something must have happen and you can follow up with it by <a href="(WEBSITE_URL)(PADINFO)/report">reporting it</a>.<br /><br />If this in fact was a terrible mistake then we sincerely apologize for this inconvience and we will work with you on this to make it right. However if it wasn''t a mistake, then this email is for your records to keep.<br /><br />(AUTORESPONDER_CLOSING_LINE)<br /><br />(WEBMASTER_NAME)<br />The (COMPANY_NAME) Staff<br />(WEBMASTER_TITLE)<br /><br />NOTE: This message was automatically generated. Please do not reply to this message, as this mailbox is not monitored.'),
('beta_admin_registration', '(WEBSITE_URL_NAME) - Admin Registration', 'Welcome to (WEBSITE_URL_NAME)''s (EVENT_NAME) Event! Thank you for your interest in wanting to become an Admin on (WEBSITE_URL_NAME). We are currently looking into your application and it may take us up to 72 hours to respond to your request. Please be patient, as bugging us will only prolong the process.<br /><br />Tips: as long as you''ve entered in a good reason why you want to become an admin, there should be nothing to worry about. Most applicants get approved the day they request which allows them to enjoy the new, under-construction (WEBSITE_URL_NAME) Website to test and play around with as well as have access to the flavorful admin controls to control our website.<br /><br />For your reference, we have forwarded you a copy of your registration details:<br /><br />Username: (USERNAME)<br />Password: (PASSWORD)<br />PIN: (FULL_PIN)<br /><br />NOTE: These details won''t work on the Admin portion of (WEBSITE_URL_NAME) until you have been approved. However, if you would like to inquire about your application process, you can go to (WEBSITE_URL)(PADMAIN)/control and login with the details above to see if you have been approved. If done correctly, a message should appear once you press the &quot;Login&quot; button telling you the status of your application.<br /><br />Again, thank you for your interest in wanting to become an admin and we will be getting back in touch with you once we have reviewed your application.<br /><br />(AUTORESPONDER_CLOSING_LINE)<br /><br />(WEBMASTER_NAME)<br />The (COMPANY_NAME) Staff<br />(WEBMASTER_TITLE)<br /><br />NOTE: This message was automatically generated. Please do not reply to this message, as this mailbox is not monitored.'),
('beta_closedbeta_registration', '(WEBSITE_URL_NAME) - BETA Member Registration', 'Welcome to (WEBSITE_URL_NAME)''s (EVENT_NAME) Event! Thank you for your interest in wanting to become a BETA Member on (WEBSITE_URL_NAME). We are currently looking into your application and it may take us up to 72 hours to respond to your request. Please be patient, as bugging us will only prolong the process.<br /><br />Tips: as long as you''ve entered in a good reason why you want to become a BETA member, there should be nothing to worry about. Most applicants get approved the day they request which allows them to enjoy the new, under-construction (WEBSITE_URL_NAME) Website to test and play around with.<br /><br />For your reference, we have forwarded you a copy of your registration details:<br /><br />Username: (USERNAME)<br />Password: (PASSWORD)<br />PIN: (FULL_PIN)<br /><br />NOTE: These details won''t work on the (EVENT_NAME) portion of (WEBSITE_URL) until you have been approved. However, if you would like to inquire about your application process, you can go to (WEBSITE_URL)(PADMAIN)/control and login with the details above to see if you have been approved. If done correctly, a message should appear once you press the &quot;Login&quot; button telling you the status of your application.<br /><br />Again, thank you for your interest in wanting to become a BETA member and we will be getting back in touch with you once we have reviewed your application.<br /><br />(AUTORESPONDER_CLOSING_LINE)<br /><br />(WEBMASTER_NAME)<br />The (COMPANY_NAME) Staff<br />(WEBMASTER_TITLE)<br /><br />NOTE: This message was automatically generated. Please do not reply to this message, as this mailbox is not monitored.'),
('towebadmin_beta_admin_registration', '(WEBSITE_URL_NAME) - New Admin Registration', 'Hello,<br /><br />We just wanted to let you know that someone has requested access to our website and they specified they wanted to become an admin.\r\nFor your reference, we have forwarded you a copy of their registration details:<br /><br />Username: (USERNAME)<br />Password: <i>hidden</i><br />PIN: (FULL_PIN)<br /><br />NOTE: These details won''t work on the Admin portion of (WEBSITE_URL_NAME) until you approved them. You can goto (WEBSITE_URL)(PADMAIN)/control to login and then select the command entitled &quot;Review Applicants&quot; to review them.<br /><br />(AUTORESPONDER_CLOSING_LINE)<br /><br />(WEBMASTER_NAME)<br />The (COMPANY_NAME) Staff<br />(WEBMASTER_TITLE)<br /><br />NOTE: This message was automatically generated. Please do not reply to this message, as this mailbox is not monitored.'),
('towebadmin_beta_closedbeta_registration', '(WEBSITE_URL_NAME) New Closed BETA Member Registration', 'Hello,<br /><br />We just wanted to let you know that someone has requested access to our website and they specified they wanted to become a Closed BETA Member.\r\nFor your reference, we have forwarded you a copy of their registration details:<br /><br />Username: (USERNAME)<br />Password: <i>hidden</i><br />PIN: (FULL_PIN)<br /><br />NOTE: These details won''t work on the Admin portion of (WEBSITE_URL_NAME) until you approved them. You can goto (WEBSITE_URL)(PADMAIN)/control to login and then select the command entitled &quot;Review Applicants&quot; to review them.<br /><br />(AUTORESPONDER_CLOSING_LINE)<br /><br />(WEBMASTER_NAME)<br />The (COMPANY_NAME) Staff<br />(WEBMASTER_TITLE)<br /><br />NOTE: This message was automatically generated. Please do not reply to this message, as this mailbox is not monitored.'),
('beta_admin_account_decision_registration_approve', '(WEBSITE_URL_NAME) - Admin Account Decision', 'Hello (TO_WHOM_IT_MAY_CONCERN),<br /><br />We just want to write you to let you know that your application request to be an Admin has been <b>Approved</b>. You may now logged into our site by going to (WEBSITE_URL)(PADMAIN)/control. <br /><br />(AUTORESPONDER_CLOSING_LINE)<br /><br />(WEBMASTER_NAME)<br />The (COMPANY_NAME) Staff<br />(WEBMASTER_TITLE)<br /><br />NOTE: This message was automatically generated. Please do not reply to this message, as this mailbox is not monitored.'),
('beta_admin_account_decision_registration_deny', '(WEBSITE_URL_NAME) - Admin Account Decision', 'Hello (TO_WHOM_IT_MAY_CONCERN),<br /><br />We just want to write you to let you know that your application request to be an Admin has been <b>Denied</b>. We are terribly sorry about this but you don''t quite meet our qualifications yet. If you want you can always reapply for the position by going to (WEBSITE_URL)(PADMAIN)/request.<br /><br />(AUTORESPONDER_CLOSING_LINE)<br /><br />(WEBMASTER_NAME)<br />The (COMPANY_NAME) Staff<br />(WEBMASTER_TITLE)<br /><br />NOTE: This message was automatically generated. Please do not reply to this message, as this mailbox is not monitored.'),
('sadminium_reset_password', '(WEBSITE_URL_NAME) - Member Reset Password', 'Hello (TO_WHOM_IT_MAY_CONCERN),<br /><br />We just want to write you to let you know that your account password has successfully been changed!. You may now logged into our site by going to (WEBSITE_URL)(PADMAIN)/control and typing in your new password. If you did not authorize this change, then that means something went horribly wrong and you should report it us <a href="(WEBSITE_URL)(PADMAIN)/report" target="_blank">here</a>. We will investigate it to see what happened. If this message did not come at a shock to you, please keep it for your records or if you choose not to you can delete it. :)<br /><br />(AUTORESPONDER_CLOSING_LINE)<br /><br />(WEBMASTER_NAME)<br />The (COMPANY_NAME) Staff<br />(WEBMASTER_TITLE)<br /><br />NOTE: This message was automatically generated. Please do not reply to this message, as this mailbox is not monitored.'),
('comment_approved', '(WEBSITE_URL_NAME) - Comment Approved', 'Hello (TO_WHOM_IT_MAY_CONCERN),<br /><br />We just want to write you to let you know that your comment posted on <a href="(WEBSITE_URL)(PADINFO)/(PNAME_URI)/permalink/(B_YEAR)/(B_MONTH)/(B_DAY)/(PNAME_TITLE_SAFE)">(PNAME_TITLE)</a> has been successfully approved on our website. You can see it <a href="(WEBSITE_URL)(PADINFO)/(PNAME_URI)/permalink/(B_YEAR)/(B_MONTH)/(B_DAY)/(PNAME_TITLE_SAFE)#(COMMENT_ID)">here</a>. If you did not authorize this comment post, then it looks like something must have happen and you can follow up with it by going to<br /><br /><a href="(WEBSITE_URL)(PADMAIN)/report">this link</a><br /><br />If this in fact was a terrible mistake then we sincerely apologize for this inconvenience and we will work with you on this to make it right. However if it wasn''t a mistake, then this email is for your records to keep.<br /><br />(AUTORESPONDER_CLOSING_LINE)<br /><br />(WEBMASTER_NAME)<br />The (COMPANY_NAME) Staff<br />(WEBMASTER_TITLE)<br /><br />NOTE: This message was automatically generated. Please do not reply to this message, as this mailbox is not monitored.'),
('comment_denied', '(WEBSITE_URL_NAME) - Comment Denied', 'Hello (TO_WHOM_IT_MAY_CONCERN),<br /><br />We just want to write you to let you know that your comment posted on <a href="(WEBSITE_URL)(PADINFO)/(PNAME_URI)/permalink/(B_YEAR)/(B_MONTH)/(B_DAY)/(PNAME_TITLE_SAFE)">(PNAME_TITLE)</a> has has been denied on our website. If you would like to submit it again, you can by going <a href="(WEBSITE_URL)(PADINFO)/(PNAME_URI)/permalink/(B_YEAR)/(B_MONTH)/(B_DAY)/(PNAME_TITLE_SAFE)#comments">here</a>. If you did not authorize this comment post, then it looks like something must have happen and you can follow up with it by going to<br /><br /><a href="(WEBSITE_URL)(PADMAIN)/report">this link</a><br /><br />If this in fact was a terrible mistake then we sincerely apologize for this inconvenience and we will work with you on this to make it right. However if it wasn''t a mistake, then this email is for your records to keep.<br /><br />(AUTORESPONDER_CLOSING_LINE)<br /><br />(WEBMASTER_NAME)<br />The (COMPANY_NAME) Staff<br />(WEBMASTER_TITLE)<br /><br />NOTE: This message was automatically generated. Please do not reply to this message, as this mailbox is not monitored.'),
('contact_response', 'You have a response from a question you asked at (WEBSITE_URL_NAME)!!', 'Hello (TO_WHOM_IT_MAY_CONCERN),<br /><br />We just want to let you know that someone has responded to your question you submitted. The details of your message are below:<br /><br />Who you contacted: (POC_NAME)<br />Your reason for contacting us: (REASON_NAME)<br />Your Message: (YMESSAGE)<br />Your ticket numder: (TICKET_ID)<br /><br />You can check the status of ticket by going to: <a href="(WEBSITE_URL)(PADINFO)/(FORMNAME)/checkstatus/(TICKET_ID)">contact/checkstatus</a><br /><br />If you did not contact us, then it looks like something must have happen and you can follow up with it by <a href="(WEBSITE_URL)(PADINFO)/report">reporting it</a>.<br /><br />If this in fact was a terrible mistake then we sincerely apologize for this inconvience and we will work with you on this to make it right. However if it wasn''t a mistake, then this email is for your records to keep.<br /><br />(AUTORESPONDER_CLOSING_LINE)<br /><br />(WEBMASTER_NAME)<br />The (COMPANY_NAME) Staff<br />(WEBMASTER_TITLE)<br /><br />NOTE: This message was automatically generated. Please do not reply to this message, as this mailbox is not monitored.'),
('contact_escalation', 'A message from (WEBSITE_URL_NAME)!', 'Hello (TO_WHOM_IT_MAY_CONCERN),<br /><br />We just want to let you know that the query you submitted is still being looked into. Also we had to escalate it to get it further resolved. You should hear from us within another 24-72 hours. Hopefully not that long, but please be patient. The details of your message are below:<br /><br />Who you contacted: (POC_NAME)<br />Your reason for contacting us: (REASON_NAME)<br />Your Message: (YMESSAGE)<br />Your ticket numder: (TICKET_ID)<br /><br />You can check the status of ticket by going to: <a href="(WEBSITE_URL)(PADINFO)/(FORMNAME)/checkstatus/(TICKET_ID)">contact/checkstatus</a><br /><br />If you did not contact us, then it looks like something must have happen and you can follow up with it by <a href="(WEBSITE_URL)(PADINFO)/report">reporting it</a>.<br /><br />If this in fact was a terrible mistake then we sincerely apologize for this inconvience and we will work with you on this to make it right. However if it wasn''t a mistake, then this email is for your records to keep.<br /><br />(AUTORESPONDER_CLOSING_LINE)<br /><br />(WEBMASTER_NAME)<br />The (COMPANY_NAME) Staff<br />(WEBMASTER_TITLE)<br /><br />NOTE: This message was automatically generated. Please do not reply to this message, as this mailbox is not monitored.');

-- --------------------------------------------------------

--
-- Table structure for table `h_changelog_categories`
--

CREATE TABLE IF NOT EXISTS `h_changelog_categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `shortname` varchar(200) NOT NULL,
  `parentid` int(10) NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `h_changelog_comments`
--

CREATE TABLE IF NOT EXISTS `h_changelog_comments` (
  `id` int(100) NOT NULL,
  `userid` int(10) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `yname` varchar(255) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `yemail` varchar(255) NOT NULL,
  `yweb` varchar(300) NOT NULL,
  `mood` int(10) NOT NULL,
  `title` varchar(30) NOT NULL,
  `content` longtext NOT NULL,
  `entry_id` int(10) NOT NULL,
  `dateandtime` datetime NOT NULL,
  `status` enum('Approved','Pending','Denied','Deleted') NOT NULL,
  `comment_ticket_id` varchar(300) NOT NULL,
  `extra_notes` longtext NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'yes',
  `ctype` enum('regular','badge') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `h_changelog_entries`
--

CREATE TABLE IF NOT EXISTS `h_changelog_entries` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) NOT NULL,
  `dateandtime` datetime NOT NULL,
  `dateandtime_goingtostart` datetime NOT NULL,
  `content` longtext NOT NULL,
  `author` int(10) NOT NULL,
  `category` int(10) NOT NULL,
  `tags` longtext NOT NULL,
  `date_year` int(4) NOT NULL,
  `date_month` enum('01','02','03','04','05','06','07','08','09','10','11','12') NOT NULL,
  `date_day` enum('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31') NOT NULL,
  `date_hour` enum('00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','58','59','60') NOT NULL,
  `date_min` enum('00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','58','59','60') NOT NULL,
  `date_sec` enum('00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','58','59','60') NOT NULL,
  `type` enum('MAJOR REL','GO MAS','UPDATE') NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'yes',
  `status` enum('Published','Drafted','On Hold','Deleted','Recovered') NOT NULL,
  `featured` enum('yes','no') NOT NULL,
  `featured_image` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `h_changelog_entries_types`
--

CREATE TABLE IF NOT EXISTS `h_changelog_entries_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `display_in_types_list` enum('yes','no') NOT NULL,
  `is_web_dir` enum('yes','no') NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'yes',
  `shortname` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `h_changelog_moods`
--

CREATE TABLE IF NOT EXISTS `h_changelog_moods` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=126 ;

--
-- Dumping data for table `h_changelog_moods`
--

INSERT INTO `h_changelog_moods` (`id`, `name`, `is_searchable`) VALUES
(1, 'Happy', 'no'),
(2, 'Sad', 'no'),
(3, 'Mad', 'no'),
(4, 'Curious', 'no'),
(5, 'Bloggie', 'no'),
(6, 'Accepted', 'no'),
(7, 'Accomplished', 'no'),
(8, 'Aggravated', 'no'),
(9, 'Alone', 'no'),
(10, 'Amused', 'no'),
(11, 'Angry', 'no'),
(12, 'Annoyed', 'no'),
(13, 'Anxious', 'no'),
(14, 'Apathetic', 'no'),
(15, 'Ashamed', 'no'),
(16, 'Awake', 'no'),
(17, 'Bewildered', 'no'),
(18, 'Bitchy', 'no'),
(19, 'Bittersweet', 'no'),
(20, 'Blah', 'no'),
(21, 'Blank', 'no'),
(22, 'Blissful', 'no'),
(23, 'Bored', 'no'),
(24, 'Bouncy', 'no'),
(25, 'Calm', 'no'),
(26, 'Cheerful', 'no'),
(27, 'Chipper', 'no'),
(28, 'Cold', 'no'),
(29, 'Complacent', 'no'),
(30, 'Confused', 'no'),
(31, 'Content', 'no'),
(32, 'Cranky', 'no'),
(33, 'Crappy', 'no'),
(34, 'Crazy', 'no'),
(35, 'Crushed', 'no'),
(36, 'Curious', 'no'),
(37, 'Cynical', 'no'),
(38, 'Dark', 'no'),
(39, 'Depressed', 'no'),
(40, 'Determined', 'no'),
(41, 'Devious', 'no'),
(42, 'Dirty', 'no'),
(43, 'Disappointed', 'no'),
(44, 'Discontent', 'no'),
(45, 'Ditzy', 'no'),
(46, 'Dorky', 'no'),
(47, 'Drained', 'no'),
(48, 'Drunk', 'no'),
(49, 'Ecstatic', 'no'),
(50, 'Energetic', 'no'),
(51, 'Enraged', 'no'),
(52, 'Enthralled', 'no'),
(53, 'Envious', 'no'),
(54, 'Exanimate', 'no'),
(55, 'Excited', 'no'),
(56, 'Exhausted', 'no'),
(57, 'Flirty', 'no'),
(58, 'Frustrated', 'no'),
(59, 'Full', 'no'),
(60, 'Geeky', 'no'),
(61, 'Giddy', 'no'),
(62, 'Giggly', 'no'),
(63, 'Gloomy', 'no'),
(64, 'Good', 'no'),
(65, 'Grateful', 'no'),
(66, 'Groggy', 'no'),
(67, 'Grumpy', 'no'),
(68, 'Guilty', 'no'),
(69, 'High', 'no'),
(70, 'Hopeful', 'no'),
(71, 'Hot', 'no'),
(72, 'Hungry', 'no'),
(73, 'Hyper', 'no'),
(74, 'Impressed', 'no'),
(75, 'Indescribable', 'no'),
(76, 'Indifferent', 'no'),
(77, 'Infuriated', 'no'),
(78, 'Irate', 'no'),
(79, 'Irritated', 'no'),
(80, 'Jealous', 'no'),
(81, 'Jubilant', 'no'),
(82, 'Lazy', 'no'),
(83, 'Lethargic', 'no'),
(84, 'Listless', 'no'),
(85, 'Lonely', 'no'),
(86, 'Loved', 'no'),
(87, 'Melancholy', 'no'),
(88, 'Mellow', 'no'),
(89, 'Mischievous', 'no'),
(90, 'Moody', 'no'),
(91, 'Morose', 'no'),
(92, 'Naughty', 'no'),
(93, 'Nerdy', 'no'),
(94, 'Not Specified', 'no'),
(95, 'Numb', 'no'),
(96, 'Okay', 'no'),
(97, 'Optimistic', 'no'),
(98, 'Peaceful', 'no'),
(99, 'Pessimistic', 'no'),
(100, 'Pissed off', 'no'),
(101, 'Pleased', 'no'),
(102, 'Predatory', 'no'),
(103, 'Quixotic', 'no'),
(104, 'Recumbent', 'no'),
(105, 'Refreshed', 'no'),
(106, 'Rejected', 'no'),
(107, 'Rejuvenated', 'no'),
(108, 'Relaxed', 'no'),
(109, 'Relieved', 'no'),
(110, 'Restless', 'no'),
(111, 'Rushed', 'no'),
(112, 'Satisfied', 'no'),
(113, 'Shocked', 'no'),
(114, 'Sick', 'no'),
(115, 'Silly', 'no'),
(116, 'Sleepy', 'no'),
(117, 'Smart', 'no'),
(118, 'Stressed', 'no'),
(119, 'Surprised', 'no'),
(120, 'Sympathetic', 'no'),
(121, 'Thankful', 'no'),
(122, 'Tired', 'no'),
(123, 'Touched', 'no'),
(124, 'Uncomfortable', 'no'),
(125, 'Weird', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `h_cp_adminmenu`
--

CREATE TABLE IF NOT EXISTS `h_cp_adminmenu` (
  `menu` int(10) NOT NULL,
  `page` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_cp_adminmenu`
--

INSERT INTO `h_cp_adminmenu` (`menu`, `page`) VALUES
(1, 0),
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(2, 0),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 6),
(3, 0),
(3, 1),
(3, 2),
(4, 0),
(4, 1),
(4, 2),
(4, 3),
(5, 0),
(5, 1),
(5, 2),
(5, 3),
(6, 0),
(7, 0),
(7, 1),
(7, 2),
(7, 3),
(8, 0),
(8, 1),
(8, 2),
(8, 3),
(8, 4),
(8, 5),
(8, 6),
(8, 7),
(8, 8),
(8, 9),
(9, 0),
(9, 1),
(9, 2),
(9, 3),
(9, 4),
(10, 0),
(10, 1),
(10, 2),
(10, 3),
(10, 4),
(11, 0),
(11, 1),
(11, 2),
(11, 3),
(11, 4),
(11, 5),
(11, 6),
(11, 7),
(11, 8),
(11, 9),
(11, 10),
(11, 11),
(11, 12),
(11, 13),
(7, 4),
(5, 4),
(4, 4),
(12, 0),
(13, 0),
(12, 2),
(13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `h_cp_adminmenu_menus`
--

CREATE TABLE IF NOT EXISTS `h_cp_adminmenu_menus` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `special` longtext NOT NULL,
  `default_state` enum('show','hidden') NOT NULL DEFAULT 'hidden',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `h_cp_adminmenu_menus`
--

INSERT INTO `h_cp_adminmenu_menus` (`id`, `name`, `special`, `default_state`) VALUES
(1, 'Dashboard', '', 'hidden'),
(2, 'Posts', '$LIST="blog,pages_af_atoz,otherwork,work,changelog,blog,pages_af_atoz,otherwork,work,changelog,"; /* put all the table names here that you want this script to count (follow with comma)*/\r\n$SUBLIST="_entries,_entries,_entries,_projects,_entries,_categories,_categories,_categories,_projects_types,_categories,"; /* for subitems (Eg. "_entries") */\r\n/* -------------------------------------------------------------------------- */\r\n/*                     DO NOT EDIT BELOW THIS LINE                            */\r\n/* -------------------------------------------------------------------------- */\r\n//establish variables being used\r\n$TOTAL=0;\r\n\r\n//explode the LIST\r\n$LIST_LIST=explode(",",$LIST);\r\n$SUBLIST_LIST=explode(",",$SUBLIST);\r\nfor($ilist=0; $ilist<count($LIST_LIST); $ilist++){\r\n	$item=$LIST_LIST[$ilist];\r\n	$sub_item=$SUBLIST_LIST[$ilist];\r\n	$GET_TOTAL_COMMENTS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."".$sub_item."");\r\n	$TOTAL+=mysql_num_rows($GET_TOTAL_COMMENTS);\r\n}\r\necho "(".$TOTAL.")";', 'hidden'),
(3, 'Media', '', 'hidden'),
(4, 'Links', '$LIST="links,"; /* put all the table names here that you want this script to count (follow with comma) */\r\n$SUBLIST=""; /* for subitems (Eg. "_entries") */\r\n/* -------------------------------------------------------------------------- */\r\n/*                     DO NOT EDIT BELOW THIS LINE                            */\r\n/* -------------------------------------------------------------------------- */\r\n//establish variables being used\r\n$TOTAL=0;\r\n\r\n//explode the LIST\r\n$LIST_LIST=explode(",",$LIST);\r\n$SUBLIST_LIST=explode(",",$SUBLIST);\r\nfor($ilist=0; $ilist<count($LIST_LIST); $ilist++){\r\n	$item=$LIST_LIST[$ilist];\r\n    $sub_item=$SUBLIST_LIST[$ilist];\r\n	$GET_TOTAL_COMMENTS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."".$sub_item."");\r\n	$TOTAL+=mysql_num_rows($GET_TOTAL_COMMENTS);\r\n}\r\necho "(".$TOTAL.")";', 'hidden'),
(5, 'Pages', '$LIST="pages,pages_modules,"; /* put all the table names here that you want this script to count (follow with comma) */\r\n$SUBLIST=""; /* for subitems (Eg. "_entries") */\r\n/* -------------------------------------------------------------------------- */\r\n/*                     DO NOT EDIT BELOW THIS LINE                            */\r\n/* -------------------------------------------------------------------------- */\r\n//establish variables being used\r\n$TOTAL=0;\r\n\r\n//explode the LIST\r\n$LIST_LIST=explode(",",$LIST);\r\n$SUBLIST_LIST=explode(",",$SUBLIST);\r\nfor($ilist=0; $ilist<count($LIST_LIST); $ilist++){\r\n	$item=$LIST_LIST[$ilist];\r\n    $sub_item=$SUBLIST_LIST[$ilist];\r\n	$GET_TOTAL_COMMENTS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."".$sub_item."");\r\n	$TOTAL+=mysql_num_rows($GET_TOTAL_COMMENTS);\r\n}\r\necho "(".$TOTAL.")";', 'hidden'),
(6, 'Comments', '$LIST="blog,"; /* put all the comment table names here that you want this script to count (follow with comma) */\r\n$SUBLIST="_comments,"; /* for subitems (Eg. "_entries") */\r\n/* -------------------------------------------------------------------------- */\r\n/*                     DO NOT EDIT BELOW THIS LINE                            */\r\n/* -------------------------------------------------------------------------- */\r\n//establish variables being used\r\n$TOTAL=0;\r\n\r\n//explode the LIST\r\n$LIST_LIST=explode(",",$LIST);\r\n$SUBLIST_LIST=explode(",",$SUBLIST);\r\nfor($ilist=0; $ilist<count($LIST_LIST); $ilist++){\r\n	$item=$LIST_LIST[$ilist];\r\n    $sub_item=$SUBLIST_LIST[$ilist];\r\n	$GET_TOTAL_COMMENTS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."".$sub_item." WHERE status=''pending''");\r\n	$TOTAL+=mysql_num_rows($GET_TOTAL_COMMENTS);\r\n}\r\necho "(".$TOTAL.")";', 'hidden'),
(7, 'Feedbacks', '$LIST="queries,"; /* put all the comment table names here that you want this script to count (follow with comma) */\r\n$SUBLIST="_contact"; /* for subitems (Eg. "_entries") */\r\n/* -------------------------------------------------------------------------- */\r\n/*                     DO NOT EDIT BELOW THIS LINE                            */\r\n/* -------------------------------------------------------------------------- */\r\n//establish variables being used\r\n$TOTAL=0;\r\n\r\n//explode the LIST\r\n$LIST_LIST=explode(",",$LIST);\r\n$SUBLIST_LIST=explode(",",$SUBLIST);\r\nfor($ilist=0; $ilist<count($LIST_LIST); $ilist++){\r\n	$item=$LIST_LIST[$ilist];\r\n    $sub_item=$SUBLIST_LIST[$ilist];\r\n	$GET_TOTAL_COMMENTS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."".$sub_item." WHERE status=''Open'' OR status=''Escalated''");\r\n	$TOTAL+=mysql_num_rows($GET_TOTAL_COMMENTS);\r\n}\r\necho "(".$TOTAL.")";', 'hidden'),
(8, 'Appearance', '', 'hidden'),
(9, 'Users', '$LIST="users,"; /* put all the table names here that you want this script to count (follow with comma)*/\r\n$SUBLIST=","; /* for subitems (Eg. "_entries") */\r\n/* -------------------------------------------------------------------------- */\r\n/*                     DO NOT EDIT BELOW THIS LINE                            */\r\n/* -------------------------------------------------------------------------- */\r\n//establish variables being used\r\n$TOTAL=0;\r\n\r\n//explode the LIST\r\n$LIST_LIST=explode(",",$LIST);\r\n$SUBLIST_LIST=explode(",",$SUBLIST);\r\nfor($ilist=0; $ilist<count($LIST_LIST); $ilist++){\r\n	$item=$LIST_LIST[$ilist];\r\n	$sub_item=$SUBLIST_LIST[$ilist];\r\n	$GET_TOTAL_COMMENTS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."".$sub_item." WHERE status != ''deleted''");\r\n	$TOTAL+=mysql_num_rows($GET_TOTAL_COMMENTS);\r\n}\r\necho "(".$TOTAL.")";', 'hidden'),
(10, 'Tools', '', 'hidden'),
(11, 'Settings', '', 'hidden'),
(12, 'Ad Maker', '$LIST="modules_ads,"; /* put all the table names here that you want this script to count (follow with comma)*/\r\n$SUBLIST=","; /* for subitems (Eg. "_entries") */\r\n/* -------------------------------------------------------------------------- */\r\n/*                     DO NOT EDIT BELOW THIS LINE                            */\r\n/* -------------------------------------------------------------------------- */\r\n//establish variables being used\r\n$TOTAL=0;\r\n\r\n//explode the LIST\r\n$LIST_LIST=explode(",",$LIST);\r\n$SUBLIST_LIST=explode(",",$SUBLIST);\r\nfor($ilist=0; $ilist<count($LIST_LIST); $ilist++){\r\n	$item=$LIST_LIST[$ilist];\r\n	$sub_item=$SUBLIST_LIST[$ilist];\r\n	$GET_TOTAL_COMMENTS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."".$sub_item."");\r\n	$TOTAL+=mysql_num_rows($GET_TOTAL_COMMENTS);\r\n}\r\necho "(".$TOTAL.")";', 'hidden'),
(13, 'Search', '', 'hidden');

-- --------------------------------------------------------

--
-- Table structure for table `h_cp_adminmenu_pages`
--

CREATE TABLE IF NOT EXISTS `h_cp_adminmenu_pages` (
  `id` int(10) NOT NULL,
  `menu` int(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `is_default` enum('yes','no') NOT NULL DEFAULT 'no',
  `is_special` enum('yes','no') NOT NULL DEFAULT 'no',
  `special_code` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_cp_adminmenu_pages`
--

INSERT INTO `h_cp_adminmenu_pages` (`id`, `menu`, `name`, `is_default`, `is_special`, `special_code`) VALUES
(1, 1, 'Home', 'yes', 'no', ''),
(2, 1, 'Comments I''ve Made', 'no', 'no', ''),
(3, 1, 'Site Stats', 'no', 'no', ''),
(4, 1, 'My Websites', 'no', 'no', ''),
(5, 1, 'Websites I Follow', 'no', 'no', ''),
(6, 1, 'Connections', 'no', 'no', ''),
(1, 2, 'All Posts', 'yes', 'yes', '$LIST="blog,pages_af_atoz,otherwork,work,changelog,"; /* put all the table names here that you want this script to count (follow with comma)*/\r\n$SUBLIST="_entries,_entries,_entries,_projects,_entries,"; /* for subitems (Eg. "_entries") */\r\n/* -------------------------------------------------------------------------- */\r\n/*                     DO NOT EDIT BELOW THIS LINE                            */\r\n/* -------------------------------------------------------------------------- */\r\n//establish variables being used\r\n$TOTAL=0;\r\n\r\n//explode the LIST\r\n$LIST_LIST=explode(",",$LIST);\r\n$SUBLIST_LIST=explode(",",$SUBLIST);\r\nfor($ilist=0; $ilist<count($LIST_LIST); $ilist++){\r\n	$item=$LIST_LIST[$ilist];\r\n	$sub_item=$SUBLIST_LIST[$ilist];\r\n	$GET_TOTAL_COMMENTS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."".$sub_item."");\r\n	$TOTAL+=mysql_num_rows($GET_TOTAL_COMMENTS);\r\n}\r\necho "(".$TOTAL.")";'),
(2, 2, 'Add New', 'no', 'no', ''),
(3, 2, 'Categories', 'no', 'yes', '$LIST="blog,pages_af_atoz,otherwork,work,changelog,"; /* put all the table names here that you want this script to count (follow with comma)*/\r\n$SUBLIST="_categories,_categories,_categories,_projects_types,_categories,"; /* for subitems (Eg. "_entries") */\r\n/* -------------------------------------------------------------------------- */\r\n/*                     DO NOT EDIT BELOW THIS LINE                            */\r\n/* -------------------------------------------------------------------------- */\r\n//establish variables being used\r\n$TOTAL=0;\r\n\r\n//explode the LIST\r\n$LIST_LIST=explode(",",$LIST);\r\n$SUBLIST_LIST=explode(",",$SUBLIST);\r\nfor($ilist=0; $ilist<count($LIST_LIST); $ilist++){\r\n	$item=$LIST_LIST[$ilist];\r\n	$sub_item=$SUBLIST_LIST[$ilist];\r\n	$GET_TOTAL_COMMENTS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."".$sub_item."");\r\n	$TOTAL+=mysql_num_rows($GET_TOTAL_COMMENTS);\r\n}\r\necho "(".$TOTAL.")";'),
(4, 2, 'Tags', 'no', 'no', ''),
(5, 2, 'Copy a Post', 'no', 'no', ''),
(1, 3, 'Library', 'yes', 'no', ''),
(2, 3, 'Add New', 'no', 'no', ''),
(1, 4, 'All Links', 'yes', 'no', ''),
(2, 4, 'Add New', 'no', 'no', ''),
(3, 4, 'Link Categories', 'no', 'no', ''),
(1, 5, 'Home', 'yes', 'yes', '$ITEM="pages";\r\n$WHERE=" WHERE status != ''Deleted''";\r\n\r\n$COUNT_=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$ITEM."".$WHERE."");\r\necho "(".mysql_num_rows($COUNT_).")";'),
(2, 5, 'Add New', 'no', 'no', ''),
(3, 5, 'Copy a Page', 'no', 'no', ''),
(1, 6, 'Comments', 'yes', 'no', ''),
(1, 7, 'Feedbacks', 'yes', 'no', ''),
(2, 7, 'Polls', 'no', 'no', ''),
(3, 7, 'Ratings', 'no', 'no', ''),
(1, 8, 'Themes', 'yes', 'no', ''),
(2, 8, 'Widgets', 'no', 'no', ''),
(3, 8, 'Menus', 'no', 'no', ''),
(4, 8, 'Theme Options', 'no', 'no', ''),
(5, 8, 'Header', 'no', 'no', ''),
(6, 8, 'Background', 'no', 'no', ''),
(7, 8, 'Custom Design', 'no', 'no', ''),
(8, 8, 'Mobile', 'no', 'no', ''),
(9, 8, 'iPad', 'no', 'no', ''),
(1, 9, 'All Users', 'yes', 'yes', '$LIST="users,"; /* put all the table names here that you want this script to count (follow with comma)*/\r\n$SUBLIST=","; /* for subitems (Eg. "_entries") */\r\n/* -------------------------------------------------------------------------- */\r\n/*                     DO NOT EDIT BELOW THIS LINE                            */\r\n/* -------------------------------------------------------------------------- */\r\n//establish variables being used\r\n$TOTAL=0;\r\n\r\n//explode the LIST\r\n$LIST_LIST=explode(",",$LIST);\r\n$SUBLIST_LIST=explode(",",$SUBLIST);\r\nfor($ilist=0; $ilist<count($LIST_LIST); $ilist++){\r\n	$item=$LIST_LIST[$ilist];\r\n	$sub_item=$SUBLIST_LIST[$ilist];\r\n	$GET_TOTAL_COMMENTS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."".$sub_item." WHERE status != ''deleted''");\r\n	$TOTAL+=mysql_num_rows($GET_TOTAL_COMMENTS);\r\n}\r\necho "(".$TOTAL.")";'),
(2, 9, 'Invite New', 'no', 'no', ''),
(3, 9, 'My Profile', 'no', 'no', ''),
(4, 9, 'Personal Settings', 'no', 'no', ''),
(1, 10, 'Available Tools', 'yes', 'no', ''),
(2, 10, 'Import', 'no', 'no', ''),
(3, 10, 'Delete Website', 'no', 'no', ''),
(4, 10, 'Export', 'no', 'no', ''),
(1, 11, 'General Settings', 'yes', 'no', ''),
(2, 11, 'Writing', 'no', 'no', ''),
(3, 11, 'Reading', 'no', 'no', ''),
(4, 11, 'Discussion', 'no', 'no', ''),
(5, 11, 'Media', 'no', 'no', ''),
(6, 11, 'Privacy', 'no', 'no', ''),
(7, 11, 'Sharing', 'no', 'no', ''),
(8, 11, 'Polls', 'no', 'no', ''),
(9, 11, 'Ratings', 'no', 'no', ''),
(10, 11, 'Email Post Changes', 'no', 'no', ''),
(11, 11, 'Text Messaging', 'no', 'no', ''),
(12, 11, 'OpenID', 'no', 'no', ''),
(13, 11, 'Webhooks', 'no', 'no', ''),
(4, 7, 'Queries', 'no', 'no', '$LIST="queries,"; /* put all the comment table names here that you want this script to count (follow with comma) */\r\n$SUBLIST="_contact"; /* for subitems (Eg. "_entries") */\r\n/* -------------------------------------------------------------------------- */\r\n/*                     DO NOT EDIT BELOW THIS LINE                            */\r\n/* -------------------------------------------------------------------------- */\r\n//establish variables being used\r\n$TOTAL=0;\r\n\r\n//explode the LIST\r\n$LIST_LIST=explode(",",$LIST);\r\n$SUBLIST_LIST=explode(",",$SUBLIST);\r\nfor($ilist=0; $ilist<count($LIST_LIST); $ilist++){\r\n	$item=$LIST_LIST[$ilist];\r\n    $sub_item=$SUBLIST_LIST[$ilist];\r\n	$GET_TOTAL_COMMENTS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."".$sub_item." WHERE status=''Open'' OR status=''Escalated''");\r\n	$TOTAL+=mysql_num_rows($GET_TOTAL_COMMENTS);\r\n}\r\necho "(".$TOTAL.")";'),
(4, 5, 'Page Modules', 'no', 'yes', '$COUNT_PAGE_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules");\necho "(".mysql_num_rows($COUNT_PAGE_MODULES).")";'),
(4, 4, 'Navigation', 'no', 'no', ''),
(0, 12, 'Dashboard', 'yes', 'no', ''),
(1, 12, 'Add New', 'no', 'no', ''),
(2, 12, 'Manage', 'no', 'yes', '$COUNT_PAGES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}modules_ads WHERE status != ''Deleted''");\r\necho "(".mysql_num_rows($COUNT_PAGES).")";'),
(0, 13, 'Menus', 'yes', 'no', '');

-- --------------------------------------------------------

--
-- Table structure for table `h_errorpages`
--

CREATE TABLE IF NOT EXISTS `h_errorpages` (
  `layout` enum('single','double','triple') NOT NULL,
  `code` varchar(200) NOT NULL,
  `content_main` longtext NOT NULL,
  `content_main_code` longtext NOT NULL,
  `content_main_after_code` longtext NOT NULL,
  `content_sidebar` longtext NOT NULL,
  `content_sidebar_code` longtext NOT NULL,
  `content_sidebar_after_code` longtext NOT NULL,
  `content_sidebar2` longtext NOT NULL,
  `content_sidebar_code2` longtext NOT NULL,
  `content_sidebar_after_code2` longtext NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_errorpages`
--

INSERT INTO `h_errorpages` (`layout`, `code`, `content_main`, `content_main_code`, `content_main_after_code`, `content_sidebar`, `content_sidebar_code`, `content_sidebar_after_code`, `content_sidebar2`, `content_sidebar_code2`, `content_sidebar_after_code2`, `is_searchable`) VALUES
('single', '404', '<h2 class="pages-maincontent-title">Uh Oh! I think I broke it!</h2>\r\n<p>The page you are requesting cannot be found on this server. You are seeing this because of one, or more, of the following reasons:</p>\r\n<ul>\r\n<li>You clicked a link that is no longer available.</li>\r\n<li>You changed something in the URL above to something that is not real.</li>\r\n<li>You are trying to hack us. In which case, that is highly frowned upon and you should now hang your head in shame and run<br>from this website because we are coming to get you!</li>\r\n<li>An actual page got changed by the webadmin and you clicked on a remnant of a page link (rarely happens).</li>\r\n</ul>\r\n<p>If you feel this is a mistake, then contact us <a href="(baseurl)(homelp)/contact" class="black-url">here</a> and we will fix it!</p>', '', '', '', '', '', '', '', '', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `h_filter_list`
--

CREATE TABLE IF NOT EXISTS `h_filter_list` (
  `word` varchar(100) NOT NULL,
  `type` enum('general','obscene','','') NOT NULL,
  `status` enum('allowed','not allowed','','') NOT NULL DEFAULT 'not allowed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_filter_list`
--

INSERT INTO `h_filter_list` (`word`, `type`, `status`) VALUES
('echo', 'general', 'not allowed'),
('$', 'general', 'not allowed'),
('mysql', 'general', 'not allowed'),
('query', 'general', 'not allowed'),
('modules', 'general', 'not allowed'),
('h2', 'general', 'not allowed'),
('<', 'general', 'not allowed'),
('>', 'general', 'not allowed'),
('porn', 'obscene', 'not allowed'),
('p0rn', 'obscene', 'not allowed'),
('po4n', 'obscene', 'not allowed'),
('ass', 'obscene', 'not allowed'),
('a5s', 'obscene', 'not allowed'),
('a55', 'obscene', 'not allowed'),
('fuck', 'obscene', 'not allowed'),
('bitch', 'obscene', 'not allowed'),
('b1tch', 'obscene', 'not allowed'),
('damn', 'obscene', 'not allowed'),
('d@mn', 'obscene', 'not allowed'),
('shit', 'obscene', 'not allowed'),
('sh1t', 'obscene', 'not allowed'),
('5h1t', 'obscene', 'not allowed'),
('5hit', 'obscene', 'not allowed'),
('crap', 'obscene', 'not allowed'),
('cr@p', 'obscene', 'not allowed'),
('slut', 'obscene', 'not allowed'),
('5lut', 'obscene', 'not allowed'),
('hore', 'obscene', 'not allowed'),
('h0re', 'obscene', 'not allowed'),
('h0r3', 'obscene', 'not allowed'),
('hor3', 'obscene', 'not allowed'),
('whore', 'obscene', 'not allowed'),
('wh0re', 'obscene', 'not allowed'),
('wh0r3', 'obscene', 'not allowed'),
('whor3', 'obscene', 'not allowed'),
('whor', 'obscene', 'not allowed'),
('wh0r', 'obscene', 'not allowed'),
('sex', 'obscene', 'not allowed'),
('s3x', 'obscene', 'not allowed'),
('ho', 'obscene', 'not allowed'),
('h0', 'obscene', 'not allowed'),
('a', 'general', 'allowed'),
('[youtube', 'general', 'not allowed'),
('[youtube]', 'general', 'not allowed'),
('[/youtube]', 'general', 'not allowed'),
('<?php', 'general', 'not allowed'),
('<?', 'general', 'not allowed'),
('?>', 'general', 'not allowed'),
('include', 'general', 'not allowed'),
('poop', 'obscene', 'not allowed'),
('poo', 'obscene', 'not allowed'),
('0', 'general', 'allowed'),
('07', 'general', 'allowed');

-- --------------------------------------------------------

--
-- Table structure for table `h_globalvars`
--

CREATE TABLE IF NOT EXISTS `h_globalvars` (
  `mode` enum('closed','alpha mode','closed beta','open beta','open','maintenance') NOT NULL DEFAULT 'closed',
  `defaultThemeID` int(10) NOT NULL,
  `display_social_modal` enum('yes','no') NOT NULL,
  `display_admaker` enum('yes','no') NOT NULL,
  `toTopMessage` varchar(200) NOT NULL,
  `toTopMessageFontSize` int(10) NOT NULL,
  `toTopMessageWidth` int(4) NOT NULL,
  `toTopMessageHeight` int(4) NOT NULL,
  `toTopMessageLineHeight` float(50,1) NOT NULL,
  `walls_list` longtext NOT NULL,
  `walls_pack_name` varchar(255) NOT NULL,
  `walls_duration` int(10) NOT NULL,
  `walls_fade` int(10) NOT NULL,
  `walls_randomize` enum('yes','no') NOT NULL,
  `walls_toggle` enum('on','off') NOT NULL,
  `default_webmaster_u` varchar(255) NOT NULL,
  `percent_complete` float(10,2) NOT NULL,
  `status_update` varchar(300) NOT NULL,
  `blog_entries_limit` int(10) NOT NULL,
  `featured_slider_limit` int(10) NOT NULL,
  `changelog_entries_limit` int(11) NOT NULL,
  `pages_af_atoz_entries_limit` int(10) NOT NULL,
  `pages_af_watchlist_entries_limit` int(10) NOT NULL,
  `blog_entries_in_sets_of` int(10) NOT NULL,
  `changelog_entries_in_sets_of` int(11) NOT NULL,
  `pages_af_atoz_entries_in_sets_of` int(10) NOT NULL,
  `pages_af_watchlist_entries_in_sets_of` int(10) NOT NULL,
  `html_in_comments` enum('yes','no') NOT NULL,
  `N_TAGs_in_comments` enum('yes','no') NOT NULL,
  `post_action_for_comments` enum('Approved Immediately','Subject to Approval','Approved after 24 hours') NOT NULL,
  `top_nav_use` enum('top navigation w/ search','top navigation w/o search','toolkit') NOT NULL,
  `tod_case` enum('U','L') NOT NULL,
  `blog_show_seconds` enum('Yes','No') NOT NULL,
  `pages_af_atoz_show_seconds` enum('Yes','No') NOT NULL,
  `blog_show_tod` enum('Yes','No') NOT NULL,
  `pages_af_atoz_show_tod` enum('Yes','No') NOT NULL,
  `blog_time_format` enum('12h','24h') NOT NULL,
  `pages_af_atoz_time_format` enum('12h','24h') NOT NULL,
  `work_rotator_theme` int(10) NOT NULL,
  `work_jcarousel_auto` int(10) NOT NULL,
  `work_jcarousel_scrollamt` int(10) NOT NULL,
  `work_jcarousel_wrap` enum('first','last','both','circular') NOT NULL,
  `sociallinks_jcarousel_auto` int(10) NOT NULL,
  `sociallinks_jcarousel_wrap` enum('first','last','both','circular') NOT NULL,
  `sociallinks_jcarousel_scrollamt` int(10) NOT NULL,
  `sociallinks_theme` int(10) NOT NULL,
  `sociallinks_type` enum('carousel','grfx') NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'no',
  `tagcloud_count` int(10) NOT NULL,
  `main_twitter` varchar(100) NOT NULL,
  `main_twitter_avatar_size` int(100) NOT NULL,
  `main_twitter_count` int(10) NOT NULL,
  `main_twitter_auto_join_text_default` varchar(100) NOT NULL,
  `main_twitter_auto_join_text_ed` varchar(100) NOT NULL,
  `main_twitter_auto_join_text_ing` varchar(100) NOT NULL,
  `main_twitter_auto_join_text_reply` varchar(100) NOT NULL,
  `main_twitter_auto_join_text_url` varchar(100) NOT NULL,
  `main_twitter_loading_text` varchar(100) NOT NULL,
  `BlogFlickrID` varchar(100) NOT NULL,
  `BlogFlickrName` varchar(100) NOT NULL,
  `closed_message_top` longtext NOT NULL,
  `closed_message_mid` longtext NOT NULL,
  `max_closed_beta_positions` int(10) NOT NULL,
  `max_admin_positions` int(10) NOT NULL,
  `launch_day` varchar(10) NOT NULL,
  `autoresponder_closing_line` longtext NOT NULL,
  `webmaster_email` varchar(300) NOT NULL,
  `tm_toggle` enum('on','off') NOT NULL,
  `tm_cbc` enum('on','off') NOT NULL,
  `posts_pad` longtext NOT NULL,
  `posts_page` longtext NOT NULL,
  `posts_list` longtext NOT NULL,
  `posts_defaults` longtext NOT NULL,
  `posts_sublist` longtext NOT NULL,
  `posts_names` longtext NOT NULL,
  `posts_special` longtext NOT NULL,
  `posts_special_item` longtext NOT NULL,
  `posts_default_order` longtext NOT NULL,
  `pages_modules_pad` longtext NOT NULL,
  `pages_modules_page` longtext NOT NULL,
  `pages_modules_list` longtext NOT NULL,
  `pages_modules_defaults` longtext NOT NULL,
  `pages_modules_sublist` longtext NOT NULL,
  `pages_modules_names` longtext NOT NULL,
  `pages_modules_special` longtext NOT NULL,
  `pages_modules_special_item` longtext NOT NULL,
  `pages_modules_default_order` longtext NOT NULL,
  `pages_pad` longtext NOT NULL,
  `pages_page` longtext NOT NULL,
  `pages_list` longtext NOT NULL,
  `pages_defaults` longtext NOT NULL,
  `pages_sublist` longtext NOT NULL,
  `pages_names` longtext NOT NULL,
  `pages_special` longtext NOT NULL,
  `pages_special_item` longtext NOT NULL,
  `pages_default_order` longtext NOT NULL,
  `uploader_type` enum('simple','flashy','flashy-enhanced') NOT NULL,
  `comments_pad` longtext NOT NULL,
  `comments_page` longtext NOT NULL,
  `comments_list` longtext NOT NULL,
  `comments_defaults` longtext NOT NULL,
  `comments_sublist` longtext NOT NULL,
  `comments_names` longtext NOT NULL,
  `comments_special` longtext NOT NULL,
  `comments_special_item` longtext NOT NULL,
  `comments_default_order` longtext NOT NULL,
  `queries_pad` longtext NOT NULL,
  `queries_page` longtext NOT NULL,
  `queries_list` longtext NOT NULL,
  `queries_defaults` longtext NOT NULL,
  `queries_sublist` longtext NOT NULL,
  `queries_names` longtext NOT NULL,
  `queries_special` longtext NOT NULL,
  `queries_special_item` longtext NOT NULL,
  `queries_default_order` longtext NOT NULL,
  `queries_poctable` longtext NOT NULL,
  `queries_reasontable` longtext NOT NULL,
  `oani` enum('fade','horizontal-slide','vertical-slide','horizontal-push') NOT NULL,
  `plugins_whatido_tagline_1` varchar(100) NOT NULL,
  `plugins_whatido_tagline_extra_1` varchar(200) NOT NULL,
  `plugins_whatido_tagline_extended_1` longtext NOT NULL,
  `plugins_whatido_tagline_2` varchar(100) NOT NULL,
  `plugins_whatido_tagline_extra_2` varchar(200) NOT NULL,
  `plugins_whatido_tagline_extended_2` longtext NOT NULL,
  `plugins_whatido_tagline_3` varchar(100) NOT NULL,
  `plugins_whatido_tagline_extra_3` varchar(200) NOT NULL,
  `plugins_whatido_tagline_extended_3` longtext NOT NULL,
  `plugins_whatido_tagline_af_1` longtext NOT NULL,
  `plugins_whatido_tagline_af_extra_1` longtext NOT NULL,
  `plugins_whatido_tagline_af_extended_1` longtext NOT NULL,
  `plugins_whatido_tagline_af_2` longtext NOT NULL,
  `plugins_whatido_tagline_af_extra_2` longtext NOT NULL,
  `plugins_whatido_tagline_af_extended_2` longtext NOT NULL,
  `plugins_whatido_tagline_af_3` longtext NOT NULL,
  `plugins_whatido_tagline_af_extra_3` longtext NOT NULL,
  `plugins_whatido_tagline_af_extended_3` longtext NOT NULL,
  `plugins_whatido_tagline_gf_1` longtext NOT NULL,
  `plugins_whatido_tagline_gf_extra_1` longtext NOT NULL,
  `plugins_whatido_tagline_gf_extended_1` longtext NOT NULL,
  `plugins_whatido_tagline_gf_2` longtext NOT NULL,
  `plugins_whatido_tagline_gf_extra_2` longtext NOT NULL,
  `plugins_whatido_tagline_gf_extended_2` longtext NOT NULL,
  `plugins_whatido_tagline_gf_3` longtext NOT NULL,
  `plugins_whatido_tagline_gf_extra_3` longtext NOT NULL,
  `plugins_whatido_tagline_gf_extended_3` longtext NOT NULL,
  `plugins_whatido_tagline_tmm_1` longtext NOT NULL,
  `plugins_whatido_tagline_tmm_extra_1` longtext NOT NULL,
  `plugins_whatido_tagline_tmm_extended_1` longtext NOT NULL,
  `plugins_whatido_tagline_tmm_2` longtext NOT NULL,
  `plugins_whatido_tagline_tmm_extra_2` longtext NOT NULL,
  `plugins_whatido_tagline_tmm_extended_2` longtext NOT NULL,
  `plugins_whatido_tagline_tmm_3` longtext NOT NULL,
  `plugins_whatido_tagline_tmm_extra_3` longtext NOT NULL,
  `plugins_whatido_tagline_tmm_extended_3` longtext NOT NULL,
  `plugins_whatido_tagline_ln_1` longtext NOT NULL,
  `plugins_whatido_tagline_ln_extra_1` longtext NOT NULL,
  `plugins_whatido_tagline_ln_extended_1` longtext NOT NULL,
  `plugins_whatido_tagline_ln_2` longtext NOT NULL,
  `plugins_whatido_tagline_ln_extra_2` longtext NOT NULL,
  `plugins_whatido_tagline_ln_extended_2` longtext NOT NULL,
  `plugins_whatido_tagline_ln_3` longtext NOT NULL,
  `plugins_whatido_tagline_ln_extra_3` longtext NOT NULL,
  `plugins_whatido_tagline_ln_extended_3` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_globalvars`
--

INSERT INTO `h_globalvars` (`mode`, `defaultThemeID`, `display_social_modal`, `display_admaker`, `toTopMessage`, `toTopMessageFontSize`, `toTopMessageWidth`, `toTopMessageHeight`, `toTopMessageLineHeight`, `walls_list`, `walls_pack_name`, `walls_duration`, `walls_fade`, `walls_randomize`, `walls_toggle`, `default_webmaster_u`, `percent_complete`, `status_update`, `blog_entries_limit`, `featured_slider_limit`, `changelog_entries_limit`, `pages_af_atoz_entries_limit`, `pages_af_watchlist_entries_limit`, `blog_entries_in_sets_of`, `changelog_entries_in_sets_of`, `pages_af_atoz_entries_in_sets_of`, `pages_af_watchlist_entries_in_sets_of`, `html_in_comments`, `N_TAGs_in_comments`, `post_action_for_comments`, `top_nav_use`, `tod_case`, `blog_show_seconds`, `pages_af_atoz_show_seconds`, `blog_show_tod`, `pages_af_atoz_show_tod`, `blog_time_format`, `pages_af_atoz_time_format`, `work_rotator_theme`, `work_jcarousel_auto`, `work_jcarousel_scrollamt`, `work_jcarousel_wrap`, `sociallinks_jcarousel_auto`, `sociallinks_jcarousel_wrap`, `sociallinks_jcarousel_scrollamt`, `sociallinks_theme`, `sociallinks_type`, `is_searchable`, `tagcloud_count`, `main_twitter`, `main_twitter_avatar_size`, `main_twitter_count`, `main_twitter_auto_join_text_default`, `main_twitter_auto_join_text_ed`, `main_twitter_auto_join_text_ing`, `main_twitter_auto_join_text_reply`, `main_twitter_auto_join_text_url`, `main_twitter_loading_text`, `BlogFlickrID`, `BlogFlickrName`, `closed_message_top`, `closed_message_mid`, `max_closed_beta_positions`, `max_admin_positions`, `launch_day`, `autoresponder_closing_line`, `webmaster_email`, `tm_toggle`, `tm_cbc`, `posts_pad`, `posts_page`, `posts_list`, `posts_defaults`, `posts_sublist`, `posts_names`, `posts_special`, `posts_special_item`, `posts_default_order`, `pages_modules_pad`, `pages_modules_page`, `pages_modules_list`, `pages_modules_defaults`, `pages_modules_sublist`, `pages_modules_names`, `pages_modules_special`, `pages_modules_special_item`, `pages_modules_default_order`, `pages_pad`, `pages_page`, `pages_list`, `pages_defaults`, `pages_sublist`, `pages_names`, `pages_special`, `pages_special_item`, `pages_default_order`, `uploader_type`, `comments_pad`, `comments_page`, `comments_list`, `comments_defaults`, `comments_sublist`, `comments_names`, `comments_special`, `comments_special_item`, `comments_default_order`, `queries_pad`, `queries_page`, `queries_list`, `queries_defaults`, `queries_sublist`, `queries_names`, `queries_special`, `queries_special_item`, `queries_default_order`, `queries_poctable`, `queries_reasontable`, `oani`, `plugins_whatido_tagline_1`, `plugins_whatido_tagline_extra_1`, `plugins_whatido_tagline_extended_1`, `plugins_whatido_tagline_2`, `plugins_whatido_tagline_extra_2`, `plugins_whatido_tagline_extended_2`, `plugins_whatido_tagline_3`, `plugins_whatido_tagline_extra_3`, `plugins_whatido_tagline_extended_3`, `plugins_whatido_tagline_af_1`, `plugins_whatido_tagline_af_extra_1`, `plugins_whatido_tagline_af_extended_1`, `plugins_whatido_tagline_af_2`, `plugins_whatido_tagline_af_extra_2`, `plugins_whatido_tagline_af_extended_2`, `plugins_whatido_tagline_af_3`, `plugins_whatido_tagline_af_extra_3`, `plugins_whatido_tagline_af_extended_3`, `plugins_whatido_tagline_gf_1`, `plugins_whatido_tagline_gf_extra_1`, `plugins_whatido_tagline_gf_extended_1`, `plugins_whatido_tagline_gf_2`, `plugins_whatido_tagline_gf_extra_2`, `plugins_whatido_tagline_gf_extended_2`, `plugins_whatido_tagline_gf_3`, `plugins_whatido_tagline_gf_extra_3`, `plugins_whatido_tagline_gf_extended_3`, `plugins_whatido_tagline_tmm_1`, `plugins_whatido_tagline_tmm_extra_1`, `plugins_whatido_tagline_tmm_extended_1`, `plugins_whatido_tagline_tmm_2`, `plugins_whatido_tagline_tmm_extra_2`, `plugins_whatido_tagline_tmm_extended_2`, `plugins_whatido_tagline_tmm_3`, `plugins_whatido_tagline_tmm_extra_3`, `plugins_whatido_tagline_tmm_extended_3`, `plugins_whatido_tagline_ln_1`, `plugins_whatido_tagline_ln_extra_1`, `plugins_whatido_tagline_ln_extended_1`, `plugins_whatido_tagline_ln_2`, `plugins_whatido_tagline_ln_extra_2`, `plugins_whatido_tagline_ln_extended_2`, `plugins_whatido_tagline_ln_3`, `plugins_whatido_tagline_ln_extra_3`, `plugins_whatido_tagline_ln_extended_3`) VALUES
('open beta', 4, 'no', 'no', '^', 22, 30, 30, 1.5, 'Futurism_Port,Purge,Port_City,Vincent_Callebaut_Lilypads,City-Of-Future,Winter-Of-The-Future,Lights,HomeOfTheFuture,battlefield-large,', 'TheFutureIsNow', 10000, 800, 'yes', 'on', '1', 76.35, 'We are now 13% done with the complete cPanel!', 5, 3, 5, 5, 5, 3, 3, 5, 5, 'no', 'yes', 'Subject to Approval', 'toolkit', 'L', 'No', 'Yes', 'Yes', 'Yes', '12h', '12h', 4, 5, 1, 'last', 3, 'last', 1, 5, 'grfx', 'no', 30, 'nat4ancorp', 50, 1, ' I said,', ' I', ' I was', ' I replied to', ' I was checking out', 'unboxing memories...', '78267297@N06', 'thedarkerwhiteblog', 'UNDER CONSTRUCTION', 'We will open', 1, 3, '11/12/2013', 'Take care and in His Name,', 'Nat4anCorp@nat4an.com', 'off', 'off', 'af,portfolio,portfolio,portfolio,portfolio,', 'a-z-list,blog,work,work,changes,', 'pages_af_atoz,blog,otherwork,work,changelog,', 'no,no,no,no,no,', 'entries,entries,entries,projects,entries,', 'AF : The A-Z List,The Blog,Other Work,My Work,Change Log,', '0,0,0,0,0,', 'none,none,none,none,none,none,', 'dateandtime OR dateandtime_goingtostart', ',', ',', 'pages_modules,', 'no,', ',', 'General Modules,', '0,', 'none,', 'title', ',', ',', 'pages,', 'no,', ',', 'General Pages,', '0,', 'none,', 'creation', 'flashy-enhanced', 'portfolio,af,', 'blog,a-z-list,', 'blog,pages_af_atoz,', 'no,no,', 'comments,comments,', 'Blog,AF : A to Z,', '0,0,', 'none,none,', 'dateandtime', 'portfolio,portfolio,tmm,', 'contact,report,contact,', 'queries,queries,queries,', 'no,no,no,', 'contact,report,tmm,', 'Nat4andotcom Queries,Report Queries,TMM Queries,', '0,0,0,', 'none,none,none,', 'dateandtime', 'users,users,tmm_virtuosos,', 'contact,report,tmm,', 'horizontal-push', 'Smart, Friendly, Fast', 'WEBSITES', 'I like to build smart, friendly, fast websites that are both sensible and creative to what you want and who your target audience is. I believe in skipping the complexity and diving right into building a simple and easy site for you and your audience to use.', 'SEO & UX Optimized', 'DESIGN & FUNCTIONALITY', 'My websites are designed with top-of-the-line optimization in SEO & UX to provide a you with a spider-able website that can be reached by thousands. Using Optimized Functionality can increase the traffic to and from your site.', 'Eye-Catchingly Amazing', 'GATEWAYS', 'Building a website is like opening up a gateway to another realm. I love to build amazing Eye-Catching websites that aren''t just websites, but paths to new worlds. I don''t just want to make your site, I want to build your world.', 'Supernatural', 'Anime from OoTW', 'One of the biggest things to anime is how supernatural-feeling, out-of-this-world it can be. We love every single aspect of an anime that allows one to completely leave this world behind and enter into another realm.', 'The Artwork', 'made by Anime-Makers', 'Anime has some creative artwork that is very well done. The artists actually take longer than most people when developing a character. It just makes it seems so stunningly amazing.', 'Raving', 'to people of new anime', 'When we find out about a new anime, we immediately share it with our friends and occasionally family. We love how there is an incredible fan-base in the world of Anime.', '24/7 Gaming', 'Non-stop when ever, where ever', 'We live for kill joys, love to get achievements, and crave those insane moments while we are behind the box or machine. We are constantly playing games. Basically, We Love Gaming. :)', 'Tips and Cheats', 'AVAILABLE FOR YOU', 'We go deep into the game to uncover all the nitty-gritty material that makes up the game and provide you with helpful hints, colorful hacks/cheats, and things that may help you on your quest.', 'Always Reviewing', 'The Latest Innovating Games', 'When we come across a game that just needs to be reviewed, we cover it here. We love to take a look at the latest and provide you with full coverage on it.', 'Epic Beats', 'you can dance to', 'We love to listen to and make infectious melodies and beats that are truly epic works of art.', 'Outrageous Hooks', 'that will make you want more', 'The Hook is one of the most amazing parts of any song; this is the part that sinks you into the euphoric track. We love to build these up like nothing else.', 'Fantastic Drops', 'the whole family can enjoy', 'Dropping a line in a song can be as simple as a build up, build up, build up...wait...drop or something that stops everything to kick in a melody.', 'Wearing Glasses', 'whenever we feel like it', 'What is a nerd without glasses? We always put on our nerd glasses to help you, even if some of us don''t wear any glasses.', 'Geeking Out', 'at every little toy', 'Yes, whether it is a Doctor Who Tardis Coke Cooler or a working Hover Craft; we always love what we do.', 'Coding', 'the world''s solutions', 'Many of the world''s problems can be solved by coding, the right way. We take pride in our coding jobs and enjoy building amazing things with code.');

-- --------------------------------------------------------

--
-- Table structure for table `h_jc_themes`
--

CREATE TABLE IF NOT EXISTS `h_jc_themes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `h_jc_themes`
--

INSERT INTO `h_jc_themes` (`id`, `name`, `status`) VALUES
(1, 'alpha', 'active'),
(2, 'ionius', 'inactive'),
(3, 'macho', 'inactive'),
(4, 'tango', 'active'),
(5, 'niteo', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `h_launchpads`
--

CREATE TABLE IF NOT EXISTS `h_launchpads` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `short` varchar(10) NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'no',
  `padname` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `h_launchpads`
--

INSERT INTO `h_launchpads` (`id`, `name`, `short`, `is_searchable`, `padname`) VALUES
(1, 'Base', 'base', 'no', 'main'),
(2, 'Pad 1', 'pad1', 'no', '1'),
(3, 'Pad 2', 'pad2', 'no', '2'),
(4, 'Pad 3', 'pad3', 'no', '3'),
(5, 'Pad 4', 'pad4', 'no', '4');

-- --------------------------------------------------------

--
-- Table structure for table `h_links`
--

CREATE TABLE IF NOT EXISTS `h_links` (
  `url` varchar(500) NOT NULL,
  `target` enum('_blank','_self','_parent','_top') NOT NULL,
  `title` varchar(200) NOT NULL,
  `type` enum('blogroll') NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_links`
--

INSERT INTO `h_links` (`url`, `target`, `title`, `type`, `name`, `is_searchable`) VALUES
('http://anthonyvenable110.wordpress.com/', '_blank', 'A guy who talks about anything computer-related or food-related!!!', 'blogroll', 'AnthonyVenable''s Edible Tech Blog', 'yes'),
('http://chrisneighbors.com/', '_blank', 'Personal Finance and Investing Blog', 'blogroll', 'Chris Neighbors', 'yes'),
('http://jonraasch.com/blog/', '_blank', 'John Raasch is a front-end web developer / designer in Portland, OR. I love all things Javascript, jQuery and UX.', 'blogroll', 'John Raasch''s Awsum Blog', 'yes'),
('http://labnotes.org/', '_blank', 'A blog by Assaf Arkin. Your morning goodness. The Daily Hi. A cool little short-sweet-n-to-the-point blog for all your needs', 'blogroll', 'Lab Notes', 'yes'),
('http://roadtoangelo.tumblr.com/', '_blank', 'A Tumblr for my awsum ness!', 'blogroll', 'Road to Angelo Tumblr', 'yes'),
('http://blog.desinghrajan.in/', '_blank', 'a blog about computer & technology', 'blogroll', '[SOLVED] Desing Hrajan''s Blog', 'yes'),
('http://www.fourfront.us/blog/', '_blank', 'FourFront Blog', 'blogroll', 'For all your CSS Needs', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `h_modules_ads`
--

CREATE TABLE IF NOT EXISTS `h_modules_ads` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `status` enum('active','inactive','deleted') COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('top') COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `target` enum('_blank','_self','_parent') COLLATE utf8_unicode_ci NOT NULL,
  `img_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img_border` enum('on','off') COLLATE utf8_unicode_ci NOT NULL,
  `img_alt` longtext COLLATE utf8_unicode_ci NOT NULL,
  `img_width` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `img_height` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `img_align` enum('center') COLLATE utf8_unicode_ci NOT NULL,
  `times_displayed` int(255) NOT NULL,
  `dateandtime` datetime NOT NULL,
  `date_year` int(4) NOT NULL,
  `date_month` enum('01','02','03','04','05','06','07','08','09','10','11','12') COLLATE utf8_unicode_ci NOT NULL,
  `date_day` enum('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31') COLLATE utf8_unicode_ci NOT NULL,
  `date_hour` enum('00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24') COLLATE utf8_unicode_ci NOT NULL,
  `date_min` enum('00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','58','59','60') COLLATE utf8_unicode_ci NOT NULL,
  `date_sec` enum('00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','58','59','60') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `h_modules_ads`
--

INSERT INTO `h_modules_ads` (`id`, `status`, `name`, `type`, `url`, `target`, `img_location`, `img_border`, `img_alt`, `img_width`, `img_height`, `img_align`, `times_displayed`, `dateandtime`, `date_year`, `date_month`, `date_day`, `date_hour`, `date_min`, `date_sec`) VALUES
(1, 'inactive', 'Viral Cycler', 'top', 'http://viralcycler.com/x/nat4ancorp', '_blank', 'http://viralcycler.com/x/admin/images/1366041815.gif', '', 'Earn HUGE Commissions with this simple system!', '100%', '100', 'center', 808, '2013-05-07 00:19:00', 2013, '05', '07', '00', '19', '00'),
(2, 'inactive', 'Viral Repeat', 'top', 'http://www.viralrepeat.com/?rid=2244', '_blank', 'http://www.viralrepeat.com/getimg.php?id=2', '', 'Viral Marketing System Gets Me Quality Traffic Every Day', '100%', '100', 'center', 796, '2013-05-07 00:15:00', 2013, '05', '07', '00', '15', '00'),
(3, 'inactive', 'RealHitz4u', 'top', 'http://www.realhitz4u.com/?rid=101154', '_blank', 'http://www.realhitz4u.com/refbanners/pscbanner468x60.gif', '', 'Start getting the traffic you deserve!', '100%', '100', 'center', 785, '2013-05-07 00:19:00', 2013, '05', '07', '00', '19', '00'),
(4, 'active', 'Cash In On Banners', 'top', 'http://www.cashinonbanners.com/?r=30156', '_blank', 'http://www.cashinonbanners.com/images/banner468x60_1.gif', 'off', 'Get A Million+ of Guaranteed Visitors - FREE!', '100%', '100', 'center', 1109, '2013-05-07 00:17:00', 2013, '05', '07', '00', '17', '00'),
(5, 'active', 'Advertise your Business', 'top', 'http://www.nat4an.com/portfolio/contact&reason=advertise', '_self', 'http://www.nat4an.com/includes/public/uploads/Modules/admaker/advertise_your_business.jpg', 'on', 'Starting prices vary and are first-come-first-server basis! Lock in your Advertising today!', '100%', '100', 'center', 1033, '0000-00-00 00:00:00', 0, '01', '01', '00', '00', '00'),
(6, 'active', 'Cash In On Banners', 'top', 'http://www.cashinonbanners.com/?r=30156', '_blank', 'http://www.cashinonbanners.com/images/10$fastPile2.gif', 'off', 'Amazingly Powerful FREE Method of Generating Traffic!', '100%', '100', 'center', 1045, '2013-05-06 22:54:00', 2013, '05', '06', '22', '54', '01'),
(7, 'active', 'Blue Surf', 'top', 'http://www.blue-surf.net/splash/com-crazy.php?r=nat4ancorp', '_blank', 'http://www.blue-surf.net/images/banner-rotator.php', 'off', 'Commission Crazy! I made $3,214 in the last 3 days! Find out how!', '100%', '100', 'center', 1002, '2013-05-07 00:32:00', 2013, '05', '07', '00', '32', '00');

-- --------------------------------------------------------

--
-- Table structure for table `h_navigation`
--

CREATE TABLE IF NOT EXISTS `h_navigation` (
  `name` varchar(255) NOT NULL,
  `surl` varchar(255) NOT NULL,
  `parent` varchar(200) NOT NULL,
  `launchpad` int(100) NOT NULL,
  `type` enum('nav','topnav','subnav','bottomnav') NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_navigation`
--

INSERT INTO `h_navigation` (`name`, `surl`, `parent`, `launchpad`, `type`, `is_searchable`) VALUES
('Blank Page', 'page1', '', 1, 'nav', 'no'),
('PostSystem Example', 'page2', '', 1, 'nav', 'no'),
('MTS Example', 'page3', '', 1, 'nav', 'no'),
('A Page', 'page4', '', 1, 'nav', 'no'),
('Blank Page', 'page1', '', 2, 'nav', 'no'),
('PostSystem Example', 'page2', '', 2, 'nav', 'no'),
('MTS Example', 'page3', '', 3, 'nav', 'no'),
('A Page', 'page4', '', 2, 'nav', 'no'),
('Blank Page', 'page1', '', 3, 'nav', 'no'),
('PostSystem Example', 'page2', '', 3, 'nav', 'no'),
('MTS Example', 'page3', '', 2, 'nav', 'no'),
('A Page', 'page4', '', 3, 'nav', 'no'),
('Blank Page', 'page1', '', 4, 'nav', 'no'),
('PostSystem Example', 'page2', '', 4, 'nav', 'no'),
('MTS Example', 'page3', '', 4, 'nav', 'no'),
('A Page', 'page4', '', 4, 'nav', 'no'),
('Blank Page', 'page1', '', 5, 'nav', 'no'),
('PostSystem Example', 'page2', '', 5, 'nav', 'no'),
('MTS Example', 'page3', '', 5, 'nav', 'no'),
('A Page', 'page4', '', 5, 'nav', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `h_pages`
--

CREATE TABLE IF NOT EXISTS `h_pages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `page_lock` enum('restrict all','restrict non head admins','restrict non admins','restrict non amb','off') NOT NULL DEFAULT 'off',
  `page` varchar(255) NOT NULL,
  `layout` enum('single','double','triple') NOT NULL,
  `pageNAME` varchar(255) NOT NULL,
  `pageKEYWORDS` longtext NOT NULL,
  `lp` enum('all','padmain','pad1','pad2','pad3','pad4') NOT NULL,
  `lpm` int(10) NOT NULL,
  `subpage` varchar(255) NOT NULL,
  `created` date NOT NULL,
  `content_main` longtext NOT NULL,
  `content_main_code` longtext NOT NULL,
  `content_main_after_code` longtext NOT NULL,
  `content_sidebar` longtext NOT NULL,
  `content_sidebar_code` longtext NOT NULL,
  `content_sidebar_after_code` longtext NOT NULL,
  `content_sidebar2` longtext NOT NULL,
  `content_sidebar_code2` longtext NOT NULL,
  `content_sidebar_after_code2` longtext NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'yes',
  `toggle_feat` enum('on','off') NOT NULL DEFAULT 'off',
  `status` enum('Drafted','Published','On Hold','Deleted','Recovered') NOT NULL DEFAULT 'Published',
  `visits` int(255) NOT NULL,
  `last_known_ip` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `h_pages`
--

INSERT INTO `h_pages` (`id`, `page_lock`, `page`, `layout`, `pageNAME`, `pageKEYWORDS`, `lp`, `lpm`, `subpage`, `created`, `content_main`, `content_main_code`, `content_main_after_code`, `content_sidebar`, `content_sidebar_code`, `content_sidebar_after_code`, `content_sidebar2`, `content_sidebar_code2`, `content_sidebar_after_code2`, `is_searchable`, `toggle_feat`, `status`, `visits`, `last_known_ip`) VALUES
(1, 'off', 'page1', 'double', 'Blank Page', 'about,who is Nat4an?,Design and Technology Academy,Eureka,Nat4an.com,LOVE to code,pentium computer,level 12 Flunky,What do I think about the Web,how to feed a gold fish,lost the art of communication,Minecraft,CMS', 'padmain', 1, '', '2012-07-26', '<h2 class="pages-maincontent-title">(THE_PARAGRAPH_TITLE)</h2>\r\n<div class="pages-maincontent-content">\r\n<div class="pages-maincontent-content-inner">\r\n<p>This block of text is a basic template that has been made for your convenience as a placeholder to make your new website look like it has stuff on it. You can write anything you want here. Please keep the structure of this content the way it is now and put your content for this paragraph between the &quot;pages-maincontent-content-inner&quot; if you would like to retain the original CSS structure or you could just completely write your own HTML Only code in here (or just plain text) and change up the styles by either adding them to this textbox or editing the theme CSS by going to Appearence and then Editor. Either way, this is just to help you.</p>\r\n</div>\r\n</div>\r\n\r\n<h2 class="pages-maincontent-title">(THE_PARAGRAPH_TITLE)</h2>\r\n<div class="pages-maincontent-content">\r\n<div class="pages-maincontent-content-inner">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget mauris nisl. Ut id dolor in est sodales euismod nec aliquet enim. Cras in vehicula urna, et eleifend nunc. Vivamus malesuada ultricies elit eget consectetur. Nunc nibh velit, mollis non pulvinar nec, congue sit amet eros. Praesent vehicula nisi sed magna mollis dapibus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean tristique rhoncus ipsum vel commodo. Suspendisse lacinia urna nec enim iaculis rutrum. Proin vel quam orci. Donec non risus mi. Sed non felis sed dui vulputate tempus. Mauris aliquet, magna vitae ultricies tincidunt, arcu nisl vehicula mi, et imperdiet nunc sem quis lorem. Duis vitae cursus ante. Sed a egestas purus, sit amet placerat mi. Pellentesque volutpat consequat viverra.</p>\r\n</div>\r\n</div>', '//@$launchpad=$_GET[''launchpad''];\r\n/* This section is for custom PHP code. You can use this to put some server parsing code from creating a dynamic link to creating the entire page in PHP. Have fun! Go nuts!. Make sure to remove this comment unless you want it to stay. :) */', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$page'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' AND status=''Published'' AND toggle_visible=''on'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	$toggle_visible=$FETCH_MODULES[''toggle_visible''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		if($toggle_visible == "on"){eval($contents);}else if($toggle_visible == "off"){/* not visible */}\r\n	echo "</div>";\r\n}', '', '', '', '', 'yes', 'off', 'Published', 31, '127.0.0.1'),
(3, 'off', 'page3', 'double', 'MTS Example', 'contact Nat4an,contact Nathan Smyth,contacting Nat4an Corp', 'padmain', 1, '', '2012-08-12', '', '$TITLE						= "(NAME FOR CONTACT)";\r\n$PADINFO					= $properties->PADMAIN;\r\n$DBTBLSTART					= "";\r\n$EXTRA_NAME					= ""; //for the email subject\r\n$EXTRA_NAME_SAFE			= ""; //the safe version of $EXTRA_NAME\r\nglobal $FORMNAME;\r\n$FORMNAME					= "contact"; //usually the page name\r\n$POC_DB						= "users"; //could be: users, tmm_virtuosos, etc\r\n$POC_DB_WHERE_TYPE_CLAUSE	= "type = ''admin''"; //the where clause of the poc db\r\n$POC_DB_ORDER_BY			= "uname";\r\n$QUERY_TABLENAME			= "queries_"; //the part after the prefix of the tablename\r\n$QUERY_TABLESUBNAME			= "contact"; //the part after the _ after the $QUERY_TABLENAME\r\n$TYPE                                   = "contact";\r\n/* ---------- DO NOT EDIT BELOW THIS LINE OR ELSE YOU WILL BREAK IT --------- */\r\ninclude("includes/private/bin/plugins/mts/plugin.php");', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$page'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' AND status=''Published'' AND toggle_visible=''on'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	$toggle_visible=$FETCH_MODULES[''toggle_visible''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		if($toggle_visible == "on"){eval($contents);}else if($toggle_visible == "off"){/* not visible */}\r\n	echo "</div>";\r\n}', '', '', '', '', 'yes', 'off', 'Published', 22, '127.0.0.1'),
(4, 'off', 'home', 'double', 'Home', 'Nat4an,Nathan,Home,web designer,', 'padmain', 1, '', '2012-09-08', '<br />', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$properties->PADMAIN$page'' AND type=''maincontent'' AND launchpad=''$launchpadPN'' AND toggle_visible=''on'' AND status=''Published'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n        $mini_title=$FETCH_MODULES[''mini_title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<div class=\\"pages-sidebar-title\\">{$title} <div class=\\"pages-sidebar-minititle\\">{$mini_title}</div></div>";}\r\n	echo "<div class=\\"pages-maincontent-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		eval($contents);\r\n	echo "</div>";\r\n}', '', '<br />', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$properties->PADMAIN$page'' AND type=''sidebar'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' AND toggle_visible=''on'' AND status=''Published'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<div class=\\"pages-sidebar-title\\">{$title}</div>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		eval($contents);\r\n	echo "</div>";\r\n}', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$properties->PADMAIN$page'' AND type=''sidebar'' AND sidebar=''2'' AND launchpad=''$launchpadPN'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		eval($contents);\r\n	echo "</div>";\r\n}', '', 'yes', 'on', 'Published', 42, '127.0.0.1'),
(5, 'off', 'search', 'double', 'Search', 'nat4an current projects,projects by Nat4an,projects,work', 'padmain', 1, '', '2012-09-10', '', '/* SEARCH FUNCTION FOR NAT4AN.COM */\r\n/* EVERYTHING YOU NEED TO SEARCH MY SITE IS RIGHT HERE IN THE CODE AND IN THE PROPS.PHP PAGE */\r\n/* COPYRIGHT Â© 2012 NAT4AN CORP. NOT TO BE COPIED */\r\n/* ORIGINAL CODING WORK: NATHAN SMYTH */\r\n/* --------------------------------------------------------- BEGIN ---------------------------------------------------------*/\r\nerror_reporting(0);\r\n//get variables and other materials\r\nmb_language(''uni'');\r\nmb_internal_encoding(''UTF-8'');\r\n@$searchQuery=$_POST[''search''];\r\n@$SEARCH_TEXT=$properties->SEARCH_TEXT;\r\nif($searchQuery == $SEARCH_TEXT){$SEARCH_TEXT="&quot;".$SEARCH_TEXT."&quot;";}else if(strlen(trim(preg_replace(''/\\xc2\\xa0/'','' '',$searchQuery))) == 0){$SEARCH_TEXT="nothing";}\r\n\r\n//build search\r\nif(($searchQuery == "") || ($searchQuery == " ") || (strlen(trim(preg_replace(''/\\xc2\\xa0/'','' '',$searchQuery))) == 0)){\r\n	echo "<h2 class=\\"pages-maincontent-title\\">Uh oh! It looks like a diglett just appeared here</h2>";\r\n	echo "<h2>You must type in something to search for it. You cannot just search for {$SEARCH_TEXT}.</h2>";\r\n} else {\r\n	echo "<h2 class=\\"pages-maincontent-title\\">Searching Nat4an.com for &quot;".$searchQuery."&quot;</h2>";\r\n	SEARCH($properties,$searchQuery);\r\n}', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$page'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	$toggle_visible=$FETCH_MODULES[''toggle_visible''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		if($toggle_visible == "on"){eval($contents);}else if($toggle_visible == "off"){/* not visible */}\r\n	echo "</div>";\r\n}', '', '', '', '', 'no', 'off', 'Published', 4, '127.0.0.1'),
(6, 'off', 'changes', 'single', 'Site Changes', 'site changes, changelog,', 'padmain', 1, '', '2012-09-14', '<br />', '/* YOU MIGHT HAVE TO SEARCH FOR THE PAD NAME (PADMAIN, PAD1 THROUGH 4, AND CHANGE IT BASED ON WHAT PAD */\r\n$pname="changelog";\r\n$pname_special="Changes";\r\n$pname_uri="changes";\r\n$display_user=true;\r\n$PADINFO=$properties->PADMAIN;\r\n$PNAME_PUBLISHED_NAME="Published";\r\n/* ---------- DO NOT EDIT BELOW THIS LINE OR ELSE YOU WILL BREAK IT --------- */\r\ninclude("includes/private/bin/plugins/PostSystem/plugin.php");', '', '', '', '', '', '', '', 'yes', 'off', 'Published', 3, '127.0.0.1'),
(7, 'off', 'privacy', 'single', 'Privacy Policy', 'privacy,policy,', 'padmain', 1, '', '2012-09-14', '<h2 class="pages-maincontent-title">Privacy Policy</h2>\r\n<div class="pages-maincontent-content">\r\n\r\n<div style="font-family:arial"><strong>What information do we collect?</strong> <br /><br />We collect information from you when you register on our site, subscribe to our newsletter, respond to a survey or fill out a form.  <br /><br />When ordering or registering on our site, as appropriate, you may be asked to enter your: name, e-mail address or phone number. You may, however, visit our site anonymously.<br /><br /><strong>What do we use your information for?</strong> <br /><br />Any of the information we collect from you may be used in one of the following ways: <br /><br />; To personalize your experience<br />(your information helps us to better respond to your individual needs)<br /><br />; To improve our website<br />(we continually strive to improve our website offerings based on the information and feedback we receive from you)<br /><br />; To improve customer service<br />(your information helps us to more effectively respond to your customer service requests and support needs)<br /><br /><br />; To administer a contest, promotion, survey or other site feature<br /><br /><br />; To send periodic emails<br /><br />The email address you provide may be used to send you information, respond to inquiries, and/or other requests or questions.<br /><br /><strong>How do we protect your information?</strong> <br /><br />We implement a variety of security measures to maintain the safety of your personal information when you enter, submit, or access your personal information. <br /> <br />We offer the use of a secure server. All supplied sensitive/credit information is transmitted via Secure Socket Layer (SSL) technology and then encrypted into our Database to be only accessed by those authorized with special access rights to our systems, and are required to?keep the information confidential. <br /><br />After a transaction, your private information (credit cards, social security numbers, financials, etc.) will not be stored on our servers.<br /><br /><strong>Do we use cookies?</strong> <br /><br />Yes (Cookies are small files that a site or its service provider transfers to your computers hard drive through your Web browser (if you allow) that enables the sites or service providers systems to recognize your browser and capture and remember certain information<br /><br /> We use cookies to understand and save your preferences for future visits, keep track of advertisements and compile aggregate data about site traffic and site interaction so that we can offer better site experiences and tools in the future.<br /><br /><strong>Do we disclose any information to outside parties?</strong> <br /><br />We do not sell, trade, or otherwise transfer to outside parties your personally identifiable information. This does not include trusted third parties who assist us in operating our website, conducting our business, or servicing you, so long as those parties agree to keep this information confidential. We may also release your information when we believe release is appropriate to comply with the law, enforce our site policies, or protect ours or others rights, property, or safety. However, non-personally identifiable visitor information may be provided to other parties for marketing, advertising, or other uses.<br /><br /><strong>Third party links</strong> <br /><br /> Occasionally, at our discretion, we may include or offer third party products or services on our website. These third party sites have separate and independent privacy policies. We therefore have no responsibility or liability for the content and activities of these linked sites. Nonetheless, we seek to protect the integrity of our site and welcome any feedback about these sites.<br /><br /><strong>California Online Privacy Protection Act Compliance</strong><br /><br />Because we value your privacy we have taken the necessary precautions to be in compliance with the California Online Privacy Protection Act. We therefore will not distribute your personal information to outside parties without your consent.<br /><br />As part of the California Online Privacy Protection Act, all users of our site may make any changes to their information at anytime by logging into their control panel and going to the ''Edit Profile'' page.<br /><br /><strong>Childrens Online Privacy Protection Act Compliance</strong> <br /><br />We are in compliance with the requirements of COPPA (Childrens Online Privacy Protection Act), we do not collect any information from anyone under 13 years of age. Our website, products and services are all directed to people who are at least 13 years old or older.<br /><br /><strong>Online Privacy Policy Only</strong> <br /><br />This online privacy policy applies only to information collected through our website and not to information collected offline.<br /><br /><strong>Terms and Conditions</strong> <br /><br />Please also visit our Terms and Conditions section establishing the use, disclaimers, and limitations of liability governing the use of our website at <a href="http://www.nat4an.com/portfolio/tos">http://www.nat4an.com/portfolio/tos</a><br /><br /><strong>Your Consent</strong> <br /><br />By using our site, you consent to our <a style=''text-decoration:none; color:#3C3C3C;'' href=''http://www.freeprivacypolicy.com/'' target=''_blank''>websites privacy policy</a>.<br /><br /><strong>Changes to our Privacy Policy</strong> <br /><br />If we decide to change our privacy policy, we will post those changes on this page, send an email notifying you of any changes, and/or update the Privacy Policy modification date below. <br /><br /><strong>Contacting Us</strong> <br /><br />If there are any questions regarding this privacy policy you may contact us using the information below. <br /><br />http://www.nat4an.com/portfolio/contact<br /><br />United States<br />nat4ancorp@gmail.com<br />210-863-8843<br /><br /><span></span><span></span>This policy is powered by Free Privacy Policy and Rhino Support <a style=''color:#000; text-decoration:none;'' href=''http://www.rhinosupport.com'' target=''_blank''>help desk software</a>.<span></span><span></span><span></span>\r\n</div></div>', '', '', '', '', '', '', '', '', 'yes', 'off', 'Published', 0, ''),
(30, 'off', 'page2', 'double', 'PostSystem Example', 'blog,Colleagues of Mine,Back on the Road,Creative Fotos,New Memories,The Library,What am I saying?', 'padmain', 1, '', '2012-07-26', '', '/* YOU MIGHT HAVE TO SEARCH FOR THE PAD NAME (PADMAIN, PAD1 THROUGH 4, AND CHANGE IT BASED ON WHAT PAD */\r\n$pname="blog";\r\n$pname_special="Blog";\r\nif(isset($_GET[''user''])){$pname_uri="blog/user/".$_GET[''user''];}else{$pname_uri="blog";}\r\n$display_user=true;\r\n$PADINFO=$properties->PADMAIN;\r\n$PNAME_PUBLISHED_NAME="Published";\r\n/* ---------- DO NOT EDIT BELOW THIS LINE OR ELSE YOU WILL BREAK IT --------- */\r\ninclude("includes/private/bin/plugins/PostSystem/plugin.php");', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$page'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' AND status=''Published'' AND toggle_visible=''on'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	$toggle_visible=$FETCH_MODULES[''toggle_visible''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		if($toggle_visible == "on"){eval($contents);}else if($toggle_visible == "off"){/* not visible */}\r\n	echo "</div>";\r\n}', '', '', '', '', 'yes', 'on', 'Published', 21, '127.0.0.1'),
(31, 'off', 'report', 'double', 'Report', 'report to Nat4an,report,report to Nat4an Corp,fraud,report fraud,help,', 'padmain', 1, '', '2013-01-17', '', '$TITLE						= "Report to Us";\r\n$PADINFO					= $properties->PADMAIN;\r\n$DBTBLSTART					= "";\r\n$EXTRA_NAME					= ""; //for the email subject\r\n$EXTRA_NAME_SAFE			= ""; //the safe version of $EXTRA_NAME\r\nglobal $FORMNAME;\r\n$FORMNAME					= "report"; //usually the page name\r\n$POC_DB						= "users"; //could be: users, tmm_virtuosos, etc\r\n$POC_DB_WHERE_TYPE_CLAUSE	= "type = ''admin''"; //the where clause of the poc db\r\n$POC_DB_ORDER_BY			= "uname";\r\n$QUERY_TABLENAME			= "queries_"; //the part after the prefix of the tablename\r\n$QUERY_TABLESUBNAME			= "report"; //the part after the _ after the $QUERY_TABLENAME\r\n$TYPE                                   = "contact";\r\n/* ---------- DO NOT EDIT BELOW THIS LINE OR ELSE YOU WILL BREAK IT --------- */\r\ninclude("includes/private/bin/plugins/mts/plugin.php");', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$page'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	$toggle_visible=$FETCH_MODULES[''toggle_visible''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		if($toggle_visible == "on"){eval($contents);}else if($toggle_visible == "off"){/* not visible */}\r\n	echo "</div>";\r\n}', '', '', '', '', 'yes', 'off', 'Published', 1, '127.0.0.1'),
(33, 'off', 'page4', 'double', 'A Page', 'about jelly,jelly stuff,cms,mit,', 'padmain', 1, '', '2013-06-17', '<h2 class="pages-maincontent-title">(THE_PARAGRAPH_TITLE)</h2>\r\n<div class="pages-maincontent-content">\r\n<div class="pages-maincontent-content-inner">\r\n<p>This block of text is a basic template that has been made for your convenience as a placeholder to make your new website look like it has stuff on it. You can write anything you want here. Please keep the structure of this content the way it is now and put your content for this paragraph between the &quot;pages-maincontent-content-inner&quot; if you would like to retain the original CSS structure or you could just completely write your own HTML Only code in here (or just plain text) and change up the styles by either adding them to this textbox or editing the theme CSS by going to Appearence and then Editor. Either way, this is just to help you.</p>\r\n</div>\r\n</div>\r\n\r\n<h2 class="pages-maincontent-title">(THE_PARAGRAPH_TITLE)</h2>\r\n<div class="pages-maincontent-content">\r\n<div class="pages-maincontent-content-inner">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget mauris nisl. Ut id dolor in est sodales euismod nec aliquet enim. Cras in vehicula urna, et eleifend nunc. Vivamus malesuada ultricies elit eget consectetur. Nunc nibh velit, mollis non pulvinar nec, congue sit amet eros. Praesent vehicula nisi sed magna mollis dapibus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean tristique rhoncus ipsum vel commodo. Suspendisse lacinia urna nec enim iaculis rutrum. Proin vel quam orci. Donec non risus mi. Sed non felis sed dui vulputate tempus. Mauris aliquet, magna vitae ultricies tincidunt, arcu nisl vehicula mi, et imperdiet nunc sem quis lorem. Duis vitae cursus ante. Sed a egestas purus, sit amet placerat mi. Pellentesque volutpat consequat viverra.</p>\r\n</div>\r\n</div>', '', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$page'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' AND status=''Published'' AND toggle_visible=''on'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	$toggle_visible=$FETCH_MODULES[''toggle_visible''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		if($toggle_visible == "on"){eval($contents);}else if($toggle_visible == "off"){/* not visible */}\r\n	echo "</div>";\r\n}', '', '', '', '', 'no', 'off', 'Published', 22, '127.0.0.1'),
(34, 'off', 'page1', 'double', 'Blank Page', 'about,who is Nat4an?,Design and Technology Academy,Eureka,Nat4an.com,LOVE to code,pentium computer,level 12 Flunky,What do I think about the Web,how to feed a gold fish,lost the art of communication,Minecraft,CMS', 'pad1', 2, '', '2012-07-26', '<h2 class="pages-maincontent-title">(THE_PARAGRAPH_TITLE)</h2>\r\n<div class="pages-maincontent-content">\r\n<div class="pages-maincontent-content-inner">\r\n<p>This block of text is a basic template that has been made for your convenience as a placeholder to make your new website look like it has stuff on it. You can write anything you want here. Please keep the structure of this content the way it is now and put your content for this paragraph between the &quot;pages-maincontent-content-inner&quot; if you would like to retain the original CSS structure or you could just completely write your own HTML Only code in here (or just plain text) and change up the styles by either adding them to this textbox or editing the theme CSS by going to Appearence and then Editor. Either way, this is just to help you.</p>\r\n</div>\r\n</div>\r\n\r\n<h2 class="pages-maincontent-title">(THE_PARAGRAPH_TITLE)</h2>\r\n<div class="pages-maincontent-content">\r\n<div class="pages-maincontent-content-inner">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget mauris nisl. Ut id dolor in est sodales euismod nec aliquet enim. Cras in vehicula urna, et eleifend nunc. Vivamus malesuada ultricies elit eget consectetur. Nunc nibh velit, mollis non pulvinar nec, congue sit amet eros. Praesent vehicula nisi sed magna mollis dapibus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean tristique rhoncus ipsum vel commodo. Suspendisse lacinia urna nec enim iaculis rutrum. Proin vel quam orci. Donec non risus mi. Sed non felis sed dui vulputate tempus. Mauris aliquet, magna vitae ultricies tincidunt, arcu nisl vehicula mi, et imperdiet nunc sem quis lorem. Duis vitae cursus ante. Sed a egestas purus, sit amet placerat mi. Pellentesque volutpat consequat viverra.</p>\r\n</div>\r\n</div>', '//@$launchpad=$_GET[''launchpad''];\r\n/* This section is for custom PHP code. You can use this to put some server parsing code from creating a dynamic link to creating the entire page in PHP. Have fun! Go nuts!. Make sure to remove this comment unless you want it to stay. :) */', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$page'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' AND status=''Published'' AND toggle_visible=''on'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	$toggle_visible=$FETCH_MODULES[''toggle_visible''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		if($toggle_visible == "on"){eval($contents);}else if($toggle_visible == "off"){/* not visible */}\r\n	echo "</div>";\r\n}', '', '', '', '', 'yes', 'off', 'Published', 30, '127.0.0.1'),
(35, 'off', 'home', 'double', 'Home', 'Nat4an,Nathan,Home,web designer,', 'pad1', 2, '', '2012-09-08', '<br />', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$properties->PADMAIN$page'' AND type=''maincontent'' AND launchpad=''$launchpadPN'' AND toggle_visible=''on'' AND status=''Published'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n        $mini_title=$FETCH_MODULES[''mini_title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<div class=\\"pages-sidebar-title\\">{$title} <div class=\\"pages-sidebar-minititle\\">{$mini_title}</div></div>";}\r\n	echo "<div class=\\"pages-maincontent-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		eval($contents);\r\n	echo "</div>";\r\n}', '', '<br />', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$properties->PADMAIN$page'' AND type=''sidebar'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' AND toggle_visible=''on'' AND status=''Published'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<div class=\\"pages-sidebar-title\\">{$title}</div>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		eval($contents);\r\n	echo "</div>";\r\n}', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$properties->PADMAIN$page'' AND type=''sidebar'' AND sidebar=''2'' AND launchpad=''$launchpadPN'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		eval($contents);\r\n	echo "</div>";\r\n}', '', 'yes', 'on', 'Published', 48, '127.0.0.1'),
(36, 'off', 'page4', 'double', 'A Page', 'about jelly,jelly stuff,cms,mit,', 'pad1', 2, '', '2013-06-17', '<h2 class="pages-maincontent-title">(THE_PARAGRAPH_TITLE)</h2>\r\n<div class="pages-maincontent-content">\r\n<div class="pages-maincontent-content-inner">\r\n<p>This block of text is a basic template that has been made for your convenience as a placeholder to make your new website look like it has stuff on it. You can write anything you want here. Please keep the structure of this content the way it is now and put your content for this paragraph between the &quot;pages-maincontent-content-inner&quot; if you would like to retain the original CSS structure or you could just completely write your own HTML Only code in here (or just plain text) and change up the styles by either adding them to this textbox or editing the theme CSS by going to Appearence and then Editor. Either way, this is just to help you.</p>\r\n</div>\r\n</div>\r\n\r\n<h2 class="pages-maincontent-title">(THE_PARAGRAPH_TITLE)</h2>\r\n<div class="pages-maincontent-content">\r\n<div class="pages-maincontent-content-inner">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget mauris nisl. Ut id dolor in est sodales euismod nec aliquet enim. Cras in vehicula urna, et eleifend nunc. Vivamus malesuada ultricies elit eget consectetur. Nunc nibh velit, mollis non pulvinar nec, congue sit amet eros. Praesent vehicula nisi sed magna mollis dapibus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean tristique rhoncus ipsum vel commodo. Suspendisse lacinia urna nec enim iaculis rutrum. Proin vel quam orci. Donec non risus mi. Sed non felis sed dui vulputate tempus. Mauris aliquet, magna vitae ultricies tincidunt, arcu nisl vehicula mi, et imperdiet nunc sem quis lorem. Duis vitae cursus ante. Sed a egestas purus, sit amet placerat mi. Pellentesque volutpat consequat viverra.</p>\r\n</div>\r\n</div>', '', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$page'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' AND status=''Published'' AND toggle_visible=''on'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	$toggle_visible=$FETCH_MODULES[''toggle_visible''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		if($toggle_visible == "on"){eval($contents);}else if($toggle_visible == "off"){/* not visible */}\r\n	echo "</div>";\r\n}', '', '', '', '', 'no', 'off', 'Published', 21, '127.0.0.1'),
(37, 'off', 'page3', 'double', 'MTS Example', 'contact Nat4an,contact Nathan Smyth,contacting Nat4an Corp', 'pad1', 2, '', '2012-08-12', '', '$TITLE						= "(NAME FOR CONTACT)";\r\n$PADINFO					= $properties->PADMAIN;\r\n$DBTBLSTART					= "";\r\n$EXTRA_NAME					= ""; //for the email subject\r\n$EXTRA_NAME_SAFE			= ""; //the safe version of $EXTRA_NAME\r\nglobal $FORMNAME;\r\n$FORMNAME					= "contact"; //usually the page name\r\n$POC_DB						= "users"; //could be: users, tmm_virtuosos, etc\r\n$POC_DB_WHERE_TYPE_CLAUSE	= "type = ''admin''"; //the where clause of the poc db\r\n$POC_DB_ORDER_BY			= "uname";\r\n$QUERY_TABLENAME			= "queries_"; //the part after the prefix of the tablename\r\n$QUERY_TABLESUBNAME			= "contact"; //the part after the _ after the $QUERY_TABLENAME\r\n$TYPE                                   = "contact";\r\n/* ---------- DO NOT EDIT BELOW THIS LINE OR ELSE YOU WILL BREAK IT --------- */\r\ninclude("includes/private/bin/plugins/mts/plugin.php");', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$page'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' AND status=''Published'' AND toggle_visible=''on'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	$toggle_visible=$FETCH_MODULES[''toggle_visible''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		if($toggle_visible == "on"){eval($contents);}else if($toggle_visible == "off"){/* not visible */}\r\n	echo "</div>";\r\n}', '', '', '', '', 'yes', 'off', 'Published', 21, '127.0.0.1'),
(38, 'off', 'page2', 'double', 'PostSystem Example', 'blog,Colleagues of Mine,Back on the Road,Creative Fotos,New Memories,The Library,What am I saying?', 'pad1', 2, '', '2012-07-26', '', '/* YOU MIGHT HAVE TO SEARCH FOR THE PAD NAME (PADMAIN, PAD1 THROUGH 4, AND CHANGE IT BASED ON WHAT PAD */\r\n$pname="blog";\r\n$pname_special="Blog";\r\nif(isset($_GET[''user''])){$pname_uri="blog/user/".$_GET[''user''];}else{$pname_uri="blog";}\r\n$display_user=true;\r\n$PADINFO=$properties->PADMAIN;\r\n$PNAME_PUBLISHED_NAME="Published";\r\n/* ---------- DO NOT EDIT BELOW THIS LINE OR ELSE YOU WILL BREAK IT --------- */\r\ninclude("includes/private/bin/plugins/PostSystem/plugin.php");', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$page'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' AND status=''Published'' AND toggle_visible=''on'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	$toggle_visible=$FETCH_MODULES[''toggle_visible''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		if($toggle_visible == "on"){eval($contents);}else if($toggle_visible == "off"){/* not visible */}\r\n	echo "</div>";\r\n}', '', '', '', '', 'yes', 'on', 'Published', 20, '127.0.0.1'),
(39, 'off', 'home', 'double', 'Home', 'Nat4an,Nathan,Home,web designer,', 'pad2', 3, '', '2012-09-08', '<br />', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$properties->PADMAIN$page'' AND type=''maincontent'' AND launchpad=''$launchpadPN'' AND toggle_visible=''on'' AND status=''Published'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n        $mini_title=$FETCH_MODULES[''mini_title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<div class=\\"pages-sidebar-title\\">{$title} <div class=\\"pages-sidebar-minititle\\">{$mini_title}</div></div>";}\r\n	echo "<div class=\\"pages-maincontent-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		eval($contents);\r\n	echo "</div>";\r\n}', '', '<br />', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$properties->PADMAIN$page'' AND type=''sidebar'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' AND toggle_visible=''on'' AND status=''Published'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<div class=\\"pages-sidebar-title\\">{$title}</div>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		eval($contents);\r\n	echo "</div>";\r\n}', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$properties->PADMAIN$page'' AND type=''sidebar'' AND sidebar=''2'' AND launchpad=''$launchpadPN'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		eval($contents);\r\n	echo "</div>";\r\n}', '', 'yes', 'on', 'Published', 40, '127.0.0.1'),
(40, 'off', 'page4', 'double', 'A Page', 'about jelly,jelly stuff,cms,mit,', 'pad2', 3, '', '2013-06-17', '<h2 class="pages-maincontent-title">(THE_PARAGRAPH_TITLE)</h2>\r\n<div class="pages-maincontent-content">\r\n<div class="pages-maincontent-content-inner">\r\n<p>This block of text is a basic template that has been made for your convenience as a placeholder to make your new website look like it has stuff on it. You can write anything you want here. Please keep the structure of this content the way it is now and put your content for this paragraph between the &quot;pages-maincontent-content-inner&quot; if you would like to retain the original CSS structure or you could just completely write your own HTML Only code in here (or just plain text) and change up the styles by either adding them to this textbox or editing the theme CSS by going to Appearence and then Editor. Either way, this is just to help you.</p>\r\n</div>\r\n</div>\r\n\r\n<h2 class="pages-maincontent-title">(THE_PARAGRAPH_TITLE)</h2>\r\n<div class="pages-maincontent-content">\r\n<div class="pages-maincontent-content-inner">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget mauris nisl. Ut id dolor in est sodales euismod nec aliquet enim. Cras in vehicula urna, et eleifend nunc. Vivamus malesuada ultricies elit eget consectetur. Nunc nibh velit, mollis non pulvinar nec, congue sit amet eros. Praesent vehicula nisi sed magna mollis dapibus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean tristique rhoncus ipsum vel commodo. Suspendisse lacinia urna nec enim iaculis rutrum. Proin vel quam orci. Donec non risus mi. Sed non felis sed dui vulputate tempus. Mauris aliquet, magna vitae ultricies tincidunt, arcu nisl vehicula mi, et imperdiet nunc sem quis lorem. Duis vitae cursus ante. Sed a egestas purus, sit amet placerat mi. Pellentesque volutpat consequat viverra.</p>\r\n</div>\r\n</div>', '', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$page'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' AND status=''Published'' AND toggle_visible=''on'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	$toggle_visible=$FETCH_MODULES[''toggle_visible''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		if($toggle_visible == "on"){eval($contents);}else if($toggle_visible == "off"){/* not visible */}\r\n	echo "</div>";\r\n}', '', '', '', '', 'no', 'off', 'Published', 21, '127.0.0.1'),
(41, 'off', 'page1', 'double', 'Blank Page', 'about,who is Nat4an?,Design and Technology Academy,Eureka,Nat4an.com,LOVE to code,pentium computer,level 12 Flunky,What do I think about the Web,how to feed a gold fish,lost the art of communication,Minecraft,CMS', 'pad2', 3, '', '2012-07-26', '<h2 class="pages-maincontent-title">(THE_PARAGRAPH_TITLE)</h2>\r\n<div class="pages-maincontent-content">\r\n<div class="pages-maincontent-content-inner">\r\n<p>This block of text is a basic template that has been made for your convenience as a placeholder to make your new website look like it has stuff on it. You can write anything you want here. Please keep the structure of this content the way it is now and put your content for this paragraph between the &quot;pages-maincontent-content-inner&quot; if you would like to retain the original CSS structure or you could just completely write your own HTML Only code in here (or just plain text) and change up the styles by either adding them to this textbox or editing the theme CSS by going to Appearence and then Editor. Either way, this is just to help you.</p>\r\n</div>\r\n</div>\r\n\r\n<h2 class="pages-maincontent-title">(THE_PARAGRAPH_TITLE)</h2>\r\n<div class="pages-maincontent-content">\r\n<div class="pages-maincontent-content-inner">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget mauris nisl. Ut id dolor in est sodales euismod nec aliquet enim. Cras in vehicula urna, et eleifend nunc. Vivamus malesuada ultricies elit eget consectetur. Nunc nibh velit, mollis non pulvinar nec, congue sit amet eros. Praesent vehicula nisi sed magna mollis dapibus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean tristique rhoncus ipsum vel commodo. Suspendisse lacinia urna nec enim iaculis rutrum. Proin vel quam orci. Donec non risus mi. Sed non felis sed dui vulputate tempus. Mauris aliquet, magna vitae ultricies tincidunt, arcu nisl vehicula mi, et imperdiet nunc sem quis lorem. Duis vitae cursus ante. Sed a egestas purus, sit amet placerat mi. Pellentesque volutpat consequat viverra.</p>\r\n</div>\r\n</div>', '//@$launchpad=$_GET[''launchpad''];\r\n/* This section is for custom PHP code. You can use this to put some server parsing code from creating a dynamic link to creating the entire page in PHP. Have fun! Go nuts!. Make sure to remove this comment unless you want it to stay. :) */', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$page'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' AND status=''Published'' AND toggle_visible=''on'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	$toggle_visible=$FETCH_MODULES[''toggle_visible''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		if($toggle_visible == "on"){eval($contents);}else if($toggle_visible == "off"){/* not visible */}\r\n	echo "</div>";\r\n}', '', '', '', '', 'yes', 'off', 'Published', 30, '127.0.0.1'),
(42, 'off', 'page3', 'double', 'MTS Example', 'contact Nat4an,contact Nathan Smyth,contacting Nat4an Corp', 'pad2', 3, '', '2012-08-12', '', '$TITLE						= "(NAME FOR CONTACT)";\r\n$PADINFO					= $properties->PADMAIN;\r\n$DBTBLSTART					= "";\r\n$EXTRA_NAME					= ""; //for the email subject\r\n$EXTRA_NAME_SAFE			= ""; //the safe version of $EXTRA_NAME\r\nglobal $FORMNAME;\r\n$FORMNAME					= "contact"; //usually the page name\r\n$POC_DB						= "users"; //could be: users, tmm_virtuosos, etc\r\n$POC_DB_WHERE_TYPE_CLAUSE	= "type = ''admin''"; //the where clause of the poc db\r\n$POC_DB_ORDER_BY			= "uname";\r\n$QUERY_TABLENAME			= "queries_"; //the part after the prefix of the tablename\r\n$QUERY_TABLESUBNAME			= "contact"; //the part after the _ after the $QUERY_TABLENAME\r\n$TYPE                                   = "contact";\r\n/* ---------- DO NOT EDIT BELOW THIS LINE OR ELSE YOU WILL BREAK IT --------- */\r\ninclude("includes/private/bin/plugins/mts/plugin.php");', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$page'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' AND status=''Published'' AND toggle_visible=''on'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	$toggle_visible=$FETCH_MODULES[''toggle_visible''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		if($toggle_visible == "on"){eval($contents);}else if($toggle_visible == "off"){/* not visible */}\r\n	echo "</div>";\r\n}', '', '', '', '', 'yes', 'off', 'Published', 22, '127.0.0.1'),
(43, 'off', 'page2', 'double', 'PostSystem Example', 'blog,Colleagues of Mine,Back on the Road,Creative Fotos,New Memories,The Library,What am I saying?', 'pad2', 3, '', '2012-07-26', '', '/* YOU MIGHT HAVE TO SEARCH FOR THE PAD NAME (PADMAIN, PAD1 THROUGH 4, AND CHANGE IT BASED ON WHAT PAD */\r\n$pname="blog";\r\n$pname_special="Blog";\r\nif(isset($_GET[''user''])){$pname_uri="blog/user/".$_GET[''user''];}else{$pname_uri="blog";}\r\n$display_user=true;\r\n$PADINFO=$properties->PADMAIN;\r\n$PNAME_PUBLISHED_NAME="Published";\r\n/* ---------- DO NOT EDIT BELOW THIS LINE OR ELSE YOU WILL BREAK IT --------- */\r\ninclude("includes/private/bin/plugins/PostSystem/plugin.php");', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$page'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' AND status=''Published'' AND toggle_visible=''on'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	$toggle_visible=$FETCH_MODULES[''toggle_visible''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		if($toggle_visible == "on"){eval($contents);}else if($toggle_visible == "off"){/* not visible */}\r\n	echo "</div>";\r\n}', '', '', '', '', 'yes', 'on', 'Published', 19, '127.0.0.1');
INSERT INTO `h_pages` (`id`, `page_lock`, `page`, `layout`, `pageNAME`, `pageKEYWORDS`, `lp`, `lpm`, `subpage`, `created`, `content_main`, `content_main_code`, `content_main_after_code`, `content_sidebar`, `content_sidebar_code`, `content_sidebar_after_code`, `content_sidebar2`, `content_sidebar_code2`, `content_sidebar_after_code2`, `is_searchable`, `toggle_feat`, `status`, `visits`, `last_known_ip`) VALUES
(44, 'off', 'search', 'double', 'Search', 'nat4an current projects,projects by Nat4an,projects,work', 'pad1', 2, '', '2012-09-10', '', '/* SEARCH FUNCTION FOR NAT4AN.COM */\r\n/* EVERYTHING YOU NEED TO SEARCH MY SITE IS RIGHT HERE IN THE CODE AND IN THE PROPS.PHP PAGE */\r\n/* COPYRIGHT Â© 2012 NAT4AN CORP. NOT TO BE COPIED */\r\n/* ORIGINAL CODING WORK: NATHAN SMYTH */\r\n/* --------------------------------------------------------- BEGIN ---------------------------------------------------------*/\r\nerror_reporting(0);\r\n//get variables and other materials\r\nmb_language(''uni'');\r\nmb_internal_encoding(''UTF-8'');\r\n@$searchQuery=$_POST[''search''];\r\n@$SEARCH_TEXT=$properties->SEARCH_TEXT;\r\nif($searchQuery == $SEARCH_TEXT){$SEARCH_TEXT="&quot;".$SEARCH_TEXT."&quot;";}else if(strlen(trim(preg_replace(''/\\xc2\\xa0/'','' '',$searchQuery))) == 0){$SEARCH_TEXT="nothing";}\r\n\r\n//build search\r\nif(($searchQuery == "") || ($searchQuery == " ") || (strlen(trim(preg_replace(''/\\xc2\\xa0/'','' '',$searchQuery))) == 0)){\r\n	echo "<h2 class=\\"pages-maincontent-title\\">Uh oh! It looks like a diglett just appeared here</h2>";\r\n	echo "<h2>You must type in something to search for it. You cannot just search for {$SEARCH_TEXT}.</h2>";\r\n} else {\r\n	echo "<h2 class=\\"pages-maincontent-title\\">Searching Nat4an.com for &quot;".$searchQuery."&quot;</h2>";\r\n	SEARCH($properties,$searchQuery);\r\n}', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$page'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	$toggle_visible=$FETCH_MODULES[''toggle_visible''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		if($toggle_visible == "on"){eval($contents);}else if($toggle_visible == "off"){/* not visible */}\r\n	echo "</div>";\r\n}', '', '', '', '', 'no', 'off', 'Published', 6, '127.0.0.1'),
(45, 'off', 'search', 'double', 'Search', 'nat4an current projects,projects by Nat4an,projects,work', 'pad2', 3, '', '2012-09-10', '', '/* SEARCH FUNCTION FOR NAT4AN.COM */\r\n/* EVERYTHING YOU NEED TO SEARCH MY SITE IS RIGHT HERE IN THE CODE AND IN THE PROPS.PHP PAGE */\r\n/* COPYRIGHT Â© 2012 NAT4AN CORP. NOT TO BE COPIED */\r\n/* ORIGINAL CODING WORK: NATHAN SMYTH */\r\n/* --------------------------------------------------------- BEGIN ---------------------------------------------------------*/\r\nerror_reporting(0);\r\n//get variables and other materials\r\nmb_language(''uni'');\r\nmb_internal_encoding(''UTF-8'');\r\n@$searchQuery=$_POST[''search''];\r\n@$SEARCH_TEXT=$properties->SEARCH_TEXT;\r\nif($searchQuery == $SEARCH_TEXT){$SEARCH_TEXT="&quot;".$SEARCH_TEXT."&quot;";}else if(strlen(trim(preg_replace(''/\\xc2\\xa0/'','' '',$searchQuery))) == 0){$SEARCH_TEXT="nothing";}\r\n\r\n//build search\r\nif(($searchQuery == "") || ($searchQuery == " ") || (strlen(trim(preg_replace(''/\\xc2\\xa0/'','' '',$searchQuery))) == 0)){\r\n	echo "<h2 class=\\"pages-maincontent-title\\">Uh oh! It looks like a diglett just appeared here</h2>";\r\n	echo "<h2>You must type in something to search for it. You cannot just search for {$SEARCH_TEXT}.</h2>";\r\n} else {\r\n	echo "<h2 class=\\"pages-maincontent-title\\">Searching Nat4an.com for &quot;".$searchQuery."&quot;</h2>";\r\n	SEARCH($properties,$searchQuery);\r\n}', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$page'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	$toggle_visible=$FETCH_MODULES[''toggle_visible''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		if($toggle_visible == "on"){eval($contents);}else if($toggle_visible == "off"){/* not visible */}\r\n	echo "</div>";\r\n}', '', '', '', '', 'no', 'off', 'Published', 5, '127.0.0.1'),
(46, 'off', 'home', 'double', 'Home', 'Nat4an,Nathan,Home,web designer,', 'pad3', 4, '', '2012-09-08', '<br />', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$properties->PADMAIN$page'' AND type=''maincontent'' AND launchpad=''$launchpadPN'' AND toggle_visible=''on'' AND status=''Published'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n        $mini_title=$FETCH_MODULES[''mini_title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<div class=\\"pages-sidebar-title\\">{$title} <div class=\\"pages-sidebar-minititle\\">{$mini_title}</div></div>";}\r\n	echo "<div class=\\"pages-maincontent-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		eval($contents);\r\n	echo "</div>";\r\n}', '', '<br />', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$properties->PADMAIN$page'' AND type=''sidebar'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' AND toggle_visible=''on'' AND status=''Published'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<div class=\\"pages-sidebar-title\\">{$title}</div>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		eval($contents);\r\n	echo "</div>";\r\n}', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$properties->PADMAIN$page'' AND type=''sidebar'' AND sidebar=''2'' AND launchpad=''$launchpadPN'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		eval($contents);\r\n	echo "</div>";\r\n}', '', 'yes', 'on', 'Published', 40, '127.0.0.1'),
(47, 'off', 'search', 'double', 'Search', 'nat4an current projects,projects by Nat4an,projects,work', 'pad3', 4, '', '2012-09-10', '', '/* SEARCH FUNCTION FOR NAT4AN.COM */\r\n/* EVERYTHING YOU NEED TO SEARCH MY SITE IS RIGHT HERE IN THE CODE AND IN THE PROPS.PHP PAGE */\r\n/* COPYRIGHT Â© 2012 NAT4AN CORP. NOT TO BE COPIED */\r\n/* ORIGINAL CODING WORK: NATHAN SMYTH */\r\n/* --------------------------------------------------------- BEGIN ---------------------------------------------------------*/\r\nerror_reporting(0);\r\n//get variables and other materials\r\nmb_language(''uni'');\r\nmb_internal_encoding(''UTF-8'');\r\n@$searchQuery=$_POST[''search''];\r\n@$SEARCH_TEXT=$properties->SEARCH_TEXT;\r\nif($searchQuery == $SEARCH_TEXT){$SEARCH_TEXT="&quot;".$SEARCH_TEXT."&quot;";}else if(strlen(trim(preg_replace(''/\\xc2\\xa0/'','' '',$searchQuery))) == 0){$SEARCH_TEXT="nothing";}\r\n\r\n//build search\r\nif(($searchQuery == "") || ($searchQuery == " ") || (strlen(trim(preg_replace(''/\\xc2\\xa0/'','' '',$searchQuery))) == 0)){\r\n	echo "<h2 class=\\"pages-maincontent-title\\">Uh oh! It looks like a diglett just appeared here</h2>";\r\n	echo "<h2>You must type in something to search for it. You cannot just search for {$SEARCH_TEXT}.</h2>";\r\n} else {\r\n	echo "<h2 class=\\"pages-maincontent-title\\">Searching Nat4an.com for &quot;".$searchQuery."&quot;</h2>";\r\n	SEARCH($properties,$searchQuery);\r\n}', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$page'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	$toggle_visible=$FETCH_MODULES[''toggle_visible''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		if($toggle_visible == "on"){eval($contents);}else if($toggle_visible == "off"){/* not visible */}\r\n	echo "</div>";\r\n}', '', '', '', '', 'no', 'off', 'Published', 5, '127.0.0.1'),
(48, 'off', 'page1', 'double', 'Blank Page', 'about,who is Nat4an?,Design and Technology Academy,Eureka,Nat4an.com,LOVE to code,pentium computer,level 12 Flunky,What do I think about the Web,how to feed a gold fish,lost the art of communication,Minecraft,CMS', 'pad3', 4, '', '2012-07-26', '<h2 class="pages-maincontent-title">(THE_PARAGRAPH_TITLE)</h2>\r\n<div class="pages-maincontent-content">\r\n<div class="pages-maincontent-content-inner">\r\n<p>This block of text is a basic template that has been made for your convenience as a placeholder to make your new website look like it has stuff on it. You can write anything you want here. Please keep the structure of this content the way it is now and put your content for this paragraph between the &quot;pages-maincontent-content-inner&quot; if you would like to retain the original CSS structure or you could just completely write your own HTML Only code in here (or just plain text) and change up the styles by either adding them to this textbox or editing the theme CSS by going to Appearence and then Editor. Either way, this is just to help you.</p>\r\n</div>\r\n</div>\r\n\r\n<h2 class="pages-maincontent-title">(THE_PARAGRAPH_TITLE)</h2>\r\n<div class="pages-maincontent-content">\r\n<div class="pages-maincontent-content-inner">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget mauris nisl. Ut id dolor in est sodales euismod nec aliquet enim. Cras in vehicula urna, et eleifend nunc. Vivamus malesuada ultricies elit eget consectetur. Nunc nibh velit, mollis non pulvinar nec, congue sit amet eros. Praesent vehicula nisi sed magna mollis dapibus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean tristique rhoncus ipsum vel commodo. Suspendisse lacinia urna nec enim iaculis rutrum. Proin vel quam orci. Donec non risus mi. Sed non felis sed dui vulputate tempus. Mauris aliquet, magna vitae ultricies tincidunt, arcu nisl vehicula mi, et imperdiet nunc sem quis lorem. Duis vitae cursus ante. Sed a egestas purus, sit amet placerat mi. Pellentesque volutpat consequat viverra.</p>\r\n</div>\r\n</div>', '//@$launchpad=$_GET[''launchpad''];\r\n/* This section is for custom PHP code. You can use this to put some server parsing code from creating a dynamic link to creating the entire page in PHP. Have fun! Go nuts!. Make sure to remove this comment unless you want it to stay. :) */', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$page'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' AND status=''Published'' AND toggle_visible=''on'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	$toggle_visible=$FETCH_MODULES[''toggle_visible''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		if($toggle_visible == "on"){eval($contents);}else if($toggle_visible == "off"){/* not visible */}\r\n	echo "</div>";\r\n}', '', '', '', '', 'yes', 'off', 'Published', 29, '127.0.0.1'),
(49, 'off', 'page4', 'double', 'A Page', 'about jelly,jelly stuff,cms,mit,', 'pad3', 4, '', '2013-06-17', '<h2 class="pages-maincontent-title">(THE_PARAGRAPH_TITLE)</h2>\r\n<div class="pages-maincontent-content">\r\n<div class="pages-maincontent-content-inner">\r\n<p>This block of text is a basic template that has been made for your convenience as a placeholder to make your new website look like it has stuff on it. You can write anything you want here. Please keep the structure of this content the way it is now and put your content for this paragraph between the &quot;pages-maincontent-content-inner&quot; if you would like to retain the original CSS structure or you could just completely write your own HTML Only code in here (or just plain text) and change up the styles by either adding them to this textbox or editing the theme CSS by going to Appearence and then Editor. Either way, this is just to help you.</p>\r\n</div>\r\n</div>\r\n\r\n<h2 class="pages-maincontent-title">(THE_PARAGRAPH_TITLE)</h2>\r\n<div class="pages-maincontent-content">\r\n<div class="pages-maincontent-content-inner">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget mauris nisl. Ut id dolor in est sodales euismod nec aliquet enim. Cras in vehicula urna, et eleifend nunc. Vivamus malesuada ultricies elit eget consectetur. Nunc nibh velit, mollis non pulvinar nec, congue sit amet eros. Praesent vehicula nisi sed magna mollis dapibus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean tristique rhoncus ipsum vel commodo. Suspendisse lacinia urna nec enim iaculis rutrum. Proin vel quam orci. Donec non risus mi. Sed non felis sed dui vulputate tempus. Mauris aliquet, magna vitae ultricies tincidunt, arcu nisl vehicula mi, et imperdiet nunc sem quis lorem. Duis vitae cursus ante. Sed a egestas purus, sit amet placerat mi. Pellentesque volutpat consequat viverra.</p>\r\n</div>\r\n</div>', '', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$page'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' AND status=''Published'' AND toggle_visible=''on'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	$toggle_visible=$FETCH_MODULES[''toggle_visible''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		if($toggle_visible == "on"){eval($contents);}else if($toggle_visible == "off"){/* not visible */}\r\n	echo "</div>";\r\n}', '', '', '', '', 'no', 'off', 'Published', 20, '127.0.0.1'),
(50, 'off', 'page3', 'double', 'MTS Example', 'contact Nat4an,contact Nathan Smyth,contacting Nat4an Corp', 'pad3', 4, '', '2012-08-12', '', '$TITLE						= "(NAME FOR CONTACT)";\r\n$PADINFO					= $properties->PADMAIN;\r\n$DBTBLSTART					= "";\r\n$EXTRA_NAME					= ""; //for the email subject\r\n$EXTRA_NAME_SAFE			= ""; //the safe version of $EXTRA_NAME\r\nglobal $FORMNAME;\r\n$FORMNAME					= "contact"; //usually the page name\r\n$POC_DB						= "users"; //could be: users, tmm_virtuosos, etc\r\n$POC_DB_WHERE_TYPE_CLAUSE	= "type = ''admin''"; //the where clause of the poc db\r\n$POC_DB_ORDER_BY			= "uname";\r\n$QUERY_TABLENAME			= "queries_"; //the part after the prefix of the tablename\r\n$QUERY_TABLESUBNAME			= "contact"; //the part after the _ after the $QUERY_TABLENAME\r\n$TYPE                                   = "contact";\r\n/* ---------- DO NOT EDIT BELOW THIS LINE OR ELSE YOU WILL BREAK IT --------- */\r\ninclude("includes/private/bin/plugins/mts/plugin.php");', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$page'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' AND status=''Published'' AND toggle_visible=''on'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	$toggle_visible=$FETCH_MODULES[''toggle_visible''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		if($toggle_visible == "on"){eval($contents);}else if($toggle_visible == "off"){/* not visible */}\r\n	echo "</div>";\r\n}', '', '', '', '', 'yes', 'off', 'Published', 21, '127.0.0.1'),
(51, 'off', 'page2', 'double', 'PostSystem Example', 'blog,Colleagues of Mine,Back on the Road,Creative Fotos,New Memories,The Library,What am I saying?', 'pad3', 4, '', '2012-07-26', '', '/* YOU MIGHT HAVE TO SEARCH FOR THE PAD NAME (PADMAIN, PAD1 THROUGH 4, AND CHANGE IT BASED ON WHAT PAD */\r\n$pname="blog";\r\n$pname_special="Blog";\r\nif(isset($_GET[''user''])){$pname_uri="blog/user/".$_GET[''user''];}else{$pname_uri="blog";}\r\n$display_user=true;\r\n$PADINFO=$properties->PADMAIN;\r\n$PNAME_PUBLISHED_NAME="Published";\r\n/* ---------- DO NOT EDIT BELOW THIS LINE OR ELSE YOU WILL BREAK IT --------- */\r\ninclude("includes/private/bin/plugins/PostSystem/plugin.php");', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$page'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' AND status=''Published'' AND toggle_visible=''on'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	$toggle_visible=$FETCH_MODULES[''toggle_visible''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		if($toggle_visible == "on"){eval($contents);}else if($toggle_visible == "off"){/* not visible */}\r\n	echo "</div>";\r\n}', '', '', '', '', 'yes', 'on', 'Published', 20, '127.0.0.1'),
(52, 'off', 'home', 'double', 'Home', 'Nat4an,Nathan,Home,web designer,', 'pad4', 5, '', '2012-09-08', '<br />', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$properties->PADMAIN$page'' AND type=''maincontent'' AND launchpad=''$launchpadPN'' AND toggle_visible=''on'' AND status=''Published'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n        $mini_title=$FETCH_MODULES[''mini_title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<div class=\\"pages-sidebar-title\\">{$title} <div class=\\"pages-sidebar-minititle\\">{$mini_title}</div></div>";}\r\n	echo "<div class=\\"pages-maincontent-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		eval($contents);\r\n	echo "</div>";\r\n}', '', '<br />', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$properties->PADMAIN$page'' AND type=''sidebar'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' AND toggle_visible=''on'' AND status=''Published'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<div class=\\"pages-sidebar-title\\">{$title}</div>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		eval($contents);\r\n	echo "</div>";\r\n}', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$properties->PADMAIN$page'' AND type=''sidebar'' AND sidebar=''2'' AND launchpad=''$launchpadPN'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		eval($contents);\r\n	echo "</div>";\r\n}', '', 'yes', 'on', 'Published', 39, '127.0.0.1'),
(53, 'off', 'search', 'double', 'Search', 'nat4an current projects,projects by Nat4an,projects,work', 'pad4', 5, '', '2012-09-10', '', '/* SEARCH FUNCTION FOR NAT4AN.COM */\r\n/* EVERYTHING YOU NEED TO SEARCH MY SITE IS RIGHT HERE IN THE CODE AND IN THE PROPS.PHP PAGE */\r\n/* COPYRIGHT Â© 2012 NAT4AN CORP. NOT TO BE COPIED */\r\n/* ORIGINAL CODING WORK: NATHAN SMYTH */\r\n/* --------------------------------------------------------- BEGIN ---------------------------------------------------------*/\r\nerror_reporting(0);\r\n//get variables and other materials\r\nmb_language(''uni'');\r\nmb_internal_encoding(''UTF-8'');\r\n@$searchQuery=$_POST[''search''];\r\n@$SEARCH_TEXT=$properties->SEARCH_TEXT;\r\nif($searchQuery == $SEARCH_TEXT){$SEARCH_TEXT="&quot;".$SEARCH_TEXT."&quot;";}else if(strlen(trim(preg_replace(''/\\xc2\\xa0/'','' '',$searchQuery))) == 0){$SEARCH_TEXT="nothing";}\r\n\r\n//build search\r\nif(($searchQuery == "") || ($searchQuery == " ") || (strlen(trim(preg_replace(''/\\xc2\\xa0/'','' '',$searchQuery))) == 0)){\r\n	echo "<h2 class=\\"pages-maincontent-title\\">Uh oh! It looks like a diglett just appeared here</h2>";\r\n	echo "<h2>You must type in something to search for it. You cannot just search for {$SEARCH_TEXT}.</h2>";\r\n} else {\r\n	echo "<h2 class=\\"pages-maincontent-title\\">Searching Nat4an.com for &quot;".$searchQuery."&quot;</h2>";\r\n	SEARCH($properties,$searchQuery);\r\n}', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$page'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	$toggle_visible=$FETCH_MODULES[''toggle_visible''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		if($toggle_visible == "on"){eval($contents);}else if($toggle_visible == "off"){/* not visible */}\r\n	echo "</div>";\r\n}', '', '', '', '', 'no', 'off', 'Published', 5, '127.0.0.1'),
(54, 'off', 'page4', 'double', 'A Page', 'about jelly,jelly stuff,cms,mit,', 'pad4', 5, '', '2013-06-17', '<h2 class="pages-maincontent-title">(THE_PARAGRAPH_TITLE)</h2>\r\n<div class="pages-maincontent-content">\r\n<div class="pages-maincontent-content-inner">\r\n<p>This block of text is a basic template that has been made for your convenience as a placeholder to make your new website look like it has stuff on it. You can write anything you want here. Please keep the structure of this content the way it is now and put your content for this paragraph between the &quot;pages-maincontent-content-inner&quot; if you would like to retain the original CSS structure or you could just completely write your own HTML Only code in here (or just plain text) and change up the styles by either adding them to this textbox or editing the theme CSS by going to Appearence and then Editor. Either way, this is just to help you.</p>\r\n</div>\r\n</div>\r\n\r\n<h2 class="pages-maincontent-title">(THE_PARAGRAPH_TITLE)</h2>\r\n<div class="pages-maincontent-content">\r\n<div class="pages-maincontent-content-inner">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget mauris nisl. Ut id dolor in est sodales euismod nec aliquet enim. Cras in vehicula urna, et eleifend nunc. Vivamus malesuada ultricies elit eget consectetur. Nunc nibh velit, mollis non pulvinar nec, congue sit amet eros. Praesent vehicula nisi sed magna mollis dapibus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean tristique rhoncus ipsum vel commodo. Suspendisse lacinia urna nec enim iaculis rutrum. Proin vel quam orci. Donec non risus mi. Sed non felis sed dui vulputate tempus. Mauris aliquet, magna vitae ultricies tincidunt, arcu nisl vehicula mi, et imperdiet nunc sem quis lorem. Duis vitae cursus ante. Sed a egestas purus, sit amet placerat mi. Pellentesque volutpat consequat viverra.</p>\r\n</div>\r\n</div>', '', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$page'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' AND status=''Published'' AND toggle_visible=''on'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	$toggle_visible=$FETCH_MODULES[''toggle_visible''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		if($toggle_visible == "on"){eval($contents);}else if($toggle_visible == "off"){/* not visible */}\r\n	echo "</div>";\r\n}', '', '', '', '', 'no', 'off', 'Published', 21, '127.0.0.1'),
(55, 'off', 'page1', 'double', 'Blank Page', 'about,who is Nat4an?,Design and Technology Academy,Eureka,Nat4an.com,LOVE to code,pentium computer,level 12 Flunky,What do I think about the Web,how to feed a gold fish,lost the art of communication,Minecraft,CMS', 'pad4', 5, '', '2012-07-26', '<h2 class="pages-maincontent-title">(THE_PARAGRAPH_TITLE)</h2>\r\n<div class="pages-maincontent-content">\r\n<div class="pages-maincontent-content-inner">\r\n<p>This block of text is a basic template that has been made for your convenience as a placeholder to make your new website look like it has stuff on it. You can write anything you want here. Please keep the structure of this content the way it is now and put your content for this paragraph between the &quot;pages-maincontent-content-inner&quot; if you would like to retain the original CSS structure or you could just completely write your own HTML Only code in here (or just plain text) and change up the styles by either adding them to this textbox or editing the theme CSS by going to Appearence and then Editor. Either way, this is just to help you.</p>\r\n</div>\r\n</div>\r\n\r\n<h2 class="pages-maincontent-title">(THE_PARAGRAPH_TITLE)</h2>\r\n<div class="pages-maincontent-content">\r\n<div class="pages-maincontent-content-inner">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget mauris nisl. Ut id dolor in est sodales euismod nec aliquet enim. Cras in vehicula urna, et eleifend nunc. Vivamus malesuada ultricies elit eget consectetur. Nunc nibh velit, mollis non pulvinar nec, congue sit amet eros. Praesent vehicula nisi sed magna mollis dapibus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean tristique rhoncus ipsum vel commodo. Suspendisse lacinia urna nec enim iaculis rutrum. Proin vel quam orci. Donec non risus mi. Sed non felis sed dui vulputate tempus. Mauris aliquet, magna vitae ultricies tincidunt, arcu nisl vehicula mi, et imperdiet nunc sem quis lorem. Duis vitae cursus ante. Sed a egestas purus, sit amet placerat mi. Pellentesque volutpat consequat viverra.</p>\r\n</div>\r\n</div>', '//@$launchpad=$_GET[''launchpad''];\r\n/* This section is for custom PHP code. You can use this to put some server parsing code from creating a dynamic link to creating the entire page in PHP. Have fun! Go nuts!. Make sure to remove this comment unless you want it to stay. :) */', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$page'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' AND status=''Published'' AND toggle_visible=''on'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	$toggle_visible=$FETCH_MODULES[''toggle_visible''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		if($toggle_visible == "on"){eval($contents);}else if($toggle_visible == "off"){/* not visible */}\r\n	echo "</div>";\r\n}', '', '', '', '', 'yes', 'off', 'Published', 31, '127.0.0.1'),
(56, 'off', 'page3', 'double', 'MTS Example', 'contact Nat4an,contact Nathan Smyth,contacting Nat4an Corp', 'pad4', 5, '', '2012-08-12', '', '$TITLE						= "(NAME FOR CONTACT)";\r\n$PADINFO					= $properties->PADMAIN;\r\n$DBTBLSTART					= "";\r\n$EXTRA_NAME					= ""; //for the email subject\r\n$EXTRA_NAME_SAFE			= ""; //the safe version of $EXTRA_NAME\r\nglobal $FORMNAME;\r\n$FORMNAME					= "contact"; //usually the page name\r\n$POC_DB						= "users"; //could be: users, tmm_virtuosos, etc\r\n$POC_DB_WHERE_TYPE_CLAUSE	= "type = ''admin''"; //the where clause of the poc db\r\n$POC_DB_ORDER_BY			= "uname";\r\n$QUERY_TABLENAME			= "queries_"; //the part after the prefix of the tablename\r\n$QUERY_TABLESUBNAME			= "contact"; //the part after the _ after the $QUERY_TABLENAME\r\n$TYPE                                   = "contact";\r\n/* ---------- DO NOT EDIT BELOW THIS LINE OR ELSE YOU WILL BREAK IT --------- */\r\ninclude("includes/private/bin/plugins/mts/plugin.php");', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$page'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' AND status=''Published'' AND toggle_visible=''on'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	$toggle_visible=$FETCH_MODULES[''toggle_visible''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		if($toggle_visible == "on"){eval($contents);}else if($toggle_visible == "off"){/* not visible */}\r\n	echo "</div>";\r\n}', '', '', '', '', 'yes', 'off', 'Published', 23, '127.0.0.1'),
(57, 'off', 'page2', 'double', 'PostSystem Example', 'blog,Colleagues of Mine,Back on the Road,Creative Fotos,New Memories,The Library,What am I saying?', 'pad4', 5, '', '2012-07-26', '', '/* YOU MIGHT HAVE TO SEARCH FOR THE PAD NAME (PADMAIN, PAD1 THROUGH 4, AND CHANGE IT BASED ON WHAT PAD */\r\n$pname="blog";\r\n$pname_special="Blog";\r\nif(isset($_GET[''user''])){$pname_uri="blog/user/".$_GET[''user''];}else{$pname_uri="blog";}\r\n$display_user=true;\r\n$PADINFO=$properties->PADMAIN;\r\n$PNAME_PUBLISHED_NAME="Published";\r\n/* ---------- DO NOT EDIT BELOW THIS LINE OR ELSE YOU WILL BREAK IT --------- */\r\ninclude("includes/private/bin/plugins/PostSystem/plugin.php");', '', '', '$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''$page'' AND sidebar=''1'' AND launchpad=''$launchpadPN'' AND status=''Published'' AND toggle_visible=''on'' ORDER BY arr") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){\r\n	$title=$FETCH_MODULES[''title''];\r\n	$contents=$FETCH_MODULES[''contents''];\r\n	$toggle_title=$FETCH_MODULES[''toggle_title''];\r\n	$toggle_visible=$FETCH_MODULES[''toggle_visible''];\r\n	if($toggle_title == "off"){/* no title */} else if($toggle_title == "on"){echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";}\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n		//convert contents\r\n		$contents=converter($properties,$contents,''basic'',''to'');\r\n		if($toggle_visible == "on"){eval($contents);}else if($toggle_visible == "off"){/* not visible */}\r\n	echo "</div>";\r\n}', '', '', '', '', 'yes', 'on', 'Published', 21, '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `h_pages_modules`
--

CREATE TABLE IF NOT EXISTS `h_pages_modules` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `arr` int(10) NOT NULL,
  `launchpad` enum('padmain','pad1','pad2','pad3','pad4') NOT NULL,
  `title` varchar(255) NOT NULL,
  `mini_title` varchar(200) NOT NULL,
  `toggle_title` enum('on','off') NOT NULL,
  `contents` longtext NOT NULL,
  `page` varchar(100) NOT NULL,
  `type` enum('maincontent','sidebar','footer') NOT NULL,
  `sidebar` int(10) NOT NULL,
  `footer_section` enum('','left','mid','right') NOT NULL,
  `toggle_visible` enum('on','off') NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'no',
  `status` enum('Drafted','Published','On Hold','Deleted','Recovered') NOT NULL DEFAULT 'Published',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=85 ;

--
-- Dumping data for table `h_pages_modules`
--

INSERT INTO `h_pages_modules` (`id`, `arr`, `launchpad`, `title`, `mini_title`, `toggle_title`, `contents`, `page`, `type`, `sidebar`, `footer_section`, `toggle_visible`, `is_searchable`, `status`) VALUES
(1, 4, 'padmain', 'Colleagues of Mine', '', 'on', '//GET COLLEAGUES OF MINE MAKER\r\necho "<div class=\\"blog-hp-container-title\\">Blog Roll</div>";\r\necho "<div class=\\"module-container-mini\\">";\r\n	echo "<div class=\\"module-container-mini-lcol\\">";						\r\n		/* CUSTOM CODE GOES HERE */		\r\n		echo "<div class=\\"module-container-mini-content\\">";\r\n		$GET_COM_QUERY=mysql_query("SELECT * FROM h_links WHERE type=''blogroll''") or die(mysql_error());\r\n		if(mysql_num_rows($GET_COM_QUERY)<1){\r\n		  echo "<li>no items</li>";\r\n		} else {\r\n			@$ending="";\r\n		  while($FETCH_COM_QUERY=mysql_fetch_array($GET_COM_QUERY)){\r\n			if(strlen($FETCH_COM_QUERY[''name'']) > 25){$ending="...";}else{$ending="";}\r\n			echo "<li class=\\"module-li\\"><a href=\\"".$FETCH_COM_QUERY[''url'']."\\" target=\\"".$FETCH_COM_QUERY[''target'']."\\" title=\\"".$FETCH_COM_QUERY[''title'']."\\">".substr($FETCH_COM_QUERY[''name''],0,25).$ending."</a></li>";\r\n		   }\r\n		}\r\n		echo "</div>";\r\n		/* END CUSTOM CODE GOES HERE */\r\n	echo "</div>";\r\necho "</div>";', 'blog', 'sidebar', 1, '', 'off', 'no', 'Published'),
(2, 1, 'padmain', 'Back on the Road', '', 'on', '/* YOU MIGHT HAVE TO SEARCH FOR THE PAD NAME AND CHANGE IT TO MATCH WHAT IS NEEDED */\r\n$pname="blog";\r\n$pname_special="Blog";\r\n$pname_uri="blog";\r\n$display_user=true;\r\n$PADINFO=$properties->PADMAIN;\r\n/* ---------- DO NOT EDIT BELOW THIS LINE OR ELSE YOU WILL BREAK IT --------- */\r\n//BACK ON THE ROAD MAKER\r\n\r\n/* STEP 1: COLLECTION INFORMATION FROM DB */\r\n\r\n/* STEP 1.1: FIND ALL THE DATES AND PUT THEM INTO A STRING*/\r\n$FIND_ALL_DATE_IN_ENTRIES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$pname."_entries WHERE status=''Published'' AND dateandtime LIKE ''%'' GROUP BY date_year, date_month ORDER BY dateandtime DESC");\r\n@$dateandtime_string="";\r\nwhile($FETCH_ADIE=mysql_fetch_array($FIND_ALL_DATE_IN_ENTRIES)){\r\n	$dateandtime=$FETCH_ADIE[''dateandtime'']; \r\n	/* STEP 2: CONVERT, STREAMLINE, AND BUILD DATES */\r\n	/*\r\n	HELPFUL COMMENTS :\r\n	0000-00-00\r\n	0123456789\r\n	*/\r\n\r\n	//years\r\n	$year=substr($dateandtime,0,4); //2012\r\n\r\n	//months\r\n	$month=substr($dateandtime,5,2); //08\r\n	\r\n	//YYYY-MM,YYYY-MM,\r\n	\r\n	$this_dateandtime_string=$year."-".$month."-";\r\n		\r\n	//put it together\r\n	$dateandtime_string.=$year."-".$month.",";\r\n}\r\n\r\n/* STEP 3: PARSE THE INFORMATION INTO MANAGEABLE LISTS */\r\n@$the_complete_dateandtime=$dateandtime_string;\r\n@$the_complete_dateandtime_list=explode(",",$the_complete_dateandtime);\r\n@$new_complete_dateandtime="";\r\n\r\n/* STEP X: TAKE THE LIST AND COUNT HOW MANY TIMES A STR APPEARS */\r\nfor($ic=0; $ic<count($the_complete_dateandtime_list); $ic++){\r\n	@$count_o=substr_count($the_complete_dateandtime,$the_complete_dateandtime_list[$ic]);\r\n}\r\n\r\n/* STEP 4: MAKE THE LIST AND DO ADDITIONAL PARSING IF REQUIRED */\r\n/* STEP 4.1: PARSE EACH YEAR AND MONTH */\r\necho "<div class=\\"blog-hp-container-title\\">Blog Archive</div>";\r\necho "<div class=\\"module-container-twocolumn\\">";\r\n	echo "<div class=\\"module-container-twocolumn-lcol\\">";\r\n		/* CUSTOM CODE GOES HERE */\r\n		echo "<div class=\\"module-container-twocolumn-lcol-content\\">";\r\n		for($i=0; $i<count($the_complete_dateandtime_list); $i++){\r\n			@$the_exploded_list=explode("-",$the_complete_dateandtime_list[$i]);\r\n			@$the_year=$the_exploded_list[0];\r\n			@$the_month=$the_exploded_list[1];\r\n			$default_month_num_list=array(\r\n				0 => "01",\r\n				1 => "02",\r\n				2 => "03",\r\n				3 => "04",\r\n				4 => "05",\r\n				5 => "06",\r\n				6 => "07",\r\n				7 => "08",\r\n				8 => "09",\r\n				9 => "10",\r\n				10 => "11",\r\n				11 => "12"\r\n			);\r\n			$default_month_names_list=array(\r\n				0 => "January",\r\n				1 => "February",\r\n				2 => "March",\r\n				3 => "April",\r\n				4 => "May",\r\n				5 => "June",\r\n				6 => "July",\r\n				7 => "August",\r\n				8 => "September",\r\n				9 => "October",\r\n				10 => "November",\r\n				11 => "December"\r\n			);\r\n			for($ii=0; $ii<count($default_month_num_list); $ii++){\r\n				if($the_month==$default_month_num_list[$ii]){\r\n					$the_month=$default_month_names_list[$ii];\r\n				}\r\n			}\r\n			echo "<li class=\\"module-container-twocolumn-lcol-content-li\\"><a href=\\"".$wurl.$PADINFO."/".$page."/botr/".$the_year."/".$the_month."#top\\">".$the_month." ".$the_year."</a></li>";\r\n		}\r\n		echo "</div>";\r\n		/* END CUSTOM CODE GOES HERE */\r\n	echo "</div>";\r\n	echo "<div class=\\"module-container-twocolumn-rcol\\">";\r\n		/* CUSTOM CODE GOES HERE */\r\n		echo "<div class=\\"module-container-twocolumn-rcol-content\\">";\r\n		/* STEP 4.2: COUNT THE NUMBER OF ENTRIES IN EACH MONTH YEAR */\r\n		for($i=0; $i<count($the_complete_dateandtime_list)-1; $i++){\r\n				@$the_exploded_list=explode("-",$the_complete_dateandtime_list[$i]);\r\n				@$the_year=$the_exploded_list[0];\r\n				@$the_month=$the_exploded_list[1];\r\n				$FIND_ALL_ENTRIES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$pname."_entries WHERE dateandtime LIKE ''$the_year-$the_month-%'' AND status=''Published''");\r\n				$the_count=mysql_num_rows($FIND_ALL_ENTRIES);\r\n				echo "<li class=\\"module-container-twocolumn-rcol-content-li-paren\\">(".$the_count.")</a></li>";\r\n			}				\r\n		echo "</div>";\r\n		/* END CUSTOM CODE GOES HERE */\r\n	echo "</div>";\r\necho "</div>";', 'blog', 'sidebar', 1, '', 'off', 'no', 'Published'),
(3, 3, 'padmain', 'Creative Fotos', '', 'on', 'echo "<div class=\\"blog-hp-container-title\\">Blog Photos</div>";\r\necho "<div class=\\"module-container-mini\\">";\r\n	/* CUSTOM CODE GOES HERE */\r\n	$BlogFlickrID=getGlobalVars($properties,"BlogFlickrID");\r\n	$BlogFlickrName=getGlobalVars($properties,"BlogFlickrName");\r\n			\r\n	if(strlen($BlogFlickrName)>15){$BlogFlickrNameReal=substr($BlogFlickrName,0,15)."...";}else{$BlogFlickrNameReal=$BlogFlickrName;}\r\n	echo "<div class=\\"module-container-mini-lcol\\">";						\r\n		echo "<div class=\\"module-container-mini-content\\">\r\n			";\r\n			echo "\r\n			<ul id=\\"cycle\\"></ul>\r\n			<script type=\\"text/javascript\\">\r\n			$(''#cycle'').jflickrfeed({\r\n				limit: 50,\r\n				qstrings: {\r\n					id: ''".$BlogFlickrID."''\r\n				},\r\n				itemTemplate: ''<li><img src=\\"{{image}}\\" alt=\\"{{title}}\\" width=\\"195\\" height=\\"255\\" /><div>{{title}}</div></li>''\r\n			}, function(data) {\r\n				$(''#cycle div'').hide();\r\n				$(''#cycle'').cycle({\r\n					timeout: 5000\r\n				});\r\n				$(''#cycle li'').hover(function(){\r\n					$(this).children(''div'').show();\r\n				},function(){\r\n					$(this).children(''div'').hide();\r\n				});\r\n			});\r\n			</script>\r\n			<br />\r\n			&nbsp;&nbsp;&nbsp;<a href=\\"http://instagram.com/".$BlogFlickrName."\\" class=\\"big-url\\" target=\\"_blank\\">Follow @".$BlogFlickrNameReal."</a>\r\n			<br />\r\n			<br />\r\n			";\r\n		echo "</div>";\r\n	echo "</div>";\r\n	/* END CUSTOM CODE GOES HERE */\r\necho "</div>";', 'blog', 'sidebar', 1, '', 'on', 'no', 'Published'),
(4, 6, 'padmain', 'New Memories', '', 'on', '/* NEW MEMORIES MODULE */\r\necho "<div class=\\"blog-hp-container-title\\">New Blog Posts</div>";\r\necho "<div class=\\"module-container-mini\\">";\r\n	echo "<div class=\\"module-container-mini-leftcol\\">";\r\n		/* CUSTOM CODE GOES HERE */\r\n		$GET_LATEST_BLOG_ENTRIES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE status=''Published'' ORDER BY dateandtime DESC LIMIT 2") or die(''uh oh! ''.mysql_error());\r\n		if(mysql_num_rows($GET_LATEST_BLOG_ENTRIES)<1){\r\n			echo "No memories found...:(";\r\n		} else {\r\n			while($FETCH_LATEST_BLOG_ENTRIES=mysql_fetch_array($GET_LATEST_BLOG_ENTRIES)){\r\n				$id=$FETCH_LATEST_BLOG_ENTRIES[''id''];\r\n				$title=$FETCH_LATEST_BLOG_ENTRIES[''title''];\r\n				$content=$FETCH_LATEST_BLOG_ENTRIES[''content''];\r\n				$author=$FETCH_LATEST_BLOG_ENTRIES[''author''];\r\n				$category=$FETCH_LATEST_BLOG_ENTRIES[''category''];\r\n				$tags=$FETCH_LATEST_BLOG_ENTRIES[''tags''];\r\n				$dateandtime=$FETCH_LATEST_BLOG_ENTRIES[''dateandtime''];\r\n			\r\n				//make dateandtime\r\n				//0000-00-00\r\n				//0123456789\r\n				$blog_entry_year  = substr($dateandtime,0,4);\r\n				$blog_entry_month = substr($dateandtime,5,2);\r\n				$blog_entry_day   = substr($dateandtime,8,2);\r\n				//determine month					\r\n				if($blog_entry_month=="01"){$blog_entry_month_full="Jan";}\r\n				if($blog_entry_month=="02"){$blog_entry_month_full="Feb";}\r\n				if($blog_entry_month=="03"){$blog_entry_month_full="Mar";}\r\n				if($blog_entry_month=="04"){$blog_entry_month_full="Apr";}\r\n				if($blog_entry_month=="05"){$blog_entry_month_full="May";}\r\n				if($blog_entry_month=="06"){$blog_entry_month_full="Jun";}\r\n				if($blog_entry_month=="07"){$blog_entry_month_full="Jul";}\r\n				if($blog_entry_month=="08"){$blog_entry_month_full="Aug";}\r\n				if($blog_entry_month=="09"){$blog_entry_month_full="Sep";}\r\n				if($blog_entry_month=="10"){$blog_entry_month_full="Oct";}\r\n				if($blog_entry_month=="11"){$blog_entry_month_full="Nov";}\r\n				if($blog_entry_month=="12"){$blog_entry_month_full="Dec";}\r\n			\r\n				//convert dateandtime into a better looking string\r\n				$dateandtime = $blog_entry_month . " " . $blog_entry_day . ", " . $blog_entry_year;\r\n				$dateandtime_m = $blog_entry_month;\r\n				$dateandtime_m_full = $blog_entry_month_full;\r\n				$dateandtime_d = $blog_entry_day;\r\n				$dateandtime_y = $blog_entry_year;\r\n			\r\n				//convert and get the author\r\n				$GET_BLOG_AUTHOR_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE id=''{$author}''") or die(''uh oh! ''.mysql_error());\r\n				while($FETCH_BLOG_AUTHOR_INFO=mysql_fetch_array($GET_BLOG_AUTHOR_INFO)){\r\n				 $uname=$FETCH_BLOG_AUTHOR_INFO[''uname''];\r\n				 $fname=$FETCH_BLOG_AUTHOR_INFO[''fname''];\r\n				 $lname=$FETCH_BLOG_AUTHOR_INFO[''lname''];\r\n				 $HTDN=$FETCH_BLOG_AUTHOR_INFO[''how_to_display_name''];\r\n				}	\r\n			\r\n				//convert and get the category\r\n				$GET_BLOG_CATEGORY_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_categories WHERE id=''{$category}''") or die(''uh oh! ''.mysql_error());\r\n				while($FETCH_BLOG_CATEGORY_INFO=mysql_fetch_array($GET_BLOG_CATEGORY_INFO)){\r\n				 $category=$FETCH_BLOG_CATEGORY_INFO[''name''];\r\n				}\r\n				\r\n				//get comment for posts\r\n				$GET_COMMENTS_C=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_comments WHERE entry_id=''$id'' AND status=''Approved''");\r\n				if(mysql_num_rows($GET_COMMENTS_C)<1){\r\n					$comments_count="0 comments";\r\n				} else {\r\n					if((mysql_num_rows($GET_COMMENTS_C)>0) && (mysql_num_rows($GET_COMMENTS_C)<2)){\r\n						$comments_count=mysql_num_rows($GET_COMMENTS_C)." comment";\r\n					} else {\r\n						$comments_count=mysql_num_rows($GET_COMMENTS_C)." comments";\r\n					}\r\n				}\r\n				\r\n				//set author to uname from db\r\n				/* SWITCH DEPENDING ON USER-SET ATTIBUTE */switch($HTDN){case ''full'':$author=$fname." ".$lname;break;case ''only username'':$author=$uname;break;case ''only first name'':$author=$fname;break;}\r\n				//set author to uname from db\r\n				echo "<div class=\\"module-container-mini-title\\">".$title."</div>";\r\n				\r\n				echo "<div class=\\"module-container-mini-author\\">by <a href=\\"".@$wurl.$properties->PADMAIN."/blog/user/".$uname."#top\\">" . $author . "</a></div>";\r\n				\r\n				echo "<div class=\\"module-container-mini-category\\">under " . "<a href=\\"".@$wurl.$properties->PADMAIN."/blog/category/".strtolower(converter($properties,$category,''url'',''to''))."#top\\">" . $category . "</a></div>";\r\n				\r\n				echo "<div class=\\"module-container-mini-content\\">".substr(converter($properties,$content,''previewarticle'',''to''),0,100)."...</div>";\r\n				\r\n				echo "<div class=\\"module-container-mini-readmorebtn\\">";\r\n					\r\n					echo "<div class=\\"module-container-mini-rmbtnrow\\">";\r\n						echo "<div class=\\"module-container-mini-rmbtnlcol\\">&nbsp;</div>";\r\n						echo "<div class=\\"module-container-mini-rmbtnrcol\\" onclick=\\"".@$wurl.$properties->PADMAIN."/blog/permalink/".converter($properties,$title,''url'',''to'')."\\"><a href=\\"".@$wurl.$properties->PADMAIN."/blog/permalink/".$blog_entry_year."/".$blog_entry_month."/".$blog_entry_day."/".converter($properties,$title,''url'',''to'')."#top\\">Check it out!</a></div>";\r\n					echo "</div>";\r\n					\r\n				echo "</div>";\r\n				/* END CUSTOM CODE GOES HERE */\r\n				echo "<div class=\\"module-container-mini-separator\\"></div>";\r\n			}\r\n		}\r\n	echo "</div>";\r\necho "</div>";', 'blog', 'sidebar', 1, '', 'on', 'no', 'Published'),
(5, 5, 'padmain', 'The Library', '', 'on', '//THE LIBRARY MAKER\r\n$GET_LIB_QUERY=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_categories WHERE status = ''Active'' ORDER BY name") or die(mysql_error());\r\necho "<div class=\\"blog-hp-container-title\\">Blog Categories</div>";\r\necho "<div class=\\"module-container-twocolumn\\">";\r\n	if(mysql_num_rows($GET_LIB_QUERY)<1){\r\n		echo "No Categories Yet!";\r\n	} else {		\r\n		echo "<div class=\\"module-container-twocolumn-lcol\\">";						\r\n			/* CUSTOM CODE GOES HERE */		\r\n			echo "<div class=\\"module-container-twocolumn-lcol-content\\">";\r\n				@$the_complete_list_of_cats="";\r\n					\r\n				//put each year and month\r\n				while($FETCH_LIB_QUERY=mysql_fetch_array($GET_LIB_QUERY)){\r\n					$id=$FETCH_LIB_QUERY[''id''];\r\n					$name=$FETCH_LIB_QUERY[''name''];\r\n					$shortname=$FETCH_LIB_QUERY[''shortname''];\r\n					$parentid=$FETCH_LIB_QUERY[''parentid''];\r\n					\r\n					if($parentid==0){\r\n						//not linked to a parent; it is a parent\r\n						echo "<li class=\\"module-container-twocolumn-lcol-li\\"><a href=\\"".@$wurl.$properties->PADMAIN."/".$page."/category/".$FETCH_LIB_QUERY[''shortname'']."#top\\">".$FETCH_LIB_QUERY[''name'']."</a></li>";\r\n						//make a list of the cats\r\n						$the_complete_list_of_cats.=$id.",";\r\n					} else {\r\n						//linked to a parent\r\n						//find the parent name\r\n						$GET_PARENT_QUERY=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_categories WHERE status = ''Active'' AND id=''$parentid''") or die(mysql_error());\r\n						$FETCH_PARENT_QUERY=mysql_fetch_array($GET_PARENT_QUERY);\r\n						$parentname=$FETCH_PARENT_QUERY[''shortname''];\r\n						\r\n						echo "<li class=\\"module-container-twocolumn-lcol-li\\"><a href=\\"".@$wurl.$properties->PADMAIN."/".$page."/category/".$parentname.":".$FETCH_LIB_QUERY[''shortname'']."#top\\">".$FETCH_LIB_QUERY[''name'']."</a></li>";	\r\n						\r\n						//make a list of the cats\r\n						$the_complete_list_of_cats.=$id.",";\r\n					}\r\n				}\r\n			echo "</div>";\r\n			/* END CUSTOM CODE GOES HERE */\r\n		echo "</div>";\r\n		echo "<div class=\\"module-container-twocolumn-rcol\\">";\r\n			/* CUSTOM CODE GOES HERE */		\r\n			echo "<div class=\\"module-container-twocolumn-rcol-content\\">";\r\n				//explode the list\r\n				$the_complete_list_of_cats_list=explode(",",$the_complete_list_of_cats);\r\n				for($i=0; $i<count($the_complete_list_of_cats_list)-1; $i++){\r\n					$COUNT_ENTRIES_BY_CAT=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE status=''Published'' AND category=''$the_complete_list_of_cats_list[$i]''");\r\n					$the_count=mysql_num_rows($COUNT_ENTRIES_BY_CAT);\r\n					echo "<li class=\\"module-container-twocolumn-rcol-content-li-paren\\">(".$the_count.")</li>";\r\n				}\r\n			echo "</div>";\r\n			/* END CUSTOM CODE GOES HERE */\r\n		echo "</div>";\r\n	}\r\necho "</div>";', 'blog', 'sidebar', 1, '', 'off', 'no', 'Published'),
(6, 1, 'padmain', 'TWDB Tweets', '', 'on', 'echo "<div class=\\"blog-hp-container-title\\">Blog</div>";\r\necho "<div class=\\"module-container-mini\\">";\r\n	/* CUSTOM CODE GOES HERE */\r\n	echo "<div class=\\"module-container-mini-lcol\\">";								\r\n		echo "<script type=\\"text/javascript\\">\r\n			jQuery(function($){\r\n				$(\\".tweet-nfrta-special\\").tweet({\r\n					username: \\"".getGlobalVars($properties,"BlogFlickrName")."\\",\r\n					join_text: \\"auto\\",\r\n					avatar_size: 32,\r\n					count: 3,\r\n					auto_join_text_default: \\" we said,\\", \r\n					auto_join_text_ed: \\" we\\",\r\n					auto_join_text_ing: \\" we were\\",\r\n					auto_join_text_reply: \\" we replied to\\",\r\n					auto_join_text_url: \\" we were checking out\\",\r\n					loading_text: \\"loading tweets...\\"\r\n				});\r\n			});\r\n		</script>\r\n		<div class=\\"tweet-nfrta-special\\"></div>\r\n		<br />\r\n		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\\"https://twitter.com/".getGlobalVars($properties,"BlogFlickrName")."\\" class=\\"mid-url\\" target=\\"_blank\\">Follow @".getGlobalVars($properties,"BlogFlickrName")."</a>\r\n		<br />\r\n		<br />\r\n		";\r\n	echo "</div>";\r\n	/* END CUSTOM CODE GOES HERE */\r\necho "</div>"; ', 'blog', 'sidebar', 1, '', 'off', 'no', 'Recovered'),
(20, 1, 'padmain', 'BLOG', '// Insights from the Inside', 'on', '/* YOU MIGHT HAVE TO SEARCH FOR THE PAD NAME (PADMAIN, PAD1 THROUGH 4, AND CHANGE IT BASED ON WHAT PAD */\r\n$pname="blog";\r\n$pname_special="Blog";\r\n$pname_uri="blog";\r\n$display_user=true;\r\n$PADINFO=$properties->PADMAIN;\r\n$title_name="blog";\r\n$PNAME_PUBLISHED_NAME="Published";\r\n/* YOU ARE GOING TO HAVE TO RENAME THE FUNCTION TO A DIF ONE SINCE YOU CANNOT */\r\n/* MULTIPLE FUNCTIONS ON THE SAME PAGE */\r\n/* ---------- DO NOT EDIT BELOW THIS LINE OR ELSE YOU WILL BREAK IT --------- */\r\n//check for meta being used\r\nif(isset($_GET[''meta''])){\r\n	//find out what meta to use\r\n	switch($_GET[''meta'']){\r\n		default:\r\n			@$credentials="";\r\n			//meta is wrong or not there, do normal page\r\n			build_blog_page(''normal'',$properties,$credentials,$pname,$pname_special,$PADINFO,$pname_uri,$title_name,$display_user,$PNAME_PUBLISHED_NAME,$HTDN);\r\n		break;\r\n	}\r\n} else {\r\n	//meta is not being used, do normal pname page\r\n    @$credentials="";\r\n	build_blog_page(''normal'',$properties,$credentials,$pname,$pname_special,$PADINFO,$pname_uri,$title_name,$display_user,$PNAME_PUBLISHED_NAME,$HTDN);\r\n}\r\n\r\nfunction build_blog_page($operation,$properties,$credentials,$pname,$pname_special,$PADINFO,$pname_uri,$title_name,$display_user,$PNAME_PUBLISHED_NAME,$HTDN){\r\n	if($_SERVER[''HTTP_HOST'']=="localhost"){$WEBSITE_URL=$properties->WEBSITE_TEST_URL;}else{$WEBSITE_URL=$properties->WEBSITE_REMO_URL;}\r\n	switch($operation){\r\n		case ''normal'':\r\n			$GET_PNAME_ENTRIES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$pname."_entries WHERE status=''".$PNAME_PUBLISHED_NAME."'' ORDER BY dateandtime DESC LIMIT 3") or die(''uh oh! ''.mysql_error());\r\n			if(mysql_num_rows($GET_PNAME_ENTRIES)<1){\r\n				echo "<h2>No New Entries :(</h2>";\r\n			} else {\r\n				while($FETCH_PNAME_ENTRIES=mysql_fetch_array($GET_PNAME_ENTRIES)){\r\n					$id=$FETCH_PNAME_ENTRIES[''id''];\r\n					$title=$FETCH_PNAME_ENTRIES[''title''];\r\n					$content=$FETCH_PNAME_ENTRIES[''content''];\r\n					$author=$FETCH_PNAME_ENTRIES[''author''];\r\n					@$director=$FETCH_PNAME_ENTRIES[''director''];\r\n					@$studio=$FETCH_PNAME_ENTRIES[''studio''];\r\n					@$network=$FETCH_PNAME_ENTRIES[''network''];\r\n					$category=$FETCH_PNAME_ENTRIES[''category''];\r\n					$tags=$FETCH_PNAME_ENTRIES[''tags''];\r\n					$dateandtime=$FETCH_PNAME_ENTRIES[''dateandtime''];\r\n					$dateandtime_goingtostart=$FETCH_PNAME_ENTRIES[''dateandtime_goingtostart''];\r\n				\r\n					//set up an indicator variable\r\n					$dateandtime_indicator=$dateandtime;\r\n					\r\n					if($dateandtime=="0000-00-00 00:00:00"){\r\n						/* ART Member has not started reviewing and will start */\r\n						//make dateandtime\r\n						//0000-00-00 00:00:00\r\n						//0123456789012345678\r\n						$pname_entry_year  = substr($dateandtime_goingtostart,0,4);\r\n						$pname_entry_month = substr($dateandtime_goingtostart,5,2);\r\n						$pname_entry_day   = substr($dateandtime_goingtostart,8,2);\r\n						$pname_entry_hour  = substr($dateandtime_goingtostart,11,2);\r\n						$pname_entry_min   = substr($dateandtime_goingtostart,14,2);\r\n						$pname_entry_sec   = substr($dateandtime_goingtostart,17,2);\r\n					} else {\r\n						/* STARTED */\r\n						//make dateandtime\r\n						//0000-00-00 00:00:00\r\n						//0123456789012345678\r\n						$pname_entry_year  = substr($dateandtime,0,4);\r\n						$pname_entry_month = substr($dateandtime,5,2);\r\n						$pname_entry_day   = substr($dateandtime,8,2);\r\n						$pname_entry_hour  = substr($dateandtime,11,2);\r\n						$pname_entry_min   = substr($dateandtime,14,2);\r\n						$pname_entry_sec   = substr($dateandtime,17,2);\r\n					}\r\n					\r\n					//determine month				\r\n					if($pname_entry_month=="01"){$pname_entry_month_full="Jan";}\r\n					if($pname_entry_month=="02"){$pname_entry_month_full="Feb";}\r\n					if($pname_entry_month=="03"){$pname_entry_month_full="Mar";}\r\n					if($pname_entry_month=="04"){$pname_entry_month_full="Apr";}\r\n					if($pname_entry_month=="05"){$pname_entry_month_full="May";}\r\n	\r\n					if($pname_entry_month=="06"){$pname_entry_month_full="Jun";}\r\n					if($pname_entry_month=="07"){$pname_entry_month_full="Jul";}\r\n					if($pname_entry_month=="08"){$pname_entry_month_full="Aug";}\r\n					if($pname_entry_month=="09"){$pname_entry_month_full="Sep";}\r\n					if($pname_entry_month=="10"){$pname_entry_month_full="Oct";}\r\n					if($pname_entry_month=="11"){$pname_entry_month_full="Nov";}\r\n					if($pname_entry_month=="12"){$pname_entry_month_full="Dec";}\r\n				\r\n					//convert dateandtime into a better looking string\r\n					$dateandtime = $pname_entry_month . " " . $pname_entry_day . ", " . $pname_entry_year;\r\n					$dateandtime_m = $pname_entry_month;\r\n					$dateandtime_m_full = $pname_entry_month_full;\r\n					$dateandtime_d = $pname_entry_day;\r\n					$dateandtime_y = $pname_entry_year;\r\n				\r\n					//convert and get the director or author\r\n					if($display_user===false){\r\n						$GET_PNAME_AUTHOR_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$pname."_directors WHERE id=''{$director}''") or die(''uh oh! ''.mysql_error());\r\n						while($FETCH_PNAME_AUTHOR_INFO=mysql_fetch_array($GET_PNAME_AUTHOR_INFO)){\r\n						 $director_name=$FETCH_PNAME_AUTHOR_INFO[''name''];\r\n						 $director_shortname=$FETCH_PNAME_AUTHOR_INFO[''shortname''];\r\n						}	\r\n					} else {				\r\n						$GET_PNAME_AUTHOR_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE id=''{$author}''") or die(''uh oh! ''.mysql_error());\r\n						while($FETCH_PNAME_AUTHOR_INFO=mysql_fetch_array($GET_PNAME_AUTHOR_INFO)){\r\n						 $uname=$FETCH_PNAME_AUTHOR_INFO[''uname''];\r\n						 $fname=$FETCH_PNAME_AUTHOR_INFO[''fname''];\r\n						 $lname=$FETCH_PNAME_AUTHOR_INFO[''lname''];\r\n						 $HTDN=$FETCH_PNAME_AUTHOR_INFO[''how_to_display_name''];\r\n						}\r\n					}\r\n					\r\n					//convert and get the studio\r\n					if($display_user===false){\r\n						$GET_PNAME_AUTHOR_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$pname."_studios WHERE id=''{$studio}''") or die(''uh oh! ''.mysql_error());\r\n						while($FETCH_PNAME_AUTHOR_INFO=mysql_fetch_array($GET_PNAME_AUTHOR_INFO)){\r\n						 $studio_name=$FETCH_PNAME_AUTHOR_INFO[''name''];\r\n						 $studio_shortname=$FETCH_PNAME_AUTHOR_INFO[''shortname''];\r\n						}	\r\n					} else {				\r\n						/* NONE */\r\n					}\r\n					\r\n					//convert and get the network\r\n					if($display_user===false){\r\n						$GET_PNAME_AUTHOR_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$pname."_networks WHERE id=''{$network}''") or die(''uh oh! ''.mysql_error());\r\n						while($FETCH_PNAME_AUTHOR_INFO=mysql_fetch_array($GET_PNAME_AUTHOR_INFO)){\r\n						 $network_name=$FETCH_PNAME_AUTHOR_INFO[''name''];\r\n						 $network_shortname=$FETCH_PNAME_AUTHOR_INFO[''shortname''];\r\n						}	\r\n					} else {				\r\n						/* NONE */\r\n					}\r\n				\r\n					//convert and get the category\r\n					//#,#,\r\n					if(strpos($category,",")!="-1"){\r\n						/* MULTIPLE CATEGORIES */\r\n						$category_list=explode(",",$category);\r\n						$category="";\r\n						for($icat=0; $icat<=count($category_list)-1; $icat++){\r\n							$GET_PNAME_CATEGORY_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$pname."_categories WHERE id=''{$category_list[$icat]}''") or die(''uh oh! ''.mysql_error());\r\n							while($FETCH_PNAME_CATEGORY_INFO=mysql_fetch_array($GET_PNAME_CATEGORY_INFO)){\r\n							 if($icat==count($category_list)-1){$category.="<a href=\\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/category/".converter($properties,$FETCH_PNAME_CATEGORY_INFO[''name''],''url'',''to'')."#top\\">" . $FETCH_PNAME_CATEGORY_INFO[''name''] . "</a>";}else{$category.="<a href=\\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/category/".converter($properties,$FETCH_PNAME_CATEGORY_INFO[''name''],''url'',''to'')."#top\\">" . $FETCH_PNAME_CATEGORY_INFO[''name''] . "</a>, ";}\r\n							}\r\n						}\r\n					} else {\r\n						$GET_PNAME_CATEGORY_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$pname."_categories WHERE id=''{$category}''") or die(''uh oh! ''.mysql_error());\r\n						while($FETCH_PNAME_CATEGORY_INFO=mysql_fetch_array($GET_PNAME_CATEGORY_INFO)){\r\n						 $category=$FETCH_PNAME_CATEGORY_INFO[''name''];\r\n						 $category="<a href=\\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/category/".converter($properties,$FETCH_PNAME_CATEGORY_INFO[''name''],''url'',''to'')."#top\\">" . $FETCH_PNAME_CATEGORY_INFO[''name''] . "</a>";\r\n						}	\r\n					}\r\n					\r\n					//get comment for posts\r\n					$GET_COMMENTS_C=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$pname."_comments WHERE entry_id=''$id'' AND status=''Approved''");\r\n					if(mysql_num_rows($GET_COMMENTS_C)<1){\r\n						$comments_count="0 comments";\r\n					} else {\r\n						if((mysql_num_rows($GET_COMMENTS_C)>0) && (mysql_num_rows($GET_COMMENTS_C)<2)){\r\n							$comments_count=mysql_num_rows($GET_COMMENTS_C)." comment";\r\n						} else {\r\n							$comments_count=mysql_num_rows($GET_COMMENTS_C)." comments";\r\n						}\r\n					}\r\n					\r\n					//get likes for posts\r\n					$GET_LIKES_C=mysql_query("SELECT * FROM {$properties->DB_PREFIX}thumbs WHERE entryid=''$id'' AND onpage=''".$pname_uri."'' AND type=''like'' AND thumbitem=''entry''");\r\n					if(mysql_num_rows($GET_LIKES_C)<1){\r\n						$likes_count="0 likes";\r\n					} else {\r\n						if((mysql_num_rows($GET_LIKES_C)>0) && (mysql_num_rows($GET_LIKES_C)<2)){\r\n							$likes_count=mysql_num_rows($GET_LIKES_C)." like";\r\n						} else {\r\n							$likes_count=mysql_num_rows($GET_LIKES_C)." likes";\r\n						}\r\n					}					\r\n	\r\n					//set author to uname from db					\r\n					if($display_user===false){$author_name=$name;}else{/* SWITCH DEPENDING ON USER-SET ATTIBUTE */switch($HTDN){case ''full'':$author_name=$fname." ".$lname;break;case ''only username'':$author_name=$uname;break;case ''only first name'':$author_name=$fname;break;}}\r\n	\r\n					/* START BUILDING THE PNAME LIST */\r\n					//echo "<div class=\\"".$title_name."-hp-container-title\\">".ucfirst($title_name)." Post</div>";\r\n					echo "<div class=\\"module-container-small whatido_bottom\\">";\r\n						\r\n						echo "<div class=\\"module-container-small-row\\">";\r\n													\r\n							echo "<div class=\\"module-container-small-lcol\\">";\r\n								\r\n								//the dateandtime\r\n								if($dateandtime_indicator=="0000-00-00 00:00:00"){\r\n									//get todays date in pieces\r\n									$today_y=date("Y");\r\n									$today_m=date("n");\r\n									$today_d=date("j");\r\n									\r\n									//establish vars\r\n									$font_size="80%";\r\n									\r\n									//compare								\r\n									$num_of_years=$pname_entry_year - $today_y;\r\n									$num_of_months=$pname_entry_month - $today_m;\r\n									$num_of_days=$pname_entry_day - $today_d;\r\n									if($num_of_years<1){\r\n										$ending_y="s";\r\n									} else if(($num_of_years>0) && ($num_of_years<2)){\r\n										$ending_y="";\r\n									} else if($num_of_years>1){\r\n										$ending_y="s";\r\n									}\r\n									\r\n									if($num_of_months<1){\r\n										$ending_m="s";\r\n									} else if(($num_of_months>0) && ($num_of_months<2)){\r\n										$ending_m="";\r\n									} else if($num_of_months>1){\r\n										$ending_m="s";\r\n									}\r\n									\r\n									if($num_of_days<1){\r\n										$ending_d="s";\r\n									} else if(($num_of_days>0) && ($num_of_days<2)){\r\n										$ending_d="";\r\n									} else if($num_of_days>1){\r\n										$ending_d="s";\r\n									}\r\n									\r\n									//make in...\r\n									if($num_of_years < 1){\r\n										$display_inyear="";\r\n									} else {\r\n										//check to see if month and day are there\r\n										if($num_of_months > 0 && $num_of_days > 0){\r\n											$display_inyear="{$num_of_years} year{$ending_y}, ";\r\n											$font_size="80%";\r\n										} else if($num_of_months > 0 || $num_of_days > 0){\r\n											$display_inyear="{$num_of_years} year{$ending_y}, ";\r\n											$font_size="100%";\r\n										} else {\r\n											$display_inyear="{$num_of_years} year{$ending_y}";	\r\n										}\r\n									}\r\n									if($num_of_months < 1){\r\n										$display_inmonth="";\r\n									} else {\r\n										//check to see if year and day are there\r\n										if($num_of_years > 0 && $num_of_days > 0){\r\n											$display_inmonth="{$num_of_months} month{$ending_m}, ";\r\n											$font_size="80%";\r\n										} else if($num_of_years > 0 || $num_of_days > 0){\r\n											$display_inmonth="{$num_of_months} month{$ending_m}, ";\r\n											$font_size="100%";\r\n										} else {\r\n											$display_inmonth="{$num_of_months} month{$ending_m}";\r\n										}\r\n									}\r\n									if($num_of_days < 1){\r\n										$display_inday="";\r\n									} else {\r\n										//check to see if year and month are there\r\n										if($num_of_years > 0 && $num_of_months > 0){\r\n											$display_intie=" &amp; ";\r\n											$font_size="100%";\r\n											$display_inday="{$display_intie}{$num_of_days} day{$ending_d}";\r\n										} else {\r\n											$display_inday="{$num_of_days} day{$ending_d}";\r\n										}\r\n									}\r\n									if(($num_of_years == 0) && ($num_of_months == 0) && ($num_of_days == 0)){\r\n										$font_size="100%";\r\n									}\r\n									\r\n									echo "<div class=\\"module-container-small-date-goingtostart\\" style=\\"font-size: {$font_size};\\">";\r\n									//detect if date is today\r\n									if(($num_of_years == 0) && ($num_of_months == 0) && ($num_of_days == 0)){\r\n										echo "today";\r\n									} else {\r\n										echo "in {$display_inyear}{$display_inmonth}{$display_inday}";	\r\n									}\r\n									echo "</div>";\r\n								} else {\r\n									$font_size="100%";\r\n									echo "<div class=\\"module-container-small-date\\" style=\\"font-size: {$font_size};\\">";\r\n									echo $dateandtime_d." ".$dateandtime_m_full.", ".$dateandtime_y;\r\n									echo "</div>";\r\n								}\r\n								\r\n								//the author or director\r\n								echo "<div class=\\"module-container-small-author\\">";\r\n									if($display_user===false){/*CUSTOM DISPLAY*/echo "<a href=\\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/directors/".$director_shortname."\\" title=\\"the director\\">" . $director_name . "</a>";}else{echo "<a href=\\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/user/".$uname."#top\\">" . $author_name . "</a>";}\r\n								echo "</div>";\r\n								\r\n								if($display_user===false){\r\n									//the studio\r\n									echo "<div class=\\"module-container-small-studio\\">";\r\n										echo "<a href=\\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/studios/".$studio_shortname."\\" title=\\"the studio\\">" . $studio_name . "</a>";\r\n									echo "</div>";\r\n									\r\n									//the network\r\n									echo "<div class=\\"module-container-small-network\\">";\r\n										echo "<a href=\\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/networks/".$network_shortname."\\" title=\\"the network\\">" . $network_name . "</a>";\r\n									echo "</div>";\r\n								} else if($display_user===true) {\r\n									/* NONE */	\r\n								}\r\n															\r\n								//the comments\r\n								echo "<div class=\\"module-container-small-comments\\">";\r\n									echo "<a href=\\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/permalink/".$pname_entry_year."/".$pname_entry_month."/".$pname_entry_day."/".converter($properties,$title,''url'',''to'')."#comments"."\\">".$comments_count."</a>";\r\n								echo "</div>";\r\n								\r\n								//the likes\r\n								echo "<div class=\\"module-container-full-comments\\">";\r\n									echo "<a href=\\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/permalink/".$pname_entry_year."/".$pname_entry_month."/".$pname_entry_day."/".converter($properties,$title,''url'',''to'')."#top"."\\">".$likes_count."</a>";\r\n								echo "</div>";\r\n								\r\n								//the category\r\n								echo "<div class=\\"module-container-small-category\\">";\r\n									echo $pname_special." / " . $category;\r\n								echo "</div>";\r\n								\r\n							echo "</div>";\r\n							\r\n							echo "<div class=\\"module-container-rcol\\">";\r\n								\r\n								//the title\r\n								echo "<div class=\\"module-container-small-title\\">";\r\n	\r\n									echo "<a href=\\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/permalink/".$pname_entry_year."/".$pname_entry_month."/".$pname_entry_day."/".converter($properties,$title,''url'',''to'')."#top\\">".$title."</a>";\r\n								echo "</div>";\r\n								\r\n								//the content\r\n								echo "<div class=\\"module-container-small-content\\">";\r\n									$content=converter($properties,$content,''article'',''to'');\r\n									$content=converter($properties,$content,''basic'',''to'');\r\n									$content=converter($properties,$content,''ncode'',''to'');\r\n									echo $content."...<a href=\\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/permalink/".$pname_entry_year."/".$pname_entry_month."/".$pname_entry_day."/".converter($properties,$title,''url'',''to'')."#top\\">[READ MORE]</a>";\r\n								echo "</div>";\r\n															\r\n								//the tags\r\n								echo "<div class=\\"module-container-small-tags\\">";\r\n									//convert the tags into urls\r\n									@$tagslist=explode(",",$tags);\r\n									$tags="";\r\n									for($itgs=0; $itgs<count(@$tagslist); $itgs++){\r\n										$tags.="<a href=\\"".$WEBSITE_URL.$PADINFO."/".@$pname_uri."/tag/".converter($properties,$tagslist[$itgs],''url'',''to'')."\\">".$tagslist[$itgs]."</a> ";\r\n									}\r\n							\r\n									echo "Tags: " . $tags;\r\n								echo "</div>";\r\n								\r\n							echo "</div>";\r\n							\r\n						echo "</div>";\r\n						\r\n					echo "</div>";\r\n					/* END BUILDING PNAME LIST */\r\n				}	\r\n			}\r\n                        echo "<br />";\r\n			echo "<a href=\\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/2#top\\" class=\\"blog-more-btn\\">VIEW OLDER POSTS ></a>";\r\n		break;\r\n	}\r\n}', 'basehome', 'maincontent', 0, '', 'off', 'no', 'Published'),
(24, 2, 'padmain', 'Already Contacted?', '', 'on', 'echo "<div class=\\"highlight-hp-container-title\\">Highlight</div>";\r\necho "<div class=\\"module-container-mini\\">";\r\n	echo "<div class=\\"module-container-mini-lcol\\">";						\r\n		/* CUSTOM CODE GOES HERE */\r\n		echo "<div class=\\"module-container-mini-content\\">If you have already contacted us, then you can click on the &quot;contact/checkstatus&quot; link. This link redirects you to that page that allows you to enter the ticket ID number and see what that status is on it. If you do not remember your ticket ID then it should be in your email. :)</div>";\r\n		/* END CUSTOM CODE GOES HERE */\r\n	echo "</div>";\r\necho "</div>";', 'contact', 'sidebar', 1, '', 'on', 'no', 'Published'),
(25, 5, 'padmain', 'Latest Comments', '', 'on', 'echo "<div class=\\"blog-hp-container-title\\">Blog</div>";\r\necho "<div class=\\"module-container-mini\\">";\r\n	echo "<div class=\\"module-container-mini-row\\">";\r\n		\r\n		echo "<div class=\\"module-container-mini-lcol\\">";\r\n			/* CUSTOM CODE GOES HERE */\r\n			$GET_LATEST_BLOG_COMMENTS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_comments WHERE status=''Approved'' ORDER BY dateandtime DESC LIMIT 2") or die(''uh oh! ''.mysql_error());\r\n			if(mysql_num_rows($GET_LATEST_BLOG_COMMENTS)<1){\r\n				echo "<div class=\\"module-container-mini-content\\">No comments found...:(</div>";\r\n			} else {\r\n				while($FETCH_LATEST_BLOG_COMMENTS=mysql_fetch_array($GET_LATEST_BLOG_COMMENTS)){\r\n					$id=$FETCH_LATEST_BLOG_COMMENTS[''id''];\r\n					$yname=$FETCH_LATEST_BLOG_COMMENTS[''yname''];\r\n					$title=$FETCH_LATEST_BLOG_COMMENTS[''title''];\r\n					$dateandtime=$FETCH_LATEST_BLOG_COMMENTS[''dateandtime''];\r\n					$content=$FETCH_LATEST_BLOG_COMMENTS[''content''];\r\n					$entry_id=$FETCH_LATEST_BLOG_COMMENTS[''entry_id''];\r\n					$ctype=$FETCH_LATEST_BLOG_COMMENTS[''ctype''];\r\n				\r\n					//make dateandtime\r\n					//0000-00-00\r\n					//0123456789\r\n					$blog_c_year  = substr($dateandtime,0,4);\r\n					$blog_c_month = substr($dateandtime,5,2);\r\n					$blog_c_day   = substr($dateandtime,8,2);\r\n					\r\n					//determine month					\r\n					if($blog_c_month=="01"){$blog_c_month_full="Jan";}\r\n					if($blog_c_month=="02"){$blog_c_month_full="Feb";}\r\n					if($blog_c_month=="03"){$blog_c_month_full="Mar";}\r\n					if($blog_c_month=="04"){$blog_c_month_full="Apr";}\r\n					if($blog_c_month=="05"){$blog_c_month_full="May";}\r\n					if($blog_c_month=="06"){$blog_c_month_full="Jun";}\r\n					if($blog_c_month=="07"){$blog_c_month_full="Jul";}\r\n					if($blog_c_month=="08"){$blog_c_month_full="Aug";}\r\n					if($blog_c_month=="09"){$blog_c_month_full="Sep";}\r\n					if($blog_c_month=="10"){$blog_c_month_full="Oct";}\r\n					if($blog_c_month=="11"){$blog_c_month_full="Nov";}\r\n					if($blog_c_month=="12"){$blog_c_month_full="Dec";}\r\n				\r\n					//convert dateandtime into a better looking string\r\n					$dateandtime = $blog_c_month . " " . $blog_c_day . ", " . $blog_c_year;\r\n					$dateandtime_m = $blog_c_month;\r\n					$dateandtime_m_full = $blog_c_month_full;\r\n					$dateandtime_d = $blog_c_day;\r\n					$dateandtime_y = $blog_c_year;\r\n					\r\n					$GET_LATEST_BLOG_ENTRIES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE id=''$entry_id''") or die(''uh oh! ''.mysql_error());\r\n					while($FETCH_LATEST_BLOG_ENTRIES=mysql_fetch_array($GET_LATEST_BLOG_ENTRIES)){\r\n						$dateandtime=$FETCH_LATEST_BLOG_ENTRIES[''dateandtime''];\r\n						$blog_title=$FETCH_LATEST_BLOG_ENTRIES[''title''];\r\n					}\r\n					\r\n					$blog_entry_year  = substr($dateandtime,0,4);\r\n					$blog_entry_month = substr($dateandtime,5,2);\r\n					$blog_entry_day   = substr($dateandtime,8,2);\r\n					\r\n					if($blog_entry_month=="01"){$blog_entry_month_full="Jan";}\r\n					if($blog_entry_month=="02"){$blog_entry_month_full="Feb";}\r\n					if($blog_entry_month=="03"){$blog_entry_month_full="Mar";}\r\n					if($blog_entry_month=="04"){$blog_entry_month_full="Apr";}\r\n					if($blog_entry_month=="05"){$blog_entry_month_full="May";}\r\n					if($blog_entry_month=="06"){$blog_entry_month_full="Jun";}\r\n					if($blog_entry_month=="07"){$blog_entry_month_full="Jul";}\r\n					if($blog_entry_month=="08"){$blog_entry_month_full="Aug";}\r\n					if($blog_entry_month=="09"){$blog_entry_month_full="Sep";}\r\n					if($blog_entry_month=="10"){$blog_entry_month_full="Oct";}\r\n					if($blog_entry_month=="11"){$blog_entry_month_full="Nov";}\r\n					if($blog_entry_month=="12"){$blog_entry_month_full="Dec";}\r\n				\r\n					//convert dateandtime into a better looking string\r\n					$dateandtime_m = $blog_entry_month;\r\n					$dateandtime_d = $blog_entry_day;\r\n					$dateandtime_y = $blog_entry_year;\r\n				\r\n					if($ctype=="badge"){\r\n						//get the category\r\n						$GET_BLOG_CATEGORY=mysql_query("SELECT * FROM {$properties->DB_PREFIX}badges WHERE id=''{$entry_id}''") or die(''uh oh! ''.mysql_error());\r\n						while($FETCH_BLOG_CATEGORY=mysql_fetch_array($GET_BLOG_CATEGORY)){\r\n						 $category=$FETCH_BLOG_CATEGORY[''name''];\r\n						 $badgeid=$FETCH_BLOG_CATEGORY[''id''];\r\n						}\r\n					} else {\r\n						//get the category\r\n						$GET_BLOG_CATEGORY=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE id=''{$entry_id}''") or die(''uh oh! ''.mysql_error());\r\n						while($FETCH_BLOG_CATEGORY=mysql_fetch_array($GET_BLOG_CATEGORY)){\r\n						 $category=$FETCH_BLOG_CATEGORY[''category''];\r\n						}	\r\n					}\r\n					\r\n					//convert and get the category\r\n					$GET_BLOG_CATEGORY_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_categories WHERE id=''{$category}''") or die(''uh oh! ''.mysql_error());\r\n					while($FETCH_BLOG_CATEGORY_INFO=mysql_fetch_array($GET_BLOG_CATEGORY_INFO)){\r\n					 $category=$FETCH_BLOG_CATEGORY_INFO[''name''];					 \r\n					}\r\n					\r\n					//set author to uname from db\r\n					echo "<div class=\\"module-container-mini-title\\">".$title."</div> ";\r\n					echo "<div class=\\"module-container-mini-author\\">by " . $yname . "</div>";\r\n					\r\n					if($ctype=="badge"){\r\n                                                $category=mysql_real_escape_string($category);\r\n						echo "<div class=\\"module-container-mini-category\\">posted on " . "<a href=\\"".@$wurl.$properties->PADMAIN."/blog/badges/".$badgeid."#top\\">" . $category . "</a></div>";\r\n					} else {\r\n						echo "<div class=\\"module-container-mini-category\\">posted in " . "<a href=\\"".@$wurl.$properties->PADMAIN."/blog/category/".converter($properties,$category,''url'',''to'')."#top\\">" . $category . "</a></div>";\r\n					}\r\n					\r\n					echo "<div class=\\"module-container-mini-content\\">".substr(converter($properties,$content,''previewarticle'',''to''),0,100)."...</div>";					\r\n					echo "<div class=\\"module-container-mini-readmorebtn\\">";\r\n						echo "<div class=\\"module-container-mini-rmbtnrow\\">";\r\n							echo "<div class=\\"module-container-mini-rmbtnlcol\\">&nbsp;</div>";\r\n							\r\n							if($ctype=="badge"){\r\n								echo "<div class=\\"module-container-mini-rmbtnrcol\\" onclick=\\"".@$wurl.$properties->PADMAIN."/blog/badges/".$badgeid."#{$id}\\"><a href=\\"".@$wurl.$properties->PADMAIN."/blog/badges/".$badgeid."#{$id}\\">Check it out!</a></div>";\r\n							} else {							\r\n								echo "<div class=\\"module-container-mini-rmbtnrcol\\" onclick=\\"".@$wurl.$properties->PADMAIN."/blog/permalink/".$blog_entry_year."/".$blog_entry_month."/".$blog_entry_day."/".converter($properties,$blog_title,''url'',''to'')."#{$id}\\"><a href=\\"".@$wurl.$properties->PADMAIN."/blog/permalink/".$blog_entry_year."/".$blog_entry_month."/".$blog_entry_day."/".converter($properties,$blog_title,''url'',''to'')."#{$id}\\">Check it out!</a></div>";\r\n							}\r\n						echo "</div>";\r\n					echo "</div>";\r\n				}\r\n			}\r\n		echo "</div>";\r\n	echo "</div>";\r\n	echo "<div class=\\"module-container-mini-separator\\"></div>";\r\necho "</div>";', 'blog', 'sidebar', 1, '', 'on', 'no', 'Published');
INSERT INTO `h_pages_modules` (`id`, `arr`, `launchpad`, `title`, `mini_title`, `toggle_title`, `contents`, `page`, `type`, `sidebar`, `footer_section`, `toggle_visible`, `is_searchable`, `status`) VALUES
(26, 2, 'padmain', 'COMMENTS', '// What others say', 'on', 'echo "<div class=\\"blog-hp-container-title\\">Blog</div>";\r\necho "<div class=\\"module-container-mini\\">";\r\n	echo "<div class=\\"module-container-mini-row\\">";\r\n		\r\n		echo "<div class=\\"module-container-mini-lcol\\">";\r\n			/* CUSTOM CODE GOES HERE */\r\n			$GET_LATEST_BLOG_COMMENTS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_comments WHERE status=''Approved'' ORDER BY dateandtime DESC LIMIT 2") or die(''uh oh! ''.mysql_error());\r\n			if(mysql_num_rows($GET_LATEST_BLOG_COMMENTS)<1){\r\n				echo "<div class=\\"module-container-mini-content\\">No comments found...:(</div>";\r\n			} else {\r\n				while($FETCH_LATEST_BLOG_COMMENTS=mysql_fetch_array($GET_LATEST_BLOG_COMMENTS)){\r\n					$id=$FETCH_LATEST_BLOG_COMMENTS[''id''];\r\n					$yname=$FETCH_LATEST_BLOG_COMMENTS[''yname''];\r\n					$title=$FETCH_LATEST_BLOG_COMMENTS[''title''];\r\n					$dateandtime=$FETCH_LATEST_BLOG_COMMENTS[''dateandtime''];\r\n					$content=$FETCH_LATEST_BLOG_COMMENTS[''content''];\r\n					$entry_id=$FETCH_LATEST_BLOG_COMMENTS[''entry_id''];\r\n					$ctype=$FETCH_LATEST_BLOG_COMMENTS[''ctype''];\r\n				\r\n					//make dateandtime\r\n					//0000-00-00\r\n					//0123456789\r\n					$blog_c_year  = substr($dateandtime,0,4);\r\n					$blog_c_month = substr($dateandtime,5,2);\r\n					$blog_c_day   = substr($dateandtime,8,2);\r\n					\r\n					//determine month					\r\n					if($blog_c_month=="01"){$blog_c_month_full="Jan";}\r\n					if($blog_c_month=="02"){$blog_c_month_full="Feb";}\r\n					if($blog_c_month=="03"){$blog_c_month_full="Mar";}\r\n					if($blog_c_month=="04"){$blog_c_month_full="Apr";}\r\n					if($blog_c_month=="05"){$blog_c_month_full="May";}\r\n					if($blog_c_month=="06"){$blog_c_month_full="Jun";}\r\n					if($blog_c_month=="07"){$blog_c_month_full="Jul";}\r\n					if($blog_c_month=="08"){$blog_c_month_full="Aug";}\r\n					if($blog_c_month=="09"){$blog_c_month_full="Sep";}\r\n					if($blog_c_month=="10"){$blog_c_month_full="Oct";}\r\n					if($blog_c_month=="11"){$blog_c_month_full="Nov";}\r\n					if($blog_c_month=="12"){$blog_c_month_full="Dec";}\r\n				\r\n					//convert dateandtime into a better looking string\r\n					$dateandtime = $blog_c_month . " " . $blog_c_day . ", " . $blog_c_year;\r\n					$dateandtime_m = $blog_c_month;\r\n					$dateandtime_m_full = $blog_c_month_full;\r\n					$dateandtime_d = $blog_c_day;\r\n					$dateandtime_y = $blog_c_year;\r\n					\r\n					$GET_LATEST_BLOG_ENTRIES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE id=''$entry_id''") or die(''uh oh! ''.mysql_error());\r\n					while($FETCH_LATEST_BLOG_ENTRIES=mysql_fetch_array($GET_LATEST_BLOG_ENTRIES)){\r\n						$dateandtime=$FETCH_LATEST_BLOG_ENTRIES[''dateandtime''];\r\n						$blog_title=$FETCH_LATEST_BLOG_ENTRIES[''title''];\r\n					}\r\n					\r\n					$blog_entry_year  = substr($dateandtime,0,4);\r\n					$blog_entry_month = substr($dateandtime,5,2);\r\n					$blog_entry_day   = substr($dateandtime,8,2);\r\n					\r\n					if($blog_entry_month=="01"){$blog_entry_month_full="Jan";}\r\n					if($blog_entry_month=="02"){$blog_entry_month_full="Feb";}\r\n					if($blog_entry_month=="03"){$blog_entry_month_full="Mar";}\r\n					if($blog_entry_month=="04"){$blog_entry_month_full="Apr";}\r\n					if($blog_entry_month=="05"){$blog_entry_month_full="May";}\r\n					if($blog_entry_month=="06"){$blog_entry_month_full="Jun";}\r\n					if($blog_entry_month=="07"){$blog_entry_month_full="Jul";}\r\n					if($blog_entry_month=="08"){$blog_entry_month_full="Aug";}\r\n					if($blog_entry_month=="09"){$blog_entry_month_full="Sep";}\r\n					if($blog_entry_month=="10"){$blog_entry_month_full="Oct";}\r\n					if($blog_entry_month=="11"){$blog_entry_month_full="Nov";}\r\n					if($blog_entry_month=="12"){$blog_entry_month_full="Dec";}\r\n				\r\n					//convert dateandtime into a better looking string\r\n					$dateandtime_m = $blog_entry_month;\r\n					$dateandtime_d = $blog_entry_day;\r\n					$dateandtime_y = $blog_entry_year;\r\n				\r\n					if($ctype=="badge"){\r\n						//get the category\r\n						$GET_BLOG_CATEGORY=mysql_query("SELECT * FROM {$properties->DB_PREFIX}badges WHERE id=''{$entry_id}''") or die(''uh oh! ''.mysql_error());\r\n						while($FETCH_BLOG_CATEGORY=mysql_fetch_array($GET_BLOG_CATEGORY)){\r\n						 $category=$FETCH_BLOG_CATEGORY[''name''];\r\n						 $badgeid=$FETCH_BLOG_CATEGORY[''id''];\r\n						}\r\n					} else {\r\n						//get the category\r\n						$GET_BLOG_CATEGORY=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE id=''{$entry_id}''") or die(''uh oh! ''.mysql_error());\r\n						while($FETCH_BLOG_CATEGORY=mysql_fetch_array($GET_BLOG_CATEGORY)){\r\n						 $category=$FETCH_BLOG_CATEGORY[''category''];\r\n						}	\r\n					}\r\n					\r\n					//convert and get the category\r\n					$GET_BLOG_CATEGORY_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_categories WHERE id=''{$category}''") or die(''uh oh! ''.mysql_error());\r\n					while($FETCH_BLOG_CATEGORY_INFO=mysql_fetch_array($GET_BLOG_CATEGORY_INFO)){\r\n					 $category=$FETCH_BLOG_CATEGORY_INFO[''name''];					 \r\n					}\r\n					\r\n					//set author to uname from db\r\n					echo "<div class=\\"module-container-mini-title\\">".$title."</div> ";\r\n					echo "<div class=\\"module-container-mini-author\\">by " . $yname . "</div>";\r\n					\r\n					if($ctype=="badge"){\r\n						echo "<div class=\\"module-container-mini-category\\">posted on " . "<a href=\\"".@$wurl.$properties->PADMAIN."/blog/badges/".$badgeid."#top\\">" . $category . "</a></div>";\r\n					} else {\r\n						echo "<div class=\\"module-container-mini-category\\">posted in " . "<a href=\\"".@$wurl.$properties->PADMAIN."/blog/category/".converter($properties,$category,''url'',''to'')."#top\\">" . $category . "</a></div>";\r\n					}\r\n					\r\n					echo "<div class=\\"module-container-mini-content\\">".substr(converter($properties,$content,''previewarticle'',''to''),0,100)."...</div>";					\r\n					echo "<div class=\\"module-container-mini-readmorebtn\\">";\r\n						echo "<div class=\\"module-container-mini-rmbtnrow\\">";\r\n							echo "<div class=\\"module-container-mini-rmbtnlcol\\">&nbsp;</div>";\r\n							\r\n							if($ctype=="badge"){\r\n								echo "<div class=\\"module-container-mini-rmbtnrcol\\" onclick=\\"".@$wurl.$properties->PADMAIN."/blog/badges/".$badgeid."#{$id}\\"><a href=\\"".@$wurl.$properties->PADMAIN."/blog/badges/".$badgeid."#{$id}\\">Check it out!</a></div>";\r\n							} else {							\r\n								echo "<div class=\\"module-container-mini-rmbtnrcol\\" onclick=\\"".@$wurl.$properties->PADMAIN."/blog/permalink/".$blog_entry_year."/".$blog_entry_month."/".$blog_entry_day."/".converter($properties,$blog_title,''url'',''to'')."#{$id}\\"><a href=\\"".@$wurl.$properties->PADMAIN."/blog/permalink/".$blog_entry_year."/".$blog_entry_month."/".$blog_entry_day."/".converter($properties,$blog_title,''url'',''to'')."#{$id}\\">Check it out!</a></div>";\r\n							}\r\n						echo "</div>";\r\n					echo "</div>";\r\n				}\r\n			}\r\n		echo "</div>";\r\n	echo "</div>";\r\n	echo "<div class=\\"module-container-mini-separator\\"></div>";\r\necho "</div>";', 'portfoliohome', 'sidebar', 1, '', 'on', 'no', 'Published'),
(33, 1, 'padmain', 'What am I?', '', 'on', '$GET_USER=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE id=''1''") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_USER=mysql_fetch_array($GET_USER)){\r\n	$uname=$FETCH_USER[''uname''];\r\n	$fname=$FETCH_USER[''fname''];\r\n	$lname=$FETCH_USER[''lname''];\r\n	$avatar=$FETCH_USER[''avatar''];\r\n	$gender=$FETCH_USER[''gender''];\r\n}\r\necho "<div id=\\"footer-box1-container\\">\r\n	<div id=\\"fb1c-row\\">\r\n		<div id=\\"fb1c-leftcol\\">\r\n			";\r\n			if($avatar=="" || $avatar=="male" || $avatar=="female" || $avatar=="other"){\r\n				/* NO AVATAR; DISPLAY BASED ON GENDER */\r\n				switch($gender){\r\n					case ''male'':\r\n						echo "<img src=\\"".$WEBSITE_URL.$THEME_NAME."images/profile_male.png\\" width=\\"75\\" height=\\"75\\" alt=\\"".$uname."''s profile\\" />";\r\n					break;\r\n					\r\n					case ''female'':\r\n						echo "<img src=\\"".$WEBSITE_URL.$THEME_NAME."images/profile_female.png\\" width=\\"75\\" height=\\"75\\" alt=\\"".$uname."''s profile\\" />";\r\n					break;\r\n					\r\n					case ''other'':\r\n						echo "<img src=\\"".$WEBSITE_URL.$THEME_NAME."images/profile_other.png\\" width=\\"75\\" height=\\"75\\" alt=\\"".$uname."''s profile\\" />";\r\n					break;\r\n				}\r\n			} else {\r\n				/* AVATAR FOUND */\r\n				echo "<img src=\\"".$WEBSITE_URL."includes/public/avatars/".$avatar.".png\\" width=\\"75\\" height=\\"75\\" alt=\\"".$uname."''s Avatar\\" title=\\"".$uname."''s Avatar\\" />";\r\n			}\r\n			echo "\r\n		</div>\r\n		<div id=\\"fb1c-rightcol\\">\r\n			<p style=\\"color:black;\\">JELLY stands for Just an Essential Liberating Library for You and is a fully customizable CMS that allows you to easily start any website campaign and receive top quality SEO and UX Optimization <a href=\\"".$WEBSITE_URL.$properties->PADMAIN."/about\\" class=\\"footer-btn\\">LEARN MORE</a></p>\r\n		</div>\r\n	</div>\r\n</div>";', '', 'footer', 0, 'left', 'on', 'no', 'Published'),
(34, 1, 'padmain', 'Nat4an says...', '', 'on', 'echo "<div id=\\"status-updates-container\\">\r\n	<div id=\\"s-u-c-row\\">\r\n		<div id=\\"s-u-c-leftcol\\">\r\n			\r\n		</div>\r\n		<div id=\\"s-u-c-rightcol\\">";\r\n			echo "<script type=\\"text/javascript\\">\r\n			jQuery(function($){\r\n				$(\\".tweet-main-hp\\").tweet({\r\n					username: \\"".getGlobalVars($properties,''main_twitter'')."\\",\r\n					join_text: \\"auto\\",\r\n					avatar_size: ".getGlobalVars($properties,''main_twitter_avatar_size'').",\r\n					count: ".getGlobalVars($properties,''main_twitter_count'').",\r\n					auto_join_text_default: \\"".getGlobalVars($properties,''main_twitter_auto_join_text_default'')."\\", \r\n					auto_join_text_ed: \\"".getGlobalVars($properties,''main_twitter_auto_join_text_ed'')."\\",\r\n					auto_join_text_ing: \\"".getGlobalVars($properties,''main_twitter_auto_join_text_ing'')."\\",\r\n					auto_join_text_reply: \\"".getGlobalVars($properties,''main_twitter_auto_join_text_reply'')."\\",\r\n					auto_join_text_url: \\"".getGlobalVars($properties,''main_twitter_auto_join_text_url'')."\\",\r\n					loading_text: \\"".getGlobalVars($properties,''main_twitter_loading_text'')."\\"\r\n				});\r\n			});\r\n			</script>\r\n			<div class=\\"tweet-main-hp\\"></div>\r\n			<a href=\\"https://twitter.com/".getGlobalVars($properties,''main_twitter'')."\\" class=\\"dark-big-url\\" target=\\"_blank\\">Follow @".getGlobalVars($properties,''main_twitter'')."</a>\r\n			";\r\n		echo "</div>\r\n	</div>\r\n</div>"; ', '', 'footer', 0, 'right', 'off', 'no', 'Published'),
(35, 1, 'padmain', 'Recent Posts', '', 'on', '$PADINFO=$properties->PADMAIN;\r\n$GET_BLOG_ENTRIES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE status=''Published'' ORDER BY dateandtime DESC LIMIT 2") or die(''uh oh! ''.mysql_error());\r\n/* START BUILDING THE BLOG LIST */\r\necho "<div class=\\"module-container-mini-footer\\">";	\r\necho "<div class=\\"module-container-mini-footer-row\\">";			\r\necho "<div class=\\"module-container-mini-footer-lcol\\">";\r\nwhile($FETCH_BLOG_ENTRIES=mysql_fetch_array($GET_BLOG_ENTRIES)){\r\n	$id=$FETCH_BLOG_ENTRIES[''id''];\r\n	$title=$FETCH_BLOG_ENTRIES[''title''];\r\n	$content=$FETCH_BLOG_ENTRIES[''content''];\r\n	$author=$FETCH_BLOG_ENTRIES[''author''];\r\n	$category=$FETCH_BLOG_ENTRIES[''category''];\r\n	$tags=$FETCH_BLOG_ENTRIES[''tags''];\r\n	$dateandtime=$FETCH_BLOG_ENTRIES[''dateandtime''];\r\n\r\n	//make dateandtime\r\n	//0000-00-00\r\n	//0123456789\r\n	$blog_entry_year  = substr($dateandtime,0,4);\r\n	$blog_entry_month = substr($dateandtime,5,2);\r\n	$blog_entry_day   = substr($dateandtime,8,2);\r\n	\r\n	if($blog_entry_month=="01"){$blog_entry_month_full="Jan";}\r\n	if($blog_entry_month=="02"){$blog_entry_month_full="Feb";}\r\n	if($blog_entry_month=="03"){$blog_entry_month_full="Mar";}\r\n	if($blog_entry_month=="04"){$blog_entry_month_full="Apr";}\r\n	if($blog_entry_month=="05"){$blog_entry_month_full="May";}\r\n\r\n	if($blog_entry_month=="06"){$blog_entry_month_full="Jun";}\r\n	if($blog_entry_month=="07"){$blog_entry_month_full="Jul";}\r\n	if($blog_entry_month=="08"){$blog_entry_month_full="Aug";}\r\n	if($blog_entry_month=="09"){$blog_entry_month_full="Sep";}\r\n	if($blog_entry_month=="10"){$blog_entry_month_full="Oct";}\r\n	if($blog_entry_month=="11"){$blog_entry_month_full="Nov";}\r\n	if($blog_entry_month=="12"){$blog_entry_month_full="Dec";}\r\n\r\n	//convert dateandtime into a better looking string\r\n	$dateandtime = $blog_entry_month . "-" . $blog_entry_day . "-" . $blog_entry_year;\r\n	$dateandtime_m = $blog_entry_month;\r\n	$dateandtime_m_full = $blog_entry_month_full;\r\n	$dateandtime_d = $blog_entry_day;\r\n	$dateandtime_y = $blog_entry_year;\r\n					\r\n		//the title\r\n		@$the_title="";\r\n		if(strlen($title)>20){$the_title=substr($title,0,21)."...";}else{$the_title=$title;}\r\n		echo "<div class=\\"module-container-mini-footer-title\\">";\r\n			echo "<a href=\\"".$WEBSITE_URL.$PADINFO."/blog/permalink/".$blog_entry_year."/".$blog_entry_month."/".$blog_entry_day."/".converter($properties,$title,''url'',''to'')."#top\\" onclick=\\"window.location.href=''".$WEBSITE_URL.$PADINFO."/blog/permalink/".$blog_entry_year."/".$blog_entry_month."/".$blog_entry_day."/".converter($properties,$title,''url'',''to'')."''#top\\">".$the_title." (".$dateandtime.")</a>";\r\n		echo "</div>";\r\n	\r\n}\r\necho "</div>";\r\necho "</div>";		\r\necho "</div>";\r\n/* END BUILDING BLOG LIST */', '', 'footer', 0, 'right', 'off', 'no', 'Published'),
(36, 1, 'padmain', 'Social Links', '', 'on', 'if(getGlobalVars($properties,"sociallinks_type")=="carousel"){\r\n	/* JQUERY CAROUSEL LINKS */\r\n	echo "<script type=\\"text/javascript\\">\r\n	function social_sites_initCallback(carousel){\r\n		// Disable autoscrolling if the user clicks the prev or next button.\r\n		carousel.buttonNext.bind(''click'', function() {\r\n			carousel.startAuto(0);\r\n		});\r\n	\r\n		carousel.buttonPrev.bind(''click'', function() {\r\n			carousel.startAuto(0);\r\n		});\r\n	\r\n		// Pause autoscrolling if the user moves with the cursor over the clip.\r\n		carousel.clip.hover(function() {\r\n			carousel.stopAuto();\r\n		}, function() {\r\n			carousel.startAuto();\r\n		});\r\n	}\r\n	\r\n	jQuery(document).ready(function() {\r\n		jQuery(''#social-sites'').jcarousel({\r\n			auto: ".getGlobalVars($properties,''sociallinks_jcarousel_auto'').",\r\n			wrap: ''".getGlobalVars($properties,''sociallinks_jcarousel_wrap'')."'',\r\n			scroll: ".getGlobalVars($properties,''sociallinks_jcarousel_scrollamt'').",\r\n			initCallback: social_sites_initCallback\r\n		});\r\n	});\r\n	</script>\r\n	";\r\n	\r\n	/* GET SKINID */\r\n	$GET_SKIN_ID=mysql_query("SELECT * FROM {$properties->DB_PREFIX}jc_themes WHERE id=''".getGlobalVars($properties,"sociallinks_theme")."''");\r\n	if(mysql_num_rows($GET_SKIN_ID)<1){\r\n		/* NOT THERE */\r\n	} else {\r\n		while($FETCH_SKIN_ID=mysql_fetch_array($GET_SKIN_ID)){\r\n			$skinIDname=$FETCH_SKIN_ID[''name''];\r\n		}\r\n	}\r\n	\r\n	echo "<ul id=\\"social-sites\\" class=\\"jcarousel-skin-".$skinIDname."\\">";\r\n	/* GET SOCIAL SITES */\r\n	$GET_SOCIAL_SITES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}social_sites ORDER BY name");\r\n	if(mysql_num_rows($GET_SOCIAL_SITES)<1){\r\n		echo "<li>I''m not that social...:(</li>";	\r\n	} else {\r\n		while($FETCH_SOCIAL_SITES=mysql_fetch_array($GET_SOCIAL_SITES)){\r\n			?><li><a href="<?php echo $FETCH_SOCIAL_SITES[''url''];?>" target="_blank"><img src="<?php echo $WEBSITE_URL;?><?php echo $NEW_PATH_TO_THEME_ASSETS;?>images/beingsocial/png/<?php echo $FETCH_SOCIAL_SITES[''image''];?>.png" width="50" height="50" alt="" /></a></li><?php\r\n		}\r\n	}\r\n	echo "</ul>";\r\n} else if(getGlobalVars($properties,"sociallinks_type")=="grfx"){\r\n	/* COOL GRAPHICALLY MADE JQUERY SOCIAL LINKS */\r\n	/* GET SOCIAL SITES */\r\n	$GET_SOCIAL_SITES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}social_sites ORDER BY name");\r\n	if(mysql_num_rows($GET_SOCIAL_SITES)<1){\r\n		echo "I''m not that social...:(";\r\n	} else {\r\n		while($FETCH_SOCIAL_SITES=mysql_fetch_array($GET_SOCIAL_SITES)){\r\n			?>                        \r\n            <a href="<?php echo $FETCH_SOCIAL_SITES[''url''];?>" target="_blank"><img src="<?php echo $WEBSITE_URL;?><?php echo $NEW_PATH_TO_THEME_ASSETS;?>images/beingsocial/png/<?php echo $FETCH_SOCIAL_SITES[''image''];?>.png" width="50" height="50" alt="<?php echo $FETCH_SOCIAL_SITES[''name''];?>" /></a>\r\n            \r\n            \r\n            <?php\r\n		}\r\n	}\r\n}', '', 'footer', 0, 'mid', 'off', 'no', 'Published'),
(38, 7, 'padmain', 'Tag Cloud', '', 'on', '/* PUT ALL TAG INFOMATION HERE */\r\n$GET_BEGS_FROM	= "blog,"; //work,a-z-list-reviews,\r\n$GET_TAGS_FROM	= "blog_entries,"; //work_projects,pages_af_atoz_entries,\r\n$GET_PADS_FROM	= $properties->PADMAIN.","; //.$properties->PADMAIN.",".$properties->PAD1.","\r\nif($_GET[''meta'']==""){\r\n	/* NO WHERE */\r\n	$TAGS_WHERE		= "";\r\n	$TAGS_WHERE		= " WHERE status=''Published'',";\r\n} else {\r\n	/* DOING WHERE */\r\n	//fetch the tagcloud materials from blog\r\n	$TAGS_WHERE		= "";\r\n	$tc_entry_id=build_pname_page(''tagcloudentryid'',$properties,$PADINFO,$page,$credentials,$wurl,$pname,$pname_special,$pname_uri,$display_user,$PNAME_PUBLISHED_NAME,$NEW_PATH_TO_THEME_ASSETS);\r\n	$TAGS_WHERE		= " WHERE id={$tc_entry_id},";	\r\n}\r\n/* END PUT ALL TAG INFOMATION HERE */\r\n\r\n/* ------------------------------------------------------------------------------------------------------------------------ */\r\n/*                         DO NOT EDIT BELOW HERE OR YOU WILL BREAK IT */\r\n/* ------------------------------------------------------------------------------------------------------------------------ */\r\nerror_reporting(0);\r\necho "<style type=\\"text/css\\">";\r\necho "#module-mini-a-container-contents a {";\r\necho "text-decoration: none;";\r\necho "color: white;";\r\necho "}";\r\necho "#module-mini-a-container-contents a:hover {";\r\necho "text-decoration: underline;";\r\necho "}";\r\necho "</style>";\r\n@$begstagspads="";\r\n\r\n/* DETERMINE THE WEBSITE_URL */\r\nif($_SERVER[''HTTP_HOST'']=="localhost"){$WEBSITE_URL=$properties->WEBSITE_TEST_URL;}else{$WEBSITE_URL=$properties->WEBSITE_REMO_URL;}\r\n\r\n//explode the list(s)\r\n$GET_BEGS_FROM_LIST=explode(",",$GET_BEGS_FROM);\r\n$GET_TAGS_FROM_LIST=explode(",",$GET_TAGS_FROM);\r\n$GET_PADS_FROM_LIST=explode(",",$GET_PADS_FROM);\r\n$TAGS_WHERE_LIST=explode(",",$TAGS_WHERE);\r\n\r\nfor($i=0; $i<count($GET_TAGS_FROM_LIST)-1; $i++){\r\n	$GET_TAGS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$GET_TAGS_FROM_LIST[$i]."".$TAGS_WHERE_LIST[$i]."") or die(''uh oh! ''.mysql_error());\r\n	while($FETCH_TAGS=mysql_fetch_array($GET_TAGS)){\r\n		//will produce: blog::tagname::pad,work::tagname::pad,\r\n		$tags=$FETCH_TAGS[''tags''];		\r\n	}\r\n	$TAG_LIST=explode(",",$tags);\r\n	for($in=0; $in<count($TAG_LIST); $in++){\r\n		$begstagspads.=$GET_BEGS_FROM_LIST[$i]."::".$TAG_LIST[$in]."::".$GET_PADS_FROM_LIST[$i].",";\r\n	}\r\n}\r\n\r\n/* START BUILDING THE TAG LIST */\r\necho "<div id=\\"module-mini-container\\" style=\\"padding: 10px;\\">";\r\n	echo "<div id=\\"module-mini-container-crow\\">";			\r\n		echo "<div id=\\"module-mini-container-rcol\\">";\r\n			echo "<div id=\\"module-mini-a-container-contents\\" style=\\"text-align:justify;word-wrap:break-word;\\">";						\r\n			@$font_colors="000000,333333,666666,999999,";\r\n			@$font_colors_list=explode(",",$font_colors);\r\n			@$font_size_from=16;\r\n			@$font_size_to=35;\r\n			@$begstagspads_list=explode(",",$begstagspads);\r\n			@$amount_to_display=getGlobalVars($properties,''tagcloud_count'');\r\n			@$start=rand(0,count($begstagspads_list));\r\n			@$end=$start+$amount_to_display+1;\r\n			@$ii;\r\n			for($ii=$start; $ii<=$end; $ii++){\r\n				$begtagpad=explode("::",$begstagspads_list[$ii]);\r\n				$beg=$begtagpad[0];\r\n				$tag=$begtagpad[1];\r\n				$pad=$begtagpad[2];\r\n				if($ii == $amount_to_display){\r\n					echo "<a style=\\"font-size:".rand($font_size_from,$font_size_to)."px;color: #".$font_colors_list[rand(0,count($font_colors_list))]." !important;\\" href=\\"".$WEBSITE_URL.$pad."/".$beg."/tag/".converter($properties,$tag,''url'',''to'')."#top\\" onclick=\\"window.location.href=''".$WEBSITE_URL.$pad."/".$beg."/tag/".converter($properties,$tag,''url'',''to'')."#top''\\">".$tag."</a>";\r\n				} else {\r\n					echo "<a style=\\"font-size:".rand($font_size_from,$font_size_to)."px;;color: #".$font_colors_list[rand(0,count($font_colors_list))]." !important;\\" href=\\"".$WEBSITE_URL.$pad."/".$beg."/tag/".converter($properties,$tag,''url'',''to'')."#top\\" onclick=\\"window.location.href=''".$WEBSITE_URL.$pad."/".$beg."/tag/".converter($properties,$tag,''url'',''to'')."#top''\\">".$tag."</a> ";\r\n				}\r\n			}\r\n			echo "</div>";\r\n		echo "</div>";\r\n	echo "</div>";		\r\necho "</div>";\r\n/* END BUILDING TAG LIST */', 'blog', 'sidebar', 1, '', 'off', 'no', 'Published'),
(52, 4, 'padmain', 'TWDB Tweets', '', 'on', 'echo "<div class=\\"blog-hp-container-title\\">Blog Tweets</div>";\r\necho "<div class=\\"module-container-mini-special\\">";\r\n	echo "<div class=\\"module-container-mini-special-leftcol\\">";						\r\n		/* CUSTOM CODE GOES HERE */\r\n		echo "<div class=\\"module-container-mini-special-content\\">		\r\n			";\r\n			echo "<script type=\\"text/javascript\\">\r\n				jQuery(function($){\r\n					$(\\".tweet-nfrta\\").tweet({\r\n						username: \\"".getGlobalVars($properties,"main_twitter")."\\",\r\n						join_text: \\"auto\\",\r\n						avatar_size: 32,\r\n						count: 3,\r\n						auto_join_text_default: \\" we said,\\", \r\n						auto_join_text_ed: \\" we\\",\r\n						auto_join_text_ing: \\" we were\\",\r\n						auto_join_text_reply: \\" we replied to\\",\r\n						auto_join_text_url: \\" we were checking out\\",\r\n						loading_text: \\"loading tweets...\\"\r\n					});\r\n				});\r\n			</script>\r\n			<div class=\\"tweet-nfrta\\"></div>\r\n                        <br />\r\n			<a href=\\"https://twitter.com/".getGlobalVars($properties,"main_twitter")."\\" class=\\"big-url\\" target=\\"_blank\\">Follow @".getGlobalVars($properties,"main_twitter")."</a>\r\n			";\r\n			echo "		\r\n		</div>";\r\n		/* END CUSTOM CODE GOES HERE */\r\n		\r\n	echo "</div>";\r\necho "</div>";', 'portfoliohome', 'sidebar', 1, '', 'off', 'no', 'Recovered'),
(53, 5, 'padmain', 'TWDB Photos', '', 'on', 'echo "<div class=\\"blog-hp-container-title\\">Blog</div>";\r\necho "<div class=\\"module-container-mini\\">";\r\n	/* CUSTOM CODE GOES HERE */\r\n	$BlogFlickrID=getGlobalVars($properties,"BlogFlickrID");\r\n	$BlogFlickrName=getGlobalVars($properties,"BlogFlickrName");\r\n			\r\n	if(strlen($BlogFlickrName)>15){$BlogFlickrNameReal=substr($BlogFlickrName,0,15)."...";}else{$BlogFlickrNameReal=$BlogFlickrName;}\r\n	echo "<div class=\\"module-container-mini-lcol\\">";						\r\n		echo "<div class=\\"module-container-mini-content\\">\r\n			";\r\n			echo "\r\n			<ul id=\\"cycle\\"></ul>\r\n			<script type=\\"text/javascript\\">\r\n			$(''#cycle'').jflickrfeed({\r\n				limit: 50,\r\n				qstrings: {\r\n					id: ''".$BlogFlickrID."''\r\n				},\r\n				itemTemplate: ''<li><img src=\\"{{image}}\\" alt=\\"{{title}}\\" width=\\"195\\" height=\\"255\\" /><div>{{title}}</div></li>''\r\n			}, function(data) {\r\n				$(''#cycle div'').hide();\r\n				$(''#cycle'').cycle({\r\n					timeout: 5000\r\n				});\r\n				$(''#cycle li'').hover(function(){\r\n					$(this).children(''div'').show();\r\n				},function(){\r\n					$(this).children(''div'').hide();\r\n				});\r\n			});\r\n			</script>\r\n			<br />\r\n			&nbsp;&nbsp;&nbsp;<a href=\\"http://instagram.com/".$BlogFlickrName."\\" class=\\"big-url\\" target=\\"_blank\\">Follow @".$BlogFlickrNameReal."</a>\r\n			<br />\r\n			<br />\r\n			";\r\n		echo "</div>";\r\n	echo "</div>";\r\n	/* END CUSTOM CODE GOES HERE */\r\necho "</div>";', 'portfoliohome', 'sidebar', 1, '', 'off', 'no', 'Published'),
(60, 1, 'padmain', 'Already Reported?', '', 'on', 'echo "<div class=\\"highlight-hp-container-title\\">Highlight</div>";\r\necho "<div class=\\"module-container-mini\\">";\r\n	echo "<div class=\\"module-container-mini-lcol\\">";						\r\n		/* CUSTOM CODE GOES HERE */\r\n		echo "<div class=\\"module-container-mini-content\\">If you have already reported a problem to us, then you can click on the &quot;report/checkstatus&quot; link. This link redirects you to that page that allows you to enter the ticket ID number and see what that status is on it. If you do not remember your ticket ID then it should be in your email. :)</div>";\r\n		/* END CUSTOM CODE GOES HERE */\r\n	echo "</div>";\r\necho "</div>";', 'report', 'sidebar', 1, '', 'on', 'no', 'Published'),
(68, 2, 'padmain', 'Earn 50% Commission', '', 'off', 'echo "<a href=\\"http://viralcycler.com/x/nat4ancorp\\" target=\\"_blank\\"><img src=\\"http://viralcycler.com/x/admin/images/1366041784.gif\\" border=0 alt=\\"\\"></a>";', '', 'footer', 0, 'right', 'off', 'no', 'Published'),
(72, 1, 'padmain', 'Get a Copy', '', 'on', '?>\r\n<style type="text/css">\r\n.download-center-h1 {\r\n    font-size: 1.5em;\r\n    font-weight: bold;\r\n}\r\n.download-center-h2 {\r\n    font-size: 1.25em;\r\n    font-weight: bold;\r\n    text-align: center;\r\n}\r\n.download-center-h3 {\r\n    font-size: 1em;\r\n    font-weight: normal;\r\n    text-align: center;\r\n}\r\n.download-link {\r\n    padding: 5px;\r\n    margin-bottom: 5px;\r\n    background: orange;\r\n    color: black;\r\n    cursor: pointer;\r\n    -moz-border-radius: 10px 10px 10px 10px;\r\n    -webkit-border-radius: 10px 10px 10px 10px;\r\n    -khtml-border-radius: 10px 10px 10px 10px;\r\n    border-radius: 10px 10px 10px 10px;\r\n    behavior: url(images/border-radius.htc);\r\n    text-align: center;\r\n}\r\n.download-link:hover {\r\n    background: blue;\r\n    color: white;\r\n}\r\n.download-center-p {\r\n    position: relative;\r\n    top: 7px; \r\n}\r\n</style>\r\n<?php\r\nglobal $WEBSITE_URL;\r\necho "<div class=\\"highlight-hp-container-title\\">Highlight</div>";\r\necho "<div class=\\"module-container-mini\\">";\r\n	echo "<div class=\\"module-container-mini-lcol\\">";						\r\n		/* CUSTOM CODE GOES HERE */\r\n		echo "\r\n                <div class=\\"module-container-mini-content\\">\r\n                    <center>\r\n                    <span class=\\"download-center-h1\\">Latest Release</span>\r\n                    <span class=\\"download-center-h3\\">1.0.41 (Strawberry)</span>   \r\n                    <div onclick=\\"window.location=''".$WEBSITE_URL."includes/public/uploads/Downloads/JELLY/jelly_cms_strawberry.zip''\\" class=\\"download-link\\">Download</div>\r\n                    <br />\r\n                    <span class=\\"download-center-h2\\">Older Releases</span>\r\n                    <span class=\\"download-center-p\\">\r\n                    <div onclick=\\"window.location=''".$WEBSITE_URL."includes/public/uploads/Downloads/JELLY/jelly_cms_grape.zip''\\" class=\\"download-link\\">1.0.4 (Grape)</div>\r\n                    <div onclick=\\"window.location=''".$WEBSITE_URL."includes/public/uploads/Downloads/JELLY/jelly_cms_apricot.zip''\\" class=\\"download-link\\">1.0.39 (Apricot)</div>\r\n                    <div onclick=\\"window.location=''".$WEBSITE_URL."includes/public/uploads/Downloads/JELLY/jelly_cms_mango.zip''\\" class=\\"download-link\\">1.0.38 (Mango)</div>\r\n                    </span>\r\n\r\n                    <br />\r\n                    <span class=\\"download-center-h2\\">BETA Releases</span>\r\n                    <span class=\\"download-center-p\\">\r\n                    <div onclick=\\"window.location=''".$WEBSITE_URL."files/tools/Frameworks/JELLY/jelly_cms_grapeb3.zip''\\" class=\\"download-link\\">1.0.4b3 (Grape)</div>\r\n                    <div onclick=\\"window.location=''".$WEBSITE_URL."files/tools/Frameworks/JELLY/jelly_cms_grapeb2.zip''\\" class=\\"download-link\\">1.0.4b2 (Grape)</div>\r\n                    <div onclick=\\"window.location=''".$WEBSITE_URL."files/tools/Frameworks/JELLY/jelly_cms_grapeb1.zip''\\" class=\\"download-link\\">1.0.4b1 (Grape)</div>\r\n                    <div onclick=\\"window.location=''".$WEBSITE_URL."files/tools/Frameworks/JELLY/jelly_cms_apricotb2.zip''\\" class=\\"download-link\\">1.0.39b2 (Apricot)</div>\r\n                    <div onclick=\\"window.location=''".$WEBSITE_URL."includes/public/uploads/Downloads/JELLY/jelly_cms_apricotb1.zip''\\" class=\\"download-link\\">1.0.39b1 (Apricot)</div>\r\n                    </span>\r\n                    </center>\r\n                </div>\r\n                ";\r\n		/* END CUSTOM CODE GOES HERE */\r\n	echo "</div>";\r\necho "</div>";', 'download', 'sidebar', 1, '', 'on', 'no', 'Published'),
(73, 1, 'padmain', 'Basic Module Template', '', 'on', 'echo "<div class=\\"highlight-hp-container-title\\">Template</div>";\r\necho "<div style=\\"padding:10px;\\">This is just a basic module template code thingy</div>";', 'page2', 'sidebar', 1, '', 'on', 'no', 'Published'),
(74, 1, 'padmain', 'Basic Module Template', '', 'on', 'echo "<div class=\\"highlight-hp-container-title\\">Template</div>";\r\necho "<div style=\\"padding:10px;\\">This is just a basic module template code thingy</div>";', 'page1', 'sidebar', 1, '', 'on', 'no', 'Published'),
(75, 1, 'padmain', 'Basic Module Template', '', 'on', 'echo "<div class=\\"highlight-hp-container-title\\">Template</div>";\r\necho "<div style=\\"padding:10px;\\">This is just a basic module template code thingy</div>";', 'page3', 'sidebar', 1, '', 'on', 'no', 'Published'),
(76, 1, 'padmain', 'Basic Module Template', '', 'on', 'echo "<div class=\\"highlight-hp-container-title\\">Template</div>";\r\necho "<div style=\\"padding:10px;\\">This is just a basic module template code thingy</div>";', 'page4', 'sidebar', 1, '', 'on', 'no', 'Published'),
(77, 1, 'padmain', 'Renders any code!', '', 'on', 'echo "<div class=\\"highlight-hp-container-title\\">Template</div>";\r\necho "<div style=\\"padding:10px;\\">You can put any amount of code (PHP/HTML/JS) into this module and make it your own!</div>";', 'page4', 'sidebar', 1, '', 'on', 'no', 'Published'),
(78, 1, 'padmain', 'Renders any code!', '', 'on', 'echo "<div class=\\"highlight-hp-container-title\\">Template</div>";\r\necho "<div style=\\"padding:10px;\\">You can put any amount of code (PHP/HTML/JS) into this module and make it your own!</div>";', 'page1', 'sidebar', 1, '', 'on', 'no', 'Published'),
(79, 2, 'padmain', '2 systems in 1!', '', 'on', 'echo "<div class=\\"highlight-hp-container-title\\">Template</div>";\r\necho "<div style=\\"padding:10px;\\">This CMS comes equipped with <a href=\\"https://github.com/nat4ancorp/MTS\\" target=\\"_blank\\" class=\\"black-url\\">MTS (Modular Ticketing System)</a> which is a ticketing and email system that captures end-users inputs as comments and queries. This is a versatile and unique all-in-one system that can help you capture the input of your visitors. You can set up CERS (Centralized Email Response System: another system that comes standard with this CMS) Messages that are interpreted by the system and send them out to the email the end-user inputs as well as send an email to the person being contacted.</div>";', 'page3', 'sidebar', 1, '', 'on', 'no', 'Published'),
(80, 2, 'padmain', 'What is PostSystem?', '', 'on', 'echo "<div class=\\"highlight-hp-container-title\\">Template</div>";\r\necho "<div style=\\"padding:10px;\\">PostSystem is embedded into this CMS and it is a modular system that can be used as a Blog or anything that you have dynamic content for. You can moderate and add content by utilizing the Posts tab on this cPanel.</div>";', 'page2', 'sidebar', 1, '', 'on', 'no', 'Published'),
(81, 1, 'padmain', 'Basic Module Template', '', 'on', 'echo "<div class=\\"highlight-hp-container-title\\">Template</div>";\r\necho "<div style=\\"padding:10px;\\">This is just a basic module template code thingy</div>";', 'basehome', 'sidebar', 1, '', 'on', 'no', 'Published'),
(82, 1, 'padmain', 'Basic MainContent Module Template', '', 'on', 'echo "<div style=\\"background:white;padding:10px;color:black;\\">This is just a basic module template code thingy. Did you know you can set up modules as main content items? All you do is go to the Page Modules section of the cPanel, then click Add new and set the Type as Main Content.</div>";', 'basehome', 'maincontent', 0, '', 'on', 'no', 'Published'),
(83, 1, 'padmain', 'Did you know?', '', 'on', 'echo "<div class=\\"highlight-hp-container-title\\">Template</div>";\r\necho "<div style=\\"padding:10px;\\">You can add/change what you want the search to search for by going to the Search section of this cPanel and adding what are known as Chapters and items for those chapters. The items are composed of code that renders using a plugin called SearchHelper.</div>";', 'search', 'sidebar', 1, '', 'on', 'no', 'Published'),
(84, 1, 'pad1', 'Basic MainContent Module Template', '', 'on', 'echo "<div style=\\"background:white;padding:10px;color:black;\\">This is just a basic module template code thingy. Did you know you can set up modules as main content items? All you do is go to the Page Modules section of the cPanel, then click Add new and set the Type as Main Content.</div>";', 'pad1home', 'maincontent', 0, '', 'on', 'no', 'Published');

-- --------------------------------------------------------

--
-- Table structure for table `h_queries_contact`
--

CREATE TABLE IF NOT EXISTS `h_queries_contact` (
  `ticket_id` varchar(300) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `poc` int(10) NOT NULL,
  `reason` int(10) NOT NULL,
  `contact_message` longtext NOT NULL,
  `extra_notes` longtext NOT NULL,
  `status` enum('Open','Escalated','Closed','Deleted','Recovered') NOT NULL DEFAULT 'Open',
  `dateandtime` datetime NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'no',
  `atlevel` int(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `h_queries_contact_reasons`
--

CREATE TABLE IF NOT EXISTS `h_queries_contact_reasons` (
  `rcode` int(10) NOT NULL AUTO_INCREMENT,
  `reason` varchar(100) NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`rcode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `h_queries_contact_reasons`
--

INSERT INTO `h_queries_contact_reasons` (`rcode`, `reason`, `is_searchable`) VALUES
(1, 'Hire Me/Us', 'no'),
(2, 'Let''s Talk', 'no'),
(3, 'Report a Bug', 'no'),
(4, 'I want my AD on your site', 'no'),
(5, 'Complain to Me/Us', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `h_queries_report`
--

CREATE TABLE IF NOT EXISTS `h_queries_report` (
  `ticket_id` varchar(300) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `poc` int(10) NOT NULL,
  `reason` int(10) NOT NULL,
  `contact_message` longtext NOT NULL,
  `extra_notes` longtext NOT NULL,
  `status` enum('Open','Escalated','Closed','Deleted','Recovered') NOT NULL DEFAULT 'Open',
  `dateandtime` datetime NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'no',
  `atlevel` int(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `h_queries_report_reasons`
--

CREATE TABLE IF NOT EXISTS `h_queries_report_reasons` (
  `rcode` int(10) NOT NULL AUTO_INCREMENT,
  `reason` varchar(100) NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`rcode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `h_queries_report_reasons`
--

INSERT INTO `h_queries_report_reasons` (`rcode`, `reason`, `is_searchable`) VALUES
(1, 'Report Fraudulent Activity', 'no'),
(2, 'Report a Bug', 'no'),
(3, 'Account Relation', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `h_queries_tmm`
--

CREATE TABLE IF NOT EXISTS `h_queries_tmm` (
  `ticket_id` varchar(300) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `poc` int(10) NOT NULL,
  `reason` int(10) NOT NULL,
  `contact_message` longtext NOT NULL,
  `extra_notes` longtext NOT NULL,
  `status` enum('Open','Escalated','Closed') NOT NULL DEFAULT 'Open',
  `dateandtime` datetime NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `h_queries_tmm_reasons`
--

CREATE TABLE IF NOT EXISTS `h_queries_tmm_reasons` (
  `rcode` int(10) NOT NULL AUTO_INCREMENT,
  `reason` varchar(100) NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`rcode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `h_queries_tmm_reasons`
--

INSERT INTO `h_queries_tmm_reasons` (`rcode`, `reason`, `is_searchable`) VALUES
(1, 'Hire Me', 'no'),
(2, 'Let''s Talk', 'no'),
(3, 'Complain to Me', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `h_search_chapters`
--

CREATE TABLE IF NOT EXISTS `h_search_chapters` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `launchpad_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `show_name` enum('yes','no') NOT NULL DEFAULT 'yes',
  `page` varchar(100) NOT NULL,
  `item_id` longtext NOT NULL,
  `chapter_id` longtext NOT NULL,
  `search_this` longtext NOT NULL,
  `item_single` longtext NOT NULL,
  `item_plural` longtext NOT NULL,
  `connector_single` longtext NOT NULL,
  `connector_plural` longtext NOT NULL,
  `ending_single` longtext NOT NULL,
  `ending_plural` longtext NOT NULL,
  `where_clause` longtext NOT NULL,
  `order_by` longtext NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'no',
  `for_lp` enum('all','pad1','pad2','pad3','pad4') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `h_search_chapters`
--

INSERT INTO `h_search_chapters` (`id`, `launchpad_id`, `name`, `show_name`, `page`, `item_id`, `chapter_id`, `search_this`, `item_single`, `item_plural`, `connector_single`, `connector_plural`, `ending_single`, `ending_plural`, `where_clause`, `order_by`, `is_searchable`, `for_lp`) VALUES
(2, 1, 'Apparatus', 'yes', 'a-z-list', '1,2,3,4,5,', '2,2,2,2,2,', 'users,users,users,users,users,', 'User,Writer,Moderator,Admin,BETA Tester,', 'Users,Writers,Moderators,Admins,BETA Testers,', 'matching,matching,matching,matching,matching,', 'matching,matching,matching,matching,matching,', '', '', 'type=''user'' AND fname LIKE (searchQuery) AND status=''active'' OR type=''user'' AND lname LIKE (searchQuery) AND status=''active'' OR type=''user'' AND uname LIKE (searchQuery) AND status=''active'',type=''writer'' AND fname LIKE (searchQuery) AND status=''active'' OR type=''writer'' AND lname LIKE (searchQuery) AND status=''active'' OR type=''writer'' AND uname LIKE (searchQuery) AND status=''active'',type=''mod'' AND fname LIKE (searchQuery) AND status=''active'' OR type=''mod'' AND lname LIKE (searchQuery) AND status=''active'' OR type=''mod'' AND uname LIKE (searchQuery) AND status=''active'',type=''admin'' AND fname LIKE (searchQuery) AND status=''active'' OR type=''admin'' AND lname LIKE (searchQuery) AND status=''active'' OR type=''admin'' AND uname LIKE (searchQuery) AND status=''active'',type=''beta'' AND fname LIKE (searchQuery) AND status=''active'' OR type=''beta'' AND lname LIKE (searchQuery) AND status=''active'' OR type=''beta'' AND uname LIKE (searchQuery) AND status=''active'',', 'uname,uname,uname,uname,uname,', 'yes', 'all'),
(4, 1, 'Pages', 'yes', 'portfolio', '1,', '4,', 'pages,', 'Page,', 'Pages,', ' with content that has ,', ' with contents that have ,', ' in it,', ' in them,', 'content_main LIKE (searchQuery) AND status=''Published'' OR content_main_code LIKE (searchQuery) AND status=''Published'' OR content_main_after_code LIKE (searchQuery) AND status=''Published'' OR content_sidebar LIKE (searchQuery) AND status=''Published'' OR content_sidebar_code LIKE (searchQuery) AND status=''Published'' OR content_sidebar_after_code LIKE (searchQuery) AND status=''Published'' OR content_sidebar2 LIKE (searchQuery) AND status=''Published'' OR content_sidebar_code2 LIKE (searchQuery) AND status=''Published'' OR content_sidebar_after_code2 LIKE (searchQuery) AND status=''Published''', 'page,', 'yes', 'all');

-- --------------------------------------------------------

--
-- Table structure for table `h_search_chapters_items`
--

CREATE TABLE IF NOT EXISTS `h_search_chapters_items` (
  `item_id` int(10) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `chapter_id` int(10) NOT NULL,
  `content` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_search_chapters_items`
--

INSERT INTO `h_search_chapters_items` (`item_id`, `item_name`, `chapter_id`, `content`) VALUES
(4, 'Apparatus : Admins matching', 2, '/* (Apparatus) (Admins matching) */\n/* YOU MIGHT HAVE TO SEARCH FOR THE PAD NAME AND CHANGE IT TO MATCH WHAT IS NEEDED */\n$pname="users";\n$pname_special="Users";\n$pname_uri="blog/user/";\n$display_user=false;\n$PADINFO=$properties->PADMAIN;\n$search_type="double"; /* entry, comment, single, double */\n/* ---------- DO NOT EDIT BELOW THIS LINE OR ELSE YOU WILL BREAK IT --------- */\ninclude("includes/private/bin/plugins/searchHelper/plugin.php");'),
(3, 'Apparatus : Moderators matching', 2, '/* (Apparatus) (Moderators matching) */\n/* YOU MIGHT HAVE TO SEARCH FOR THE PAD NAME AND CHANGE IT TO MATCH WHAT IS NEEDED */\n$pname="users";\n$pname_special="";\n$pname_uri="blog/user/";\n$display_user=false;\n$PADINFO=$properties->PADMAIN;\n$search_type="double"; /* entry, comment, single, double */\n/* ---------- DO NOT EDIT BELOW THIS LINE OR ELSE YOU WILL BREAK IT --------- */\ninclude("includes/private/bin/plugins/searchHelper/plugin.php");'),
(2, 'Apparatus : Writers matching', 2, '/* (Apparatus) (Writers matching) */\n/* YOU MIGHT HAVE TO SEARCH FOR THE PAD NAME AND CHANGE IT TO MATCH WHAT IS NEEDED */\n$pname="users";\n$pname_special="";\n$pname_uri="blog/user/";\n$display_user=false;\n$PADINFO=$properties->PADMAIN;\n$search_type="double"; /* entry, comment, single, double */\n/* ---------- DO NOT EDIT BELOW THIS LINE OR ELSE YOU WILL BREAK IT --------- */\ninclude("includes/private/bin/plugins/searchHelper/plugin.php");'),
(1, 'Apparatus : Users matching', 2, '/* (Apparatus) (Users matching) */\n/* YOU MIGHT HAVE TO SEARCH FOR THE PAD NAME AND CHANGE IT TO MATCH WHAT IS NEEDED */\n$pname="users";\n$pname_special="";\n$pname_uri="blog/user/";\n$display_user=false;\n$PADINFO=$properties->PADMAIN;\n$search_type="double"; /* entry, comment, single, double */\n/* ---------- DO NOT EDIT BELOW THIS LINE OR ELSE YOU WILL BREAK IT --------- */\ninclude("includes/private/bin/plugins/searchHelper/plugin.php");'),
(5, 'Apparatus : BETA Tester matching', 2, '/* (Apparatus) (BETA Tester matching) */\n/* YOU MIGHT HAVE TO SEARCH FOR THE PAD NAME AND CHANGE IT TO MATCH WHAT IS NEEDED */\n$pname="users";\n$pname_special="";\n$pname_uri="blog/user/";\n$display_user=false;\n$PADINFO=$properties->PADMAIN;\n$search_type="double"; /* entry, comment, single, double */\n/* ---------- DO NOT EDIT BELOW THIS LINE OR ELSE YOU WILL BREAK IT --------- */\ninclude("includes/private/bin/plugins/searchHelper/plugin.php");'),
(1, 'Pages : with contents', 4, '/* (Pages) (with contents) */\n/* YOU MIGHT HAVE TO SEARCH FOR THE PAD NAME AND CHANGE IT TO MATCH WHAT IS NEEDED */\n$pname="pages";\n$pname_special="Pages";\n$pname_uri="";\n$display_user=false;\n$PADINFO=$properties->PADMAIN;\n$search_type="single"; /* entry, comment, single, double */\n/* ---------- DO NOT EDIT BELOW THIS LINE OR ELSE YOU WILL BREAK IT --------- */\ninclude("includes/private/bin/plugins/searchHelper/plugin.php");');

-- --------------------------------------------------------

--
-- Table structure for table `h_security_questions`
--

CREATE TABLE IF NOT EXISTS `h_security_questions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `value` varchar(200) NOT NULL,
  `in_list` enum('yes','no') NOT NULL,
  `is_auto_q` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `h_security_questions`
--

INSERT INTO `h_security_questions` (`id`, `value`, `in_list`, `is_auto_q`) VALUES
(1, 'What is your favorite hobby', 'yes', 'no'),
(2, 'What is the last four of your Social Security Number', 'yes', 'no'),
(3, 'Where did you meet your spouse', 'yes', 'no'),
(4, 'What was the name of your first pet', 'yes', 'no'),
(5, 'Who is Jesus to you', 'yes', 'no'),
(6, 'What does 42 mean to you', 'yes', 'no'),
(7, 'What was your first job', 'yes', 'no'),
(8, 'What is your mother''s maiden name', 'yes', 'no'),
(9, 'What is your 4-digit PIN number', 'no', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `h_social_sites`
--

CREATE TABLE IF NOT EXISTS `h_social_sites` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `url` varchar(300) NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'yes',
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `h_social_sites`
--

INSERT INTO `h_social_sites` (`id`, `name`, `url`, `is_searchable`, `image`) VALUES
(1, 'Facebook', 'http://www.facebook.com/mrnat4an', 'yes', 'facebook'),
(4, 'Main Twitter', 'https://twitter.com/nat4ancorp', 'yes', 'twitter'),
(5, 'iPhoneography', 'http://instagram.com/thedarkerwhiteblog', 'yes', 'instagram'),
(6, 'Google Plus', 'https://plus.google.com/115647257330579481347/posts', 'yes', 'googleplus'),
(7, 'StumbleUpon', 'http://www.stumbleupon.com/stumbler/nat4ancorp', 'yes', 'stumbledupon'),
(8, 'RTA Foursquare', 'https://foursquare.com/roadtoangelo', 'yes', 'foursquare'),
(9, 'Freelancer Profile', 'https://www.freelancer.com/u/nat4ancorp.html', 'yes', 'freelancer'),
(10, 'LinkedIN', 'http://www.linkedin.com/pub/nathan-smyth/45/2a1/a93', 'yes', 'linkedin');

-- --------------------------------------------------------

--
-- Table structure for table `h_staff_types`
--

CREATE TABLE IF NOT EXISTS `h_staff_types` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_staff_types`
--

INSERT INTO `h_staff_types` (`id`, `name`) VALUES
(1, 'President and Head Webmaster'),
(2, 'Audio Admin'),
(3, 'Artist'),
(4, 'Web Admin'),
(5, 'Affiliate Recruiter (NON STAFF)');

-- --------------------------------------------------------

--
-- Table structure for table `h_tempsystem`
--

CREATE TABLE IF NOT EXISTS `h_tempsystem` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `ip` varchar(100) NOT NULL,
  `lptoggle` int(1) NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'no',
  `fb_like` enum('no','yes') NOT NULL DEFAULT 'no',
  `temp_session` varchar(500) NOT NULL,
  `themeID` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3200 ;

-- --------------------------------------------------------

--
-- Table structure for table `h_themes`
--

CREATE TABLE IF NOT EXISTS `h_themes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `pretty_name` varchar(100) NOT NULL,
  `type` enum('free','premium') NOT NULL,
  `endrun` enum('avail','test','not avail','') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `h_themes`
--

INSERT INTO `h_themes` (`id`, `name`, `pretty_name`, `type`, `endrun`) VALUES
(4, 'CleanOrange', 'CleanOrange', 'free', 'avail');

-- --------------------------------------------------------

--
-- Table structure for table `h_thumbs`
--

CREATE TABLE IF NOT EXISTS `h_thumbs` (
  `onpage` varchar(100) NOT NULL,
  `entryid` int(11) NOT NULL,
  `commentid` int(11) NOT NULL,
  `type` enum('like','dislike') NOT NULL,
  `uid` int(11) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `last_like` date NOT NULL,
  `thumbitem` enum('entry','comment','badge') NOT NULL DEFAULT 'entry',
  `foruid` int(11) NOT NULL,
  `badgeid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `h_users`
--

CREATE TABLE IF NOT EXISTS `h_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `gender` enum('male','female','other') NOT NULL DEFAULT 'other',
  `uname` varchar(100) NOT NULL,
  `upass` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `type` enum('user','writer','mod','admin','beta') NOT NULL,
  `head_admin` enum('yes','no') NOT NULL DEFAULT 'no',
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'yes',
  `staff_type` int(10) NOT NULL,
  `status` enum('active','pending','deleted','suspended','denied') NOT NULL,
  `security_question` int(10) NOT NULL,
  `security_answer` varchar(100) NOT NULL,
  `pin` int(4) NOT NULL,
  `why` longtext NOT NULL,
  `loggedin` enum('yes','no') NOT NULL DEFAULT 'no',
  `logged_ip` varchar(100) NOT NULL DEFAULT '',
  `logged_session` varchar(300) NOT NULL,
  `agree_to_tos` enum('yes','no') NOT NULL DEFAULT 'no',
  `suspended_reason` longtext NOT NULL,
  `tou_status` enum('agree','disagree') NOT NULL DEFAULT 'disagree',
  `in_site` enum('yes','no') NOT NULL DEFAULT 'no',
  `dateandtime_applied` datetime NOT NULL,
  `dateandtime_lastlogin` datetime NOT NULL,
  `notifications` enum('on','off') NOT NULL DEFAULT 'on',
  `is_webmaster` enum('yes','no') NOT NULL DEFAULT 'no',
  `how_to_display_name` enum('full','only username','only first name') NOT NULL DEFAULT 'full',
  `themeID` int(10) NOT NULL,
  `isIncludedInMTS` enum('no','yes') NOT NULL DEFAULT 'no',
  `fb_like` enum('no','yes') NOT NULL DEFAULT 'no',
  `level` int(10) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `bio` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `h_users`
--

INSERT INTO `h_users` (`id`, `fname`, `lname`, `gender`, `uname`, `upass`, `email`, `type`, `head_admin`, `is_searchable`, `staff_type`, `status`, `security_question`, `security_answer`, `pin`, `why`, `loggedin`, `logged_ip`, `logged_session`, `agree_to_tos`, `suspended_reason`, `tou_status`, `in_site`, `dateandtime_applied`, `dateandtime_lastlogin`, `notifications`, `is_webmaster`, `how_to_display_name`, `themeID`, `isIncludedInMTS`, `fb_like`, `level`, `avatar`, `bio`) VALUES
(1, 'Nathan', 'Smyth', 'other', 'mrnat4an', '08647ba01c76cab1e39f1a6a30feb8c720fa09a289ec54b55a1a4ee26b58c610', 'nat4ancorp@gmail.com', 'admin', 'yes', 'yes', 1, 'active', 6, 'badwolf', 4815, '', 'no', '', '', 'yes', '', 'agree', 'no', '0000-00-00 00:00:00', '2013-06-18 17:53:30', 'on', 'yes', 'only first name', 1, 'yes', 'yes', 3, 'power', ''),
(2, 'Benji', 'Zello', 'male', 'Benji_Zello', '36915484043374eb6eb4c577eeec0cc9d0ef19af56295c19c105257deee72d90', 'Benjizello@yahoo.com', 'admin', 'no', 'yes', 4, 'active', 0, '', 6391, 'HEAD ADMIN''S REFERRAL', 'no', '', '', 'no', 'lack of logging in, please get in touch with Nathan @ 210-863-8843 to reactivate it.', 'disagree', 'no', '2012-07-11 13:38:31', '2013-06-17 00:20:53', 'on', 'no', 'full', 3, 'no', 'no', 1, '', ''),
(3, 'Josh', 'Tyler', 'male', 'Snoopy', 'bad01ff1e1d50c3f9ae6805c5bf776cd93062224305d5fd27923182e86d1e581', 'Spartan082@gmail.com', 'admin', 'no', 'yes', 4, 'suspended', 0, '', 3928, 'HEAD ADMIN''S REFERRAL', 'no', '', '', 'no', 'lack of logging in, please get in touch with Nathan @ 210-863-8843 to reactivate it.', 'disagree', 'no', '2012-09-27 21:46:20', '0000-00-00 00:00:00', 'on', 'no', 'full', 3, 'no', 'no', 2, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `h_users_achievements`
--

CREATE TABLE IF NOT EXISTS `h_users_achievements` (
  `uid` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `date_received` datetime NOT NULL,
  `status` enum('unread','read') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
