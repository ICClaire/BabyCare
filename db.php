<?php
     define('_HOST_NAME','localhost');
     define('_DATABASE_NAME','babycare');
     define('_DATABASE_USER_NAME','root');
     define('_DATABASE_PASSWORD','root');
 
    $babycon = new MySQLi(_HOST_NAME,_DATABASE_USER_NAME,_DATABASE_PASSWORD,_DATABASE_NAME);

     if($babycon->connect_errno)
     {
       die("ERROR : -> ".$babycon->connect_error);
     }
?>
<!-- // Connects to the MySQL database called babycare -->