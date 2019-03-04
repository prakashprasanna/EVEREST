var CLASS12S;
$('#class12_PBA').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(CLASS12S);
    CLASS12S = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBCLASS12S();
    }, 1000); 
});
$('#class12_scan').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(CLASS12S);
    CLASS12S = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBCLASS12S();
    }, 1000); 
});


                          function saveToDBCLASS12S()
                          {
                            console.log('Saving to the db');
                            form = $('.class12-S-form');
                        	$.ajax({
                 		url: "edit/outcome/CLASS12S",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-class12').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var CLASS12SD = new Date();
                           $('.form-status-class12').html('Saved! Last: ' + CLASS12SD.toLocaleTimeString());
         		    },
                           });

                        }


                         $('.class12-S-form').submit(function(e) {
                        	saveToDBCLASS12S();
                        	e.preventDefault();
                         });