function displayJobs() {
    const jobList = document.getElementById('jobList');
    jobList.innerHTML = ''; 

    const storedJobs = JSON.parse(localStorage.getItem('jobs')) || [];
    const button = document.querySelector('.buttoni_forma');

    storedJobs.forEach(job => {
        const jobItem = document.createElement('li');
        jobItem.innerHTML = `
            <strong>Emri i kompanisë:</strong> ${job.kompania}<br>
            <strong>Qyteti:</strong> ${job.Qyteti}<br>
            <strong>Orari:</strong> ${job.orari}<br>
            <strong>Pozita:</strong> ${job.pozita}<br>
            <strong>Përshkrimi i punës:</strong> ${job.about_us}<br>
            <strong>Paga:</strong> ${job.paga} €<br>
            <button class="buttoni_forma">Apliko</button>

            <hr>
        `;
        jobItem.querySelector('.buttoni_forma').addEventListener('click', () => rootbutton());
        jobList.appendChild(jobItem);
    });

  
    
}

document.addEventListener('DOMContentLoaded', () => {
    displayJobs();

    const button = document.querySelector('.buttoni_forma');
    
    button.addEventListener('click', rootbutton);
})
;


function rootbutton() {
    window.location.href = '../Forma/forma.html';
}


window.onload = displayJobs;