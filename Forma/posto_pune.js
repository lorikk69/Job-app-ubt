function posto_pune() {
    let kompania = document.getElementById('kompania').value;
    let qyteti = document.getElementById('Qyteti').value;
    let orari = document.getElementById('orari').value;
    let pozita = document.getElementById('pozita').value;
    let about_us = document.getElementById('about_us').value;
    let paga = document.getElementById('paga').value;

    if (kompania === "") {
        alert("Ju lutem shkruani emrin e kompanisë");
        return;
    } else if (qyteti === "") {
        alert("Ju lutem shkruani qytetin");
        return;
    } else if (orari === "") {
        alert("Ju lutem zgjidheni orarin per klienta");
        return;
    } else if (pozita === "") {
        alert("Ju lutem shkruani poziten e punës");
        return;
    } else if (about_us === "") {
        alert("Ju lutem shkruani diqka per kompaninë tuaj");
        return;
    } else if (paga === "") {
        alert("Ju lutem shkruani pagen e caktuar");
        return;
    }

    const job = {
        kompania,
        qyteti,
        orari,
        pozita,
        about_us,
        paga,
    };

    const storedJobs = JSON.parse(localStorage.getItem('jobs')) || [];
    storedJobs.push(job);
    localStorage.setItem('jobs', JSON.stringify(storedJobs));

 
    alert("Puna u postua me sukses!");

    window.location.href = "../Shpalljet/Shpallje.html";
}

