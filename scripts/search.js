document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.getElementById('searching');
  searchInput.addEventListener('keyup', search);
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

      resultDiv.classList.add("active");
    }
    document.addEventListener('click', function (e) {
      const resultDiv = document.getElementById('result');
      if (!e.target.closest('form')) {
        resultDiv.classList.remove('active');
      }
    });
  };
  xhr.send(query);
  
  console.log("debug");
}