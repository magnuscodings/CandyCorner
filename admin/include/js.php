  <script src="assets/js/script.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
<!-- <script>
  $(document).ready(function() {
   var table= $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    } );
} );


</script> -->
<script>
  $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                    extend: 'print',
                    exportOptions: {
                        stripHtml : false,
                        columns: [0, 1, 2, 3, 4, 5,6] 
                        //specify which column you want to print
 
                    }
                },
            // {
            //     extend: 'copyHtml5',
            //     exportOptions: {
            //         columns: [ 0, ':visible' ]
            //     }
            // },
            // {
            //     extend: 'excelHtml5',
            //     exportOptions: {
            //         columns: ':visible'
            //     }
            // },

            // {
            //     extend: 'pdfHtml5',
            //     exportOptions: {
            //       stripHtml : false,
            //         columns: [ 0, 1, 2,4, 5,6 ]
            //     }
            // },
            // 'colvis'
        ]
    } );
} );
</script>