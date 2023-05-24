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
                            <th >Quantity</th>
                            <th >Price</th>
                            <th >Date</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $result= $db->selectOrderUser($_SESSION['user_id']);
                            $i=1;
                            while($row=$result->fetch_array()){

                                echo 
                                '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.ucfirst($row['grp_prodname']).'</td>
                                    <td>'.ucfirst($row['grp_quantity']).'</td>
                                    <td>'.$row['grp_price'].'</td>
                                    <td>'.$row['order_date'].'</td>
                                    
                                    <td class="text-center">
                                        <button class="btn orderTogler btn-success"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#order"
                                        data-id="'.$row['prod_id'].'"
                                        data-price="'.$row['prod_price'].'"
                                        data-name="'.ucfirst($row['prod_name']).'"
                                        >Pending</button>
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
 


<script>
    $('#nav-orders').addClass('active')
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