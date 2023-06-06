<?php 
include("../conn/class.php");
$db=new db_class();
include("include/navbar.php");
include("include/sidebar.php");

?>

    <!-- Main -->
    <main class="main-container" style="z-index:2">
        <div class="fluid-container">
            <h1 >Canceled Orders</h1>
            <div class="table-responsive card">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th >Transaction Number</th>
                            <th >Orders</th>
                            <th >Quantity</th>
                            <th >Total</th>
                            <th >Date</th>
                            <th >Canceled by</th>
                            <th >Reason</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $result= $db->reportCancelledOrders();
                            $i=1;
                            while($row=$result->fetch_array()){
                                $type = $row['order_cancel_record_type'];
                                if($type == 0){
                                    $cancel = "user";
                                }else if($type==2){
                                    $cancel = "admin";
                                }
                                echo 
                                '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.ucwords($row['order_united_id']).'</td>
                                    <td>'.lcfirst($row['grp_order_prod']).'</td>
                                    <td>'.lcfirst($row['grp_order_qty']).'</td>
                                    <td>'.lcfirst($row['totalQty']).'</td>
                                    <td>'.$row['order_date'].'</td>
                                    <td>'.ucwords($cancel).'</td>
                                    <td>'.ucfirst($row['order_cancel_record_reason']).'</td>
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
    $('#nav-cancelled').addClass('active')

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
                        columns: [0, 1, 2,3,4,5,6,7] 
                        //specify which column you want to print
 
                    }
                },

        ]
    } );
} );
</script>