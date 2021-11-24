$("#cdt") .on("change", function() {
    var codi_tipo = $("#cdt").val();

    $.ajax({
        url: 'carregarCategoria.php',
        dataType: "HTML",
        type: 'POST',
        data: {tipo: codi_tipo},
        success: function(data) {
            $("#ccatg") .html(data);
        }
    });
});