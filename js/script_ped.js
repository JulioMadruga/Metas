var val="H";

function masc(valor){

    valor = valor.toString().replace(/\D/g,"");
    valor = valor.toString().replace(/(\d)(\d{8})$/,"$1.$2");
    valor = valor.toString().replace(/(\d)(\d{5})$/,"$1.$2");
    valor = valor.toString().replace(/(\d)(\d{2})$/,"$1,$2");
    return valor


};
$( function() {

    $( "#autocomplete_cli" ).autocomplete({
        source: function( request, response ) {


            $.ajax({
                url: "api/autocomplete_cli.php",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function( data ) {
                    console.log(data);
                    response( data );

                }
            });

        },
        select: function (event, ui) {

            cli_cod = ui

            $('#autocomplete_cli').val(ui.item.label); // display the selected text

            if(ui.item.tipo === "F"){

                $('#select_cpf').val(ui.item.value); // save selected id to input
            }else {
                $('#select_cpf').val(ui.item.cnpj); // save selected id to input
            }


            $('#selectuser_id').val(ui.item.id_cli); // save selected id to input

            try {
                app.newOrc.id_cli = ui.item.id_cli;
            }catch (e) {

                app.newLoc.id_cli = ui.item.id_cli;
            }



            return false;
        }
    });

    /======================================================================/



    $( "#autocomplete_cli2" ).autocomplete({
        source: function( request, response ) {


            $.ajax({
                url: "api/autocomplete_cli.php",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function( data ) {

                    response( data );

                }
            });

        },
        select: function (event, ui) {

            $('#autocomplete_cli2').val(ui.item.label); // display the selected text
            $('#select_cpf2').val(ui.item.value); // save selected id to input
            app.clickedOrc.id_cli = ui.item.id_cli;
            return false;
        }
    });

    /======================================================================/



    $( "#autocomplete_prod" ).autocomplete({
        source: function( request, response ) {


            $.ajax({
                url: "api/autocomplete_prod.php",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function( data ) {

                    response( data );

                }
            });

        },
        select: function (event, ui) {

            val = ui;
            $('#autocomplete_prod').val(ui.item.label); // display the selected text
            $('#valor').val(ui.item.H);
            $('#id_prod').val(ui.item.value);
            $('#quant').val(1);

            try {
                app.newOrc.proddesc = ui.item.label;
                app.newOrc.id_prod = ui.item.value;
                app.newOrc.un_medida = 'H';
                app.newOrc.vluni = "R$ " + parseFloat(ui.item.H).toFixed(2);
            }catch (e) {
                app.newLoc.proddesc = ui.item.label;
                app.newLoc.id_prod = ui.item.value;
                app.newLoc.un_medida = 'H';
                app.newLoc.vluni = "R$ " + parseFloat(ui.item.H).toFixed(2);
            }


            // $('#selectuser_id').val(ui.item.value); // save selected id to input
            return false;



        },






    });



    /======================================================================/



    $( "#autocomplete_prod2" ).autocomplete({
        source: function( request, response ) {


            $.ajax({
                url: "api/autocomplete_prod.php",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function( data ) {

                    response( data );

                }
            });

        },
        select: function (event, ui) {

            val = ui;
            $('#autocomplete_prod2').val(ui.item.label); // display the selected text
            $('#valor').val(ui.item.H);
            app.clickedOrc.id_prod = ui.item.value;
            $('#select_autocomplete').val('H');
            app.clickedOrc.vluni = ui.item.H;
            $('#quant').val(1);
            // $('#selectuser_id').val(ui.item.value); // save selected id to input
            return false;



        },






    });


    $( "#autocomplete_orc" ).autocomplete({
        source: function( request, response ) {


            $.ajax({
                url: "api/autocomplete_orc.php",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term

                },

                success: function( data ) {

                  response( data );

                }
            });

        },
        select: function (event, ui) {

            $('#autocomplete_orc').val("Nº: "+ui.item.value+"  -  "+ui.item.label); // display the selected text
            $('#autocomplete_orcaValor').val(ui.item.vl_total); // save selected id to input
            app.locacao.id_OrcAuto = ui.item.value;
            return false;
        },

    })

        
       .autocomplete( "instance" )._renderItem = function( ul, item ) {
        return $( "<li>" )
            .append( "<div>" +"<strong> NºOrcamento: "+ item.value + "</strong> - " + item.label + " - R$" + masc(item.vl_total) + "</div>" )
            .appendTo( ul );
       };



});

function split( val ) {
    return val.split( /,\s*/ );
}
function extractLast( term ) {
    return split( term ).pop();
}

$('#close').on('click', function (e) {

    $('#modal-dialog').hide()
});

$('#close3').on('click', function (e) {

    $('#modal-edit').hide()
});

$('#close4').on('click', function (e) {

    $('#modal-busca').hide()
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove()
      console.log('fechar')
});
