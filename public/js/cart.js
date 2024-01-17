var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

let cart = document.querySelector(".cart");
// let test = ``

let brand = "";
let categorized = "";
let name = "";
let price = "";

//Cart working JS
if(document.readyState == 'loading'){
    document.addEventListener('DOMContentLoaded', ready);
}else{
    ready();
}

//Making Function
function ready(){
    //Remove item from cart
    var removeCartButtons = document.getElementsByClassName('cart-remove');
    for (var i=0; i< removeCartButtons.length;i++){
        var button = removeCartButtons[i];
        button.addEventListener("click", removeCartItem);
    }
    //Quantity change
    var quantityInputs = document.getElementsByClassName('cart-quantity');
    for(var i = 0; i <quantityInputs.length; i++ ){
        var input = quantityInputs[i];
        input.addEventListener("change", quantityChanged);
    }

    //Add to cart
    var addCart = document.getElementsByClassName("add-cart")
    for(var i = 0; i <addCart.length; i++ ){
        var button = addCart[i];
        button.addEventListener("click", addCartClicked);
    }

}

//Remove item from cart
function removeCartItem(event){
    var buttonClicked = event.target;
    buttonClicked.remove();
    console.log(buttonClicked);
    // updateTotal();
}
//Quantity changes
function quantityChanged(event){
    var input = event.target;
    if(isNaN(input.value) || input.value <=0){
        input.value = 1;
    }
    // updateTotal()
}
//Add to cart
function addCartClicked(event){
    var button = event.target;
    var shopProducts = button.parentElement;
    var tittle = shopProducts.getElementsByClassName("select2-selection__rendered")[0].innerText;
    var brand = "";
    var categorized = "";
    var name = "";
    var price = "";

    var firstComma = tittle.indexOf(",");
    if(firstComma >= 0){
        brand = tittle.substring(0, firstComma);
        var secondComma = tittle.indexOf(",", firstComma + 1);
        if(secondComma >= 0){
            categorized = tittle.substring(firstComma + 2, secondComma);
            var thirdComma = tittle.indexOf(",", secondComma + 1 );
            if(thirdComma >= 0){
                name = tittle.substring(secondComma + 2,thirdComma);
                price = tittle.substring(thirdComma + 2);
            }
        }
    }
    addProductToCart(brand,categorized,name,price);
    // updateTotal();
    console.log(tittle);
    console.log(brand);
    console.log(categorized);
    console.log(name);
    console.log(price);
}

function addProductToCart(brand,categorized,name,price){
    // var cartShopBox = document.createElement("div");


    // cartShopBox.classList.add("cart-box")
    var cartItems = document.getElementsByClassName("cart-content")[0];

    // var cartItemsName = cartItems.getElementsByClassName("cart-product-name");
    //     for(var i = 0; i < cartItemsName.length; i++ ){
    //         if(cartItemsName[i].innerText == name){
    //             alert("You have already added this item to the cart");
    //             return;
    //         }      
    //     }
    
    // console.log(cartBoxContent);
    // console.log(cartShopBox);
    // console.log(cartItems);
    // console.log(cartItemsName);
    
}


function addProduct() {
    var test =``;
    test += `<div class="flex flex-row"> <div class="cart-product-name justify-center text-left w-2/5 font-semibold text-s">{name}</div><div class="cart-product-categorized justify-center text-center w-1/5 font-semibold text-s">"{categorized}"</div><div class="cart-product-brand justify-center text-center w-1/5 font-semibold text-s">{brand}</div><div class="justify-center text-center w-1/5 font-semibold text-s"><input class="cart-quantity border text-black text-center w-20" type="number" value="1" min="1" max="100"></div><div class="cart-price justify-center text-center w-1/5 font-semibold text-s">{price}</div><div class="justify-center text-center w-1/5 transform hover:text-purple-500 hover:scale-110"><i class="cart-remove fas fa-trash-alt"></i></div> </div>`;
    $(".cart-result").html(test)

}

// var cartBoxContent = `<div class="cart-product-name justify-center text-left w-2/5 font-semibold text-s">${name}</div><div class="cart-product-categorized justify-center text-center w-1/5 font-semibold text-s">${categorized}</div><div class="cart-product-brand justify-center text-center w-1/5 font-semibold text-s">${brand}</div><div class="justify-center text-center w-1/5 font-semibold text-s"><input class="cart-quantity border text-black text-center w-20" type="number" value="1" min="1" max="100"></div><div class="cart-price justify-center text-center w-1/5 font-semibold text-s">${price}</div><div class="justify-center text-center w-1/5 transform hover:text-purple-500 hover:scale-110"><i class="cart-remove fas fa-trash-alt"></i></div>`;
// cartShopBox.innerHTML = cartBoxContent;
// console.log(cartShopBox.innerHTML)
// cartItems.append(cartShopBox);
// cartShopBox
//     .getElementsByClassName('cart-remove')[0]
//     .addEventListener('click', removeCartItem);
// cartShopBox
//     .getElementsByClassName('cart-quantity')[0]
//     .addEventListener('change', quantityChanged);
    
    // console.log(cartItems);
//Update total
// function updateTotal(){
//     var cartContent = document.getElementsByClassName('cart-content')[0];
//     var cartBoxes = cartContent.getElementsByClassName('cart-box');
//     console.log(cartBoxes);
//     var total = 0;
//     for(var i = 0; i < cartBoxes.length; i++){
//         var cartBox = cartBoxes[i];
//         var priceElement = cartBox.getElementsByClassName('cart-price')[0];
//         var quantityElement = cartBox.getElementsByClassName('cart-quantity')[0];
//         var price = parseFloat(priceElement.innerText.replace(" vnd", ""));
//         var quantity = quantityElement.value;
//         total = total + (price * quantity);

//         console.log(quantity);
//         console.log(price);
//         console.log(total);
//         document.getElementsByClassName('total-price')[0].innerText = total + " vnd" ;
//     }
    
    
// }