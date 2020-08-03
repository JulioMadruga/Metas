<?php
/**
 * Created by PhpStorm.
 * User: julio
 * Date: 12/10/2019
 * Time: 13:13
 */

require_once 'conexao/DB.php';

class ClientesBase extends  DB
{

    public $rca;

    /**
     * @return mixed
     */
    public function getRca()
    {
        return $this->rca;
    }

    /**
     * @param mixed $rca
     */
    public function setRca($rca)
    {
        $this->rca = $rca;
    }





    public  function index()
    {


        $sql = "SELECT b.rca, a. * FROM `clientes_sap`a, clientes_flexx b WHERE a.cod_cli = b.cod_cli and b.rca = $this->rca ";

        $stm = DB::prepare($sql);
        $stm->execute();
        $stm = $stm->fetchAll();

        return $stm;



    }

    public  function find_cli($id)
    {


        $sql = "SELECT b.rca, c.nome, a. * FROM `clientes_sap`a, clientes_flexx b, usuarios c WHERE a.cod_cli = b.cod_cli AND b.rca = c.rca and a.cod_cli = $id ";

        $stm = DB::prepare($sql);
        $stm->execute();
        $stm = $stm->fetchAll();

        return $stm;



    }





}