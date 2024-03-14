document.addEventListener("DOMContentLoaded", () => {
    // Fetch fruit data from API or use your own dataset
    fetch('https://www.fruityvice.com/api/fruit/all')
        .then(response => response.json())
        .then(data => displayFruits(data));

    function displayFruits(fruits) {
        const fruitsSection = document.getElementById('fruits');
        fruitsSection.innerHTML = '';

        fruits.forEach(fruit => {
            const card = document.createElement('div');
            card.className = 'fruit-card';
            card.innerHTML = `
                <h2>${fruit.name}</h2>
                <p>Calories: ${fruit.nutritions.calories}</p>
                <p>Fat: ${fruit.nutritions.fat}</p>
                <p>Sugar: ${fruit.nutritions.sugar}</p>
                <p>Carbohydrates: ${fruit.nutritions.carbohydrates}</p>
                <p>Protein: ${fruit.nutritions.protein}</p>
                <!-- Add more details as needed -->

                <!-- Include buttons for edit and delete -->
            `;

            fruitsSection.appendChild(card);
        });
    }

    // Add your search, CRUD operations, and other functionalities here
    // app.js

// Wait for the DOM to be fully loaded
document.addEventListener("DOMContentLoaded", function () {
    // Attach click event to the entire fruits section
    document.getElementById("fruits").addEventListener("click", function (event) {
        // Check if the clicked element is an Edit or Delete button
        if (event.target.classList.contains("edit-btn")) {
            // Handle Edit button click
            const fruitId = event.target.closest(".fruit-card").dataset.fruitId;
            editFruit(fruitId);
        } else if (event.target.classList.contains("delete-btn")) {
            // Handle Delete button click
            const fruitId = event.target.closest(".fruit-card").dataset.fruitId;
            deleteFruit(fruitId);
        }
    });
});

// Function to handle Edit button click
function editFruit(fruitId) {
    // Implement your logic to edit the fruit with the given ID
    console.log("Edit fruit with ID:", fruitId);
}

// Function to handle Delete button click
function deleteFruit(fruitId) {
    // Implement your logic to delete the fruit with the given ID
    console.log("Delete fruit with ID:", fruitId);
}

});
