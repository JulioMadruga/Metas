<?php
require_once 'database/conectar.php';

$itensgeral = ['cod_cli','cliente','cod_vend','vend','canal','nestleatevc'

];

$sql = "";

$id_user = $_GET["id"];

var_dump($file = $_FILES['img']['tmp_name']);

$numFile = count(array_filter($file));



foreach ($itensgeral as $itens){


             if(!isset($_POST[$itens])) {

                 $$itens = 'N';

              }elseif ($_POST[$itens]=='on'){

                 $$itens = 'S';
             }else{

                 $$itens = $_POST[$itens];
             }



}



function image_handler($source_image,$destination,$tn_w = 100,$tn_h = 100,$quality = 80,$wmsource = false) {
    // The getimagesize functions provides an "imagetype" string contstant, which can be passed to the image_type_to_mime_type function for the corresponding mime type
    $info = getimagesize($source_image);
    $imgtype = image_type_to_mime_type($info[2]);
    // Then the mime type can be used to call the correct function to generate an image resource from the provided image
    switch ($imgtype) {
        case 'image/jpeg':
            $source = imagecreatefromjpeg($source_image);
            break;
        case 'image/gif':
            $source = imagecreatefromgif($source_image);
            break;
        case 'image/png':
            $source = imagecreatefrompng($source_image);
            break;
        default:
            die('Invalid image type.');
    }
    // Now, we can determine the dimensions of the provided image, and calculate the width/height ratio
    $src_w = imagesx($source);
    $src_h = imagesy($source);
    $src_ratio = $src_w/$src_h;
    // Now we can use the power of math to determine whether the image needs to be cropped to fit the new dimensions, and if so then whether it should be cropped vertically or horizontally. We're just going to crop from the center to keep this simple.
    if ($tn_w/$tn_h > $src_ratio) {
        $new_h = $tn_w/$src_ratio;
        $new_w = $tn_w;
    } else {
        $new_w = $tn_h*$src_ratio;
        $new_h = $tn_h;
    }
    $x_mid = $new_w/2;
    $y_mid = $new_h/2;
    // Now actually apply the crop and resize!
    $newpic = imagecreatetruecolor(round($new_w), round($new_h));
    imagecopyresampled($newpic, $source, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);
    $final = imagecreatetruecolor($tn_w, $tn_h);
    imagecopyresampled($final, $newpic, 0, 0, ($x_mid-($tn_w/2)), ($y_mid-($tn_h/2)), $tn_w, $tn_h, $tn_w, $tn_h);
    // If a watermark source file is specified, get the information about the watermark as well. This is the same thing we did above for the source image.
    if($wmsource) {
        $info = getimagesize($wmsource);
        $imgtype = image_type_to_mime_type($info[2]);
        switch ($imgtype) {
            case 'image/jpeg':
                $watermark = imagecreatefromjpeg($wmsource);
                break;
            case 'image/gif':
                $watermark = imagecreatefromgif($wmsource);
                break;
            case 'image/png':
                $watermark = imagecreatefrompng($wmsource);
                break;
            default:
                die('Invalid watermark type.');
        }
        // Determine the size of the watermark, because we're going to specify the placement from the top left corner of the watermark image, so the width and height of the watermark matter.
        $wm_w = imagesx($watermark);
        $wm_h = imagesy($watermark);
        // Now, figure out the values to place the watermark in the bottom right hand corner. You could set one or both of the variables to "0" to watermark the opposite corners, or do your own math to put it somewhere else.
        $wm_x = $tn_w - $wm_w;
        $wm_y = $tn_h - $wm_h;
        // Copy the watermark onto the original image
        // The last 4 arguments just mean to copy the entire watermark
        imagecopy($final, $watermark, $wm_x, $wm_y, 0, 0, $tn_w, $tn_h);
    }
    // Ok, save the output as a jpeg, to the specified destination path at the desired quality.
    // You could use imagepng or imagegif here if you wanted to output those file types instead.
    if(Imagejpeg($final,$destination,$quality)) {
        return true;
    }
    // If something went wrong
    return false;
}



//var_dump($teste = $_FILES['img']['tmp_name'][0]);



if (isset($_FILES)){


    //get the uploaded image
    $source_image = $_FILES['img']['tmp_name'][0];
    //specify the output path in your file system and the image size/quality
    $resizeFileName = md5(rand());
    $destination = 'uploads/'.$resizeFileName.'.jpg';
    $tn_w = 530;
    $tn_h = 530;
    $quality = 100;
    //path to an optional watermark
    // $wmsource = '/path/to/your/watermark/image.png';
    // Try to process the image and echo a small message whether or not it worked. If the image is saved somewhere public, you could add an <img src> tag to display the image here, too!
  //  $success = image_handler($source_image,$destination,$tn_w,$tn_h,$quality);

   // $images1[] = $resizeFileName;

    $file = $_FILES['img']['tmp_name'];
    //var_dump($numFile = count(array_filter($file)));


    for($i = 0; $i < $numFile; $i++){


        //get the uploaded image
        $source_image = $_FILES['img']['tmp_name'][$i];
        //specify the output path in your file system and the image size/quality
        $resizeFileName = md5(rand());
        $destination = 'uploads/'.$resizeFileName.'.jpg';
        $tn_w = 1024;
        $tn_h = 728;
        $quality = 100;
        //path to an optional watermark
        // $wmsource = '/path/to/your/watermark/image.png';
        // Try to process the image and echo a small message whether or not it worked. If the image is saved somewhere public, you could add an <img src> tag to display the image here, too!
        $success = image_handler($source_image,$destination,$tn_w,$tn_h,$quality);

        $images2[] =  $resizeFileName;

    }



}

$images = array_merge($images2);

$imgJSON = json_encode($images);

$nestleatevc = "S";


$import = $conn->prepare("INSERT INTO clientes_site (id_user,rca, nome,cod_cli,razao, canal, images, status, data_cad) VALUES
                             ('$id_user','$cod_vend','$vend','$cod_cli','$cliente','$canal','$imgJSON','$nestleatevc',NOW())");
// var_dump($import);
$import->execute();

header("Location:clienteatevc.php?result=ok");