var AIP;
$('#AIPDate').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(AIP);
    AIP = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_AIP();
    }, 1000);
});
$('#AIPDocsDate').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(AIP);
    AIP = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_AIP();
    }, 1000);
});
$('#EVisaDate').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(AIP);
    AIP = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_AIP();
    }, 1000);
});

                          function saveToDB_AIP()
                          {
                            console.log('Saving to the db');
                            form = $('.AIP-form');
                        	$.ajax({
                 		url: "update/AIP_details",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-AIP').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var AIP = new Date();
                           $('.form-status-AIP').html('Saved! Last: ' + AIP.toLocaleTimeString());
         		    },
                           });
                        }


                         $('.AIP-form').submit(function(e) {
                        	saveToDB_AIP();
                        	e.preventDefault();
                         });
    