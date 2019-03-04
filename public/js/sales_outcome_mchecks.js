var ARMCBA;
$('#ARM_CBA').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(ARMCBA);
    ARMCBA = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBARMS();
    }, 1000); 
});

                          function saveToDBARMS()
                          {
                            console.log('Saving to the db');
                            form = $('.ARM-S-form');
                        	$.ajax({
                 		url: "edit/outcome/ARMS",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-ARM-CBA').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var ARMSD = new Date();
                           $('.form-status-ARM-CBA').html('Saved! Last: ' + ARMSD.toLocaleTimeString());
         		    },
                           });

                        }


                         $('.ARM-S-form').submit(function(e) {
                        	saveToDBARMS();
                        	e.preventDefault();
                         });