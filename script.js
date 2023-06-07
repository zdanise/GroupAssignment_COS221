$(document).ready(function() {
    fetchWineList();
    $("#addForm").submit(function(event) {
      event.preventDefault();
  
      var wine = {
        wine_name: $("#wineName").val(),
        wine_age: $("#wineAge").val(),
        bottle_size: $("#bottleSize").val(),
        wine_type: $("#wineType").val(),
        winery_id: $("#wineryId").val(),
        image: $("#image").val(),
        price: $("#price").val()
      };
  
      addWine(wine);
    });
  
    
    $(document).on("click", ".update-btn", function() {
      var wineId = $(this).data("id");
      var updatedWine = {
        wine_name: $("#updateName" + wineId).val(),
        wine_age: $("#updateAge" + wineId).val(),
        bottle_size: $("#updateBottleSize" + wineId).val(),
        wine_type: $("#updateWineType" + wineId).val(),
        winery_id: $("#updateWineryId" + wineId).val(),
        image: $("#updateImage" + wineId).val(),
        price: $("#updatePrice" + wineId).val()
      };
  
      updateWine(wineId, updatedWine);
    });
  
   
    $(document).on("click", ".delete-btn", function() {
      var wineId = $(this).data("id");
      deleteWine(wineId);
    });
  });
  
  function fetchWineList() {
    $.ajax({
      url: "http://localhost/wineryLogin.php", 
      type: "GET",
      dataType: "json",
      success: function(data) {
        displayWineList(data);
      }
    });
  }
  
  function displayWineList(wines) {
    var wineList = $("#wineList");
    wineList.empty();
  
    if (wines.length === 0) {
      wineList.append("<p>No wines found.</p>");
    } else {
      var table = $("<table>");
      table.append("<tr><th>Name</th><th>Age</th><th>Bottle Size</th><th>Type</th><th>Winery ID</th><th>Image</th><th>Price</th><th>Action</th></tr>");
  
      for (var i = 0; i < wines.length; i++) {
        var wine = wines[i];
        var row = $("<tr>");
  
        row.append("<td>" + wine.wine_name + "</td>");
        row.append("<td>" + wine.wine_age + "</td>");
        row.append("<td>" + wine.bottle_size + "</td>");
        row.append("<td>" + wine.wine_type + "</td>");
        row.append("<td>" + wine.winery_id + "</td>");
        row.append("<td>" + wine.image + "</td>");//add an image tag
        row.append("<td>" + wine.price + "</td>");
  
        var actionColumn = $("<td>");
        var updateButton = $("<button>", {
          text: "Update",
          class: "update-btn",
          "data-id": wine.wine_id
        });
        var deleteButton = $("<button>", {
          text: "Delete",
          class: "delete-btn",
          "data-id": wine.wine_id
        });
  
        actionColumn.append(updateButton);
        actionColumn.append(deleteButton);
        row.append(actionColumn);
  
        table.append(row);
      }
  
      wineList.append(table);
    }
  }
  
  function addWine(wine) {
    $.ajax({
      url: "http://localhost/wineryLogin.php",
      type: "POST",
      data: JSON.stringify(wine),
      contentType: "application/json",
      success: function(data) {
        fetchWineList();
        $("#addForm")[0].reset();
      }
    });
  }
  
  function updateWine(wineId, updatedWine) {
    $.ajax({
      url: "http://localhost/wineryLogin.php" + wineId,
      type: "PUT",
      data: JSON.stringify(updatedWine),
      contentType: "application/json",
      success: function(data) {
        fetchWineList();
      }
    });
  }
  
  function deleteWine(wineId) {
    $.ajax({
      url: "http://localhost/wineryLogin.php" + wineId,
      type: "DELETE",
      success: function(data) {
        fetchWineList();
      }
    });
  }
  