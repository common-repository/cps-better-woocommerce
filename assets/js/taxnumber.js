jQuery(document).ready(function($){
	$('#billing_company').keyup(function() {
		if( $(this).val().length == 0 ) {
			$('#billing_tax_number_field').hide();
			if(! $("#billing_tax_number").val() ){
				$('#billing_tax_number').val("- N/A -");
			}
		} else {
			$('#billing_tax_number_field').show();
			if( $("#billing_tax_number").val() == "- N/A -" ){
				$('#billing_tax_number').val("");
			}
		}
	}).keyup();
});
