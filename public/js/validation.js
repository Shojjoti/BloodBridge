document.addEventListener("DOMContentLoaded", function () {

    const donorForm = document.getElementById("donorRegisterForm");

    if (donorForm) {

        donorForm.addEventListener("submit", function (event) {

            let name =
                document.getElementById("name").value.trim();

            let email =
                document.getElementById("email").value.trim();

            let nid =
                document.getElementById("nid").value.trim();

            let phone =
                document.getElementById("phone").value.trim();

            let password =
                document.getElementById("password").value;

            let confirmPassword =
                document.getElementById("confirm_password").value;


            let valid = true;


            if (name === "") {

                alert("Name is required.");

                valid = false;
            }


            const emailPattern =
                /^[^\s@]+@gmail\.com$/;


            if (!emailPattern.test(email)) {

                alert("Enter a valid Gmail.");

                valid = false;
            }


            const nidPattern =
                /^([0-9]{10}|[0-9]{13}|[0-9]{17})$/;


            if (!nidPattern.test(nid)) {

                alert("Enter a valid NID number.");

                valid = false;
            }


            const phonePattern =
                /^01[3-9][0-9]{8}$/;


            if (!phonePattern.test(phone)) {

                alert("Enter a valid Bangladesh phone number.");

                valid = false;
            }


            if (password.length < 8) {

                alert(
                    "Password must contain at least 8 characters."
                );

                valid = false;
            }


            if (password !== confirmPassword) {

                alert("Passwords do not match.");

                valid = false;
            }


            if (!valid) {

                event.preventDefault();
            }

        });
    }


    const userForm =
        document.getElementById("userRegisterForm");


    if (userForm) {

        userForm.addEventListener("submit", function (event) {

            const email =
                document.getElementById("email").value.trim();

            const password =
                document.getElementById("password").value;

            const confirmPassword =
                document.getElementById("confirm_password").value;


            const emailPattern =
                /^[^\s@]+@gmail\.com$/;


            if (!emailPattern.test(email)) {

                alert("Enter a valid Gmail.");

                event.preventDefault();

                return;
            }


            if (password.length < 8) {

                alert(
                    "Password must contain at least 8 characters."
                );

                event.preventDefault();

                return;
            }


            if (password !== confirmPassword) {

                alert("Passwords do not match.");

                event.preventDefault();
            }

        });
    }


    const loginForm =
        document.getElementById("loginForm");


    if (loginForm) {

        loginForm.addEventListener("submit", function (event) {

            const email =
                document.getElementById("email").value.trim();

            const password =
                document.getElementById("password").value;


            const emailPattern =
                /^[^\s@]+@gmail\.com$/;


            if (!emailPattern.test(email)) {

                alert("Enter a valid Gmail.");

                event.preventDefault();

                return;
            }


            if (password === "") {

                alert("Password is required.");

                event.preventDefault();
            }

        });
    }

});