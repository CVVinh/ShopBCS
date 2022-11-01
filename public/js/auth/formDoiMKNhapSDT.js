/* xac thuc form gui so dien thoai */
$('.formDoiMKNhapSDT').validate({
    rules: {
        'sdtDoiMK': {
            required: true,
            number: true,
            minlength: 10,
            maxlength: 11,
        },
    },
    messages: {
        'sdtDoiMK': {
            required: "Bạn chưa nhập số điện thoại",
            number: "Số điện thoại phải là một chuỗi số",
            minlength: "Số điện thoại phải có ít nhất 10 chữ số",
            maxlength: "Số điện thoại không lớn hơn 11 chữ số",
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

$('.formDoiMKNhapSDT').submit(function(event) {
    if (!grecaptcha.getResponse()) {
        $("#loiRobotDienThoai").show();
        event.preventDefault();
        grecaptcha.execute();
    } else {
        $("#loiRobotDienThoai").hide();
    }
});