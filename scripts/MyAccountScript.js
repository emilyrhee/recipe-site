const hamburgerDropDown = () => {
    const dropdown = document.getElementById('MyAccountDropdown');
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";

    if(dropdown.style.display === "block"){
        setTimeout(() => window.addEventListener('click', closeHamburgerDropdown), 1); // this interval help that with one click it pops up and close up
    }
}

// click outside of the hamburger
const closeHamburgerDropdown = (event) =>{
    const dropdown = document.getElementById('MyAccountDropdown');
    const button = document.getElementById('checking');

    if(event.target !== dropdown && event.target !== button){
        dropdown.style.display = 'none';
        window.removeEventListener('click', closeHamburgerDropdown);
    }
}