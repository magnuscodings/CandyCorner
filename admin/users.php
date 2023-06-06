<?php 
include("../conn/class.php");
$db=new db_class();
include("include/navbar.php");
include("include/sidebar.php");
?>

    <!-- Main -->
    <main class="main-container" style="z-index:2">
        <div class="fluid-container">
            <h1>Branch</h1>
            <div class="row">
                <div class="col-auto ms-auto m-3">
                    <button class="btn btn-success addTogler" data-bs-toggle="modal" data-bs-target="#modal">Add Branch</button>
                </div>
            </div>
            <div class="table-responsive card">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                       <?php 
                        $result= $db->selectAllUsers();
                        $i=1;
                        while($row=$result->fetch_array()){
                             $edit ='<button class="btn btn-primary ms-3 togler" data-bs-target="#modal" data-bs-toggle="modal"
                                    data-id="'.$row['u_id'].'" data-name="'.$row['u_name'].'" data-email="'.$row['u_email'].'" data-password="'.$row['u_password'].'" >Edit</button>';
                             $delete  ='<button class="btn btn-danger ms-3 deleteTogler" data-bs-target="#modalDelete" data-bs-toggle="modal" data-id="'.$row['u_id'].'">Delete</button>';
                             $action = $edit.$delete;
                             $status = $row['u_status'];
                             if($status==0){
                                $status='Pending';
                             }else if($status==1){
                                $status='Deactivated';
                             }else if($status==2){
                                $status='Activated';
                             }

                            echo 
                            '<tr>
                                <td>'.$i.'</td>
                                <td>'.ucfirst($row['u_name']).'</td>
                                <td>'.ucfirst($row['u_email']).'</td>
                                <td>'.ucfirst($status).'</td>
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
        <h1 class="modal-title fs-5" id="modalLabel">Branch Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p class="small" id="textForm">Fill out Required fields.</p>
        <form action="#" id="branchForm" >
            <input type="text" id="id" hidden name="id">
            <input type="text" hidden name="addBranch">
            <div class="row" id="rowForm">
                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <label>Branch Name:</label>
                        <input type="text" placeholder="Branch Name" id="name" name="name" required class="form-control">
                    </div>
                </div>
                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <label>Branch Email:</label>
                        <input type="email" placeholder="Branch Email" id="email" name="email" required class="form-control">
                    </div>
                </div>
                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <label>Password:</label>
                        <input type="password" placeholder="Branch Password" id="password" name="password" required class="form-control">
                    </div>
                </div>
            </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit"  class="btn btn-primary">Confirm</button>
      </div>
      </form>

    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalLabel">Branch Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p class="medium" id="textForm">Are you sure you want to delete?</p>
        <form action="#" id="branchDelete" >
            <input type="text" hidden id="deleteid"  name="id">
            <input type="text" hidden name="deleteBranch">
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
    $('#nav-users').addClass('active')
</script>
<script src="controller/functions.js"></script>
<script>
AddingDetails('#branchForm')
AddingDetails('#branchDelete')
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
    $('.addTogler').click(function(){
        $('input').val('')
    })
    $('.deleteTogler').click(function(){
        var id = $(this).attr('data-id')
        $('#deleteid').val(id)
    })
    $('.togler').click(function(){
        var id = $(this).attr('data-id')
        var name = $(this).attr('data-name')
        var email = $(this).attr('data-email')
        var password = $(this).attr('data-password')
        $('#id').val(id)
        $('#name').val(name)
        $('#email').val(email)
        $('#password').val(password)
    })
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
                        columns: [0, 1, 2, 3] 
                        //specify which column you want to print
 
                    }
                },

        ]
    } );
} );
</script>