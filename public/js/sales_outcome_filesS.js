var FNCACO;
$('#FNC_ACO').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(FNCACO);
    FNCACO = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBFNC();
    }, 1000); 
});

                          function saveToDBFNC()
                          {
                            console.log('Saving to the db');
                            form = $('.FNC-form');
                        	$.ajax({
                 		url: "edit/outcome/FNC",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-FNC-ACO').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var FNCD = new Date();
                           $('.form-status-FNC-ACO').html('Saved! Last: ' + FNCD.toLocaleTimeString());
         		    },
                           });

                        }


                         $('.FNC-form').submit(function(e) {
                        	saveToDBFNC();
                        	e.preventDefault();
                         });