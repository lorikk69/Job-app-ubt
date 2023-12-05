let emailsv;
let passwordsv;
const divi = document.getElementsByClassName("signupforma")[0];
const butonis = document.getElementById("butonis");
let butonil;

butonis.addEventListener("click", function () {
    const emris = document.getElementById("emris");
    const emails = document.getElementById("emails");
    const passwords = document.getElementById("passwords");
    let emrisv = emris.value;
    emailsv = emails.value;
    passwordsv = passwords.value;

    if (emrisv != "" && emailsv != "" && passwordsv != "") {
        alert("Ju jeni regjistruar me sukses!");
        divi.outerHTML = ` 
    <div class="signupforma">
    <p id="titulli">Log In</p>
    <form>
        <label for="email">Email: </label>
        <input type="email" id="emaill" name="email" placeholder="Email" required>
    
        <label for="password">Fjalëkalimi: </label>
        <input type="password" id="passwordl" name="password" placeholder="Fjalëkalimi" required>
    
        <button type="submit" id="butonil">Login</button>
    </form>
    </div>`;
        butonil = document.getElementById("butonil");
    } else {
        alert("Ju lutem mbushini format me poshte!");
    }
})

document.addEventListener("click", function (event) {
    if (event.target && event.target.id == "butonil") {
        event.preventDefault(); 
        const emaill2 = document.getElementById("emaill");
        const passwordl2 = document.getElementById("passwordl");

        let emaillv = emaill2.value;
        let passwordlv = passwordl2.value;
        let loginsuccess = false;
        if (emailsv === emaillv && passwordsv === passwordlv) {
            loginsuccess = true;
            alert("Jeni kyçur me sukses!");
            window.location.href = "../index/index.html";
        } else {
            alert("Email ose Fjalëkalimi janë gabim, provoni përsëri!");
        }
    }
});
