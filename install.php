<?php

/*
Fixed install.php file for bwapp
*/

$message = "Click <a href=\"install.php?install=yes\">here</a> to install bWAPP.";
$db = 0;

if(isset($_REQUEST["install"]) && $_REQUEST["install"] == "yes")
{
    // Connection settings
    include("config.inc.php");

    // Connects to the server
    $link = new mysqli($server, $username, $password);

    // Checks the connection
    if($link->connect_error)
    {
        die("Connection failed: " . $link->connect_error);
    }

    // Checks if the database 'bWAPP' already exists
    if($link->select_db("bWAPP"))
    {
        $message = "The bWAPP database already exists...";
    }
    else
    {
        // Creates the database 'bWAPP'
        $sql = "CREATE DATABASE IF NOT EXISTS bWAPP";
        if(!$link->query($sql))
        {
            die("Error creating database: " . $link->error);
        }

        // Selects the database 'bWAPP'
        $link->select_db("bWAPP");

        // Creates the 'users' table
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id int(10) NOT NULL AUTO_INCREMENT,
            login varchar(100) DEFAULT NULL,
            password varchar(100) DEFAULT NULL,
            email varchar(100) DEFAULT NULL,
            secret varchar(100) DEFAULT NULL,
            activation_code varchar(100) DEFAULT NULL,
            activated tinyint(1) DEFAULT '0',
            reset_code varchar(100) DEFAULT NULL,
            admin tinyint(1) DEFAULT '0',
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
        if(!$link->query($sql))
        {
            die("Error creating users table: " . $link->error);
        }

        // Populates the table 'users' with the default users
        $sql = "INSERT INTO users (login, password, email, secret, activation_code, activated, reset_code, admin) VALUES
            ('A.I.M.', '6885858486f31043e5839c735d99457f045affd0', 'bwapp-aim@mailinator.com', 'A.I.M. or Authentication Is Missing', NULL, 1, NULL, 1),
            ('bee', '6885858486f31043e5839c735d99457f045affd0', 'bwapp-bee@mailinator.com', 'Any bugs?', NULL, 1, NULL, 1)";
        if(!$link->query($sql))
        {
            die("Error populating users table: " . $link->error);
        }

        // Creates the 'blog' table
        $sql = "CREATE TABLE IF NOT EXISTS blog (
            id int(10) NOT NULL AUTO_INCREMENT,
            owner varchar(100) DEFAULT NULL,
            entry varchar(500) DEFAULT NULL,
            date datetime DEFAULT NULL,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
        if(!$link->query($sql))
        {
            die("Error creating blog table: " . $link->error);
        }

        // Creates the 'visitors' table
        $sql = "CREATE TABLE IF NOT EXISTS visitors (
            id int(10) NOT NULL AUTO_INCREMENT,
            ip_address varchar(50) DEFAULT NULL,
            user_agent varchar(500) DEFAULT NULL,
            date datetime DEFAULT NULL,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
        if(!$link->query($sql))
        {
            die("Error creating visitors table: " . $link->error);
        }

        // Creates the 'movies' table
        $sql = "CREATE TABLE IF NOT EXISTS movies (
            id int(10) NOT NULL AUTO_INCREMENT,
            title varchar(100) DEFAULT NULL,
            release_year varchar(100) DEFAULT NULL,
            genre varchar(100) DEFAULT NULL,
            main_character varchar(100) DEFAULT NULL,
            imdb varchar(100) DEFAULT NULL,
            tickets_stock int(10) DEFAULT NULL,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
        if(!$link->query($sql))
        {
            die("Error creating movies table: " . $link->error);
        }

        // Populates the table 'movies'
        $sql = "INSERT INTO movies (title, release_year, genre, main_character, imdb, tickets_stock) VALUES
            ('G.I. Joe: Retaliation', '2013', 'action', 'Cobra Commander', 'tt1583421', 100),
            ('Iron Man', '2008', 'action', 'Tony Stark', 'tt0371746', 53),
            ('Man of Steel', '2013', 'action', 'Clark Kent', 'tt0770828', 78),
            ('Terminator Salvation', '2009', 'sci-fi', 'John Connor', 'tt0438488', 100),
            ('The Amazing Spider-Man', '2012', 'action', 'Peter Parker', 'tt0948470', 13),
            ('The Cabin in the Woods', '2011', 'horror', 'Some zombies', 'tt1259521', 666),
            ('The Dark Knight Rises', '2012', 'action', 'Bruce Wayne', 'tt1345836', 3),
            ('The Fast and the Furious', '2001', 'action', 'Brian O\'Connor', 'tt0232500', 40),
            ('The Incredible Hulk', '2008', 'action', 'Bruce Banner', 'tt0800080', 23),
            ('World War Z', '2013', 'horror', 'Gerry Lane', 'tt0816711', 0)";
        if(!$link->query($sql))
        {
            die("Error populating movies table: " . $link->error);
        }

        // Creates the 'heroes' table
        $sql = "CREATE TABLE IF NOT EXISTS heroes (
            id int(10) NOT NULL AUTO_INCREMENT,
            login varchar(100) DEFAULT NULL,
            password varchar(100) DEFAULT NULL,
            secret varchar(100) DEFAULT NULL,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
        if(!$link->query($sql))
        {
            die("Error creating heroes table: " . $link->error);
        }

        // Populates the table 'heroes' with the default users
        $sql = "INSERT INTO heroes (login, password, secret) VALUES
            ('neo', 'trinity', 'Oh why didn\'t I took that BLACK pill?'),
            ('alice', 'loveZombies', 'There\'s a cure!'),
            ('thor', 'Asgard', 'Oh, no... this is Earth... isn\'t it?'),
            ('wolverine', 'Log@N', 'What\'s a Magneto?'),
            ('johnny', 'm3ph1st0ph3l3s', 'I\'m the Ghost Rider!'),
            ('seline', 'm00n', 'It wasn\'t the Lycans. It was you.')";
        if(!$link->query($sql))
        {
            die("Error populating heroes table: " . $link->error);
        }

        $message = "bWAPP has been installed successfully!";
    }

    $db = 1;

    $link->close();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!--<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Architects+Daughter">-->
<link rel="stylesheet" type="text/css" href="stylesheets/stylesheet.css" media="screen" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<!--<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>-->
<script src="js/html5.js"></script>
<title>bWAPP - Installation</title>
</head>
<body>
<header>
<h1>bWAPP</h1>
<h2>an extremely buggy web app !</h2>
</header>
<div id="menu">
    <table>
        <tr>
        <?php
        if($db == 1)
        {
        ?>
            <td><a href="login.php">Login</a></td>
            <td><a href="user_new.php">New User</a></td>
            <td><a href="info.php">Info</a></td>
            <td><a href="training.php">Talks & Training</a></td>
            <td><a href="http://itsecgames.blogspot.com" target="_blank">Blog</a></td>
        <?php
        }
        else
        {
        ?>
            <td><font color="#ffb717">Install</font></td>
            <td><a href="info_install.php">Info</a></td>
            <td><a href="training_install.php">Talks & Training</a></td>
            <td><a href="http://itsecgames.blogspot.com" target="_blank">Blog</a></td>
        <?php
        }
        ?>
        </tr>
    </table>
</div>
<div id="main">
    <h1>Installation</h1>
    <p><?php echo $message?></p>
</div>
<div id="side">
    <a href="http://twitter.com/MME_IT" target="blank_" class="button"><img src="./images/twitter.png"></a>
    <a href="http://be.linkedin.com/in/malikmesellem" target="blank_" class="button"><img src="./images/linkedin.png"></a>
    <a href="http://www.facebook.com/pages/MME-IT-Audits-Security/104153019664877" target="blank_" class="button"><img src="./images/facebook.png"></a>
    <a href="http://itsecgames.blogspot.com" target="blank_" class="button"><img src="./images/blogger.png"></a>
</div>
<div id="disclaimer">
    <p>bWAPP is licensed under <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/" target="_blank"><img style="vertical-align:middle" src="./images/cc.png"></a> &copy; 2014 MME BVBA / Follow <a href="http://twitter.com/MME_IT" target="_blank">@MME_IT</a> on Twitter and ask for our cheat sheet, containing all solutions! / Need an exclusive <a href="http://www.mmebvba.com" target="_blank">training</a>?</p>
</div>
<div id="bee">
    <img src="./images/bee_1.png">
</div>
</body>
</html>
