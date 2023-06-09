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
            <h1 >Orders</h1>
            <div class="table-responsive card">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th >Item Order</th>
                            <th >Date</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $result= $db->selectOrderUser($_SESSION['user_id']);
                            $i=1;
                            while($row=$result->fetch_array()){
                                $status = $row['order_status'];
                                $id = $row['order_united_id'];
                                $reference ='<button class="btn toglerRef btn-secondary"
                                data-bs-toggle="modal" data-bs-target="#reference"
                                data-id="'.$id.'" 
                                data-grp_prodname="'.$row['grp_prodname'].'"
                                data-grp_quantity="'.$row['grp_quantity'].'"
                                data-grp_price="'.$row['grp_price'].'"
                                data-grp_description="'.$row['grp_description'].'"
                                >'.$row['order_united_id'].'</button>';
                                if($status==0){
                                    $action ='<button class="btn togler btn-secondary"
                                    data-bs-toggle="modal" data-bs-target="#modal"
                                    data-id="'.$id.'"
                                    >Pending</button>';
                                }else if($status==2){
                                    $action="<button class='btn btn-secondary'>Preparing items</button>";
                                }else if($status==1){
                                    $action="<button class='btn btn-danger'>Cancelled</button>";
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
                                    <td>'.$reference.'</td>
                                    <td>'.$row['order_date'].'</td>
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
    <!-- <td>'.ucfirst($row['grp_prodname']).'</td> -->
   
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



 <!-- Modal -->
<div class="modal fade" id="reference" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalLabel">Order Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="table-responsive">
            <table class="table">
            <thead>
              <tr>
                <th>Pcode</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
              </tr>
            </thead>
           <tbody id="orders">

           </tbody>
            
            </table>
          </div>


        <!-- <textarea name="reason" cols="30" class="form-control" placeholder="Reason for canceling order:" required rows="5"></textarea> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script>
    $('#nav-orders').addClass('active')
</script>
<?php include("include/js.php");?>
<script src="controller/functions.js"></script>
<script>
AddingDetails('#orderForm')
$('.togler').click(function(){
    var id = $(this).attr('data-id')
    $('#id').val(id)
}) 
$('.toglerRef').click(function(){
  $('#orders').empty()
    var prodname = $(this).attr('data-grp_prodname')
    var quantity = $(this).attr('data-grp_quantity')
    var price = $(this).attr('data-grp_price')
    var description = $(this).attr('data-grp_description')
    
    var prodnames = prodname.split(',');
    var quantitys = quantity.split(',');
    var prices = price.split(',');
    var descriptions = description.split(',');
  
    

    prodnames.forEach((element,index) => {
      console.log(element)
      $('#orders').append('<tr><td>'+prodnames[index]+'</td> <td>'+descriptions[index]+'</td> <td>'+quantitys[index]+'</td> <td>'+prices[index]+'</td></tr>');
    });
}) 


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