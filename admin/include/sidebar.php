 <!-- Sidebar -->
 <aside id="sidebar" style="z-index: 3;">
            <div class="sidebar-title">
                <div class="sidebar-brand">
                <span class="material-icons-outlined">inventory</span>ADMIN
            </div>
            <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
          </div>

          <ul class="sidebar-list">
          <a href="index.php" class="text-light text-decoration-none">
            <li class="sidebar-list-item" id="nav-home" >
                <span class="material-icons-outlined ">dashboard</span> Dashboard
            </li>
          </a>
          <a href="users.php" class="text-light text-decoration-none">
            <li class="sidebar-list-item" id="nav-users">
                <span class="material-icons-outlined">group</span> Users
            </li>
          </a>
          <a href="products.php" class="text-light text-decoration-none">
            <li class="sidebar-list-item" id="nav-products">
                <span class="material-icons-outlined">inventory_2</span> Products
            </li>
          </a>
          <a href="category.php" class="text-light text-decoration-none">
            <li class="sidebar-list-item" id="nav-category">
                <span class="material-icons-outlined">list</span> Category List
            </li>
          </a>
            <a href="inventory.php" class="text-light text-decoration-none">  
            <li class="sidebar-list-item" id="nav-inventory">
                <span class="material-icons-outlined">fact_check</span> Inventory
            </li>
            <a href="request.php" class="text-light text-decoration-none">
            <li class="sidebar-list-item" id="nav-request" >
                <span class="material-icons-outlined ">front_hand</span> Request
            </li>
          </a>
            </a>
                <a href="orders.php" class="text-light text-decoration-none">
                <li class="sidebar-list-item"  id="nav-order">
                <span class="material-icons-outlined">add_shopping_cart</span> Purchase Order
            </li>
            </a>
                <a href="sales.php" class="text-light text-decoration-none">
                <li class="sidebar-list-item"  id="nav-sales">
                <span class="material-icons-outlined">shopping_cart</span> Sales Orders
            </li>
            </a>
                <a class="text-light text-decoration-none" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                <li class="sidebar-list-item"  id="nav-reports">
                <span class="material-icons-outlined">poll</span> Reports 
                <span class="material-icons-outlined">keyboard_arrow_down</span>
            </li>
            <div class="collapse" id="collapseExample">
                <a href="report-topSelling.php" class="text-light text-decoration-none ">
                    <li class="sidebar-list-item"  id="nav-top">
                    <span class="material-icons-outlined ps-4">star</span> Top Selling
                </li>
                </a>
                <a href="report-soldItems.php" class="text-light text-decoration-none ">
                    <li class="sidebar-list-item"  id="nav-sold">
                    <span class="material-icons-outlined ps-4">sell</span> Sold Items
                </li>
                </a>
                <a href="report-criticalStocks.php" class="text-light text-decoration-none ">
                    <li class="sidebar-list-item"  id="nav-critical">
                    <span class="material-icons-outlined ps-4">warning</span> Critical Stocks
                </li>
                </a>
                <a href="report-cancelledOrder.php" class="text-light text-decoration-none ">
                    <li class="sidebar-list-item"  id="nav-cancelled">
                    <span class="material-icons-outlined ps-4">delete_forever</span> Cancelled Order
                </li>
                </a>
                <a href="report-stockHistory.php" class="text-light text-decoration-none ">
                    <li class="sidebar-list-item"  id="nav-history">
                    <span class="material-icons-outlined ps-4">inventory_2</span> Stock in History
                </li>
                </a>
            </div>
            </a>
            <a href="verification.php" class="text-light text-decoration-none">
                <li class="sidebar-list-item"  id="nav-verify">
                <span class="material-icons-outlined">verified</span> Verification
            </li>
            </a>
                <!-- <a href="products.php" class="text-light text-decoration-none">
                <li class="sidebar-list-item"  id="nav-settings">
                <span class="material-icons-outlined">settings</span> Settings
                
            </li> -->
           
            </a>
            <a href="include/logout.php" class="text-light text-decoration-none">
                <li class="sidebar-list-item" >
                    <span class="material-icons-outlined">logout</span> Logout
                </li>
            </a>
          </ul>

        </aside>
        <!-- End Sidebar -->