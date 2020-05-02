<?php
/**
 * Created by PhpStorm.
 * User: julio
 * Date: 12/10/2019
 * Time: 13:13
 */

require_once 'conexao/DB.php';

class MixIdeal extends  DB
{


    public  function PontosChoc()
    {


        $sql = "Select rca, vendedor, sum(total) as total from (SELECT rca, vendedor, hierarquia, if(hierarquia=5534716,(total * 4), if(hierarquia=5534705,(total * 5), if(hierarquia=5534707,(total * 7), if(hierarquia=5534706,(total * 6), if(hierarquia=5534708,(total * 4), if(hierarquia=5534712,(total * 7), if(hierarquia=5534714,(total * 7), total ))))))) as total
                from (SELECT rca, vendedor,hierarquia, COUNT(hierarquia) as total FROM `clientes` where hierarquia in (5534707,5534712,5534714,5534706,5534705,5534716,5534708) GROUP by hierarquia, rca ORDER by rca)sub)sub GROUP by rca";

        $stm = DB::prepare($sql);
        $stm->execute();


        return $stm->fetchAll();
    }

    public  function PontosBisc()
    {


        $sql = "select rca, vendedor, sum(total) as total from (SELECT rca, vendedor, hierarquia, if(hierarquia=5534716,(total * 1), 
             if(hierarquia=5534705,(total * 2), if(hierarquia=5534707,(total * 4), if(hierarquia=5534706,(total * 3), if(hierarquia=5534708,(total * 1), if(hierarquia=5534712,(total * 4), 
             if(hierarquia=5534714,(total * 4), total ))))))) as total from (SELECT rca, vendedor,hierarquia, COUNT(hierarquia) as total FROM `clientes` where 
             hierarquia in (5534707,5534712,5534714,5534706,5534705,5534716,5534708) GROUP by hierarquia, rca ORDER by rca)sub)sub GROUP by rca";

        $stm = DB::prepare($sql);
        $stm->execute();


        return $stm->fetchAll();
    }







}