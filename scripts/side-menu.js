/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-button");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function () {
    this.parentNode.classList.toggle("expanded");
    var dropdownContent = this.parentNode.querySelector("ul.inner-dropdown");
    dropdownContent.classList.toggle("slideDown");
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }

    for (j = 0; j < dropdown.length; j++) {
      if (this != dropdown[j]) {
        console.log(dropdown[j]);

        var dropdownContent =
          dropdown[j].parentNode.querySelector("ul.inner-dropdown");
        if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
          dropdown[j].parentNode.classList.remove("expanded");
          dropdownContent.classList.toggle("slideDown");
        } 
      }
    }
  });
}
