var PASSPORTACO;
$('#passport_ACO').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(PASSPORTACO);
    PASSPORTACO = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBPASSPORT();
    }, 1000); 
});

                          function saveToDBPASSPORT()
                          {
                            console.log('Saving to the db');
                            form = $('.passport-form');
                        	$.ajax({
                 		url: "edit/outcome/PASSPORT",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-passport-ACO').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var passD = new Date();
                           $('.form-status-passport-ACO').html('Saved! Last: ' + passD.toLocaleTimeString());
         		    },
                           });

                        }


                         $('.passport-form').submit(function(e) {
                        	saveToDBPASSPORT();
                        	e.preventDefault();
                         });