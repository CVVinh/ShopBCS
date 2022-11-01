$('.formPhuongThucVanChuyen').validate({
    rules: {
        'vc_ten': {
            required: true,
            maxlength: 255,
        },
    },
    messages: {
        'vc_ten': {
            required: "Bạn chưa nhập tên phương thức vận chuyển",
            maxlength: "Tên phương thức vận chuyển quá dài",
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