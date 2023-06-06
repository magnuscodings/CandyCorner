<?php 
include("../conn/class.php");
$db=new db_class();
include("include/navbar.php");
include("include/sidebar.php");
?>

    <!-- Main -->
    <main class="main-container" style="z-index:2">
        <div class="fluid-container">
            <h1 >Category</h1>
            <div class="row">
                <div class="col-auto ms-auto m-3">
                    <button class="btn btn-success addTogler" data-bs-toggle="modal" data-bs-target="#modal">Add Category</button>
                </div>
            </div>
            <div class="table-responsive card">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th class="w-25 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                       <?php 
                        $result= $db->selectCategory();
                        $i=1;
                        while($row=$result->fetch_array()){

                            echo 
                            '<tr>
                                <td>'.$i.'</td>
                                <td>'.ucfirst($row['category_name']).'</td>
                                <td class="text-center"><button class="btn editTogler btn-success"
                                data-bs-toggle="modal" data-bs-target="#modal"
                                data-id="'.$row['category_id'].'"
                                data-name="'.$row['category_name'].'"
                                >Edit</button>
                                <button class="btn deleteTogler btn-danger"
                                data-bs-toggle="modal" data-bs-target="#modal"
                                data-id="'.$row['category_id'].'"
                                >Delete</button>
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
    $('#nav-category').addClass('active')
</script>

<?php include("include/js.php");?>
<script src="controller/functions.js"></script>
<script>
AddingDetails('#categoryForm')
$('.addTogler').click(function(){
    $('#modalLabel').text('Add Category')
    $('#submit').attr('name','addCategory')
    $('#categoryForm :input').val('')  
    $('#name').attr('required',true)
})
$('.editTogler').click(function(){
    $('#modalLabel').text('Edit Category')
    var name = $(this).attr('data-name')
    var id = $(this).attr('data-id')
    $('#id').val(id)
    $('#name').val(name)
    $('#submit').attr('name','editCategory')
    $('#name').attr('required',true)
}) 
$('.deleteTogler').click(function(){
    $('#modalLabel').text('Delete Category')
    var id = $(this).attr('data-id')
    $('#id').val(id)
    $('#submit').attr('name','deleteCategory')
    $('#name').attr('required',false)
    $('#rowForm').hide()
    $('#textForm').text('Are you sure you want to delete?')
}) 
</script>
