document.addEventListener(
    "DOMContentLoaded",
    function () {

        const dashboard =
            document.getElementById(
                "adminDashboard"
            );


        if (!dashboard) {
            return;
        }


        fetch(
            "index.php?action=adminStats"
        )

        .then(response =>
            response.json()
        )

        .then(data => {

            if (!data.success) {

                return;
            }


            document.getElementById(
                "totalDonors"
            ).textContent = data.donors;


            document.getElementById(
                "totalUsers"
            ).textContent = data.users;


            document.getElementById(
                "totalRequests"
            ).textContent = data.requests;


            document.getElementById(
                "verifiedDonors"
            ).textContent = data.verified;

        })

        .catch(error => {

            console.log(error);

        });

    }
);