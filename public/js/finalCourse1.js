var timeoutId;
$('#final').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(timeoutId);
    timeoutId = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB();
    }, 1000);
});

                          function saveToDB()
                          {
                            console.log('Saving to the db');
                            form = $('.final-form');
                        	$.ajax({
                 		url: "update/final_course",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-holder').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var d = new Date();
                           $('.form-status-holder').html('Saved! Last: ' + d.toLocaleTimeString());
                       window.location.reload();                
         		    },
                           });

                        }


                         $('.final-form').submit(function(e) {
                        	saveToDB();
                        	e.preventDefault();
                         });
