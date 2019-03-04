var ARMACO;
$('#ARM_ACO').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(ARMACO);
    ARMACO = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBARM();
    }, 1000); 
});

                          function saveToDBARM()
                          {
                            console.log('Saving to the db');
                            form = $('.ARM-form');
                        	$.ajax({
                 		url: "edit/outcome/ARM",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-ARM-ACO').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var ARMD = new Date();
                           $('.form-status-ARM-ACO').html('Saved! Last: ' + ARMD.toLocaleTimeString());
         		    },
                           });

                        }


                         $('.ARM-form').submit(function(e) {
                        	saveToDBARM();
                        	e.preventDefault();
                         });