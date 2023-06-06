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
            <h1 >Settings</h1>
            <div class="table-responsive card">
                <div class="row d-flex justify-content-center" >
                    <div class="col-sm-4 mb-2">
                        <div class="form-group form-group-default">
                            <input type="text" placeholder="Username" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center" >
                    <div class="col-sm-4 mb-2">
                        <div class="form-group form-group-default">
                            <input type="text" placeholder="Old Password" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center" >
                    <div class="col-sm-4 mb-2">
                        <div class="form-group form-group-default">
                            <input type="text" placeholder="New Password" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center" >
                    <div class="col-sm-4 mb-2">
                        <div class="form-group form-group-default">
                            <input type="text" placeholder="Re type New password" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>



<script>
    $('#nav-settings').addClass('active')
</script>
<?php include("include/js.php");?>
<script src="controller/functions.js"></script>
<script>
AddingDetails('#orderForm')

</script>