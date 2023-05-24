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
            <h1 >Cart</h1>
            <div class="table-responsive card">
                <form id="cartForm">
                <input hidden class="post" id="post" name="deleteCart" >
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th >Name</th>
                            <th class="w-25">Qty</th>
                            <th >Price</th>
                            <th >Subtotal</th>
                            <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $result= $db->cartUser($_SESSION['user_id']);
                            $i=1;
                            $total=0;
                            

                            while($row=$result->fetch_array()){

                                echo 
                                '
                                <input class="qty'.$row['prod_id'].'" hidden value="'.$row['prod_price'].'" >
                                <input hidden name="id" value="'.$row['cart_id'].'" >
                                <input hidden name="product[]" value="'.$row['prod_id'].'"  >

                                <tr>
                                    <td>'.$i.'</td>
                                    <td>'.ucfirst($row['prod_name']).'</td>
                                    <td><input type="number" min="1" required class="form-control qty" name="quantity[]" id="'.$row['prod_id'].'" value="1"></td>
                                   
                                    <td>P'.number_format($row['prod_price'],2).'</td>
                                    <td class="subs" id="sub'.$row['prod_id'].'">P'.number_format($row['prod_price'],2).'</td>
                                    <td ><button class="btn btn-danger remove" >Remove</button></td>
                                </tr>';
                                $i++;
                                $total+=$row['prod_price'];
                            }
                        ?>
                    </tbody>
                </table>
              
                <div class="row justify-content-center">
                    <div class="col-sm-4">
                        <?php 
                        if($total!=0){ ?>
                        <p class=" text-center h3">Total: P<span id="total"><?=number_format($total,2)?></span></p>
                        <button class="btn checkout btn-success form-control">Checkout</button>
                        <?php }
                        ?>
                        
                    </div>
                </div>
                </form>
            </div>
          
        </div>
    </main>

<script>
    $('#nav-cart').addClass('active')
</script>
<?php include("include/js.php");?>
<script src="controller/functions.js"></script>
<script>

Cart('#cartForm')
$('.qty').on('input change', function() {
        var value =parseFloat($(this).val())
        var qty = !isNaN(value) ? value : 0;

        var qtyID=$(this).attr('id')
        var price =parseFloat($('.qty'+qtyID).val())
        var ProductPricetotal=price*qty
        // console.log(ProductPricetotal)
        $('#sub'+qtyID).text('P'+ProductPricetotal.toFixed(2))
        var total =0
        $('.subs').each(function(){
            var subtotal =$(this).text().replace(/[A-Za-z]/g, "")
            
            total+=parseFloat(subtotal);
        })
        $('#total').text(total.toFixed(2))
    });
      
</script>