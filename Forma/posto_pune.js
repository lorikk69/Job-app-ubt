function posto_pune() {
    const requiredElements = document.querySelectorAll('[required]');
    let allFieldsFilled = true;

    const job = {
        kompania: document.getElementById('kompania').value,
        Qyteti: document.getElementById('Qyteti').value,
        orari: document.getElementById('orari').value,
        pozita: document.getElementById('pozita').value,
        about_us: document.getElementById('about_us').value,
        paga: document.getElementById('paga').value,
    };

    requiredElements.forEach((element) => {
        if (!element.value.trim()) {
            allFieldsFilled = false;
        }
    });

    if (allFieldsFilled) {
        const storedJobs = JSON.parse(localStorage.getItem('jobs')) || [];

        storedJobs.push(job);

        localStorage.setItem('jobs', JSON.stringify(storedJobs));

        const event = new Event('jobPosted');
        document.dispatchEvent(event);

        alert("Puna u postua me sukses!");
    } else {
        alert("Ju lutem, plotësoni të gjitha fushat e detyrueshme!");
    }
    
}
