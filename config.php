<?php
    // Define DB Params
    define("DB_HOST", "localhost");
    define("DB_USER", "");
    define("DB_PASS", "");
    define("DB_NAME", "test");

    $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    $table_users = 'shares_users';
    $table_shares = 'shares';

    // //Drop table if they exists
    // $sql = "DROP TABLE IF EXISTS shares;";
    // mysqli_query($db, $sql);
    // $sql = "DROP TABLE IF EXISTS shares_users;";
    // mysqli_query($db, $sql);

    //Create table
    $sql = "CREATE TABLE {$table_users} (id INT(11) UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, register_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (id));";
    mysqli_query($db, $sql);

    $sql = "CREATE TABLE {$table_shares} (id INT(11) UNSIGNED AUTO_INCREMENT NOT NULL, user_id INT(11) UNSIGNED NOT NULL, title VARCHAR(255) NOT NULL, body TEXT NOT NULL, link VARCHAR(255) NOT NULL, create_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (id), FOREIGN KEY (user_id) REFERENCES {$table_shares}(id));";
    mysqli_query($db, $sql);

    // Define URL
    define("ROOT_PATH", "/miniBlog/");
    define("ROOT_URL", "http://localhost:8081/miniBlog/");
?>
