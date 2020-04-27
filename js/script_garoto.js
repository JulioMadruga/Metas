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

            $('#autocomplete_cli').val(ui.item.label); // display the selected text
            $('#cod_cli').val(ui.item.id_cli); // display the selected text
            $('#cod_vend').val(ui.item.rca); // display the selected text
            $('#vend').val(ui.item.vend); // display the selected text
            $('#canal').val(ui.item.canal); // display the selected text
            document.getElementById('canalCliente').innerHTML = ui.item.canal2; // display the selected text
            $('#codcli').show();
            $('#vendedor').show();
            $('#herarquia').show();
            return false;
        }
    })


      .autocomplete( "instance" )._renderItem = function( ul, item ) {
        return $( "<li>" )
            .append( "<div>" +"<strong> Razão: "+ item.label + "</strong> <p>Cnpj:" + item.cnpj + " - <strong style='color:chartreuse !important;'>"+item.cidade + " </strong></p>  </div>" )
            .appendTo( ul );
    };

    /======================================================================/







});

function split( val ) {
    return val.split( /,\s*/ );
}
function extractLast( term ) {
    return split( term ).pop();
}

