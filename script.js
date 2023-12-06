function signup() {
  const email = document.getElementById("signemail").value;
  const password = document.getElementById("signpassowrd").value;


  if (localStorage.getItem(email)) {
    alert("Ky email eshte perdorur me pare, zgjidh nje tjeter.");
    return;
  }


  localStorage.setItem(email, password);


  document.getElementById("signupForm").reset();

  alert("Llogaria eshte krijuar me sukses.");
  window.location.href = "/login.html";
}

function login() {
  const email = document.getElementById("loginemail").value;
  const password = document.getElementById("loginpassword").value;

  e
  if (!localStorage.getItem(email)) {

    showError();
    return;
  }


  if (localStorage.getItem(email) !== password) {

    showError();
    return;
  }


  document.getElementById("loginForm").reset();

  alert("U kyçet me sukses miresevini.");
  window.location.href = "../index/index.html";
}

function showError() {
  alert("Email ose Fjalekalimi jane gabim, provo perseri.");
}