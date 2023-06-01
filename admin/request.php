<?php 
include("../conn/class.php");
$db=new db_class();
include("include/navbar.php");
include("include/sidebar.php");
?>

    <!-- Main -->
    <main class="main-container" style="z-index:2">
        <div class="fluid-container">
            <h1 class="mb-3">Request</h1>
           
            <div class="table-responsive card">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                         <tr>
                            <th >#</th>
                            <th >Item</th>
                            <th >Quantity</th>
                            <th >Reason</th>
                            <th >Date</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                         <?php 
                            $result= $db->selectAllRequest();
                            $i=1;
                            while($row=$result->fetch_array()){
                                $status = $row['request_status'];
                                $user_id = $row['request_user_id'];
                                $req_id = $row['request_id'];
                                $qty = $row['request_qty'];
                                $button='N/A';
                                if($status==0){
                                    $action="<button class='btn btn-secondary'>Pending</button>";
                                    $button='<a class="btn btn-primary togler" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modal"
                                    data-id="'.$req_id.'"
                                    data-user_id="'.$user_id.'"
                                    data-user_id="'.$user_id.'"
                                     >Action</a>';
                                }else if($status==2){
                                    $action="<button class='btn btn-secondary'>Accepted / Scheduled set </button>";
                                }else if($status==1){
                                    $action="<button class='btn btn-danger'>Rejected</button>";
                                }else if($status==3){
                                    $button='<a class="btn btn-primary togler2" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#action"
                                    data-id="'.$req_id.'"
                                    data-user_id="'.$user_id.'"
                                    data-qty="'.$qty.'"
                                     >Action</a>';
                                    $action="<button class='btn btn-primary'>Picked up</button>";
                                }else if($status==4){
                                    $button='N/A';
                                    $action="<button class='btn btn-success'>Successfully</button>";
                                }
                                echo 
                                '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.ucfirst($row['prod_name']).'</td>
                                    <td>'.ucfirst($row['request_qty']).'</td>
                                    <td>'.ucwords($row['request_reason']).'</td>
                                    <td>'.ucwords($row['request_date']).'</td>
                                    <td class="text-center">'.$action.'</td>
                                    <td class="text-center">'.$button.'</td>
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
        <h1 class="modal-title fs-5" id="modalLabel">Request Action</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p class="small" id="textForm">Fill out Required fields.</p>
        <form action="controller/request.php" method="POST" >
            <div class="row" id="rowForm">
                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <label>Pick up date:</label>
                        <input type="text" id="id" name="id" hidden>
                        <input type="text" id="user_id" name="user_id" hidden>
                        <input type="date" name="date" class="form-control" value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"  min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
        <button type="submit" name="accept"  class="btn btn-success">Accept</button>
      </div>
      </form>

    </div>
  </div>
</div>
 <!-- Modal -->
<div class="modal fade" id="action" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalLabel">Request Action</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="controller/request.php" method="POST" >
            <div class="row">
                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <label>Did you received the item?</label>
                        <input type="text" id="actionid" hidden name="id" >
                        <input type="text" hidden name="user_id" id="actionuser_id">
                        <input type="text" hidden name="qty" id="qty">
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="actionaccept"  class="btn btn-success">Confirm</button>
      </div>
      </form>

    </div>
  </div>
</div>       
<script>
    $('#nav-request').addClass('active')
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
    $('#user_id').val($(this).attr('data-user_id'))
    }) 
    $('.togler2').click(function(){
    $('#actionid').val($(this).attr('data-id'))
    $('#actionuser_id').val($(this).attr('data-user_id'))
    $('#qty').val($(this).attr('data-qty'))

    }) 
</script>