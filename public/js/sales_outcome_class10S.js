var CLASS10ACO;
$('#class10_ACO').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(CLASS10ACO);
    CLASS10ACO = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBCLASS10();
    }, 1000); 
});

                          function saveToDBCLASS10()
                          {
                            console.log('Saving to the db');
                            form = $('.class10-form');
                        	$.ajax({
                 		url: "edit/outcome/class10",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-class10-ACO').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var class10D = new Date();
                           $('.form-status-class10-ACO').html('Saved! Last: ' + class10D.toLocaleTimeString());
         		    },
                           });

                        }


                         $('.class10-form').submit(function(e) {
                        	saveToDBCLASS10();
                        	e.preventDefault();
                         });