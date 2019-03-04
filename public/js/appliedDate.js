var timeoutId4;
$('#appliedDte').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(timeoutId4);
    timeoutId4 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB4();
    }, 1000);
});
$('#courseStatus').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(timeoutId4);
    timeoutId4 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB4();
    }, 1000);
});

                          function saveToDB4()
                          {
                            console.log('Saving to the db');
                            form = $('.applied-form');
                        	$.ajax({
                 		url: "update/applied_date",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-holder4').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var d4 = new Date();
                           $('.form-status-holder4').html('Saved! Last: ' + d4.toLocaleTimeString());
         		    },
                           });
                        }


                         $('.applied-form').submit(function(e) {
                        	saveToDB4();
                        	e.preventDefault();
                         });