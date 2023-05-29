function register(){
    $(document).ready(function() {
        $('#registerForm').submit(function(event) {
          event.preventDefault(); // Prevent the form from submitting normally
          var formData = $(this).serialize(); // Serialize the form data
          if($(pass1).val()==$(pass2).val() && $(checkbox).prop('checked')){
              $.ajax({
                  url: 'controller/functions.php',
                  method: 'POST',
                  data: formData,
                  success: function(response) {
                      // Handle successful response from server
                      // var res = JSON.parse(response);
                                //   alert(response)
                                  if(response==2){
                                    $('#registerForm input, #registerForm textarea').val('');
                                    alert('Success Registration')
                                  }else if(response==1){
                                    alert('Failed Registration')
                                  }else if(response==3){
                                    alert('Choose another email')
                                  }
                  },
                  error: function(xhr, status, error) {
                      // Handle errors from server
                      console.log('Server error:', error);
                  }
                  });
          }else{
              alert('Password not match or Terms and conditions is not checked')
          }
        });
      });
}
function login(){
    $(document).ready(function() {
        $('#loginForm').submit(function(event) {
          event.preventDefault(); // Prevent the form from submitting normally
          var formData = $(this).serialize(); // Serialize the form data
              $.ajax({
                  url: 'controller/functions.php',
                  method: 'POST',
                  data: formData,
                  success: function(response) {
                      // Handle successful response from server
                      // var res = JSON.parse(response);
                                //   alert(response)
                                  if(response==2){
                                    alert('Success Login')
                                    window.location="admin/"
                                  }else if(response==1){
                                    alert('Success Login')
                                    window.location="checker/"
                                  }else if(response==0){
                                    alert('Success Login')
                                    window.location="branch/"
                                  }else if(response==3){
                                    alert('Failed Login')
                                  }
                  },
                  error: function(xhr, status, error) {
                      // Handle errors from server
                      console.log('Server error:', error);
                  }
                  });
      
        });
      });
}