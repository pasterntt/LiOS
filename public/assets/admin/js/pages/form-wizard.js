$(document).ready(function() {
    var $validator = $("#wizardForm").validate({
        rules: {
            orderFirstname: {
                required: true
            },
            orderLastname: {
                required: true
		    },
            orderStreet: {
                required: true,
		    },
            orderStreetnumber: {
                required: true
            },
            orderZIP: {
                required: true,
                number: true
		    },
            orderCity: {
                required: true,
		    },
            orderCountry: {
                required: true
		    },
		    exampleInputProductId: {
                required: true
		    },
		    exampleInputQuantity: {
                required: true
            },
		    exampleInputCard: {
                required: true,
                number: true
		    },
		    exampleInputSecurity: {
                required: true,
                number: true
		    },
		    exampleInputHolder: {
                required: true
            },
		    exampleInputExpiration: {
                required: true,
                date: true
            },
		    exampleInputCsv: {
                required: true,
                number: true
            }
        }
    });

    $('#rootwizard').bootstrapWizard({
        'tabClass': 'nav nav-tabs',
        onTabShow: function (tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index + 1;
            var $percent = ($current / $total) * 100;
            $('#rootwizard').find('.progress-bar').css({width: $percent + '%'});
        },
        'onNext': function (tab, navigation, index) {
            if ($('#chooseContact').val() == 0) {
                var $valid = $("#wizardForm").valid();
                if (!$valid) {
                    $validator.focusInvalid();
                    return false;
                }
            }
        },
        'onTabClick': function (tab, navigation, index) {
            var $valid = $("#wizardForm").valid();
            if (!$valid) {
                $validator.focusInvalid();
                return false;
            }
        },
    });

    $('.date-picker').datepicker({
        orientation: "top auto",
        autoclose: true
    });
    
});