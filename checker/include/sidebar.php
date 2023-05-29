 <!-- Sidebar -->
 <aside id="sidebar" style="z-index: 3;">
            <div class="sidebar-title">
                <div class="sidebar-brand">
                <span class="material-icons-outlined">inventory</span>Candy Corner's Inventory
            </div>
            <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
          </div>

          <ul class="sidebar-list">
          <a href="index.php" class="text-light text-decoration-none">
            <li class="sidebar-list-item" id="nav-home" >
                <span class="material-icons-outlined ">dashboard</span> Dashboard
            </li>
          </a>
          <a href="orders.php" class="text-light text-decoration-none">
                <li class="sidebar-list-item"  id="nav-order">
                <span class="material-icons-outlined">add_shopping_cart</span> Purchase Order
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