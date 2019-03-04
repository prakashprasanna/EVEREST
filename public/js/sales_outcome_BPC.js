var BPCS;
$('#BPC_PBA').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(BPCS);
    BPCS = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBBPCS();
    }, 1000); 
});
$('#BPC_scan').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(BPCS);
    BPCS = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBBPCS();
    }, 1000); 
});


                          function saveToDBBPCS()
                          {
                            console.log('Saving to the db');
                            form = $('.BPC-S-form');
                        	$.ajax({
                 		url: "edit/outcome/BPCS",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-BPC').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var BPCSD = new Date();
                           $('.form-status-BPC').html('Saved! Last: ' + BPCSD.toLocaleTimeString());
         		    },
                           });

                        }


                         $('.BPC-S-form').submit(function(e) {
                        	saveToDBBPCS();
                        	e.preventDefault();
                         });