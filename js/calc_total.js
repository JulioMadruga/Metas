function calc_kg(vd){
    
    i=0;
    somar = 0;
    somar_valor = 0;
    somar_tri = 0;
    somar_baton = 0;
    somar_tab = 0;
    somar_rech = 0;
    somar_cookie = 0;

    somar_total = 0;


	   
      
    while(i<vd){

         var tri = parseInt(document.getElementById('trimarca'+i).value);
         var mbaton = parseInt(document.getElementById('meta_baton'+i).value);
         var jumbo = parseInt(document.getElementById('jumbo'+i).value);

         var rech = parseInt(document.getElementById('posit_rech'+i).value);
         var cookies = parseInt(document.getElementById('posit_cookie'+i).value);

         var valor_choc = parseFloat(document.getElementById('valor_choc'+i).value);
         var valor_bisc = parseFloat(document.getElementById('valor_bisc'+i).value);



         somar_tri = somar_tri + tri;
         
         document.getElementById('total_tri').value = somar_tri;
         
         
        somar_baton = somar_baton + mbaton;
         
         document.getElementById('total_baton').value = somar_baton;
         
         
         somar_tab = somar_tab + jumbo;
         
         document.getElementById('total_jumbo').value = somar_tab;



         somar_rech = somar_rech + rech;

        document.getElementById('total_rech').value = somar_rech;

        somar_cookie = somar_cookie + cookies;

        document.getElementById('total_cookie').value = somar_cookie;



        valor_total = (valor_choc + valor_bisc).toFixed(2);

        document.getElementById('valor'+i).value = parseFloat(valor_total).toFixed(2);


        var valor_soma = parseFloat(document.getElementById('valor'+i).value);

        somar_total = somar_total + valor_soma;


        //retornará 1.234,53
        function formatNumber(value) {
            value = convertToFloatNumber(value);
            return value.formatMoney(2, ',', '.');
        }

        //transforma a entrada em número float
        var convertToFloatNumber = function(value) {
            value = value.toString();
            if (value.indexOf('.') !== -1 && value.indexOf(',') !== -1) {
                if (value.indexOf('.') <  value.indexOf(',')) {
                    //inglês
                    return parseFloat(value.replace(/,/gi,''));
                } else {
                    //português
                    return parseFloat(value.replace(/./gi,'').replace(/,/gi,'.'));
                }
            } else {
                return parseFloat(value);
            }
        }

//prototype para formatar a saída
        Number.prototype.formatMoney = function (c, d, t) {
            var n = this,
                c = isNaN(c = Math.abs(c)) ? 2 : c,
                d = d == undefined ? "." : d,
                t = t == undefined ? "," : t,
                s = n < 0 ? "-" : "",
                i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
                j = (j = i.length) > 3 ? j % 3 : 0;
            return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
        };




        document.getElementById('total_valor').value ='R$ ' + formatNumber(somar_total);;

          
         
         
        i++;  
         }; 




     }

function tri(){
    
    var meta = parseInt(document.getElementById('tri').innerText);
    var result= parseInt(document.getElementById('tri_result').innerText);
    
    
    dif = ((result/meta)*100).toFixed(0);
    
 if(dif>100){
    
   difn = "100%";
  
    document.getElementById('graftri').style.width = difn;
    document.getElementById('graftri').innerText = difn+"  Atingido";
    
} else{
    difn = dif.toString();
document.getElementById('graftri').style.width = difn+"%";
document.getElementById('graftri').innerText = difn+"%"+"  Atingido";
}
}

function bat(){
    
    var meta = parseInt(document.getElementById('baton').innerText);
    var result= parseInt(document.getElementById('baton_result').innerText);
    
    
    dif = ((result/meta)*100).toFixed(0);
    
 if(dif>100){
    
   difn = "100%";
  
    document.getElementById('grafbaton').style.width = difn;
    document.getElementById('grafbaton').innerText = difn+"  Atingido";
    
} else{
    difn = dif.toString();
document.getElementById('grafbaton').style.width = difn+"%";
document.getElementById('grafbaton').innerText = difn+"%"+"  Atingido";
}

}



function rech(){

    var meta = parseInt(document.getElementById('rech').innerText);
    var result= parseInt(document.getElementById('rech_result').innerText);


    dif = ((result/meta)*100).toFixed(0);

    if(dif>100){

        difn = "100%";

        document.getElementById('grafrech').style.width = difn;
        document.getElementById('grafrech').innerText = difn+"  Atingido";

    } else{
        difn = dif.toString();
        document.getElementById('grafrech').style.width = difn+"%";
        document.getElementById('grafrech').innerText = difn+"%"+"  Atingido";
    }

}


function cookie(){

    var meta = parseInt(document.getElementById('cookie').innerText);
    var result= parseInt(document.getElementById('cookie_result').innerText);


    dif = ((result/meta)*100).toFixed(0);

    if(dif>100){

        difn = "100%";

        document.getElementById('grafcookie').style.width = difn;
        document.getElementById('grafcookie').innerText = difn+"  Atingido";

    } else{
        difn = dif.toString();
        document.getElementById('grafcookie').style.width = difn+"%";
        document.getElementById('grafcookie').innerText = difn+"%"+"  Atingido";
    }

}



function jum(){

    var meta = parseInt(document.getElementById('jumbo').innerText);
    var result= parseInt(document.getElementById('jumbo_result').innerText);


    dif = ((result/meta)*100).toFixed(0);

    if(dif>100){

        difn = "100%";

        document.getElementById('grafjumbo').style.width = difn;
        document.getElementById('grafjumbo').innerText = difn+"  Atingido";

    } else{
        difn = dif.toString();
        document.getElementById('grafjumbo').style.width = difn+"%";
        document.getElementById('grafjumbo').innerText = difn+"%"+"  Atingido";
    }

}





// function valordesc(){
//
//     var meta = document.getElementById('valordesc').innerText;
//     var result=document.getElementById('valordesc_realizado').innerText;
//
//     metavalor =  parseFloat(meta.replace("R$","").replace(".","").replace(",","."));
//     resultvalor =  parseFloat(result.replace("R$","").replace(".","").replace(",","."));
//
//     difv = ((resultvalor/metavalor)*100).toFixed(0);
//
//    if (difv>100){
//
//    difnv= "100%";
//
//     document.getElementById('grafvalordesc').style.width = difnv;
//     document.getElementById('grafvalordesc').innerText = difnv+"  Atingido";
//
// } else{
//     difnv = difv.toString();
//
// document.getElementById('grafvalordesc').style.width = difnv+"%";
// document.getElementById('grafvalordesc').innerText = difnv+"%"+"  Atingido";
// }
// }




function valor(){

    var meta = document.getElementById('valor').innerText;
    var result=document.getElementById('valor_realizado').innerText;

    metavalor =  parseFloat(meta.replace("R$","").replace(".","").replace(",","."));
    resultvalor =  parseFloat(result.replace("R$","").replace(".","").replace(",","."));

    difv = ((resultvalor/metavalor)*100).toFixed(0);

    if (difv>100){

        difnv= "100%";

        document.getElementById('grafvalor').style.width = difnv;
        document.getElementById('grafvalor').innerText = difnv+"  Atingido";

    } else{
        difnv = difv.toString();

        document.getElementById('grafvalor').style.width = difnv+"%";
        document.getElementById('grafvalor').innerText = difnv+"%"+"  Atingido";
    }
}



function valor_bisc(){

    var meta = document.getElementById('valor_bisc').innerText;
    var result=document.getElementById('valor_realizado_bisc').innerText;

    metavalor =  parseFloat(meta.replace("R$","").replace(".","").replace(",","."));
    resultvalor =  parseFloat(result.replace("R$","").replace(".","").replace(",","."));

    difv = ((resultvalor/metavalor)*100).toFixed(0);

    if (difv>100){

        difnv= "100%";

        document.getElementById('grafbisc').style.width = difnv;
        document.getElementById('grafbisc').innerText = difnv+"  Atingido";

    } else{
        difnv = difv.toString();

        document.getElementById('grafbisc').style.width = difnv+"%";
        document.getElementById('grafbisc').innerText = difnv+"%"+"  Atingido";
    }
}




function bonus(){
        var v1 =parseFloat(document.getElementById('grafbisc').style.width.replace("%",""))
        var v2 =parseFloat(document.getElementById('grafvalor').style.width.replace("%",""))
        var v3 =parseFloat(document.getElementById('grafjumbo').style.width.replace("%",""))
        var v4 =parseFloat(document.getElementById('grafcookie').style.width.replace("%",""))
        var v5 =parseFloat(document.getElementById('grafrech').style.width.replace("%",""))
        var v6 =parseFloat(document.getElementById('grafbaton').style.width.replace("%",""))
        var v7 =parseFloat(document.getElementById('graftri').style.width.replace("%",""))


    total = parseFloat((v1 + v2 + v3  + v4 + v5 + v6 + v7) / 7).toFixed(0)

   if(total == 100 ){

       document.getElementById('grafbonus').style.width = "100%"
       document.getElementById('grafbonus').innerText = "100%"+"  Atingido";
	   document.getElementById('grafbonus').className = 'progress-bar progress-bar-success  progress-bar-striped active'

   }else {

       document.getElementById('grafbonus').style.width = total+"%"
       document.getElementById('grafbonus').innerText = total+"%" +"  Atingido";
   }
}

function login(){
    
    var tipo = document.getElementById('tipo').value; 
    
    document.getElementById('acao').value = tipo;
    
}

function verifica(){
    var tabela = document.getElementById('tabela');    
    var linhas = tabela.getElementsByTagName('tr');     
    cont = linhas.length -2;
       
    i=0;
   
    
   while(i<cont){
    
     var valor = document.getElementById('valor'+i).innerText; 
     metavalor =  parseFloat(valor.replace("R$","").replace(".","").replace(",","."));
  // alert(metavalor);
    
    if (metavalor<0){
    document.getElementById('vendas'+i).style.color = "rgb(255, 0, 0)";
    document.getElementById('vendas'+i).style.fontWeight = "bold";
   
   
    } 
    if(i % 2 == 0){
        document.getElementById('vendas'+i).style.background = "#BED1D6";
        
        
    } i++;
    }

}
    
 
function calc_metatri(){
    
    var tabela = document.getElementById('tabela');    
    var linhas = tabela.getElementsByTagName('tr');     
    cont = linhas.length -1;
   
   i=0;
   soma=0;
    
    while(i<cont){
         var total = parseInt(document.getElementById('meta'+i).innerText);
    
    soma = soma + total;
    i++;
}
   document.getElementById('totalmetatri').innerText = soma;
   
   totaltri = parseInt(document.getElementById('totaltri').innerText);
   
   total = soma - totaltri;
   
   document.getElementById('diftri').innerText = total
   

   
   
}