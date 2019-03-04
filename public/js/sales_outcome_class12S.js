var CLASS12ACO;
$('#class12_ACO').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(CLASS12ACO);
    CLASS12ACO = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBCLASS12();
    }, 1000); 
});

                          function saveToDBCLASS12()
                          {
                            console.log('Saving to the db');
                            form = $('.class12-form');
                        	$.ajax({
                 		url: "edit/outcome/class12",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-class12-ACO').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var class12D = new Date();
                           $('.form-status-class12-ACO').html('Saved! Last: ' + class12D.toLocaleTimeString());
         		    },
                           });

                        }


                         $('.class12-form').submit(function(e) {
                        	saveToDBCLASS12();
                        	e.preventDefault();
                         });