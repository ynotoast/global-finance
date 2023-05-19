// console.log("script is running");
const params = new URLSearchParams(location.search);
const carId = params.get('id')

fetch('car.json')
    .then(response => response.json())
    .then(data => {
        const cars = data.cars;
        const car = cars.find(c => c.id === carId);

        const carNameElement = document.getElementsByClassName("car-name");
        carNameElement[0].innerHTML = car.shortName; //name title
        carNameElement[0].innerHTML = car.longName; //name title
        carNameElement[1].innerHTML += car.longName; //name details

        const carSubtitleElement = document.getElementsByClassName("car-subtitle");
        carSubtitleElement[0].innerHTML = car.subtitle; //subtitle in home

        const carDescElement = document.getElementsByClassName("car-desc");
        carDescElement[0].innerHTML = car.desc; //Description in details

        const carPriceElement = document.getElementsByClassName("car-price");
        carPriceElement[0].innerHTML = `The ${car.longName} starts at ${car.price}`; //name and price in the buy now section

        const carBg = document.getElementsByClassName("car-bg")[0];
        carBg.style.backgroundImage = `url(${car.background})`; //sets background image (dont think it works with library used in template, so this has to do)
        
        const carD1Element = document.getElementsByClassName("car-d-1");
        carD1Element[0].innerHTML = car.d1;

        const carD2Element = document.getElementsByClassName("car-d-2");
        carD2Element[0].innerHTML = car.d2;

        const carD3Element = document.getElementsByClassName("car-d-3");
        carD3Element[0].innerHTML = car.d3;

        const carD4Element = document.getElementsByClassName("car-d-4");
        carD4Element[0].innerHTML = car.d4;

        const carD5Element = document.getElementsByClassName("car-d-5");
        carD5Element[0].innerHTML = car.d5;
    });


// Get the ID parameter from the current URL
const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get('id');
  
// Set the href attribute of the <a> tag to include the ID
const financingLink = document.getElementById('financing-link');
financingLink.href = `finance.php?id=${id}`;

// Set the href attribute of the <a> tag to include the ID
const purchaseLink = document.getElementById('purchase-link');
purchaseLink.href = `purchase.php?id=${id}`;
