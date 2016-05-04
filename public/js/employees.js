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
        var url = "/employees/delete/" + id;
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

    /**
     * Ajax search employee
     */
     var delay = (function(){
      var timer = 0;
      return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
      };
    })();

    $("#search-employee").keyup(function(event) {
        delay(function(){
            var _token = $("#form-index-employee").find("input[name='_token']").val();
            var key_search  = $("#search-employee").val();
            var department_search =  $('#search-department').val();
            var url =  "/employees/search-ajax/result";
            $.ajax({
                url : url,
                type: "GET",
                dataType: "JSON",
                cache:false,
                data: {'key_search': key_search,'department_search':department_search},
                success: function(data){  
                    $('.ajax-result').html(data);
                },
                error: function(){

                }
            });
        }, 100 );
    });

    $('#search-department').change(function(){
        var _token = $("#form-index-employee").find("input[name='_token']").val();
       var url =  "/employees/search-ajax/result";
       var department_search = $(this).val();
       var key_search  = $("#search-employee").val();
       $.ajax({
                url : url,
                type: "GET",
                dataType: "JSON",
                cache:false,
                data: {'key_search': key_search,'department_search':department_search},
                success: function(data){  
                    $('.ajax-result').html(data);
                },
                error: function(){

                }
            });
    })
});