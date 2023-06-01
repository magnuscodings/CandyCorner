<?php 
session_start();
include("../conn/class.php");
$db=new db_class();
include("include/navbar.php");
include("include/sidebar.php");
?>
    <!-- Main -->
    <main class="main-container" style="z-index:2">
        <div class="fluid-container">
            <h1 >Request</h1>
            <div class="row">
                <div class="col-auto ms-auto m-3">
                    <button class="btn btn-success addTogler" data-bs-toggle="modal" data-bs-target="#request">Add Request</button>
                </div>
            </div>
            <div class="table-responsive card">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th >Item</th>
                            <th >Quantity</th>
                            <th >Reason</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $result= $db->selectRequest($_SESSION['user_id']);
                            $i=1;
                            while($row=$result->fetch_array()){
                                $status = $row['request_status'];
                                $id = $row['request_id'];

                                if($status==0){
                                    $action="<button class='btn btn-secondary'>Pending</button>";
                                }else if($status==2){
                                    $action="<button class='btn btn-secondary'>Preparing items</button>";
                                }else if($status==1){
                                    $action="<button class='btn btn-danger'>Rejected</button>";
                                }else if($status==3){
                                    $action="<button class='btn btn-primary'>Ready for delivery</button>";
                                }else if($status==4){
                                    $action="<a href='controller/action.php?id=".$id."' class='btn btn-primary'>On the way / Order received</a>";
                                }else if($status==5){
                                    $action="<a class='btn btn-success'>Received</a>";
                                }
                                echo 
                                '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.ucfirst($row['prod_name']).'</td>
                                    <td>'.ucfirst($row['request_qty']).'</td>
                                    <td>'.ucwords($row['request_reason']).'</td>
                                    
                                    <td class="text-center">'.$action.'</td>
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
<div class="modal fade" id="request" tabindex="-1" aria-labelledby="orderLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Pullout Request</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p class="small" >Fill out Required fields.</p>
        <form id="reqForm">
            <input type="text" name="addrequest" hidden>
            <div class="row">
                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <label>Pullout Product:</label>
                        <select name="prod_id" class="form-control" required>
                            <option value="">Select Product</option>
                            <?php
                            $result= $db->selectOrderUserGrouped($_SESSION['user_id']);
                            while($row=$result->fetch_array()){
                                echo '<option value="'.$row['prod_id'].'">'.ucwords($row['prod_name']).'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <label>Pullout Quantity:</label>
                        <input type="number" placeholder="Quantity" min="1" id="quantity" name="quantity" class="form-control" Required>
                    </div>
                </div>
                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <label>Pull out reason:</label>
                        <textarea name="reason" cols="20" class="form-control" Required rows="5"></textarea>
                     </div>
                </div>
            </div>

      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Confirm</button>
      </div>
      </form>

    </div>
  </div>
</div>

<script>
    $('#nav-request').addClass('active')
</script>
<?php include("include/js.php");?>
<script src="controller/functions.js"></script>
<script>
AddingDetails('#reqForm')
</script>