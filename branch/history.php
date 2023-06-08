<?php 
include("../conn/class.php");
$db=new db_class();
include("include/navbar.php");
include("include/sidebar.php");
session_start();
?>

    <!-- Main -->
    <main class="main-container" style="z-index:2">
        <div class="fluid-container">
            <h1 >History Orders</h1>
            <div class="table-responsive card">
            <form id="myForm" method="GET">
                <div class="row mb-2 mt-2">
                        <div class="col-auto">
                            <select name="month" id="monthSelect" class="form-control">
                                <option value="">Select Month</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <input type="date" name="date" id="dateSelect" class="form-control">
                        </div>
                </div>
                </form>
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th >Pcode</th>
                            <th >Description</th>
                            <th >Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $result= $db->reportStocksBranch($_SESSION['user_id']);
                            if(isset($_GET['month'])){
                                $result= $db->reportStocksMonthBranch($_GET['month'],$_SESSION['user_id']);
                            }else if(isset($_GET['date'])){
                                $result= $db->reportStocksDateBranch($_GET['date'],$_SESSION['user_id']);
                            }
                            $i=1;
                            while($row=$result->fetch_array()){
                              
                                echo 
                                '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.ucwords($row['prod_name']).'</td>
                                    <td>'.ucwords($row['prod_description']).'</td>
                                    <td>'.lcfirst($row['totalqty']).'</td>
                                    <td>P'.lcfirst($row['totalprice']).'</td>
                                    
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
    $('#monthSelect').change(function() {
        $('#dateSelect').val('').attr('disabled',true)
         $('#myForm').submit();
         
    });
    $('#dateSelect').change(function() {
        $('#monthSelect').val('').attr('disabled',true)
        $('#monthSelect').val('')
         $('#myForm').submit();
    });
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