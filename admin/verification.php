<?php 
include("../conn/class.php");
$db=new db_class();
include("include/navbar.php");
include("include/sidebar.php");

?>

    <!-- Main -->
    <main class="main-container" style="z-index:2">
        <div class="fluid-container">
            <h1 >Verification</h1>
            <div class="table-responsive card">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th >Name</th>
                            <th >Email</th>
                            <th >Status</th>
                            <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $result= $db->selectUsers(0);
                            $i=1;
                            while($row=$result->fetch_array()){
                               $action='';

                                if($row['u_status']==0){
                                    $action ='<button class="btn togler btn-primary"
                                    data-bs-toggle="modal" data-bs-target="#modal"
                                    data-id="'.$row['u_id'].'"
                                    >Change Status</button>';
                                    $status='Not Verified';
                                }
                                echo 
                                '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.ucwords($row['u_name']).'</td>
                                    <td>'.lcfirst($row['u_email']).'</td>
                                    <td>'.ucwords($status).'</td>
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
        <p class="medium" id="textForm">Do you verify the branch account?</p>
        <form action="controller/verification.php" method="POST">
        <input type="text" id="id" hidden name="id" >
      </div>
      <div class="modal-footer">
        <button type="submit" name="change" class="btn btn-primary">Accept</button>
        <button type="submit" name="decline" class="btn btn-danger">Decline</button>
      </div>
       </form>

    </div>
  </div>
</div>
        
<script>
    $('#nav-verify').addClass('active')
    $('.togler').click(function(){
    var id = $(this).attr('data-id')
    $('#id').val(id)
}) 
</script>
<?php include("include/js.php");?>