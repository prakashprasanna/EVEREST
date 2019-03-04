var timeoutId3;
$('#final3').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(timeoutId3);
    timeoutId3 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB3();
    }, 1000);
});

                          function saveToDB3()
                          {
                            console.log('Saving to the db');
                            form = $('.final3-form');
                        	$.ajax({
                 		url: "update/final_course3",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-holder3').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var d3 = new Date();
                           $('.form-status-holder3').html('Saved! Last: ' + d3.toLocaleTimeString());
                       window.location.reload();                
         		    },
                           });
                        }


                         $('.final3-form').submit(function(e) {
                        	saveToDB3();
                        	e.preventDefault();
                         });
