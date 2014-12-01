var form = {
    init : function(config) {
      this.config = config;
      this.bindEvents();
    },

    bindEvents: function() {
      this.config.wrap_form.on('click','#submit',this.submit_add_address_form);
      this.config.wrap_who_am_i_form.on('click','#who_am_i_submit',this.submit_who_am_i_form);
      this.config.wrap_how_do_i_pay_form.on('click','#how_do_i_pay_submit',this.submit_how_do_i_pay_form);
    },
    
    submit_add_address_form : function(e) {

      var obj = form;
      $.ajax({
        url      :  'add_address_action.php',
        type     :  'POST',
        data     :   obj.config.wrap_form.serialize(),
        dataType :  'json',
        success  :  function(results) {
          obj.config.display_errors_wraper.empty().append(results).fadeOut(2000,'swing').fadeIn(3000).fadeOut(3000);
        }
      });
      e.preventDefault();
    },

    submit_who_am_i_form : function(e) {

      var obj = form;
      console.log('form submitted');
      $.ajax({
        url      :  'whoAmI_action.php',
        type     :  'POST',
        data     :   obj.config.wrap_who_am_i_form.serialize(),
        dataType :  'json',
        success  :  function(results) {
          obj.config.display_who_am_i_form_errors.empty().append(results).fadeOut(2000,'swing').fadeIn(3000).fadeOut(3000);
        }
      });
      e.preventDefault();
    },

    submit_how_do_i_pay_form : function(e) {

      var obj = form;
      
      $.ajax({
        url      :  'how_do_i_pay_action.php',
        type     :  'POST',
        data     :   obj.config.wrap_how_do_i_pay_form.serialize(),
        dataType :  'json',
        success  :  function(results) {
          console.log(results); 
          return false;
          obj.config.display_how_do_i_pay_errors.empty().append(results).fadeOut(2000,'swing').fadeIn(3000).fadeOut(3000);  
        }
      });
      // e.preventDefault();
    }
}
form.init({
  wrap_form : $('#myform'),
  display_errors_wraper : $('#display_errors-wrapper'),

  wrap_who_am_i_form : $('#who_am_i_form'),
  display_who_am_i_form_errors : $('#display_who_am_i_form_errors'),

  wrap_how_do_i_pay_form : $('#how_do_i_pay_form'),
  display_how_do_i_pay_errors : $('#display_how_do_i_pay_errors')

});

