<?php
/**
 * Created by PhpStorm.
 * User: julio
 * Date: 12/10/2019
 * Time: 13:13
 */

require_once 'conexao/DB.php';

class CadCli extends  DB
{


    public  function Cad_all($rca)
    {


        $sql = "Select rca,cnpj,razao,estado, obs, DATE_FORMAT(dataini ,'%d/%m/%Y') as dataini,
                                                         DATE_FORMAT(datafim ,'%d/%m/%Y')AS datafim, email,contato,fone from solicitacao where rca = $rca ORDER BY estado desc, dataini DESC";

        $stm = DB::prepare($sql);
        $stm->execute();


        return $stm->fetchAll();


    }








}