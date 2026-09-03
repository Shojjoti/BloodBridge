function viewDonor(id)
{
    const url =
        "index.php?action=donorDetails&id="
        + encodeURIComponent(id);


    fetch(url)

        .then(response =>
            response.json()
        )

        .then(data => {

            if (!data.success) {

                alert(data.message);

                return;
            }


            const donor = data.donor;


            document.getElementById(
                "donorName"
            ).textContent = donor.name;


            document.getElementById(
                "donorBlood"
            ).textContent = donor.blood_group;


            document.getElementById(
                "donorPhone"
            ).textContent = donor.phone;


            document.getElementById(
                "donorEmail"
            ).textContent = donor.email;


            document.getElementById(
                "donorDistance"
            ).textContent =
                "Verified donor";


            document.getElementById(
                "donorModal"
            ).style.display = "flex";

        })

        .catch(error => {

            console.log(error);

            alert(
                "Unable to load donor details."
            );

        });
}


function closeDonorModal()
{
    document.getElementById(
        "donorModal"
    ).style.display = "none";
}