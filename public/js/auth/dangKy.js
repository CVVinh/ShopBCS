window.onload = function() {
    render();
};

$('.formDangKy').validate({
    rules: {
        'ten': {
            required: true,
            maxlength: 30,
        },
        'ngaysinh': {
            required: true,
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
        'password': {
            required: true,
            minlength: 6,
            maxlength: 15,
        },
        'xacnhanmatkhau': {
            required: true,
            equalTo: "#password"
        },
    },
    messages: {
        'ten': {
            required: "Bạn chưa nhập tên người dùng",
            maxlength: "Tên người dùng quá dài",
        },
        'ngaysinh': {
            required: "Bạn chưa nhập ngày sinh",
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
        'password': {
            required: "Bạn chưa nhập vào mật khẩu",
            minlength: "Mật khẩu phải có ít nhất 6 ký tự",
            maxlength: "Mật khẩu quá dài",
        },
        'xacnhanmatkhau': {
            required: "Bạn chưa nhập mật khẩu xác nhận",
            equalTo: "Mật khẩu không trùng khớp với mật khẩu đã nhập",
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

$('.formDangKy').submit(function(event) {
    if (!grecaptcha.getResponse()) {
        $("#loiRobotDangKy").show();
        event.preventDefault();
        grecaptcha.execute();
    } else {
        $("#loiRobotDangKy").hide();
    }
});
captcharRegister = function() {}