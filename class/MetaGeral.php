<?php
/**
 * Created by PhpStorm.
 * User: julio
 * Date: 12/10/2019
 * Time: 13:13
 */

require_once 'conexao/DB.php';

class MetaGeral extends  DB
{

    function __construct($meta, $baton, $bisc, $geral)
    {

        if (empty($geral)) {

            $sql = "UPDATE $meta set Rbaton = 0, Rbisc = 0, Rgeral = 0 ";
            $stm = DB::prepare($sql);
            $stm->execute();
        } else {

            foreach ($baton as $value) {

                $sql = "UPDATE $meta set Rbaton = '$value->realizado' where Rca = '$value->rca'";
                $stm = DB::prepare($sql);
                $stm->execute();

            }

            foreach ($bisc as $value) {

                $sql = "UPDATE $meta set Rbisc = '$value->realizado' where Rca = '$value->rca'";
                $stm = DB::prepare($sql);
                $stm->execute();

            }

            foreach ($geral as $value) {

                $sql = "UPDATE $meta set Rgeral = '$value->realizado' where Rca = '$value->rca'";
                $stm = DB::prepare($sql);
                $stm->execute();

            }


        }


    }

    public function AtualizaVenda($meta,$choc,$bisc,$total){

        if (empty($total)){

            $sql = "UPDATE $meta set RVendaChoc = 0, RVendaBisc = 0, RVendaTotal = 0 ";
            $stm = DB::prepare($sql);
            $stm->execute();
        }else{

            foreach ($choc as $value){

                $sql = "UPDATE $meta set RVendaChoc = '$value->realizado' where Rca = '$value->rca'";
                $stm = DB::prepare($sql);
                $stm->execute();

            }

            foreach ($bisc as $value){

                $sql = "UPDATE $meta set RVendaBisc = '$value->realizado' where Rca = '$value->rca'";
                $stm = DB::prepare($sql);
                $stm->execute();

            }

            foreach ($total as $value){

                $sql = "UPDATE $meta set RVendaTotal = '$value->realizado' where Rca = '$value->rca'";
                $stm = DB::prepare($sql);
                $stm->execute();

            }




        }




    }






}