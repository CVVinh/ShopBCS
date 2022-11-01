$('.formDonViSP').validate({
    rules: {
        'dv_ten': {
            required: true,
            maxlength: 255,
        },
    },
    messages: {
        'dv_ten': {
            required: "Bạn chưa nhập đơn vị của sản phẩm",
            maxlength: "Tên đơn vị sản phẩm quá dài",
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