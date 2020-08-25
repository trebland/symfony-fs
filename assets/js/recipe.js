var $collectionPanel;

$(document).ready(function() {
    var $addButton = $("#add-ingredient");
    $collectionPanel = $("#ingredients .collection");

    // Adds a delete button onto each group innately included in the form
    $('.delete-group').each(function (){
        $(this).click(function () {
            removeAndUpdateIngredients($(this));
        })
    });

    // Allows for the user to add an ingredient field.
    $addButton.click(function () {
        addField();
    });


});

function addField() {
    var length = $collectionPanel.children().length;

    var $input = $('<input type="text" id="recipe_ingredients_' + length + '" name="recipe[ingredients][' + length + ']" class="form-control recipe_ingredient" placeholder="Ingredient Name" aria-label="Ingredient Name" aria-describedby="button-addon' + length + '" required>');

    var $button = $('<button class="btn btn-danger" type="button" id="button-addon' + length + '">Delete</button>');

    $button.click(function () {
        removeAndUpdateIngredients($(this));
    });
    
    var $inputGroup = $(`
    <div class="input-group-append delete-group">
    </div>
    `).append($button);

    var $field = $(`
        <div class="input-group mb-3">
        </div>
    `).append($input).append($inputGroup);

    // Adds a delete button onto each group dynamically included in the form
    $collectionPanel.append($field);
}

// Current area of improvement
function removeAndUpdateIngredients(buttonRef) {
    $(buttonRef).closest('.input-group').remove();
    
    $('.recipe_ingredient').each(function(index) {
        $(this).attr('id', "recipe_ingredients_" + index);
        $(this).attr('name', "recipe[ingredients][" + index + "]");
    });
}