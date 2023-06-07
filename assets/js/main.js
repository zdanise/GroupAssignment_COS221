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
    $("#swiper").hide();
}

function closePopup() {
    document.getElementById("popup").style.display = "none";
}

function submitSelection() {
    var comboValue = document.getElementById("combo").value;
    var searchValue = document.getElementById("search").value.trim();
    var jsonData = {};

    if (comboValue !== "All") {
        jsonData.tables = comboValue;
    }

    if (searchValue !== "") {
        jsonData.searchfor = searchValue;
    
    }

    handleresponse(jsonData);
    closePopup();
}
function flipCard(card) {
    $(card).find('.card-inner').eq(0).toggleClass('flipped');
}

function addingElements(element){
    var divElement = $('<div>').addClass('swiper-slide discover__card');
    var cardInnerElement = $('<div>').addClass('card-inner');
    var cardFrontElement = $('<div>').addClass('card-front');
    var imgElement = $('<img>').attr('src', element.image_url).addClass('discover__img');
    var discoverDataElement = $('<div>').addClass('discover__data');
    var h2Element = $('<h2>').addClass('discover__title').text(element.winery_name);
    discoverDataElement.append(h2Element);
    cardFrontElement.append(imgElement, discoverDataElement);
    var cardBackElement = $('<div>').addClass('card-back');
    cardInnerElement.append(cardFrontElement, cardBackElement);
    divElement.append(cardInnerElement);
    divElement.on('click', ()=> {flipCard(divElement)});
    $('.swiper-wrapper').append(divElement);
    let destiitemsName = $('<h2>').text("Winery name: " + element.winery_name);
    let destiitemsLocation = $('<p>').text("Location: " + element.location);
    cardBackElement.append(destiitemsName, destiitemsLocation);
    cardBackElement.css('flex-direction', 'column');
    cardBackElement.css('justify-content', 'flex-start');
    return cardBackElement;
}

  
function handleresponse(jsonData) {
    console.log(jsonData);
    $.ajax({
        url: 'destination.php',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(jsonData),
        success: function(data) {
            console.log(data);
            $('.swiper').empty();
            $(".swipers").hide();
            $('.swiper').append('<div class="swiper-wrapper"></div>');
            if (data=="No wines found" || data.data.length==0){
                const noWines = $('<p>').text("No wineries found");
                $('.swiper-wrapper').append(noWines);
                $('.swiper-wrapper').css('justify-content', 'center');
                $("#swiper").show();
                return;
            }
            $('.swiper').append('<div class="swiper-button-prev swipers"></div>');
            $('.swiper').append('<div class="swiper-button-next swipers"></div>');
            $('.swiper').append('<script>\
                    swiper = new Swiper(".swiper", {\
                    direction: "horizontal",\
                    loop: true,\
                    navigation: {\
                        nextEl: ".swiper-button-next",\
                        prevEl: ".swiper-button-prev",\
                    },\
                });\
            </script>');


            if (data.type === "farm") {
                data.data.forEach(element => {
                    console.log(1);
                    let card = addingElements(element);
                    const destiitemsFamily = $('<p>').text("Family: " + element.Family_name);
                    const destiitemsRestaurant = $('<p>').text("Restaurant: " + element.Restaurant);
                    $(card).append(destiitemsFamily, destiitemsRestaurant);
                });
            } else if (data.type === "vineyard") {
                data.data.forEach(element => {
                    let card = addingElements(element);
                    const destiitemsReservations = $('<p>').text("Available reservations: " + element.Reservations);
                    const destiitemsTutorial = $('<p>').text("Time: " + element.tutorials);
                    $(card).append(destiitemsReservations, destiitemsTutorial);

                    
                });
            } else if (data.type === "Everything") {
                data.data.forEach(element => {
                    console.log(1);
                    let card = addingElements(element);
                    $("#swiper").show();
                    
                });
            } else if (data.type === "destination") {
                data.data.forEach(element => {
                    let card = addingElements(element);
                    const destiitemsBnB = $('<p>').text("BnB: " + element.BnB_Name);
                    $(card).append(destiitemsBnB);
                });
            }
            $("#swiper").show();
        },
        error: function(error) {
            console.error(error);
        }
    });
    
}
