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
  const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
  toastTrigger.addEventListener("click", () => {
    toastBootstrap.show();
  });
}
$(document).ready(function() {
  $(document).on('click', '.collapse-sidebar', function() {
      const $icon = $(this);
      const leftArrowClass = 'fa-solid fa-bars';
      const rightArrowClass = 'fa-solid fa-x';
      
      // Change icon direction and class toggling
      $icon.removeClass('collapse-sidebar').addClass('sidebar-back');
      $icon.removeClass(leftArrowClass).addClass(rightArrowClass);
      $('.iq-sidebar').addClass('collapse-sidebar');
      $('.content').addClass('collapse-content');
      $('.iq-navbar-custom').addClass('remove-radius')
  });

  $(document).on('click', '.sidebar-back', function() {
      const $icon = $(this);
      const leftArrowClass = 'fa-solid fa-bars';
      const rightArrowClass = 'fa-solid fa-x';
      
      // Revert icon direction and class toggling
      $icon.removeClass('sidebar-back').addClass('collapse-sidebar');
      $icon.removeClass(rightArrowClass).addClass(leftArrowClass);
      $('.iq-sidebar').removeClass('collapse-sidebar');
      $('.content').removeClass('collapse-content');
      $('.iq-navbar-custom').removeClass('remove-radius')
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



document.addEventListener("DOMContentLoaded", function () {
  const btn = document.querySelector('.btn[data-bs-target="#exampleModalToggle2"]');
  const modalElement = document.getElementById('exampleModalToggle2');

  if (btn && modalElement) {
    btn.addEventListener('click', function () {
      modalElement.addEventListener('shown.bs.modal', function () {
        setTimeout(function () {
          const modal = bootstrap.Modal.getInstance(modalElement);
          if (modal) {
            modal.hide();
          }
        }, 1500);
      }, { once: true });
    });
  }
});

 // Color Picker Logic
 document.querySelectorAll('.color-select-btn').forEach((btn, index) => {
  const colorPicker = document.querySelectorAll('.colorPicker')[index];
  btn.addEventListener('click', () => {
      colorPicker.click();
  });
  colorPicker.addEventListener('input', (event) => {
      btn.style.backgroundColor = event.target.value;
  });
});

// Image Upload Logic
document.querySelectorAll('.imageUpload').forEach((input, index) => {
  const status = document.querySelectorAll('.imageStatus')[index];
  input.addEventListener('change', function () {
      if (this.files.length > 0) {
          status.textContent = this.files[0].name; // Display file name
      } else {
          status.textContent = 'No Image Selected';
      }
  });
});


