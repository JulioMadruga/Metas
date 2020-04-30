<?php
/**
 * Created by PhpStorm.
 * User: julio
 * Date: 12/10/2019
 * Time: 13:13
 */

require_once 'conexao/DB.php';

class PositBaton extends  DB
{

    public $id;
    public $TabMes;
    public $TabMeta;
    public $Baton;

    /**
     * @return mixed
     */
    public function getBaton()
    {
        return $this->Baton;
    }

    /**
     * @param mixed $Baton
     */
    public function setBaton($Baton)
    {
        $this->Baton = $Baton;
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


        $sql = "SELECT meta_baton, COUNT(NOME_parceiro) as realizado FROM (SELECT b.VENDEDOR, a.NOME_PARCEIRO, b.meta_baton, b.rca FROM 
                $this->TabMes a, $this->TabMeta b where a.MATERIAL IN ($this->Baton)
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

            $sql = "SELECT meta_baton from $this->TabMeta where Rca = $this->id ";

            $stm = DB::prepare($sql);
            $stm->execute();
            $stm = $stm->fetchAll();

            return $stm;

        }


    public function PositAll(){

        $sql = "SELECT a.ID, b.razao FROM $this->TabMes a, clientes b where a.vendedor = b.rca AND a.ID=b.Cod_Cli and a.MATERIAL IN ($this->Baton) and a.Quantidade>0 and a.VENDEDOR=$this->id GROUP by id";

        $stm = DB::prepare($sql);
        $stm->execute();
        $stm = $stm->fetchAll();

        return $stm;

    }



    public function NotPosit(){

        $sql = "SELECT Cod_Cli, razao FROM clientes WHERE rca = $this->id AND Cod_cli not in(SELECT a.ID FROM $this->TabMes a, clientes b where a.vendedor = b.rca AND a.ID=b.Cod_Cli and a.MATERIAL IN ($this->Baton) and a.Quantidade>0 and a.VENDEDOR=$this->id GROUP by id) order by Cod_cli";

        $stm = DB::prepare($sql);
        $stm->execute();
        $stm = $stm->fetchAll();

        return $stm;

    }


    public function PositGeral(){

        $sql = "SELECT rca, COUNT(id) as realizado FROM (SELECT b.rca, a.id FROM $this->TabMes a, usuarios b where a.MATERIAL IN ($this->Baton) AND a.QUANTIDADE>0 and a.vendedor = b.rca group by a.id)SUB GROUP BY rca";

        $stm = DB::prepare($sql);
        $stm->execute();
        $stm = $stm->fetchAll();

        return $stm;

    }




}