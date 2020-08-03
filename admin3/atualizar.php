<?php
require_once '../Database/Conexao.php';

$meta = $_POST['mes'];

$consulta_ved = $conn->prepare("SELECT a.rca FROM $meta a, usuarios b WHERE  a.Rca = b.Rca and b.tipo= 'logar' order by vendedor");
 $consulta_ved-> execute();
 $result2= $consulta_ved->fetchAll();


       $i = 0;
    foreach($result2 as $row) {

        extract($row);

         $linha[$i] = "'$row[0]'";



        $i++;

       }




          $meta = $_POST['mes'];
          $valor= $_POST['valor'];
          $trimarca= $_POST['trimarca'];
          $meta_baton= $_POST['meta_baton'];
          $jumbo= $_POST['jumbo'];
          $valor_choc = $_POST['valor_choc'];

          $posit_rech = $_POST['posit_rech'];
          $posit_cookie = $_POST['posit_cookie'];
          $posit_serenata = $_POST['posit_serenata'];
          $valor_bisc = $_POST['valor_bisc'];



$i=0;
foreach($valor AS $row ) {
  // echo $produto.'<br />';
  // echo $i;
   $up_valor= $conn->prepare("update $meta set valor ='".$row."' where rca =". $linha["$i"]);
  // print_r($up_valor);
   $up_valor->execute();

  // var_dump($up_valor);

   $i++ ;


}

$i=0;
foreach($trimarca AS $row ) {
  // echo $produto.'<br />';
  // echo $i;
   $up_trimarca= $conn->prepare("update $meta set trimarca = $row where rca =". $linha["$i"]);
   $up_trimarca->execute();

   $i++ ;


}



$i=0;
foreach($meta_baton AS $row ) {
  // echo $produto.'<br />';
  // echo $i;
   $up_meta_baton= $conn->prepare("update $meta set meta_baton = $row where rca =". $linha["$i"]);

   $up_meta_baton->execute();


   $i++ ;


}

$i=0;
foreach($jumbo AS $row ) {
  // echo $produto.'<br />';
  // echo $i;
   $up_jumbo= $conn->prepare("update $meta set tab = $row where rca =". $linha["$i"]);
   $up_jumbo->execute();


   $i++ ;


}


$i=0;
foreach($valor_bisc AS $row ) {
    // echo $produto.'<br />';
    // echo $i;
    $up_valor_bisc= $conn->prepare("update $meta set valor_bisc ='".$row."' where rca =". $linha["$i"]);
    $up_valor_bisc->execute();



    $i++ ;


}

$i=0;
foreach($valor_choc AS $row ) {
    // echo $produto.'<br />';
    // echo $i;
    $up_valor_choc= $conn->prepare("update $meta set valor_choc ='".$row."' where rca =". $linha["$i"]);
    $up_valor_choc->execute();



    $i++ ;


}

$i=0;
foreach($posit_rech AS $row ) {
    // echo $produto.'<br />';
    // echo $i;
    $up_posit_rech= $conn->prepare("update $meta set posit_jumbos ='".$row."' where rca =". $linha["$i"]);
    $up_posit_rech->execute();


    $i++ ;


}

$i=0;
foreach($posit_cookie AS $row ) {
    // echo $produto.'<br />';
    // echo $i;
    $up_posit_cookie= $conn->prepare("update $meta set posit_talento ='".$row."' where rca =". $linha["$i"]);
    $up_posit_cookie->execute();



    $i++ ;


}

$i=0;
foreach($posit_serenata AS $row ) {
    // echo $produto.'<br />';
    // echo $i;
    $up_posit_serenata= $conn->prepare("update $meta set posit_serenata ='".$row."' where rca =". $linha["$i"]);
    $up_posit_serenata->execute();



    $i++ ;


}


if(isset($_POST['excluir'])){

$excluir = $_POST['excluir'];
foreach($excluir as $item){

   $Excluir_Vend= $conn->prepare("delete from $meta WHERE vendedor='$item'");
   $Excluir_Vend->execute();

   $Excluir_Vend2= $conn->prepare("delete from Usuarios WHERE nome='$item'and tipo = 'logar'");
   $Excluir_Vend2->execute();

   echo ("<script>alert('O Vendedor ".$item." foi Exluido');</script>");

//aqui o resto da query
}
echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastrar.php'>";
 die;
}


echo ("<script>alert('Dados Atualizado com Sucesso!!!');window.history.go(-1);</script>"); die;


      
      ?>