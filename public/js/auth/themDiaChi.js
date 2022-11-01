$('.formThemDiaChiKH').validate({
    rules: {
        'dc_tenkh': {
            required: true,
            maxlength: 255,
        },
        'dc_sdt': {
            required: true,
            number: true,
            minlength: 10,
            maxlength: 11,
        },
        'dc_ten': {
            required: true,
            maxlength: 255,
        },
    },
    messages: {
        'dc_tenkh': {
            required: "Bạn chưa nhập tên người nhận hàng",
            maxlength: "Tên người dùng quá dài",
        },
        'dc_sdt': {
            required: "Bạn chưa nhập số điện thoại",
            number: "Số điện thoại phải là một dãy số",
            minlength: "Số điện thoại phải có ít nhất 10 chữ số",
            maxlength: "Số điện thoại không lớn hơn 11 chữ số",
        },
        'dc_ten': {
            required: "Bạn chưa nhập địa chỉ nhận hàng",
            maxlength: "Địa chỉ quá dài",
        }
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