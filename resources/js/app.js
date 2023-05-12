import './bootstrap';
$(document).ready(function (){

// Cart Toggle
    let cartToggle = document.getElementById('cart-button');
    let cartToggleCount = 0;
    let cartWrapper = document.getElementById('cart-wrapper');
    let cartElement = document.getElementById('cart');
    let subtotal = document.getElementById('subtotal');
    let total = document.getElementById('total');
    let applyPromoButton = document.querySelector('#apply-promo');
    let addToCartButton = document.querySelectorAll('.add-to-cart');

    applyPromoButton.addEventListener('click', applyPromo);

    let cartProductQuantity = "<input name='quantity' id='quantity-value' type='number' value='1'>";

    let productRemove = "<button class='remove' onclick='removeFromCart(this)'>X</button>";

    let updatedPrice;
    let added = [], itemClass = {};

// Capture HTML cart body
    var cartTableBody = document.getElementById('cart-table-body');

// Cart object model
    let cart = {
        'items': [],
        "subtotal": 0,
        "iphoneDis": 0,
        "androidDis": 0,
        "Off5": 0,
        "finalDis": 0,
        'total': 0
    };
    //
    // for (let button of addToCartButton) {
    //     button.addEventListener('click', addToCart);
    // }


    $('.trigger, .keep-shopping').click(function() {
        $('.slider').toggleClass('close');
    });

// Adding products to the shopping cart
//     function addToCart(event) {
//
//         if (added.includes(event.target.parentElement.id)) {
//             duplicateId = '#' + event.target.parentElement.id;
//
//             cartTableBody.querySelector(duplicateId).querySelector('#quantity-value').value++;
//             return;
//         }
//
//         // Capture product
//         let product = event.target.parentNode;
//         let productId = product.id;
//         added.unshift(productId);
//         let productName = product.querySelector('.product-name').innerHTML;
//         let productPrice = product.querySelector('.product-price').innerHTML.replace(/[^\d.-]/g, '');
//         productPrice = Number(productPrice);
//         let productUpdatedPrice = productPrice;
//
//         thisClass = product.classList.value.split(' ');
//         /*
//             thisClass = thisClass.replace('products ', '');
//         */
//
//         itemClass[productId] = thisClass;
//
//         // Add item to cart javascript model
//         cart.items.push({
//             'product': productId,
//             'productName': productName,
//             'productPrice': productPrice,
//             'productUpdatedPrice': productUpdatedPrice,
//         });
//
//
//         // Add a new row for each product
//         let productRow = document.createElement('tr');
//         productRow.setAttribute('id', productId);
//         cartTableBody.appendChild(productRow);
//
//         // Add five columns to product row
//         for (let num = 0; num <= 6; num++) {
//             let newColumn = document.createElement('td');
//             productRow.appendChild(newColumn);
//         }
//
//         // Build HTML cart
//         productRow.childNodes[0].innerHTML = productName;
//         productRow.childNodes[1].innerHTML = cartProductQuantity;
//         productRow.childNodes[1].setAttribute('id', 'quantity');
//         productRow.childNodes[2].innerHTML = productPrice;
//         productRow.childNodes[2].setAttribute('id', 'product-price');
//         productRow.childNodes[2].setAttribute('class', 'cart-product-price');
//         productRow.childNodes[3].innerHTML = productPrice;
//         productRow.childNodes[3].setAttribute('id', 'updated-product-price');
//         productRow.childNodes[3].setAttribute('class', 'cart-updated-product-price');
//         productRow.childNodes[4].innerHTML = "<button id='update' onclick='updateQuantity(this)'>Update</button>"
//         productRow.childNodes[5].innerHTML = productRemove;
//
//
//
//         updateSubtotal();
//         updateTotal();
//
//         $('.slider').toggleClass('close');
//
//     }

    function removeFromCart(event) {
        let parentRow = event.parentNode.parentNode;
        let parentBody = parentRow.parentNode;
        let parentRowId = parentRow.id;
        parentBody.removeChild(parentRow);

        total.value = (Number(total.value) - parentRow.querySelector('#updated-product-price').innerHTML).toFixed(2);

        var index = added.indexOf(parentRowId);
        if (index !== -1) {
            added.splice(index, 1);
        }

        for (let item of cart.items) {
            if (item.product === parentRowId) cart.items.splice(item, 1);
        }

        var subtotalRow = document.getElementById("subtotal");
        var subtotalRowParent = subtotalRow.parentNode;
        for (let node of subtotalRowParent.childNodes) {
            if (node.id === "discountRow") {
                var discountRow = document.getElementById("discountRow");

                subtotalRowParent.removeChild(discountRow);
            }

        }

        cart.finalDis = 0;
        updateSubtotal();
        updateTotal();

    }


    function updateQuantity(event) {
        let parentRow = event.parentNode.parentNode;
        let parentRowId = parentRow.id;
        var inputQuantity,productPrice,updatedPrice,totalPrice;

        for (let node of parentRow.childNodes) {
            switch (node.id) {
                case 'quantity':
                    inputQuantity = node.firstChild;
                    break;

                case 'product-price':
                    productPrice = Number(node.innerHTML);
                    break;

                case 'updated-product-price':
                    updatedPrice = node;
                    totalPrice = Number(node.innerHTML);
                    console.log(totalPrice);
            }
        }

        let inputQuantityValue = (Number(inputQuantity.value)).toFixed(2);

        if (inputQuantityValue <= 0) removeFromCart(event);

        totalPrice = inputQuantity.value * productPrice;
        updatedPrice.innerHTML = totalPrice;

        for (let item of cart.items) {
            if (item.product === parentRowId) item.productUpdatedPrice = totalPrice;
        }

        updateSubtotal();
        updateTotal();
        console.log(cart);
    }

    function applyPromo(event) {
        let promoInputValue = document.getElementById('promo').value.toUpperCase();
        let promoInput = document.getElementById('promo');

        switch (promoInputValue) {
            case 'IPHONEX15':
                let price = 0;
                for (item of cart.items) {
                    if (item.product.includes('iphone-x')) {
                        price += item.productPrice;
                        let pro15Dis = (price * 15) / 100;

                        cart.iphoneDis = pro15Dis;
                        cart.finalDis = cart.iphoneDis.toFixed(2);
                        addDiscountAmount();
                    }
                }

                alert('15% Off the iPhone X!');
                break;

            case 'ANDROID10':
                for (item of cart.items) {
                    if (isIncluded('android', itemClass[item.product])) {
                        let product = cartTableBody.querySelector('#' + item.product);
                        var productUpdatedPrice = product.querySelector('#updated-product-price').innerHTML;

                        productUpdatedPrice = (Number (productUpdatedPrice) * 10) / 100;

                        product.querySelector('#updated-product-price').innerHTML = (Number (product.querySelector('#updated-product-price').innerHTML)) - productUpdatedPrice;

                    }
                }

                cart.androidDis = productUpdatedPrice;
                cart.finalDis = cart.androidDis.toFixed(2);

                addDiscountAmount();

                alert('10% Off all Android products!');

                break;

            case '5OFFEVERYTHING':
                let subtotalDiscount = (cart.subtotal * 5) / 100;

                cart.Off5 = subtotalDiscount;
                cart.finalDis = cart.Off5.toFixed(2);
                addDiscountAmount();

                alert('5% Off the price of all products combined!');
                break;

            case '':
                alert('Please enter a discount code!');

                break;

            default:
                alert('Invalid Code!');
        }

        function addDiscountAmount() {
            var orderTotalRow = document.getElementById("total-wrapper");
            var orderTotalRowParent = orderTotalRow.parentNode;
            var newRow = document.createElement("tr");
            orderTotalRowParent.insertBefore(newRow, orderTotalRow);
            newRow.setAttribute("id", "discountRow");
            for(var j = 0; j < 2; j++){
                var newTd = document.createElement("td");
                newRow.appendChild(newTd);
            }
            newRow.childNodes[0].innerHTML = "Discount:";
            newRow.childNodes[1].innerHTML = cart.finalDis;
            newRow.childNodes[1].setAttribute("id", "discountAmt");

            updateSubtotal();
            updateTotal();
        }
    }

    function updateSubtotal() {
        cart.subtotal = 0;

        for (let item of cart.items) {
            cart.subtotal += item.productUpdatedPrice;
        }

        subtotal.innerHTML = cart.subtotal.toFixed(2);
    }

    function updateTotal() {
        cart.total = 0;
        cart.total += (cart.subtotal - cart.finalDis);
        total.innerHTML = cart.total.toFixed(2);
    }

    function isIncluded(input, words) {
        try {
            if(!input || words.length == 0) throw 'Invalid Input or words is empty';
        }

        catch(err) {
            return `Please provide valid input or add a word to check for`;
        }

        let allowed = [' ','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
        let count = 0;

        for (let index = 0; index < input.length; index++) {
            if(!allowed.includes(input[index])) {
                input = input.replace(input[index], ' ');
            }
        }

        input = input.split(' ');

        for (let i = 0; i < input.length; i++) {
            for (let c = 0; c < 3; c++) {
                if (input[i] == ' ' || input[i] == '') {
                    input.splice(i, 1);
                }
            }
        }

        for (let word in input) {
            for (let word2 in words) {
                if (input[word] == words[word2]) return true;
            }
        }
        return false;
    }

});
