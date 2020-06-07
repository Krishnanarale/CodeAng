<?php 
/**
 * 
 */
class EmployeeModel extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	public function store($data) {
		return $this->db->insert('employees', $data);
	}

	public function get() {
		return $this->db->get('employees');
	}

	public function getById($id) {
		$this->db->select();
		$this->db->from('employees');
		$this->db->where('id', $id);
		return $this->db->get();
	}

	public function update($data, $id) {
		$this->db->where('id', $id);
		return $this->db->update('employees', $data);
	}

	public function delete($id) {
		return $this->db->delete('employees', array('id' => $id));
	}
}