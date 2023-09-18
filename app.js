
const productEl=document.querySelector(".shop-items");
function renderProducts(){
products.forEach((product)=>{
productEl.innerHTML+=
` <div class="shop-item">
                           <img class="shop-item-image" src="${product.imgSrc}">
          <span class="shop-item-title">${product.name}</span>
          <p>${product.description}</p>
                           <div class="shop-item-details">
                               <span class="shop-item-price">${product.price}</span>
                               <button class="btn btn-primary shop-item-button" type="button">ADD TO CART</button>
                           </div>
                           </div>

     `
     });
}
renderProducts();
