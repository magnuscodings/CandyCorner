<?php 
include("../conn/class.php");
$db=new db_class();
include("include/navbar.php");
include("include/sidebar.php");

?>

    <!-- Main -->
    <main class="main-container" style="z-index:2">
        <div class="fluid-container">
            <h1 >Inventory</h1>
            <div class="table-responsive card">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th >Name</th>
                            <th class="w-25">Description</th>
                            <th class="text-center">Barcode</th>
                            <th >Category</th>
                            <th >Price</th>
                            <th >Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $result= $db->selectStocks();
                            $i=1;
                            while($row=$result->fetch_array()){
                                if($row['stock_status']==0){
                                    $status='Available';
                                }else if($row['stock_status']==1){
                                    $status='Not Available';
                                }else if($row['stock_status']==2){
                                    $status='Delivered';
                                }else if($row['stock_status']==3){
                                    $status='Pull out';
                                }
                                echo 
                                '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.ucfirst($row['prod_name']).'</td>
                                    <td>'.ucfirst($row['prod_description']).'</td>
                                    <td class="text-center"><img src="../assets/img/barcode/'.$row['stock_barcode'].'"></td>
                                    <td>'.ucfirst($row['category_name']).'</td>
                                    <td>P'.number_format($row['prod_price'],2).'</td>
                                    <td>'.$status.'</td>
                                    
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
    $('#nav-inventory').addClass('active')
</script>
<?php include("include/js.php");?>