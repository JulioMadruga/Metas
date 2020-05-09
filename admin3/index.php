<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
require_once '../Database/Conexao.php';
session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.html");
}

//include_once '../Database/conectar.php';

$id = $_SESSION['user_session'];

$dados_user = $conn->prepare("SELECT * FROM usuarios where id = $id");
$dados_user->execute();
$result = $dados_user->fetchAll();

$id_user = $result[0]['id'];
$usuario = $result[0]['nome'];



date_default_timezone_set('America/Cuiaba');


 
//$id = $usuario;
$date = date('Ymd' );
 
 
 $data = date('D');
    $mes = date('M');
    $dia = date('d');
    $ano = date('Y');
    
    $mes_meta = array(
        'Jan' => 'meta1',
        'Feb' => 'meta2',
        'Mar' => 'meta3',
        'Apr' => 'meta4',
        'May' => 'meta5',
        'Jun' => 'meta6',
        'Jul' => 'meta7',
        'Aug' => 'meta8',
        'Nov' => 'meta11',
        'Sep' => 'meta9',
        'Oct' => 'meta10',
        'Dec' => 'meta12'
    );
    
     $mes_extenso = array(
        'Jan' => 'Janeiro',
        'Feb' => 'Fevereiro',
        'Mar' => 'Marco',
        'Apr' => 'Abril',
        'May' => 'Maio',
        'Jun' => 'Junho',
        'Jul' => 'Julho',
        'Aug' => 'Agosto',
        'Nov' => 'Novembro',
        'Sep' => 'Setembro',
        'Oct' => 'Outubro',
        'Dec' => 'Dezembro'
    );
 
 $meta = $mes_meta["$mes"];
 
 $mes = $mes_extenso["$mes"];

// var_dump($mes);
 
 if (isset($_GET['mes'])){
    $meta = $_GET['mes'];
    
    $mes_select = array(
        'meta1' => 'Janeiro',
        'meta2' => 'Fevereiro',
        'meta3' => 'Marco',
        'meta4' => 'Abril',
        'meta5' => 'Maio',
        'meta6' => 'Junho',
        'meta7' => 'Julho',
        'meta8' => 'Agosto',
        'meta11' => 'Novembro',
        'meta9' => 'Setembro',
        'meta10' => 'Outubro',
        'meta12' => 'Dezembro'
    );
    
    $mes = $mes_select["$meta"];
}

$databonus = $conn->prepare("SELECT * FROM bonus where mes = '$mes'");
$databonus->execute();
$resultdatabonus = $databonus->fetchAll();

//var_dump($resu)

$databonus = $resultdatabonus[0][2];




//If (isset($_GET['regiao'])) {
//
//    $regiao = $_GET['regiao'];
//
//
//    $consulta_sup = $conn->prepare("SELECT DISTINCT a.nome FROM supervisor a, usuarios b WHERE a.rca = b.rca and  b.regiao = '$regiao' ORDER by nome");
//
//    $consulta_sup->execute();
//    $result_sup = $consulta_sup->fetchAll();
//
////var_dump($result_sup);
//
//
//    $i = 0;
//
//    foreach ($result_sup as $row) {
//
//
//        $consulta_vendas[$i] = $conn->prepare("SELECT b.VENDEDOR, sum(cast(replace(replace(a.Liquido, '.', ''), ',', '.') as decimal(10,2))) as peso, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2)))
//                                          as Total, b.Vendedor, b.kg, b.valor FROM $mes a, $meta b, usuarios c where a.VENDEDOR = b.rca and a.vendedor = c.rca and c.regiao = '$regiao' and c.super = '$row[0]' group by c.nome");
//        //var_dump($consulta_vendas[$i]);
//        $consulta_vendas[$i]->execute();
//        $result_vendas[$i] = $consulta_vendas[$i]->fetchAll();
//
//        // var_dump($result_vendas[$i]);
//
//
//        $consulta_meta[$i] = $conn->prepare("select a.vendedor, a.kg, a.valor, b.Rca from $meta a, usuarios b where a.Vendedor=b.nome and b.regiao = '$regiao' and b.super = '$row[0]' order by a.vendedor");
//        //var_dump($consulta_meta[$i]);
//        $consulta_meta[$i]->execute();
//        $result_meta[$i] = $consulta_meta[$i]->fetchAll();
//
//        $consulta_dev[$i] = $conn->prepare("SELECT a.VENDEDOR, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) as Total from $mes a, usuarios b where a.VENDEDOR = b.Rca and a.Valor_total <0 and b.regiao = '$regiao' and b.super = '$row[0]' GROUP by b.nome");
//        //var_dump($consulta_dev[$i]);
//        $consulta_dev[$i]->execute();
//        $result_dev[$i] = $consulta_dev[$i]->fetchAll();
//
//        //var_dump($result_meta[$i]);
//
//        $consulta_real_super[$i] = $conn->prepare("SELECT sum(cast(replace(replace(a.Liquido, '.', ''), ',', '.') as decimal(10,2))) as peso, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) as Total FROM $mes a, usuarios b where a.vendedor = b.rca and b.regiao ='$regiao' and b.super = '$row[0]'");
//        // var_dump($consulta_real_super);
//        $consulta_real_super[$i]->execute();
//        $result_real_super[$i] = $consulta_real_super[$i]->fetchAll();
//
//        $consulta_meta_super[$i] = $conn->prepare("SELECT ROUND(SUM(a.kg), 2) as peso, ROUND(SUM(a.valor), 2) as Total FROM $meta a, usuarios b WHERE a.rca = b.rca and b.regiao = '$regiao' and b.super = '$row[0]'  ");
//        $consulta_meta_super[$i]->execute();
//        $result_meta_super[$i] = $consulta_meta_super[$i]->fetchAll();
//
//        $consulta_dev_super[$i] = $conn->prepare("SELECT a.VENDEDOR, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) as Total from $mes a, usuarios b where a.VENDEDOR = b.Rca and a.Valor_total <0 and b.regiao = '$regiao' and b.super = '$row[0]'");
//        //var_dump($consulta_dev[$i]);
//        $consulta_dev_super[$i]->execute();
//        $result_dev_super[$i] = $consulta_dev_super[$i]->fetchAll();
//
//
//        $consulta_totalreal_choc = $conn->prepare("SELECT sum(cast(replace(replace(a.Liquido, '.', ''), ',', '.') as decimal(10,2))) as peso, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) as Total FROM $mes a, usuarios b where a.vendedor = b.rca and b.regiao = '$regiao' ");
//        $consulta_totalreal_choc->execute();
//        $result_totalreal_choc = $consulta_totalreal_choc->fetchAll();
//
//
//        $consulta_totalreal = $conn->prepare("SELECT sum(cast(replace(replace(a.Liquido, '.', ''), ',', '.') as decimal(10,2))) as peso, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) as Total FROM $mes a, usuarios b where a.vendedor = b.rca and b.regiao = '$regiao' ");
//        $consulta_totalreal->execute();
//        $result_totalreal = $consulta_totalreal->fetchAll();
//
//        $consulta_totalmeta = $conn->prepare("SELECT ROUND(SUM(a.kg), 2) as peso, ROUND(SUM(a.valor), 2) as Total, ROUND(SUM(a.valor_choc), 2) as choc, ROUND(SUM(a.valor_bisc), 2) as bisc FROM $meta a, usuarios b where a.rca = b.rca and b.regiao = '$regiao'");
//        $consulta_totalmeta->execute();
//        $result_totalmeta = $consulta_totalmeta->fetchAll();
//
//        $consulta_totalDev = $conn->prepare("SELECT a.VENDEDOR, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) as Total from $mes a, usuarios b where a.VENDEDOR = b.Rca and a.Valor_total <0 and b.regiao = '$regiao' ");
//        $consulta_totalDev->execute();
//        $result_totalDev = $consulta_totalDev->fetchAll();
//
//        $i++;
//
//
//    }
//
//
//
//
//
//}


if(!isset($_GET['regiao'] )|| $regiao == 'Todos'){


$consulta_sup = $conn->prepare("SELECT DISTINCT super FROM usuarios where super <> '' ORDER by regiao, super");

$consulta_sup->execute();
$result_sup = $consulta_sup->fetchAll();


    $consulta_top = $conn->prepare("SELECT * FROM $meta limit 1");

    $consulta_top->execute();
    $result_top = $consulta_top->fetchAll();

    $topchoc = $result_top[0][10];
    $topbisc = $result_top[0][11];

$i = 0;

foreach ($result_sup as $row) {


    $cont_tri = $conn->prepare("select * from trimarca");
    $cont_tri->execute();
    $result_cont = $cont_tri->fetchAll();

    $bat = $result_cont[0][0];
    $tal = $result_cont[0][1];
    $ser = $result_cont[0][2];
    $jum = $result_cont[0][4];
    $bisc = $result_cont[0][5];
    //$cookie = $result_cont[0][6];





        $consulta_bimarca[$i] = $conn->prepare("SELECT VENDEDOR, trimarca, COUNT(NOME_parceiro) as realizado, if(trimarca - COUNT(NOME_parceiro)<0,0,trimarca - COUNT(NOME_parceiro)) as dif FROM (SELECT b.VENDEDOR, a.NOME_PARCEIRO, b.vendedor as vend, b.trimarca FROM $mes a, $meta b, usuarios c where a.MATERIAL IN ($bisc) AND a.QUANTIDADE>0 and a.vendedor = b.rca and a.vendedor = c.Rca and c.super = '$row[0]' group by a.id)SUB GROUP BY VENDEDOR");
       // print_r($consulta_bimarca);
        $consulta_bimarca[$i]->execute();
        $result_bimarca[$i] = $consulta_bimarca[$i]->fetchAll();



        $consulta_bimarca_real[$i] = $conn->prepare("SELECT SUM(realizado) from (SELECT VENDEDOR, tab, COUNT(id) as realizado, if(tab - COUNT(id)<0,0,tab - COUNT(id)) as dif  FROM 
        (SELECT b.VENDEDOR, a.NOME_PARCEIRO,a.id, b.vendedor as vend, b.tab FROM $mes a, $meta b, usuarios c where 
        a.material in ($bisc) and a.QUANTIDADE>0 and a.vendedor = b.rca and a.vendedor = c.Rca and c.super = '$row[0]' group by a.id)SUB GROUP BY VENDEDOR)sub");
      //print_r($consulta_bimarca);
        $consulta_bimarca_real[$i]->execute();
        $result_bimarca_real[$i] = $consulta_bimarca_real[$i]->fetchAll();





    $consulta_cli[$i] = $conn->prepare("select a.Vendedor, COUNT(id) from clientes a, usuarios b where a.rca =b.Rca and b.super = '$row[0]' GROUP by a.Vendedor order by a.vendedor");
    $consulta_cli[$i]->execute();
    $result_cli[$i] = $consulta_cli[$i]->fetchAll();






    $consulta_baton[$i] = $conn->prepare("SELECT VENDEDOR, meta_baton, COUNT(NOME_parceiro) as realizado, if(meta_baton - COUNT(NOME_parceiro)<0,0,meta_baton - COUNT(NOME_parceiro)) as dif FROM (SELECT b.VENDEDOR, a.NOME_PARCEIRO, b.vendedor as vend, b.meta_baton FROM $mes a, $meta b, usuarios c where a.MATERIAL IN ($bat) AND a.QUANTIDADE>0 and a.vendedor = b.rca and a.vendedor = c.Rca and c.super = '$row[0]' group by a.id)SUB GROUP BY VENDEDOR");
   // print_r($consulta_baton);
    $consulta_baton[$i]->execute();
    $result_baton[$i] = $consulta_baton[$i]->fetchAll();


    $consulta_baton2[$i] = $conn->prepare("select sum(realizado) from (SELECT VENDEDOR, meta_baton, COUNT(id) as realizado, if(meta_baton - COUNT(id)<0,0,meta_baton - COUNT(id)) as dif FROM (SELECT b.VENDEDOR, a.id, b.vendedor as vend, b.meta_baton FROM $mes a, $meta b, usuarios c where a.MATERIAL IN ($bat) AND a.QUANTIDADE>0 and a.vendedor = b.rca and a.vendedor = c.Rca and c.super = '$row[0]' group by a.id)SUB GROUP BY VENDEDOR)sub");
    $consulta_baton2[$i]->execute();
    $result_baton2[$i] = $consulta_baton2[$i]->fetchAll();



    $consulta_Jum[$i] = $conn->prepare("SELECT VENDEDOR, tab, COUNT(id) as realizado, if(tab - COUNT(id)<0,0,tab - COUNT(id)) as dif  FROM 
   (SELECT b.VENDEDOR, a.NOME_PARCEIRO,a.id, b.vendedor as vend, b.tab FROM $mes a, $meta b, usuarios c where 
    a.QUANTIDADE>0 and a.vendedor = b.rca and a.vendedor = c.Rca and c.super = '$row[0]' group by a.id)SUB GROUP BY VENDEDOR");
    //print_r($consulta_Jum[$i]);
    $consulta_Jum[$i]->execute();
    $result_Jum[$i] = $consulta_Jum[$i]->fetchAll();


    $consulta_Jum2[$i] = $conn->prepare("SELECT SUM(realizado) from (SELECT VENDEDOR, tab, COUNT(id) as realizado, if(tab - COUNT(id)<0,0,tab - COUNT(id)) as dif  FROM 
   (SELECT b.VENDEDOR, a.NOME_PARCEIRO,a.id, b.vendedor as vend, b.tab FROM $mes a, $meta b, usuarios c where 
    a.QUANTIDADE>0 and a.vendedor = b.rca and a.vendedor = c.Rca and c.super = '$row[0]' group by a.id)SUB GROUP BY VENDEDOR)sub");

    //print_r($consulta_Jum2);
    $consulta_Jum2[$i]->execute();
    $result_Jum2[$i] = $consulta_Jum2[$i]->fetchAll();


    $consulta_rech[$i] = $conn->prepare("select rca, vendedor, sum(total) as total from (SELECT rca, vendedor, hierarquia, if(hierarquia=5534716,(total * 4), if(hierarquia=5534705,(total * 5), if(hierarquia=5534707,(total * 7), if(hierarquia=5534706,(total * 6), if(hierarquia=5534708,(total * 4), if(hierarquia=5534712,(total * 7), if(hierarquia=5534714,(total * 7), total ))))))) as total
    from (SELECT rca, vendedor,hierarquia, COUNT(hierarquia) as total FROM `clientes` where hierarquia in (5534707,5534712,5534714,5534706,5534705,5534716,5534708) GROUP by hierarquia, rca ORDER by rca)sub)sub GROUP by rca");
    //var_dump($consulta_rech[$i]);
    $consulta_rech[$i]->execute();
    $result_rech[$i] = $consulta_rech[$i]->fetchAll();



    $consulta_pontos_bisc[$i] = $conn->prepare("select rca, vendedor, sum(total) as total from (SELECT rca, vendedor, hierarquia, if(hierarquia=5534716,(total * 1), 
             if(hierarquia=5534705,(total * 2), if(hierarquia=5534707,(total * 4), if(hierarquia=5534706,(total * 3), if(hierarquia=5534708,(total * 1), if(hierarquia=5534712,(total * 4), 
             if(hierarquia=5534714,(total * 4), total ))))))) as total from (SELECT rca, vendedor,hierarquia, COUNT(hierarquia) as total FROM `clientes` where 
             hierarquia in (5534707,5534712,5534714,5534706,5534705,5534716,5534708) GROUP by hierarquia, rca ORDER by rca)sub)sub GROUP by rca");
    //var_dump($consulta_rech[$i]);
    $consulta_pontos_bisc[$i]->execute();
    $result_pontos_bisc[$i] = $consulta_pontos_bisc[$i]->fetchAll();




    $consulta_real_hierarquia[$i] = $conn->prepare("SELECT b.vendedor, sum(a.total) as total FROM `hierarquia_$mes` a, $meta b, usuarios c where a.vendedor = b.Rca and b.Rca =c.Rca and c.super = '$row[0]' GROUP BY b.vendedor");
    //var_dump($consulta_real_hierarquia[$i]);
    $consulta_real_hierarquia[$i]->execute();
    $result_real_hierarquia[$i] = $consulta_real_hierarquia[$i]->fetchAll();




    $consulta_real_hierarquia_bisc[$i] = $conn->prepare("SELECT b.vendedor, sum(a.total) as total FROM `hierarquia_bisc_$mes` a, $meta b, usuarios c where a.vendedor = b.Rca and b.Rca =c.Rca and c.super = '$row[0]' GROUP BY b.vendedor");
    //var_dump($consulta_real_hierarquia[$i]);
    $consulta_real_hierarquia_bisc[$i]->execute();
    $result_real_hierarquia_bisc[$i] = $consulta_real_hierarquia_bisc[$i]->fetchAll();




    $consulta_rech2[$i] = $conn->prepare("SELECT SUM(realizado) from (SELECT VENDEDOR, posit_rech, COUNT(id) as realizado, if(posit_rech - COUNT(id)<0,0,posit_rech - COUNT(id)) as dif  FROM
   (SELECT b.VENDEDOR, a.NOME_PARCEIRO,a.id, b.vendedor as vend, b.posit_rech FROM $mes a, $meta b, usuarios c where
    a.MATERIAL IN ($bisc) AND a.QUANTIDADE>0 and a.vendedor = b.rca and a.vendedor = c.Rca and c.super = '$row[0]' group by a.id)SUB GROUP BY VENDEDOR)sub");


    $consulta_rech2[$i]->execute();
    $result_rech2[$i] = $consulta_rech2[$i]->fetchAll();


    $consulta_cookie[$i] = $conn->prepare("SELECT VENDEDOR, posit_cookies, COUNT(id) as realizado, if(posit_cookies - COUNT(id)<0,0,posit_cookies  - COUNT(id)) as dif  FROM 
   (SELECT b.VENDEDOR, a.NOME_PARCEIRO,a.id, b.vendedor as vend, b.posit_cookies  FROM $mes a, $meta b, usuarios c where 
    a.MATERIAL IN ($bisc) AND a.QUANTIDADE>0 and a.vendedor = b.rca and a.vendedor = c.Rca and c.super = '$row[0]' group by a.id)SUB GROUP BY VENDEDOR");

    $consulta_cookie[$i]->execute();
    $result_cookie[$i] = $consulta_cookie[$i]->fetchAll();



    $consulta_cookie2[$i] = $conn->prepare("SELECT SUM(realizado) from (SELECT VENDEDOR, posit_cookies , COUNT(id) as realizado, if(posit_cookies  - COUNT(id)<0,0,posit_cookies - COUNT(id)) as dif  FROM 
   (SELECT b.VENDEDOR, a.NOME_PARCEIRO,a.id, b.vendedor as vend, b.posit_cookies  FROM $mes a, $meta b, usuarios c where 
    a.MATERIAL IN ($bisc) AND a.QUANTIDADE>0 and a.vendedor = b.rca and a.vendedor = c.Rca and c.super = '$row[0]' group by a.id)SUB GROUP BY VENDEDOR)sub");


    $consulta_cookie2[$i]->execute();
    $result_cookie2[$i] = $consulta_cookie2[$i]->fetchAll();





    $consulta_vendas[$i] = $conn->prepare("SELECT b.VENDEDOR, sum(cast(replace(replace(a.Liquido, '.', ''), ',', '.') as decimal(10,2))) as peso, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) 
                                          as Total, b.Vendedor, b.valor FROM $mes a, $meta b, usuarios c where a.VENDEDOR = b.rca and a.vendedor = c.rca and c.super = '$row[0]' group by c.nome");
   // var_dump($consulta_vendas[$i]);
    $consulta_vendas[$i]->execute();
    $result_vendas[$i] = $consulta_vendas[$i]->fetchAll();



    $consulta_vendas_desc[$i] = $conn->prepare("SELECT a.vendedor, a.bonus, b.super FROM `$meta` a, `usuarios` b where a.rca = b.rca and b.super = '$row[0]' order by a.vendedor");
    // print_r($consulta_vendas_desc[$i]);
    $consulta_vendas_desc[$i]->execute();
    $result_vendas_desc[$i] = $consulta_vendas_desc[$i]->fetchAll();






    $consulta_vendas_bisc[$i] = $conn->prepare("SELECT b.VENDEDOR, sum(cast(replace(replace(a.Liquido, '.', ''), ',', '.') as decimal(10,2))) as peso, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) 
                                          as Total, b.Vendedor, b.valor_bisc FROM $mes a, $meta b, usuarios c where a.VENDEDOR = b.rca and a.vendedor = c.rca and a.material in ('12365150','12365129','12365128','12365141','12365282')  and c.super = '$row[0]' group by c.nome");
    //var_dump($consulta_vendas_bisc[$i]);
    $consulta_vendas_bisc[$i]->execute();
    $result_vendas_bisc[$i] = $consulta_vendas_bisc[$i]->fetchAll();


    $consulta_vendas_choc[$i] = $conn->prepare("SELECT b.VENDEDOR, sum(cast(replace(replace(a.Liquido, '.', ''), ',', '.') as decimal(10,2))) as peso, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) 
                                          as Total, b.Vendedor, b.valor_choc FROM $mes a, $meta b, usuarios c where a.VENDEDOR = b.rca and a.vendedor = c.rca and a.material not in ('12365150','12365129','12365128','12365141','12365282')  and c.super = '$row[0]' group by c.nome");
   // var_dump($consulta_vendas_choc[$i]);
    $consulta_vendas_choc[$i]->execute();
    $result_vendas_choc[$i] = $consulta_vendas_choc[$i]->fetchAll();

    // var_dump($result_vendas[$i]);


    $consulta_meta[$i] = $conn->prepare("select a.vendedor, a.meta_baton, a.valor, b.Rca, a.trimarca, a.tab, a.posit_rech, a.posit_cookies, a.valor_choc, a.valor_bisc, a.topchoc, a.topbisc from $meta a, usuarios b where a.Vendedor=b.nome and b.super = '$row[0]' order by a.vendedor");
    //var_dump($consulta_meta[$i]);
    $consulta_meta[$i]->execute();
    $result_meta[$i] = $consulta_meta[$i]->fetchAll();

    //var_dump($result_meta[$i]);


    $consulta_dev[$i] = $conn->prepare("SELECT a.VENDEDOR, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) as Total from $mes a, usuarios b where a.VENDEDOR = b.Rca and a.Valor_total <0 and b.super = '$row[0]' GROUP by b.nome");
    //var_dump($consulta_dev[$i]);
    $consulta_dev[$i]->execute();
    $result_dev[$i] = $consulta_dev[$i]->fetchAll();

    //var_dump($result_dev[$i]);


    $consulta_real_super_choc[$i] = $conn->prepare("SELECT sum(cast(replace(replace(a.Liquido, '.', ''), ',', '.') as decimal(10,2))) as peso, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) as Total FROM $mes a, usuarios b where a.vendedor = b.rca and a.material not in ('12365150','12365129','12365128','12365141','12365282')  and b.super = '$row[0]'");
    // var_dump($consulta_real_super);
    $consulta_real_super_choc[$i]->execute();
    $result_real_super_choc[$i] = $consulta_real_super_choc[$i]->fetchAll();
    // var_dump($result_real_super[$i]);


    $consulta_real_super_bisc[$i] = $conn->prepare("SELECT sum(cast(replace(replace(a.Liquido, '.', ''), ',', '.') as decimal(10,2))) as peso, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) as Total FROM $mes a, usuarios b where a.vendedor = b.rca and a.material in ('12365150','12365129','12365128','12365141','12365282')  and b.super = '$row[0]'");
    // var_dump($consulta_real_super);
    $consulta_real_super_bisc[$i]->execute();
    $result_real_super_bisc[$i] = $consulta_real_super_bisc[$i]->fetchAll();
    // var_dump($result_real_super[$i]);


    $consulta_real_super[$i] = $conn->prepare("SELECT sum(cast(replace(replace(a.Liquido, '.', ''), ',', '.') as decimal(10,2))) as peso, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) as Total FROM $mes a, usuarios b where a.vendedor = b.rca and b.super = '$row[0]'");
    // var_dump($consulta_real_super);
    $consulta_real_super[$i]->execute();
    $result_real_super[$i] = $consulta_real_super[$i]->fetchAll();
    // var_dump($result_real_super[$i]);

    $consulta_meta_super[$i] = $conn->prepare("SELECT SUM(a.meta_baton) as peso, ROUND(SUM(a.valor), 2) as Total, sum(trimarca), sum(tab), sum(posit_rech), sum(posit_cookies), ROUND(SUM(a.valor_choc), 2) as choc, ROUND(SUM(a.valor_bisc), 2) as bisc FROM $meta a, usuarios b WHERE a.rca = b.rca and b.super = '$row[0]'  ");
    $consulta_meta_super[$i]->execute();
    $result_meta_super[$i] = $consulta_meta_super[$i]->fetchAll();








    $consulta_dev_super[$i] = $conn->prepare("SELECT a.VENDEDOR, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) as Total from $mes a, usuarios b where a.VENDEDOR = b.Rca and a.Valor_total <0 and b.super = '$row[0]'");
    //var_dump($consulta_dev[$i]);
    $consulta_dev_super[$i]->execute();
    $result_dev_super[$i] = $consulta_dev_super[$i]->fetchAll();




    $i++;


}


    $consulta_totalreal_choc = $conn->prepare("SELECT sum(cast(replace(replace(Liquido, '.', ''), ',', '.') as decimal(10,2))) as peso, sum(cast(replace(replace(Valor_total, '.', ''), ',', '.') as decimal(10,2))) as Total FROM $mes where material not in ('12365150','12365129','12365128','12365141','12365282')");
   // print_r($consulta_totalreal_choc);
    $consulta_totalreal_choc->execute();
    $result_totalreal_choc = $consulta_totalreal_choc->fetchAll();

    $consulta_totalreal_bisc = $conn->prepare("SELECT sum(cast(replace(replace(Liquido, '.', ''), ',', '.') as decimal(10,2))) as peso, sum(cast(replace(replace(Valor_total, '.', ''), ',', '.') as decimal(10,2))) as Total FROM $mes where material in ('12365150','12365129','12365128','12365141','12365282')");
    $consulta_totalreal_bisc->execute();
    $result_totalreal_bisc = $consulta_totalreal_bisc->fetchAll();


    $consulta_totalreal = $conn->prepare("SELECT sum(cast(replace(replace(Liquido, '.', ''), ',', '.') as decimal(10,2))) as peso, sum(cast(replace(replace(Valor_total, '.', ''), ',', '.') as decimal(10,2))) as Total FROM $mes");
    $consulta_totalreal->execute();
    $result_totalreal = $consulta_totalreal->fetchAll();


    $consulta_totalmeta = $conn->prepare("SELECT SUM(meta_baton) as peso, ROUND(SUM(valor), 2) as Total, sum(trimarca), sum(tab), sum(posit_rech), sum(posit_cookies), ROUND(SUM(valor_choc), 2) as choc, ROUND(SUM(valor_bisc), 2) as bisc FROM $meta");
    $consulta_totalmeta->execute();
    $result_totalmeta = $consulta_totalmeta->fetchAll();

    $consulta_totalDev = $conn->prepare("SELECT a.VENDEDOR, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) as Total from $mes a, usuarios b where a.VENDEDOR = b.Rca and a.Valor_total <0 ");
    $consulta_totalDev->execute();
    $result_totalDev = $consulta_totalDev->fetchAll();


    $consulta_bimarca_totalr = $conn->prepare("SELECT SUM(realizado) from (SELECT VENDEDOR, tab, COUNT(id) as realizado, if(tab - COUNT(id)<0,0,tab - COUNT(id)) as dif  FROM 
   (SELECT b.VENDEDOR, a.NOME_PARCEIRO,a.id, b.vendedor as vend, b.tab FROM $mes a, $meta b, usuarios c where 
    a.material in ($bisc) and a.QUANTIDADE>0 and a.vendedor = b.rca and a.vendedor = c.Rca group by a.id)SUB GROUP BY VENDEDOR)sub");
    // print_r($consulta_bimarca_totalr[$i]);
    $consulta_bimarca_totalr->execute();
    $result_bimarca_totalr = $consulta_bimarca_totalr->fetchAll();


    $consulta_baton_totalr = $conn->prepare("select sum(realizado) from (SELECT VENDEDOR, meta_baton, COUNT(NOME_parceiro) as realizado, if(meta_baton - COUNT(NOME_parceiro)<0,0,meta_baton - COUNT(NOME_parceiro)) as dif FROM (SELECT b.VENDEDOR, a.NOME_PARCEIRO, b.vendedor as vend, b.meta_baton FROM $mes a, $meta b where a.MATERIAL IN ($bat) AND a.QUANTIDADE>0 and a.vendedor = b.rca group by a.id)SUB GROUP BY VENDEDOR)sub");
    $consulta_baton_totalr->execute();
    $result_baton_totalr = $consulta_baton_totalr->fetchAll();


    $consulta_jum_total = $conn->prepare("select count(id) from(select * from $mes where material not in (12365150,12365129,12365128,12365141,12365282) group by id)sub");
    // print_r($consulta_jum_total);
    $consulta_jum_total->execute();
    $result_jum_totalr = $consulta_jum_total->fetchAll();


    $consulta_rech_total = $conn->prepare("SELECT SUM(realizado) from (SELECT VENDEDOR, posit_rech, COUNT(id) as realizado, if(posit_rech - COUNT(id)<0,0,posit_rech - COUNT(id)) as dif  FROM 
   (SELECT b.VENDEDOR, a.NOME_PARCEIRO,a.id, b.vendedor as vend, b.posit_rech FROM $mes a, $meta b where 
    a.MATERIAL IN ($bisc) AND a.QUANTIDADE>0 and a.vendedor = b.rca  group by a.id)SUB GROUP BY VENDEDOR)sub");

    $consulta_rech_total->execute();
    $result_rech_totalr = $consulta_rech_total->fetchAll();


    $consulta_cookie_total = $conn->prepare("SELECT SUM(realizado) from (SELECT VENDEDOR, posit_rech, COUNT(id) as realizado, if(posit_rech - COUNT(id)<0,0,posit_rech - COUNT(id)) as dif  FROM 
   (SELECT b.VENDEDOR, a.NOME_PARCEIRO,a.id, b.vendedor as vend, b.posit_rech FROM $mes a, $meta b where 
    a.MATERIAL IN ($bisc) AND a.QUANTIDADE>0 and a.vendedor = b.rca  group by a.id)SUB GROUP BY VENDEDOR)sub");

    $consulta_cookie_total->execute();
    $result_cookie_totalr = $consulta_cookie_total->fetchAll();




}



$mes_sel = array(
    '1' => 'Janeiro',
    '2' => 'Fevereiro',
    '3' => 'Marco',
    '4' => 'Abril',
    '5' => 'Maio',
    '6' => 'Junho',
    '7' => 'Julho',
    '8' => 'Agosto',
    '11' => 'Novembro',
    '9' => 'Setembro',
    '10' => 'Outubro',
    '12' => 'Dezembro'
);



?>


<html style="background: #737373;">
    <head>
        <meta charset="UTF-8">
        <title>Painel Administrador</title>
        <style type="text/css">
          .link a { color: #000000;}
          .link a:hover {text-decoration: none; font-weight: bold;
          }
          .link:hover{ background: #9ef15c;}

        </style>
         <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="../css/print.css" media="print" />
        <link rel="stylesheet" href="../css/bootstrap-theme.css">
       <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.css.map">
    <link rel="stylesheet" href="../css/bootstrap.css.map">
    <link rel="stylesheet" href="../css/menu.css">
        <link rel="stylesheet" href="../css/graf_percentual.css">
           <link rel="stylesheet" href="../css/tableexport.min.css">
     <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png" />
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/npm.js"></script>
        <script src="../js/Chart.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

     <script>   // aqui eh a base da pagina

         window.onload = function(){
             document.getElementById('mes').onchange = function(){
                 window.location = '?mes=' + this.value;


             }

         }


         $(function(){
             var $ppc = $('.progress-pie-chart'),
                 percent = parseInt($ppc.data('percent')),
                 deg = 360*percent/100;
             if (percent > 100){
                 deg = 360;
             }
             if (percent > 50) {
                 $ppc.addClass('gt-50');
             }
             $('.ppc-progress-fill').css('transform','rotate('+ deg +'deg)');
             $('.ppc-percents span').html(percent+'%');
         });

         $(function(){
             var $ppc2 = $('.progress2-pie-chart'),
                 percent2 = parseInt($ppc2.data('percent2')),
                 deg2 = 360*percent2/100;

             if (percent2 > 100){
                 deg2 = 360;
             }
             if (percent2 > 50) {
                 $ppc2.addClass('gt2-50');
             }

             $('.ppc-progress2-fill').css('transform','rotate('+ deg2 +'deg)');
             $('.ppc-percents2 span').html(percent2+'%');
         });




$(document).ready( function(){
$("#painel").hide();
$("#painel").slideDown(1500);

//$("tr:odd").css("background","#CED4D6");
//$("tr:last").css("background","#074456");


});

jQuery(document).ready(function (e) {
    function t(t) {
        e(t).bind("click", function (t) {
            t.preventDefault();
            e(this).parent().fadeOut()
        })
    }
    e(".dropdown-toggle").click(function () {
        var t = e(this).parents(".button-dropdown").children(".dropdown-menu").is(":hidden");
        e(".button-dropdown .dropdown-menu").hide();
        e(".button-dropdown .dropdown-toggle").removeClass("active");
        if (t) {
            e(this).parents(".button-dropdown").children(".dropdown-menu").toggle().parents(".button-dropdown").children(".dropdown-toggle").addClass("active")
        }
    });
    e(document).bind("click", function (t) {
        var n = e(t.target);
        if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-menu").hide();
    });
    e(document).bind("click", function (t) {
        var n = e(t.target);
        if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-toggle").removeClass("active");
    })
});




</script>


    </head>
    <body>
         <div id="nav" class="col-lg-12"  style="background: #121415;">
       <ul class="nav">
           <li role="presentation"  id="active"><a href="#">Resumo de vendas</a></li>

<!--          <li class="button-dropdown"><a href="javascript:void(0)" class="dropdown-toggle">  Positivações  <span>▼</span>  </a>-->
<!--              <ul class="dropdown-menu">-->
<!--                  <li><a href="trimarca.php">Positivação Geral</a></li>-->
<!--                  <li><a href="baton.php">Positivação Baton</a></li>-->
<!--                  <li><a href="jumbos.php">Positivação Biscoitos</a></li>-->
<!--                  <li><a href="rech.php">Recheados</a></li>-->
<!--                  <li><a href="cookies.php">Cookies</a></li>-->
<!---->
<!--              </ul>-->
<!---->
<!--          </li>-->
           <?php
           if($usuario=="Julio" || $usuario=="Marciano"){?>
           <li class="button-dropdown"><a href="javascript:void(0)" class="dropdown-toggle"> Relatórios <span>▼</span>  </a>
               <ul class="dropdown-menu">
                   <li role="presentation"><a href="top.php">Ranking Mix Ideal</a></li>
                   <li role="presentation"><a href="acessos.php">Relat. de Acessos</a></li>
<!--                   <li role="presentation"><a href="inadimplencia.php">Financeiro</a></li>-->

                       <li role="presentation"><a href="baton.php">Posit. Faturado Baton</a></li>
                       <li role="presentation"><a href="geral.php">Posit. Faturado Geral</a></li>
                       <li role="presentation"><a href="bisc.php">Posit. Faturado Biscoitos</a></li>
                       <li role="presentation"><a href="baton_diario.php">Baton Diário</a></li>
                       <li role="presentation"><a href="geral_diario.php">Geral Diário</a></li>

               </ul>
           </li><?php  }  ?>
           <li role="presentation"><a href="mixideal.php">Relatório Mix Ideal</a></li>

           <?php
           if($usuario=="Julio" || $usuario=="Marciano"){?>



               <li class="button-dropdown"><a href="javascript:void(0)" class="dropdown-toggle"> Transmissão Flexx <span>▼</span>  </a>
                   <ul class="dropdown-menu">
                       <li role="presentation" ><a href="vendasflex.php">Pedidos transmitido</a></li>
                       <li role="presentation" ><a href="vendasflexpascoa.php">Pedidos transmitido Páscoa</a></li>

                   </ul>

               </li>


               <li class="button-dropdown"><a href="javascript:void(0)" class="dropdown-toggle">Atualizar pedidos SAP <span>▼</span>  </a>
                   <ul class="dropdown-menu">
                       <li role="presentation" ><a href="email/index.php">Atualizar</a></li>

                   </ul>

               </li>


           <li class="button-dropdown"><a href="javascript:void(0)" class="dropdown-toggle"> Cadastros <span>▼</span>  </a>
               <ul class="dropdown-menu">
                   <li role="presentation" ><a href="cadastrar.php">Cadastrar Metas</a></li>
                   <li role="presentation" ><a href="campanha.php">Cad. Campanhas</a></li>
                   <li role="presentation" ><a href="cadcood.php">Cad. Coordenadores</a></li>
                   <li role="presentation" ><a href="cadvend.php">Cad. Vendedores</a></li>
                   <?php
                   if($usuario=="Julio" || $usuario=="Marciano"){

                       echo '<li role="presentation" ><a href="solicitacao.php">Solic. Cadastros</a></li>';
}

                        ?>
               </ul>

           </li>
           <li class="button-dropdown"><a href="javascript:void(0)" class="dropdown-toggle">Importacao<span>▼</span>  </a>
               <ul class="dropdown-menu">
                   <li><a href="Importacao.php">Resultados</a></li>
                   <li><a href="posit_geral.php">Posit. Geral</a></li>
                   <li><a href="posit_baton.php">Posit. Baton</a></li>
                   <li><a href="posit_bisc.php">Posit. Biscoitos</a></li>
                   <li><a href="clientes.php">Clientes</a></li>
                   <li role="presentation" ><a href="financeiro.php">Financeiro</a></li>
                   <li role="presentation" ><a href="produtos.php">Produtos</a></li>
                   <li role="presentation" ><a href="email/index.php">Venda Diaria</a></li>


               </ul>

           </li>

           <?php  }  ?>

  <li role="presentation" style="float: right;padding-top: 10px;padding-right: 5px;"><input  class="btn btn-danger btn-xs" type="submit" value="Sair" onclick="location.  href='../index.html'"></li>
  <li role="presentation" style="float: right;"><h5 style="color: #A6CFF3; font-family: sans-serif;padding-top: 4px;">Usuário: <strong><?php print $usuario; ?></strong> &nbsp&nbsp&nbsp&nbsp</h5></li>

       </ul>
        </div>
     <div class="row" style="background: #737373; padding-top: 55px;">


        <div class="col-md-3" style="text-align:center; background-color:#074456; font-family:Oswald; color:#E4F3F7;height: 50px; padding-top: 5px;"><img style=" position: absolute;  left: 45px;  top: 25px; z-index: 1;" src="../images/disnorte.png"></div>
        <div class="col-md-6" style="text-align:center; background-color:#074456; font-family:Oswald; color:#E4F3F7;height: 50px; padding-top: 5px;"><h4>SISTEMA DE ACOMPANHAMENTO DE METAS</h4></div>
        <div class="col-md-3" style="text-align:center; height: 50px; background-color:#074456; font-family:Oswald; color:#E4F3F7;"><img style="position: absolute; top: 15px; z-index: 1; right: 50px;" src="../images/garoto.png"></div>


       </div>



         <div class="row" style="background: #737373;">

         <div class="col-md-3" style="text-align:center; background-color:#074456; font-family:Oswald; color:#E4F3F7;height: 32px; padding-top: 5px;"></div>

        <div class="col-md-6" style="text-align:center; background-color:#074456; font-family:Oswald; color:#E4F3F7;height: 32px;">

        Selecionar Mês: &nbsp&nbsp
            <?php echo' <select id="mes" name="mes"style="height: 30px; background-color: #0C4F63;color: #ffffff; font-family: sans-serif;  font-size: 18px;text-align: center; font-weight: bold;" > 
      
';

      $i=1;

while ($i <= 12) {
    $consulta_mes = $conn->prepare("SELECT data_doc from " . $mes_sel [$i] . " limit 1");
    $consulta_mes->execute();
    $result_mes = $consulta_mes->fetchAll();


    echo '
    
     <option value="meta' . $i . '"';

    if ($i > 9) {
        if ($i == substr($meta, -2)) {
            echo 'selected';
        }
    } else{
        if ($i == substr($meta, -1)) {
            echo 'selected';
        }
}

   if(empty($result_mes)){

       echo '>'.$mes.' - '.$ano.'</option>';

   }else{

       echo '>'.$mes_sel[$i].' - '.substr($result_mes[0][0], -4).'</option>';

   }

    $i++;
};

      ?>

<?php

echo '         

      </select>


</div>
       
       <div class="col-md-3" style="margin: auto; background-color:#074456;font-family:Oswald; color:#E4F3F7;height: 32px;"> 

</div>
       
        
       
    </div>    
    
<div id="painel" class="row" style="background: #737373;">

<div class="col-md-12" style="text-align:center; padding-top: 20px; background-color:#CED4D6; font-family:Oswald; color:#074456; padding: 5px 25px 5px 25px;">
<div class="col-md-12">       
<div class="table-responsive">
<table id="resultados" align="center" cellpadding="10">


';



if (count($result_meta) ) {

    $z =0;

    $devolucao = array();
    $total_Posit_Geral =  array();
    $total_Posit_Baton =  array();
    $total_Posit_bisc=  array();
    $total_Geral=  array();




    foreach ($result_sup as $row){



        echo '<tr class="success" style="height: 15px;">';
        echo '<td colspan="10"></td>';
        echo '</tr>';

        $color = array (0 => "#c5edf7",1 => "#55b2ca", 2 => "#c5edf7", 3 => "#55b2ca", 4 => "#c5edf7",5 => "#55b2ca",
            6 => "#c5edf7", 7 => "#55b2ca",  8 => "#c5edf7",  9 => "#55b2ca",  10 => "#c5edf7",   11 => "#55b2ca"
        );



        echo '<tr class="success" style="background: #226a80; font-size:16px;color: aliceblue;height: 30px; border: solid; border-color: #226a80;">';
        echo '<td colspan="24">'.$row[0].'</td>';
        echo '</tr>';

        echo '<tr class="success" style=" font-size:16px;color: aliceblue;height: 30px; border: solid; border-color: #a25e23;">';
        echo '<td colspan="7" style="background: #a25e23;">POSITIVAÇÕES</td>';
        echo '<td colspan="1" style="background: #ced4d6;"></td>';
        echo '<td colspan="7" style="background: #e6a313;">Mix Ideal</td>';

        echo '<td colspan="1" style="background: #ced4d6;"></td>';
        echo '<td colspan="9" style="background: #4CAF50;">VALOR</td>';


        echo '<tr style="font-size: 16px;background: #074456;color: aliceblue;">';
        echo '<td style="width: 150px; text-align: center; border: solid; border-color: #245269;">Vendedores</td>';
        echo '<td style="width: 60px; text-align: center; border: solid; border-color: #245269;">Meta Geral</td>';
        echo '<td style="width: 70px; text-align: center; border: solid; border-color: #245269; background-color: #097190">Real. Geral</td>';

        echo '<td style="width: 60px; text-align: center; border: solid; border-color: #245269;">Meta Baton</td>';
        echo '<td style="width: 70px; text-align: center; border: solid; border-color: #245269; background-color: #097190">Real. Baton</td>';

        echo '<td style="width: 60px; text-align: center; border: solid; border-color: #245269;">Meta Biscoito</td>';
        echo '<td style="width: 70px; text-align: center; border: solid; border-color: #245269; background-color: #097190 ">Real. Biscoito</td>';

//        echo '<td style="width: 100px; text-align: center; border: solid; border-color: #245269;">Meta Valor</td>';
//        echo '<td style="width: 100px; text-align: center; border: solid; border-color: #245269; background-color: #097190;">Realizado</td>';

        echo '<td style="width: 20px; text-align: center; border: solid; border-color: #ced4d6; border-right-color: #245269;background-color: #ced4d6"></td>';
        echo '<td style="width: 60px; text-align: center; border: solid; border-color: #245269;">Total Clientes</td>';
        echo '<td style="width: 70px; text-align: center; border: solid; border-color: #245269; background-color: #097190">Pontos Total Chocolate</td>';
        echo '<td style="width: 60px; text-align: center; border: solid; border-color: #245269;">Meta Choc</td>';
        echo '<td style="width: 70px; text-align: center; border: solid; border-color: #245269; background-color: #097190">Realizado </td>';
        echo '<td style="width: 70px; text-align: center; border: solid; border-color: #245269; background-color: #097190">Pontos Total Biscoito</td>';
        echo '<td style="width: 100px; text-align: center; border: solid; border-color: #245269;">Meta Bisc</td>';
        echo '<td style="width: 100px; text-align: center; border: solid; border-color: #245269; background-color: #097190;">Realizado</td>';

        echo '<td style="width: 20px; text-align: center; border: solid; border-color: #ced4d6; border-right-color: #245269;background-color: #ced4d6"></td>';
        echo '<td style="width: 100px; text-align: center; border: solid; border-color: #245269;">Meta Valor Choc</td>';
        echo '<td style="width: 100px; text-align: center; border: solid; border-color: #245269; background-color: #097190;">Realizado</td>';
        echo '<td style="width: 100px; text-align: center; border: solid; border-color: #245269;">Meta Valor Bisc</td>';
        echo '<td style="width: 100px; text-align: center; border: solid; border-color: #245269; background-color: #097190;">Realizado</td>';
        echo '<td style="width: 100px; text-align: center; border: solid; border-color: #245269;">Meta Total</td>';
        echo '<td style="width: 100px; text-align: center; border: solid; border-color: #245269; background-color: #097190;">Realizado</td>';
        echo '<td style="width: 100px; text-align: center; border: solid; border-color: #245269;">Bonus</td>';
        echo '<td style="width: 100px; text-align: center; border: solid; border-color: #245269;">Devoluções</td>';



echo '</tr>';


        $total_Clientes_Parcial =  array();
        $total_Pontos_Tot_Parcial =  array();
        $total_Pontos_Tot_Bisc_Parcial =  array();
        $total_Pontos_Tot_Bisc_Parcial2 =  array();
        $total_Pontos_Choc_Parcial =  array();
        $total_Pontos_Choc_Real=  array();
        $total_Pontos_Choc_Real_bisc=  array();
        $rgeral=  array();



        foreach($result_meta[$z] as $row) {



            //var_dump($row);
            $verfic = true;

            echo '<tr class="success" style="background-color: '.$color[$z]. '!important;">';
            echo '<td class="link" style="width: 150px; text-align: left; border: solid; border-color: #245269; padding-left: 10px;"><a id href="vendas.php?mes=' . $meta . '&vd=' . $row[3] . '">' . $row[0] . '</a></td>';

            echo '<td style="width: 60px; text-align: center; border: solid; border-color: #245269;">'. $row[5]. '</td>';

            $r = $row[5];
            //var_dump($result_vendas);

            foreach ($result_Jum[$z] as $row2) {


                If ($row[0] == $row2[0]) {
                    echo '<td style="width: 70px; text-align: center; border: solid; border-color: #245269; background-color: #81cde0 !important;">'.$row2[2]. '</td>';
                    $verfic = false;
                    $r2 = $row2[2];

                    break;

                }else {

                    $verfic = true;

                }



            }


            If (empty($result_Jum[$z])) {

                echo '<td style="width: 70px; text-align: center; border: solid; border-color: #4B5F65; background-color: #81cde0 !important;">0</td>';
                //echo  '<script> alert("'.$row[0].'");</script>';
                // echo  '<script> alert("'.$row2[0].'");</script>';

                $r2 = 0;
            }else{

                If ($verfic == true) {

                    echo '<td style="width: 70px; text-align: center; border: solid; border-color: #4B5F65; background-color: #81cde0 !important;">0</td>';
                    //echo  '<script> alert("'.$row[0].'");</script>';
                    // echo  '<script> alert("'.$row2[0].'");</script>';
                    $r2 = 0;

                }



            }

              $posit_geral = $r - $r2;


            echo '<td style="width: 60px; text-align: center; border: solid; border-color: #245269;">'. $row[1]. '</td>';

            $b = $row[1];
           //var_dump($result_vendas);

            foreach ($result_baton[$z] as $row2) {


                If ($row[0] == $row2[0]) {
                    echo '<td style="width: 70px; text-align: center; border: solid; border-color: #245269; background-color: #81cde0!important;">'.$row2[2]. '</td>';
                    $verfic = false;
                    $b2 = $row2[2];
                    break;



                }else {

                    $verfic = true;

                }

            }


            If (empty($result_baton[$z])) {

                echo '<td style="width: 70px; text-align: center; border: solid; border-color: #4B5F65; background-color: #81cde0 !important;">0</td>';
                //echo  '<script> alert("'.$row[0].'");</script>';
                // echo  '<script> alert("'.$row2[0].'");</script>';
                $b2 = 0;

            }else{

                If ($verfic == true) {

                    echo '<td style="width: 70px; text-align: center; border: solid; border-color: #4B5F65; background-color: #81cde0 !important;">0</td>';
                    //echo  '<script> alert("'.$row[0].'");</script>';
                    // echo  '<script> alert("'.$row2[0].'");</script>';
                    $b2 = 0;

                }


            }

            $posit_baton = $b - $b2;



            echo '<td style="width: 60px; text-align: center; border: solid; border-color: #245269;">'. $row[4]. '</td>';

            $c = $row[4];
            //var_dump($result_vendas);

            foreach ($result_bimarca[$z] as $row2) {


                If ($row[0] == $row2[0]) {
                    echo '<td style="width: 70px; text-align: center; border: solid; border-color: #245269; background-color: #81cde0 !important;">'.$row2[2]. '</td>';
                    $verfic = false;

                    $c2 = $row2[2];

                  break;

                }else {

                    $verfic = true;

                }




            }





            If (empty($result_bimarca[$z])) {

                echo '<td style="width: 70px; text-align: center; border: solid; border-color: #4B5F65; background-color: #81cde0 !important;">0</td>';
                //echo  '<script> alert("'.$row[0].'");</script>';
                // echo  '<script> alert("'.$row2[0].'");</script>';
                $c2 = 0;

            }else{

                If ($verfic == true) {

                    echo '<td style="width: 70px; text-align: center; border: solid; border-color: #4B5F65; background-color: #81cde0 !important;">0</td>';
                    //echo  '<script> alert("'.$row[0].'");</script>';
                    // echo  '<script> alert("'.$row2[0].'");</script>';
                    $c2 = 0;

                }


            }

            $posit_bisc = $c - $c2;

            //
           // echo '<td style="width: 100px; text-align: center; border: solid; border-color: #245269;">R$  ' . number_format($row[8], 2, ',', '.') . '</td>';

//            foreach ($result_vendas_choc[$z] as $row2) {
//                If ($row[0] == $row2[0]) {
//                    echo '<td style="width: 100px; text-align: center; border: solid; border-color: #245269; background-color: #81cde0 !important; ">R$  ' . number_format($row2[2], 2, ',', '.') . '</td>';
//                    $verfic = false;
//
//                    //echo  '<td style="width: 150px; text-align: center; border: solid; border-color: #4B5F65;">'.$row[3].'</td>';
//                }
//
//            }
//
//            If ($verfic == true) {
//
//                echo '<td style="width: 100px; text-align: center; border: solid; border-color: #4B5F65; background-color: #81cde0 !important;">0</td>';
//
//            }

            if($posit_geral<0 && $posit_baton<0 & $posit_bisc<0){
//                $databonus2 = $conn->prepare("UPDATE $meta set bonus = now() where vendedor = '$row[0]'");
//                $databonus2->execute();
            }

            echo '<td style="width: 20px; text-align: center; background-color: #ced4d6 !important;"></td>';


            foreach ($result_cli[$z] as $row2) {


                If (trim($row[0]) == trim($row2[0])) {
                    echo '<td style="width: 70px; text-align: center; border: solid; border-color: #245269; background-color: #81cde0 !important;">'.$row2[1]. '</td>';

                    $verfic = false;

                    $total_Clientes_Parcial [] = $row2[1] ;
                    $total_Clientes_Total [] = $row2[1] ;

                    break;

                }else {

                    $verfic = true;

                }



            }


            If (empty($result_cli[$z])) {

                echo '<td style="width: 70px; text-align: center; border: solid; border-color: #4B5F65; background-color: #81cde0 !important;">0</td>';
                //echo  '<script> alert("'.$row[0].'");</script>';
                // echo  '<script> alert("'.$row2[0].'");</script>';

            }else{

                If ($verfic == true) {

                    echo '<td style="width: 70px; text-align: center; border: solid; border-color: #4B5F65; background-color: #81cde0 !important;">0</td>';
                    //echo  '<script> alert("'.$row[0].'");</script>';
                    // echo  '<script> alert("'.$row2[0].'");</script>';

                }


            }

            //var_dump($result_vendas);

            foreach ($result_rech[$z] as $row2) {


                If (trim($row[0]) == trim($row2[1])) {
                    echo '<td style="width: 70px; text-align: center; border: solid; border-color: #245269; background-color: #81cde0 !important;">'.$row2[2]. '</td>';

                    $total_Pontos_Tot_Parcial [] = $row2[2] ;
                    $total_Pontos_Total [] = $row2[2] ;

                    $verfic = false;

                    break;

                }else {

                    $verfic = true;

                }




            }


            If (empty($result_rech[$z])) {

                echo '<td style="width: 70px; text-align: center; border: solid; border-color: #4B5F65; background-color: #81cde0 !important;">0</td>';
                //echo  '<script> alert("'.$row[0].'");</script>';
                // echo  '<script> alert("'.$row2[0].'");</script>';

            }else{

                If ($verfic == true) {

                    echo '<td style="width: 70px; text-align: center; border: solid; border-color: #4B5F65; background-color: #81cde0 !important;">0</td>';
                    //echo  '<script> alert("'.$row[0].'");</script>';
                    // echo  '<script> alert("'.$row2[0].'");</script>';

                }


            }


            //var_dump($result_vendas);

            foreach ($result_rech[$z] as $row2) {


                If (trim($row[0]) == trim($row2[1])) {
                    echo '<td style="width: 70px; text-align: center; border: solid; border-color: #245269; background-color: #81cde0 !important;">'.round($row2[2]*$row[10]). '</td>';
                    $verfic = false;

                    $total_Pontos_Choc [] = round($row2[2]*$row[10]);

                    $total_Pontos_Choc_Parcial [] = round($row2[2]*$row[10]);

                    break;

                }else {

                    $verfic = true;

                }




            }


            If (empty($result_rech[$z])) {

                echo '<td style="width: 70px; text-align: center; border: solid; border-color: #4B5F65; background-color: #81cde0 !important;">0</td>';
                //echo  '<script> alert("'.$row[0].'");</script>';
                // echo  '<script> alert("'.$row2[0].'");</script>';

            }else{

                If ($verfic == true) {

                    echo '<td style="width: 70px; text-align: center; border: solid; border-color: #4B5F65; background-color: #81cde0 !important;">0</td>';
                    //echo  '<script> alert("'.$row[0].'");</script>';
                    // echo  '<script> alert("'.$row2[0].'");</script>';

                }


            }






            foreach ($result_real_hierarquia[$z] as $row2) {


                If (trim($row[0]) == trim($row2[0])) {
                    echo '<td style="width: 70px; text-align: center; border: solid; border-color: #245269; background-color: #81cde0 !important;">'.$row2[1]. '</td>';
                    $verfic = false;

                    $total_Pontos_Choc_Real [] = $row2[1] ;
                    $total_Pontos_Choc_Real_Total [] = $row2[1] ;

                    break;

                }else {

                    $verfic = true;

                }




            }


            If (empty($result_real_hierarquia[$z])) {

                echo '<td style="width: 70px; text-align: center; border: solid; border-color: #4B5F65; background-color: #81cde0 !important;">0</td>';
                //echo  '<script> alert("'.$row[0].'");</script>';
                // echo  '<script> alert("'.$row2[0].'");</script>';

            }else{

                If ($verfic == true) {

                    echo '<td style="width: 70px; text-align: center; border: solid; border-color: #4B5F65; background-color: #81cde0 !important;">0</td>';
                    //echo  '<script> alert("'.$row[0].'");</script>';
                    // echo  '<script> alert("'.$row2[0].'");</script>';

                }


            }





            foreach ($result_pontos_bisc[$z] as $row2) {


                If (trim($row[0]) == trim($row2[1])) {
                    echo '<td style="width: 70px; text-align: center; border: solid; border-color: #245269; background-color: #81cde0 !important;">'.$row2[2]. '</td>';

                    $total_Pontos_Tot_Bisc_Parcial [] = $row2[2] ;
                    $total_Pontos_Bisc_Total [] = $row2[2] ;

                    $verfic = false;

                    break;

                }else {

                    $verfic = true;

                }




            }


            If (empty($result_pontos_bisc[$z])) {

                echo '<td style="width: 70px; text-align: center; border: solid; border-color: #4B5F65; background-color: #81cde0 !important;">0</td>';
                //echo  '<script> alert("'.$row[0].'");</script>';
                // echo  '<script> alert("'.$row2[0].'");</script>';

            }else{

                If ($verfic == true) {

                    echo '<td style="width: 70px; text-align: center; border: solid; border-color: #4B5F65; background-color: #81cde0 !important;">0</td>';
                    //echo  '<script> alert("'.$row[0].'");</script>';
                    // echo  '<script> alert("'.$row2[0].'");</script>';

                }


            }




            foreach ($result_pontos_bisc[$z] as $row2) {


                If (trim($row[0]) == trim($row2[1])) {
                    echo '<td style="width: 70px; text-align: center; border: solid; border-color: #245269; background-color: #81cde0 !important;">'.round($row2[2]*$row[11]). '</td>';

                    $total_Pontos_Tot_Bisc_Parcial2 [] = round($row2[2]*$row[11]); ;
                    $total_Pontos_Bisc_Total2 [] = round($row2[2]*$row[11]); ;

                    $verfic = false;

                    break;

                }else {

                    $verfic = true;

                }



            }


            If (empty($result_pontos_bisc[$z])) {

                echo '<td style="width: 70px; text-align: center; border: solid; border-color: #4B5F65; background-color: #81cde0 !important;">0</td>';
                //echo  '<script> alert("'.$row[0].'");</script>';
                // echo  '<script> alert("'.$row2[0].'");</script>';

            }else{

                If ($verfic == true) {

                    echo '<td style="width: 70px; text-align: center; border: solid; border-color: #4B5F65; background-color: #81cde0 !important;">0</td>';
                    //echo  '<script> alert("'.$row[0].'");</script>';
                    // echo  '<script> alert("'.$row2[0].'");</script>';

                }


            }





            foreach ($result_real_hierarquia_bisc[$z] as $row2) {


                If (trim($row[0]) == trim($row2[0])) {
                    echo '<td style="width: 70px; text-align: center; border: solid; border-color: #245269; background-color: #81cde0 !important;">'.$row2[1]. '</td>';
                    $verfic = false;

                    $total_Pontos_Choc_Real_bisc [] = $row2[1] ;
                    $total_Pontos_Choc_Real_Total_bisc [] = $row2[1] ;

                    break;

                }else {

                    $verfic = true;

                }




            }


            If (empty($result_real_hierarquia_bisc[$z])) {

                echo '<td style="width: 70px; text-align: center; border: solid; border-color: #4B5F65; background-color: #81cde0 !important;">0</td>';
                //echo  '<script> alert("'.$row[0].'");</script>';
                // echo  '<script> alert("'.$row2[0].'");</script>';

            }else{

                If ($verfic == true) {

                    echo '<td style="width: 70px; text-align: center; border: solid; border-color: #4B5F65; background-color: #81cde0 !important;">0</td>';
                    //echo  '<script> alert("'.$row[0].'");</script>';
                    // echo  '<script> alert("'.$row2[0].'");</script>';

                }


            }




            echo '<td style="width: 20px; text-align: center; background-color: #ced4d6 !important;"></td>';

            echo '<td style="width: 100px; text-align: center; border: solid; border-color: #245269;">R$  ' . number_format($row[8], 2, ',', '.') . '</td>';

            foreach ($result_vendas_choc[$z] as $row2) {
                If ($row[0] == $row2[0]) {
                    echo '<td style="width: 100px; text-align: center; border: solid; border-color: #245269; background-color: #81cde0 !important; ">R$  ' . number_format($row2[2], 2, ',', '.') . '</td>';
                    $verfic = false;

                    //echo  '<td style="width: 150px; text-align: center; border: solid; border-color: #4B5F65;">'.$row[3].'</td>';
                }

            }

           
            If ($verfic == true or empty($result_vendas[$z])) {

                echo '<td style="width: 100px; text-align: center; border: solid; border-color: #245269; background-color: #81cde0 !important;">0</td>';
                //echo  '<script> alert("'.$row[0].'");</script>';
                // echo  '<script> alert("'.$row2[0].'");</script>';

            }







            $numero = number_format(floatval($row[9]), 2, ',', '.');


            echo '<td style="width: 100px; text-align: center; border: solid; border-color: #245269;">R$  ' . $numero . '</td>';

            foreach ($result_vendas_bisc[$z] as $row2) {

                If (trim($row[0]) == trim($row2[0])) {
                    echo '<td style="width: 100px; text-align: center; border: solid; border-color: #245269; background-color: #81cde0 !important; ">R$  ' . number_format($row2[2], 2, ',', '.') . '</td>';
                    $verfic = false;
                    break;


                    //echo  '<td style="width: 150px; text-align: center; border: solid; border-color: #4B5F65;">'.$row[3].'</td>';
                }else {

                    $verfic = true;

                }

            }

            If (empty($result_vendas_bisc[$z])) {

                echo '<td style="width: 100px; text-align: center; border: solid; border-color: #245269; background-color: #81cde0 !important;">0</td>';
                //echo  '<script> alert("'.$row[0].'");</script>';
                // echo  '<script> alert("'.$row2[0].'");</script>';

            }else{

                If ($verfic == true) {

                    echo '<td style="width: 100px; text-align: center; border: solid; border-color: #245269; background-color: #81cde0 !important;">0</td>';
                    //echo  '<script> alert("'.$row[0].'");</script>';
                    // echo  '<script> alert("'.$row2[0].'");</script>';

                }


            }

//----------------------------------------------------------------------------------------------------------------------------------------------------------

            echo '<td style="width: 100px; text-align: center; border: solid; border-color: #245269;">R$  ' . number_format($row[2], 2, ',', '.') . '</td>';

            foreach ($result_vendas[$z] as $row2) {
                If ($row[0] == $row2[0]) {
                    echo '<td style="width: 100px; text-align: center; border: solid; border-color: #245269; background-color: #81cde0 !important; ">R$  ' . number_format($row2[2], 2, ',', '.') . '</td>';
                    $verfic = false;

                    //echo  '<td style="width: 150px; text-align: center; border: solid; border-color: #4B5F65;">'.$row[3].'</td>';
                }

            }


            If ($verfic == true or empty($result_vendas[$z])) {

                echo '<td style="width: 100px; text-align: center; border: solid; border-color: #245269; background-color: #81cde0 !important;">0</td>';
                //echo  '<script> alert("'.$row[0].'");</script>';
                // echo  '<script> alert("'.$row2[0].'");</script>';

            }


//--------------------------------------------------------------------------------------------------------------------------------------------------


            foreach ($result_vendas_desc[$z] as $row2) {


                If ($row[0] == $row2[0]) {


                    if($row2[1]<> null && $row2[1] <= $databonus){

                        echo '<td style="width: 100px; color:white;text-align: center; border: solid; border-color: #245269; background-color: green !important; ">SIM</td>';
                    }else{

                        echo '<td style="width: 100px; color:white; text-align: center; border: solid; border-color: #245269; background-color:red !important; ">NÃO</td>';
                    }


                    $verfic = false;

                    //echo  '<td style="width: 150px; text-align: center; border: solid; border-color: #4B5F65;">'.$row[3].'</td>';
                }

            }









            foreach ($result_dev[$z] as $row2) {

               // echo $row[3]; echo '-'; echo $row2[1]; echo '<br>';

                If ($row[3] == $row2[0]) {
                    echo '<td style="width: 100px; text-align: center; border: solid; border-color: #245269;">' . number_format($row2[1], 2, ',', '.') . '</td>';

                  $verfic = false;

                  break;

                }else {

                    $verfic = true;

                }



            }


            If (empty($result_dev[$z])) {

                echo '<td style="width: 100px; text-align: center; border: solid; border-color: #4B5F65;">0</td>';
                //echo  '<script> alert("'.$row[0].'");</script>';
                // echo  '<script> alert("'.$row2[0].'");</script>';

            }else{

                If ($verfic == true) {

                    echo '<td style="width: 100px; text-align: center; border: solid; border-color: #4B5F65;">0</td>';
                    //echo  '<script> alert("'.$row[0].'");</script>';
                    // echo  '<script> alert("'.$row2[0].'");</script>';

                }


            }





            //


            echo "</tr>";




        }

        $total_Posit_Geral [] =  $result_meta_super[$z][0][3];
        $total_Posit_Baton [] =  $result_meta_super[$z][0][0];
        $total_Posit_bisc [] =  $result_meta_super[$z][0][2];
        $total_Geral [] =  $result_meta_super[$z][0][1];



        echo '<tr class="success" style="background: #074456; font-size:14px;color: aliceblue;height: 30px;">';
        echo'<td style="width: 150px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">Total</td>';

        echo '<td id="kgmeta" style="width: 60px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.$result_meta_super[$z][0][3].'</td>';
        echo '<td id="Rkg" style="width: 70px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.$result_Jum2[$z][0][0].'</td>';

        echo '<td id="kgmeta" style="width: 60px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.$result_meta_super[$z][0][0].'</td>';
        echo '<td id="Rkg" style="width: 70px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.$result_baton2[$z][0][0].'</td>';

        echo '<td id="kgmeta" style="width: 60px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.$result_meta_super[$z][0][2].'</td>';
        echo '<td id="Rkg" style="width: 70px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.$result_bimarca_real[$z][0][0].'</td>';

        //echo '<td id="metav" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">R$ ' . number_format($result_meta_super[$z][0][6], 2, ',', '.').'</td>';
       // echo '<td id="metar" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;"> R$ ' . number_format($result_real_super_choc[$z] [0][1], 2, ',', '.').'</td>';

        echo '<td style="    width: 100px;text-align: center; border: solid;border-color: #ced4d6;background-color: #ced4d6;"></td>';
        echo '<td id="dev" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.array_sum($total_Clientes_Parcial).'</td>';
        echo '<td id="dev" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.array_sum($total_Pontos_Tot_Parcial).'</td>';
        echo '<td id="dev" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.array_sum($total_Pontos_Choc_Parcial).'</td>';
        echo '<td id="dev" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.array_sum($total_Pontos_Choc_Real).'</td>';
        echo '<td id="dev" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.array_sum($total_Pontos_Tot_Bisc_Parcial).'</td>';
        echo '<td id="metav" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.array_sum($total_Pontos_Tot_Bisc_Parcial2).'</td>';
        echo '<td id="metar" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.array_sum($total_Pontos_Choc_Real_bisc).'</td>';


        echo '<td style="    width: 100px;text-align: center; border: solid;border-color: #ced4d6;background-color: #ced4d6;"></td>';
        echo '<td id="metav" style="width: 100px; font-size:12px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">R$ ' . number_format($result_meta_super[$z][0][6], 2, ',', '.').'</td>';
        echo '<td id="metar" style="width: 100px; font-size:12px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;"> R$ ' . number_format($result_real_super_choc[$z] [0][1], 2, ',', '.').'</td>';
        echo '<td id="metav" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">R$ ' . number_format($result_meta_super[$z][0][7], 2, ',', '.').'</td>';
        echo '<td id="metar" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;"> R$ ' . number_format($result_real_super_bisc[$z] [0][1], 2, ',', '.').'</td>';
        echo '<td id="metav" style="width: 100px; font-size:12px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">R$ ' . number_format($result_meta_super[$z][0][1], 2, ',', '.').'</td>';
        echo '<td id="metar" style="width: 100px; font-size:12px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;"> R$ ' . number_format($result_real_super[$z] [0][1], 2, ',', '.').'</td>';

        echo '<td id="dev" style="width: 100px; text-align: center;  border: solid; border-color: #074456;border-right-color: #CED4D6;"></td>';

        echo '<td id="dev" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-left-color: #CED4D6;"> R$ ' . number_format($result_dev_super[$z] [0][1], 2, ',', '.').'</td>';

        echo "</tr>";

        $devolucao [] =  $result_dev_super[$z] [0][1];





        $z++;

    }

  } else {
    echo "Nennhum resultado retornado.";
    echo $id;

  }

    echo '</table>';
      echo '</br>';
      echo '<table align="center" cellpadding="5">';

error_reporting(0);


   //echo array_sum($total_Geral);

                           echo '<tr class="success" style="background: #074456; font-size:12px;color: aliceblue;height: 40px;">';
                           echo'<td style="width: 155px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">Total</td>';

                           echo '<td id="kgmeta" style="width: 60px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.array_sum($total_Posit_Geral).'</td>';
                           echo '<td id="Rkg" style="width: 65px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.$result_jum_totalr[0][0].'</td>';

                           echo '<td id="kgmeta" style="width: 65px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.array_sum($total_Posit_Baton).'</td>';
                           echo '<td id="Rkg" style="width: 65px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.$result_baton_totalr[0][0].'</td>';

                           echo '<td id="kgmeta" style="width: 65px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.array_sum($total_Posit_bisc).'</td>';
                           echo '<td id="Rkg" style="width: 80px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.$result_bimarca_totalr[0][0].'</td>';

                          // echo '<td id="metav" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">R$ ' . number_format($result_totalmeta[0][6], 2, ',', '.').'</td>';
                         //  echo '<td id="metar" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;"> R$ ' . number_format($result_totalreal_choc[0][1], 2, ',', '.').'</td>';

                           echo '<td style="width: 85px;text-align: center; border: solid;border-color: #ced4d6;background-color: #ced4d6;"></td>';
                           echo '<td id="Mrech" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.array_sum($total_Clientes_Total).'</td>';
                           echo '<td id="Rrech" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.array_sum($total_Pontos_Total).'</td>';
                           echo '<td id="Mcook" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.array_sum($total_Pontos_Choc).'</td>';


                           if ($total_Pontos_Choc_Real_Total === null){
                               echo '<td id="Rcook" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">0</td>';
                           }else{
                               echo '<td id="Rcook" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.array_sum($total_Pontos_Choc_Real_Total).'</td>';
                           }


                           echo '<td id="Rrech" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.array_sum($total_Pontos_Bisc_Total).'</td>';
                           echo '<td id="metav" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.array_sum($total_Pontos_Bisc_Total2).'</td>';


                           if($total_Pontos_Choc_Real_Total_bisc === null){
                               echo '<td id="metar" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;"> 0</td>';
                           }else{
                               echo '<td id="metar" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;"> '.array_sum($total_Pontos_Choc_Real_Total_bisc).'</td>';
                           }

                           echo '<td style="width: 70px; text-align: center; border: solid;border-color: #ced4d6;background-color: #ced4d6;"></td>';
                           echo '<td id="metav" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">R$ ' . number_format($result_totalmeta[0][6], 2, ',', '.').'</td>';
                           echo '<td id="metar" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;"> R$ ' . number_format($result_totalreal_choc[0][1], 2, ',', '.').'</td>';

                           echo '<td id="metav" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">R$ ' . number_format($result_totalmeta[0][7], 2, ',', '.').'</td>';
                           echo '<td id="metar" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;"> R$ ' . number_format($result_totalreal_bisc[0][1], 2, ',', '.').'</td>';

                           echo '<td id="metav" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">R$ ' . number_format(array_sum($total_Geral), 2, ',', '.').'</td>';
                           echo '<td id="metar" style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;"> R$ ' . number_format($result_totalreal[0][1], 2, ',', '.').'</td>';

                           echo '<td style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;"> </td>';

                        //   echo '<td style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;"> R$ ' . number_format($result_totalreal[0][1], 2, ',', '.').'</td>';
                           echo '<td style="width: 100px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;"> R$ ' . array_sum($devolucao).'</td>';





      if($result_totalmeta[0][0] !== null){

          $percent_valor = ($result_totalreal[0][1]/$result_totalmeta[0][1])*100;

      }




  echo '
</table>
</div>
</br>
</div>


<div class="col-md-1"></div> 
</div>

';
               

       
       
       ?>
            <script src="../js/bootstrap.min_1.js" type="text/javascript"></script>
            <script src="../js/FileSaver.min.js" type="text/javascript"></script>
            <script src="../js/tableexport.min.js" type="text/javascript"></script>
            <script> $('#resultados').tableExport(); </script>


    </body>
</html>
