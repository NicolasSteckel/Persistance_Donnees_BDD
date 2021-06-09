<?php

include 'Constantes_AndroidData.php';

class AndroidRepert
{    
  function __construct(){}

  private $conn; //Objet de connexion.

  function Connect() {
    $dsn="mysql:host=".SERVERNAME.";dbname=".DBNAME.";charset=UTF8";
    $this->conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);

    if(mysqli_connect_errno()) {

    } else {

    }
    return $this->conn;
}
}
 
?>