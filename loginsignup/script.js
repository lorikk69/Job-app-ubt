function signup() {
  const email = document.getElementById("signemail").value;
  const password = document.getElementById("signpassword").value;

  console.log("Email:", email);
  console.log("Password:", password);

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    alert("Shkruaj nje email valide.");
    return;
  }

  const passwordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)[A-Za-z\d]{8,}$/;
  if (!passwordRegex.test(password)) {
    alert("Fjalekalimi duhet te kete nje shkronje te vogel, nje shkronje te madhe, nje numer dhe duhet ti permbaje 8 apo me shume karaktere!");
    return;
  }

  if (localStorage.getItem(email)) {
    alert("Ky email eshte perdorur me pare, perdor nje tjeter!");
    return;
  }

  localStorage.setItem(email, password);

  document.getElementById("signupForm").reset();

  alert("Regjistrimi u krye me sukses.");
  window.location.href = "login.html";
}





function login() {
  const email = document.getElementById("loginemail").value;
  const password = document.getElementById("loginpassword").value;

  
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
  window.location.href = "../posto/posto_pune.html";
}

function showError() {
  alert("Email ose Fjalekalimi jane gabim, provo perseri.");
}