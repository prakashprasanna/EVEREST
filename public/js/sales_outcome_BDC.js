var BDCS;
$('#BDC_PBA').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(BDCS);
    BDCS = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBBDCS();
    }, 1000); 
});
$('#BDC_scan').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(BDCS);
    BDCS = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBBDCS();
    }, 1000); 
});


                          function saveToDBBDCS()
                          {
                            console.log('Saving to the db');
                            form = $('.BDC-S-form');
                        	$.ajax({
                 		url: "edit/outcome/BDCS",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-BDC').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var BDCSD = new Date();
                           $('.form-status-BDC').html('Saved! Last: ' + BDCSD.toLocaleTimeString());
         		    },
                           });

                        }


                         $('.BDC-S-form').submit(function(e) {
                        	saveToDBBDCS();
                        	e.preventDefault();
                         });