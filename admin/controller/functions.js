function AddingDetails($form){
    $(document).ready(function() {
        $($form).submit(function(event) {
          event.preventDefault(); // Prevent the form from submitting normally
          var formData = $(this).serialize(); // Serialize the form data
              $.ajax({
                  url: 'controller/functions.php',
                  method: 'POST',
                  data: formData,
                  success: function(response) {
                      // Handle successful response from server
                      // var res = JSON.parse(response);
                                  // console.log(response)
                                  if(response==2){
                                    alert('Success')
                                  location.reload()

                                  }else if(response==1){
                                    alert('Failed')
                                  }else if(response==3){
                                    alert('Error')
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

