function initSearch(searchInputId, tableId) {
    const searchInput = document.getElementById(searchInputId);
    const table = document.getElementById(tableId);

    if (!searchInput || !table) {
        return; // Exit if the required elements are not found.
    }

    searchInput.addEventListener("input", function() {
        const searchTerm = searchInput.value.toLowerCase();
        const rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) { // Start at 1 to skip the header row
            const cells = rows[i].getElementsByTagName("td");
            let match = false;

            for (let j = 0; j < cells.length; j++) {
                if (cells[j].textContent.toLowerCase().includes(searchTerm)) {
                    match = true;
                    break;
                }
            }

            if (match) {
                rows[i].style.display = "table-row"; // Show row
            } else {
                rows[i].style.display = "none"; // Hide row
            }
        }
    });
}
