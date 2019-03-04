var BCS;
$('#BC_PBA').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(BCS);
    BCS = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBBCS();
    }, 1000); 
});
$('#BC_scan').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(BCS);
    BCS = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBBCS();
    }, 1000); 
});


                          function saveToDBBCS()
                          {
                            console.log('Saving to the db');
                            form = $('.BC-S-form');
                        	$.ajax({
                 		url: "edit/outcome/BCS",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-BC').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var BCSD = new Date();
                           $('.form-status-BC').html('Saved! Last: ' + BCSD.toLocaleTimeString());
         		    },
                           });

                        }


                         $('.BC-S-form').submit(function(e) {
                        	saveToDBBCS();
                        	e.preventDefault();
                         });