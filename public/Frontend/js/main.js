(function($) {
	"use strict"

    //Login Form
    $('#login-form-link').click(function(e) {
        $("#login-form").delay(100).fadeIn(100);
        $("#register-form").fadeOut(100);
        $('#register-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });

    $('#register-form-link').click(function(e) {
        $("#register-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
        $('#login-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });

	// Mobile Nav toggle
	$('.menu-toggle > a').on('click', function (e) {
		e.preventDefault();
		$('#responsive-nav').toggleClass('active');
	})

	// Fix cart dropdown from closing
	$('.cart-dropdown').on('click', function (e) {
		e.stopPropagation();
	});

	/////////////////////////////////////////

	// Products Slick
	$('.products-slick').each(function() {
		var $this = $(this),
				$nav = $this.attr('data-nav');

		$this.slick({
			slidesToShow: 4,
            draggable:false,
			slidesToScroll: 1,
			autoplay: true,
			infinite: true,
			speed: 300,
			dots: false,
			arrows: true,
			appendArrows: $nav ? $nav : false,
			responsive: [{
	        breakpoint: 991,
	        settings: {
	          slidesToShow: 2,
	          slidesToScroll: 1,
	        }
	      },
	      {
	        breakpoint: 480,
	        settings: {
	          slidesToShow: 1,
	          slidesToScroll: 1,
	        }
	      },
	    ]
		});
	});

	// Products Widget Slick
	$('.products-widget-slick').each(function() {
		var $this = $(this),
				$nav = $this.attr('data-nav');

		$this.slick({
			infinite: true,
			autoplay: true,
			speed: 300,
			dots: false,
			arrows: true,
			appendArrows: $nav ? $nav : false,
		});
	});

	/////////////////////////////////////////

	// Product Main img Slick
	$('#product-main-img').slick({
    infinite: true,
    speed: 300,
    dots: false,
    arrows: true,
    fade: true,
    asNavFor: '#product-imgs',
  });

	// Product imgs Slick
  $('#product-imgs').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    centerMode: true,
    focusOnSelect: true,
		centerPadding: 0,
		vertical: true,
    asNavFor: '#product-main-img',
		responsive: [{
        breakpoint: 991,
        settings: {
					vertical: false,
					arrows: false,
					dots: true,
        }
      },
    ]
  });

	// Product img zoom
	var zoomMainProduct = document.getElementById('product-main-img');
	if (zoomMainProduct) {
		$('#product-main-img .product-preview').zoom();
	}

    // Input number
    $('.input-number').each(function() {
        var $this = $(this),
            $input = $this.find('input[type="number"]'),
            up = $this.find('.qty-up'),
            down = $this.find('.qty-down');

        down.on('click', function () {
            var value = parseInt($input.val()) - 1;
            value = value < 1 ? 1 : value;
            $input.val(value);
            $input.change();
        })

        up.on('click', function () {
            var value = parseInt($input.val()) + 1;
            $input.val(value);
            $input.change();
        })
    });

	/////////////////////////////////////////
})(jQuery);


/////////////////////////////////////////
/////////////////////////////////////////
//              Product Cart
/////////////////////////////////////////
/////////////////////////////////////////

//DOM Element
const productsSlickEl = document.querySelectorAll('.products-slick');
const storeEl = document.querySelector('#store');
const productDetailsEl = document.querySelector('.product-details');
const cartDom = document.querySelector('.cartoutput');
const tableEl = document.querySelector('.cart-table');


//CartProducts
let products = {
    cartProduct: []
};





//Check Duplicate Products
const duplicateCheck = function (cart,checkProduct){
    let check = false;
    if(cart){
        cart.cartProduct.forEach(function (element){
            if(element.name === checkProduct.name){
                check = true;
            }
        });
    }

    return check;
};

//Filter Cart
const filterProduct = function (cart,productName){
    if(cart){
        let filterCart = cart.cartProduct.filter(function (element){
            return element.name !== productName;
        });

        return {cartProduct:filterCart};
    }

    return false;
}

//Update Cart
const updateCart = function (cart,productName,quantity){

    let updatedCarts = cart.cartProduct.filter(function (element){
        if(element.name === productName){
            element.quantity = quantity;
        }
        return element;
    });

    setCart({cartProduct:updatedCarts});
}

//
const priceCalculator = function (totalPrice,price,cartDom,subtotal,quantity){
    let sumTotal = 0;

    totalPrice.innerHTML = `<strong>${Number(quantity.value) * Number(price)}</strong>`;

    cartDom.querySelectorAll('.totalPrice').forEach(function (element){
        sumTotal += Number(element.textContent);
    });

    subtotal.innerHTML = `<h3><strong>${sumTotal}</strong></h3>`;
}

//Store Products in localstorage
const setCart = function (products){
    localStorage.setItem('cart',JSON.stringify(products));
};

//Get Cart Data
const getCart = function (){
    const cart = JSON.parse(localStorage.getItem('cart'));
    if(!cart){
        return {cartProduct: []};
    }
    return cart;
}

//Render Data
const render = function (cartData){
    cartData.cartProduct.forEach(function (element){
        let html = `
            <tr>
                <td class="col-sm-8 col-md-6">
                    <div class="media">
                        <a class="thumbnail pull-left" href="${element.slug}"> <img class="media-object" src="${element.image}" style="width: 72px;"> </a>
                        <div class="media-body">
                            <h4 style="margin-top:30px;margin-left:10px"><a href="${element.slug}" class="name">${element.name}</a></h4>
                        </div>
                    </div>
                </td>
                <td class="col-sm-1 col-md-1" style="text-align: center">
                    <input type="number" class="form-control quantity" min="1" id="exampleInputEmail1" value="${element.quantity}">
                </td>
                <td class="col-sm-1 col-md-1 text-center price"><strong>${element.price}</strong></td>
                <td class="col-sm-1 col-md-1 text-center totalPrice"><strong>${element.price}</strong></td>
                <td class="col-sm-1 col-md-1">
                    <button type="button" class="btn btn-danger productRemove">
                         Remove
                    </button></td>
            </tr>
            `;

        if(cartDom){
            cartDom.insertAdjacentHTML('afterbegin',html);
        }
    });
}

//Get Product Details for slick and storeEl
const getProductsDetails = function (e){
    if(e.target.closest('.add-to-cart-btn')){

        //Products Info name,image,slug,quantity,price
        const productEl = e.target.closest('.product');

        const productName = productEl.querySelector('.product-name > a').textContent.trim();
        const productSlug = productEl.querySelector('.product-name > a').getAttribute('href');
        const productImage = productEl.querySelector('.product-img > img').getAttribute('src');
        const productQuantity = 1;
        const productPrice = productEl.querySelector('.product-price').childNodes[0].nodeValue.slice(3).replaceAll(',','');
        console.log(productPrice);
        let product = {
            name: productName,
            slug: productSlug,
            image: productImage,
            quantity: Number(productQuantity),
            price:Number(productPrice)
        }

        products = getCart();

        let duplicate = duplicateCheck(products,product);

        if(!duplicate){
            products.cartProduct.push(product);

            //Set to localStorage
            setCart(products);
        }else{
            alert('Product Already Added to cart');
        }
    }
}

//Add to Cart when Click
if(productsSlickEl.length) {
    productsSlickEl.forEach(function (element) {
        element.addEventListener('click', getProductsDetails);
    });
}
else if(storeEl) {
    storeEl.addEventListener('click', getProductsDetails);
}else{
    if(productDetailsEl){
        productDetailsEl.addEventListener('click',function (e){
            if(e.target.closest('.add-to-cart-btn')){
                let sectionEl = e.target.closest('.section');

                const productName = sectionEl.querySelector('.product-name').textContent.trim();
                const productSlug = window.location.href;
                const productImage = sectionEl.querySelector('#product-imgs img').getAttribute('src');
                const productQuantity = sectionEl.querySelector('.input-number input').value;
                const productPrice = sectionEl.querySelector('.product-price').childNodes[0].nodeValue.slice(3).replaceAll(',','');


                let product = {
                    name: productName,
                    slug: productSlug,
                    image: productImage,
                    quantity: Number(productQuantity),
                    price: Number(productPrice)
                }

                products = getCart();

                let duplicate = duplicateCheck(products,product);

                if(!duplicate){
                    products.cartProduct.push(product);

                    //Set to localStorage
                    setCart(products);
                }else{
                    alert('Product Already Added to cart');
                }
            }
        });
    }
}


//Show CartData to Cart page
let cartData = getCart();
if(cartData.cartProduct.length){
    render(cartData);
}else{
    tableEl.innerHTML = "<h2 class='text-center text-danger' style='margin: 100px 0'>Cart Is Empty</h2>";
}

//Remove Product
if(cartDom){
    cartDom.addEventListener('click',function (e){
        if (e.target.classList.contains('productRemove')){
            let productName = e.target.closest('tr').querySelector('h4').textContent;

            let filterProducts = filterProduct(cartData,productName);

            //Update localstorage
            setCart(filterProducts);
            location.reload();
        }
    });
}

if(cartDom){
    let quantity = document.querySelector('.quantity');
    let subtotal = cartDom.querySelector('.subtotal');
    let price = cartDom.querySelector('.price').textContent;
    let totalPrice = cartDom.querySelector('.totalPrice');

    cartDom.addEventListener('change',function (e){
        if(e.target.classList.contains('quantity')){
            quantity = e.target;
            let parent = e.target.closest('tr');
            let name = parent.querySelector('.name').textContent;
            price = parent.querySelector('.price').textContent;
            totalPrice = parent.querySelector('.totalPrice');

            priceCalculator(totalPrice,price,cartDom,subtotal,quantity);

            updateCart(cartData,name,Number(quantity.value));

            document.querySelector('.order').value = JSON.stringify(cartData);
        }
    });

    priceCalculator(totalPrice,price,cartDom,subtotal,quantity);

    document.querySelector('.order').value = JSON.stringify(cartData);
}
