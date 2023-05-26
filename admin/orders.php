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
                            <th>Branch Name</th>
                            <th>Products</th>
                            <th>Quantity</th>
                            <th>Products</th>
                            <th>Date Order</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                       <?php 
                        $result= $db->selectOrders();
                        $i=1;
                        while($row=$result->fetch_array()){
                            $status = $row['order_status'];
                            $id = $row['order_united_id'];
                            $user_id = $row['order_user_id'];
                            $action="";

                            if($status==0){
                                $accept = status($id,$user_id,2,'Accept');
                                $decline = status($id,$user_id,1,'Decline');
                                $action = $accept.$decline;
                            }else if($status==2){
                                $action="<button class='btn btn-secondary'>Pending in checker</button>";
                            }else if($status==1){
                                $action="<button class='btn btn-danger'>Not Available</button>";
                            }
                            $status = statusReport($row['order_status']);
                            
                            echo 
                            '<tr>
                                <td>'.$i.'</td>
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
        <h1 class="modal-title fs-5" id="modalLabel">Add Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p class="small" id="textForm">Fill out Required fields.</p>
        <form action="#" id="categoryForm" >
            <div class="row" id="rowForm">
                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <label>Category Name:</label>
                        <input type="text" id="id" name="id" hidden>
                        <input type="text" placeholder="Category Name" id="name" name="name" required class="form-control">
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
<script>
    $('.togler').click(function(){
    $('#id').val($(this).attr('data-id'))

}) 
</script>
<?php 
function status($id,$user_id,$status,$text){
    if($status==2){
        return '<a class="btn btn-success" href="controller/action.php?id='.$id.'&status='.$status.'&user='.$user_id.'" >'.ucfirst($text).'</a> ';
    }else if($status==1){
        return '<a class="btn btn-danger" href="controller/action.php?id='.$id.'&status='.$status.'&user='.$user_id.'" >'.ucfirst($text).'</a> ';
    }
}
?>