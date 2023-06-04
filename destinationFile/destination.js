// const formData = {
   
//     phone: '0579486846392',
//     address: 'Cape TOWN',
  
//   };
  
//   const requestOptions = {
//     method: 'POST',
//     headers: {
//       'Content-Type': 'application/json',
//     },
//     body: JSON.stringify(formData),
//   };





//         fetch('destination.php',requestOptions)
//         .then(response => response.json())
//         .then(data => {
//            if(data.type==="Farm")
//            {





//             const desti = document.getElementById('destination');
//             data.forEach(destiitems => {
         
//               const destiDiv = document.createElement('div');
//               const destiitemsImage = document.createElement('img');
//               const destiitemsName = document.createElement('h2');
//               const destiitemsLocation = document.createElement('p');
//               const destiitemsFamily = document.createElement('p');
             
              
//               //destiitemsImage.src = destiitems.data.image_url;
//              // destiitemsImage.alt ="destiitems Image";
//               destiitemsName.textContent = "Winery name"+destiitems.data.winery_name;
            
//               destiitemsLocation.textContent ="Location: " + destiitems.data.location;
//               destiitemsFamily.textContent = "Family: " +destiitems.data.Family_name;
             
              
           
//               destiitemsDiv.appendChild(destiitemsName);
//               destiitemsDiv.appendChild(destiitemsLocation);
//              // destiitemsDiv.appendChild(destiitemsImage);
//               destiitemsDiv.appendChild(destiitemsFamily);
           
//               destiitemsList.appendChild(destiitemsDiv);
//             });












//            }

//            else if(data.type==="vineyard")
//            {  
            
            
//             const desti = document.getElementById('destination');
//             data.forEach(destiitems => {
         
//               const destiDiv = document.createElement('div');
//               const destiitemsImage = document.createElement('img');
//               const destiitemsName = document.createElement('h2');
//               const destiitemsLocation = document.createElement('p');


//               const destiitemsReservations = document.createElement('p');
//               const destiitemsTutorial = document.createElement('p');
             
             
              
//              // destiitemsImage.src = destiitems.data.image_url;
//              // destiitemsImage.alt ="destiitems Image";
//               destiitemsName.textContent = "Winery name"+destiitems.data.winery_name;
            
//               destiitemsLocation.textContent ="Location : " + destiitems.data.location;
//               destiitemsReservations.textContent = "Available reservations : " +destiitems.data.Reservations;
//               destiitemsTutorial.textContent = "Time : " +destiitems.data.tutorials;
             
           
//               destiitemsDiv.appendChild(destiitemsName);
//               destiitemsDiv.appendChild(destiitemsLocation);
//               //destiitemsDiv.appendChild(destiitemsImage);
//               destiitemsDiv.appendChild( destiitemsReservations);
//               destiitemsDiv.appendChild( destiitemsTutorial);
           
//               destiitemsList.appendChild(destiitemsDiv);
//             });


//            }
//            else if(data.type==="Everything")
//            {

//             const desti = document.getElementById('destination');
//             data.forEach(destiitems => {
         
//               const destiDiv = document.createElement('div');
//               const destiitemsImage = document.createElement('img');
//               const destiitemsName = document.createElement('h2');
//               const destiitemsLocation = document.createElement('p');


              
             
              
//               //destiitemsImage.src = destiitems.data.image_url;
//               //destiitemsImage.alt ="destiitems Image";
//               destiitemsName.textContent = "Winery name  "+destiitems.data.winery_name;
            
//               destiitemsLocation.textContent ="Location : " + destiitems.data.location;
             
             
           
//               destiitemsDiv.appendChild(destiitemsName);
//               destiitemsDiv.appendChild(destiitemsLocation);
//              // destiitemsDiv.appendChild(destiitemsImage);
           
//               destiitemsList.appendChild(destiitemsDiv);
//             });

//            }
//            else if(data.type==="destination")
//            {
//             const desti = document.getElementById('destination');
//             data.forEach(destiitems => {
         
//               const destiDiv = document.createElement('div');
//               const destiitemsImage = document.createElement('img');
//               const destiitemsName = document.createElement('h2');
//               const destiitemsLocation = document.createElement('p');


//               const destiitemsBnB = document.createElement('p');
             
             
             
              
//              // destiitemsImage.src = destiitems.data.image_url;
//              // destiitemsImage.alt ="destiitems Image";
//               destiitemsName.textContent = "Winery name"+destiitems.data.winery_name;
            
//               destiitemsLocation.textContent ="Location : " + destiitems.data.location;
//               destiitemsBnB.textContent = "BnB : "+destiitems.data.BnB;
             
             
           
//               destiitemsDiv.appendChild(destiitemsName);
//               destiitemsDiv.appendChild(destiitemsLocation);
//              // destiitemsDiv.appendChild(destiitemsImage);
           
//               destiitemsList.appendChild(destiitemsDiv);
//             });
//            }

          
//         })
//         .catch(error => {
//           console.error('Error:', error);
//         });

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

        destiitemsName.textContent = "Winery name: " + destiitems.winery_name;
        destiitemsLocation.textContent = "Location: " + destiitems.location;
        destiitemsFamily.textContent = "Family: " + destiitems.Family_name;

        destiDiv.appendChild(destiitemsName);
        destiDiv.appendChild(destiitemsLocation);
        destiDiv.appendChild(destiitemsFamily);

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

        destiitemsName.textContent = "Winery name: " + destiitems.winery_name;
        destiitemsLocation.textContent = "Location: " + destiitems.location;
        destiitemsReservations.textContent = "Available reservations: " + destiitems.Reservations;
        destiitemsTutorial.textContent = "Time: " + destiitems.tutorials;

        destiDiv.appendChild(destiitemsName);
        destiDiv.appendChild(destiitemsLocation);
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
