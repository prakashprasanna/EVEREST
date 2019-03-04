var CVS;
$('#CV_PBA').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(CVS);
    CVS = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBCVS();
    }, 1000); 
});
$('#CV_scan').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(CVS);
    CVS = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBCVS();
    }, 1000); 
});


                          function saveToDBCVS()
                          {
                            console.log('Saving to the db');
                            form = $('.CV-S-form');
                        	$.ajax({
                 		url: "edit/outcome/CVS",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-CV').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var CVSD = new Date();
                           $('.form-status-CV').html('Saved! Last: ' + CVSD.toLocaleTimeString());
         		    },
                           });

                        }


                         $('.CV-S-form').submit(function(e) {
                        	saveToDBCVS();
                        	e.preventDefault();
                         });