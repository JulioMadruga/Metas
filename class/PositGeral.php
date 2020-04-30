<?php
/**
 * Created by PhpStorm.
 * User: julio
 * Date: 12/10/2019
 * Time: 13:13
 */

require_once 'conexao/DB.php';

class PositGeral extends  DB
{

    public $id;
    public $TabMes;
    public $TabMeta;

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


        $sql = "SELECT tab, COUNT(id) as realizado FROM
                (SELECT b.VENDEDOR, a.NOME_PARCEIRO,a.id, b.tab, b.Rca FROM $this->TabMes a, $this->TabMeta b where 
                  a.vendedor = b.rca group by a.id )SUB where rca = $this->id GROUP BY VENDEDOR";

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

            $sql = "SELECT tab from $this->TabMeta where Rca = $this->id ";

            $stm = DB::prepare($sql);
            $stm->execute();
            $stm = $stm->fetchAll();

            return $stm;

        }


    public function PositAll(){

        $sql = "SELECT a.ID, a.Nome_parceiro FROM $this->TabMes a where a.Quantidade>0 and a.VENDEDOR=$this->id GROUP by a.ID";

        $stm = DB::prepare($sql);
        $stm->execute();
        $stm = $stm->fetchAll();

        return $stm;

    }

    public function NotPosit(){

        $sql = "SELECT Cod_Cli, razao FROM clientes WHERE rca = $this->id AND Cod_cli not in(SELECT a.ID FROM $this->TabMes a where a.Quantidade>0 and a.VENDEDOR=$this->id GROUP by a.ID) order by Cod_cli";

        $stm = DB::prepare($sql);
        $stm->execute();
        $stm = $stm->fetchAll();

        return $stm;

    }





}