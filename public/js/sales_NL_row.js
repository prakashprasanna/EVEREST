var NLrows;
$('#NLrows').on('input propertychange change', function() {
    console.log('Textarea Change');
    
    clearTimeout(NLrows);
    NLrows = setTimeout(function() {
        // Runs 1 second (1000 ms) after the last change    
        saveToDBNLrows();
    }, 1000);
});

                          function saveToDBNLrows()
                          {
                            console.log('Saving to the db');
                            form = $('.NL-row-form');
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
                        	$.ajax({
                 		url: "dashboard/update/NLrows",
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


                         $('.NL-row-form').submit(function(e) {
                        	saveToDBNLrows();
                        	e.preventDefault();
                         });

