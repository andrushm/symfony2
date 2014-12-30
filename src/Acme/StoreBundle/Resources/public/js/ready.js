$(document).ready(function() {
    $('#productTable').dataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "list"
    } );
} );