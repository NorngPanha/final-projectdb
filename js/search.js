function submitSearch() {
    // Get the value from the input field
    var query = document.getElementById('searchInput').value;

    // Create a new form dynamically
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'index.php';

    // Create a hidden input to store the search query
    var input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'location';
    input.value = query;
    form.appendChild(input);

    // Append the form to the body and submit it
    document.body.appendChild(form);
    form.submit();
}

// Handle button click
document.getElementById('searchButton').addEventListener('click', function() {
    submitSearch();
});

// Handle Enter key press in the input field
document.getElementById('searchInput').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault(); // Prevent form submission if it's within an actual form
        submitSearch();
    }
});