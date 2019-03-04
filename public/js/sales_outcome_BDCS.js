var BDCACO;
$('#BDC_ACO').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(BDCACO);
    BDCACO = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBBDC();
    }, 1000); 
});

                          function saveToDBBDC()
                          {
                            console.log('Saving to the db');
                            form = $('.BDC-form');
                        	$.ajax({
                 		url: "edit/outcome/BDC",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-BDC-ACO').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var BDCD = new Date();
                           $('.form-status-BDC-ACO').html('Saved! Last: ' + BDCD.toLocaleTimeString());
         		    },
                           });

                        }


                         $('.BDC-form').submit(function(e) {
                        	saveToDBBDC();
                        	e.preventDefault();
                         });