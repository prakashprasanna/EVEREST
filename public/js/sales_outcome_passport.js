var PASSPORTS;
$('#passport_PBA').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(PASSPORTS);
    PASSPORTS = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBPASSPORTS();
    }, 1000); 
});
$('#passport_scan').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(PASSPORTS);
    PASSPORTS = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBPASSPORTS();
    }, 1000); 
});


                          function saveToDBPASSPORTS()
                          {
                            console.log('Saving to the db');
                            form = $('.passport-S-form');
                        	$.ajax({
                 		url: "edit/outcome/PASSPORTS",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-passport').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var passSD = new Date();
                           $('.form-status-passport').html('Saved! Last: ' + passSD.toLocaleTimeString());
         		    },
                           });

                        }


                         $('.passport-S-form').submit(function(e) {
                        	saveToDBPASSPORTS();
                        	e.preventDefault();
                         });