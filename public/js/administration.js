$(document).ready(function(){
	//Validate email . If email not true , it show errror and forbid add user . otherwise, everything ok 
	$("input[name='add-email']").on('blur',function(){
		var email = $(this).val();
		if(!isEmail(email)) {
			$('.err-email').removeClass('hidden');
			$('#add-admin').hide();
		} else {
			$('.err-email').addClass('hidden');
			$('#add-admin').show();
		}
		
	});

	//Validate email . If username is blank, less than 5 characters, or more then 20 characters. it show errror and forbid add user . otherwise, everything ok 
	$("input[name='add-username']").on("blur",function(){
		var username = $(this).val();
		var lengthUser  = username.length;
		if(lengthUser == 0) {
			$('.err-username').removeClass("hidden");
			$('.err-username span').html('Username is required field');
			$('#add-admin').hide();
		} else if(lengthUser < 5 ) {
			$('.err-username').removeClass("hidden");
			$('.err-username span').html('Username is at least 5 characters');	
			$('#add-admin').hide();
		} else if(lengthUser > 20 ) {
			$('.err-username').removeClass("hidden");
			$('.err-username span').html('Username is less than 20 characters');
			$('#add-admin').hide();	
		} else {
			$('.err-username').addClass("hidden");
			$('#add-admin').show();
		}

	});

	//When admin click event. Add user using ajax and save to database
	$('#add-admin').on('click',function(){
		var level = $('#add-ad').find("select[name='add-level']").val();
		//If level not choosed. Show error. 
		if(!level) {
			$('.err-level').removeClass('hidden');
		}else {
			$('.loading').removeClass('hidden');
			//Else Send ajax
			$("#modal-id-1").modal('hide').delay('500');
			var url = "http://directory.dev/administration/add";
			var token = $('#add-ad').find("input[name='_token']").val();
			var username = $('#add-ad').find("input[name='add-username']").val();
			var email = $('#add-ad').find("input[name='add-email']").val();

			//After add user. Set default for form data	
			$('#add-ad').find("input[name='add-email']").val('');
			$('#add-ad').find("input[name='add-username']").val('');
			$('#add-ad').find("select[name='add-level']:first-child").find('option:first-child').attr('selected');

			
			//Send ajax
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'JSON',
				data: {'username':username, 'email':email, '_token':token, 'level':level},
				cache : false,
				success: function(result){
					console.log(result.id);
					$('.loading').addClass('hidden');
					var str = '<tr><td>'+result.id+'</td><td><img src="http://directory.dev/public/upload/images/default-user.png" width="100px" height="100px" /></td><td>'+result.username+'</td><td>'+result.email+'</td><td>'+result.level+'</td>';
					str += '<td><a href="http://directory.dev/administration/edit/'+ result.id +'" class="edit-cart" id=""><img class="tooltip-test edit" data-original-title="Update" '+ 'src="http://directory.dev/public/images/edit.png"' + 'alt=""></a>';
					str += '<a class="delete-admin delete-admin-'+ result.id+'" data-toggle="modal" href="#modal-delete-" data-target="#modal-delete" val="'+ (result.id) +'"><img class="tooltip-test" data-original-title="Remove"  src="http://directory.dev/public/images/remove.png" alt=""></a></td></tr>';
					$('#list-admin').append(str);
					// $('body').append(str1);
					swal("Success!","Added!" , 'success');
					// $('.delete-admin').on('click',function(){
					// 	var id = result.id;
					// 	$('.confirm_del_' + id).on('click',function(){
					// 		$("#modal-id-" + id).modal('hide').delay('500');
					// 		var url = "http://directory.dev/administration/delete/" + id;
					// 		var token = $('#form-index-admin').find("input[name='_token']").val();
					// 		$.ajax({
					// 			url: url,
					// 			type: 'GET',
					// 			dataType: 'JSON',
					// 			cache : false,
					// 			data : {'id':id, '_token':token},
					// 			success: function (result){

					// 				$('.delete-admin-'+result).parent().parent().hide();
					// 				swal("Success!","Deleted!" , 'success');
					// 			},
					// 			error: function(err) {
					// 				sweetAlert("Oops...", "Something went wrong!", "error");
					// 			}
					// 		});
					// 	})
					// });

				},
				error: function(err) {
					console.log(err);
					sweetAlert("Oops...", "Something went wrong!", "error");
					$('.loading').addClass('hidden');
				}


			});
		}
		
		
	});

	//Delete admin using ajax

	// $('.delete-admin').on('click',function(){
		$('#modal-delete').on('show.bs.modal', function(e) {
			var id = $(e.relatedTarget).attr('val');
			$(this).find('.confirm_del').data('id', id);
		});
		$('.confirm_del').on('click',function(){
				$("#modal-delete").modal('hide').delay('500');
				id =  $(this).data('id');
				var url = "http://directory.dev/administration/delete/" + id;
				var token = $('#form-index-admin').find("input[name='_token']").val();
				$.ajax({
					url: url,
					type: 'GET',
					dataType: 'JSON',
					cache : false,
					data : {'id':id, '_token':token},
					success: function (result){

						$('.delete-admin-'+result).parent().parent().hide();
						swal("Success!","Deleted!" , 'success');
					},
					error: function(err) {
						sweetAlert("Oops...", "Something went wrong!", "error");
					}
				});
		})
	// });

	

})

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

