// const { remove } = require("lodash");

// const { remove } = require("lodash");

const header = document.querySelector("#topbar");
const headerHeight = header.clientHeight;
const navToggle = document.querySelector(".nav-toggle");
const countDown = document.querySelector(".countdown");
const daysText = document.querySelector(".days");
const hoursText = document.querySelector(".hours");
const minutesText = document.querySelector(".minutes");
const secondsText = document.querySelector(".seconds");
const timeCountDown = countDown?.dataset.time;
const selectDonVi = document.querySelectorAll(".button_box button");
const listProduct = document.querySelector(".list__product");
const showInfoOrder = listProduct?.querySelector(".product-show-order");
const productShow = document.querySelector(".product__pay");
const showAllProduct = listProduct?.querySelector(".product-list--buy");
const productShowHidden = listProduct?.querySelector(".product-hidden-order");
const iconDropdown = document.querySelector(".icon-dropdown");
const accordionShow = document.querySelector(".accordion-show");
let show = true;
const infoList = document.querySelectorAll(".info__list-item-link");
const iconRemoves = document.querySelectorAll(".icon-remove");
const giaBan = document.querySelector(".giaBan");
const removeSPs = document.querySelectorAll(".remove-sp");
const addressHidden = document.querySelector(".address-hidden");
const addAddress = document.querySelector(".add-address");
const addAddressEdit = document.querySelector(".add-address--edit");
const editAddress = document.querySelector(".address-edit");
const btnImgHover = document.querySelectorAll(".img-hover img");
let changeSrcImg = document.querySelector(".gallery__image-feature");
const stars = document.querySelectorAll(
    ".form-sao .form-check label.form-check-label"
);
const starLength = stars.length / 5;
const saveReview = document.querySelectorAll(".save-review");

if (saveReview) {
    saveReview.forEach((item) => {
        item.addEventListener("click", () => {
            const modal = document.createElement("div");
            const reviewsp = document.createElement("div");
            const img = document.createElement("img");
            img.src =
                "https://media.istockphoto.com/photos/paint-splatter-thank-you-picture-id1132817705?b=1&k=20&m=1132817705&s=170667a&w=0&h=fAlE3Lb0PPIySZ_otp-vv92H7F-e1lu4VjrFg4bJAUk=";
            img.classList.add("img-modal");
            reviewsp.className = "review-sp";
            modal.className = "modal-full";
            let t = document.createElement("div");
            reviewsp.appendChild(t);
            reviewsp.appendChild(img);
            t.classList.add("show-review");
            t.textContent = "Cảm ơn bạn đã đánh giá cho sản phẩm!";
            modal.appendChild(reviewsp);
            document.body.appendChild(modal);
            setTimeout(() => {
                document.body.removeChild(modal);
            }, 3000);
        });
    });
}
if (stars) {
    stars.forEach((item, idx) => {
        item.addEventListener("click", (e) => {
            let soSao = e.target.id;
            stars.forEach((el) => el.classList.remove("active"));

            e.target.classList.toggle("active");

            if (idx >= 5) {
                for (let i = 5; i <= idx; i++) {
                    // console.log(i);
                    stars[i].classList.add("active");
                }
            } else {
                for (let i = 0; i < soSao; i++) {
                    stars[i].classList.add("active");
                }
            }
        });
    });
}

const inputSearch = document.querySelector(".form-drop");
const formShow = document.querySelector(".form-show");

window.addEventListener("mouseover", (e) => {
    if (!e.target.classList.contains("form-drop")) {
    }
    if (
        !e.target.classList.contains("form-show") &&
        !e.target.classList.contains("form-show--item")
    ) {
        formShow.classList.remove("show");
    }
});

if (inputSearch) {
    inputSearch.addEventListener("click", () => {
        formShow.classList.add("show");
    });
}

// if (stars) {
//     stars.forEach((item, idx) => {
//         item.addEventListener("click", function (e) {
//             for (let i = 0; i <= idx; i++) {
//                 if (e.target.classList.contains("fa-star-o")) {
//                     stars[i].setAttribute("class", "fa fa-star");
//                 } else {
//                     stars[i].setAttribute("class", "fa fa-star-o");
//                 }
//             }
//             // if (e.target.classList.contains("fa-star-o")) {
//             //     e.target.setAttribute("class", "fa fa-star");
//             // } else {
//             //     e.target.setAttribute("class", "fa fa-star-o");
//             // }
//         });
//     });
// }

function countStar(val) {
    var a = val.id;
    var sosao = Number(a.slice(5, a.length));
    for (var i = 1; i <= 5; i++) {
        document.getElementById("stars" + i).innerHTML =
            '<i class="fa fa-star-o" aria-hidden="true"></i>';
    }
    for (var i = 1; i <= sosao; i++) {
        document.getElementById("stars" + i).innerHTML =
            '<i class="fa fa-star" aria-hidden="true"></i>';
    }
}

if (btnImgHover) {
    btnImgHover.forEach((item) => {
        item.addEventListener("mouseover", (e) => {
            changeSrcImg.src = e.target.src;
        });
    });
}

if (editAddress) {
    editAddress.addEventListener("click", function () {
        addAddressEdit.classList.toggle("active");
    });
}

if (addressHidden) {
    addressHidden.addEventListener("click", () => {
        addAddress.classList.toggle("active");
    });
}

const tongGiaBan = document.querySelector(".tongGiaBan");
// Xoá sản phẩm theo bộ

if (iconRemoves) {
    iconRemoves.forEach((item) => {
        item.addEventListener("click", (e) => {
            let total = +giaBan.textContent
                .split("")
                .filter((item) => item !== "đ" && item !== ".")
                .join("");
            let totalOld = +tongGiaBan.textContent
                .split("")
                .filter((item) => item !== "đ" && item !== ".")
                .join("");

            let buyCombo = e.target.parentElement.parentElement;
            let buyComboList = buyCombo.parentElement;
            let buyComboLists = buyCombo.parentElement.parentElement;
            const buyAllPrice = +buyComboList
                .querySelector(".buy-price")
                .textContent.split("")
                .filter((item) => item !== "đ" && item !== ".")
                .join("");
            const buyAllOld = +buyComboList
                .querySelector(".buy-price--old")
                .textContent.split("")
                .filter((item) => item !== "đ" && item !== ".")
                .join("");
            buyComboLists.removeChild(buyComboList);
            if (buyAllPrice) {
                const price = total - buyAllPrice;
                giaBan.innerHTML = `${price.toLocaleString()}<sup>đ</sup>`;
            }
            if (buyAllOld) {
                const priceOld = totalOld - buyAllOld;
                tongGiaBan.innerHTML = `${priceOld.toLocaleString()}<sup>đ</sup>`;
            }

            // Cách 2
            // buyAllOld.forEach((ol) => {
            //     const priceOld = parseFloat(ol.textContent);
            //     totalAll += priceOld;
            // });
            // console.log(totalAll);
            // buyAllPrice.forEach((el) => {
            //     const price = parseFloat(el.textContent);
            //     total += price;
            // });
            // giaBan.innerHTML = `${total.toFixed(3)}đ`;
            // tongGiaBan.innerHTML = `${totalAll.toFixed(3)}đ`;
        });
    });
}
// info
if (infoList) {
    infoList.forEach((item) => {
        item.addEventListener("click", (el) => {
            infoList.forEach((it) => it.classList.remove("active"));
            el.target.classList.add("active");
        });
    });
}

if (iconDropdown) {
    iconDropdown.addEventListener("click", (e) => {
        e.target.classList.toggle("fa-caret-up");
        accordionShow.classList.toggle("show");
    });
}

if (listProduct) {
    showInfoOrder.addEventListener("click", function () {
        if (show) {
            showAllProduct.classList.toggle("show");
            showInfoOrder.innerHTML = `Ẩn thông tin đơn hàng <i class="fa fa-caret-up" aria-hidden="true"></i> `;
            show = false;
        } else {
            showAllProduct.classList.remove("show");
            showInfoOrder.innerHTML = `Hiển thị thông tin đơn hàng <i class="fa fa-caret-down" aria-hidden="true"></i> `;
            show = true;
        }
    });
}
selectDonVi.forEach((item) => {
    selectDonVi[0].classList.add("active");
    item.addEventListener("click", (event) => {
        selectDonVi.forEach((el) => el.classList.remove("active"));
        event.target.classList.add("active");
    });
});
const codeSaleLabel = document.querySelectorAll(".code__sale-label");

codeSaleLabel.forEach((item) => {
    codeSaleLabel[0].classList.add("active");
    item.addEventListener("click", (event) => {
        codeSaleLabel.forEach((el) => el.classList.remove("active"));
        event.target.classList.add("active");
    });
});
window.addEventListener("load", function () {
    window.addEventListener("scroll", function (e) {
        const heightScroll = window.pageYOffset;

        const topBar = navToggle.parentElement.parentElement;
        if (heightScroll > headerHeight) {
            // navToggle.classList.add("active");
            navToggle.style.transform = "translateY(100%)";
        } else {
            navToggle.style.transform = "translateY(-100%)";
            // navToggle.classList.remove("active");
        }
    });

    function countdown(date) {
        const endDate = new Date(date).getTime();

        const currentDate = new Date();

        if (isNaN(endDate) && endDate - currentDate <= 0) return;
        setInterval(caculate, 1000);

        function caculate() {
            let days, hours, minutes, seconds;
            const now = new Date();

            // Đổi ra timestamp ra milisecond
            const startDate = now.getTime();
            // Time còn lại
            let timeRemaining = parseInt((endDate - startDate) / 1000);
            if (timeRemaining <= 0) return;
            days = parseInt(timeRemaining / 86400);
            timeRemaining = timeRemaining % 86400;

            hours = parseInt(timeRemaining / 3600);
            timeRemaining = timeRemaining % 3600;

            minutes = parseInt(timeRemaining / 60);
            timeRemaining = timeRemaining % 60;

            seconds = parseInt(timeRemaining);

            if (daysText) {
                daysText.textContent = days >= 10 ? days : `0${days}`;
            }
            if (hoursText) {
                hoursText.textContent = hours >= 10 ? hours : `0${hours}`;
            }
            if (minutesText) {
                minutesText.textContent =
                    minutes >= 10 ? minutes : `0${minutes}`;
            }
            if (secondsText) {
                secondsText.textContent =
                    seconds >= 10 ? seconds : `0${seconds}`;
            }
        }
    }
    countdown(timeCountDown);
});

$(document).ready(function () {
    $(".product-list").slick({
        slidesToShow: 5,
        slidesToScroll: 2,
        infinite: false,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: true,
        dots: true,
        prevArrow:
            "<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
        nextArrow:
            "<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 2,
                    infinite: true,
                    dots: true,
                },
            },
            {
                breakpoint: 740,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    dots: true,
                    arrows: false,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true,
                    arrows: false,
                },
            },
        ],
    });
});
const callToACtionbtns = document.querySelectorAll(".order__info-item");
callToACtionbtns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        callToACtionbtns.forEach((el) => el.classList.remove("borderr"));
        e.target.classList.add("borderr");
    });
});
