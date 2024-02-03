function displayJobs() {
    const jobList = document.getElementById('jobList');
    jobList.innerHTML = '';

    const storedJobs = JSON.parse(localStorage.getItem('jobs')) || [];
    const maxFormsToShow = 3;  
    let formsDisplayed = 0;  

    storedJobs.forEach(job => {
        if (formsDisplayed < maxFormsToShow) {
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


            if (job.showButton) {
                const button = document.createElement('button');
                button.textContent = 'Posto punë';
                button.classList.add('buttoni_forma');
                button.addEventListener('click', () => rootbutton());
                jobItem.appendChild(button);
            }

            jobList.appendChild(jobItem);
            formsDisplayed++;
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    displayJobs();
});

function rootbutton() {
    window.location.href = '../Forma/forma.html';
}

window.onload = displayJobs;
