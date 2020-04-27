
<?php


    require '../PHPMailer/PHPMailerAutoload.php';
    require '../Database/Conexao.php';


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



$cont_tri = $conn->prepare("select * from trimarca");
$cont_tri->execute();
$result_cont = $cont_tri->fetchAll();

$bat = $result_cont[0][0];
$tal = $result_cont[0][1];
$ser = $result_cont[0][2];



$consulta_email= $conn->prepare("select vendedor,trimarca, Count(nome_parceiro)as reali, if(trimarca -Count(nome_parceiro)<0,0,trimarca -Count(nome_parceiro)) as dif, email, rca from 
(Select vendedor,nome_parceiro, sum(baton)as baton, sum(talento) as talento, trimarca, email, rca from 
(SELECT b.vendedor,a.nome_parceiro, a.quantidade, a.material in($bat) as Baton, 
a.material in($tal) as Talento, b.vendedor as vend, b.trimarca, c.email, b.rca FROM $mes a, $meta b, usuarios c where a.material in ($bat,$tal) and a.quantidade>0 and a.vendedor= b.rca and a.VENDEDOR = c.Rca) 
sub group by nome_parceiro)sub where baton>0 and talento>0 and rca = 502 group by vendedor");
$consulta_email->execute();
$result_email = $consulta_email->fetchAll();


$consulta_metatri = $conn->prepare(" select a.vendedor, a.trimarca,a.rca, b.email from $meta a, usuarios b where a.rca = b.rca order by vendedor");
$consulta_metatri->execute();
$result_metatri = $consulta_metatri->fetchAll();





    foreach ($result_metatri as $i => $row){

        $verfic = true;

    $mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.terra.com.br';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'julio@disnorteagil.com.br';                 // SMTP username
    $mail->Password = '712196j';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    $mail->CharSet = 'UTF-8';

    $mail->setFrom('julio@disnorteagil.com.br', 'Julio');
    $mail->addAddress($row[3], $row[0]);     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
     $mail->addCC('julio@disnorteagil.com.br');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'ACOMPANHAMETO BIMARCA';

        $consulta_tri= $conn->prepare("SELECT Cod_Cliente,Nome from clientes WHERE Cod_Cliente NOT IN (select id from(Select vendedor,nome_parceiro, sum(baton)as baton, sum(talento) as talento, trimarca, rca, id from
 (SELECT b.vendedor,a.nome_parceiro, a.quantidade, a.material in($bat) as Baton, a.material in($tal) as Talento,
 b.vendedor as vend, b.trimarca, b.rca, a.ID FROM $mes a, $meta b where a.material in ($bat,$tal) 
 and a.quantidade>0 and a.vendedor= b.rca) sub group by nome_parceiro)sub where baton>0 and talento>0 and Vendedor = '$row[0]')and Vendedor = '$row[0]'");
        $consulta_tri->execute();
        $result_tri = $consulta_tri->fetchAll();


    $mail->Body = '
      
    <table style="width: 100%;background: #164c5d;border: solid;border-color: #ffffff;border-style: double;">
        <tr>
            <td style="width:200px; padding: 10px;"><img style="margin: 8px;" src="http://disnorteagil.no-ip.biz:8090/objetivos/images/garoto.png"></td>

            <td style="width:400px"></td>

            <td style="width:200px; padding: 10px;"><img style="float: right" src="http://disnorteagil.no-ip.biz:8090/objetivos/images/disnorte.png"></td>

        </tr>


    </table>



<p style="font-family:Dosis; font-size: 20px; color: #335a67; ">Ol&aacute; <strong style="color: #164c5d; "> '.str_replace('VG','',str_replace('CBA','',$row{'vendedor'})).'</strong> segue para acompanhamento Meta Bimarca Mês de '.$mes.'</p>


<table cellpadding="5" style="color:#0F4150; font-family:Dosis;  ">

    <tr style = "height:40px">
        <td colspan="3" style="background: #074456;color: aliceblue; font-size:20px; text-align: center;">PARCIAL BIMARCA</td>
    </tr>

    <tr style="background: #074456;color: aliceblue; font-size:20px;">
        <td style="width: 100px; text-align: center; ">META</td>
        <td style="width: 150px; text-align: center; ">REALIZADO</td>
        <td style="width: 150px; text-align: center; ">A REALIZAR</td>

    </tr>

    <tr style="background: #7fb3c3;color: aliceblue; font-size:20px;" >
    
    
        <td style="width: 100px; text-align: center; ">'.$row[1].'</td>';

        foreach ($result_email as $row2){
            If($row[2] == $row2[5]){

                $mail->Body .='
        <td style="width: 150px; text-align: center; ">'.$row2[2].'</td>
        <td style="width: 150px; text-align: center; ">'.$row2[3].'</td>';

                $verfic = false;

                //echo  '<td style="width: 150px; text-align: center; border: solid; border-color: #4B5F65;">'.$row[3].'</td>';
            }

        }

        If($verfic == true){

            $mail->Body .='
        <td style="width: 150px; text-align: center; ">0</td>
        <td style="width: 150px; text-align: center; ">'.$row[1].'</td>';

        }

        $mail->Body .='
    </tr>


</table>
<br>
<br>
<br>
<br>
<h3 style="font-family:Dosis; font-size: 20px; color: #335a67; ">Segue lista de cliente que ainda não foram positivados</h3>

<table cellpadding="5" style="color:#0F4150; font-family:Dosis;  ">

<tr style = "height:40px">
        <td colspan="2" style="background: #FFC107;color: #E91E63;  font-size:20px; text-align: center;">CLIENTES SEM POSITIVAÇÃO BIMARCA</td>
    </tr>
<tr style="background: #FFEB3B;color: #E91E63; font-size:20px;">
 <td style="width: 200px; text-align: center; ">Cod. Cliente</td>
 <td style="width: 400px; text-align: center; ">Razão</td>

</tr>
';
    foreach ($result_tri as $row2) {
        $mail->Body .='

        <tr style = "background: #fbf196;color: #3f4142; font-size:20px;" >
        <td style = "width: 200px; text-align: center; " > '.$row2[0].'</td >
        <td style = "width: 400px; text-align: center; " > '.$row2[1].'</td >
        

    </tr >
';
}
        $mail->Body .='
</table>




    ';

    //$mail->msgHTML(file_get_contents('../PHPMailer/examples/contents.html'), dirname(__FILE__));
    $mail->AltBody = 'email teste';

    if (!$mail->send()) {
        echo 'Mensagem não enviada';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Mensagem enviada - '.$row{'vendedor'}.'-'.$row{'email'}.'<br>';
    }

        if ($i > 0 && $i % 10 == 0) {
            sleep(30);
        }


}






