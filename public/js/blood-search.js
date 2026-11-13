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

document.addEventListener('DOMContentLoaded', function() {
    const geoBtn = document.getElementById('geoBtn');
    if (geoBtn) {
        geoBtn.addEventListener('click', function() {
            if (navigator.geolocation) {
                // visually indicate loading
                const originalContent = this.innerHTML;
                this.innerHTML = '⏳';
                
                navigator.geolocation.getCurrentPosition(function(position) {
                    document.getElementById('lat').value = position.coords.latitude;
                    document.getElementById('lng').value = position.coords.longitude;
                    
                    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${position.coords.latitude}&lon=${position.coords.longitude}`)
                        .then(response => response.json())
                        .then(data => {
                        if (data && data.display_name) {
                            let addr = data.address;
                            let area = addr.neighbourhood || addr.suburb || addr.residential || addr.village || addr.county || "";
                            let city = addr.city || addr.town || addr.state_district || "";
                            
                            let parts = [];
                            if (area) parts.push(area);
                            if (city && city !== area) parts.push(city);
                            
                            document.getElementById('location').value = parts.length > 0 ? parts.join(', ') : data.display_name.split(',').slice(0, 2).join(', ');
                        }
                        document.getElementById('geoBtn').innerHTML = '✅';
                            setTimeout(() => geoBtn.innerHTML = originalContent, 2000);
                        })
                        .catch(err => {
                            console.error(err);
                            geoBtn.innerHTML = originalContent;
                            document.getElementById('location').value = "Lat: " + position.coords.latitude.toFixed(4) + ", Lng: " + position.coords.longitude.toFixed(4);
                        });
                }, function(error) {
                    alert("Error getting location: " + error.message);
                    geoBtn.innerHTML = originalContent;
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        });
    }
});