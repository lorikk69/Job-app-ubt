<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,400;0,700;1,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="About_us.css">
  <title>About - An example of about us page</title>
</head>
<body>

<?php 
    session_start();
    include '../headerfooter/header.php';
?>

<section class="banner">
  <div class="container">
    <h1>About us</h1>
  </div>
</section>

<section class="first">
  <div class="container">
    <p>Në TalentCraft, ne shpërblejmë talentin dhe inkurajojmë zhvillimin personal dhe profesional. Krijimi i një mjedisi tërheqës dhe i mbështetur për punonjësit dhe punëdhënësit është në qendër të vlerave tona.</p>
  </div>
</section>

<section class="slideshow-container">
  <div class="mySlides fade">
    <div class="container">
      <div class="overlay">
        <div class="text">Bashkëpunim</div>
      </div>
      <img src="../photos/career.jpg" alt="Slide 1">
    </div>
  </div>
  <div class="mySlides fade">
    <div class="container">
      <div class="overlay">
        <div class="text">Team Work!</div>
      </div>
      <img src="../photos/career1.jpg" alt="Slide 2">
    </div>
  </div>
  <div class="mySlides fade">
    <div class="container">
      <div class="overlay">
        <div class="text">:)</div>
      </div>
      <img src="../photos/career2.webp" alt="Slide 3">
    </div>
  </div>
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
</section>


<section class="second">
  <div class="container">
    <div class="left-img">
      <img src="../photos/img1.webp" alt="Person">
    </div>
    <div class="right-content">
      <h2>Misioni ynë</h2>
      <p>Misioni ynë është të lidhim talentin me mundësitë, duke krijuar një rrjet të fortë pune që sjellë përparim dhe sukses për individët dhe organizatat. Ne jemi të përkushtuar në sigurimin e një platforme inovative dhe efektive për gjetjen e punës dhe rekrutimin e kualifikuarve.</p>
    </div>
  </div>
</section>

<section class="third">
  <div class="container">
    <div class="left-content">
      <h2>Vlerat tona</h2>
      <p>
        <li>Integriteti: Ne vlerësojmë integritetin dhe sjelljen etike në çdo veprim.</li>
        <li>Inovacioni: Inkurajojmë mendimin kreativ dhe zhvillimin e produkteve dhe shërbimeve inovative.</li>
        <li>Bashkëpunimi: Besojmë në fuqinë e bashkëpunimit dhe krijimit të një ekipi të fortë.</li>
        <li>Përgjegjësia: Kemi përgjegjësi ndaj punonjësve, punëdhënësve dhe komunitetit ku operojmë.</li>
      </p>
      <a class="cta" href="../Contact/Contact.php">Contact us »</a>
    </div>
    <div class="right-img">
      <img src="../photos/ph1.jpg" alt="photo">
    </div>
  </div>
</section>

<?php 
  include '../headerfooter/footer.php';
?>

<script>
    let slideIndex = 1;
    showSlides(slideIndex);
    
    function plusSlides(n) {
      showSlides(slideIndex += n);
    }
    
    function showSlides(n) {
      let i;
      let slides = document.getElementsByClassName("mySlides");
      if (n > slides.length) {slideIndex = 1}
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
      }
      slides[slideIndex-1].style.display = "block";
    }
</script>

</body>
</html>
