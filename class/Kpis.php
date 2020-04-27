<?php
/**
 * Created by PhpStorm.
 * User: julio
 * Date: 12/04/2020
 * Time: 19:50
 */

require_once 'conexao/DB.php';

class Kpis extends  DB
{


    public function all()
    {


        $sql = "SELECT * FROM trimarca";

        $stm = DB::prepare($sql);
        $stm->execute();


        return $stm->fetchAll();


    }



}

