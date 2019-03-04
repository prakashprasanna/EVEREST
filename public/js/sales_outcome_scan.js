var FSPCBA;
$('#FSP_CBA').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(FSPCBA);
    FSPCBA = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBFSPS();
    }, 1000); 
});

                          function saveToDBFSPS()
                          {
                            console.log('Saving to the db');
                            form = $('.FSP-S-form');
                        	$.ajax({
                 		url: "edit/outcome/FSPS",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-FSP-CBA').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var FSPSD = new Date();
                           $('.form-status-FSP-CBA').html('Saved! Last: ' + FSPSD.toLocaleTimeString());
         		    },
                           });

                        }


                         $('.FSP-S-form').submit(function(e) {
                        	saveToDBFSPS();
                        	e.preventDefault();
                         });