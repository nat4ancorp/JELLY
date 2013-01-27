-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 06, 2012 at 10:40 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `thewife`
--

-- --------------------------------------------------------

--
-- Table structure for table `h_changelog`
--

CREATE TABLE IF NOT EXISTS `h_changelog` (
  `date` date NOT NULL,
  `content` longtext NOT NULL,
  `type` enum('UPDATE','CHANGE','REMOVE') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_changelog`
--

INSERT INTO `h_changelog` (`date`, `content`, `type`) VALUES
('2012-05-27', 'Started the new theme and added some colourful additions to this fine website.', 'UPDATE'),
('2012-05-30', 'Added 4 launchpads for the 4 different "inner websites". I need to fix the glitch when ever the page is zoomed the launchpad''s move. This is due to relative position on the % container divs. I have applied a "margin-right: -4px;" to the 1st, 2nd, and 3rd launchpad''s to offset it for now but there is still a blank space in the middle of 2 and 3 launchpad. I did add database support to the interface by making the navigation list dynamically load in.', 'UPDATE'),
('2012-05-31', 'Fixed the spaces in between the launchpad items by adding a "display: inline-table;". I started to add the blogging module stuff. Keep getting a weird thing that has to do with the wrap (or col) CSS markup where the text (content) is chopped off when doing "height=100%". Weird. Actually it does that on all the pages. When i take off the "height: 100%;" and put it to "height: auto" then it works but the container color is not white. :(', 'UPDATE'),
('2012-07-24', 'Uploaded this BETA version on my website, started to add some CSS &quot;Hacks&quot; for detecting different browsers and using the correct CSS versions of the site - work in progress, changed up the splash page, and that is it.', 'CHANGE'),
('2012-07-25', 'Added mod_rewrite support to web urls to make them prettier, starting putting together a Conditonal CSS script used by a freeware offline to coupe with capatibility, checked for validated markup by using W3C''s Markup Validation (got down to 12 errors :)). still cannot figure out why The Musik Maker tab disappears, did some MOD_REWRITE stuff that is static and needs to be dynamic, and that is it', 'UPDATE'),
('2012-08-03', 'I was able to, with the help from a coder friend, fix some glitches that seemed to be happening around the launchpad area, I cleaned up the code, messed around with the way the engine parses each page from the database, in fact I completely changed the page.php file to a much better approach for when you load pages dynamically from a db, I also stretched the error.php look (the one that loads error pages from the db), back to the way pages are parsed...you no longer need to add &quot;echo "&quot; stuff to the page. You simply just write in HTML code like you would any easy, normal webpage, and my coder friend was able to help me fix the overflow on the pages (where the page text use to cut off)...its fixed now! That''s it. :)', 'UPDATE'),
('2012-08-22', 'I have been working on re-creating the whole interface for this website! It now looks more designed and more like me. I changed the header, made it compatible in all major web browsers, and did some small changes here and there.', 'UPDATE'),
('2012-09-06', 'Tweaked all pages to where they are more designed. IE: I added the stylings to the sidebar to make em a bit better, updated the Pad looks, fixed the 100% column heights, added some stuff to the database, and that is about it', 'CHANGE');

-- --------------------------------------------------------

--
-- Table structure for table `h_check`
--

CREATE TABLE IF NOT EXISTS `h_check` (
  `Grade` enum('A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F+','F','F-') NOT NULL,
  `Overall Points` int(3) NOT NULL,
  `W3C_Validated` enum('invalid','valid') NOT NULL,
  `Deductions` float(10,3) NOT NULL,
  `Browser` enum('FF','IE 8','IE 7','IE 6','Chrome','Chrome Linux','Opera','Safari') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_check`
--

INSERT INTO `h_check` (`Grade`, `Overall Points`, `W3C_Validated`, `Deductions`, `Browser`) VALUES
('A-', 100, 'invalid', 3.001, 'FF');

-- --------------------------------------------------------

--
-- Table structure for table `h_errorpages`
--

CREATE TABLE IF NOT EXISTS `h_errorpages` (
  `code` varchar(200) NOT NULL,
  `content_main` longtext NOT NULL,
  `content_main_code` longtext NOT NULL,
  `content_main_after_code` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_errorpages`
--

INSERT INTO `h_errorpages` (`code`, `content_main`, `content_main_code`, `content_main_after_code`) VALUES
('404', '<h2>Uh Oh! I think I broke it!</h2>\r\n<p>The page you are requesting cannot be found on this server. You are seeing this because of one, or more, of the following reasons:</p>\r\n<ul>\r\n<li>You clicked a link that is no longer available.</li>\r\n<li>You changed something in the URL above to something that is not real.</li>\r\n<li>You are trying to hack us. In which case, that is highly frowned upon and you should now hang your head in shame and run<br>from this website because we are coming to get you!</li>\r\n<li>An actual page got changed by the webadmin and you clicked on a remnant of a page link (rarely happens).</li>\r\n</ul>\r\n<p>If you feel this is a mistake, then contact us [INSERT YOUR CONTACT PAGE HERE] and we will fix it!</p>', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `h_launchpads`
--

CREATE TABLE IF NOT EXISTS `h_launchpads` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `short` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `h_launchpads`
--

INSERT INTO `h_launchpads` (`id`, `name`, `short`) VALUES
(1, 'Main', 'padmain'),
(2, 'Pad 1', 'pad1'),
(3, 'Pad 2', 'pad2'),
(4, 'Pad 3', 'pad3'),
(5, 'Pad 4', 'pad4');

-- --------------------------------------------------------

--
-- Table structure for table `h_links`
--

CREATE TABLE IF NOT EXISTS `h_links` (
  `url` varchar(500) NOT NULL,
  `target` enum('_blank','_self','_parent','_top') NOT NULL,
  `title` varchar(200) NOT NULL,
  `type` enum('blogroll') NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_links`
--

INSERT INTO `h_links` (`url`, `target`, `title`, `type`, `name`) VALUES
('http://anthonyvenable110.wordpress.com/', '_blank', 'A guy who talks about anything computer-related or food-related!!!', 'blogroll', 'AnthonyVenable''s Edible Tech Blog'),
('http://chrisneighbors.com/', '_blank', 'Personal Finance and Investing Blog', 'blogroll', 'Chris Neighbors'),
('http://jonraasch.com/blog/', '_blank', 'John Raasch is a front-end web developer / designer in Portland, OR. I love all things Javascript, jQuery and UX.', 'blogroll', 'John Raasch''s Awsum Blog'),
('http://labnotes.org/', '_blank', 'A blog by Assaf Arkin. Your morning goodness. The Daily Hi. A cool little short-sweet-n-to-the-point blog for all your needs', 'blogroll', 'Lab Notes'),
('http://roadtoangelo.tumblr.com/', '_blank', 'A Tumblr for my awsum ness!', 'blogroll', 'Road to Angelo Tumblr');

-- --------------------------------------------------------

--
-- Table structure for table `h_navigation`
--

CREATE TABLE IF NOT EXISTS `h_navigation` (
  `name` varchar(255) NOT NULL,
  `surl` varchar(255) NOT NULL,
  `parent` varchar(200) NOT NULL,
  `launchpad` int(100) NOT NULL,
  `type` enum('nav','topnav','subnav','bottomnav') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_navigation`
--

INSERT INTO `h_navigation` (`name`, `surl`, `parent`, `launchpad`, `type`) VALUES
('Page 1', 'page1', '', 1, 'nav'),
('Page 1', 'page1', '', 2, 'nav'),
('Page 1', 'page1', '', 3, 'nav'),
('Page 1', 'page1', '', 4, 'nav'),
('Page 1', 'page1', '', 5, 'nav');

-- --------------------------------------------------------

--
-- Table structure for table `h_pages`
--

CREATE TABLE IF NOT EXISTS `h_pages` (
  `page` varchar(255) NOT NULL,
  `pageNAME` varchar(255) NOT NULL,
  `pageKEYWORDS` longtext NOT NULL,
  `lp` enum('padmain','pad1','pad2','pad3','pad4') NOT NULL,
  `lpm` enum('padmain','pad1','pad2','pad3','pad4') NOT NULL,
  `subpage` varchar(255) NOT NULL,
  `created` date NOT NULL,
  `content_main` longtext NOT NULL,
  `content_main_code` longtext NOT NULL,
  `content_main_after_code` longtext NOT NULL,
  `content_sidebar` longtext NOT NULL,
  `content_sidebar_code` longtext NOT NULL,
  `content_sidebar_after_code` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_pages`
--

INSERT INTO `h_pages` (`page`, `pageNAME`, `pageKEYWORDS`, `lp`, `lpm`, `subpage`, `created`, `content_main`, `content_main_code`, `content_main_after_code`, `content_sidebar`, `content_sidebar_code`, `content_sidebar_after_code`) VALUES
('home', '', '', 'padmain', 'padmain', '', '2012-07-26', '<h2>What you are seeing is a shell of the impossible...coming soon!</h2><p>Welcome to the WIFE! The WIFE? You mean I have to deal with another one? I thought one was enough. Oh! You don''''t mean someone you marry. Gotcha. :/</p><p>What is the WIFE you ask? The WIFE is a Web Interface for Everyone. What this means is it is a full on, fully customizable CMS (not a template) website. There are no limits to what just can do with this. The only limitations are what you can code and the knowledge you have in taking templates (even tho this is not a template) and making them websites.</p><p>What is so special about this CMS? Well, thanks for asking, this CMS is not your typical standard CMS. It is fully customizable. Have I made myself clear?</p><p>You will be seeing many new changes happen to this website! Please come back soon!</p><h2>Changes</h2>\r\n<ul class="no-list-style">', '$GET_CHANGELOG=mysql_query("SELECT * FROM {$properties->DB_PREFIX}changelog ORDER BY date DESC");\r\nif(mysql_num_rows($GET_CHANGELOG)<1){\r\necho "No changes made to this system!";\r\n} else {\r\nwhile($FETCH_CHANGELOG=mysql_fetch_array($GET_CHANGELOG)){\r\necho "<li><b>[".$FETCH_CHANGELOG[''type'']."] ".$FETCH_CHANGELOG[''date'']."</b> - <span style=\\"text-align:justify;word-wrap:break-word\\">".$FETCH_CHANGELOG[''content'']."</span></li><br />";\r\n}\r\n}\r\necho "</ul><h1 class=\\"h1-center\\">Launch Day!</h2>\r\n<p class=\\"p-center\\">The Launch of the New Website will be</p>\r\n<h1 class=\\"h1-center\\">".$properties->LAUNCH_DAY."</h1>";', '<p class="p-center">Until then, please enjoy the back-end-website for this incredibly amazing website by going to my blog by</p>\r\n<h1 class="h1-center"><a href="http://www.nat4an.com/blog">Clicking here</a></h1>', '', '$GET_ATTRIBUTES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''padmain$page''") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_ATTRIBUTES=mysql_fetch_array($GET_ATTRIBUTES)){\r\n	$title=$FETCH_ATTRIBUTES[''title''];\r\n    $contents=$FETCH_ATTRIBUTES[''contents''];\r\n    echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n        eval($contents);\r\n        echo "</div>";\r\n}', ''),
('home', '', '', 'pad1', 'pad1', '', '2012-07-26', '<h2>What you are seeing is a shell of the impossible...coming soon!</h2><p>Welcome to the WIFE! The WIFE? You mean I have to deal with another one? I thought one was enough. Oh! You don''''t mean someone you marry. Gotcha. :/</p><p>What is the WIFE you ask? The WIFE is a Web Interface for Everyone. What this means is it is a full on, fully customizable CMS (not a template) website. There are no limits to what just can do with this. The only limitations are what you can code and the knowledge you have in taking templates (even tho this is not a template) and making them websites.</p><p>What is so special about this CMS? Well, thanks for asking, this CMS is not your typical standard CMS. It is fully customizable. Have I made myself clear?</p><p>You will be seeing many new changes happen to this website! Please come back soon!</p><h2>Changes</h2>\r\n<ul class="no-list-style">', '$GET_CHANGELOG=mysql_query("SELECT * FROM {$properties->DB_PREFIX}changelog ORDER BY date DESC");\r\nif(mysql_num_rows($GET_CHANGELOG)<1){\r\necho "No changes made to this system!";\r\n} else {\r\nwhile($FETCH_CHANGELOG=mysql_fetch_array($GET_CHANGELOG)){\r\necho "<li><b>[".$FETCH_CHANGELOG[''type'']."] ".$FETCH_CHANGELOG[''date'']."</b> - <span style=\\"text-align:justify;word-wrap:break-word\\">".$FETCH_CHANGELOG[''content'']."</span></li><br />";\r\n}\r\n}\r\necho "</ul><h1 class=\\"h1-center\\">Launch Day!</h2>\r\n<p class=\\"p-center\\">The Launch of the New Website will be</p>\r\n<h1 class=\\"h1-center\\">".$properties->LAUNCH_DAY."</h1>";', '<p class="p-center">Until then, please enjoy the back-end-website for this incredibly amazing website by going to my blog by</p>\r\n<h1 class="h1-center"><a href="http://www.nat4an.com/blog">Clicking here</a></h1>', '', '$GET_ATTRIBUTES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''pad1$page''") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_ATTRIBUTES=mysql_fetch_array($GET_ATTRIBUTES)){\r\n	$title=$FETCH_ATTRIBUTES[''title''];\r\n    $contents=$FETCH_ATTRIBUTES[''contents''];\r\n    echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n        eval($contents);\r\n        echo "</div>";\r\n}', ''),
('home', '', '', 'pad2', 'pad2', '', '2012-07-26', '<h2>What you are seeing is a shell of the impossible...coming soon!</h2><p>Welcome to the WIFE! The WIFE? You mean I have to deal with another one? I thought one was enough. Oh! You don''''t mean someone you marry. Gotcha. :/</p><p>What is the WIFE you ask? The WIFE is a Web Interface for Everyone. What this means is it is a full on, fully customizable CMS (not a template) website. There are no limits to what just can do with this. The only limitations are what you can code and the knowledge you have in taking templates (even tho this is not a template) and making them websites.</p><p>What is so special about this CMS? Well, thanks for asking, this CMS is not your typical standard CMS. It is fully customizable. Have I made myself clear?</p><p>You will be seeing many new changes happen to this website! Please come back soon!</p><h2>Changes</h2>\r\n<ul class="no-list-style">', '$GET_CHANGELOG=mysql_query("SELECT * FROM {$properties->DB_PREFIX}changelog ORDER BY date DESC");\r\nif(mysql_num_rows($GET_CHANGELOG)<1){\r\necho "No changes made to this system!";\r\n} else {\r\nwhile($FETCH_CHANGELOG=mysql_fetch_array($GET_CHANGELOG)){\r\necho "<li><b>[".$FETCH_CHANGELOG[''type'']."] ".$FETCH_CHANGELOG[''date'']."</b> - <span style=\\"text-align:justify;word-wrap:break-word\\">".$FETCH_CHANGELOG[''content'']."</span></li><br />";\r\n}\r\n}\r\necho "</ul><h1 class=\\"h1-center\\">Launch Day!</h2>\r\n<p class=\\"p-center\\">The Launch of the New Website will be</p>\r\n<h1 class=\\"h1-center\\">".$properties->LAUNCH_DAY."</h1>";', '<p class="p-center">Until then, please enjoy the back-end-website for this incredibly amazing website by going to my blog by</p>\r\n<h1 class="h1-center"><a href="http://www.nat4an.com/blog">Clicking here</a></h1>', '', '$GET_ATTRIBUTES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''pad2$page''") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_ATTRIBUTES=mysql_fetch_array($GET_ATTRIBUTES)){\r\n	$title=$FETCH_ATTRIBUTES[''title''];\r\n    $contents=$FETCH_ATTRIBUTES[''contents''];\r\n    echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n        eval($contents);\r\n        echo "</div>";\r\n}', ''),
('home', '', '', 'pad3', 'pad3', '', '2012-07-26', '<h2>What you are seeing is a shell of the impossible...coming soon!</h2><p>Welcome to the WIFE! The WIFE? You mean I have to deal with another one? I thought one was enough. Oh! You don''''t mean someone you marry. Gotcha. :/</p><p>What is the WIFE you ask? The WIFE is a Web Interface for Everyone. What this means is it is a full on, fully customizable CMS (not a template) website. There are no limits to what just can do with this. The only limitations are what you can code and the knowledge you have in taking templates (even tho this is not a template) and making them websites.</p><p>What is so special about this CMS? Well, thanks for asking, this CMS is not your typical standard CMS. It is fully customizable. Have I made myself clear?</p><p>You will be seeing many new changes happen to this website! Please come back soon!</p><h2>Changes</h2>\r\n<ul class="no-list-style">', '$GET_CHANGELOG=mysql_query("SELECT * FROM {$properties->DB_PREFIX}changelog ORDER BY date DESC");\r\nif(mysql_num_rows($GET_CHANGELOG)<1){\r\necho "No changes made to this system!";\r\n} else {\r\nwhile($FETCH_CHANGELOG=mysql_fetch_array($GET_CHANGELOG)){\r\necho "<li><b>[".$FETCH_CHANGELOG[''type'']."] ".$FETCH_CHANGELOG[''date'']."</b> - <span style=\\"text-align:justify;word-wrap:break-word\\">".$FETCH_CHANGELOG[''content'']."</span></li><br />";\r\n}\r\n}\r\necho "</ul><h1 class=\\"h1-center\\">Launch Day!</h2>\r\n<p class=\\"p-center\\">The Launch of the New Website will be</p>\r\n<h1 class=\\"h1-center\\">".$properties->LAUNCH_DAY."</h1>";', '<p class="p-center">Until then, please enjoy the back-end-website for this incredibly amazing website by going to my blog by</p>\r\n<h1 class="h1-center"><a href="http://www.nat4an.com/blog">Clicking here</a></h1>', '', '$GET_ATTRIBUTES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''pad3$page''") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_ATTRIBUTES=mysql_fetch_array($GET_ATTRIBUTES)){\r\n	$title=$FETCH_ATTRIBUTES[''title''];\r\n    $contents=$FETCH_ATTRIBUTES[''contents''];\r\n    echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n        eval($contents);\r\n        echo "</div>";\r\n}', ''),
('home', '', '', 'pad4', 'pad4', '', '2012-07-26', '<h2>What you are seeing is a shell of the impossible...coming soon!</h2><p>Welcome to the WIFE! The WIFE? You mean I have to deal with another one? I thought one was enough. Oh! You don''''t mean someone you marry. Gotcha. :/</p><p>What is the WIFE you ask? The WIFE is a Web Interface for Everyone. What this means is it is a full on, fully customizable CMS (not a template) website. There are no limits to what just can do with this. The only limitations are what you can code and the knowledge you have in taking templates (even tho this is not a template) and making them websites.</p><p>What is so special about this CMS? Well, thanks for asking, this CMS is not your typical standard CMS. It is fully customizable. Have I made myself clear?</p><p>You will be seeing many new changes happen to this website! Please come back soon!</p><h2>Changes</h2>\r\n<ul class="no-list-style">', '$GET_CHANGELOG=mysql_query("SELECT * FROM {$properties->DB_PREFIX}changelog ORDER BY date DESC");\r\nif(mysql_num_rows($GET_CHANGELOG)<1){\r\necho "No changes made to this system!";\r\n} else {\r\nwhile($FETCH_CHANGELOG=mysql_fetch_array($GET_CHANGELOG)){\r\necho "<li><b>[".$FETCH_CHANGELOG[''type'']."] ".$FETCH_CHANGELOG[''date'']."</b> - <span style=\\"text-align:justify;word-wrap:break-word\\">".$FETCH_CHANGELOG[''content'']."</span></li><br />";\r\n}\r\n}\r\necho "</ul><h1 class=\\"h1-center\\">Launch Day!</h2>\r\n<p class=\\"p-center\\">The Launch of the New Website will be</p>\r\n<h1 class=\\"h1-center\\">".$properties->LAUNCH_DAY."</h1>";', '<p class="p-center">Until then, please enjoy the back-end-website for this incredibly amazing website by going to my blog by</p>\r\n<h1 class="h1-center"><a href="http://www.nat4an.com/blog">Clicking here</a></h1>', '', '$GET_ATTRIBUTES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''pad4$page''") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_ATTRIBUTES=mysql_fetch_array($GET_ATTRIBUTES)){\r\n	$title=$FETCH_ATTRIBUTES[''title''];\r\n    $contents=$FETCH_ATTRIBUTES[''contents''];\r\n    echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n        eval($contents);\r\n        echo "</div>";\r\n}', ''),
('page1', 'Page 1', '', 'padmain', 'padmain', '', '2012-07-26', '<h1>Page 1 Content</h1>\r\n<h2>What you are seeing is a shell of the impossible...coming soon!</h2><p>Welcome to the WIFE! The WIFE? You mean I have to deal with another one? I thought one was enough. Oh! You don''''t mean someone you marry. Gotcha. :/</p><p>What is the WIFE you ask? The WIFE is a Web Interface for Everyone. What this means is it is a full on, fully customizable CMS (not a template) website. There are no limits to what just can do with this. The only limitations are what you can code and the knowledge you have in taking templates (even tho this is not a template) and making them websites.</p><p>What is so special about this CMS? Well, thanks for asking, this CMS is not your typical standard CMS. It is fully customizable. Have I made myself clear?</p><p>You will be seeing many new changes happen to this website! Please come back soon!</p><h2>Changes</h2>\r\n<ul class="no-list-style">', '$GET_CHANGELOG=mysql_query("SELECT * FROM {$properties->DB_PREFIX}changelog ORDER BY date DESC");\r\nif(mysql_num_rows($GET_CHANGELOG)<1){\r\necho "No changes made to this system!";\r\n} else {\r\nwhile($FETCH_CHANGELOG=mysql_fetch_array($GET_CHANGELOG)){\r\necho "<li><b>[".$FETCH_CHANGELOG[''type'']."] ".$FETCH_CHANGELOG[''date'']."</b> - <span style=\\"text-align:justify;word-wrap:break-word\\">".$FETCH_CHANGELOG[''content'']."</span></li><br />";\r\n}\r\n}\r\necho "</ul><h1 class=\\"h1-center\\">Launch Day!</h2>\r\n<p class=\\"p-center\\">The Launch of the New Website will be</p>\r\n<h1 class=\\"h1-center\\">".$properties->LAUNCH_DAY."</h1>";', '<p class="p-center">Until then, please enjoy the back-end-website for this incredibly amazing website by going to my blog by</p>\r\n<h1 class="h1-center"><a href="http://www.nat4an.com/blog">Clicking here</a></h1>', '', '$GET_ATTRIBUTES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE page=''padmain$page''") or die(''uh oh! ''.mysql_error());\r\nwhile($FETCH_ATTRIBUTES=mysql_fetch_array($GET_ATTRIBUTES)){\r\n	$title=$FETCH_ATTRIBUTES[''title''];\r\n    $contents=$FETCH_ATTRIBUTES[''contents''];\r\n    echo "<h2 class=\\"pages-sidebar-title\\">{$title}</h2>";\r\n	echo "<div class=\\"pages-sidebar-contents\\">";\r\n        eval($contents);\r\n        echo "</div>";\r\n}', '');

-- --------------------------------------------------------

--
-- Table structure for table `h_pages_modules`
--

CREATE TABLE IF NOT EXISTS `h_pages_modules` (
  `title` varchar(255) NOT NULL,
  `contents` longtext NOT NULL,
  `page` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_pages_modules`
--

INSERT INTO `h_pages_modules` (`title`, `contents`, `page`) VALUES
('No Hands!', 'echo "<ul>";\r\necho "<li>Aren''t I pretty talented? I just built this website without using my hands and feet (not that people use their feet to build their websites). How many people can say they have done that before? Heh? No one? Wow I must be pretty special!</li>";\r\necho "</ul>";', 'padmainhome'),
('Valid XHTML traditional markup', 'echo "<ul>";\r\necho "<li><b>The HTML in this layout validates as XHTML 1.0 traditional.</b> What does that mean to you? Absolutely nothing but the fact that it is stable enough for you to muck around with. :P</li>\r\n<hr>\r\n<li>Is that a mustashe at the top of the screen? Yes! In fact that is a mustache. Why you ask? Because it is yet another sign of me being creative and funny.</li>";\r\necho "</ul>";', 'padmainhome'),
('No Hands!', 'echo "<ul>";\r\necho "<li>Aren''t I pretty talented? I just built this website without using my hands and feet (not that people use their feet to build their websites). How many people can say they have done that before? Heh? No one? Wow I must be pretty special!</li>";\r\necho "</ul>";', 'pad1home'),
('Valid XHTML traditional markup', 'echo "<ul>";\r\necho "<li><b>The HTML in this layout validates as XHTML 1.0 traditional.</b> What does that mean to you? Absolutely nothing but the fact that it is stable enough for you to muck around with. :P</li>\r\n<hr>\r\n<li>Is that a mustashe at the top of the screen? Yes! In fact that is a mustache. Why you ask? Because it is yet another sign of me being creative and funny.</li>";\r\necho "</ul>";', 'pad1home'),
('No Hands!', 'echo "<ul>";\r\necho "<li>Aren''t I pretty talented? I just built this website without using my hands and feet (not that people use their feet to build their websites). How many people can say they have done that before? Heh? No one? Wow I must be pretty special!</li>";\r\necho "</ul>";', 'pad2home'),
('Valid XHTML traditional markup', 'echo "<ul>";\r\necho "<li><b>The HTML in this layout validates as XHTML 1.0 traditional.</b> What does that mean to you? Absolutely nothing but the fact that it is stable enough for you to muck around with. :P</li>\r\n<hr>\r\n<li>Is that a mustashe at the top of the screen? Yes! In fact that is a mustache. Why you ask? Because it is yet another sign of me being creative and funny.</li>";\r\necho "</ul>";', 'pad2home'),
('No Hands!', 'echo "<ul>";\r\necho "<li>Aren''t I pretty talented? I just built this website without using my hands and feet (not that people use their feet to build their websites). How many people can say they have done that before? Heh? No one? Wow I must be pretty special!</li>";\r\necho "</ul>";', 'pad3home'),
('Valid XHTML traditional markup', 'echo "<ul>";\r\necho "<li><b>The HTML in this layout validates as XHTML 1.0 traditional.</b> What does that mean to you? Absolutely nothing but the fact that it is stable enough for you to muck around with. :P</li>\r\n<hr>\r\n<li>Is that a mustashe at the top of the screen? Yes! In fact that is a mustache. Why you ask? Because it is yet another sign of me being creative and funny.</li>";\r\necho "</ul>";', 'pad3home'),
('No Hands!', 'echo "<ul>";\r\necho "<li>Aren''t I pretty talented? I just built this website without using my hands and feet (not that people use their feet to build their websites). How many people can say they have done that before? Heh? No one? Wow I must be pretty special!</li>";\r\necho "</ul>";', 'pad4home'),
('Valid XHTML traditional markup', 'echo "<ul>";\r\necho "<li><b>The HTML in this layout validates as XHTML 1.0 traditional.</b> What does that mean to you? Absolutely nothing but the fact that it is stable enough for you to muck around with. :P</li>\r\n<hr>\r\n<li>Is that a mustashe at the top of the screen? Yes! In fact that is a mustache. Why you ask? Because it is yet another sign of me being creative and funny.</li>";\r\necho "</ul>";', 'pad4home'),
('No Hands!', 'echo "<ul>";\r\necho "<li>Aren''t I pretty talented? I just built this website without using my hands and feet (not that people use their feet to build their websites). How many people can say they have done that before? Heh? No one? Wow I must be pretty special!</li>";\r\necho "</ul>";', 'padmainpage1'),
('Valid XHTML traditional markup', 'echo "<ul>";\r\necho "<li><b>The HTML in this layout validates as XHTML 1.0 traditional.</b> What does that mean to you? Absolutely nothing but the fact that it is stable enough for you to muck around with. :P</li>\r\n<hr>\r\n<li>Is that a mustashe at the top of the screen? Yes! In fact that is a mustache. Why you ask? Because it is yet another sign of me being creative and funny.</li>";\r\necho "</ul>";', 'padmainpage1');

-- --------------------------------------------------------

--
-- Table structure for table `h_tempsystem`
--

CREATE TABLE IF NOT EXISTS `h_tempsystem` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `ip` varchar(100) NOT NULL,
  `lptoggle` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `h_tempsystem`
--

INSERT INTO `h_tempsystem` (`id`, `ip`, `lptoggle`) VALUES
(1, '127.0.0.1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `h_users`
--

CREATE TABLE IF NOT EXISTS `h_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uname` varchar(100) NOT NULL,
  `upass` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `h_users`
--

INSERT INTO `h_users` (`id`, `uname`, `upass`) VALUES
(1, 'mrnat4an', 'password');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
