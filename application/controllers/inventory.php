<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inventory extends CI_Controller {
	function __construct() {
		parent::__construct();
		if (!$this->tank_auth->is_logged_in()) {
			redirect('login');
		}
		$this->page_data['logged_in'] = TRUE;
		$this->page_data['title'] = 'Browse Inventory';
		$this->page_data['promo'] = FALSE;
		$this->load->model('items_model');
	}

	function index() {
		redirect('inventory/browse');
	}

	function browse($offset = 0) {
		$this->load->library('pagination');
		$config['base_url'] = base_url() . "inventory/browse";
		$config['total_rows'] = $this->items_model->count($this->tank_auth->get_user_id());
		$config['per_page'] = '20';
		$config['full_tag_open'] = 'Page: ';
		$this->pagination->initialize($config);
		$this->page_data['pagify'] =  $this->pagination->create_links();

		$this->page_data['inventory'] = $this->items_model->get_all($this->tank_auth->get_user_id(), $offset, $config['per_page']);
		$this->page_data['category_dropdown'] = $this->items_model->get_category_dropdown();

		$this->load->view('page-top', $this->page_data);
		$this->load->view('app/browse', $this->page_data);
		$this->load->view('page-bottom', $this->page_data);
	}

	function delete($item_id) {
		if ($this->items_model->delete_by_id($item_id)) {
			echo "1";
		} else {
			echo "0";
		}
	}

	function add() {
		$data['name'] = htmlentities($this->input->post('name'));
		$data['item_category_id'] = $this->input->post('category') + 0;
		$data['quantity'] = $this->input->post('quantity') + 0;
		$data['value'] = $this->input->post('value') + 0;
		$data['purchased'] = htmlentities($this->input->post('purchased'));
		$data['user_id'] = $this->tank_auth->get_user_id() + 0;
		$result = $this->items_model->add($data);
		if ($result) {
?>
	<tr>
		<td class="align-center first"><img src="images/delete.png" class="delete_icon" alt="Delete" data-item-id="<?=$result?>" /></td>
		<td class="align-left"><?=$data['name']?></td>
		<td class="align-center"><?=$this->items_model->get_category_name_by_id($data['item_category_id'])?></td>
		<td class="align-center"><?=date('M j, Y', strtotime($data['purchased']))?></td>
		<td class="align-center"><?=$data['quantity']?></td>
		<td class="align-right">$<?=$data['value']?></td>
		<td class="align-center last">N/A</td>
	</tr>
<?php
		} else {
			echo "0";
		}
	}
}