function QuenMatKhau() {
    $('#theDangNhapHT').hide();
    $('#theChonPhuongThuc').show();
}

function XacNhanBangDienThoai() {
    $('#theChonPhuongThuc').hide();
    $('#theDoiMKDienThoai').show();
}

function XacNhanBangEmail() {
    $('#theChonPhuongThuc').hide();
    $('#theDoiMKEmail').show();
}

function TroVeDN() {
    $('#theDangNhapHT').show();
    $('#theChonPhuongThuc').hide();
}

function TroVe() {
    $('#theChonPhuongThuc').show();
    $('#theDoiMKEmail').hide();
    $('#theDoiMKDienThoai').hide();
    $('#theDoiMKXacNhanSDT').hide();
    $('#theDoiMKDatMK').hide();
    $('#loiNhapSDT').hide();
    $('#loiXacNhanMaSDT').hide();
    $("#thongBaoGuiMaSDT").hide();
    $("#thonngBaoXacNhanMaSDT").hide();
    $("#thongBaoDoiMKEmail").hide();
    $("#loiDoiMKEmail").hide();
    $("#loiRobotEmail").hide();
    $("#loiRobotDienThoai").hide();
}

var firebaseConfig = {
    apiKey: "AIzaSyAvqPdn10SmFrcn-ROMAP4NYZ2vlBFHyQk",
    authDomain: "myproject-352411.firebaseapp.com",
    projectId: "myproject-352411",
    storageBucket: "myproject-352411.appspot.com",
    messagingSenderId: "997433701402",
    appId: "1:997433701402:web:4ca83483d79d41d69e8da3",
    measurementId: "G-VQBYFQE5LM"
};
firebase.getAnalistics(firebase.initializeApp(firebaseConfig));

/* window.onload = function() {
    render();
}; */

function render() {
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptchaContainer');
    recaptchaVerifier.render().then((widgetId) => {
        window.recaptchaWidgetId = widgetId;
    });
}
var soDienThoaiXacNhan;

function guiSDTXacThuc() {
    if ($("#sdtDoiMK").length && $("#sdtDoiMK").val().length) {
        var number = $("#sdtDoiMK").val();
        number = '+84' + number.substring(1);
        soDienThoaiXacNhan = number;
    }
    firebase.auth().signInWithPhoneNumber(soDienThoaiXacNhan, window.recaptchaVerifier).then(function(
        confirmationResult) {
        window.confirmationResult = confirmationResult;
        coderesult = confirmationResult;
        $("#thongBaoGuiMaSDT").text("Tin nhắn đã được gửi đến số điện thoại " + soDienThoaiXacNhan +
            " bạn kiểm tra và vui lòng xác nhận!");
        $("#thongBaoGuiMaSDT").show();
        $("#thonngBaoXacNhanMaSDT").text("Tin nhắn đã được gửi đến số điện thoại " + soDienThoaiXacNhan +
            " bạn kiểm tra và vui lòng xác nhận!");
        $("#thonngBaoXacNhanMaSDT").show();

        $('#theDoiMKXacNhanSDT').show();
        $('#theDoiMKDienThoai').hide();
        $('#loiNhapSDT').hide();

    }).catch(function(error) {
        $("#loiNhapSDT").text(error.message);
        $("#loiNhapSDT").show();
        $("#thongBaoGuiMaSDT").hide();
    });
}

function XacThucMaSDTDoiMK() {
    var code = $("#maXacThucSDT").val();
    coderesult.confirm(code).then(function(result) {
        var user = result.user;
        $("#thonngBaoXacNhanMaSDT").text("Mã xác thực hợp lệ.");
        $("#thonngBaoXacNhanMaSDT").show();
        $('#loiXacNhanMaSDT').hide();
        firebase.auth().currentUser.delete();
        $('#theDoiMKXacNhanSDT').hide();
        $('#theDoiMKDatMK').show();
        /* var href = $('#dieuHuongDoiMK').attr('href');
        window.location.href = href; */
    }).catch(function(error) {
        $("#loiXacNhanMaSDT").text(error.message);
        $("#loiXacNhanMaSDT").show();
        $("#thonngBaoXacNhanMaSDT").hide();
    });
    return false;
}