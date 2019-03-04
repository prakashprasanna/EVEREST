var visa;
$('#visaCountry').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(visa);
    visa = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_visa();
    }, 1000);
});
$('#visaAppliedDate').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(visa);
    visa = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_visa();
    }, 1000);
});
$('#expApprovalDate').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(visa);
    visa = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_visa();
    }, 1000);
});
$('#visaStatus').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(visa);
    visa = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_visa();
    }, 1000);
});

                          function saveToDB_visa()
                          {
                            console.log('Saving to the db');
                            form = $('.visa-form');
                        	$.ajax({
                 		url: "update/visa_details",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-visa').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var visa = new Date();
                           $('.form-status-visa').html('Saved! Last: ' + visa.toLocaleTimeString());
         		    },
                           });
                        }


                         $('.visa-form').submit(function(e) {
                        	saveToDB_visa();
                        	e.preventDefault();
                         });
    