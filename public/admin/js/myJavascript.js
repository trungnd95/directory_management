
$("div.alert").delay(5000).slideUp();

$("#deleteCategory").click(function() {
});

function xacnhanxoa(msg) {
	if(window.confirm(msg)) {
		return true;
	} return false;
}
$(document).ready(function() {	    
    $('[name="checkAll"]').on('ifChecked', function(event){
    	$('[name="items[]"], [name="checkAll"]').iCheck('check');
	});

    $('[name="checkAll"]').on('ifUnchecked', function(event){
    	$('[name="items[]"], [name="checkAll"]').iCheck('uncheck');
	});
    
});
//$(document).ready(function () {
//	$(".showAc").hover(					
//		function() {
//			abc = $(":parent");
//			console.log(abc);
//			$("div:hidden").show();
//		}, function() {
//			$("div.show-hide").hide();
//		}
//	);
//});