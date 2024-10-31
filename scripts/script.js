const handleVisibility = () => {
    const blurred = document.querySelector('.the-blur-screen');
    if(window.scrollY < 100){
        blurred.style.visibility = "visible";
    }else{
        blurred.style.visibility = "hidden";
    }
};

window.addEventListener('scroll', handleVisibility());