<?php
/**
 * Created by PhpStorm.
 * User: julio
 * Date: 12/10/2019
 * Time: 13:13
 */

require_once 'conexao/DB.php';

class Users extends  DB
{


    public  function User_all()
    {


        $sql = "SELECT id, nome from usuarios";

        $stm = DB::prepare($sql);
        $stm->execute();


        return $stm->fetchAll();


    }

    public  function UserMixCood($cood)
    {


        $sql = "SELECT DISTINCT super FROM usuarios where super = '$cood' ORDER by regiao, super";
        var_dump($sql);


        $stm = DB::prepare($sql);
        $stm->execute();


        return $stm->fetchAll();


    }

    public  function all_Vendedores()
    {


        $sql = "SELECT rca,nome FROM usuarios where super <> '' ORDER by nome";
        var_dump($sql);


        $stm = DB::prepare($sql);
        $stm->execute();


        return $stm->fetchAll();


    }

    public  function VendedoresCood($cood)
    {


        $sql = "SELECT rca,nome FROM usuarios where super = '$cood' order by nome";
        var_dump($sql);


        $stm = DB::prepare($sql);
        $stm->execute();


        return $stm->fetchAll();


    }











}