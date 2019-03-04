

      $(".success").click(function(){
        toastr.success('We do have the Kapua suite available.', 'Success Alert', {timeOut: 5000})
      });


      $(".error").click(function(){
        toastr.error('You Got Error', 'Inconceivable!', {timeOut: 5000})
      });


      $(".info").click(function(){
        toastr.info('It is for your kind information', 'Information', {timeOut: 5000})
      });


      $(".warning").click(function(){
        toastr.warning('It is for your kind warning', 'Warning', {timeOut: 5000})
      });
    