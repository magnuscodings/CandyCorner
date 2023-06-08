<?php 
include("../conn/class.php");
$db=new db_class();
include("include/navbar.php");
include("include/sidebar.php");

?>

    <!-- Main -->
    <main class="main-container" style="z-index:2">
        <div class="fluid-container">
            <h1 >Stock-in History</h1>
            <div class="table-responsive card">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th >Reference Number</th>
                            <th >Pcode</th>
                            <th >Quantity</th>
                            <th >Date</th>
                            <th >Merchant/Branch</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $result= $db->reportStockInHistory();
                            $i=1;
                            while($row=$result->fetch_array()){
                            
                                echo 
                                '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.ucwords($row['order_united_id']).'</td>
                                    <td>'.lcfirst($row['grp_order_prod']).'</td>
                                    <td>'.lcfirst($row['grp_order_qty']).'</td>
                                    <td>'.$row['order_date'].'</td>
                                    <td>'.ucwords($row['u_name']).'</td>

                                </tr>';
                                $i++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>


<script>
    $('#nav-reports').addClass('active')
    $('#nav-history').addClass('active')

</script>
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

<script>
  $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                    extend: 'print',
                    exportOptions: {
                        stripHtml : false,
                        columns: [0, 1, 2,3,4,5] 
                        //specify which column you want to print
 
                    }
                },

        ]
    } );
} );
</script>