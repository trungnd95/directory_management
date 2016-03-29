$(document).ready(function(){
	/**
   * Delete employee
   */
    $('#modal-delete-employee').on('show.bs.modal', function(e) {
      var id = $(e.relatedTarget).data('id');
      $(this).find('.confirm_del_employee').data('id', id);
    });
    $('.confirm_del_employee').on('click',function(){
        $("#modal-delete-employee").modal('hide').delay('500');
        id =  $(this).data('id');
        var url = "http://directory.dev/employees/delete/" + id;
        var token = $('#form-index-employee').find("input[name='_token']").val();
        $.ajax({
          url: url,
          type: 'GET',
          dataType: 'JSON',
          cache : false,
          data : {'id':id, '_token':token},
          success: function (result){

            $('.delete-employee-'+result).parent().parent().hide();
            swal("Success!","Deleted!" , 'success');
          },
          error: function(err) {
            sweetAlert("Oops...", "Something went wrong!", "error");
          }
        });
    });
});