var BCACO;
$('#BC_ACO').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(BCACO);
    BCACO = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBBC();
    }, 1000); 
});

                          function saveToDBBC()
                          {
                            console.log('Saving to the db');
                            form = $('.BC-form');
                        	$.ajax({
                 		url: "edit/outcome/BC",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-BC-ACO').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var BCD = new Date();
                           $('.form-status-BC-ACO').html('Saved! Last: ' + BCD.toLocaleTimeString());
         		    },
                           });

                        }


                         $('.BC-form').submit(function(e) {
                        	saveToDBBC();
                        	e.preventDefault();
                         });