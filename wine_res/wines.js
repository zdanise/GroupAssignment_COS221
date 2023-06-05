// SEARCH FUNCTIONALITY
function sortWines() {
  var wineList = document.querySelector('.wine-list');
  var wineItems = Array.from(wineList.getElementsByClassName('wine-item'));
  var sortOption = document.getElementById('sort-option').value;
  var sortOrder = document.getElementById('sort-order').value;

  wineItems.sort(function (a, b) {
    var valueA = a.querySelector('[data-attribute="' + sortOption + '"]').innerText.slice(sortOption.length + 2);
    var valueB = b.querySelector('[data-attribute="' + sortOption + '"]').innerText.slice(sortOption.length + 2);

    if (sortOption === 'price' || sortOption === 'year') {
      valueA = parseInt(valueA);
      valueB = parseInt(valueB);
    }

    if (sortOrder === 'asc') {
      return valueA - valueB;
    } else {
      return valueB - valueA;
    }
  });

  wineItems.forEach(function (item) {
    wineList.appendChild(item);
  });
}

function searchWines() {
  var searchTerm = document.getElementById('wine-search').value.toLowerCase();
  var wineItems = Array.from(document.getElementsByClassName('wine-item'));

  wineItems.forEach(function (item) {
    var wineName = item.querySelector('h3').innerText.toLowerCase();
    if (wineName.includes(searchTerm)) {
      item.style.display = 'block';
    } else {
      item.style.display = 'none';
    }
  });
}


//
// CREATE THE DUMMY LIST OF WINE
// Define the wine list data
const wineList = [
  {
    name: "Wine 1",
    price: "R220",
    year: "2020",
    country: "Italy"
  },
  {
    name: "Wine 2",
    price: "R180",
    year: "2018",
    country: "France"
  },
];

// DISPLAY THE DUMMY LIST
function renderWineList() {
  const wineListContainer = document.querySelector(".wine-list");
  wineListContainer.innerHTML = ""; // Clear the container

  wineList.forEach((wine, index) => {
    const wineItem = document.createElement("div");
    wineItem.classList.add("wine-item");

    const wineImage = document.createElement("img");
    wineImage.src = "https://www.princewinestore.com.au/media/catalog/product/placeholder/default/placeholder-2.png";
    wineImage.wineName = "wine" + (index + 1);
    wineImage.alt = "Wine " + (index + 1);
    wineItem.appendChild(wineImage);

    const wineName = document.createElement("h3");
    wineName.classList.add("wine-details");
    wineName.textContent = wine.name;
    wineItem.appendChild(wineName);

    const wineDetails = document.createElement("div");
    wineDetails.classList.add("wine-details");
    wineDetails.id = "details-" + (index + 1);

    const price = document.createElement("p");
    price.dataset.attribute = "price";
    price.textContent = "Price: " + wine.price;
    wineDetails.appendChild(price);

    const year = document.createElement("p");
    year.dataset.attribute = "year";
    year.textContent = "Year: " + wine.year;
    wineDetails.appendChild(year);

    const country = document.createElement("p");
    country.dataset.attribute = "country";
    country.textContent = "Country: " + wine.country;
    wineDetails.appendChild(country);

    wineItem.appendChild(wineDetails);

    const addToCartButton = document.createElement("button");
    addToCartButton.id = "add-to-cart";
    addToCartButton.textContent = "Add to Cart";
    wineItem.appendChild(addToCartButton);

    wineListContainer.appendChild(wineItem);
  });
}

// SORTING
function sortWines() {
  const sortOption = document.getElementById("sort-option").value;
  const sortOrder = document.getElementById("sort-order").value;

  wineList.sort((a, b) => {
    let valueA = a[sortOption].toLowerCase();
    let valueB = b[sortOption].toLowerCase();

    if (sortOrder === "desc") {
      [valueA, valueB] = [valueB, valueA];
    }

    if (valueA < valueB) {
      return -1;
    } else if (valueA > valueB) {
      return 1;
    }
    return 0;
  });
  renderWineList();
}
