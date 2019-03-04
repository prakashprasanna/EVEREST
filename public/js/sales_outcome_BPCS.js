var BPCACO;
$('#BPC_ACO').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(BPCACO);
    BPCACO = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBBPC();
    }, 1000); 
});

                          function saveToDBBPC()
                          {
                            console.log('Saving to the db');
                            form = $('.BPC-form');
                        	$.ajax({
                 		url: "edit/outcome/BPC",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-BPC-ACO').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var BPCD = new Date();
                           $('.form-status-BPC-ACO').html('Saved! Last: ' + BPCD.toLocaleTimeString());
         		    },
                           });

                        }


                         $('.BPC-form').submit(function(e) {
                        	saveToDBBPC();
                        	e.preventDefault();
                         });