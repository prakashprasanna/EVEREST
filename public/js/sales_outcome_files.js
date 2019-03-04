var FNCCBA;
$('#FNC_CBA').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(FNCCBA);
    FNCCBA = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBFNCS();
    }, 1000); 
});

                          function saveToDBFNCS()
                          {
                            console.log('Saving to the db');
                            form = $('.FNC-S-form');
                        	$.ajax({
                 		url: "edit/outcome/FNCS",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-FNC-CBA').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var FNCSD = new Date();
                           $('.form-status-FNC-CBA').html('Saved! Last: ' + FNCSD.toLocaleTimeString());
         		    },
                           });

                        }


                         $('.FNC-S-form').submit(function(e) {
                        	saveToDBFNCS();
                        	e.preventDefault();
                         });