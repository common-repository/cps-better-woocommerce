jQuery(document).ready(function($){

	$("#billing_company_check_field label span").hide();

	if( $('#billing_company_check').prop("checked" ) == false){
		$("#billing_company_field").hide();
		if(! $("#billing_company").val() ){
			$('#billing_company').val("- N/A -");
		}
		$("#billing_tax_number_field").hide();
		if(! $("#billing_tax_number").val() ){
			$('#billing_tax_number').val("- N/A -");
		}
	}

	$('#billing_company_check').click(function(){
		if($(this).prop("checked") == true){
			if( $("#billing_company").val() == "- N/A -" ){
				$('#billing_company').val("");
			}
			$("#billing_company_field").show();
			if( $("#billing_tax_number").val() == "- N/A -" ){
				$('#billing_tax_number').val("");
			}
			$("#billing_tax_number_field").show();
		}
		else if( $(this).prop("checked") == false ){
			$("#billing_company_field").hide();
			if(! $("#billing_company").val() ){
				$('#billing_company').val("- N/A -");
			}
			$("#billing_tax_number_field").hide();
			if(! $("#billing_tax_number").val() ){
				$('#billing_tax_number').val("- N/A -");
			}
		}
	});

});
