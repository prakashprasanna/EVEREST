var ERMACO;
$('#ERM_ACO').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(ERMACO);
    ERMACO = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBERM();
    }, 1000); 
});

                          function saveToDBERM()
                          {
                            console.log('Saving to the db');
                            form = $('.ERM-form');
                        	$.ajax({
                 		url: "edit/outcome/ERM",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-ERM-ACO').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var ERMD = new Date();
                           $('.form-status-ERM-ACO').html('Saved! Last: ' + ERMD.toLocaleTimeString());
         		    },
                           });

                        }


                         $('.ERM-form').submit(function(e) {
                        	saveToDBERM();
                        	e.preventDefault();
                         });