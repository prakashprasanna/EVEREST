var timeoutAdmi;
$('#admi').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(timeoutAdmi);
    timeoutAdmi = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_admi();
    }, 1000);
});

                          function saveToDB_admi()
                          {
                            console.log('Saving to the db');
                            form = $('.admi-form');
                        	$.ajax({
                 		url: "update/sendToAdmissions",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-admi').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var dAdmi = new Date();
                           $('.form-status-admi').html('App sent to Admissions! Last: ' + dAdmi.toLocaleTimeString());
                       window.location.reload();                
         		    },
                           });

                        }


                         $('.admi-form').submit(function(e) {
                        	saveToDB_admi();
                        	e.preventDefault();
                         });