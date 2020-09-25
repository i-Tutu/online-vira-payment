<?php

error_reporting(E_ALL);

// /* Database credentials. Assuming you are running MySQL
// server with default setting (user 'root' with no password) */
// define('DB_SERVER', 'localhost');
// define('DB_USERNAME', 'root');
// define('DB_PASSWORD', '');
// define('DB_NAME', 'studentspay');
 
// /* Attempt to connect to MySQL database */
// $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// // Check connection
// if($link === false){
//     die("ERROR: Could not connect. " . mysqli_connect_error());
// }

// $con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// // Check connection

// if (!$con) {
//     die("Connection failed: " . mysqli_connect_error());
// }

?>

<?php
  class DB {

          // public static $host = "localhost";
          // public static $dbName = "studentspay";
          // public static $username = "root";
          // public static $password = "";

          public static $host = "localhost";
          public static $dbName = "virapayment";
          public static $dbName = "ourcomunmmy_virapayment_db";
          public static $username = "ourcomunmmy_virapayment";
          public static $password = "pa$$Word55";

    private static function connect() {
            $pdo = new PDO("mysql:host=".self::$host.";dbname=".self::$dbName.";charset=utf8", self::$username, self::$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
    }

    public static function query($query, $params = array()) {
              $statement = self::connect()->prepare($query);
              $statement->execute($params);

              if (explode(' ', $query)[0] == 'SELECT') {
              $data = $statement->fetchAll();
              return $data;
              } else{
                return True;
              }
      }

    public static function fetch($query, $params = array()) {
            $statement = self::connect()->prepare($query);
            $statement->execute($params);

            if (explode(' ', $query)[0] == 'SELECT') {
            $data = $statement->fetchAll();
            return $data;
            }
    }

    public static function count($query, $params = array()) {
            $statement = self::connect()->prepare($query);
            $statement->execute($params);

            $data = $statement->rowCount();
            return $data;

    }

  }
