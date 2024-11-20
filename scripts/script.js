const handleVisibility = () => {
  const blurred = document.querySelector('.the-blur-screen');
  if (blurred != null) {
    if (window.scrollY < 100) {
      blurred.style.visibility = "visible";
    } else {
      blurred.style.visibility = "hidden";
    }
  }
};

window.addEventListener('scroll', handleVisibility());

document.addEventListener("DOMContentLoaded", function () {
  const filterToggleBtn = document.getElementById("filterToggleBtn");
  const filterFormContainer = document.getElementById("filterFormContainer");

  filterToggleBtn.addEventListener("click", () => {
    filterFormContainer.classList.toggle("d-none");
  });

  const sidebarToggleBtn = document.getElementById("sidebarToggleBtn");

  sidebarToggleBtn.addEventListener("click", () => {
    sidebarFormContainer.classList.toggle("d-none");
  });
});

document.addEventListener("click", function (event) {
  const isClickInside = filterFormContainer.contains(event.target) || filterToggleBtn.contains(event.target);

  if (!isClickInside) {
    filterFormContainer.classList.add("d-none");
  }
});
