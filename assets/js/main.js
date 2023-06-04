/*==================== SHOW MENU ====================*/
const navMenu = document.getElementById('nav-menu'),
      navToggle = document.getElementById('nav-toggle'),
      navClose = document.getElementById('nav-close')

/*===== MENU SHOW =====*/
/* Validate if constant exists */
if(navToggle){
    navToggle.addEventListener('click', () =>{
        navMenu.classList.add('show-menu')
    })
}

/*===== MENU HIDDEN =====*/
/* Validate if constant exists */
if(navClose){
    navClose.addEventListener('click', () =>{
        navMenu.classList.remove('show-menu')
    })
}

/*==================== REMOVE MENU MOBILE ====================*/
const navLink = document.querySelectorAll('.nav__link')

function linkAction(){
    const navMenu = document.getElementById('nav-menu')
    // When we click on each nav__link, we remove the show-menu class
    navMenu.classList.remove('show-menu')
}
navLink.forEach(n => n.addEventListener('click', linkAction))

// pop-up
function openPopup() {
    document.getElementById("popup").style.display = "block";
}

function closePopup() {
    document.getElementById("popup").style.display = "none";
}

function submitSelection() {
    var comboValue = document.getElementById("combo").value;
    var searchValue = document.getElementById("search").value.trim();
    if (comboValue !== "All" && searchValue !== "") {
        var jsonData = {
            table: comboValue,
            searchfor: searchValue
        };
        console.log(jsonData);
    }
    else if (comboValue !== "All"){
        var jsonData= {
            table: comboValue,
        };
    }
    else if (searchValue !== ""){
        var jsonData= {
            table: "winery",
            searchfor : searchValue
        };

    }
    else{
        var jsonData= {
            table: "winery"
        };

    }
    closePopup();
    const requestOptions = {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(jsonData),
    };
}
function flipCard(card) {
    card.getElementsByClassName('card-inner')[0].classList.toggle('flipped');
}

  
function handleresponse(){
    fetch('destination.php',requestOptions)
        .then(response => response.json())
        .then(data => {
           if(data.type==="Farm")
           {





            const desti = document.getElementById('destination');
            data.forEach(destiitems => {
         
              const destiDiv = document.createElement('div');
              const destiitemsImage = document.createElement('img');
              const destiitemsName = document.createElement('h2');
              const destiitemsLocation = document.createElement('p');
              const destiitemsFamily = document.createElement('p');
             
              
              destiitemsImage.src = destiitems.data.image_url;
              destiitemsImage.alt ="destiitems Image";
              destiitemsName.textContent = "Winery name"+destiitems.data.winery_name;
            
              destiitemsLocation.textContent ="Location: " + destiitems.data.location;
              destiitemsFamily.textContent = "Family: " +destiitems.data.Family_name;
             
              
           
              destiitemsDiv.appendChild(destiitemsName);
              destiitemsDiv.appendChild(destiitemsLocation);
              destiitemsDiv.appendChild(destiitemsImage);
              destiitemsDiv.appendChild(destiitemsFamily);
           
              destiitemsList.appendChild(destiitemsDiv);
            });












           }

           else if(data.type==="vineyard")
           {  
            
            
            const desti = document.getElementById('destination');
            data.forEach(destiitems => {
         
              const destiDiv = document.createElement('div');
              const destiitemsImage = document.createElement('img');
              const destiitemsName = document.createElement('h2');
              const destiitemsLocation = document.createElement('p');


              const destiitemsReservations = document.createElement('p');
              const destiitemsTutorial = document.createElement('p');
             
             
              
              destiitemsImage.src = destiitems.data.image_url;
              destiitemsImage.alt ="destiitems Image";
              destiitemsName.textContent = "Winery name"+destiitems.data.winery_name;
            
              destiitemsLocation.textContent ="Location : " + destiitems.data.location;
              destiitemsReservations.textContent = "Available reservations : " +destiitems.data.Reservations;
              destiitemsTutorial.textContent = "Time : " +destiitems.data.tutorials;
             
           
              destiitemsDiv.appendChild(destiitemsName);
              destiitemsDiv.appendChild(destiitemsLocation);
              destiitemsDiv.appendChild(destiitemsImage);
              destiitemsDiv.appendChild( destiitemsReservations);
              destiitemsDiv.appendChild( destiitemsTutorial);
           
              destiitemsList.appendChild(destiitemsDiv);
            });


           }
           else if(data.type==="Everything")
           {

            const desti = document.getElementById('destination');
            data.forEach(destiitems => {
         
              const destiDiv = document.createElement('div');
              const destiitemsImage = document.createElement('img');
              const destiitemsName = document.createElement('h2');
              const destiitemsLocation = document.createElement('p');


              
             
              
              destiitemsImage.src = destiitems.data.image_url;
              destiitemsImage.alt ="destiitems Image";
              destiitemsName.textContent = "Winery name  "+destiitems.data.winery_name;
            
              destiitemsLocation.textContent ="Location : " + destiitems.data.location;
             
             
           
              destiitemsDiv.appendChild(destiitemsName);
              destiitemsDiv.appendChild(destiitemsLocation);
              destiitemsDiv.appendChild(destiitemsImage);
           
              destiitemsList.appendChild(destiitemsDiv);
            });

           }
           else if(data.type==="destination")
           {
            const desti = document.getElementById('destination');
            data.forEach(destiitems => {
         
              const destiDiv = document.createElement('div');
              const destiitemsImage = document.createElement('img');
              const destiitemsName = document.createElement('h2');
              const destiitemsLocation = document.createElement('p');


              const destiitemsBnB = document.createElement('p');
             
             
             
              
              destiitemsImage.src = destiitems.data.image_url;
              destiitemsImage.alt ="destiitems Image";
              destiitemsName.textContent = "Winery name"+destiitems.data.winery_name;
            
              destiitemsLocation.textContent ="Location : " + destiitems.data.location;
              destiitemsBnB.textContent = "BnB : "+destiitems.data.BnB;
             
             
           
              destiitemsDiv.appendChild(destiitemsName);
              destiitemsDiv.appendChild(destiitemsLocation);
              destiitemsDiv.appendChild(destiitemsImage);
           
              destiitemsList.appendChild(destiitemsDiv);
            });
           }

          
        })
        .catch(error => {
          console.error('Error:', error);
        });
}

