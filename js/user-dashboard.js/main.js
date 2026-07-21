$(document).ready(function () {
    function handleSidebar() {
        if (window.innerWidth <= 991.6) {
            $(".open-sidebar").show();
            $(".close-sidebar").hide();
            $(".iq-sidebar").hide();
        } else {
            $(".iq-sidebar").show();
            $(".open-sidebar, .close-sidebar").hide();
        }
    }
    handleSidebar();
    $(window).on("resize", handleSidebar);
    $(".open-sidebar").on("click", function () {
        $(".iq-sidebar").show();
        $(".open-sidebar").hide();
        $(".close-sidebar").show();
    });
    $(".close-sidebar").on("click", function () {
        $(".iq-sidebar").hide();
        $(".close-sidebar").hide();
        $(".open-sidebar").show();
    });
});
$(document).on("click", ".wrapper-menu", function () {
    $(this).toggleClass("open");
});

$(document).on("click", ".wrapper-menu", function () {
    $("body").toggleClass("sidebar-main");
});

$(document).ready(function () {
    $("#chat-start").on("click", function () {
        $(".chat-data-left").toggleClass("show");
    });

    $(".close-btn-res").on("click", function () {
        $(".chat-data-left").removeClass("show");
    });

    $(".iq-chat-ui li").on("click", function () {
        $(".chat-data-left").removeClass("show");
    });

    $(".sidebar-toggle").on("click", function () {
        $(".chat-data-left").addClass("show");
    });
});

$(document).ready(function () {
    $(".todo-task-lists li").on("click", function () {
        const checkbox = $(this).find("input:checkbox[name=todo-check]");
        if (checkbox.is(":checked")) {
            checkbox.prop("checked", false);
            $(this).removeClass("active-task");
        } else {
            checkbox.prop("checked", true);
            $(this).addClass("active-task");
        }
    });
});

function checkClass(ele, type, className) {
    switch (type) {
        case "addClass":
            if (!ele.hasClass(className)) {
                ele.addClass(className);
            }
            break;
        case "removeClass":
            if (ele.hasClass(className)) {
                ele.removeClass(className);
            }
            break;
        case "toggleClass":
            ele.toggleClass(className);
            break;
    }
}

// $(".iq-sidebar-menu .active").each(function () {
//   $(this).addClass("show");
//   $(this).find(".iq-submenu .active").addClass("show");
// });

$(document).on(
    "click",
    ".iq-booking-screen .iq-booking-no .list-inline-item .iq-seat",
    function (e) {
        e.preventDefault();
        let sheet = 0;
        if (!$(this).hasClass("bg-secondary")) {
            $(this).toggleClass("active");
            sheet = $(".iq-booking-screen").find(".iq-seat.active").length;
            $(".iq-film-block").find("span").text(sheet);
        }
    }
);

$(document).on("click", ".ri-close-circle-line", function () {
    $(this).closest(".film-side").removeClass("film-side");
});

$(document).on("click", ".iq-film-block", function () {
    if (parseInt($(this).find("span").text()) > 0) {
        $(".iq-sidebar-right-menu").addClass("film-side");
    }
});
const toastTrigger = document.getElementById("liveToastBtn");
const toastLiveExample = document.getElementById("liveToast");

if (toastTrigger) {
    const toastBootstrap =
        bootstrap.Toast.getOrCreateInstance(toastLiveExample);
    toastTrigger.addEventListener("click", () => {
        toastBootstrap.show();
    });
}
$(document).ready(function () {
    $(document).on("click", ".collapse-sidebar", function () {
        const $icon = $(this);
        const leftArrowClass = "fa-solid fa-bars";
        const rightArrowClass = "fa-solid fa-x";

        // Change icon direction and class toggling
        $icon.removeClass("collapse-sidebar").addClass("sidebar-back");
        $icon.removeClass(leftArrowClass).addClass(rightArrowClass);
        $(".iq-sidebar").addClass("collapse-sidebar");
        $(".content").addClass("collapse-content");
        $(".iq-navbar-custom").addClass("remove-radius");
    });

    $(document).on("click", ".sidebar-back", function () {
        const $icon = $(this);
        const leftArrowClass = "fa-solid fa-bars";
        const rightArrowClass = "fa-solid fa-x";

        // Revert icon direction and class toggling
        $icon.removeClass("sidebar-back").addClass("collapse-sidebar");
        $icon.removeClass(rightArrowClass).addClass(leftArrowClass);
        $(".iq-sidebar").removeClass("collapse-sidebar");
        $(".content").removeClass("collapse-content");
        $(".iq-navbar-custom").removeClass("remove-radius");
    });
});

// INCLUDE JQUERY & JQUERY UI 1.12.1
$(function () {
    $("#from").datepicker({
        dateFormat: "dd-mm-yy",
        duration: "fast",
    });
    $("#to").datepicker({
        dateFormat: "dd-mm-yy",
        duration: "fast",
    });
    $(".dob").datepicker({
        dateFormat: "dd-mm-yy",
        duration: "fast",
    });
    $("#expiry-date").datepicker({
        dateFormat: "dd-mm-yy",
        duration: "fast",
    });
    $("#proposal-date").datepicker({
        dateFormat: "dd-mm-yy",
        duration: "fast",
    });
    $("#deadline").datepicker({
        dateFormat: "dd-mm-yy",
        duration: "fast",
    });
    $("#date").datepicker({
        dateFormat: "dd-mm-yy",
        duration: "fast",
    });
});

$(document).ready(function () {
    // Toggle password visibility when clicking on the toggle icon
    $(".togglePassword").on("click", function () {
        const passwordField = $(this).siblings("input"); // Select the input field
        const eyeIcon = $(this).find(".eyeIcon"); // Select the icon within the span
        const isPasswordVisible = passwordField.attr("type") === "password";

        // Toggle password visibility
        passwordField.attr("type", isPasswordVisible ? "text" : "password");

        // Change eye icon
        eyeIcon.toggleClass("fa-eye fa-eye-slash");
    });
});

//   permission page script

$(document).ready(function () {
    // Handle parent checkbox click
    $(".parent-checkbox").on("change", function () {
        let isChecked = $(this).is(":checked");
        $(this)
            .closest(".permission-module")
            .find(".child-checkbox")
            .prop("checked", isChecked);
    });

    // Handle child checkbox click
    $(".child-checkbox").on("change", function () {
        let $module = $(this).closest(".permission-module");
        let allChecked =
            $module.find(".child-checkbox").length ===
            $module.find(".child-checkbox:checked").length;
        $module.find(".parent-checkbox").prop("checked", allChecked);
    });
});
$(document).ready(function () {
    $("#single").intlTelInput({
        initialCountry: "sa", // Saudi Arabia as default
        utilsScript:
            "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js",
    });

    // Clear input value initially
    $("#single").val("");
});
document.addEventListener("DOMContentLoaded", () => {
    const percentElement = document.querySelector(".calculate-percent");
    if (!percentElement) return; // early exit if not found

    const percentText = percentElement.textContent.trim();
    const percentValue = parseFloat(percentText.replace("%", ""));

    const totalBars = 4;
    const percentPerBar = 100 / totalBars;
    const bars = document.querySelectorAll(".calculate-bar");

    bars.forEach((bar, index) => {
        const barStart = index * percentPerBar;
        const barEnd = (index + 1) * percentPerBar;

        let fillPercent = 0;

        if (percentValue >= barEnd) {
            fillPercent = 100;
        } else if (percentValue > barStart) {
            fillPercent = ((percentValue - barStart) / percentPerBar) * 100;
        }

        bar.style.setProperty("--fill", fillPercent + "%");
        bar.style.setProperty("--fill-width", fillPercent + "%");
        bar.style.setProperty("--fill-color", "#0C5B2C");

        const fillDiv = document.createElement("div");
        fillDiv.style.width = fillPercent + "%";
        fillDiv.style.height = "100%";
        fillDiv.style.backgroundColor = "#0C5B2C";
        fillDiv.style.position = "absolute";
        fillDiv.style.top = 0;
        fillDiv.style.left = 0;
        fillDiv.style.transition = "width 0.4s ease";
        bar.appendChild(fillDiv);
    });
});

function handleFileUpload(input, labelId, previewId) {
    const label = document.getElementById(labelId);
    const preview = document.getElementById(previewId);

    if (input.files.length > 0) {
        const fileName = input.files[0].name;
        label.textContent = fileName;

        // Show file icon
        preview.innerHTML = `
        <i class="bi bi-file-earmark-text fs-3 text-primary"></i>
        <strong>${fileName}</strong>
      `;
    }
}

function handleImageUpload(input, previewId, labelId) {
    const preview = document.getElementById(previewId);
    const label = document.getElementById(labelId);

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.innerHTML = `<img src="${e.target.result}" alt="Uploaded Image" class="img-fluid rounded" />`;
            label.textContent = input.files[0].name;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const startDateEl = document.getElementById("startDateLabel");
    const endDateEl = document.getElementById("endDateLabel");
    const progressEl = document.getElementById("durationProgress");
    const remainingEl = document.getElementById("daysRemaining");

    if (!startDateEl || !endDateEl || !progressEl || !remainingEl) return;

    // Read the date strings from HTML
    const startDateStr = startDateEl.textContent.trim();
    const endDateStr = endDateEl.textContent.trim();

    // Parse dates using US format (MM/DD/YYYY)
    const startDate = new Date(startDateStr);
    const endDate = new Date(endDateStr);
    const today = new Date();

    // Validate date parsing
    if (isNaN(startDate.getTime()) || isNaN(endDate.getTime())) {
        console.error("Invalid date format. Use MM/DD/YYYY in HTML.");
        return;
    }

    // Calculate duration and progress
    const totalTime = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));
    const timePassed = Math.ceil((today - startDate) / (1000 * 60 * 60 * 24));
    const daysRemaining = Math.max(0, totalTime - timePassed);
    const progressPercent = Math.min(
        100,
        Math.max(0, (timePassed / totalTime) * 100)
    );

    // Update progress bar
    progressEl.style.width = progressPercent + "%";
    remainingEl.innerText = `${daysRemaining} days remaining`;
});
