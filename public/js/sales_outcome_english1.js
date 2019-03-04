var ERMCBA;
$('#ERM_CBA').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(ERMCBA);
    ERMCBA = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBERMS();
    }, 1000); 
});

                          function saveToDBERMS()
                          {
                            console.log('Saving to the db');
                            form = $('.ERM-S-form');
                        	$.ajax({
                 		url: "edit/outcome/ERMS",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-ERM-CBA').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var ERMSD = new Date();
                           $('.form-status-ERM-CBA').html('Saved! Last: ' + ERMSD.toLocaleTimeString());
         		    },
                           });

                        }


                         $('.ERM-S-form').submit(function(e) {
                        	saveToDBERMS();
                        	e.preventDefault();
                         });