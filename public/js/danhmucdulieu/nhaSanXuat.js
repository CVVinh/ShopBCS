$('.formNhaSanXuat').validate({
    rules: {
        'nsx_ten': {
            required: true,
            maxlength: 255,
        },
        'nsx_sdt': {
            required: true,
            number: true,
            minlength: 10,
            maxlength: 11,
        },
        'nsx_email': {
            required: true,
            email: true,
            maxlength: 40,
        },
        'nsx_diachi': {
            required: true,
            maxlength: 255,
        },
        'nsx_msthue': {
            required: true,
            number: true,
            maxlength: 10,
        },
    },
    messages: {
        'nsx_ten': {
            required: "Bạn chưa nhập tên nhà sản xuất",
            maxlength: "Tên nhà sản xuất quá dài",
        },
        'nsx_sdt': {
            required: "Bạn chưa nhập số điện thoại nhà sản xuất",
            number: "Số điện thoại phải là một dãy số",
            minlength: "Số điện thoại phải có ít nhất 10 chữ số",
            maxlength: "Số điện thoại không lớn hơn 11 chữ số",
        },
        'nsx_email': {
            required: "Bạn chưa nhập email nhà sản xuất",
            email: "Email không hợp lệ",
            maxlength: "Email nhà sản xuất quá dài",
        },
        'nsx_diachi': {
            required: "Bạn chưa nhập địa chỉ nhà sản xuất",
            maxlength: "Địa chỉ nhà sản xuất quá dài",
        },
        'nsx_msthue': {
            required: "Bạn chưa nhập mã số thuế nhà sản xuất",
            number: "Mã số thuế phải là một số",
            maxlength: "Mã số thuế không lớn hơn 10 chữ số",
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