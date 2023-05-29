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
                            <th class="w-25">Description</th>
                            <th class="text-center">Barcode</th>
                            <th >Category</th>
                            <th >Price</th>
                            <th >Status</th>
                            <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $result= $db->selectStocks();
                            $i=1;
                            while($row=$result->fetch_array()){
                                $change='N/A';
                               
                                if($row['stock_status']==0){
                                    $status='Available';
                                    $change = status('Change',$row['stock_id']);

                                }else if($row['stock_status']==1){
                                    $status='N/A';
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
                                    <td>'.$change.'</td>
                                    
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
        <h1 class="modal-title fs-5" id="modalLabel">Action</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p class="small" id="textForm">Change status</p>
        <form action="#" id="checkerForm" >
            <div class="row" id="rowForm">
            <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <input type="text" hidden name="id"  id="id" >
                        
                        <select name="order_id" required class="form-control">
                            <option value="">Select Order</option>
                        <?php 
                            $result = $db->CheckerSelectOrders();
                            while($row = $result -> fetch_array()){
                                $id = $row['order_united_id'];
                                $grp_order= $row['grp_order'];
                                $u_name= $row['u_name'];
                                echo '<option value="'.$id.'">'.ucwords($u_name.$grp_order ).'</option>';
                            }
                            ?>
                            
                            
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <select name="status" required class="form-control">
                            <option value="">Status</option>
                            <option value="1">Unavailable</option>
                            <option value="2">Pullout</option>
                        </select>
                    </div>
                </div>
            </div>
            <input type="text" hidden name="checker">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit"  class="btn btn-primary">Confirm</button>
      </div>
      </form>

    </div>
  </div>
</div>
        

<script>
    $('#nav-inventory').addClass('active')
</script>
<?php include("include/js.php");?>
<script src="controller/functions.js"></script>
<?php 
function status($text,$prod_id){
        return '<button class="btn togler btn-success" 
        data-bs-toggle="modal" 
        data-bs-target="#modal"
        data-id="'.$prod_id.'"
        >'.ucfirst($text).'</button> ';
}
?>
<script>
    AddingDetails('#checkerForm')
    $('.togler').click(function(){
    var id = $(this).attr('data-id')
    $('#id').val(id)
}) 
</script>