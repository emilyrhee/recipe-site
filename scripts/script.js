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

  const searchInput = document.getElementById('searching');
  searchInput.addEventListener('keyup', search);
});

document.addEventListener("click", function (event) {
  const isClickInside = filterFormContainer.contains(event.target) || filterToggleBtn.contains(event.target);

  if (!isClickInside) {
    filterFormContainer.classList.add("d-none");
  }
});

function search() {
  var query = new FormData();
  query.append('searching', document.getElementById("searching").value);
  var xhr = new XMLHttpRequest();
  xhr.open('POST', '../UserFeatures/recipe_title_storage.php');
  xhr.onload = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      const resultDiv = document.getElementById("result");
      resultDiv.innerHTML = xhr.responseText.trim();

      if (xhr.responseText.trim() !== "") {
        resultDiv.classList.add("active");
      } else {
        resultDiv.classList.remove("active");
      }
    }
    document.addEventListener('click', function (e) {
      const resultDiv = document.getElementById('result');
      if (!e.target.closest('form')) {
        resultDiv.classList.remove('active');
      }
    });
  };
  xhr.send(query);
}