<?php
/**
 * Created by PhpStorm.
 * User: julio
 * Date: 12/10/2019
 * Time: 13:13
 */

require_once 'conexao/DB.php';

class MixBisc extends  DB
{

    public $id;
    public $TabMes;
    public $TabMeta;


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



    public function TotPontos(){


        $sql = "SELECT rca, total from ( select rca, vendedor, sum(total) as total from (SELECT rca, vendedor, hierarquia, if(hierarquia=5534716,(total * 1), 
             if(hierarquia=5534705,(total * 2), if(hierarquia=5534707,(total * 4), if(hierarquia=5534706,(total * 3), if(hierarquia=5534708,(total * 1), if(hierarquia=5534712,(total * 4), 
             if(hierarquia=5534714,(total * 4), total ))))))) as total from (SELECT rca, vendedor,hierarquia, COUNT(hierarquia) as total FROM `clientes` where 
             hierarquia in (5534707,5534712,5534714,5534706,5534705,5534716,5534708) GROUP by hierarquia, rca ORDER by rca)sub)sub GROUP by rca) sub where Rca = $this->id";

        $stm = DB::prepare($sql);
        $stm->execute();


        return $stm->fetchAll();



    }

    public function RealPontos(){


        $sql = "SELECT b.vendedor, sum(a.total) as total FROM `hierarquia_bisc_$this->TabMes` a, $this->TabMeta b, 
                  usuarios c where a.vendedor = b.Rca and b.Rca =c.Rca and c.Rca = $this->id GROUP BY b.vendedor";

        $stm = DB::prepare($sql);
        $stm->execute();


        return $stm->fetchAll();



    }

    public function MPercent(){

        $sql = "SELECT topbisc from $this->TabMeta where Rca = $this->id ";

        $stm = DB::prepare($sql);
        $stm->execute();


        return $stm->fetchAll();



    }


    public function TotPontosGeral(){


        $sql = "SELECT rca, total from ( select rca, vendedor, sum(total) as total from (SELECT rca, vendedor, hierarquia, if(hierarquia=5534716,(total * 1), 
             if(hierarquia=5534705,(total * 2), if(hierarquia=5534707,(total * 4), if(hierarquia=5534706,(total * 3), if(hierarquia=5534708,(total * 1), if(hierarquia=5534712,(total * 4), 
             if(hierarquia=5534714,(total * 4), total ))))))) as total from (SELECT rca, vendedor,hierarquia, COUNT(hierarquia) as total FROM `clientes` where 
             hierarquia in (5534707,5534712,5534714,5534706,5534705,5534716,5534708) GROUP by hierarquia, rca ORDER by rca)sub)sub GROUP by rca) sub";

        $stm = DB::prepare($sql);
        $stm->execute();


        return $stm->fetchAll();



    }


    public function TotRealPontos(){


        $sql = "SELECT b.rca, sum(a.total) as total FROM `hierarquia_bisc_$this->TabMes` a, usuarios b where a.vendedor = b.Rca GROUP BY b.rca";

        $stm = DB::prepare($sql);
        $stm->execute();


        return $stm->fetchAll();



    }


    public function MPercentGeral(){

        $sql = "SELECT round(AVG(topbisc),2) as media FROM $this->TabMeta ";

        $stm = DB::prepare($sql);
        $stm->execute();


        return $stm->fetchAll();



    }







}