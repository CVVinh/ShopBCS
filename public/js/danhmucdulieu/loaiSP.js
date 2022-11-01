$('.formLoaiSanPham').validate({
    rules: {
        'lsp_ten': {
            required: true,
            maxlength: 255,
        },
    },
    messages: {
        'lsp_ten': {
            required: "Bạn chưa nhập loại của sản phẩm",
            maxlength: "Tên loại sản phẩm quá dài",
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