$('.formCapNhat').validate({
    rules: {
        'ten': {
            required: true,
            maxlength: 30,
        },
        
        'email': {
            email: true,
            maxlength: 40,
        },
        'sdt': {
            required: true,
            number: true,
            minlength: 10,
            maxlength: 11,
        },
    },
    messages: {
        'ten': {
            required: "Bạn chưa nhập tên người dùng",
            maxlength: "Tên người dùng quá dài",
        },
        'email': {
            email: "Email không hợp lệ",
            maxlength: "Địa chỉ Email quá dài",
        },
        'sdt': {
            required: "Bạn chưa nhập số điện thoại",
            number: "Số điện thoại phải là một dãy số",
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