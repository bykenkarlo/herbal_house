<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout_model extends CI_Model {

	public function addBillingInfo() {
		if (isset($this->session->user_id)) {
			$user_id = $this->session->user_id;
		}
		else if (isset($this->session->temp_user_id)) {
			$user_id = $this->session->temp_user_id;
		}
		else {
			$user_id = $this->userIDGenerator();
		}

		$checkBillInfo = $this->checkBillingInfo($user_id);		
		if (isset($checkBillInfo)) {
			$response['status'] = 'already_exist';
			$response['message'] = 'Billing info already exists';
			return $response;
			exit();
		}
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$email_address = $this->input->post('email_address');
		$phone = $this->input->post('phone');
		$address = $this->input->post('address');
		$city = $this->input->post('city');
		$state = $this->input->post('state');
		$zip_code = $this->input->post('zip_code');
		$country = $this->input->post('country');
		$order_notes = $this->input->post('order_notes');
		$ship_same_address = $this->input->post('ship_same_address');

		$this->form_validation->set_rules('email_address', 'Email', 'required|valid_email',
			array(
				'valid_email' => 'Please input a valid Email Address!',
				'required' => 'Email Address is Required!'
			)
		);

		if ($this->form_validation->run() == FALSE) {
			$response['status'] = 'failed';
			$response['message'] = $this->form_validation->error_array();
		}
		else{
			$data = array(
				'user_id'=>$user_id,
				'fname'=>$fname,
				'lname'=>$lname,
				'email_address'=>$email_address,
				'phone_number'=>$phone,
				'full_address'=>$address,
				'city'=>$city,
				'state'=>$state,
				'zip_code'=>$zip_code,
				'country'=>$country,
				'created_at'=>date('Y-m-d H:i:s'),
			);
			$this->db->INSERT('billing_info_tbl', $data);

			if (isset($ship_same_address)) { /* if checked, copy to shipping bl */
				$this->db->INSERT('shipping_info_tbl', $data);
			}
			$response['status'] = 'success';
			$response['message'] = 'Added billing info';
		}
		return $response;
	}
	public function checkBillingInfo($user_id){
		return $this->db->WHERE('user_id', $user_id)
			->GET('billing_info_tbl')->row_array();
	}
	public function checkShippingInfo($user_id){
		return $this->db->WHERE('user_id', $user_id)
			->GET('shipping_info_tbl')->row_array();
	}
	public function userIDGenerator($length=19) {
   		$characters = '0123456789abcdef';
	    $charactersLength = strlen($characters);
	    $tempUserID = '';
	    for ($i = 0; $i < $length; $i++) {
	        $tempUserID .= $characters[rand(0, $charactersLength - 1)];
	    }
	   
	  	$checkUserID = $this->checkTempUserID($tempUserID);
		if ($checkUserID > 0) {
	   		$this->userIDGenerator();
		}
		else{
        	$userID = $this->session->set_userdata('temp_user_id', $tempUserID);
			return $tempUserID;
		}
    }
    public function checkTempUserID($tempUserID) {
    	return $this->db->WHERE('user_id', $tempUserID)
    		->GET('cart_tbl')->num_rows();
    }
    public function getBillingInfo(){
    	if (isset($this->session->user_id)) {
			$user_id = $this->session->user_id;
		}
		else if (isset($this->session->temp_user_id)) {
			$user_id = $this->session->temp_user_id;
		}
		else {
			$user_id = $this->userIDGenerator();
		}


    	if (isset($user_id)) {
    		return $this->db->WHERE('user_id', $user_id)->GET('billing_info_tbl')->row_array();
    	}
    	else{
    		$response['status'] = 'failed';
			$response['message'] = 'No record yet!';
    	}
    }
    public function addShippingInfo() {
		if (isset($this->session->user_id)) {
			$user_id = $this->session->user_id;
		}
		else if (isset($this->session->temp_user_id)) {
			$user_id = $this->session->temp_user_id;
		}
		else {
			$user_id = $this->userIDGenerator();
		}

		$checkBillInfo = $this->checkShippingInfo($user_id);		
		if (isset($checkBillInfo)) {
			$response['status'] = 'already_exist';
			$response['message'] = 'Shipping info already exists';
			return $response;
			exit();
		}
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$email_address = $this->input->post('email_address');
		$phone = $this->input->post('phone');
		$address = $this->input->post('address');
		$city = $this->input->post('city');
		$state = $this->input->post('state');
		$zip_code = $this->input->post('zip_code');
		$country = $this->input->post('country');
		$order_notes = $this->input->post('order_notes');
		$ship_same_address = $this->input->post('ship_same_address');

		$this->form_validation->set_rules('email_address', 'Email', 'required|valid_email',
			array(
				'valid_email' => 'Please input a valid Email Address!',
				'required' => 'Email Address is Required!'
			)
		);

		if ($this->form_validation->run() == FALSE) {
			$response['status'] = 'failed';
			$response['message'] = $this->form_validation->error_array();
		}
		else{
			$data = array(
				'user_id'=>$user_id,
				'fname'=>$fname,
				'lname'=>$lname,
				'email_address'=>$email_address,
				'phone_number'=>$phone,
				'full_address'=>$address,
				'city'=>$city,
				'state'=>$state,
				'zip_code'=>$zip_code,
				'country'=>$country,
				'created_at'=>date('Y-m-d H:i:s'),
			);
			$this->db->INSERT('billing_info_tbl', $data);

			$response['status'] = 'success';
			$response['message'] = 'Added Shipping info';
		}
		return $response;
	}
    public function getShippingInfo(){
    	if (isset($this->session->user_id)) {
			$user_id = $this->session->user_id;
		}
		else if (isset($this->session->temp_user_id)) {
			$user_id = $this->session->temp_user_id;
		}
		else {
			$user_id = $this->userIDGenerator();
		}


    	if (isset($user_id)) {
    		return $this->db->WHERE('user_id', $user_id)->GET('shipping_info_tbl')->row_array();
    	}
    	else{
    		$response['status'] = 'failed';
			$response['message'] = 'No record yet!';
    	}
    }
    public function getShippingInfoByID($user_id){
    	return $this->db->SELECT('si_id')->WHERE('user_id',$user_id)->WHERE('status','active')->GET('shipping_info_tbl')->row_array();
    }
    public function getBillingInfoByID($user_id){
    	return $this->db->SELECT('bi_id')->WHERE('user_id', $user_id)->WHERE('status','active')->GET('billing_info_tbl')->row_array();
    }
    public function generateReferenceNo($order_id,  $length = 11) {
	    $characters = '0123456789ABCDEF';
	    $charactersLength = strlen($characters);
	    $reference_no = '';
	    for ($i = 0; $i < $length; $i++) {
	        $reference_no .= $characters[rand(0, $charactersLength - 1)];
	    }
	    $reference_no = 'HO'.$order_id.$reference_no;

	    $check = $this->db->WHERE('reference_no',$reference_no)->GET('order_tbl')->num_rows();
	    if ($check > 0) {
	    	$this->generateReferenceNo($order_id);
	    }
	    else{
		    $data = array(
	    		'reference_no'=>$reference_no,
	    	);
	    	$this->db->WHERE('order_id', $order_id)->UPDATE('order_tbl', $data); /* insert reference no*/

	    	$logs = array('order_id'=>$order_id, 'activity'=>'Generating new order reference no. '.$reference_no );
	    	$this->insertOrderEventLogs($logs);
	    }
    	return $reference_no;
	}
	public function getPaymentOptions(){
		$query = $this->db->WHERE('status','active')->GET('payment_method_tbl')->result_array();

		$result = array();
		foreach ($query as $q) {
			$array = array(
				'payment_id'=>$q['pm_id'],
				'payment_method'=>$q['name'],
				'payment_description'=>$q['description'],
				'payment_logo'=>base_url().$q['logo'],
			);
			array_push($result, $array);
		}
		return $result;
	}

	public function placeOrder() {
    	if (isset($this->session->user_id)) {
			$user_id = $this->session->user_id;
		}
		else if (isset($this->session->temp_user_id)) {
			$user_id = $this->session->temp_user_id;
		}
		$checkShipinfo = $this->checkShippingInfo($user_id);
		$checkBillinfo = $this->checkBillingInfo($user_id);
    	$payment_method = $this->input->post('payment_method');

    	$this->form_validation->set_rules('payment_method', 'Payment Method', 'required',
			array(
				'required' => 'Please choose your preferred Payment Method!'
			)
		);

    	if (!isset($checkBillinfo)) { /* check if there's a BILLING INFO saved from client*/
			$response['status'] = 'no_bill_info';
			$response['message'] = 'Billing Info is required!';
			return $response;
			exit();
		}

    	if (!isset($checkShipinfo)) { /* check if there's a SHIPPING INFO saved from client*/
			$response['status'] = 'no_ship_info';
			$response['message'] = 'Shipping Info is required!';
			return $response;
			exit();
		}

		if ($this->form_validation->run() == FALSE) { /* check if there's a PAYMENT METHOD choose by client*/
			$response['status'] = 'failed';
			$response['message'] = $this->form_validation->error_array();
			return $response;
			exit();
		}
		
		if ($payment_method == 'Cash On Delivery') {
			$reference_no = $this->insertNewOrder($user_id);

			$response['status'] = 'success';
			$response['message'] = 'Order has been created!';
			$response['order_url'] = base_url('order/').$reference_no;
		}
		else if($payment_method == 'Paypal') {
			$response['status'] = 'success';
			$response['message'] = 'Order has been created with Paypal';
			$response['order_url'] = '';
		}
		return $response;
    }
    public function insertNewOrder($user_id) {
    	$getShipInfo = $this->getShippingInfoByID($user_id);
    	$getBillInfo = $this->getBillingInfoByID($user_id);
    	$order_note = $this->input->post('order_notes');
    	$payment_method = $this->input->post('payment_method');
    	$revenue = $this->getTotalRevenue($user_id);
    	$data = array(
	    	'bi_id'=>$getBillInfo['bi_id'],
	    	'si_id'=>$getShipInfo['si_id'],
	    	'user_id'=>$user_id,
	    	'status'=>'created',
	    	'total_revenue'=>$revenue['total'],
	    	'note'=>$order_note,
	    	'payment_method'=>$payment_method,
	    	'created_at'=>date('Y-m-d H:i:s'),
	    );
	    $this->db->INSERT('order_tbl', $data);
	    $order_id = $this->db->insert_id();
	    $reference_no = $this->generateReferenceNo($order_id);  /* insert order ref no */
	    $moveCartToSales = $this->moveCartToSales($user_id, $order_id);  /* move cart items to sales */
	    $this->paymentDetails($order_id, $payment_method ); /* insert payment details*/

	    $activity = 'Order Placed';
	    $this->shipmentTracking($order_id, $activity); /* insert shipment track details*/

	    $notif_log = array('user_id'=>$user_id, 'message'=>'New Order Placed #'.$reference_no,'created_at'=>date('Y-m-d H:i:s')); 
		$this->insertNewNotification($notif_log); /* INSERT new Notification */
		$this->sendOrderConfirmationEmail($order_id);

		return $reference_no;
    }
    public function moveCartToSales($user_id, $order_id) {
    	$cart = $this->db->WHERE('user_id', $user_id)->GET('cart_tbl')->result_array();

    	foreach ($cart as $ca) {
    		$this->minusQtyFromCartToProduct($ca['p_id'], $ca['qty']);
    		$arr = array(
    			'order_id'=>$order_id,
    			'user_id'=>$user_id,
    			'p_id'=>$ca['p_id'],
    			'price'=>$ca['price'],
    			'qty'=>$ca['qty'],
    			'created_at'=>date('Y-m-d H:i:s'),
    		);
    		$this->db->INSERT('sales_tbl', $arr); /* move cart to sales */
    	}
    	$this->db->WHERE('user_id', $user_id)->DELETE('cart_tbl'); /* remove all cart after moved */

    }
    public function minusQtyFromCartToProduct($p_id, $qty) {
    	$product = $this->db
    		->WHERE('p_id', $p_id)
    		->GET('products_tbl')->row_array();
    	$prod_qty = $product['qty'] - $qty;

    	$data = array('qty'=>$prod_qty);
    	$this->db->WHERE('p_id', $p_id)->UPDATE('products_tbl', $data); /* update qty of the product */
    }
    public function getTotalRevenue($user_id){
    	$query = $this->db->SELECT('price, qty')
			->WHERE('user_id', $user_id)
			->GET('cart_tbl')->result_array();

    	$grand_total = 0;
    	$total = 0;
    	foreach($query as $q){
    		$total_price_per_product = $q['price'] * $q['qty'];
    		$grand_total += $total_price_per_product;
		}
		$data['grand_total'] = $grand_total;
		$data['total'] = $grand_total;

		return $data;
    }
    public function paymentDetails($order_id, $payment_method ) {
    	$payment_ref_no = '';
    	if ($payment_method == 'Cash On Delivery') {
    		$payment_ref_no = '';
    		$status = 'unpaid';
    	}

    	$data = array(
    		'order_id'=>$order_id,
    		'payment_method'=>$payment_method,
    		'payment_ref_no'=>$payment_ref_no,
    		'status'=>$status,
    		'created_at'=>date('Y-m-d H:i:s'),
    	);
    	$this->db->INSERT('payment_tbl', $data);
    }
    public function shipmentTracking($order_id, $activity ) {
    	$data = array(
    		'order_id'=>$order_id,
    		'activity_log'=>$activity,
    		'created_at'=>date('Y-m-d H:i:s'),
    	);
    	$this->db->INSERT('shipment_track_tbl', $data);
    }
    public function insertNewNotification ($notif_log) {
		$this->db->INSERT('notification_tbl', $notif_log);
	}
	public function insertOrderEventLogs($logs){
		$this->db->INSERT('order_events_tbl', $logs);
	}
	public function sendOrderConfirmationEmail($order_id) {
		$orderData = $this->getOrderData($order_id);
		
		$config = array (
			'mailtype' => 'html',
			'charset'  => 'utf-8',
			'priority' => '1'
		);
		$order_date = date('F d, Y, h:i A', strtotime($orderData['ordered_date']));
		$data['header_image'] = base_url().'assets/images/herbal-house-logo.png';
		$data['header_image_url'] = base_url().'?utm_source=herbalhouse&utm_medium=order_confirmation&utm_campaign=email';
		$data['name'] = $orderData['fname'].' '.$orderData['lname'];
		$data['email_address'] = $orderData['email_address'];
		$data['reference_no'] = $orderData['reference_no'];
		$data['total_amount'] = number_format( $orderData['total_amount'], 2);
		$data['payment_method'] = $orderData['payment_method'] ;
		$data['order_details'] = base_url('order/').$orderData['reference_no'];
		$data['ordered_date'] =  $order_date;

		$this->email->initialize($config);
		$this->email->from('no-reply@kenkarlo.com', 'Herbal House');
		$this->email->to($orderData['email_address']);
		$this->email->subject('Thank you for your order');
		$body = $this->load->view('email/order_confirmation', $data, TRUE);
		$this->email->message($body);
		$this->email->send();

		$logs = array('order_id'=>$order_id, 'activity'=>'Order email confirmation sent.');
	    $this->insertOrderEventLogs($logs);
	}
	public function getOrderData($order_id) {
		$query = $this->db->SELECT('bit.fname, bit.lname, bit.email_address, ot.reference_no, ot.total_revenue as total_amount, ot.payment_method, ot.created_at as ordered_date')
			->FROM('order_tbl as ot')
			->JOIN('billing_info_tbl as bit','bit.bi_id = ot.bi_id')
			->WHERE('ot.order_id', $order_id)
			->GET()->row_array();
		return $query;
	}
}