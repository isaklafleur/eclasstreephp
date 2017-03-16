<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @package    Supplier
 * @subpackage General
 * @author     Arjun J<arjunjgowda260389@gmail.com>
 * @version    V1
 */

class General extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//$this->output->enable_profiler(TRUE);
		$this->load->model('user_model');
		$this->load->model('packages_model');
		$this->load->model('suppliers_model');
		$this->load->model('meta_data');
	}

	/**
	 * index page of application will be loaded here
	 */
	function index()
	{
		if (is_logged_in_user()) {
			//$this->load->view('dashboard/reminder');
			$supplier_origin = $this->session->userdata(AUTH_USER_POINTER);//echo $supplier_origin;
			$data = $this->suppliers_model->check_supplier_profile_register($supplier_origin);#debug($data);exit;
			if(intval(@$data['data'][0]['completed_profile']) > 0){ 
				redirect('menu/index');
			}else{
				redirect('general/complete_profile');
			}
			
		} else {
			//show login
			$data = array();
			$verification_msg = $this->input->get('email_verified');
			if($verification_msg){
				$data['qry_status'] = $verification_msg;
			}
			echo $this->template->view('general/login',$data);
		}
	}
	function subscribers() {

		//$this->output->enable_profiler(TRUE);
 		$subscribers = $this->custom_db->single_table_records ('email_subscription', '*');
		$data['result'] = $subscribers['data'];
		$this->template->view('general/subscribers', $data);
	}

		/**
	 * Activate Email Subscription
	 */
	function subscribe($origin)
	{
		$data = array('status' => ACTIVE);
		$cond['origin'] = $origin;
		$this->custom_db->update_record('email_subscription',$data, $cond);
		set_update_message ();	
		redirect('general/subscribers/');
	}
	/**
	 * Deactiavte Email Subscription
	 */
	function unsubscribe($origin)
	{
		$data = array('status' => INACTIVE);
		$cond['origin'] = $origin;
		$this->custom_db->update_record('email_subscription',$data, $cond);
		set_update_message ();	
		redirect('general/subscribers/');
	}
	function markup() {
		$markup = $this->packages_model->get_markup();
		$data['r'] = $markup;
		$this->template->view('packages/markup', $data);
	}
	/*
	 * drivers
	 */
	function drivers(){
		$operation_data ['data'] = $this->input->post ();
		$read_ops = $this->input->get ();
		if (valid_array ( $operation_data ['data'] ) == true) {
			#debug($operation_data ['data']) ; exit;
			$this->current_page->set_auto_validator ();
			if ($this->form_validation->run ()) {	
				Provab_Page_Loader::clean_form_id ( $operation_data ['data'] );
				$operation_data ['data']['created_by_origin'] = $this->entity_user_id;
				$origin = $this->packages_model->save_driver( $operation_data ['data'], $operation_data ['data'] ['origin'] );
				if (intval ( $operation_data ['data'] ['origin'] ) > 0) {
					// set message
					set_update_message ();
				} elseif (intval ( $operation_data ['data'] ['origin'] ) == 0) {
					set_insert_message ();
				}
				redirect ( 'general/drivers?' . get_current_pageid () );
			}
		}
		elseif (isset ( $read_ops ['eid'] ) == true and intval ( $read_ops ['eid'] ) > 0) 
		{ 
			$result = $this->packages_model->get_drivers ( $read_ops ['eid']);
		
			if ($result != FALSE) 
			{
				$operation_data ['data'] = $result[0];
			}
			 else 
			{
				redirect ('general/drivers?' . get_current_pageid ());
			}
		}
		$operation_data ['data_list'] = $this->packages_model->get_drivers (0,$this->entity_user_id);
		#debug($operation_data ['data_list']); exit;
		$this->template->view('general/drivers',$operation_data);
	}
	

	/**
	 * Activate drivers
	 */
	function activate_drivers($origin)
	{
		$data = array('status' => ACTIVE);
		$cond['origin'] = $origin;
		$this->custom_db->update_record('drivers',$data, $cond);
		set_update_message ();	
		redirect('general/drivers');
	}
	
	/**
	 * Deactiavte drivers
	 */
	function deactivate_drivers($origin)
	{
		$data = array('status' => INACTIVE);
		$cond['origin'] = $origin;
		$this->custom_db->update_record('drivers',$data, $cond);
		set_update_message ();	
		redirect('general/drivers');
	}
	
	/*
	 * guides
	 */
	function guides(){
		$operation_data ['data'] = $this->input->post ();
		$read_ops = $this->input->get ();
		if (valid_array ( $operation_data ['data'] ) == true) {
			#debug($operation_data ['data']) ; exit;
			$this->current_page->set_auto_validator ();
			if ($this->form_validation->run ()) {	
				
				Provab_Page_Loader::clean_form_id ( $operation_data ['data'] );
				
				$origin = $this->packages_model->save_guide( $operation_data ['data'], $operation_data ['data'] ['origin'] );
				
				if (intval ( $operation_data ['data'] ['origin'] ) > 0) {
					// set message
					set_update_message ();
				} elseif (intval ( $operation_data ['data'] ['origin'] ) == 0) {
					set_insert_message ();
				}
				redirect ( 'general/guides?' . get_current_pageid () );
			}
		}
		elseif (isset ( $read_ops ['eid'] ) == true and intval ( $read_ops ['eid'] ) > 0) 
		{
			$result = $this->packages_model->get_guides ( $read_ops ['eid'] );
		
			if ($result != FALSE) 
			{
				$operation_data ['data'] = $result[0];
			}
			 else 
			{
				redirect ('general/guides?' . get_current_pageid ());
			}
		}
		$operation_data ['data_list'] = $this->packages_model->get_guides (0,$this->entity_user_id);
		#debug($operation_data ['data_list']); exit;
		$this->template->view('general/guides',$operation_data);
	}
	
	
	/**
	 * Activate guides
	 */
	function activate_guides($origin)
	{
		$data = array('status' => ACTIVE);
		$cond['origin'] = $origin;
		$this->custom_db->update_record('guides',$data, $cond);
		set_update_message ();	
		redirect('general/guides');
	}
	
	/**
	 * Deactiavte guides
	 */
	function deactivate_guide($origin)
	{
		$data = array('status' => INACTIVE);
		$cond['origin'] = $origin;
		$this->custom_db->update_record('guides',$data, $cond);	
		set_update_message ();	
		redirect('general/guides');
	}
	/*
	 * Drivers & guides ends here----->>>
	 */
	
	function edit_markup($id) {
		$value = $this->input->post();
		if (valid_array ( $value )) {
			$operation_data['payment_type'] = $value['payment_type'];
			$operation_data['value'] = $value['markup_value'];
			$id = $value['origin'];
			$cond = array(
				"origin" => $id	
			);
			$this->custom_db->update_record ( 'markup', $operation_data, $cond );
		}
		$cond = array(
			"origin" => $id	
		);
		$markup = $this->packages_model->get_markup($cond);
		$data['r'] = $markup;
		$this->template->view('packages/edit_markup', $data);
	}	
	/**
	 * Activate markup
	 */
	function activate_markup($condition)
	{
		$status = ACTIVE;
		$this->packages_model->update_markup($status, $condition);
		set_update_message ();	
		redirect('general/markup');
	}
	
	/**
	 * Deactiavte markup
	 */
	function deactivate_markup($condition)
	{
		$status = INACTIVE;
		$this->packages_model->update_markup($status, $condition);
		set_update_message ();	
		redirect('general/markup');
	}

	
	
	/**
	 * Logout function for logout from account and unset all the session variables
	 */
	function initilize_logout() {
		if (is_logged_in_user()) {
			$this->user_model->update_login_manager($this->session->userdata(LOGIN_POINTER));
			$this->session->unset_userdata(array(AUTH_USER_POINTER => '',LOGIN_POINTER => '', DOMAIN_AUTH_ID => '', DOMAIN_KEY => ''));
			redirect('general/index');
		}
	}
	/**
	 * oops page of application will be loaded here
	 */
	public function ooops()
	{
		$this->template->view('utilities/404.php');
	}

	public function pre_register_supplier()
	{		
		$page_data['body'] = $this->template->isolated_view('general/pre_register_supplier');
		$this->template->view('template_v2', $page_data);
	}
	
	public function complete_profile()
	{
		$supplier_origin = $this->session->userdata(AUTH_USER_POINTER);
		$data = $this->suppliers_model->check_supplier_email_verified($supplier_origin); 
		if($data['status']){
			$page_data['email_verified'] = $data['data'][0]['email_verified'];			
		}
		$data['personal_details'] = $this->suppliers_model->get_personal_details($supplier_origin);
		$data['company_details'] = $this->suppliers_model->get_company_details($supplier_origin);
		$data['bank_details'] = $this->suppliers_model->get_bank_details($supplier_origin);
		$data['operational_cities'] = $this->suppliers_model->get_operational_cities($supplier_origin);		
		$data['category_details'] = $this->suppliers_model->get_category_details($supplier_origin);   
		#debug($page_data);exit;
		$page_data['body'] = $this->template->isolated_view('general/complete_profile',$data);
		echo $this->template->isolated_view('template_v2',$page_data);
	}
	
	public function verify_mail() {
		$origin = $this->input->get('ref_id');
		if($origin != '')
		{
			$origin = base64_decode($origin);
			if(intval($origin) > 0){
				$data = array();
				$data['qry_status'] = $this->suppliers_model->save_simple_supplier_login($data, $origin);
				header('Location: '.base_url().'general/index?email_verified='.urlencode($data['qry_status']));
			}
		}		
	}
	
	public function profile_completed()
	{
		$operation_data = $this->input->post();
		if(empty($operation_data) == false && intval($operation_data['accept_agreement']) == 1 )
		{
			$supplier_origin = $this->session->userdata(AUTH_USER_POINTER);
			$this->suppliers_model->update_supplier_profile_completed($supplier_origin); 
			redirect('general/index');
			
		}	
	}
	
	public function insert_city()
	{
		$city_data = $this->custom_db->single_table_records('city_list','*');		
		$i = 1;
		$this->db->select_max('id');
		$query = $this->db->get('city_list');
		$max_no = $query->result_array();		
		foreach($city_data['data'] as $city)
		{
			$id = $max_no[0]['id']+$i;
			$data = array(
				'id' => $id,
				'name' => $city['destination'],
				'country_id' => $city['country'],
				'api_country_id' => $city['api_country_id']
			);
			$insert_data = $this->custom_db->insert_record('city_list',$data);
			$i++;
			debug($insert_data);			
		}
	}

	public function delete_city()
	{
		
	}


	function vehicles()
	{
		$operation_data ['data'] = $this->input->post();
		$read_ops = $this->input->get ();
		if(valid_array($operation_data ['data']) == true)
		{
			$this->current_page->set_auto_validator ();
			Provab_Page_Loader::clean_form_id ( $operation_data ['data'] );
			if($this->form_validation->run ())
			{
				$operation_data ['data']['created_by_origin'] = intval($this->entity_user_id);
				$response = $this->meta_data->save_vehicles($operation_data ['data']);

				if(intval ( $operation_data ['data'] ['origin'] ) > 0){
					set_update_message ();
				}elseif( $operation_data ['data'] ['origin'] == 0){
					set_insert_message ();
				}

			}
		}elseif(isset ( $read_ops ['eid'] ) == true and intval ( $read_ops ['eid'] ) > 0)
		{
			$vehicle_list = $this->meta_data->get_vehicles_list($read_ops ['eid']);
			$operation_data['data'] = $vehicle_list['data'][0];
		}
		$vehicle_list = $this->meta_data->get_vehicles_list(0,$this->entity_user_id);
		if($vehicle_list['status'] == QUERY_SUCCESS){
		$operation_data['table_data']  = $vehicle_list['data'];
		}
		$this->template->view('general/vehicles',$operation_data);
	}

	function delete_vehicle()
	{
		if($_POST)
		{
			$origin = $this->input->post('origin');
			$cond['origin'] = $origin;
			$this->custom_db->delete_record('vehicles',$cond);			
			set_update_message ();	
		}
	}
}
