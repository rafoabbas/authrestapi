<?php
require_once 'includes/DbOperations.php';

if ($_GET['action']){
    $action = $_GET['action'];
    $response = array();
    switch ($action)
    {
        case  "register":
            if($_SERVER['REQUEST_METHOD']=='POST'){
                if(


                    isset($_POST['username']) and
                    isset($_POST['email']) and
                    isset($_POST['password']))
                {
                    //operate the data further

                    $db = new DbOperations();

                    $result = $db->createUser( 	$_POST['username'],
                        $_POST['password'],
                        $_POST['email']
                    );
                    if($result == 1){
                        $response['error'] = false;
                        $response['message'] = "User registered successfully";
                    }elseif($result == 2){
                        $response['error'] = true;
                        $response['message'] = "Some error occurred please try again";
                    }elseif($result == 0){
                        $response['error'] = true;
                        $response['message'] = "It seems you are already registered, please choose a different email and username";
                    }

                }else{
                    $response['error'] = true;
                    $response['message'] = "Required fields are missing";
                }
            }else{
                $response['error'] = true;
                $response['message'] = "Invalid Request";
            }
            echo json_encode($response);

            break;
        case "login":

            if($_SERVER['REQUEST_METHOD']=='POST'){
                if(isset($_POST['username']) and isset($_POST['password'])){
                    $db = new DbOperations();

                    if($db->userLogin($_POST['username'], $_POST['password'])){
                        $user = $db->getUserByUsername($_POST['username']);
                        $response['error'] = false;
                        $response['id'] = $user['id'];
                        $response['email'] = $user['email'];
                        $response['username'] = $user['username'];
                    }else{
                        $response['error'] = true;
                        $response['message'] = "Invalid username or password";
                    }

                }else{
                    $response['error'] = true;
                    $response['message'] = "Required fields are missing";
                }
            }else{
                $response['error'] = true;
                $response['message'] = "Invalid Request";
            }

            echo json_encode($response);
            break;
        default:

            echo  'alma';

    }
}