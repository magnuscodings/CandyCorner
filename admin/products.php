<?php 
include("../conn/class.php");
$db=new db_class();
include("include/navbar.php");
include("include/sidebar.php");
?>

    <!-- Main -->
    <main class="main-container" style="z-index:2">
        <div class="fluid-container">
            <h1 >Products</h1>
            <div class="row">
                <div class="col-auto ms-auto m-3">
                    <button class="btn btn-success addTogler" data-bs-toggle="modal" data-bs-target="#modal">Add Products</button>
                </div>
            </div>
            <div class="table-responsive card">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th >Pcode</th>
                            <th class="w-25">Description</th>
                            <th >Category</th>
                            <th >Price</th>
                            <th >QTY</th>
                            <th class="text-center">Add Stocks</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $result= $db->selectProducts();
                            $i=1;
                            while($row=$result->fetch_array()){
                                    $qty =(isset( $db->selectProductQty($row['prod_id'])->fetch_array()['count'])) ?  $db->selectProductQty($row['prod_id'])->fetch_array()['count'] : '0';
                                echo 
                                '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.ucfirst($row['prod_name']).'</td>
                                    <td>'.ucfirst($row['prod_description']).'</td>
                                    <td>'.ucfirst($row['category_name']).'</td>
                                    <td>P'.number_format($row['prod_price'],2).'</td>
                                    <td>'.$qty.'</td>
                                    
                                    <td class="text-center">
                                        <button class="btn stockTogler btn-primary"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#stocks"
                                        data-id="'.$row['prod_id'].'"
                                        data-name="'.$row['prod_name'].'"
                                        >Add stocks</button>
                                    </td>
                                    
                                    <td class="text-center">
                                        <button class="btn editTogler btn-success"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modal"
                                        data-id="'.$row['prod_id'].'"
                                        data-name="'.$row['prod_name'].'"
                                        data-category="'.$row['prod_category'].'"
                                        data-description="'.$row['prod_description'].'"
                                        data-price="'.$row['prod_price'].'"
                                        >Edit</button>

                                    <button class="btn deleteTogler btn-danger"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modal"
                                        data-id="'.$row['prod_id'].'"
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
        <h1 class="modal-title fs-5" id="modalLabel">Add Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p class="small" id="textForm">Fill out Required fields.</p>
        <form id="productForm">
            <div class="row" id="rowForm">
                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <label>Product Name:</label>
                        <input type="text" placeholder="Product Name" id="name" name="name" class="form-control" Required>
                    </div>
                </div>
                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <label>Product Category:</label>
                        <select name="category" id="category" class="form-control" Required>
                            <option value="">Select Category</option>
                            <?php 
                            $result= $db->selectCategory();
                            while($row=$result->fetch_array()){
                                echo '<option value="'.$row['category_id'].'">'.ucwords($row['category_name']).'</option>';
                            }
                       ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <label>Product Description:</label>
                        <textarea placeholder="Product Description" id="description" name="description" class="form-control" cols="30" rows="5"></textarea>
                    </div>
                </div>
                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <label>Product Price:</label>
                        <input type="number" min="0" id="price" placeholder="Product Price" name="price" class="form-control" Required>
                    </div>
                </div>
                <input type="text"  id="submit"   name="addProduct" hidden >
                <input type="text"name="id"  id="id" hidden >
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>

    </div>
  </div>
</div>   
<!-- Modal -->
<div class="modal fade" id="stocks" tabindex="-1" aria-labelledby="stocksLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Add Stocks</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p class="small" >Fill out Required fields.</p>
        <form id="stocksForm">
            <div class="row" >
                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <label>Stocks Quantity</label>
                        <input type="number" placeholder="Quantity" min="1" name="quantity" class="form-control" Required>
                        <input type="text" value="0" hidden id="stocks_id" name="stocks_id">
                        <input type="text" value="0" hidden id="stocks_name" name="stocks_name">
                        <input type="text" value="1" hidden name="addStocks">
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add stocks</button>
      </div>
      </form>

    </div>
  </div>
</div>


<script>
    $('#nav-products').addClass('active')
</script>
<?php include("include/js.php");?>
<script src="controller/functions.js"></script>
<script>
AddingDetails('#productForm')
AddingDetails('#stocksForm')
$('.addTogler').click(function(){
    $('#modalLabel').text('Add Category')
    $('#submit').attr('name','addProduct').val(1)
    $('#productForm :input').val('')  

})
$('.editTogler').click(function(){
    $('#modalLabel').text('Edit Category')

    $('#id').val($(this).attr('data-id'))
    $('#name').val($(this).attr('data-name'))
    $('#category').val($(this).attr('data-category'))
    $('#description').val($(this).attr('data-description'))
    $('#price').val($(this).attr('data-price'))

    $('#submit').attr('name','editProduct').val(1)

}) 
$('.deleteTogler').click(function(){
    $('#modalLabel').text('Delete Product')
    var id = $(this).attr('data-id')
    $('#id').val(id)
    $('#submit').attr('name','deleteProduct').val(1)
    $('#name').attr('required',false)
    $('#rowForm').hide()
    $('#textForm').text('Are you sure you want to delete?')
    $('#productForm :input').attr('required',false)
}) 
$('.stockTogler').click(function(){
    $('#stocks_id').val($(this).attr('data-id'))
    $('#stocks_name').val($(this).attr('data-name'))
})
</script>