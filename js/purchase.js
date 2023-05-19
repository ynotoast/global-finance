// Function to calculate the distance between two sets of coordinates
function calcDistance(lat1, lon1, lat2, lon2) {
    var R = 6371; // Earth's radius in kilometers
    var dLat = toRad(lat2 - lat1);
    var dLon = toRad(lon2 - lon1);
    var lat1 = toRad(lat1);
    var lat2 = toRad(lat2);
    var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.sin(dLon / 2) * Math.sin(dLon / 2) * Math.cos(lat1) * Math.cos(lat2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d = R * c; // Distance in kilometers
    return d;
}

// Function to convert degrees to radians
function toRad(degrees) {
    return degrees * Math.PI / 180;
}

// Function to display the list of dealerships sorted by distance
function displayDealerships(position) {
    // Get user's latitude and longitude
    const lat1 = position.coords.latitude;
    const lon1 = position.coords.longitude;

    // Load list of dealerships from JSON file
    fetch('dealerships.json')
        .then(response => response.json())
        .then(data => {
            // Calculate distance between user and each dealership
            const dealerships = data.dealerships.map(dealer => {
                const lat2 = dealer.latitude;
                const lon2 = dealer.longitude;
                const distance = calcDistance(lat1, lon1, lat2, lon2);
                dealer.distance = distance;
                return dealer;
            });

            // Sort dealerships by distance
            dealerships.sort((a, b) => a.distance - b.distance);

            // Create HTML list of dealerships
            const list = document.getElementById('dealerships');
            list.innerHTML = '';
            dealerships.forEach(dealer => {
                const li = document.createElement('li');
                const name = document.createElement('h3');
                const distance = document.createElement('p');
                const address = document.createElement('p');
                const phone = document.createElement('p');
                const url = document.createElement('p');
                name.innerText = dealer.name;
                address.innerText = 'Address: ' + dealer.address;
                phone.innerText = 'Phone Number: ' + dealer.phone;
                url.innerText = 'Website: ' + dealer.url;
                distance.innerText = `Distance: ${dealer.distance.toFixed(2)} km`;
                li.appendChild(name);
                li.appendChild(distance);
                li.appendChild(address);
                li.appendChild(phone);
                li.appendChild(url);
                list.appendChild(li);
            });
        })
        .catch(error => console.log(error));
}

// Function to handle errors when obtaining the user's location
function locationError(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            alert("Please turn on location data to see your nearest dealerships.");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("Location information is unavailable.");
            break;
        case error.TIMEOUT:
            alert("The request to get user location timed out.");
            break;
        case error.UNKNOWN_ERROR:
            alert("An unknown error occurred.");
            break;
    }
}

// Function to obtain the user's location
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(displayDealerships, locationError);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}