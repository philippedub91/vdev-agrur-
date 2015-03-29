// autocomplet : this function will be executed every time we change the text
function autocomplet() {
	var min_length = 0; // min caracters to display the autocomplete
	var keyword = $('#txt_commune').val();
	if (keyword.length >= min_length) {
		$.ajax({
			url: '../src/atcp_refresh_commune.php',
			type: 'POST',
			data: {keyword:keyword},
			success:function(data){
				$('#lst_commune').show();
				$('#lst_commune').html(data);
			}
		});
	} else {
		$('#lst_commune').hide();
	}
}

// set_item : this function will be executed when we select an item
function set_item(item) {
	// change input value
	$('#txt_commune').val(item);
	// hide proposition list
	$('#lst_commune').hide();
}