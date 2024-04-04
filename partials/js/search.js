$(document).ready(function() {
    const searchResultsAll = document.getElementById('search-results');
    $('#search-form').submit(function(e) {
        e.preventDefault();

        const query = $('#search-query').val();
        const genre = $('#search-genre').val();

        // Perform an AJAX request to search.php
        $.get('search.php', {
            query: query,
            genre: genre
        }, function(data) {
            displaySearchResults(data);
        });
        searchResultsAll.removeAttribute('hidden');
    });

    function displaySearchResults(results) {
        const resultList = $('#search-results-list');
        resultList.empty();

        if (results.length === 0) {
            resultList.append('<li>No results found.</li>');
        } else {
            results.forEach(function(result) {
                resultList.append('<li>' + result.dname + '</li>');
            });
        }
    }
});