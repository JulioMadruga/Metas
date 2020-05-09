<?php
require_once "Database/Conexao.php";

$directory = realpath('./arquivos/descompactados');
$pasta = $directory;

$dir = $pasta;

$scan = scandir($dir);

if(count($scan) > 2) {


}

else {

    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=processados.php'>";

}

if(is_dir($pasta))
{ $diretorio = dir($pasta);

$i = 0;

while(($arquivo = $diretorio->read()) !== false) {



    if($i>1) {

        $nome2 =$arquivo;

      //  echo '<a href="?nome=' . $arquivo . ' ">' . $arquivo . '</a><br />';

        $local = realpath('./arquivos/descompactados');

       $arquivo = $local . '\\' . $arquivo;
        $local2 = $local . '\\' . $arquivo;

        $nome = $arquivo;

// Abre o Arquvio no Modo r (para leitura)

        $arquivo = fopen($arquivo, 'r');

// Lê o conteúdo do arquivo
        while (!feof($arquivo)) {

            $linha = fgets($arquivo, 1024);
            // $result=explode(" ",$linha);
            // echo $linha.'<br />';}

            If (substr($linha, 0, 1) == '1') {

                $result = explode("  ", $linha);
              //  var_dump($result);

                // var_dump($result);

                // Num pedido
                $num_ped = intval(substr($result[0], 5, 10));

                // cod. cli
                $cod_cli = intval(substr($result[11], 2, 12));

              //  var_dump($result[25]);

             $pag = substr($result[25], 17,4);




                //data
//               echo "<br>";
//               echo $result[25];
//                echo "<br>";
             $data = substr($result[25], 9, 4) . '-' . substr($result[25], 13, 2) . '-' . substr($result[25], 15, 2);
//               echo "<br>";

            }



            If (substr($linha, 0, 1) == '2') {

                $result2 = explode("  ", $linha);

                //  var_dump($result2);


                //Cod Produto
                $produto = intval(substr($result2[10], 19, 17));

                //Quant. Prod
                $quant = intval(substr($result2[10], 37, 14));

                $valor = intval(substr($result2[10], 51, 29));

                $valor2 = substr($valor, 0, -2) . ',' . substr($valor, -2, 2);

                $v = strlen($valor2);

                if ($v>7 ) {

                    $valor3 = substr($valor2, 0, 2).'.'.substr($valor2, 2, 6);

                }else if ($v>6){

                    $valor3 = substr($valor2, 0, 1) . '.' . substr($valor2, 1, 6);

                }else{

                    $valor3 = $valor2;
                }




                $consulta_ped_Normal= $conn->prepare("SELECT cod_ped FROM ped_flexx where cod_ped = $num_ped and cod_prod = $produto");
                // var_dump($consulta_nf);
                $consulta_ped_Normal-> execute();
                $result_ped_Normal= $consulta_ped_Normal->fetchAll();



                $consulta_rca= $conn->prepare("SELECT rca FROM clientes_flexx where cod_cli = $cod_cli");
                // var_dump($consulta_nf);
                $consulta_rca-> execute();
                $result_rca= $consulta_rca->fetchAll();

                $rca = $result_rca[0][0];


                if (empty($result_ped_Normal)){

//
//                    if($produto == 12348164 or $produto == 12348314 or $produto == 12348320 or
//                        $produto == 12353508 or $produto == 12399222 or $produto == 12433130 or $produto == 12384783){
//
//                        $insert_ped = $conn->prepare("INSERT INTO ped_ovos(cod_ped,cod_cli,cod_prod,quant,valor,data, pag) values ('$num_ped','$cod_cli','$produto','$quant','$valor3','$data','$pag')");
//
//                    //var_dump($insert_ped);
//                    $insert_ped->execute();
//                    }

                    if($produto !== 12348164 && $produto !== 12348314 && $produto !== 12348320 &&
                        $produto !== 12353508 && $produto !== 12399222 && $produto !== 12433130 && $produto !== 12384783){

                        $insert_ped = $conn->prepare("INSERT INTO ped_flexx(rca,cod_ped,cod_cli,cod_prod,quant,valor,data, pag) values ('$rca','$num_ped','$cod_cli','$produto','$quant','$valor3','$data','$pag')");

                        //var_dump($insert_ped);
                        $insert_ped->execute();
                    }


                }


                $consulta_ped= $conn->prepare("SELECT cod_ped FROM ped_ovos where cod_ped = $num_ped and cod_prod = $produto");
                 // var_dump($consulta_nf);
                 $consulta_ped-> execute();
                $result_ped_Pascoa= $consulta_ped->fetchAll();


                if (empty($result_ped_Pascoa)){


                    if($produto == 12348164 or $produto == 12348314 or $produto == 12348320 or
                        $produto == 12353508 or $produto == 12399222 or $produto == 12433130 or $produto == 12384783){

                        $insert_ped = $conn->prepare("INSERT INTO ped_ovos(rca, cod_ped,cod_cli,cod_prod,quant,valor,data, pag) values ('$rca','$num_ped','$cod_cli','$produto','$quant','$valor3','$data','$pag')");

                    //var_dump($insert_ped);
                    $insert_ped->execute();
                    }



                }






            }



        }

        sleep(0.5);

        // Fecha arquivo aberto
        fclose($arquivo);

        $origem = $nome;
        $destino = realpath('./arquivos/processados/') . '\\' . $nome2;
       // var_dump($destino);
        copy($origem, $destino);
        chmod($origem, 0777);



         $arq = realpath('./arquivos/descompactados/' . '\\' . $nome2);
        //var_dump(is_file($arq));
//chmod( $arq, 0777 );
        unlink($arq);

   }

$i++;

    }
    $diretorio->close();


}else{
    echo 'A pasta não existe.';
}



echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=processados.php'>";





?>