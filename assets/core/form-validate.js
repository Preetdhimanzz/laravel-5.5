$(document).ready(function() {
    $(document).on('click', 'button[type="submit"] , input[type="submit"] ', function() {
        var minPhoneLen = 10;
        var maxPhoneLen = 15;
        $.validator.addMethod("noSpace", function(value, element, param) {
            //      	return value.indexOf(" ") >= 0 && value != "";
            return $.trim(value).length >= param;

        }, "No space please and don't leave it empty");
        $.validator.addMethod("greaterThan",
            function(value, element, param) {
                var $min = $(param);
                if (this.settings.onfocusout) {
                    $min.off(".validate-greaterThan").on("blur.validate-greaterThan", function() {
                        $(element).valid();
                    });
                }
                return parseInt(value) > parseInt($min.val());
            }, "Max must be greater than min");
        jQuery.validator.addMethod("nameRegex", function(value, element) {
            return this.optional(element) || /^[a-z\ \s]+$/i.test(value);
        }, "felid must contain only letters & space");
        /*$.validator.addMethod('minStrict', function (value, el, param) {
            return value > param;
        },"Rate should be greater then 0.00");*/
        /*====================Start login form validation================= */
        var site_url = $('#site_url').val();
        $("#login-form").validate({
            errorClass: "has-error",
            highlight: function(element, errorClass) {
                $(element).parents('.form-group').addClass(errorClass);
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.form-group').removeClass(errorClass);
            },
            rules: {
                email: {
                    required: true,
                    noSpace: true,
                    email: true
                },
                password: {
                    required: true,
                    noSpace: true,
                    minlength: 5,
                }
            },
            messages: {
                email: {
                    required: "Email is required.",
                    email: "Please enter valid email",
                },
                password: {
                    required: "Password is required.",
                    minlength: "Password must contain at least 5 characters.",
                },
            },
            submitHandler: function(form) {
                formSubmit(form);
            }
        });

        //forgot Password
        $("#forgotPassword-form").validate({
            errorClass: "has-error",
            highlight: function(element, errorClass) {
                $(element).parents('.form-group').addClass(errorClass);
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.form-group').removeClass(errorClass);
            },
            rules: {
                email: {
                    required: true,
                    noSpace: true,
                    email: true
                },
            },
            messages: {
                email: {
                    required: "Email is required.",
                    email: "Please enter valid email",
                },
            },
            submitHandler: function(form) {
                formSubmit(form);
            }
        });

        //change Password-form
        $("#register-user-form").validate({
            errorClass: "has-error",
            highlight: function(element, errorClass) {
                $(element).parents('.form-group').addClass(errorClass);
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.form-group').removeClass(errorClass);
            },
            rules: {
                userName: {
                    required: true,
                },
                mobileNo: {
                    required: true,
                    noSpace: true,
                    minlength: 10,
                    number: true,
                },
                userAddress: {
                    required: false,
                },
                userEmail: {
                    required: true,
                    noSpace: false,
                },
                userType: {
                    required: true,
                },
            },
            messages: {
                userName: "Name is required.",
                mobileNo: {
                    'required': "Mobile Number required.",
                    'minlength': "Mobile Number must contain at least 10 Number.",
                },
                userName: "Name  is required.",
            },
            submitHandler: function(form) {
                formSubmit(form);
            }
        });



        $("#update-product").validate({
            errorClass: "has-error",
            highlight: function(element, errorClass) {
                $(element).parents('.form-group').addClass(errorClass);
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.form-group').removeClass(errorClass);
            },
            rules: {
                name: {
                    required: true,
                    noSpace: true,
                },
                price: {
                    required: true,
                    noSpace: true,
                    number: true,
                }
            },
            messages: {
                name: {
                    required: "Product name is required..",
                },
                price: {
                    required: "Price is required.",
                    number: "Price must be be numric only.",
                },
            },
            submitHandler: function(form) {
                formSubmit(form);
            }
        });

    });


});

function formSubmit(form) {
    $.ajax({
        url: form.action,
        type: form.method,
        //data        : $(form).serialize(),
        data: new FormData(form),
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        beforeSend: function() {
            $('#' + form.id +" input[type=submit]").attr("disabled", "disabled");
            $('#' + form.id +" button[type=submit]").attr("disabled", "disabled");
            $(".loader_div").show();
        },
        complete: function() {
            $(".loader_div").hide();
        },
        success: function(response) {
            var appendTo = '';
            $(".loader_div").hide();
            if (response.formErrors) {
                $("input[type=submit]").removeAttr("disabled");
                $("button[type=submit]").removeAttr("disabled")
            }
            $("button[type=submit]").removeAttr("disabled");
            // $("input[type=submit]").removeAttr("disabled");
            iziToast.destroy();
            var delayTime = 3000;
            if (response.delayTime)
                delayTime = response.delayTime;
            if (response.success) {
                toster('Success', response.success_message, delayTime);
            } else {
                if (response.formErrors) {
                    $.each(response.errors, function(index, value) {
                        $("input[name='" + index + "']").parents('.form-group').addClass('has-error');
                        $("input[name='" + index + "']").after('<label id="' + index + '-error" class="has-error" for="' + index + '">' + value + '</label>');
                        $("select[name='" + index + "']").parents('.form-group').addClass('has-error');
                        $("select[name='" + index + "']").after('<label id="' + index + '-error" class="has-error" for="' + index + '">' + value + '</label>');
                    });
                } else {
                    toster('Error', response.error_message, delayTime);
                }
            }
            if (response.modelhide) {
                jQuery('#' + response.modelhide).modal('hide');
            }
            if (response.ajaxPageCallBack) {
                response.formid = form.id;
                ajaxPageCallBack(response);
            }

            if (response.resetform) {
                $('#' + form.id).resetForm();
            }
            if (response.submitDisabled) {
                $("input[type=submit]").attr("disabled", "disabled");
                $("button[type=submit]").attr("disabled", "disabled");
            }
            if (response.hideEleid) {
                jQuery('#' + response.hideEleid).hide();
                jQuery("html, body").animate({
                    scrollTop: 0
                }, "slow");
            };
            if (response.reload) {
                setTimeout(function() {
                    location.reload();
                }, delayTime)
            }
            if (response.url) {
                if (response.delayTime)
                    setTimeout(function() {
                        window.location.href = response.url;
                    }, response.delayTime);
                else
                    window.location.href = response.url;
            }

        },
        error: function(response) {

            var delayTime = 3000;
            toster('Error', 'ConnectionError!', delayTime);
            $('#' + form.id +" input[type=submit]").removeAttr("disabled");
            $('#' + form.id +" button[type=submit]").removeAttr("disabled" );
        }
    });
}
