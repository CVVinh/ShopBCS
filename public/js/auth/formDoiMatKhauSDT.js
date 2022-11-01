/* form thay doi mat khau */
$('#formDoiMatKhauSDT').validate({
    rules: {
        'sdt': {
            required: true,
            number: true,
            minlength: 10,
            maxlength: 11,
        },
        'password': {
            required: true,
            minlength: 6,
        },
        'xacNhanMK': {
            required: true,
            equalTo: "#password"
        }
    },
    messages: {
        'sdt': {
            required: "Bạn chưa nhập số điện thoại",
            number: "Số điện thoại phải là một chuỗi số",
            minlength: "Số điện thoại phải có ít nhất 10 chữ số",
            maxlength: "Số điện thoại không lớn hơn 11 chữ số",
        },
        password: {
            required: "Bạn chưa nhập vào mật khẩu",
            minlength: "Mật khẩu phải có ít nhất 6 ký tự"
        },
        xacNhanMK: {
            required: "Bạn chưa nhập xác nhận mật khẩu",
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

$('#btnGuiDoiMK').click(function() {
    $('#idDoiMKSDT').hide();
});