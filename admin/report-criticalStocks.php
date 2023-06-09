<?php 
include("../conn/class.php");
$db=new db_class();
include("include/navbar.php");
include("include/sidebar.php");

?>

    <!-- Main -->
    <main class="main-container" style="z-index:2">
        <div class="fluid-container">
            
            <h1 >Critical Stocks </h1>
            <p class="small text-secondary">Note: Products here at the critical stocks are not more than 20</p>

            <div class="table-responsive card">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th >Pcode</th>
                            <th >Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $result= $db->selectProducts();

                            $i=1;
                            while($row=$result->fetch_array()){
                                $qty =(isset( $db->selectProductQty($row['prod_id'])->fetch_array()['count']) && $db->selectProductQty($row['prod_id'])->fetch_array()['count']<20  )   ?  $db->selectProductQty($row['prod_id'])->fetch_array()['count'] : '0';
                                echo 
                                '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.ucwords($row['prod_name']).'</td>
                                    <td>'.$qty.'</td>
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
    $('#nav-critical').addClass('active')

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
                        columns: [0, 1, 2] 
                        //specify which column you want to print
 
                    }
                },

        ]
    } );
} );
</script>