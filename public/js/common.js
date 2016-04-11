$(document).ready(function(){
	//Upload image avatar
    File.prototype.convertToBase64 = function(callback){
      var FR= new FileReader();
      FR.onload = function(e) {
       callback(e.target.result)
     };       
     FR.readAsDataURL(this);
   }
   $("#image").on('change',function(){
    var selectedFile = this.files[0];
    selectedFile.convertToBase64(function(base64){
      // alert(base64);
      html = '<div class="row">';
      html += '<div class="col-xs-6 col-md-3">';
      html += '<a href="#" class="thumbnail" id="display-img">';
      html += '<img src="'+base64+'" class="img-avata-upload" />';
      html += '</a>';
      html += '</div>';
      html += '</div>';
      $('#display-img').html(html);
    }); 
  });

   $('.alert-success').delay(4000).slideUp('slow');
   // $('input').iCheck({
   //    checkboxClass: 'icheckbox_square-blue',
   //    radioClass: 'iradio_square-blue',
   //    increaseArea: '20%' // optional
   //  });
})