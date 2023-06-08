<?php
	require_once'config.php';
	
	class db_class extends db_connect{
		
		public function __construct(){
			$this->connect();
		}
		
		public function login($email, $password){
			$email=htmlentities(trim($email));
			$password=htmlentities(trim($password));
			$query=$this->conn->prepare("SELECT * FROM `users` WHERE `u_email`='$email' && `u_password`='$password' ") or die($this->conn->error);
			if($query->execute()){
				$result=$query->get_result();
				$valid=$result->num_rows;
				$fetch=$result->fetch_array();
				
				return array(
					'u_id'=>isset($fetch['u_id']) ? $fetch['u_id'] : 0,
					'count'=>isset($valid) ? $valid: 0,
					'u_type'=>isset($fetch['u_type']) ? $fetch['u_type'] : 0,
					'u_email'=>isset($fetch['u_email']) ? $fetch['u_email'] : 0,
					'u_status'=>isset($fetch['u_status']) ? $fetch['u_status'] : 0
				);	
			}
		}
		public function insertUser($email,$password,$name,$type,$status){
			$email=htmlentities($email);
			$password=htmlentities($password);
			$type=htmlentities($type);
			$name=htmlentities($name);
			$status=htmlentities($status);

			$query=$this->conn->prepare("INSERT INTO `users` (`u_id`, `u_email`, `u_password`, u_name, `u_type`, `u_status`) VALUES (NULL, '$email', '$password','$name','$type','$status')") or die($this->conn->error);			
			if($query->execute()){
				return true;
			}
		}
		public function insertCategory($name){
			$name=htmlentities($name);

			$query=$this->conn->prepare("INSERT INTO `category` (`category_id`, `category_name`, `category_status`) VALUES (NULL, '$name', '0')") or die($this->conn->error);			
			if($query->execute()){
				return true;
			}
		}
		public function insertRequestDelivery($user_id,$req_id,$date){
			$user_id=htmlentities($user_id);
			$req_id=htmlentities($req_id);
			$date=htmlentities($date);

			$query=$this->conn->prepare("INSERT INTO `request_delivery` (`request_delivery_id`, `request_delivery_user_id`, `request_delivery_request_id`, `request_delivery_date`, `request_delivery_status`) VALUES (NULL, '$user_id', '$req_id', '$date', '0')") or die($this->conn->error);			
			if($query->execute()){
				return true;
			}
		}
		public function updateRequestStatus($user_id,$req_id,$status){
			$user_id=htmlentities($user_id);
			$req_id=htmlentities($req_id);
			$status=htmlentities($status);

			$query=$this->conn->prepare("UPDATE `request` SET `request_status` = '$status' WHERE `request`.`request_id` = '$req_id' && request_user_id = '$user_id';") or die($this->conn->error);			
			if($query->execute()){
				return true;
			}
		}
		public function insertCart($id,$user_id,$quantity){
			$id=htmlentities($id);
			$user_id=htmlentities($user_id);
			$quantity=htmlentities($quantity);

			$query=$this->conn->prepare("INSERT INTO `cart` (`cart_id`, `cart_user_id`, `cart_product_id`, `cart_quantity`, `cart_status`) VALUES (NULL, '$user_id', '$id', '$quantity', '0')") or die($this->conn->error);			
			if($query->execute()){
				return true;
			}
		}
		public function insertRequest($user_id,$id,$quantity,$reason){
			$id=htmlentities($id);
			$user_id=htmlentities($user_id);
			$quantity=htmlentities($quantity);
			$reason=htmlentities($reason);

			$query=$this->conn->prepare("INSERT INTO `request` (`request_id`, `request_user_id`, `request_prod_id`, `request_qty`, `request_reason`, `request_date`, `request_status`) VALUES (NULL, '$user_id', '$id', '$quantity', '$reason', current_timestamp(), '0')") or die($this->conn->error);			
			if($query->execute()){
				return true;
			}
		}
		public function insertOrder($id,$order_id,$quantity,$user_id){
			$id=htmlentities($id);
			$order_id=htmlentities($order_id);
			$quantity=htmlentities($quantity);
			$user_id=htmlentities($user_id);

			$query=$this->conn->prepare("INSERT INTO `orders` (`order_id`, `order_united_id`, `order_product_id`, `order_quantity`, `order_date`, `order_status`,order_user_id) 
			VALUES (NULL, '$order_id', '$id', '$quantity', current_timestamp(), '0','$user_id')
			") or die($this->conn->error);			
			if($query->execute()){
				return true;
			}
		}
		public function updateCategory($name,$id){
			$name=htmlentities($name);
			$id=htmlentities($id);

			$query=$this->conn->prepare("UPDATE `category` SET `category_name` = '$name' WHERE `category`.`category_id` = '$id'") or die($this->conn->error);			
			if($query->execute()){
				return true;
			}
		}
		public function updateStocks($status,$id){
			$status=htmlentities($status);
			$id=htmlentities($id);

			$query=$this->conn->prepare("UPDATE `stocks` SET `stock_status` = '$status' WHERE `stocks`.`stock_id` = '$id';") or die($this->conn->error);			
			if($query->execute()){
				return true;
			}
		}
		public function insertInventoryRecords($status,$id,$order_id){
			$status=htmlentities($status);
			$id=htmlentities($id);
			$order_id=htmlentities($order_id);

			$query=$this->conn->prepare("INSERT INTO `inventory_records` (`inventory_record_id`, `inventory_record_prod_id`, `inventory_record_order_id`, `inventory_record_status`, `inventory_record_date`) VALUES (NULL, '$id', '$order_id', '$status', current_timestamp())") or die($this->conn->error);			
			if($query->execute()){
				return true;
			}
		}
		

		public function deactivateCategory($id){
			$id=htmlentities($id);

			$query=$this->conn->prepare("UPDATE `category` SET `category_status` = '1' WHERE `category`.`category_id` = '$id'") or die($this->conn->error);			
			if($query->execute()){
				return true;
			}
		}
		public function deleteCart($id,$user_id){
			$id=htmlentities($id);
			$user_id=htmlentities($user_id);

			$query=$this->conn->prepare("DELETE FROM cart WHERE `cart`.`cart_id` = '$id' AND cart_user_id='$user_id'") or die($this->conn->error);			
			if($query->execute()){
				return true;
			}
		}
		public function deleteAllCart($user_id){
			$user_id=htmlentities($user_id);

			$query=$this->conn->prepare("DELETE FROM cart WHERE cart_user_id='$user_id'") or die($this->conn->error);			
			if($query->execute()){
				return true;
			}
		}
		public function insertProducts($name,$category,$description,$price){
			$name=htmlentities($name);
			$category=htmlentities($category);
			$description=htmlentities($description);
			$price=htmlentities($price);

			$query=$this->conn->prepare("INSERT INTO `products` (`prod_id`, `prod_name`, `prod_category`, `prod_description`, `prod_price`, `prod_status`) VALUES (NULL, '$name', '$category', '$description', '$price', '0')") or die($this->conn->error);			
			if($query->execute()){
				return true;
			}
		}
		public function insertStocks($id,$barcode,$date){
			$id=htmlentities($id);
			$barcode=htmlentities($barcode);
			$date=htmlentities($date);

			$query=$this->conn->prepare("INSERT INTO `stocks` (`stock_id`, `stock_prod_id`, `stock_barcode`, `stock_datetime`, `stock_status`,stock_expiration) VALUES (NULL, '$id', '$barcode', current_timestamp(), '0','$date')") or die($this->conn->error);			
			if($query->execute()){
				return true;
			}
		}
		public function insertOrderRecords($user_id,$order_id,$status){
			$user_id=htmlentities($user_id);
			$order_id=htmlentities($order_id);
			$status=htmlentities($status);

			$query=$this->conn->prepare("INSERT INTO `order_records` (`order_record_id`, `order_record_user_id`,order_record_order_id, `order_record_status`, `order_record_date`) VALUES (NULL, '$user_id','$order_id', '$status', current_timestamp())") or die($this->conn->error);			
			if($query->execute()){
				return true;
			}
		}
		public function insertPulloutRecords($user_id,$prod_id,$qty){
			$user_id=htmlentities($user_id);
			$prod_id=htmlentities($prod_id);
			$qty=htmlentities($qty);

			$query=$this->conn->prepare("INSERT INTO `pullout_records` (`pullout_records_id`, `pullout_records_user_id`, `pullout_records_prod_id`, `pullout_records_qty`, `pullout_records_date`) VALUES (NULL, '$user_id', '$prod_id', '$qty', current_timestamp())") or die($this->conn->error);			
			if($query->execute()){
				return true;
			}
		}

		public function updateProducts($id,$name,$category,$description,$price){
			$id=htmlentities($id);
			$name=htmlentities($name);
			$category=htmlentities($category);
			$description=htmlentities($description);
			$price=htmlentities($price);

			$query=$this->conn->prepare("UPDATE `products` SET `prod_name` = '$name', `prod_category` = '$category', `prod_description` = '$description', `prod_price` = '$price' WHERE `products`.`prod_id` = '$id'") or die($this->conn->error);			
			if($query->execute()){
				return true;
			}
		}
		public function updateStatusOrder($user_id,$order_id,$status){
			$user_id=htmlentities($user_id);
			$order_id=htmlentities($order_id);
			$status=htmlentities($status);

			$query=$this->conn->prepare("UPDATE `orders` SET `order_status` = '$status' WHERE `orders`.`order_united_id` = '$order_id' && `orders`.`order_user_id` = '$user_id';") or die($this->conn->error);			
			if($query->execute()){
				return true;
			}
		}
		public function insertOrderCancelRecords($user_id,$reason,$type,$order_id){
			$user_id=htmlentities($user_id);
			$reason=htmlentities($reason);
			$type=htmlentities($type);
			$order_id=htmlentities($order_id);

			$query=$this->conn->prepare("INSERT INTO `order_cancel_records` (`order_cancel_record_id`, `order_cancel_record_user_id`, `order_cancel_record_reason`, `order_cancel_record_datetime`, `order_cancel_record_type`, `order_cancel_record_order_id`) VALUES (NULL, '$user_id', '$reason', current_timestamp(), '$type', '$order_id')") or die($this->conn->error);			
			if($query->execute()){
				return true;
			}
		}
		

		public function deactivateProducts($id){
			$id=htmlentities($id);

			$query=$this->conn->prepare("UPDATE `products` SET `prod_status` = '1' WHERE `products`.`prod_id` = '$id'") or die($this->conn->error);			
			if($query->execute()){
				return true;
			}
		}
		public function updateStocksStatus($id,$status){
			$id=htmlentities($id);
			$status=htmlentities($status);

			$query=$this->conn->prepare("UPDATE `stocks` SET `stock_status` = '$status' WHERE `stocks`.`stock_id` = '$id'") or die($this->conn->error);			
			if($query->execute()){
				return true;
			}
		}
		public function updateUserStatus($id,$status){
			$id=htmlentities($id);
			$status=htmlentities($status);

			$query=$this->conn->prepare("UPDATE `users` SET `u_status` = '$status' WHERE `users`.`u_id` ='$id'") or die($this->conn->error);			
			if($query->execute()){
				return true;
			}
		}

		public function selectCategory(){
			$query=$this->conn->prepare("SELECT * 
			FROM category where category_status='0' ") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function selectProducts(){
			$query=$this->conn->prepare("SELECT * FROM products as a 
			LEFT JOIN category as b 
			ON a.prod_category=b.category_id
			where `prod_status`='0'") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function dashboardProducts(){
			$query=$this->conn->prepare("SELECT COUNT(a.prod_id) as count FROM products as a 
			LEFT JOIN category as b 
			ON a.prod_category=b.category_id
			where `prod_status`='0'") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function dashboardPurchase(){
			$query=$this->conn->prepare("SELECT SUM(a.order_quantity) as count
			FROM `orders` as a 
			LEFT JOIN products as b 
			ON a.order_product_id = b.prod_id
		") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function dashboardSales(){
			$query=$this->conn->prepare("SELECT SUM(a.order_quantity) as count
			FROM `orders` as a 
			LEFT JOIN products as b 
			ON a.order_product_id = b.prod_id
			WHERE a.order_status = 5 
		") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function dashboardInventory(){
			$query=$this->conn->prepare("SELECT COUNT(stock_id) as count 
			FROM `stocks` WHERE stock_status = 0
		") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function dashboardOrders(){
			$query=$this->conn->prepare("SELECT SUM(order_quantity) as qty,
			DATE_FORMAT(order_date, '%M') as month
			FROM `orders` as a 
			GROUP BY MONTH(order_date)
		") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function dashboardOrderSales(){
			$query=$this->conn->prepare("SELECT SUM(order_quantity) as sales,
			DATE_FORMAT(order_date, '%M') as month
			FROM `orders` as a 
            WHERE a.order_status = 5 
			GROUP BY MONTH(order_date)
		") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}

		public function selectProductQty($id){
			$query=$this->conn->prepare("SELECT *, COUNT(stock_id) as count FROM stocks
			WHERE stock_status=0 and stock_prod_id='$id'
			GROUP BY stock_prod_id
			") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function selectStocks(){
			$query=$this->conn->prepare("SELECT * ,
			DATE_FORMAT(stock_expiration, '%M %d %Y ') as stock_expiration
			FROM `stocks` as a 
			LEFT JOIN products as b 
			ON a.stock_prod_id = b.prod_id
			LEFT JOIN category as c 
			ON b.prod_category = c.category_id
			ORDER BY stock_status ASC
			") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function selectUsers($status){
			$query=$this->conn->prepare("SELECT * FROM `users` WHERE u_type='0' AND u_status='$status'
			") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function selectAllUsers(){
			$query=$this->conn->prepare("SELECT * FROM `users` WHERE u_type='0' AND u_status !=1
			") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function cartUser($id){
			$id = htmlentities($id);
			$query=$this->conn->prepare("SELECT * 
			FROM `cart`  as a 
			LEFT JOIN products as b 
			ON a.cart_product_id = b.prod_id
			LEFT JOIN category as c
			ON b.prod_category = c.category_id
			WHERE `cart_user_id` ='$id'") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function selectOrderUserGrouped($user_id){
			$query=$this->conn->prepare("SELECT *, 
			GROUP_CONCAT(prod_name SEPARATOR ',') as grp_prodname,
			GROUP_CONCAT(order_quantity SEPARATOR ',') as grp_quantity,
			GROUP_CONCAT(prod_price SEPARATOR ',') as grp_price,
			DATE_FORMAT(order_date, '%M %d %Y /  %h:%i:%s %p ') as order_date
			FROM `orders` as a 
			LEFT JOIN products as b 
			ON a.order_product_id = b.prod_id
			WHERE a.order_user_id='$user_id' and order_status=5
			GROUP BY prod_id") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function selectOrderUser($user_id){
			$query=$this->conn->prepare("SELECT *, 
			GROUP_CONCAT(prod_name SEPARATOR ',') as grp_prodname,
			GROUP_CONCAT(order_quantity SEPARATOR ',') as grp_quantity,
			GROUP_CONCAT(prod_price SEPARATOR ',') as grp_price,
			GROUP_CONCAT(prod_description SEPARATOR ',') as grp_description,
			DATE_FORMAT(order_date, '%M %d %Y /  %h:%i:%s %p ') as order_date
			FROM `orders` as a 
			LEFT JOIN products as b 
			ON a.order_product_id = b.prod_id
			WHERE a.order_user_id='$user_id'
			GROUP BY order_united_id
			ORDER BY order_id desc ") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function selectAllRequest(){
			$query=$this->conn->prepare("SELECT *,DATE_FORMAT(request_date, '%M %d %Y /  %h:%i:%s %p ') as request_date FROM request as a 
			LEFT JOIN products as b 
			ON a.request_id = b.prod_id
			WHERE request_status!=5
			ORDER BY request_date desc ") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function selectRequest($user_id){
			$user_id=htmlentities($user_id);
			$query=$this->conn->prepare("SELECT *,DATE_FORMAT(request_date, '%M %d %Y /  %h:%i:%s %p ') as request_date FROM request as a 
			LEFT JOIN products as b 
			ON a.request_id = b.prod_id
			WHERE request_user_id ='$user_id'
			ORDER BY request_date desc ") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function selectOrders(){
			$query=$this->conn->prepare("SELECT *, 
			GROUP_CONCAT(prod_name SEPARATOR ',') as grp_prodname,
			GROUP_CONCAT(order_quantity SEPARATOR ',') as grp_quantity,
			GROUP_CONCAT(prod_price SEPARATOR ',') as grp_price,
			GROUP_CONCAT('P',prod_price SEPARATOR ',') as grp_prices,
			DATE_FORMAT(order_date, '%M %d %Y /  %h:%i:%s %p ') as order_date
			FROM `orders` as a 
			LEFT JOIN products as b 
			ON a.order_product_id = b.prod_id
			LEFT JOIN category as c
			ON b.prod_category = c.category_id
			LEFT JOIN users as d 
            ON a.order_user_id = d.u_id
			GROUP BY order_united_id
			ORDER BY order_status ASC ") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function CheckerSelectOrders(){
			$query=$this->conn->prepare("SELECT *, 
			GROUP_CONCAT(prod_name SEPARATOR ',') as grp_prodname,
			GROUP_CONCAT(' -> ', prod_name,' -> ', order_quantity SEPARATOR ',') as grp_order,
			GROUP_CONCAT(prod_id SEPARATOR ',') as grp_prodid,
			GROUP_CONCAT(order_quantity SEPARATOR ',') as grp_quantity,
			GROUP_CONCAT(prod_price SEPARATOR ',') as grp_price,
			GROUP_CONCAT('P',prod_price SEPARATOR ',') as grp_prices,
			DATE_FORMAT(order_date, '%M %d %Y /  %h:%i:%s %p ') as order_date
			FROM `orders` as a 
			LEFT JOIN products as b 
			ON a.order_product_id = b.prod_id
			LEFT JOIN category as c
			ON b.prod_category = c.category_id
			LEFT JOIN users as d 
            ON a.order_user_id = d.u_id
			WHERE order_status=2
			GROUP BY order_united_id") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function CheckerStocks(){
			$query=$this->conn->prepare("SELECT * 
			FROM `stocks` as a
			LEFT JOIN products as b 
			ON a.stock_prod_id = b.prod_id
			WHERE stock_status=0") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function reportTopStocksMonth($month){
			$month = htmlentities($month);

			$query=$this->conn->prepare("SELECT *, SUM(a.order_quantity) as totalqty
			FROM `orders` as a 
			LEFT JOIN products as b 
			ON a.order_product_id = b.prod_id
			WHERE a.order_status = 5 AND MONTH(order_date)='$month'
			GROUP BY b.prod_id
			ORDER BY (SUM(a.order_quantity)) DESC
			LIMIT 5") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function reportTopStocksDate($date){
			$date = htmlentities($date);

			$query=$this->conn->prepare("SELECT *, SUM(a.order_quantity) as totalqty
			FROM `orders` as a 
			LEFT JOIN products as b 
			ON a.order_product_id = b.prod_id
			WHERE a.order_status = 5 AND Date(order_date)='$date'
			GROUP BY b.prod_id
			ORDER BY (SUM(a.order_quantity)) DESC
			LIMIT 5") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function reportTopStocks(){
			$query=$this->conn->prepare("SELECT *, SUM(a.order_quantity) as totalqty
			FROM `orders` as a 
			LEFT JOIN products as b 
			ON a.order_product_id = b.prod_id
			WHERE a.order_status = 5
			GROUP BY b.prod_id
			ORDER BY (SUM(a.order_quantity)) DESC
			LIMIT 5") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function reportStocks(){
			$query=$this->conn->prepare("SELECT *, SUM(a.order_quantity) as totalqty
			FROM `orders` as a 
			LEFT JOIN products as b 
			ON a.order_product_id = b.prod_id
			WHERE a.order_status >1 
			GROUP BY b.prod_id
			") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function reportStocksBranch($user_id){
			$user_id = htmlentities($user_id);
			$query=$this->conn->prepare("SELECT *, SUM(a.order_quantity) as totalqty,SUM(a.order_quantity) * prod_price as totalprice
			FROM `orders` as a 
			LEFT JOIN products as b 
			ON a.order_product_id = b.prod_id
			WHERE a.order_status >1 AND a.order_user_id = '$user_id'
			GROUP BY b.prod_id
			") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function reportStocksMonth($month){
			$month = htmlentities($month);

			$query=$this->conn->prepare("SELECT *, SUM(a.order_quantity) as totalqty,SUM(a.order_quantity) * prod_price as totalprice
			FROM `orders` as a 
			LEFT JOIN products as b 
			ON a.order_product_id = b.prod_id
			WHERE a.order_status >1 AND MONTH(order_date)='$month'
			GROUP BY b.prod_id
			") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function reportStocksMonthBranch($month,$user_id){
			$month = htmlentities($month);
			$user_id = htmlentities($user_id);

			$query=$this->conn->prepare("SELECT *, SUM(a.order_quantity) as totalqty,SUM(a.order_quantity) * prod_price as totalprice
			FROM `orders` as a 
			LEFT JOIN products as b 
			ON a.order_product_id = b.prod_id
			WHERE a.order_status >1 AND MONTH(order_date)='$month' AND a.order_user_id = '$user_id'
			GROUP BY b.prod_id
			") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function reportStocksDate($date){
			$date = htmlentities($date);

			$query=$this->conn->prepare("SELECT *, SUM(a.order_quantity) as totalqty
			FROM `orders` as a 
			LEFT JOIN products as b 
			ON a.order_product_id = b.prod_id
			WHERE a.order_status >1 AND DATE(order_date)='$date'
			GROUP BY b.prod_id
			") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function reportStocksDateBranch($date,$user_id){
			$date = htmlentities($date);
			$user_id = htmlentities($user_id);
			$query=$this->conn->prepare("SELECT *, SUM(a.order_quantity) as totalqty
			FROM `orders` as a 
			LEFT JOIN products as b 
			ON a.order_product_id = b.prod_id
			WHERE a.order_status >1 AND DATE(order_date)='$date' AND a.order_user_id = '$user_id'
			GROUP BY b.prod_id
			") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function reportCriticalStocks($value){
			$value = htmlentities($value);
			$query=$this->conn->prepare("SELECT a.*, COUNT(b.stock_id) as stocks
			FROM products as a
			LEFT JOIN stocks as b ON a.prod_id = b.stock_prod_id
			WHERE b.stock_status =0
			GROUP BY a.prod_id
			HAVING COUNT(b.stock_id) < '$value';") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function reportCancelledOrders(){
			$query=$this->conn->prepare("SELECT * ,
			GROUP_CONCAT(prod_name SEPARATOR ',') as grp_order_prod,
			GROUP_CONCAT(order_quantity SEPARATOR ',') as grp_order_qty,
			SUM(order_quantity) as totalQty,
			DATE_FORMAT(order_date, '%M %d %Y /  %h:%i:%s %p ') as order_date
			FROM `order_cancel_records` as a 
			LEFT JOIN orders as b 
			ON a.order_cancel_record_order_id = b.order_united_id
			LEFT JOIN products as c 
			ON b.order_product_id = c.prod_id
			LEFT JOIN users as d 
            ON a.order_cancel_record_user_id = d.u_id
			GROUP BY b.order_united_id
			ORDER BY a.order_cancel_record_id ASC") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		public function reportStockInHistory(){
			$query=$this->conn->prepare("SELECT *, 
			GROUP_CONCAT(prod_name SEPARATOR ',') as grp_order_prod,
			GROUP_CONCAT(order_quantity SEPARATOR ',') as grp_order_qty,
			GROUP_CONCAT(prod_price SEPARATOR ',') as grp_price,
			GROUP_CONCAT('P',prod_price SEPARATOR ',') as grp_prices,
			DATE_FORMAT(order_date, '%M %d %Y /  %h:%i:%s %p ') as order_date
			FROM `orders` as a 
			LEFT JOIN products as b 
			ON a.order_product_id = b.prod_id
			LEFT JOIN category as c
			ON b.prod_category = c.category_id
			LEFT JOIN users as d 
            ON a.order_user_id = d.u_id
            WHERE order_status =5
			GROUP BY order_united_id
			ORDER BY order_status ASC ") or die($this->conn->error);
			if($query->execute()){
				$result = $query->get_result();
				return $result;
			}
		}
		
	}
	
	
?>

