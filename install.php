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
