function initSearch(searchInputId, tableId) {
    const searchInput = document.getElementById(searchInputId);
    const table = document.getElementById(tableId);

    if (!searchInput || !table) {
        return; // exit if the required elements are not found.
    }

    searchInput.addEventListener("input", function() {
        const searchTerm = searchInput.value.toLowerCase(); // convert searchTerm to lowercase
        const rows = table.getElementsByTagName("tr"); // fetch all rows

        for (let i = 1; i < rows.length; i++) { // start at 1 to skip the header row
            const cells = rows[i].getElementsByTagName("td"); // fetches column data of the current row
            let match = false; // flag variable

            for (let j = 0; j < cells.length; j++) { // loops through the current row
                if (cells[j].textContent.toLowerCase().includes(searchTerm)) {
                    match = true;
                    break;
                }
            }

            if (match) {
                rows[i].style.display = "table-row"; // show row with matching result 
            } else {
                rows[i].style.display = "none"; // hide rows without the matching result
            }
        }
    });
}
