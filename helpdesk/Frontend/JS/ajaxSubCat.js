$("#ccatg") .on("change", function() {
    var codi_categoria = $("#ccatg").val();

    $.ajax({
        url: 'carregarSubCat.php',
        dataType: "HTML",
        type: 'POST',
        data: {categoria: codi_categoria},
        success: function(data) {
            $("#cscatg") .html(data);
        }
    });
});