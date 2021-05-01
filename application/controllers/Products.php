<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');

class Products extends CI_Controller {

	function __construct () {
        parent::__construct();
        $this->load->model('products_model');
		$this->load->library('user_agent');
		$this->load->library('pagination');
        $this->load->library('form_validation');
    }
	public function addProduct () {	
		$data = $this->products_model->addProduct();
        $this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	public function updateProduct () {	
		$data = $this->products_model->updateProduct();
        $this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	public function delete() {
		$data = $this->products_model->deleteProduct();
        $this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	public function deleteCategory() {
		$data = $this->products_model->deleteCategory();
        $this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	public function show($row_no=0){
		// Row per page
    	$row_per_page = 10;

    	// Row position
	    if($row_no != 0){
	      $row_no = ($row_no-1) * $row_per_page;
	    }

	    // All records count
    	$all_count = $this->products_model->getProductCount();

    	// Get records
		$products = $this->products_model->getAllProductData($row_per_page, $row_no);

   		// Pagination Configuration
	    $config['base_url'] = base_url('ecom/products/');
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = $all_count;
	    $config['per_page'] = $row_per_page;

	    // Pagination with bootstrap
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination btn-xs">';
	    $config['full_tag_close'] = '</ul>';
	    $config['num_tag_open'] = '<li class="page-item ">';
	    $config['num_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['next_tag_open'] = '<li class="page-item">';
	    $config['next_tagl_close'] = '</a></li>';
	    $config['prev_tag_open'] = '<li class="page-item">';
	    $config['prev_tagl_close'] = '</li>';
	    $config['first_tag_open'] = '<li class="page-item disabled">';
	    $config['first_tagl_close'] = '</li>';
	    $config['last_tag_open'] = '<li class="page-item">';
	    $config['last_tagl_close'] = '</a></li>';
	    $config['attributes'] = array('class' => 'page-link');
	    $config['next_link'] = 'Next'; // change > to 'Next' link
	    $config['prev_link'] = 'Previous'; // change < to 'Previous' link

	    // Initialize
	    $this->pagination->initialize($config);

	    // Initialize $data Array
	    $data['pagination'] = $this->pagination->create_links();
	    $data['result'] = $products;
	    $data['row'] = $row_no;
		$data['count'] = $all_count;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function categories($row_no=0){
		// Row per page
    	$row_per_page = 10;

    	// Row position
	    if($row_no != 0){
	      $row_no = ($row_no-1) * $row_per_page;
	    }

	    // All records count
    	$all_count = $this->products_model->getProductCategoryCount();

    	// Get records
		$products = $this->products_model->getAllProductCategoryData($row_per_page, $row_no);

   		// Pagination Configuration
	    $config['base_url'] = base_url('ecom/products-category/');
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = $all_count;
	    $config['per_page'] = $row_per_page;

	    // Pagination with bootstrap
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination btn-xs">';
	    $config['full_tag_close'] = '</ul>';
	    $config['num_tag_open'] = '<li class="page-item ">';
	    $config['num_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['next_tag_open'] = '<li class="page-item">';
	    $config['next_tagl_close'] = '</a></li>';
	    $config['prev_tag_open'] = '<li class="page-item">';
	    $config['prev_tagl_close'] = '</li>';
	    $config['first_tag_open'] = '<li class="page-item disabled">';
	    $config['first_tagl_close'] = '</li>';
	    $config['last_tag_open'] = '<li class="page-item">';
	    $config['last_tagl_close'] = '</a></li>';
	    $config['attributes'] = array('class' => 'page-link');
	    $config['next_link'] = 'Next'; // change > to 'Next' link
	    $config['prev_link'] = 'Previous'; // change < to 'Previous' link

	    // Initialize
	    $this->pagination->initialize($config);

	    // Initialize $data Array
	    $data['pagination'] = $this->pagination->create_links();
	    $data['result'] = $products;
	    $data['row'] = $row_no;
		$data['count'] = $all_count;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function addProductCategory() {
		$data = $this->products_model->addProductCategory();
        $this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	public function getProductCategory() {
		$data = $this->products_model->getProductCategory();
        $this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	public function getProductDataByID() {
		$data = $this->products_model->getProductDataByID();
        $this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	public function updateProductStatus() {
		$data = $this->products_model->updateProductStatus();
        $this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	public function updateProductCategoryStatus() {
		$data = $this->products_model->updateProductCategoryStatus();
        $this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	public function getShopProducts($row_no = 0) {
		// Row per page
    	$row_per_page = 10;

    	// Row position
	    if($row_no != 0){
	      $row_no = ($row_no-1) * $row_per_page;
	    }

	    // All records count
    	$all_count = $this->products_model->getShopProductsCount();

    	// Get records
		$products = $this->products_model->getShopProducts($row_per_page, $row_no);

   		// Pagination Configuration
	    $config['base_url'] = base_url('ecom/products-category/');
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = $all_count;
	    $config['per_page'] = $row_per_page;

	    // Pagination with bootstrap
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination btn-xs">';
	    $config['full_tag_close'] = '</ul>';
	    $config['num_tag_open'] = '<li class="page-item ">';
	    $config['num_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['next_tag_open'] = '<li class="page-item">';
	    $config['next_tagl_close'] = '</a></li>';
	    $config['prev_tag_open'] = '<li class="page-item">';
	    $config['prev_tagl_close'] = '</li>';
	    $config['first_tag_open'] = '<li class="page-item disabled">';
	    $config['first_tagl_close'] = '</li>';
	    $config['last_tag_open'] = '<li class="page-item">';
	    $config['last_tagl_close'] = '</a></li>';
	    $config['attributes'] = array('class' => 'page-link');
	    $config['next_link'] = 'Next'; // change > to 'Next' link
	    $config['prev_link'] = 'Previous'; // change < to 'Previous' link

	    // Initialize
	    $this->pagination->initialize($config);

	    // Initialize $data Array
	    $data['pagination'] = $this->pagination->create_links();
	    $data['result'] = $products;
	    $data['row'] = $row_no;
		$data['count'] = $all_count;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));

	}
	public function updateProductQuantity() {
		$data = $this->products_model->updateProductQuantity();
        $this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	public function getRecommendedProducts(){
        $data = $this->products_model->getRecommendedProducts();
        $this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
    }
    public function searchProduct(){
        $data = $this->products_model->searchProduct();
        $this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
    }
}