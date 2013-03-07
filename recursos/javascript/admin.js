



$(function() {

    'use strict';

    // Initialize the jQuery File Upload widget:


    $(document).ajaxStart(function() {
        $.blockUI({message: '<h1><img src="recursos/imagens/ajax-loader.gif" /> Aguarde...</h1>'});
    });
    $(document).ajaxStop($.unblockUI);

    var tableOptions = {
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
    };

    $("#tabs").tabs();

    var tables = [];
    $("#tabs").find("table").each(function() {
        tables.push($(this).dataTable(tableOptions));
    });
    $(".command > a").button({
        icons: {
            secondary: "ui-icon-circle-plus"
        }
    }).click(function(event) {
        var $this = $(this);
        var outputHolder = $("<div id='uimodal-output'></div>");
        $("body").append(outputHolder);
        outputHolder.load($this.attr("href"), null, function() {
            $("input[type='submit'],input[type='reset']").hide();
            var form = $("form");
            alert($(form).serialize());
            var model = $(form).attr('action').split("/");
            model = model[0];
            $("input[type='submit'], input[type='reset']").button({
                icons: {
                    secondary: "ui-icon-circle-plus"
                }
            });
            outputHolder.dialog({
                height: 500,
                width: 'auto',
                position: ['center', 'center'],
//                "resize", "auto",
                modal: true,
                buttons: {
                    "Salvar": function() {
                        var row = [];
                        $.ajax({
                            type: "POST",
                            url: "app/salvar.php",
//                            context: $(this).parent().find(".ui-dialog"),
                            dataType: "json",
                            async: false,
                            data: {
                                dados: $(form).serialize(),
                                model: model
                            },
                            success: function(data) {
                                $.each(data, function(key, val) {
                                    if (val === null) {
                                        row.push("");
                                    } else {
                                        row.push(val);
                                    }
                                });
//                                alert($(button).parents().find(".tableAviso").text());
//                                alert(row);
                                var tabela = ".table";
                                model = model.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                                    return letter.toUpperCase();
                                });
//                                alert(tabela + model);
                                $(tabela + model).dataTable().fnAddData(row);
                            },
                            error: function(data) {
                                alert("data.toString()");
                            }
                        });
                        $(this).dialog("close");
                        $.jGrowl(model + " adicionado com sucesso!");
                    }},
                close: function() {
                    $(this).dialog("close");
                    $(this).remove();//have do destroy dynamic element
                }
            });
        });
        event.preventDefault();

    });
    $(document).on("click", ".link_remover", function(e) {
        var nRow = $(this).parents('tr')[0];
        var $this = $(this);
        var href = $this.attr("href");
        var url = href.split("/");
        var model = url[0];
        var outputHolder = $("<div id='.uimodal-output'>Tem certeza que deseja remover o(a) " + model + "? </div>");
        $("body").append(outputHolder);
        outputHolder.dialog({
            resizable: false,
            height: 180,
            width: 350,
            modal: true,
            async: false,
            buttons: {"Deletar": function() {
                    $.ajax({
                        type: "GET",
                        url: "app/remover.php",
                        data: {
                            model: model,
                            id: url[2]
                        },
                        success: function(data) {
                            var tabela = ".table";
                            model = model.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                                return letter.toUpperCase();
                            });
                            $(tabela + model).dataTable().fnDeleteRow(nRow);
                        }
                    });
                    $(this).dialog("close");
                    $.jGrowl(model + " removido com sucesso!");
                },
                Cancel: function() {
                    $(this).dialog("close");
                }
            }
        });
        e.preventDefault();
    });
});

