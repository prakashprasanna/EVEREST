var timeoutId0;
$('#dob0').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(timeoutId0);
    timeoutId0 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB0();
    }, 1000);
});

                          function saveToDB0()
                          {
                            console.log('Saving to the db');
                            form = $('.dob-form');
                        	$.ajax({
                 		url: "update/dob0",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-dob').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var d0 = new Date();
                           $('.form-status-dob').html('Saved! Last: ' + d0.toLocaleTimeString());
         		    },
                           });
                        }


                         $('.dob-form').submit(function(e) {
                        	saveToDB0();
                        	e.preventDefault();
                         });