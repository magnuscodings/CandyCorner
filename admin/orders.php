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
                            <th>Pcode</th>
                            <th>Quantity</th>
                            <th>Prices</th>
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
                                $decline = '<button class="btn togler btn-danger"
                                data-bs-toggle="modal" data-bs-target="#modal"
                                data-id="'.$id.'"
                                data-user_id="'.$user_id.'"
                                >Decline</button>';
                                $action = $accept.$decline;
                            }else if($status==4){
                                $action="<button class='btn btn-secondary'>On Delivery</button>";
                            }else if($status==3){
                                $action="<a href='controller/action.php?id=".$id."&status=4&user=".$user_id."' class='btn btn-primary'>Go for delivery</a>";
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
        <h1 class="modal-title fs-5" id="modalLabel">Action Status</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="medium" id="textForm">Do you wish to cancel your order?</p>
        <form action="controller/order.php" method="POST">
        <input type="text" id="id" hidden name="id" >
        <input type="text" id="user_id" hidden name="user_id" >
        <textarea name="reason" cols="30" class="form-control" placeholder="Reason for canceling order:" required rows="5"></textarea>
      </div>
      <div class="modal-footer">
        <button type="submit" name="cancelorder" class="btn btn-danger">Cancel Order</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
       </form>

    </div>
  </div>
</div>


        
<script>
    $('#nav-order').addClass('active')
</script>

<?php include("include/js.php");?>
<script src="controller/functions.js"></script>
<script>
  $('.togler').click(function(){
    var id = $(this).attr('data-id')
    var user_id = $(this).attr('data-user_id')
    $('#id').val(id)
    $('#user_id').val(user_id)
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