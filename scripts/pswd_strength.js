const passwordValidation = () => {
    const password = document.getElementById("password").value;
    const notifying_user = document.getElementById("notifying_user");

    const regexExpression = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_\-+=<>?{}[\]~])[A-Za-z\d!@#$%^&*()_\-+=<>?{}[\]~]{8,}$/;

    notifying_user.classList.remove("d-none");

    if (regexExpression.test(password)) {
        notifying_user.classList.remove("alert-warning");
        notifying_user.classList.remove("alert-danger");
        notifying_user.classList.add("alert-success");
        notifying_user.style.color = "green";
        notifying_user.textContent = "Strong Password!";
    } else if (password.length < 8) {
        notifying_user.classList.remove("alert-success");
        notifying_user.classList.remove("alert-danger");
        notifying_user.classList.add("alert-warning");
        notifying_user.style.color = "sienna";
        notifying_user.textContent = "Password must be at least 8 characters or more!";
    } else {
        notifying_user.classList.remove("alert-success");
        notifying_user.classList.remove("alert-danger");
        notifying_user.classList.add("alert-warning");
        notifying_user.style.color = "sienna";
        notifying_user.textContent = "Password must be at least 8 characters, include one uppercase letter, one lowercase letter, one number, and one special character!";
    }
};
