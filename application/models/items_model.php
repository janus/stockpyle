<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Items_model extends CI_Model {
	private $table_name = 'item';
	private $table_category_name = 'item_category';
	function __construct() {
		parent::__construct();
	}

	function get_by_id($item_id) {
		$this->db->where('id', $item_id);

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return FALSE;
	}

	function count($user_id) {
		$this->db->where('user_id', $user_id);
		$this->db->from($this->table_name);
		return $this->db->count_all_results();
	}

	function add($data) {
		if ($this->db->insert($this->table_name, $data)) {
			return $this->db->insert_id();
		} else {
			return 0;
		}
	}

	function delete_by_id($item_id) {
		$this->db->where('id', $item_id);
		$this->db->where('user_id', $this->tank_auth->get_user_id());
		$query = $this->db->delete($this->table_name);
		return $this->db->affected_rows();
	}

	function get_all($user_id, $page = 0, $count = FALSE) {
		$this->db->select("{$this->table_name}.*, {$this->table_category_name}.name AS category_name");
		$this->db->from($this->table_name);
		$this->db->where('user_id', $user_id);
		$this->db->limit($count, $page);
		$this->db->join($this->table_category_name, "{$this->table_category_name}.id = {$this->table_name}.{$this->table_category_name}_id");
		$this->db->order_by("purchased", "desc");
		$query = $this->db->get();
		#echo $this->db->last_query();
		if ($query->num_rows() >= 1) return $query->result();
		return FALSE;
	}

	function get_category_name_by_id($category_id) {
		$this->db->select('name');
		$this->db->where('id', $category_id);
		$query = $this->db->get($this->table_category_name);
		if ($query->num_rows() == 1) {
		   $row = $query->row();
		   return $row->name;
		} else {
			return FALSE;
		}
	}

	function get_category_dropdown() {
		$dropdown = <<<EOD
<select name="category">
	<option value="7">Appliances</option>
	<option value="4">Books</option>
	<option value="3">Clothing</option>
	<option value="2">Computers</option>
	<option value="1">Electronics</option>
	<option value="6">Furniture</option>
	<option value="5">Music</option>
</select>
EOD;
		return $dropdown;
	}
}