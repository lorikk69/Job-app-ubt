function redirect() {
    let form = document.getElementById("forma");     

    form.addEventListener("submit", (f) => {
        f.preventDefault();
        let emri = document.getElementById("emri");
        let mbiemri = document.getElementById('mbiemri');
        let email = document.getElementById('email');
        let qyteti = document.getElementById("qyteti");
        let viti_lindjes = document.getElementById("viti_lindjes");


        if(emri.value === ""){
            alert("Ju lutem shkruani emrin");
            return;
        }else if(mbiemri.value === ""){
            alert("Ju lutem shkruani mbiemrin");
            return;
        }else if(email.value === ""){
            alert("Ju lutem shkruani email-in");
            return;
        }else if(qyteti.value === ""){
            alert("Ju lutem shkruani qytetin");
            return;
        }else if(viti_lindjes.value === ""){
            alert("Ju lutem selektoni vitin e lindjes");
        }

        window.location.href = "../Shpalljet/Shpallje.html";
    })



    
}