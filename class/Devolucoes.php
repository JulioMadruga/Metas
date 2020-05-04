<?php
/**
 * Created by PhpStorm.
 * User: julio
 * Date: 12/10/2019
 * Time: 13:13
 */

require_once 'conexao/DB.php';

class Devolucoes extends  DB
{


    public  function index($mes,$cood,$rca)
    {


        $sql = "SELECT sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) as Total from $mes a, usuarios b 
                where a.VENDEDOR = b.Rca and a.Valor_total <0 and b.super = '$cood' and VENDEDOR = $rca GROUP by b.nome";

        $stm = DB::prepare($sql);
        $stm->execute();


        return $stm->fetchObject();


    }



    public  function total($mes,$cood)
    {


        $sql = "SELECT sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) as Total from $mes a, usuarios b 
                where a.VENDEDOR = b.Rca and a.Valor_total <0 and b.super = '$cood'";

        $stm = DB::prepare($sql);
        $stm->execute();


        return $stm->fetchObject();


    }






}