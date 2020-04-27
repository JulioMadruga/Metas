<?php

session_start();

include_once "../Database/conectar.php";

//$res = array('error' => false);

$action = 'read';

if(isset($_GET['action'])){
    $action = $_GET['action'];
}



if($action == 'login'){

  $email = $_POST['email'];
  $senha = $_POST['senha'];


    $result = $conn->query("SELECT * FROM `usuarios` where email = '$email' and senha = '$senha'");
    //var_dump($result);
    $users = array();

    while($row = $result->fetch_assoc()){
        array_push($users, $row);
    }

    if (empty($users)){

        $res['users'] = $users;

    }else{

        $res['users'] = $users;

        $_SESSION['user_session'] = $users[0]['id'];
        $_SESSION['rca_session'] = $users[0]['Rca'];
        $_SESSION['name_session'] = $users[0]['nome'];

    }


}



$conn->close();

header("Content-type: application/json");
echo json_encode($res);
die();