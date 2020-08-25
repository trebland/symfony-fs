$(document).ready(function() {
    var $addButton = $("#add-ingredient");
    var $removeButton = $("#remove-ingredient");

    $addButton.click(function () {
        addField();
    });


});

function addField() {
    $collectionPanel = $("#ingredients .collection");
    var length = $collectionPanel.children().length;

    var $input = $('<input type="text" id="recipe_ingredients_' + length + '" name="recipe[ingredients][' + length + ']" class="form-control" placeholder="Ingredient Name" aria-label="Ingredient Name" aria-describedby="button-addon' + length + '" required>');

    var $button = $('<button class="btn btn-danger" type="button" id="button-addon' + length + '">Delete</button>');

    $button.click(function () {
        $(this).closest('.input-group').remove();
    });
    
    var $inputGroup = $(`
    <div class="input-group-append">
    </div>
    `).append($button);

    var $field = $(`
        <div class="input-group mb-3">
        </div>
    `).append($input).append($inputGroup);

    $collectionPanel.append($field);
}

function removeField() {
    $().closest('.input-group').remove();
}

