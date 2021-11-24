$("#cscatg") .on("change", function() {
    var codi_item = $("#cscatg").val();

    $.ajax({
        url: 'carregarItem.php',
        dataType: "HTML",
        type: 'POST',
        data: {item: codi_item},
        success: function(data) {
            $("#idtem") .html(data);
        }
    });
});