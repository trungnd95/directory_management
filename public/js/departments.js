$(document).ready(function(){
   //Edit department
    $('.edit-department').on('click',function(e){
        var id = $(this).attr('val');
        e.preventDefault();
        $(this).parent().parent().parent().hide();
        $('.edit-depart-'+id).removeClass('hidden');
        $('.save-edit-'+ id).click(function(){
            
            var url           = '/departments/edit/' + id;
            var token         = $('#form-index-department').find("input[name='_token']").val();
            var name          = $(this).parent().parent().find("input[name='name']").val();
            var office_phone  = $(this).parent().parent().find("input[name='office_phone']").val();
            var office_code   = $(this).parent().parent().find("input[name='office_code']").val();
            var manager       = $(this).parent().parent().find("input[name='manager']").val();
            //send ajax 
            $.ajax({
                url:url,
                type: 'GET',
                dataType : 'JSON',
                cache : false,
                data : {'token':token, 'name': name,'office_phone':office_phone, 'office_code':office_code,'manager':manager},
                success: function(result) {
                    console.log(result);
                    // var office_name = result.name + '<div class="show-edit-delete"><a href="javascript:void(0)" class="edit-department" val="' + result.id + '">Edit</a>';
                    // office_name += '| <a style="color: red; cursor: pointer;" data-toggle="modal" data-target="">Delete</a>' ;
                    $('.save-edit-'+ result.id).parent().parent().addClass('hidden');
                    $('.td-data-' + result.id).show();
                    $('.td-data-' + result.id).find('.department-name').find('span').html(result.name);
                    $('.td-data-' + result.id).find('.office_phone').html(result.office_phone);
                    $('.td-data-' + result.id).find('.office_code').html(result.office_code);
                    $('.td-data-' + result.id).find('.manager').html(result.manager);
                    swal("Success!","Edited!" , 'success');
                    return false;
                },
                error: function(err) {
                    sweetAlert("Errors", "Something went wrong!", "error");  
                }
            }); 
        });
    });

    //Delete department
    $('#modal-delete-department').on('show.bs.modal', function(e) {
      var id = $(e.relatedTarget).data('id');
      $(this).find('.confirm_del_department').data('id', id);
    });
    $('.confirm_del_department').on('click',function(){
        $("#modal-delete-department").modal('hide').delay('500');
        id =  $(this).data('id');
        var url = "/departments/delete/" + id;
        var token = $('#form-index-department').find("input[name='_token']").val();
        $.ajax({
          url: url,
          type: 'GET',
          dataType: 'JSON',
          cache : false,
          data : {'id':id, '_token':token},
          success: function (result){

            $('.delete-department-'+result).parent().parent().parent().hide();
            swal("Success!","Deleted!" , 'success');
          },
          error: function(err) {
            sweetAlert("Oops...", "Something went wrong!", "error");
          }
        });
    })

    //pass information to modal view detail department
    $('#modal-view-department').on('show.bs.modal',function(e){
        /**
         * Pass value of department to modal
         */
        //Pass name value
        var department_name =  $(e.relatedTarget).attr('department-name');
        $(this).find('.modal-body').find('.department-name').text(department_name);
        //Pass phone value
        var office_phone = $(e.relatedTarget).attr('office-phone');
        $(this).find('.modal-body').find('.department-phone').text(office_phone);
        //Pass office value
        var office_code = $(e.relatedTarget).attr('office-code');
        $(this).find('.modal-body').find('.department-code').text(office_code);
        //Pass manager value
        var manager = $(e.relatedTarget).attr('manager');
        $(this).find('.modal-body').find('.department-manager').text(manager);
        //Pass address value
        var address = $(e.relatedTarget).attr('address');
        $(this).find('.modal-body').find('.department-address').text(address);
        //Pass email contact value
        var email_contact = $(e.relatedTarget).attr('email-contact');
        $(this).find('.modal-body').find('.department-email').text(email_contact);
    });
})
//End of file