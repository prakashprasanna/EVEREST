var BSWMS;
$('#BSWM_PBA').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(BSWMS);
    BSWMS = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBBSWMS();
    }, 1000); 
});
$('#BSWM_scan').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(BSWMS);
    BCS = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBBSWMS();
    }, 1000); 
});


                          function saveToDBBSWMS()
                          {
                            console.log('Saving to the db');
                            form = $('.BSWM-S-form');
                        	$.ajax({
                 		url: "edit/outcome/BSWMS",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-BSWM').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var BSWMSD = new Date();
                           $('.form-status-BSWM').html('Saved! Last: ' + BSWMSD.toLocaleTimeString());
         		    },
                           });

                        }


                         $('.BSWM-S-form').submit(function(e) {
                        	saveToDBBSWMS();
                        	e.preventDefault();
                         });