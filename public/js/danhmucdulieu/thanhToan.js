$('.formPhuongThucThanhToan').validate({
    rules: {
        'tt_ten': {
            required: true,
            maxlength: 255,
        },
    },
    messages: {
        'tt_ten': {
            required: "Bạn chưa nhập tên phương thức thanh toán",
            maxlength: "Tên phương thức thanh toán quá dài",
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