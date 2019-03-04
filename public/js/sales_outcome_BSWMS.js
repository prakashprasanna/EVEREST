var BSWMACO;
$('#BSWM_ACO').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(BSWMACO);
    BSWMACO = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBBSWM();
    }, 1000); 
});

                          function saveToDBBSWM()
                          {
                            console.log('Saving to the db');
                            form = $('.BSWM-form');
                        	$.ajax({
                 		url: "edit/outcome/BSWM",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-BSWM-ACO').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var BSWMD = new Date();
                           $('.form-status-BSWM-ACO').html('Saved! Last: ' + BSWMD.toLocaleTimeString());
         		    },
                           });

                        }


                         $('.BSWM-form').submit(function(e) {
                        	saveToDBBSWM();
                        	e.preventDefault();
                         });