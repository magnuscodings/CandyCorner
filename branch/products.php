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
            <h1 >Products</h1>
            <div class="table-responsive card">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th >Pcode</th>
                            <th class="w-25">Description</th>
                            <th >Category</th>
                            <th >Price</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $result= $db->selectProducts();
                            $i=1;
                            while($row=$result->fetch_array()){

                                echo 
                                '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.ucfirst($row['prod_name']).'</td>
                                    <td>'.ucfirst($row['prod_description']).'</td>
                                    <td>'.ucfirst($row['category_name']).'</td>
                                    <td>P'.number_format($row['prod_price'],2).'</td>
                                    
                                    <td class="text-center">
                                        <button class="btn orderTogler btn-success"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#order"
                                        data-id="'.$row['prod_id'].'"
                                        data-price="'.$row['prod_price'].'"
                                        data-name="'.ucfirst($row['prod_name']).'"
                                        >Add to Cart</button>
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
<div class="modal fade" id="order" tabindex="-1" aria-labelledby="orderLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Add Cart</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p class="small" >Fill out Required fields.</p>
        <form id="orderForm">
            <div class="row" >
                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <label>Order Quantity</label>
                        <input type="number" max="30" placeholder="Quantity" min="1" id="quantity" name="quantity" class="form-control" Required>
                        <input type="text" hidden id="id" name="id">
                        <input type="text" hidden name="addCart">
                    </div>
                </div>
                <div class="col-sm-12 mb-2">
                    <div class="form-group text-center form-group-default">
                        <p class="h2">Product: <span id="productName"></span></p>
                        <p class="h4">Price: <span id="productPrice"></span></p>
                        <p class="h3">Total: <span id="productTotal">P0.00</span></p>
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
    $('#nav-products').addClass('active')
</script>
<?php include("include/js.php");?>
<script src="controller/functions.js"></script>
<script>
AddingDetails('#orderForm')

$('.orderTogler').click(function(){
    $('#id').val($(this).attr('data-id'))
    $('#productName').text($(this).attr('data-name'))
    $('#productPrice').text('P'+$(this).attr('data-price')+'.00')

    var price = ($(this).attr('data-price'));

    $('#quantity').on('input change', function() {
        // var value = (!isNaN($(this).val())) ? parseInt(parseInt($(this).val())) :'0' ;
        // console.log(value)
        var value =parseFloat($(this).val())
        var result = !isNaN(value) ? value : 0;

        var total = price*result;
        $('#productTotal').text('P'+total.toFixed(2))

      });
      
}) 
</script>