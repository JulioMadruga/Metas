<?php
/**
 * Created by PhpStorm.
 * User: julio
 * Date: 12/10/2019
 * Time: 13:13
 */

require_once 'conexao/DB.php';

class PositJumbos extends  DB
{

    public $id;
    public $TabMes;
    public $TabMeta;
    public $Jumbos;

    /**
     * @return mixed
     */
    public function getJumbos()
    {
        return $this->Jumbos;
    }

    /**
     * @param mixed $Jumbos
     */
    public function setJumbos($Jumbos)
    {
        $this->Jumbos = $Jumbos;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTabMes()
    {
        return $this->TabMes;
    }

    /**
     * @param mixed $TabMes
     */
    public function setTabMes($TabMes)
    {
        $this->TabMes = $TabMes;
    }

    /**
     * @return mixed
     */
    public function getTabMeta()
    {
        return $this->TabMeta;
    }

    /**
     * @param mixed $TabMeta
     */
    public function setTabMeta($TabMeta)
    {
        $this->TabMeta = $TabMeta;
    }




    public  function index()
    {


        $sql = "SELECT posit_jumbos, COUNT(NOME_parceiro) as realizado FROM (SELECT b.VENDEDOR, a.NOME_PARCEIRO, b.posit_jumbos, b.rca FROM 
                $this->TabMes a, $this->TabMeta b where a.MATERIAL IN ($this->Jumbos)
                 AND a.QUANTIDADE>0 and a.vendedor = b.rca group by a.id)SUB where rca = $this->id GROUP BY VENDEDOR";

        $stm = DB::prepare($sql);
        $stm->execute();
        $stm = $stm->fetchAll();

        if(!empty($stm)){

            return $stm;
        }else{

            return  $this->meta();

        }




    }


        public function meta(){

            $sql = "SELECT posit_jumbos from $this->TabMeta where Rca = $this->id ";

            $stm = DB::prepare($sql);
            $stm->execute();
            $stm = $stm->fetchAll();

            return $stm;

        }


    public function PositAll(){

        $sql = "SELECT a.ID, b.razao FROM $this->TabMes a, clientes b where a.vendedor = b.rca AND a.ID=b.Cod_Cli and a.MATERIAL IN ($this->Jumbos) and a.Quantidade>0 and a.VENDEDOR=$this->id GROUP by id";

        $stm = DB::prepare($sql);
        $stm->execute();
        $stm = $stm->fetchAll();

        return $stm;

    }



    public function NotPosit(){

        $sql = "SELECT Cod_Cli, razao FROM clientes WHERE rca = $this->id AND Cod_cli not in(SELECT a.ID FROM $this->TabMes a, clientes b where a.vendedor = b.rca AND a.ID=b.Cod_Cli and a.MATERIAL IN ($this->Jumbos) and a.Quantidade>0 and a.VENDEDOR=$this->id GROUP by id) order by Cod_cli";

        $stm = DB::prepare($sql);
        $stm->execute();
        $stm = $stm->fetchAll();

        return $stm;

    }


    public function PositGeral(){

        $sql = "SELECT rca, COUNT(id) as realizado FROM (SELECT b.rca, a.id FROM $this->TabMes a, usuarios b where a.MATERIAL IN ($this->Jumbos) AND a.QUANTIDADE>0 and a.vendedor = b.rca group by a.id)SUB GROUP BY rca";

        $stm = DB::prepare($sql);
        $stm->execute();
        $stm = $stm->fetchAll();

        return $stm;

    }

    public function PositCoodJum($cood){


        $sql = "SELECT sum(realizado) as total from(SELECT rca, COUNT(id) as realizado FROM (SELECT b.rca, a.id FROM $this->TabMes a, usuarios b where 
                a.MATERIAL IN ($this->Jumbos) AND a.QUANTIDADE>0 and a.vendedor = b.rca and b.super = '$cood' group by a.id)SUB GROUP BY rca) sub";

        $stm = DB::prepare($sql);
        $stm->execute();
        $stm = $stm->fetchObject();

        return $stm;

    }









}