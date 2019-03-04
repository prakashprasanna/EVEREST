var ins1;
$('#offRecDate').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(ins1);
    ins1 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_ins();
    }, 1000);
});
$('#outcome_course1_startDate').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(ins1);
    ins1 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_ins();
    }, 1000);
});
$('#outcome_course1_studentID').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(ins1);
    ins1 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_ins();
    }, 1000);
});
$('#outcome_course1_fees').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(ins1);
    ins1 = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDB_ins();
    }, 1000);
});

                          function saveToDB_ins()
                          {
                            console.log('Saving to the db');
                            form = $('.ins-form');
                        	$.ajax({
                 		url: "update/ins_details",
                		type: "PATCH",
                 		data: form.serialize(), // serializes the form's elements.
                		beforeSend: function(xhr) {
                      // Let them know we are saving
         			$('.form-status-ins').html('Saving...');
                 		},
         		success: function(data) {
			var jqObj = jQuery(data); // You can get data returned from your ajax call here. ex. jqObj.find('.returned-data').html()
                        // Now show them we saved and when we did
                       var ins = new Date();
                           $('.form-status-ins').html('Saved! Last: ' + ins.toLocaleTimeString());
         		    },
                           });
                        }


                         $('.ins-form').submit(function(e) {
                        	saveToDB_ins();
                        	e.preventDefault();
                         });