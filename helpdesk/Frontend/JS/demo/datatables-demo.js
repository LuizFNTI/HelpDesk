// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTableTipo').DataTable(
    {
      language: {
        url: 'js/demo/pt_br.json'
      }
    }
  );

  $('#dataTableCategoria').DataTable(
    {
      language: {
        url: 'js/demo/pt_br.json'
      }
    }
  );
  $('#dataTableSubCat').DataTable(
    {
      language: {
        url: 'js/demo/pt_br.json'
      }
    }
  );

  $('#dataTableItem').DataTable(
    {
      language: {
        url: 'js/demo/pt_br.json'
      }
    }
  );
});


