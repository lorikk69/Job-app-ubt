function displayJobs() {
    const jobList = document.getElementById('jobList');
    jobList.innerHTML = ''; 

    const storedJobs = JSON.parse(localStorage.getItem('jobs')) || [];

    storedJobs.forEach(job => {
        const jobItem = document.createElement('li');
        jobItem.innerHTML = `
            <strong>Emri i kompanisë:</strong> ${job.kompania}<br>
            <strong>Qyteti:</strong> ${job.Qyteti}<br>
            <strong>Orari:</strong> ${job.orari}<br>
            <strong>Pozita:</strong> ${job.pozita}<br>
            <strong>Përshkrimi i punës:</strong> ${job.about_us}<br>
            <strong>Paga:</strong> ${job.paga} €<br>
            <hr>
        `;
        jobList.appendChild(jobItem);
    });
}

window.onload = displayJobs;