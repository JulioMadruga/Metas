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
    public $meta;

    /**
     * @return mixed
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @param mixed $meta
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;
    }

    public function AtualizaPosit ($baton, $bisc, $geral)
    {

        if (empty($geral)) {

            $sql = "UPDATE $this->meta set Rbaton = 0, Rbisc = 0, Rgeral = 0 ";
            $stm = DB::prepare($sql);
            $stm->execute();
        } else {

            foreach ($baton as $value) {

                $sql = "UPDATE $this->meta set Rbaton = '$value->realizado' where Rca = '$value->rca'";
                $stm = DB::prepare($sql);
                $stm->execute();

            }

            foreach ($bisc as $value) {

                $sql = "UPDATE $this->meta set Rbisc = '$value->realizado' where Rca = '$value->rca'";
                $stm = DB::prepare($sql);
                $stm->execute();

            }

            foreach ($geral as $value) {

                $sql = "UPDATE $this->meta set Rgeral = '$value->realizado' where Rca = '$value->rca'";
                $stm = DB::prepare($sql);
                $stm->execute();

            }


        }


    }

    public function AtualizaVenda($choc,$bisc,$total){

        if (empty($total)){

            $sql = "UPDATE $this->meta set RVendaChoc = 0, RVendaBisc = 0, RVendaTotal = 0 ";
            $stm = DB::prepare($sql);
            $stm->execute();
        }else{

            foreach ($choc as $value){

                $sql = "UPDATE $this->meta set RVendaChoc = '$value->realizado' where Rca = '$value->rca'";
                $stm = DB::prepare($sql);
                $stm->execute();

            }

            foreach ($bisc as $value){

                $sql = "UPDATE $this->meta set RVendaBisc = '$value->realizado' where Rca = '$value->rca'";
                $stm = DB::prepare($sql);
                $stm->execute();

            }

            foreach ($total as $value){

                $sql = "UPDATE $this->meta set RVendaTotal = '$value->realizado' where Rca = '$value->rca'";
                $stm = DB::prepare($sql);
                $stm->execute();

            }




        }




    }


    public function AtualizaMix($metaMixchoc,$metaMixbisc,$RmixChoc, $RmixBisc){

        if (empty($RmixChoc)){

            $sql = "UPDATE $this->meta set  RMixChoc= 0 ";
            $stm = DB::prepare($sql);
            $stm->execute();

            foreach ($metaMixchoc as $value){

                $sql = "UPDATE $this->meta set MetaMixChoc = '$value->total' where Rca = '$value->rca'";
                $stm = DB::prepare($sql);
                $stm->execute();

            }

        }else{

            foreach ($metaMixchoc as $value){

                $sql = "UPDATE $this->meta set MetaMixChoc = '$value->total' where Rca = '$value->rca'";
                $stm = DB::prepare($sql);
                $stm->execute();

            }

            foreach ($RmixChoc as $value){

                $sql = "UPDATE $this->meta set RMixChoc = '$value->total' where Rca = '$value->rca'";
                $stm = DB::prepare($sql);
                $stm->execute();

            }



        }



        if (empty($RmixBisc)){

            $sql = "UPDATE $this->meta set RMixBisc= 0 ";
            $stm = DB::prepare($sql);
            $stm->execute();


            foreach ($metaMixbisc as $value){

                $sql = "UPDATE $this->meta set MetaMixBisc = '$value->total' where Rca = '$value->rca'";
                $stm = DB::prepare($sql);
                $stm->execute();

            }

        }else{

            foreach ($metaMixbisc as $value){

                $sql = "UPDATE $this->meta set MetaMixBisc = '$value->total' where Rca = '$value->rca'";
                $stm = DB::prepare($sql);
                $stm->execute();

            }

            foreach ($RmixBisc as $value){

                $sql = "UPDATE $this->meta set RMixBisc = '$value->total' where Rca = '$value->rca'";
                $stm = DB::prepare($sql);
                $stm->execute();

            }



        }




    }




    public function ResultCoodGeral($cood){

        $sql = "SELECT a.rca, b.nome, a.tab, a.Rgeral, a.meta_baton, a.Rbaton, a.trimarca, a.Rbisc, a.MetaMixChoc, a.RmixChoc, a.MetaMixBisc, 
                a.RMixBisc, a.valor_choc, a.RVendaChoc, a.valor_bisc, a.RVendaBisc, a.valor, a.RVendaTotal FROM `$this->meta`a, `usuarios` b 
                WHERE a.rca = b.Rca and b.super = '$cood' ORDER by b.nome";

        $stm = DB::prepare($sql);
        $stm->execute();
        $stm = $stm->fetchAll();

        return $stm;


    } public function ResultCoodGeral2($cood){

    $sql = "SELECT a.rca, b.nome, Sum(a.tab) as Mgeral, Sum(a.Rgeral) as Rgeral, Sum(a.meta_baton) as Mbaton, Sum(a.Rbaton) as Rbaton, Sum(a.trimarca) as Mbisc, Sum(a.Rbisc) as Rbisc, Sum(a.MetaMixChoc) as MetaMixChoc , Sum(a.RmixChoc) as RmixChoc , 
                Sum(a.MetaMixBisc) as MetaMixBisc, Sum(a.RMixBisc) as RMixBisc , round(Sum(a.valor_choc),2) as valor_choc, round(Sum(a.RVendaChoc),2) as RVendaChoc, round(Sum(a.valor_bisc),2) as valor_bisc, round(Sum(a.RVendaBisc),2) as RVendaBisc, 
                round(Sum(a.valor),2) as Valor, round(Sum(a.RVendaTotal),2) as RVendaTotal FROM `$this->meta`a, `usuarios` b 
                WHERE a.rca = b.Rca and b.super = '$cood' ORDER by b.nome";

    $stm = DB::prepare($sql);
    $stm->execute();
    $stm = $stm->fetchObject();

    return $stm;


}





    public function ResultCoodGeralTotal($cood){

        $sql = "SELECT a.rca, b.nome, Sum(a.tab) as Mgeral, Sum(a.Rgeral) as Rgeral, Sum(a.meta_baton) as Mbaton, Sum(a.Rbaton) as Rbaton, Sum(a.trimarca) as Mbisc, Sum(a.Rbisc) as Rbisc, Sum(a.MetaMixChoc) as MetaMixChoc , Sum(a.RmixChoc) as RmixChoc , 
                Sum(a.MetaMixBisc) as MetaMixBisc, Sum(a.RMixBisc) as RMixBisc , round(Sum(a.valor_choc),2) as valor_choc, round(Sum(a.RVendaChoc),2) as RVendaChoc, round(Sum(a.valor_bisc),2) as valor_bisc, round(Sum(a.RVendaBisc),2) as RVendaBisc, 
                round(Sum(a.valor),2) as Valor, round(Sum(a.RVendaTotal),2) as RVendaTotal FROM `$this->meta`a, `usuarios` b 
                WHERE a.rca = b.Rca and b.super = '$cood' ORDER by b.nome";

        $stm = DB::prepare($sql);
        $stm->execute();
        $stm = $stm->fetchAll();

        return $stm;


    }


    public function ResultGeral(){

        $sql = "SELECT Sum(a.tab) as Mgeral, Sum(a.Rgeral) as Rgeral, Sum(a.meta_baton) as Mbaton, Sum(a.Rbaton) as Rbaton, Sum(a.trimarca) as Mbisc, Sum(a.Rbisc) as Rbisc, Sum(a.MetaMixChoc) as MetaMixChoc , Sum(a.RmixChoc) as RmixChoc , 
                Sum(a.MetaMixBisc) as MetaMixBisc, Sum(a.RMixBisc) as RMixBisc , round(Sum(a.valor_choc),2) as valor_choc, round(Sum(a.RVendaChoc),2) as RVendaChoc, round(Sum(a.valor_bisc),2) as valor_bisc, round(Sum(a.RVendaBisc),2) as RVendaBisc, 
                round(Sum(a.valor),2) as Valor, round(Sum(a.RVendaTotal),2) as RVendaTotal FROM `$this->meta`a, `usuarios` b 
                WHERE a.rca = b.Rca ORDER by b.nome";

        $stm = DB::prepare($sql);
        $stm->execute();
        $stm = $stm->fetchAll();

        return $stm;


    }

    public function ResultGeralNorte(){

        $sql = "SELECT Sum(a.tab) as Mgeral, Sum(a.Rgeral) as Rgeral, Sum(a.meta_baton) as Mbaton, Sum(a.Rbaton) as Rbaton, Sum(a.trimarca) as Mbisc, Sum(a.Rbisc) as Rbisc, Sum(a.MetaMixChoc) as MetaMixChoc , Sum(a.RmixChoc) as RmixChoc , 
                Sum(a.MetaMixBisc) as MetaMixBisc, Sum(a.RMixBisc) as RMixBisc , round(Sum(a.valor_choc),2) as valor_choc, round(Sum(a.RVendaChoc),2) as RVendaChoc, round(Sum(a.valor_bisc),2) as valor_bisc, round(Sum(a.RVendaBisc),2) as RVendaBisc, 
                round(Sum(a.valor),2) as Valor, round(Sum(a.RVendaTotal),2) as RVendaTotal FROM `$this->meta`a, `usuarios` b 
                WHERE a.rca = b.Rca and b.regiao = 'Norte'  ORDER by b.nome";

        $stm = DB::prepare($sql);
        $stm->execute();
        $stm = $stm->fetchAll();

        return $stm;


    }

    public function ResultGeralSul(){

        $sql = "SELECT Sum(a.tab) as Mgeral, Sum(a.Rgeral) as Rgeral, Sum(a.meta_baton) as Mbaton, Sum(a.Rbaton) as Rbaton, Sum(a.trimarca) as Mbisc, Sum(a.Rbisc) as Rbisc, Sum(a.MetaMixChoc) as MetaMixChoc , Sum(a.RmixChoc) as RmixChoc , 
                Sum(a.MetaMixBisc) as MetaMixBisc, Sum(a.RMixBisc) as RMixBisc , round(Sum(a.valor_choc),2) as valor_choc, round(Sum(a.RVendaChoc),2) as RVendaChoc, round(Sum(a.valor_bisc),2) as valor_bisc, round(Sum(a.RVendaBisc),2) as RVendaBisc, 
                round(Sum(a.valor),2) as Valor, round(Sum(a.RVendaTotal),2) as RVendaTotal FROM `$this->meta`a, `usuarios` b 
                WHERE a.rca = b.Rca and b.regiao = 'Sul'  ORDER by b.nome";

        $stm = DB::prepare($sql);
        $stm->execute();
        $stm = $stm->fetchAll();

        return $stm;


    }





}