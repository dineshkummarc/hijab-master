var table;
$(document).ready(function(){
	table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "http://localhost/hijab-master/admin_order/order_list_ajax",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [-1], //last column
            "orderable": false, //set not orderable
        },
        { "sClass": "text-center", "aTargets": [-1, -2, -3] },
        { "sClass": "text-right", "aTargets": [-4] }
        ],

    });
})