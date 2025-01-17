<footer class="site-footer">

  <a href="#top" class="smoothscroll scroll-top">
    <span class="icon-keyboard_arrow_up"></span>
  </a>

  <div class="container">
    <div class="row mb-5">
      <div class="col-6 col-md-3 mb-4 mb-md-0">
        <h3>Search Trending</h3>
        <ul class="list-unstyled">
          <li><a href="#">Web Design</a></li>
          <li><a href="#">Graphic Design</a></li>
          <li><a href="#">Web Developers</a></li>
          <li><a href="#">Python</a></li>
          <li><a href="#">HTML5</a></li>
          <li><a href="#">CSS3</a></li>
        </ul>
      </div>
      <div class="col-6 col-md-3 mb-4 mb-md-0">
        <h3>Company</h3>
        <ul class="list-unstyled">
          <li><a href="http://localhost/jobboard/about.php">About Us</a></li>
        </ul>
      </div>
      <div class="col-6 col-md-3 mb-4 mb-md-0">
        <h3>Support</h3>
        <ul class="list-unstyled">
          <li><a href="#">Support</a></li>
          <li><a href="#">Privacy</a></li>
          <li><a href="#">Terms of Service</a></li>
        </ul>
      </div>
      <div class="col-6 col-md-3 mb-4 mb-md-0">
        <h3>Contact Us</h3>
        <div class="footer-social">
          <a href="#"><span class="icon-facebook"></span></a>
          <a href="#"><span class="icon-twitter"></span></a>
          <a href="#"><span class="icon-instagram"></span></a>
          <a href="#"><span class="icon-linkedin"></span></a>
        </div>
      </div>
    </div>

    <div class="row text-center">
      <div class="col-12">
        <p class="copyright"><small>
            Copyright &copy;
            <script>document.write(new Date().getFullYear());</script> All rights reserved | Jobboard
          </small></p>
      </div>
    </div>
  </div>
</footer>

</div>

<!-- SCRIPTS -->
<script src="http://localhost/jobboard/js/jquery.min.js"></script>
<script src="http://localhost/jobboard/js/bootstrap.bundle.min.js"></script>
<script src="http://localhost/jobboard/js/isotope.pkgd.min.js"></script>
<script src="http://localhost/jobboard/js/stickyfill.min.js"></script>
<script src="http://localhost/jobboard//js/jquery.fancybox.min.js"></script>
<script src="http://localhost/jobboard/js/jquery.easing.1.3.js"></script>

<script src="http://localhost/jobboard/js/jquery.waypoints.min.js"></script>
<script src="http://localhost/jobboard/js/jquery.animateNumber.min.js"></script>
<script src="http://localhost/jobboard/js/owl.carousel.min.js"></script>
<script src="http://localhost/jobboard/js/quill.min.js"></script>


<script src="http://localhost/jobboard/js/bootstrap-select.min.js"></script>

<script src="http://localhost/jobboard/js/custom.js"></script>


<script>
  $(document).ready(function () {
    $.getJSON("https://restcountries.com/v3.1/all", function (data) {
      data.sort((a, b) => a.name.common.localeCompare(b.name.common));
      $.each(data, function (key, country) {
        $('#country-picker').append('<option value="' + country.name.common + '">' + country.name.common + '</option>');
      });

      $('#country-picker').selectpicker('refresh');
    });
  });
</script>



</body>

</html>