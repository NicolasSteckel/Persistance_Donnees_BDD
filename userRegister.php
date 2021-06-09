<?php

			//CE FICHIER EST UN WEB SERVICE

			include_once (dirname(__FILE__).'\Ressources\DB_operation.php');

			$db = new db_operation();


			

			if($_SERVER["REQUEST_METHOD"] == "POST")
			{
				if (isset($_POST["Nom"]) && isset($_POST["Password"]) && isset($_POST["mail"]) && isset($_POST["local"]) && isset($_POST["ddn"])) 
				{
			        $create = $db->createUser($_POST['Nom'],$_POST['Password'],$_POST['mail'],$_POST['local'],$_POST['ddn']);
			        switch($create) {
			            case 0:
			                $response = array(
			                    'status' => false,
			                    'error' => true,
			                    'message' => 'Ce nom d\'utilisateur ou cette adresse mail sont deja utilises'
			                );
			                break;
			            case 1:
			                $response = array(
			                    'status' => true,
			                    'error' => false,
			                    'message' => 'L\'utilisateur a ete cree'
			                );
			                break;
			            case 2:
			                $response = array(
			                    'status' => false,
			                    'error' => true,
			                    'message' => 'Erreur d\'insertion, veuillez reesayer.'
			                );
			                break;
			        }

			        echo json_encode($response);
	    		}
			}
			

			

		?>