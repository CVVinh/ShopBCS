$('#formDangNhap').validate({
    rules: {
        'email': {
            required: true,
        },
        'password': {
            required: true,
        },
    },
    messages: {
        'email': {
            required: "Bạn chưa nhập tên đăng nhập",
        },
        password: {
            required: "Bạn chưa nhập vào mật khẩu",
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