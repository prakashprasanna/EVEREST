var CLASS10S;
$('#class10_PBA').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(CLASS10S);
    CLASS10S = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBCLASS10S();
    }, 1000); 
});
$('#class10_scan').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(CLASS10S);
    CLASS10S = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBCLASS10S();
    }, 1000); 
});


                          function saveToDBCLASS10S()
                          {
                            console.log('Saving to the db');
                            form = $('.class10-S-form');
                        	$.ajax({
                 		url: "edit/outcome/CLASS10S",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-class10').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var CLASS10SD = new Date();
                           $('.form-status-class10').html('Saved! Last: ' + CLASS10SD.toLocaleTimeString());
         		    },
                           });

                        }


                         $('.class10-S-form').submit(function(e) {
                        	saveToDBCLASS10S();
                        	e.preventDefault();
                         });