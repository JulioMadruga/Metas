<?php
/**
 * Created by PhpStorm.
 * User: julio
 * Date: 12/10/2019
 * Time: 13:13
 */

require_once 'conexao/DB.php';

class Cood extends  DB
{
    public $mes;
    public $cood;
    public $sortido;
    public $serenata;
    public $baton;
    public $bisc;
    public $talento25;
    public $talento90;
    public $jumbo;
    public $pastilha;
    public $po;

    /**
     * @return mixed
     */
    public function getMes()
    {
        return $this->mes;
    }

    /**
     * @param mixed $mes
     */
    public function setMes($mes)
    {
        $this->mes = $mes;
    }

    /**
     * @return mixed
     */
    public function getCood()
    {
        return $this->cood;
    }

    /**
     * @param mixed $cood
     */
    public function setCood($cood)
    {
        $this->cood = $cood;
    }

    /**
     * @return mixed
     */
    public function getSortido()
    {
        return $this->sortido;
    }

    /**
     * @param mixed $sortido
     */
    public function setSortido($sortido)
    {
        $this->sortido = $sortido;
    }

    /**
     * @return mixed
     */
    public function getSerenata()
    {
        return $this->serenata;
    }

    /**
     * @param mixed $serenata
     */
    public function setSerenata($serenata)
    {
        $this->serenata = $serenata;
    }

    /**
     * @return mixed
     */
    public function getBaton()
    {
        return $this->baton;
    }

    /**
     * @param mixed $baton
     */
    public function setBaton($baton)
    {
        $this->baton = $baton;
    }

    /**
     * @return mixed
     */
    public function getBisc()
    {
        return $this->bisc;
    }

    /**
     * @param mixed $bisc
     */
    public function setBisc($bisc)
    {
        $this->bisc = $bisc;
    }

    /**
     * @return mixed
     */
    public function getTalento25()
    {
        return $this->talento25;
    }

    /**
     * @param mixed $talento25
     */
    public function setTalento25($talento25)
    {
        $this->talento25 = $talento25;
    }

    /**
     * @return mixed
     */
    public function getTalento90()
    {
        return $this->talento90;
    }

    /**
     * @param mixed $talento90
     */
    public function setTalento90($talento90)
    {
        $this->talento90 = $talento90;
    }

    /**
     * @return mixed
     */
    public function getJumbo()
    {
        return $this->jumbo;
    }

    /**
     * @param mixed $jumbo
     */
    public function setJumbo($jumbo)
    {
        $this->jumbo = $jumbo;
    }

    /**
     * @return mixed
     */
    public function getPastilha()
    {
        return $this->pastilha;
    }

    /**
     * @param mixed $pastilha
     */
    public function setPastilha($pastilha)
    {
        $this->pastilha = $pastilha;
    }

    /**
     * @return mixed
     */
    public function getPo()
    {
        return $this->po;
    }

    /**
     * @param mixed $po
     */
    public function setPo($po)
    {
        $this->po = $po;
    }




    public  function Cood_all()
    {


        $sql = "SELECT DISTINCT super FROM usuarios where super <> '' ORDER by regiao, super";

        $stm = DB::prepare($sql);
        $stm->execute();


        return $stm->fetchAll();


    }

    public  function ConsultaMeta()
    {


        $sql = "Select supervisor from campanha_super where mes = '$this->mes' and supervisor = '$this->cood'";

        $stm = DB::prepare($sql);
        $stm->execute();


        return $stm->fetchAll();


    }


    public  function Cad_Meta()
    {


        $sql = "INSERT INTO campanha_super (mes,supervisor,sortidoM,sortidoF,sortidoT,serenataM,serenataF,serenataT,batomM,batomF,batomT,biscM,biscF,biscT,talento25M,talento2F,talento25T,talento90M,talento90F,talento90T,jumboM,jumboF,jumboT,pastilhaM,pastilhaF,pastilhaT,posM,posF,posT)
                values ('$this->mes','$this->cood',$this->sortido,0,0,$this->serenata,0,0,$this->baton,0,0,$this->bisc,0,0,$this->talento25,0,0,$this->talento90,0,0,$this->jumbo,0,0,$this->pastilha,0,0,$this->po,0,0)";

        var_dump($sql);
        $stm = DB::prepare($sql);
        $stm->execute();


        return "Cadastrado";


    }

    public  function UPmeta()
    {


        $sql = "UPDATE campanha_super set sortidoM = $this->sortido,serenataM = $this->serenata, batomM = $this->baton, biscM = $this->bisc,
                talento25M = $this->talento25,talento90M = $this->talento90,jumboM = $this->jumbo,pastilhaM = $this->pastilha,posM = $this->po
                where supervisor = '$this->cood' and mes = '$this->mes'";

        var_dump($sql);
        $stm = DB::prepare($sql);
        $stm->execute();


        return "Atualizado";


    }


    public  function MetaPosit($meta)
    {


        $sql = "SELECT  sum(a.meta_baton) as baton, sum(a.trimarca) as bisc, sum(a.tab) as geral FROM `$meta`a, usuarios b WHERE a.rca = b.rca and super = '$this->cood'";


        $stm = DB::prepare($sql);
        $stm->execute();


        return $stm->fetchAll();


    }






}