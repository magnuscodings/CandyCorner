<?php 
include("../conn/class.php");
$db=new db_class();
include("include/navbar.php");
include("include/sidebar.php");

?>

    <!-- Main -->
    <main class="main-container" style="z-index:2">
        <div class="fluid-container">
            <h1 >Inventory</h1>
            <div class="table-responsive card">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th >Name</th>
                            <th  class="w-25">Description</th>
                            <th class="text-center">Barcode</th>
                            <th >Category</th>
                            <th >Price</th>
                            <th >Status</th>
                            <th id="example2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $result= $db->selectStocks();
                            $i=1;
                            while($row=$result->fetch_array()){
                               $action='';

                                if($row['stock_status']==0){
                                    $action ='<button class="btn togler btn-primary"
                                    data-bs-toggle="modal" data-bs-target="#modal"
                                    data-id="'.$row['stock_id'].'"
                                    data-status="'.$row['stock_status'].'"
                                    >Change Status</button>';
                                    $status='Stock on hand';
                                }else if($row['stock_status']==1){
                                    $action ='<button class="btn togler btn-danger"
                                    data-bs-toggle="modal" data-bs-target="#modal"
                                    data-id="'.$row['stock_id'].'"
                                    data-status="'.$row['stock_status'].'"
                                    >Change Status</button>';
                                    $status='For delivery';
                                }else if($row['stock_status']==2){
                                    $status='Delivered';
                                }else if($row['stock_status']==3){
                                    $status='Pull out';
                                }
                                echo 
                                '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.ucfirst($row['prod_name']).'</td>
                                    <td>'.ucfirst($row['prod_description']).'</td>
                                    <td class="text-center"><img src="../assets/img/barcode/'.$row['stock_barcode'].'"></td>
                                    <td>'.ucfirst($row['category_name']).'</td>
                                    <td>P'.number_format($row['prod_price'],2).'</td>
                                    <td>'.$status.'</td>
                                    <td>'.$action.'</td>
                                    
                                </tr>';
                                $i++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>


<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalLabel">Action Status</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p class="small" id="textForm">Fill out Required fields.</p>
        <form action="controller/inventory.php" method="POST">
            <div class="row" id="rowForm">
                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <label>Inventory Status:</label>
                        <input type="text" id="id" hidden name="id" >
                        <select name="status" id="status" required class="form-control">
                            <option value="">Select Status</option>
                            <option value="0">Available</option>
                            <option value="1">Not Available</option>
                            <option value="2">Delivered</option>
                            <option value="3">Pull out</option>
                        </select>
                    </div>
                </div>
            </div>
            <input type="text" hidden id="submit">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="change" class="btn btn-primary">Confirm</button>
      </div>
      </form>

    </div>
  </div>
</div>
        
<script>
    $('#nav-inventory').addClass('active')
    $('.togler').click(function(){
    var status = $(this).attr('data-status')
    var id = $(this).attr('data-id')
    $('#id').val(id)
    $('#status').val(status)
}) 
</script>
<?php include("include/js.php");?>
<!-- <script>
    var table = $('#example').DataTable();
     var rowData = table.row(1).data(); 
     console.log(rowData)
</script> -->