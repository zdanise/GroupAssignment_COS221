fetch('wines.php')
  .then(response => response.json())
  .then(data => {
  
    const wineList = document.getElementById('wineList');
    data.forEach(wine => {
 
      const wineDiv = document.createElement('div');
      const wineName = document.createElement('h2');
      const wineType = document.createElement('p');
      const wineImage = document.createElement('img');
      
 
      wineName.textContent = wine.name;
      wineType.textContent = wine.type;
      wineImage.src = wine.image_url;
      wineImage.alt = wine.name;
      
   
      wineDiv.appendChild(wineName);
      wineDiv.appendChild(wineType);
      wineDiv.appendChild(wineImage);
   
      wineList.appendChild(wineDiv);
    });
  })
  .catch(error => {
    console.error('Error:', error);
  });
   






