document.addEventListener("DOMContentLoaded", function () {
    const calendarBody = document.getElementById("calendar");
    const monthDisplay = document.getElementById("month-display");
    const prevButton = document.getElementById("prev-month");
    const nextButton = document.getElementById("next-month");
    const hiddenDateInput = document.getElementById("date"); // Reference to the hidden input

    const currentDate = new Date(); // Get local time from user's computer
    let selectedCell = null;

    let displayYear = currentDate.getFullYear();
    let displayMonth = currentDate.getMonth();

    // Array of month names for display
    const monthNames = [
        "January", "February", "March", "April", "May", "June", "July",
        "August", "September", "October", "November", "December"
    ];

    // Function to render the calendar
    function renderCalendar(year, month) {
        // Update the month display
        monthDisplay.textContent = `${monthNames[month]} ${year}`;

        // Clear calendar body
        calendarBody.innerHTML = "";

        // Get first day of the month and total days
        const firstDay = new Date(year, month, 1).getDay();
        const totalDays = new Date(year, month + 1, 0).getDate();

        let row = document.createElement("tr");
        let dayCounter = 1;

        // Empty cells for days before the first day
        for (let i = 0; i < firstDay; i++) {
            const emptyCell = document.createElement("td");
            row.appendChild(emptyCell);
        }

        // Populate calendar cells
        for (let i = firstDay; i < 7; i++) {
            addCalendarCell(dayCounter++, row, year, month);
        }
        calendarBody.appendChild(row);

        while (dayCounter <= totalDays) {
            row = document.createElement("tr");
            for (let i = 0; i < 7 && dayCounter <= totalDays; i++) {
                addCalendarCell(dayCounter++, row, year, month);
            }
            calendarBody.appendChild(row);
        }
    }

    // Function to add a calendar cell (date)
    function addCalendarCell(day, row, year, month) {
        const cell = document.createElement("td");
        cell.textContent = day;

        const today = new Date(); // Get current date dynamically

        // Highlight today's date
        if (
            day === today.getDate() &&
            month === today.getMonth() &&
            year === today.getFullYear()
        ) {
            cell.classList.add("today");
        }

        // Allow selection of date
        cell.addEventListener("click", function () {
            if (selectedCell) {
                selectedCell.classList.remove("selected");
            }
            cell.classList.add("selected");
            selectedCell = cell;

            // Format selected date as YYYY-MM-DD and update the hidden input
            const selectedDate = `${year}-${(month + 1).toString().padStart(2, "0")}-${day
                .toString()
                .padStart(2, "0")}`;

            hiddenDateInput.value = selectedDate; // Set value in the hidden input
            console.log(`Selected Date: ${selectedDate}`);
        });

        row.appendChild(cell);
    }

    // Add event listeners for month navigation
    prevButton.addEventListener("click", function () {
        displayMonth--;
        if (displayMonth < 0) {
            displayMonth = 11; // December
            displayYear--;
        }
        renderCalendar(displayYear, displayMonth);
    });

    nextButton.addEventListener("click", function () {
        displayMonth++;
        if (displayMonth > 11) {
            displayMonth = 0; // January
            displayYear++;
        }
        renderCalendar(displayYear, displayMonth);
    });

    // Initialize the calendar with the current date
    renderCalendar(displayYear, displayMonth);
});