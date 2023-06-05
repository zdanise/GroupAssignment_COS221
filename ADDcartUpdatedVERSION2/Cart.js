
// const formData = {
   
//     phone: '0579486846392',
//     address: 'Cape TOWN',
//     view:'YES',
//     user_id: '1'
  
//   };
  
//   const requestOptions = {
//     method: 'POST',
//     headers: {
//       'Content-Type': 'application/json',
//     },
//     body: JSON.stringify(formData),
//   };





        // fetch('CART.php',requestOptions)
        // .then(response => response.json())
        // .then(data => {
          
        //   const CARTitemsList = document.getElementById('cart');
        //   data.forEach(CARTitems => {
       
        //     const CARTitemsDiv = document.createElement('div');
        //     const CARTitemsImage = document.createElement('img');
        //     const CARTitemsName = document.createElement('h2');
        //     const CARTitemsType = document.createElement('p');
        //     const CARTitemsQuantity = document.createElement('p');
        //     const CARTitemsPrice = document.createElement('p');
            
       
        //     CARTitemsName.textContent = CARTitems.wine_name;
        //     console.log(CARTitemsName);
        //     CARTitemsType.textContent = CARTitems.wine_type;
        //     CARTitemsQuantity.textContent ="Quantity: " + CARTitems.quantity;
        //     CARTitemsPrice.textContent = "Price: " +CARTitems.price;
        //     CARTitemsImage.src = CARTitems.image;
        //     CARTitemsImage.alt ="CARTitems Image";
            
        //     CARTitemsDiv.appendChild(CARTitemsImage);
        //     CARTitemsDiv.appendChild(CARTitemsName);
        //     CARTitemsDiv.appendChild(CARTitemsType);
        //     CARTitemsDiv.appendChild( CARTitemsQuantity);
        //     CARTitemsDiv.appendChild(CARTitemsPrice);

        
        //     CARTitemsList.appendChild(CARTitemsDiv);
        //   });
        // })
        // .catch(error => {
        //   console.error('Error:', error);
        // });



    //     fetch('CART.php', requestOptions)
    // .then(response => response.json())
    // .then(data => {
    //     const CARTitemsList = document.getElementById('cart');

    //     if (data.length === 0) {
    //         CARTitemsList.textContent = "CART EMPTY";
    //     } else {
    //         data.forEach(CARTitem => {
    //             const CARTitemsDiv = document.createElement('div');
    //             const CARTitemsImage = document.createElement('img');
    //             const CARTitemsName = document.createElement('h2');
    //             const CARTitemsType = document.createElement('p');
    //             const CARTitemsQuantity = document.createElement('p');
    //             const CARTitemsPrice = document.createElement('p');

    //             CARTitemsName.textContent = CARTitem.wine_name;
    //             CARTitemsType.textContent = CARTitem.wine_type;
    //             CARTitemsQuantity.textContent = "Quantity: " + CARTitem.quantity;
    //             CARTitemsPrice.textContent = "Price: " + CARTitem.price;
    //             CARTitemsImage.src = CARTitem.image;
    //             CARTitemsImage.alt = "Wine Image";

    //             CARTitemsDiv.appendChild(CARTitemsImage);
    //             CARTitemsDiv.appendChild(CARTitemsName);
    //             CARTitemsDiv.appendChild(CARTitemsType);
    //             CARTitemsDiv.appendChild(CARTitemsQuantity);
    //             CARTitemsDiv.appendChild(CARTitemsPrice);

    //             CARTitemsList.appendChild(CARTitemsDiv);
    //         });
    //     }
    // })
    // .catch(error => {
    //     console.error('Error:', error);
    // });

    // document.addEventListener("DOMContentLoaded", function() {
       
       
    //     let dataa = {
    //         "view": "YES",
    //         "user_id": 1
    //       };

            
    
    //     fetch('CART.php',{
    //         "method":"POST",
    //         "headers":{
    //             "Content-Type":"application/json"
    //             },
    //             "body":JSON.stringify(dataa)
    //             })
             
    //             console.log(dataa);
    //     })
    //     .then(response => {
    //          return response.json();
    //     })
    //         .then(data => {
    //             console.log(data);
    //             const CARTitemsList = document.getElementById('cart');
    
    //             if (data.length === 0) {
    //                 CARTitemsList.textContent = "CART EMPTY";
    //             } else {
    //                 data.forEach(CARTitem => {
    //                     const CARTitemsDiv = document.createElement('div');
    //                     const CARTitemsImage = document.createElement('img');
    //                     const CARTitemsName = document.createElement('h2');
    //                     const CARTitemsType = document.createElement('p');
    //                     const CARTitemsQuantity = document.createElement('p');
    //                     const CARTitemsPrice = document.createElement('p');
    
    //                     CARTitemsName.textContent = CARTitem.wine_name;
    //                     CARTitemsType.textContent = CARTitem.wine_type;
    //                     CARTitemsQuantity.textContent = "Quantity: " + CARTitem.quantity;
    //                     CARTitemsPrice.textContent = "Price: " + CARTitem.price;
    //                     CARTitemsImage.src = CARTitem.image;
                        
    
    //                     CARTitemsDiv.appendChild(CARTitemsImage);
    //                     CARTitemsDiv.appendChild(CARTitemsName);
    //                     CARTitemsDiv.appendChild(CARTitemsType);
    //                     CARTitemsDiv.appendChild(CARTitemsQuantity);
    //                     CARTitemsDiv.appendChild(CARTitemsPrice);
    
    //                     CARTitemsList.appendChild(CARTitemsDiv);
    //                 });
    //             }
    //         })
    //         .catch(error => {
    //             console.error('Error:', error);
    //         });
    // document.addEventListener("DOMContentLoaded", function() {
    //     let dataa = {
    //         "view": "YES",
    //         "user_id": 1
    //     };
    
    //     fetch('CART.php', {
    //         "method": "POST",
    //         "headers": {
    //             "Content-Type": "application/json"
    //         },
    //         "body": JSON.stringify(dataa)
    //     })
    //     .then(response => {
    //         return response.json();
    //     })
    //     .then(data => {
    //         console.log(data);
    //         const CARTitemsList = document.getElementById('cart');
    
    //         if (data.length === 0) {
    //             CARTitemsList.textContent = "CART EMPTY";
    //         } else {
    //             data.forEach(CARTitem => {
    //                 const CARTitemsDiv = document.createElement('div');
    //                 const CARTitemsImage = document.createElement('img');
    //                 const CARTitemsName = document.createElement('h2');
    //                 const CARTitemsType = document.createElement('p');
    //                 const CARTitemsQuantity = document.createElement('p');
    //                 const CARTitemsPrice = document.createElement('p');
    
    //                 CARTitemsName.textContent = CARTitem.wine_name;
    //                 CARTitemsType.textContent = CARTitem.wine_type;
    //                 CARTitemsQuantity.textContent = "Quantity: " + CARTitem.quantity;
    //                 CARTitemsPrice.textContent = "Price: " + CARTitem.price;
    //                 CARTitemsImage.src = CARTitem.image;
    
    //                 CARTitemsDiv.appendChild(CARTitemsImage);
    //                 CARTitemsDiv.appendChild(CARTitemsName);
    //                 CARTitemsDiv.appendChild(CARTitemsType);
    //                 CARTitemsDiv.appendChild(CARTitemsQuantity);
    //                 CARTitemsDiv.appendChild(CARTitemsPrice);
    
    //                 CARTitemsList.appendChild(CARTitemsDiv);
    //             });
    //         }
    //     })
    //     .catch(error => {
    //         console.error('Error:', error);
    //     });
    // });
    document.addEventListener("DOMContentLoaded", function() {
        let dataa = {
            "view": "YES",
            "user_id": 1
        };
    
        fetch('CART.php', {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(dataa)
        })
        .then(response => {
            return response.json();
        })
        .then(data => {
            console.log(data);
            const CARTitemsList = document.getElementById('cart');
    
            if (data.length === 0) {
                CARTitemsList.textContent = "CART EMPTY";
            } else {
                data.forEach(CARTitem => {
                    const CARTitemsDiv = document.createElement('div');
                    const CARTitemsImage = document.createElement('img');
                    const CARTitemsName = document.createElement('h2');
                    const CARTitemsType = document.createElement('p');
                    const CARTitemsQuantity = document.createElement('p');
                    const CARTitemsPrice = document.createElement('p');
    
                    CARTitemsName.textContent = CARTitem.wine_name;
                    CARTitemsType.textContent = CARTitem.wine_type;
                    CARTitemsQuantity.textContent = "Quantity: " + CARTitem.quantity;
                    CARTitemsPrice.textContent = "Price: " + CARTitem.price;
                    CARTitemsImage.src = CARTitem.image;
    
                    CARTitemsDiv.appendChild(CARTitemsImage);
                    CARTitemsDiv.appendChild(CARTitemsName);
                    CARTitemsDiv.appendChild(CARTitemsType);
                    CARTitemsDiv.appendChild(CARTitemsQuantity);
                    CARTitemsDiv.appendChild(CARTitemsPrice);
    
                    CARTitemsList.appendChild(CARTitemsDiv);
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
    