var timeoutId6;
$('#appliedDte3').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(timeoutId6);
    timeoutId6 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB6();
    }, 1000);
});
$('#courseStatus3').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(timeoutId6);
    timeoutId6 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB6();
    }, 1000);
});

                          function saveToDB6()
                          {
                            console.log('Saving to the db');
                            form = $('.applied3-form');
                        	$.ajax({
                 		url: "update/applied3_date",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-holder6').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var d6 = new Date();
                           $('.form-status-holder6').html('Saved! Last: ' + d6.toLocaleTimeString());
         		    },
                           });
                        }


                         $('.applied3-form').submit(function(e) {
                        	saveToDB6();
                        	e.preventDefault();
                         });