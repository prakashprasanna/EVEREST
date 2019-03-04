var CVACO;
$('#CV_ACO').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(CVACO);
    CVACO = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBCV();
    }, 1000); 
});

                          function saveToDBCV()
                          {
                            console.log('Saving to the db');
                            form = $('.CV-form');
                        	$.ajax({
                 		url: "edit/outcome/CV",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-CV-ACO').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var CVD = new Date();
                           $('.form-status-CV-ACO').html('Saved! Last: ' + CVD.toLocaleTimeString());
         		    },
                           });

                        }


                         $('.CV-form').submit(function(e) {
                        	saveToDBCV();
                        	e.preventDefault();
                         });