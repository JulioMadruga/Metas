<?php
/**
 * Created by PhpStorm.
 * User: JULIO
 * Date: 14/06/2018
 * Time: 08:30
 */
require_once 'conexao/DB.php';
class ImportarCSV extends DB
{
    public $arquivo;
    public $nome;
    public $delimiter = ";";
    public $linhaDelimiter = "\\n";

    public function getNome()
    {
        return $this->nome;
    }


    public function setNome($nome)
    {
        $this->nome = $nome;
    }


    public function getArquivo()
    {
        return $this->arquivo;
    }


    public function setArquivo($arquivo)
    {
        $this->arquivo = $arquivo;
    }

    public function clientes(){

        $sql = "Truncate Table clientes ";
        $stm = DB::prepare($sql);
        $stm->execute();


        foreach(($dados = fgetcsv($this->arquivo, 1000, ";")) as $row):

            $verific = count($dados);

        endforeach;

        If ($verific == 7){


            $sql = "LOAD DATA LOCAL INFILE '$this->nome'
                     INTO TABLE clientes FIELDS TERMINATED BY '$this->delimiter'
                     LINES TERMINATED BY '$this->linhaDelimiter' IGNORE 1 LINES
                   (cod_cli,razao,rca,vendedor,hierarquia,cnpj,cidade)";

            $stm = DB::prepare($sql);

            try{
                $stm->execute();
            }catch(PDOException $e){
                echo $e->getMessage();
            }

            return $result = 'atualizado';


        }else{

            return $result = 'erro';
        }




    }




}