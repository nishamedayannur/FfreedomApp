<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){

		parent::__construct();
		error_reporting(0);
		$this->load->library("session");
    	$this->load->helper('url');
		// Load model
		$this->load->model('Employee');
	}

	public function index()
	{
		//$this->load->view('welcome_message');
		$data['employees'] = $this->Employee->get_employees_list();
		$data['roles']['vp'] = $this->Employee->get_employees_list_by_role('vp');
		$data['roles']['avp'] = $this->Employee->get_employees_list_by_role('avp');
		$data['roles']['manager'] = $this->Employee->get_employees_list_by_role('manager');
		$data['roles']['team_leader'] = $this->Employee->get_employees_list_by_role('team leader');
		//echo "<pre>";print_r($data);die;
		$this->load->view('employees_list', $data);
	}

	function get_filter()
	{
		$input = $_POST['value'];
		//echo "<pre>";print_r($data);die;
		$employees = $this->Employee->get_filter_list($input);
		//echo $this->db->last_query();die;
		//echo "<pre>";print_r($employees);die;
		$table = "";
		foreach($employees as $row)
		{
			//echo "<pre>";print_r($row);die;
			$status = ($row->status == 1) ? 'Active' : 'In-Active';
			$table .= "<tr>";
			$table .= "<td>".$row->id."</td>";
			$table .= "<td>".$row->name."</td>";
			$table .= "<td>".$row->role."</td>";
			$table .= "<td>".$row->date."</td>";
			$table .= "<td>".$status."</td>";
			$table .= "</tr>";
		}
		echo json_encode($table);
	}

	function get_rep_emp()
	{
		$input = $_POST['value'];
		//echo "<pre>";print_r($data);die;
		$employees = $this->Employee->get_rep_emp($input);
		//echo $this->db->last_query();die;
		//echo "<pre>";print_r($employees);die;
		$table = $this->buildRow($employees);
		echo json_encode($table);
	}
	function buildRow($employees)
	{
		if(isset($employees) && $employees != '')
		{
			$table = "";
			foreach($employees as $key => $row)
			{
				//echo "<pre>";print_r($row);die;
				$status = ($row['status'] == 1) ? 'Active' : 'In-Active';
				$table .= "<tr>";
				$table .= "<td>".$row['id']."</td>";
				$table .= "<td>".$row['name']."</td>";
				$table .= "<td>".$row['role']."</td>";
				$table .= "<td>".$row['date']."</td>";
				$table .= "<td>".$status."</td>";
				$table .= "</tr>";
				
				if(isset($row['children']) && sizeof($row['children']))
				{
					$table .= $this->buildRow($row['children']);
				}
			}
		}
		return $table;
	}

	function change_status()
	{
		$input = $_POST['value'];
		$status = $_POST['status'];
		$this->Employee->change_status($input, $status);
	}
}
