$(document).ready(function(){
    var save_method; //for save method string
    var table;

    table = $('#table-datatable').DataTable({
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [[ 1, "asc" ]],

      // Load data for the table's content from an Ajax source
      "ajax": {
          "url": "admin_shipping_cost/shipping_cost_ajax",
          "type": "POST"
      },

      //Set column definition initialisation properties.
      "columnDefs": [
          { 
        "targets": [0,-1], //last column
        "orderable": false,
        "searchable": false //set not orderable
      },
        { "sClass": "text-center", "aTargets": [0,1,2,3,4,5,-1] }
      ]

    });

    function reload_table()
    {
      table.ajax.reload(null,false); //reload datatable ajax 
    }
})