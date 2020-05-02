<?php

require_once 'conexao/DB.php';

class Vendabisc extends DB
{

    public $tabMes;
    public $tabMeta;
    public $Bisc;
    public $id;

    /**
     * @return mixed
     */
    public function getTabMes()
    {
        return $this->tabMes;
    }

    /**
     * @param mixed $tabMes
     */
    public function setTabMes($tabMes)
    {
        $this->tabMes = $tabMes;
    }

    /**
     * @return mixed
     */
    public function getTabMeta()
    {
        return $this->tabMeta;
    }

    /**
     * @param mixed $tabMeta
     */
    public function setTabMeta($tabMeta)
    {
        $this->tabMeta = $tabMeta;
    }

    /**
     * @return mixed
     */
    public function getBisc()
    {
        return $this->Bisc;
    }

    /**
     * @param mixed $Bisc
     */
    public function setBisc($Bisc)
    {
        $this->Bisc = $Bisc;
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






    public function index(){


        $sql = "SELECT a.VENDEDOR, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) as Tot, cast((b.valor_bisc) as decimal(10,2)) as meta,
         if(cast((b.valor_bisc - sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))))as decimal(10,2))<0,0,cast((b.valor_bisc - sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))))as decimal(10,2))) as dif 
        FROM $this->tabMes a, $this->tabMeta b where a.VENDEDOR = b.rca and a.VENDEDOR = $this->id and a.material in ($this->Bisc)";

       // print_r($sql);


        $stm = DB::prepare($sql);
        $stm->execute();
        $stm = $stm->fetchAll();


        if(isset($stm[0]->Tot)){

            return $stm;
        }else{

            return  $this->meta();

        }




    }


    public function meta(){

        $sql = "SELECT valor_bisc from $this->tabMeta where Rca = $this->id ";

        $stm = DB::prepare($sql);
        $stm->execute();
        $stm = $stm->fetchAll();

        return $stm;

    }


    public  function TotalRcaBisc()
    {


        $sql = "SELECT vendedor as rca, sum(cast(replace(replace(Valor_total, '.', ''), ',', '.') as decimal(10,2))) as realizado FROM $this->tabMes where material in ($this->Bisc) group by vendedor";

        //print_r($sql);

        $stm = DB::prepare($sql);
        $stm->execute();


        return $stm->fetchAll();


    }






}


