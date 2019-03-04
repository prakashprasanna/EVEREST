var FSPACO;
$('#FSP_ACO').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(FSPACO);
    FSPACO = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBFSP();
    }, 1000); 
});

                          function saveToDBFSP()
                          {
                            console.log('Saving to the db');
                            form = $('.FSP-form');
                        	$.ajax({
                 		url: "edit/outcome/FSP",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-FSP-ACO').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var FSPD = new Date();
                           $('.form-status-FSP-ACO').html('Saved! Last: ' + FSPD.toLocaleTimeString());
         		    },
                           });

                        }


                         $('.FSP-form').submit(function(e) {
                        	saveToDBFSP();
                        	e.preventDefault();
                         });