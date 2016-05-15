var OrderForm = function () {

    return {
        
        //Order Form
        initOrderForm: function () {
	        // Validation
	        $("#sky-form").validate({
	            // Rules for form validation
	            rules:
	            {
	                username:
	                {
	                    required: true
	                },
	                email:
	                {
	                    required: true,
	                    email: true
	                },
	                phone:
	                {
	                    required: true
	                }
	            },
	                                
	            // Messages for form validation
	            messages:
	            {
					username:
	                {
	                    required: 'Пожалуйста, введите ваше имя'
	                },
	                email:
	                {
	                    required: 'Пожалуйста, введите ваш E-Mail',
	                    email: 'Пожалуйста, введите ПРАВИЛЬНЫЙ E-Mail'
	                },
	                phone:
	                {
	                    required: 'Пожалуйста, введите ваш телефон'
	                }
	            },

	            // Ajax form submition
	            submitHandler: function(form)
	            {
	                $(form).ajaxSubmit(
	                {
	                    beforeSend: function()
	                    {
                            $( "#form-buy-error").hide();
	                        $('#sky-form button[type="submit"]').addClass('button-uploading').attr('disabled', true);
	                    },
	                    success: function()
	                    {
                            $( "#form-buy-error").hide();
	                        $("#sky-form").addClass('submited');
	                        $('#sky-form button[type="submit"]').removeClass('button-uploading').attr('disabled', false);
	                    },
                        error: function () {
                            $( "#form-buy-error").show();
                            $('#sky-form button[type="submit"]').removeClass('button-uploading').attr('disabled', false);
                        }
	                });
	            },  
	            
	            // Do not change code below
	            errorPlacement: function(error, element)
	            {
	                error.insertAfter(element.parent());
	            }
	        });
        }

    };

}();