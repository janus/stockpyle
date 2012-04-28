<script type="text/javascript" src="<?=base_url()?>scripts/jquery.form.js"></script>
<script type="text/javascript">
	$(function() {
		$('#add_icon').click(function() {
			$('#add_item').fadeIn('slow');
		});
		$('#cancel_icon').click(function() {
			$('#add_item').fadeOut('slow');
		});
		init_delete_buttons();
		zebra_table();
		init_calendar();
		$('#add_item_form').ajaxForm(function(response) {
			if (response != '0') {
				$("#inventory-listing").append(response);
				$('#add_item input').val('');
				$('#add_item').fadeOut('fast');
				init_delete_buttons();
				zebra_table();
				init_calendar();
			} else {
				alert("There was an error adding this item!");
				console.log(response);
			}
		});
	});
function init_delete_buttons() {
	$('.delete_icon').click(function(event) {
		var itemId = $(event.currentTarget).attr('data-item-id');
		var itemRow = $(event.currentTarget).parents('tr');
		$.get('inventory/delete/'+itemId, function(data) {
			if (data == '1') {
				itemRow.remove();
				zebra_table();
			} else {
				alert("There was an error removing this item!");
			}
		});
	});
}

function zebra_table() {
	$('.inventory tr:even').removeClass('odd').addClass('even');
	$('.inventory tr:odd').removeClass('even').addClass('odd');
}

function init_calendar() {
	$('.calendar').datepicker({
		dateFormat: 'yy-mm-dd'
	});
}
</script>
<div id="pagination"><?=$pagify?></div>
<table width="100%" class="inventory" id="inventory-listing">
	<colgroup width="32" />
	<colgroup width="298" />
	<colgroup width="220" />
	<colgroup width="120" />
	<colgroup width="80" />
	<colgroup width="80" />
	<colgroup width="130" />
	<tr>
		<th class="align-center first"><img src="images/add.png" id="add_icon" alt="Add" /></th>
		<th class="align-left">Name</th>
		<th class="align-center">Category</th>
		<th class="align-center">Purchase Date</th>
		<th class="align-center">Qty</th>
		<th class="align-right">Value</th>
		<th class="align-center last">Picture</th>
	</tr>
	<tr id="add_item">
		<form id="add_item_form" action="inventory/add" method="post">
			<td class="align-center first"><img src="images/cancel.png" id="cancel_icon" alt="Cancel" /></td>
			<td class="align-left"><input name="name" /></td>
			<td class="align-center"><?=$category_dropdown?></td>
			<td class="align-center"><input name="purchased" size="10" maxlength="10" value="2010-12-18" class="calendar" /></td>
			<td class="align-center"><input name="quantity" size="2" maxlength="3" /></td>
			<td class="align-right">$<input name="value" size="5" maxlength="6" /></td>
			<td class="align-center last">N/A</td>
			<input type="submit" style="display: none;" />
		</form>
	</tr>
<?php if ($inventory) { ?>
<?php foreach ($inventory AS $item) { ?>
	<tr>
		<td class="align-center first"><img src="images/delete.png" class="delete_icon" alt="Delete" data-item-id="<?=$item->id?>" /></td>
		<td class="align-left"><?=$item->name?></td>
		<td class="align-center"><?=$item->category_name?></td>
		<td class="align-center"><?=date('M j, Y', strtotime($item->purchased))?></td>
		<td class="align-center"><?=$item->quantity?></td>
		<td class="align-right">$<?=$item->value?></td>
		<td class="align-center last">N/A</td>
	</tr>
<?php } ?>
<?php } ?>
</table>
<div id="pagination"><?=$pagify?></div>