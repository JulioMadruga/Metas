<?php

session_start();

include_once "../database/conectar2.php";

$res = array('error' => false);

$action = 'read';

if(isset($_GET['action'])){
    $action = $_GET['action'];
}

if($action == 'users'){
    $result = $conn->query("select id_user, nome, count(id_user) as valor from (SELECT b.id_user, a.nome FROM usuarios a, ck_garoto b where a.id = b.id_user union all SELECT b.id_user, a.nome FROM usuarios a, ck_disnorte b where a.id = b.id_user)sub group by id_user");


    $users = array();

    while($row = $result->fetch_assoc()){
        array_push($users, $row);
    }

    $res['users'] = $users;
}

if($action == 'user'){

    $id = $_POST['id_user'];

    $result = $conn->query("SELECT 'G' as tipo, cliente,vendedor, DATE_FORMAT(dt_cad ,'%d/%m/%Y')AS data, id_check FROM `ck_garoto` where id_user = $id UNION ALL
                SELECT 'D' as tipo,cliente, vendedor, DATE_FORMAT(dt_cad ,'%d/%m/%Y')AS data, id_check  FROM `ck_disnorte` where id_user = $id ORDEr BY data DESC");


    $checkUser = array();

    while($row = $result->fetch_assoc()){
        array_push($checkUser, $row);
    }

    $res['checkUser'] = $checkUser;
}

if($action == 'garoto'){
    $result = $conn->query("select count(id_check) as checks from ck_garoto");


    $checks = array();

    while($row = $result->fetch_assoc()){
        array_push($checks, $row);
    }

    $res['checks'] = $checks;
}


if($action == 'disnorte'){
    $result = $conn->query("select count(id_check) as checks from ck_disnorte");


    $checks = array();

    while($row = $result->fetch_assoc()){
        array_push($checks, $row);
    }

    $res['checks'] = $checks;
}



if($action == 'read3'){
    $result = $conn->query("SELECT (SELECT COUNT(id_prod) from produtos) - COUNT(id_prod) as disponiveis FROM `itens_locados` WHERE data_venc > now()");


    if($result->num_rows == 0 || empty($result)){

        $result = $conn->query("SELECT COUNT(id_prod) as diponiveis from produtos a");

    }

    $disponivel = array();

    while($row = $result->fetch_assoc()){
        array_push($disponivel, $row);
    }

    $res['disponivel'] = $disponivel;
}

if($action == 'read4'){
    $result = $conn->query("SELECT COUNT(id_cli) as totalCli from clientes");


    $totalCli= array();

    while($row = $result->fetch_assoc()){
        array_push($totalCli, $row);
    }

    $res['totalCli'] = $totalCli;
}


if($action == 'read5'){
    $result = $conn->query("SELECT COUNT(id_user) as totalUser from usuarios");


    $totalUser= array();

    while($row = $result->fetch_assoc()){
        array_push($totalUser, $row);
    }

    $res['totalUser'] = $totalUser;
}


$conn->close();

header("Content-type: application/json");
echo json_encode($res);
die();