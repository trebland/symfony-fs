var $collectionPanel;

$(document).ready(function() {
    // Our button which we will use to add an ingredient slot
    var $addButton = $("#add-ingredient");

    // Our container for ingredients
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

// Adds an ingredient input field with the appropriate ids/names/classes
function addField() {
    var length = $collectionPanel.children().length;

    var $field = $(`
        <div class="input-group mb-3">
        <input type="text" id="recipe_ingredients_` + length + `" name="recipe[ingredients][` + length + `]" class="form-control recipe_ingredient" placeholder="Ingredient Name" aria-label="Ingredient Name" aria-describedby="button-addon` + length + `" required>
        </div>
    `).append(createButtonGroup());

    // Adds a delete button onto each group dynamically included in the form
    $collectionPanel.append($field);
}

// Manufactures the button group to append to the ingredient input field
function createButtonGroup() {
    var $button = $('<button class="btn btn-danger" type="button" id="button-addon' + length + '">Delete</button>');

    $button.click(function () {
        removeAndUpdateIngredients($(this));
    });
    
    var $inputGroup = $(`
    <div class="input-group-append delete-group">
    </div>
    `).append($button);

    return $inputGroup;
}

// Removes the ingredient line and updates the necessary ids/names to ensure
// .. recipe saving for ingredients occurs correctly.
function removeAndUpdateIngredients(buttonRef) {
    $(buttonRef).closest('.input-group').remove();
    
    $('.recipe_ingredient').each(function(index) {
        $(this).attr('id', "recipe_ingredients_" + index);
        $(this).attr('name', "recipe[ingredients][" + index + "]");
    });
}