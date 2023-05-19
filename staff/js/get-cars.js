// Load the JSON file
fetch('../../car.json')
  .then(response => response.json())
  .then(data => {
    // Extract the names of the cars
    const carNames = data.cars.map(car => car.longName);
    
    // Output the names to an HTML file
    const output = document.getElementById('output');
    output.innerHTML = carNames.join('<br>');
  });

