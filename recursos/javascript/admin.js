$(function() {
    $("#tabs").tabs({
        select: function(event, ui) {
        }
    });
    $(".tablesorter").dataTable({
        "bJQueryUI": true,
        "oLanguage": {
            "sProcessing": "Processando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "Não foram encontrados resultados",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando de 0 até 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "Primeiro",
                "sPrevious": "Anterior",
                "sNext": "Seguinte",
                "sLast": "Último"
            }
        }
    });
    $(".command > a").button({
        icons: {
            secondary: "ui-icon-circle-plus"
        }
    }).click(function(event) {
        var $this = $(this);
        var outputHolder = $("<div id='.uimodal-output'></div>");
        $("body").append(outputHolder);
        outputHolder.load($this.attr("href"), null, function() {
            $("input[type='submit'], input[type='reset']").button({
                icons: {
                    secondary: "ui-icon-circle-plus"
                }
            });
            outputHolder.dialog({
                height: 500,
                width: 600,
                modal: true
            });
        });
        event.preventDefault();
    });
    $(document).on("click",".link_remover",function(e){
        var $this = $(this);
        var href = $this.attr("href");
        var url = href.split("/");
        var outputHolder = $("<div id='.uimodal-output'>Tem certeza que deseja remover o(a) "+url[0]+"? </div>");
        $("body").append(outputHolder);
        outputHolder.dialog({
            
            resizable: false,
            height:180,
            width:350,
            modal: true,
            buttons: {
                "Deletar": function() {
                    $.ajax({
                        type: "GET",
                        url:"app/remover.php",
                        data: {
                            model:url[0], 
                            id:url[2]
                        },
                        success:function(data){
                            window.location.reload();
                        }
                    });
                    $( this ).dialog( "close" );

                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
        
        e.preventDefault();
    }); 
    $(document).on("click",".link_salvar",function(e){
        var form = $("form");
     $.ajax({
         type: "POST",
         url:"app/salvar.php",
         data:{
             dados: $(form).serialize(),
             model: $('model_name').val()
         },
         success:function(data){
             alert(data);
         }
     });
    
    
    
    e.preventDefault();
        })
    
});

