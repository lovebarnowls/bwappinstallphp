<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Hard-coded database connection details
$server = "localhost";
$db_username = "bwapp_user";
$db_password = "password";
$db_name = "bWAPP";

// Create a connection object
$link = new mysqli($server, $db_username, $db_password, $db_name);

// Check connection
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

echo "Connected to 'bWAPP' database.<br>";

// Array of table creation queries
$tables = [
    "users" => "CREATE TABLE IF NOT EXISTS users (
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
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1",

    "blog" => "CREATE TABLE IF NOT EXISTS blog (
        id int(10) NOT NULL AUTO_INCREMENT,
        owner varchar(100) DEFAULT NULL,
        entry varchar(500) DEFAULT NULL,
        date datetime DEFAULT NULL,
        PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1",

    "visitors" => "CREATE TABLE IF NOT EXISTS visitors (
        id int(10) NOT NULL AUTO_INCREMENT,
        ip_address varchar(50) DEFAULT NULL,
        user_agent varchar(500) DEFAULT NULL,
        date datetime DEFAULT NULL,
        PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1",

    "movies" => "CREATE TABLE IF NOT EXISTS movies (
        id int(10) NOT NULL AUTO_INCREMENT,
        title varchar(100) DEFAULT NULL,
        release_year varchar(100) DEFAULT NULL,
        genre varchar(100) DEFAULT NULL,
        main_character varchar(100) DEFAULT NULL,
        imdb varchar(100) DEFAULT NULL,
        tickets_stock int(10) DEFAULT NULL,
        PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1",

    "heroes" => "CREATE TABLE IF NOT EXISTS heroes (
        id int(10) NOT NULL AUTO_INCREMENT,
        login varchar(100) DEFAULT NULL,
        password varchar(100) DEFAULT NULL,
        secret varchar(100) DEFAULT NULL,
        PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1"
];

// Create tables
foreach ($tables as $table_name => $query) {
    if (!$link->query($query)) {
        die("Error creating $table_name table: " . $link->error);
    }
    echo "Table $table_name created successfully.<br>";
}

// Insert default data
$insert_data = [
    "users" => "INSERT INTO users (login, password, email, secret, activation_code, activated, reset_code, admin) VALUES
        ('A.I.M.', '6885858486f31043e5839c735d99457f045affd0', 'bwapp-aim@mailinator.com', 'A.I.M. or Authentication Is Missing', NULL, 1, NULL, 1),
        ('bee', '6885858486f31043e5839c735d99457f045affd0', 'bwapp-bee@mailinator.com', 'Any bugs?', NULL, 1, NULL, 1)",

    "heroes" => "INSERT INTO heroes (login, password, secret) VALUES
        ('neo', 'trinity', 'Oh why didn\'t I took that BLACK pill?'),
        ('alice', 'loveZombies', 'There\'s a cure!'),
        ('thor', 'Asgard', 'Oh, no... this is Earth... isn\'t it?'),
        ('wolverine', 'Log@N', 'What\'s a Magneto?'),
        ('johnny', 'm3ph1st0ph3l3s', 'I\'m the Ghost Rider!'),
        ('seline', 'm00n', 'It wasn\'t the Lycans. It was you.')"
];

// Insert default data
foreach ($insert_data as $table_name => $query) {
    if (!$link->query($query)) {
        echo "Error inserting data into $table_name table: " . $link->error . "<br>";
    } else {
        echo "Data inserted into $table_name table successfully.<br>";
    }
}

$link->close();

echo "Database setup completed.";
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
