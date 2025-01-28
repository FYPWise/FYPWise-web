const selectAll = document.getElementById("select-all")
const checkboxes = document.querySelectorAll(".row-checkbox");
const outputDiv = document.getElementById("output");

// array to store selected IDs
let selectedItems = [];

// function to update the selected items
function updateSelectedItems() {
    // update the output div to display selected items
    outputDiv.innerHTML = `<p>Selected Items: ${selectedItems.join(", ")}</p>`;
}

// event listener for individual checkboxes
checkboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", function () {
        const itemId = this.value;

        if (this.checked) {
            // add item to list
            if (!selectedItems.includes(itemId)) {
                selectedItems.push(itemId);
            }
        } else {
            // remove item from list
            selectedItems = selectedItems.filter(id => id !== itemId);
        }

        updateSelectedItems();
    });
});

// event listener for select all checkboxes
selectAll.addEventListener("change", function () {
    const isChecked = selectAll.checked;

    // update all row checkboxes when user clicks select-all checkbox
    checkboxes.forEach((checkbox) => {
        checkbox.checked = isChecked;
        const itemId = checkbox.value;

        if (isChecked && !selectedItems.includes(itemId)) {
            selectedItems.push(itemId);
        } else if (!isChecked) {
            selectedItems = selectedItems.filter(id => id !== itemId);
        }
    });

    updateSelectedItems();
});