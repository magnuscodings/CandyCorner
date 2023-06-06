 <!-- Sidebar -->
 <aside id="sidebar" style="z-index: 3;">
            <div class="sidebar-title">
                <div class="sidebar-brand">
                <span class="material-icons-outlined">inventory</span>Candy Corner's Inventory
            </div>
            <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
          </div>

          <ul class="sidebar-list">
          <a href="orders.php" class="text-light text-decoration-none">
                <li class="sidebar-list-item"  id="nav-order">
                <span class="material-icons-outlined">add_shopping_cart</span> Purchase Order
            </li>
            <a href="sales.php" class="text-light text-decoration-none">
                <li class="sidebar-list-item"  id="nav-sales">
                <span class="material-icons-outlined">shopping_cart</span> Sales Orders
            </li>
            <a href="inventory.php" class="text-light text-decoration-none">  
            <li class="sidebar-list-item" id="nav-inventory">
                <span class="material-icons-outlined">fact_check</span> Inventory
            </li>
            </a>
           
            <a href="include/logout.php" class="text-light text-decoration-none">
                <li class="sidebar-list-item" >
                    <span class="material-icons-outlined">logout</span> Logout
                </li>
            </a>
          </ul>

        </aside>
        <!-- End Sidebar -->