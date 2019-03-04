var timeoutId41;
$('#final41').on('input propertychange change', function() {
    
    clearTimeout(timeoutId41);
    timeoutId41 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB41();
    }, 1000);
});

                          function saveToDB41()
                          {
                            console.log('Saving to the db');
                            form = $('.final41-form');
                        	$.ajax({
                 		url: "update/final_course41",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-holder41').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj41 = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var d41 = new Date();
                           $('.form-status-holder41').html('Saved! Last: ' + d41.toLocaleTimeString());
                       window.location.reload();                
         		    },
                           });
                        }


                         $('.final41-form').submit(function(e) {
                        	saveToDB41();
                        	e.preventDefault();
                         });
