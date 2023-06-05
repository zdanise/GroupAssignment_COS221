

const formData = {
  phone: '0579486846392',
  address: 'Cape TOWN',
};

const requestOptions = {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
  },
  body: JSON.stringify(formData),
};

fetch('destination.php', requestOptions)
  .then(response => response.json())
  .then(data => {
    if (data.type === "Farm") {
      const desti = document.getElementById('destination');
      data.data.forEach(destiitems => {
        const destiDiv = document.createElement('div');
        const destiitemsImage = document.createElement('img');
        const destiitemsName = document.createElement('h2');
        const destiitemsLocation = document.createElement('p');
        const destiitemsFamily = document.createElement('p');
        const destiitemsRestaurant=document.createElement('p');

        destiitemsName.textContent = "Winery: " + destiitems.winery_name;
        destiitemsLocation.textContent = "Location: " + destiitems.location;
        destiitemsFamily.textContent = "Family: " + destiitems.Family_name;
        destiitemsRestaurant.textContent = "Restaurant: " + destiitems.Restaurant_name;
        destiitemsImage.src = destiitems.image_url;



        destiDiv.appendChild(destiitemsImage);
        destiDiv.appendChild(destiitemsName);
        destiDiv.appendChild(destiitemsLocation);
        destiDiv.appendChild(destiitemsFamily);
        destiDiv.appendChild(destiitemsRestaurant);

        desti.appendChild(destiDiv);
      });
    } else if (data.type === "vineyard") {
      const desti = document.getElementById('destination');
      data.data.forEach(destiitems => {
        const destiDiv = document.createElement('div');
        const destiitemsImage = document.createElement('img');
        const destiitemsName = document.createElement('h2');
        const destiitemsLocation = document.createElement('p');
        const destiitemsReservations = document.createElement('p');
        const destiitemsTutorial = document.createElement('p');
        destiitemsReservations.textContent = "Available reservations: " + destiitems.Reservations;
        destiitemsTutorial.textContent = "Time: " + destiitems.tutorials;
        destiitemsImage.src = destiitems.image_url;
        destiDiv.appendChild(destiitemsReservations);
        destiDiv.appendChild(destiitemsTutorial);

        desti.appendChild(destiDiv);
      });
    } else if (data.type === "Everything") {
      const desti = document.getElementById('destination');
      data.data.forEach(destiitems => {
        const destiDiv = document.createElement('div');
        const destiitemsImage = document.createElement('img');
        const destiitemsName = document.createElement('h2');
        const destiitemsLocation = document.createElement('p');

        destiitemsName.textContent = "Winery name: " + destiitems.winery_name;
        destiitemsLocation.textContent = "Location: " + destiitems.location;
        destiitemsImage.src = destiitems.image_url;


        destiDiv.appendChild(destiitemsImage);
        destiDiv.appendChild(destiitemsName);
        destiDiv.appendChild(destiitemsLocation);

        desti.appendChild(destiDiv);
      });
    } else if (data.type === "destination") {
      const desti = document.getElementById('destination');
      data.data.forEach(destiitems => {
        const destiDiv = document.createElement('div');
        const destiitemsImage = document.createElement('img');
        const destiitemsName = document.createElement('h2');
        const destiitemsLocation = document.createElement('p');
        const destiitemsBnB = document.createElement('p');

        destiitemsName.textContent = "Winery name: " + destiitems.winery_name;
        destiitemsLocation.textContent = "Location: " + destiitems.location;
        destiitemsBnB.textContent = "BnB: " + destiitems.BnB;
        destiitemsImage.src = destiitems.image_url;

        destiDiv.appendChild(destiitemsImage);
        destiDiv.appendChild(destiitemsName);
        destiDiv.appendChild(destiitemsLocation);
        destiDiv.appendChild(destiitemsBnB);

        desti.appendChild(destiDiv);
      });
    }
  })
  .catch(error => {
    console.error('Error:', error);
  });
