//this function define the filter-buttons
const filterButtons = document.querySelectorAll("#filter-buttons button");
	const filterableCards = document.querySelectorAll("#filterable-cards .card");
	const filterCards = (e) => {
    	document.querySelector("#filter-buttons .active").classList.remove("active");
    	e.target.classList.add("active");

    	filterableCards.forEach(card => {
        	if(card.dataset.name === e.target.dataset.filter || e.target.dataset.filter === "all") {
            	return card.classList.replace("hide", "show");
        	}
        	card.classList.add("hide");
    	});
	}

	filterButtons.forEach(button => button.addEventListener("click", filterCards));

//this function define the MultiCarousel
let items = document.querySelectorAll('.carousel .carouselitem')

items.forEach((el) => {
    const minPerSlide = 4
    let next = el.nextElementSibling
    for (var i=1; i<minPerSlide; i++) {
        if (!next) {
            // wrap carousel by using first child
        	next = items[0]
      	}
        let cloneChild = next.cloneNode(true)
        el.appendChild(cloneChild.children[0])
        next = next.nextElementSibling
    }
})

	//this function define the mini cart


$(".minicart-icon").on('click', function(){
	$(".cart-dropdown").slideToggle();
});

//this function define the my_account_dropdown

$(".my_account").on('click', function(){
    $(".my_account_dropdown").slideToggle();
});



//this function define the product number count
var total = 1;
Result = document.getElementById('result');
function plus() {
    total += 1;
    Result.innerHTML = total;
}

function minus() {
    if (Result.innerHTML > 1) {
        total -= 1;
        Result.innerHTML = total;
    }

}