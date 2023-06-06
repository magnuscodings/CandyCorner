<?php 
include("../conn/class.php");
$db=new db_class();
include("include/navbar.php");
include("include/sidebar.php");
 $productCount= $db->dashboardProducts()->fetch_array()['count'];
 $purchaseCount= $db->dashboardPurchase()->fetch_array()['count'];
 $salesCount= $db->dashboardSales()->fetch_array()['count'];
 $inventoryCount= $db->dashboardInventory()->fetch_array()['count'];
?>
<?php 
$topSelling= $db->reportTopStocks();
$topQty=[];
$topName=[];
while($row=$topSelling->fetch_array()){
    array_push($topQty,$row['totalqty']);
    array_push($topName,ucwords($row['prod_name']));
}
?>
<?php 
$purchaseOrders= $db->dashboardOrders();
$Orderlabel=[];
$OrderQty=[];
while($row=$purchaseOrders->fetch_array()){
    array_push($OrderQty,$row['qty']);
    array_push($Orderlabel,ucwords($row['month']));
}
$purchaseOrders= $db->dashboardOrderSales();
$SalesQty=[];
while($row=$purchaseOrders->fetch_array()){
    array_push($SalesQty,$row['sales']);
}
?>

        <!-- Main -->
        <main class="main-container" style="z-index:2">
            <div class="main title">
                <p class="font-weight-bold">DASHBOARD</p>
            </div>
            
            <div class="main-cards">

                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">PRODUCTS</p>
                        <span class="material-icons-outlined text-blue">inventory_2</span>
                    </div>
                    <span class="text-primary font-weight-bold"><?=(isset($productCount) ? $productCount : '0')?></span>
                </div>

                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">PURCHASE ORDERS</p>
                        <span class="material-icons-outlined text-orange">add_shopping_cart</span>
                    </div>
                    <span class="text-primary font-weight-bold"><?=(isset($purchaseCount) ? $purchaseCount : '0')?></span>
                </div>

                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">SALES ORDERS</p>
                        <span class="material-icons-outlined text-green">shopping_cart</span>
                    </div>
                    <span class="text-primary font-weight-bold"><?=(isset($salesCount) ? $salesCount : '0')?></span>
                </div>

                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">INVENTORY ALERTS</p>
                        <span class="material-icons-outlined text-red">notification_important</span>
                    </div>
                    <span class="text-primary font-weight-bold"><?=(isset($inventoryCount) ? $inventoryCount : '0')?></span>
                </div>

            </div>
            <div class="charts">
                <div class="charts-card">
                    <p class="chart-title">Top 5 Products</p>
                    <div id="bar-chart"></div>
                </div>

                <div class="charts">
                    <div class="charts-card">
                        <p class="chart-title">Purchase and Sales Orders</p>
                        <div id="area-chart"></div>
                    </div>
            </div>
           
        </main>
</body>
</html>
<script>
    $('#nav-home').addClass('active')
</script>
<?php include("include/js.php");?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.39.0/apexcharts.min.js"></script>
<script src="assets/js/script.js"></script>
<script>
var topQty = <?php echo json_encode($topQty);?>;
var topName = <?php echo json_encode($topName);?>;

var barChartOptions = {
    series: [{
    data: topQty
  }],
    chart: {
    type: 'bar',
    height: 350,
    toolbar: {
        show: false
    },
  },
  colors: [
    "solid #ffff",
    "#cc3c43",
    "#367952",
    "#f5b74f",
    "#4f35a1"
  ],
  plotOptions: {
    bar: {
        distributed: true,
        borderRadius: 4,
        horizontal: false,
        columnWidth: '40%',
    }
  },
  dataLabels: {
    enabled: false
  },
  legend: {
    show: false
  },
  xaxis: {
    categories: topName,
  },
  yaxis: {
    title: {
        text: "Count"
    }
  }
  };

  var barChart = new ApexCharts(document.querySelector("#bar-chart"), barChartOptions);
  barChart.render();

  // AREA CHART
  var Orderlabel = <?php echo json_encode($Orderlabel);?>;
  var OrderQty = <?php echo json_encode($OrderQty);?>;
  var SalesQty = <?php echo json_encode($SalesQty);?>;
  
  var areaChartOptions = {
    series: [{
    name: 'Purchase Orders',
    data: OrderQty
  }, {
    name: 'Sales Orders',
    data: SalesQty
  }],
    chart: {
    height: 350,
    type: 'area',
    toolbar: {
      show: false,
    },
  },
  colors: ["#4f35a1", "#246dec"],
  dataLabels: {
    enabled: false,
  },
  stroke: {
    curve: 'smooth'
  },
  labels: Orderlabel,
  markers: {
    size: 0
  },
  yaxis: [
    {
      title: {
        text: 'Purchase Orders',
      },
    },
    {
      opposite: true,
      title: {
        text: 'Sales Orders',
      },
    },
  ],
  tooltip: {
    shared: true,
    intersect: false,
  }
  };

  var areaChart = new ApexCharts(document.querySelector("#area-chart"), areaChartOptions);
  areaChart.render();
</script>