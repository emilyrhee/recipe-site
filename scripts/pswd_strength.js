const passwordValidation = () => {
    const password = document.getElementById("password").value;
    const notifying_user = document.getElementById("notifying_user");

    const regexExpression = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    if(regexExpression.test(password) && password.length >= 8){
        notifying_user.style.color = "green";
        notifying_user.textContent = "Strong Password !";
    }
    else if( regexExpression.test(password) && password.length < 8){
        notifying_user.style.color = "orange";
        notifying_user.textContent = "Password must be at least 8 characters or more !";

    }
    else{
        notifying_user.style.color = "red";
        notifying_user.textContent = "Password must be at least 8 characters or more and contain special character !";
    }
}