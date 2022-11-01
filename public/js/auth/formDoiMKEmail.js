/* xac thuc form gui email */
$('.formDoiMKEmail').validate({
    rules: {
        'email': {
            required: true,
            email: true,
        },
    },
    messages: {
        'email': {
            required: "Bạn chưa nhập địa chỉ email",
            email: "Email không hợp lệ",
        },
    },
    errorElement: "div",
    errorPlacement: function(error, element) {
        error.addClass("invalid-feedback");
        if (element.prop("type") === "checkbox") {
            error.insertAfter(element.siblings("label"));
        } else {
            error.insertAfter(element);
        }
    },
    highlight: function(element, errorClass, validClass) {
        $(element).addClass("is-invalid").removeClass("is-valid");
    },
    unhighlight: function(element, errorClass, validClass) {
        $(element).addClass("is-valid").removeClass("is-invalid");
    }
});

$('.formDoiMKEmail').submit(function(event) {
    if (!grecaptcha.getResponse()) {
        $("#loiRobotEmail").show();
        event.preventDefault();
        grecaptcha.execute();
    } else {
        $("#loiRobotEmail").hide();
    }
});
onCompleted = function() {}