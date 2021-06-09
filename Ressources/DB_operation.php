<?php

  
include_once ('DB_Connect.php');


class db_operation {

    private $context;

    function __construct() 
    {
        $db = new AndroidRepert();
        $this->context = $db->Connect();
    }



    function createUser($username, $password, $email, $localite, $ddn)
      {

        try
            {
                $stmt = $this->context->prepare("INSERT INTO USERS (Username, Password, Email, Localite, DateDeNaissance) VALUES (?, ?, ?, ?, ?);");
            }
            catch (Exception $e)
            {
                  echo "Erreur préparation : ".$e->getMessage();
               }

            $stmt->bind_param("sssss", $username, $password, $email, $localite, $ddn);



            if($stmt->execute())
            {

              return 1;
            }else{

              return 2;
            }
      }

    function UserLogin($username, $pass)
      {
          $req = "SELECT * FROM USERS where Username = ? AND Password = ?;";
          $password = $pass;


          try
          {
              $stmt = $this->context->prepare($req);

              $stmt->bind_param("ss", $username, $password);

              $stmt->execute();
              $stmt->store_result();
              return $stmt->num_rows() > 0;

          }
          catch(PDOException $error)
          {

          }
      }

      function GetUserByUsername($username)
      {
          $req = "SELECT * FROM USERS where Username = ?;";

          //Envoie de la requête à la base
          try
          {
              $stmt = $this->context->prepare($req);

              $stmt->bind_param("s", $username);

              $stmt->execute();
              $array = $stmt->get_result()->fetch_assoc();


              $stmt->store_result();

              return $array;
          }
          catch(PDOException $error)
          {

              exit();
          }
      }

      function updatePass($username, $password)
      {
       

         try
            {
                $req = "UPDATE USERS SET Password = ? where Username = ?;";
            }
            catch (Exception $e)
            {
                  echo "Erreur préparation : ".$e->getMessage();
               }

            $stmt = $this->context->prepare($req);

            $stmt->bind_param("ss", $password, $username);

            if($stmt->execute())
            {

              return 1;
            }else{

              return 0;
            }
      }

      function updateMail($username, $email)
      {
       

         try
            {
                $req = "UPDATE USERS SET Email = ? where Username = ?;";
            }
            catch (Exception $e)
            {
                  echo "Erreur préparation : ".$e->getMessage();
               }
            $stmt = $this->context->prepare($req);

            $stmt->bind_param("ss", $email, $username);

            if($stmt->execute())
            {

              return 1;
            }else{

              return 0;
            }
      }

      function updateLocal($username, $local)
      {
       

         try
            {
                $req = "UPDATE USERS SET Localite = ? where Username = ?;";
            }
            catch (Exception $e)
            {
                  echo "Erreur préparation : ".$e->getMessage();
               }
            $stmt = $this->context->prepare($req);

            $stmt->bind_param("ss", $Localite, $username);

            if($stmt->execute())
            {

              return 1;
            }else{

              return 0;
            }
      }

      function updateDate($username, $date)
      {
       

         try
            {
                $req = "UPDATE USERS SET DateDeNaissance = ? where Username = ?;";
            }
            catch (Exception $e)
            {
                  echo "Erreur préparation : ".$e->getMessage();
               }
            $stmt = $this->context->prepare($req);

            $stmt->bind_param("ss", $DDn, $username);

            if($stmt->execute())
            {

              return 1;
            }else{

              return 0;
            }
      }

      function delete($username)
      {
        try
            {
                $req = "DELETE FROM USERS WHERE Username = ?;";
            }
            catch (Exception $e)
            {
                  echo "Erreur préparation : ".$e->getMessage();
               }
            $stmt = $this->context->prepare($req);

            $stmt->bind_param("s", $username);

            if($stmt->execute())
            {

              return 1;
            }else{

              return 0;
            }
      }

      function getUsersByCriteria($username, $mail, $local)
      {
        try
            {
                $req = "SELECT * FROM USERS WHERE (UPPER(Username) LIKE UPPER('%".$username."%')) AND (UPPER(Email) LIKE UPPER('%".$mail."%')) AND (UPPER(Localite) LIKE UPPER('%".$local."%'))";
            }
            catch (Exception $e)
            {
                  echo "Erreur préparation : ".$e->getMessage();
               }

            $stmt = $this->context->prepare($req);

            if($stmt->execute())
            {

              $result = $stmt->get_result();

              $arrayResult = array();

              while ($row = $result->fetch_assoc()) 
              {
                array_push($arrayResult,$row);
              }

              return $arrayResult;;
            }else{

              return 0;
            }
      }

}


?>