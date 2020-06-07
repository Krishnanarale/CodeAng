<?php 
/**
 * Class for handling employees opration
 */
class Employees extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('EmployeeModel');	
	}

	public function index() {
		$this->load->view('listingOfEmployee');
	}

	public function AddEmployee() {
		$this->load->view('home');
	}

	public function uploadFile() {
		$this->load->view('fileUpload');
	}

	public function store() {
		$post = file_get_contents("php://input");
		$obj = json_decode($post);
		print_r($obj);
		die();
		$data = array(
			'firstName' => $obj->firstName,
			'lastName' => $obj->lastName,
			'gender' => $obj->gender,
			'dateOfBirth' => $obj->dateOfBirth,
			'email' => $obj->email,
			'phone' => $obj->phone,
		);
		$result = $this->EmployeeModel->store($data);
		if ($result) {
			$response = array(
				'status' => 'success',
				'data' => ''
			);
		} else {
			$response = array(
				'status' => 'filed',
				'data' => $result
			);
		}
		die(json_encode($response));
	}

	public function getEmployee() {
		$result = $this->EmployeeModel->get();
		if ($result) {
			$response = array(
				'status' => 'success',
				'data' => $result->result_array()
			);
		} else {
			$response = array(
				'status' => 'filed',
				'data' => $result
			);
		}
		die(json_encode($response));	
	}

	public function getEmployeeById() {
		$post = file_get_contents("php://input");
		$obj = json_decode($post);
		$result = $this->EmployeeModel->getById($obj->id);
		if ($result) {
			$response = array(
				'status' => 'success',
				'data' => $result->result_array()
			);
		} else {
			$response = array(
				'status' => 'filed',
				'data' => $result
			);
		}
		die(json_encode($response));	
	}

	public function updateEmployee() {
		$post = file_get_contents("php://input");
		$obj = json_decode($post);
		$data = array(
			'firstName' => $obj->firstName,
			'lastName' => $obj->lastName,
			'gender' => $obj->gender,
			'dateOfBirth' => $obj->dateOfBirth,
			'email' => $obj->email,
			'phone' => $obj->phone,
		);
		$result = $this->EmployeeModel->update($data, $obj->id);
		if ($result) {
			$response = array(
				'status' => 'success',
				'data' => ''
			);
		} else {
			$response = array(
				'status' => 'filed',
				'data' => $result
			);
		}
		die(json_encode($response));
	}

	public function deleteEmployee() {
		$post = file_get_contents("php://input");
		$obj = json_decode($post);
		$result = $this->EmployeeModel->delete($obj->id);
		if ($result) {
			$response = array(
				'status' => 'success',
				'data' => ''
			);
		} else {
			$response = array(
				'status' => 'filed',
				'data' => $result
			);
		}
		die(json_encode($response));
	}

	public function file() {
		print_r($_FILES); 
		print_r($_POST); 
		die();
	}
}