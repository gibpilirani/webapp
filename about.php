<?php
session_start();
?>
<!-- HEADER -->
<?php include_once('web_header.php'); ?>
<!--END OF HEADER-->
<!-- Main contenet -->
<main class="mt-3">
 <div class="container mt-3">
  <div class="row">
   <div class="col-md-8 text-justify">
    <h4>About us</h4>
    <p>The website provides information about history of computing in Malawi. It also serves as the History of Computing Collection where the community will provide any data or infomation about the computing for Malawi. The website will collect, document and publish relevant information including historical images, audio narration, video clips and others. It is a place where researchers could find information and share their ideas and research data. </p>
    <p>The information provided aims to appreciate the development of technology from the 1960s to the present and understand the trend in computing in general and then emphasise on developing technology in universities, colleges,schools and other industries. It also  gives us the reason, and how computers were brought into the education system and the influence computing has had in promoting education for the benefit of the citizens. </p>
  </p>
  <p>
    This project aims to support research and teaching to do with the development of computing and its impact on the world. It will contain information on hardware, software, archive, oral histories and ephemera. 
  </p>
    <p>It also includes things like:
<ol class="">
  <li>computation before computers,</li>
  <li>software engineering, and</li>
  <li>the development of computing in and its influence in Malawi.</li>
  <li>computer education and</li>
  <li>HCI</li>
  <li>Data processing</li>
</ol>

<p>The projects could support and explore established and new areas of the physical collection and archives. Activities could be: working on legacy software and emulators; learning about digital preservation; making social and economic case studies; collecting oral histories of ICT developments; investigating and explaining our tems and exhibits; designing social media and podcasts. Investigate topics that contribute to the new research programme in Educational, Historical and Philosophical Foundations of computing.
  </p>
</div>
<div class="col-md-4">
 <div class="col-md-12">
  <h6 class="font-weight-bold">POPULAR TOPICS</h6>
  <hr class="line">
  <!--Links for popular posts-->
  <?php include 'popular/popular-posts.php'; ?>
</div>
</div>
</div>
</div>
</main>
<!--Footer-->
<div><?php include_once('footer.php');?> </div>
<script>
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>


</body>
</html>
