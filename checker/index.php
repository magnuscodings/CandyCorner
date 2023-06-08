<?php 
include("../conn/class.php");
$db=new db_class();
include("include/navbar.php");
include("include/sidebar.php");
?>

    <!-- Main -->
    <main class="main-container" style="z-index:2">
        <div class="fluid-container">
            <h1 class="mb-3">Orders</h1>
           
            <div class="table-responsive card">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Branch</th>
                            <th>Pcode</th>
                            <th>Quantity</th>
                            <th>Products</th>
                            <th>Date / Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                       <?php 
                        $result= $db->CheckerSelectOrders();
                        $i=1;
                        while($row=$result->fetch_array()){
                            $status = $row['order_status'];
                            $id = $row['order_united_id'];
                            $user_id = $row['order_user_id'];
                            $qty = $row['grp_quantity'];
                            $prod_id = $row['grp_prodid'];
                            $action="";

                            if($status==2){
                                $change = status($id,$user_id,3,'Order Ready',$prod_id,$qty);
                                $action = $change;
                            }
                            $status = statusReport($row['order_status']);
                            
                            echo 
                            '<tr>
                                <td>'.$i.'</td>
                                <td>'.$id.'</td>
                                <td>'.ucfirst($row['u_name']).'</td>
                                <td>'.ucfirst($row['grp_prodname']).'</td>
                                <td>'.ucfirst($row['grp_quantity']).'</td>
                                <td>'.ucfirst($row['grp_prices']).'</td>
                                <td>'.ucfirst($row['order_date']).'</td>
                                <td>'.$status.'</td>
                                <td>
                                    '.$action.'
                                </td>
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
        <h1 class="modal-title fs-5" id="modalLabel">Order Ready</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p class="small" id="textForm">Fill out Required fields.</p>
        <form action="#" id="readyForm" >
            <div class="row" id="rowForm">
                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <label class="pb-2">Select Products Ready :</label>
                        
                        <?php 
                         $result= $db->CheckerStocks();
                         $i=1;
                         while($row=$result->fetch_array()){
                            echo '
                            <div class="row">
                                    <div class="col-1">
                                        <input type="checkbox" value="'.$row['stock_id'].'" data-id="check'.$row['stock_prod_id'].'" name="id[]" class="checkbox m-2 ">
                                    </div>
                                    <div class="col-10">
                                        <p>'.ucwords($row['prod_name']).'
                                        <img width="300" src="../assets/img/barcode/'.$row['stock_barcode'].'">
                                        </p>
                                    </div>
                                </div>
                            ';
                         }
                        ?>
                    </div>
                </div>
            </div>
            <input type="text" hidden id="submit">
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
    $('#nav-order').addClass('active')
</script>

<?php 
include("include/js.php");
?>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="controller/functions.js"></script>
<?php 
function status($id,$user_id,$status,$text,$prod_id,$qty){
    if($status==3){
        return '<a class="btn btn-success" href="controller/action.php?id='.$id.'&status='.$status.'&user='.$user_id.'" >'.ucfirst($text).'</a> ';
    }
}
?>