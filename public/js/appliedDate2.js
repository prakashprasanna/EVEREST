var timeoutId42;
$('#appliedDte2').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(timeoutId42);
    timeoutId42 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB42();
    }, 1000);
});
$('#courseStatus2').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(timeoutId42);
    timeoutId42 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB42();
    }, 1000);
});
                          function saveToDB42()
                          {
                            console.log('Saving to the db');
                            form = $('.applied-form2');
                        	$.ajax({
                 		url: "update/applied2_date",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-holder42').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj42 = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var d42 = new Date();
                           $('.form-status-holder42').html('Saved! Last: ' + d42.toLocaleTimeString());
         		    },
                           });
                        }


                         $('.applied-form2').submit(function(e) {
                        	saveToDB42();
                        	e.preventDefault();
                         });