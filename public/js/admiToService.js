var timeoutAdToSer;
$('#admi1').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(timeoutAdToSer);
    timeoutAdToSer = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_adtoser();
    }, 1000);
});

                          function saveToDB_adtoser()
                          {
                            console.log('Saving to the db');
                            form = $('.admi1-form');
                        	$.ajax({
                 		url: "update/admissionsToService",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-admi1').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var dAdmi1 = new Date();
                           $('.form-status-admi1').html('App sent back to Service! Last: ' + dAdmi1.toLocaleTimeString());
                       window.location.reload();                
         		    },
                           });

                        }


                         $('.admi1-form').submit(function(e) {
                        	saveToDB_adtoser();
                        	e.preventDefault();
                         });