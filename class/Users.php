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

    public  function Vend_all()
    {


        $sql = "SELECT DISTINCT cod_vend, vendedor FROM `ck_disnorte`";

        $stm = DB::prepare($sql);
        $stm->execute();


        return $stm->fetchAll();


    }






}