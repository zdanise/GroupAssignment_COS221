<script>

  // Handle the sorting
  var sortSelect = document.getElementById("sort-select");
  sortSelect.addEventListener("change", function () {
    var wineList = document.querySelector(".wine-list");
    var wineItems = Array.from(wineList.getElementsByClassName("wine-item"));
    wineItems.sort(function (a, b) {
      var sortBy = sortSelect.value;
      var aValue = a.querySelector("h3").textContent;
      var bValue = b.querySelector("h3").textContent;
      if (sortBy === "price") {
        aValue = parseFloat(a.getAttribute("data-price"));
        bValue = parseFloat(b.getAttribute("data-price"));
      } else if (sortBy === "year") {
        aValue = parseInt(a.getAttribute("data-year"));
        bValue = parseInt(b.getAttribute("data-year"));
      } else if (sortBy === "country") {
        aValue = a.getAttribute("data-country");
        bValue = b.getAttribute("data-country");
      }
      return aValue.localeCompare(bValue);
    });
    wineList.innerHTML = "";
    wineItems.forEach(function (item) {
      wineList.appendChild(item);
    });
  });

  // Code for searching wines
  var searchForm = document.getElementById("search-form");
  searchForm.addEventListener("submit", function (e) {
    e.preventDefault();
    var searchTerm = document.getElementById("search-input").value.toLowerCase();
    var wineItems = Array.from(document.querySelectorAll(".wine-item"));
    wineItems.forEach(function (item) {
      var wineName = item.querySelector("h3").textContent.toLowerCase();
      if (wineName.includes(searchTerm)) {
        item.style.display = "block";
      } else {
        item.style.display = "none";
      }
    });
  });

  // Code for opening and closing wine details popup
  var wineItems = document.querySelectorAll(".wine-item");
  var popup = document.querySelector(".popup");
  var popupClose = document.querySelector(".popup-close");

  wineItems.forEach(function (item) {
    item.addEventListener("click", function () {
      popup.style.display = "block";
    });
  });

  popupClose.addEventListener("click", function () {
    popup.style.display = "none";
  });

  // Close popup when clicking outside of it
  window.addEventListener("click", function (e) {
    if (e.target === popup) {
      popup.style.display = "none";
    }
  });
