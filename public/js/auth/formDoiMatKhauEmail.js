$('#formDoiMatKhauEmail').validate({
    rules: {
        'email': {
            required: true,
            email: true,
        },
        'password': {
            required: true,
            minlength: 6,
        },
        'xacNhanMK': {
            required: true,
            minlength: 6,
            equalTo: "#password"
        }
    },
    messages: {
        'email': {
            required: "Bạn chưa nhập địa chỉ email",
            email: "Email không hợp lệ",
        },
        password: {
            required: "Bạn chưa nhập vào mật khẩu",
            minlength: "Mật khẩu phải có ít nhất 6 ký tự"
        },
        xacNhanMK: {
            required: "Bạn chưa nhập vào mật khẩu",
            minlength: "Mật khẩu phải có ít nhất 6 ký tự",
            equalTo: "Mật khẩu không trùng khớp với mật khẩu đã nhập"
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