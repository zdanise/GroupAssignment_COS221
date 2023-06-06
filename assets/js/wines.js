let wines=[];
let orderby='ASC';
let sortby='wine_name';
let searchby='';
let filterby='';
function fetchData() {
    var xhr = new XMLHttpRequest();
    let data = {
        sortby: sortby,
        orderby: orderby,
    };
    
    if (searchby !== '' && filterby !== '') {
        data.searchby = searchby;
        data.filterby = filterby;
    } else if (searchby === '') {
        data.filterby = filterby;
    } else {
        data.searchby = searchby;
    }

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.response);
            $('#row2').empty();
            wines = {};
            if (xhr.response == 'No wines found') {
                $('#row2').append('<p>************************************' + xhr.response + '***********************************</p>');
                return;
            }
            var response = JSON.parse(xhr.response);
            response.forEach((wine) => {
                loadWines(wine);
                wines[wine.wine_id] = wine;
            });
        }
    };

    xhr.open('POST', 'wines.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json'); 
    xhr.send(JSON.stringify(data));
}

var user_id;
window.addEventListener('load',()=>{
    let orderby='ASC';
    let sortby='wine_name';
    let searchby='';
    let filterby='';
    fetchData();
    user_id=1;
} );
function loadWines(wine) {
    var row2 = $('#row2'); 
    row2.append('<div class="col-md-4"> \
    <div class="card mb-4 product-wap rounded-0"> \
        <div class="card rounded-0"> \
            <img class="card-img rounded-0 img-fluid" style="width: 300px;" src='+wine.image+'> \
            <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center"> \
                <ul class="list-unstyled"> \
                    <li><a class="btn btn-success text-white mt-2" href="shop-single.html?user_id=' + user_id + '&wine=' + encodeURIComponent(JSON.stringify(wine)) + '"><i class="far fa-eye"></i></a></li> \
                    <li><a class="btn btn-success text-white mt-2" onclick="addToCart('+wine.wine_id+')"><i class="fas fa-cart-plus"></i></a></li> \
                    <style> \
                        .btn.btn-success.text-white { \
                            background-color: rgb(83, 81, 84) !important; \
                            border-color: rgb(83, 81, 84) !important; \
                        } \
                        .btn:focus { \
                            box-shadow: 0 0 0 0 transparent !important; \
                        } \
                    </style> \
                </ul> \
            </div> \
        </div> \
        <div class="card-body"> \
            <p class="h3 text-decoration-none">'+wine.wine_name+'</p> \
            <p class="text-center mb-0">'+wine.price+'</p> \
        </div> \
    </div> \
    </div>');

}

function addToCart(wine_id, amount=1){
    var jsonData = JSON.stringify({
        wine_id: wine_id,
        user_id: user_id,
        amount: amount
      });
      
      $.ajax({
        url: "addToCart.php",
        type: "POST",
        data: jsonData,
        dataType: "json",
        contentType: "application/json",
        success: function(response) {
            $("#successModal").modal("show");
            setTimeout(function() {
              $("#successModal").modal("hide"); 
            }, 1250);
        },
        error: function(xhr, status, error) {
        }
      });
      
}

function addWithQ(){
    var quantityInput = document.getElementById("quantity");
    var quantity = quantityInput.value;
    addToCart(wine.wine_id,quantity);
}

function setSort(i){
    sortby=i;
    fetchData();

}
function setOrder(i){
    orderby=i
    fetchData();

}

function setSearch(){
    const searchInput = document.getElementById("search");
    searchby=searchInput.value.trim();
    fetchData();
}

function setFilter(i){
    filterby=i;
    fetchData();

}
  