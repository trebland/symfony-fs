// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.css';

import $ from 'jquery';

// Attaches the href tag dynamically to our search bar
// .. whose value is tied to the search input
$(function() {
    $('#search-form').submit(function(event) {
        event.preventDefault();
        
        var searchValue = findSearchValue();
        if (searchValue && searchValue.length > 0)
            window.location = ("/search/" + findSearchValue());
        else
            window.location = ("/");
    })

    // $('#search-input').submit(function() {
    //     var searchValue = findSearchValue();
    //     if (searchValue && searchValue.length > 0)
    //         $(this).attr("href", ("/search/" + findSearchValue()) );
    //     else
    //         $(this).attr("href", ("/"));
    // })
});

// Finds the value of the search-input by ID
function findSearchValue() {
    return $('#search-input').val();
}