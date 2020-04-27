<?php
/**
 * Created by PhpStorm.
 * User: julio
 * Date: 12/10/2019
 * Time: 13:13
 */

require_once 'conexao/DB.php';

class Venda extends  DB
{
     public $TabMes;

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
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @param mixed $Id
     */
    public function setId($Id)
    {
        $this->Id = $Id;
    }
     public $Id;



    public  function all()
        {


            $sql = "SELECT ID,Nome_parceiro, VENDEDOR,  sum(cast(replace(replace(Valor_total, '.', ''), ',', '.') as decimal(10,2))) as total, n_nf, data_doc 
                    FROM $this->TabMes WHERE VENDEDOR = $this->Id GROUP BY n_nf order by n_nf";

            $stm = DB::prepare($sql);
            $stm->execute();


            return $stm->fetchAll();


        }



    public  function total()
    {


        $sql = "SELECT sum(cast(replace(replace(Valor_total, '.', ''), ',', '.') as decimal(10,2))) as total FROM $this->TabMes WHERE VENDEDOR = $this->Id";

        print_r($sql);

        $stm = DB::prepare($sql);
        $stm->execute();


        return $stm->fetchAll();


    }





}