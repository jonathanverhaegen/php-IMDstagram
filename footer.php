<link rel="stylesheet" href="./style/footer.css">

<!-- Site footer -->
<footer class="site-footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-6">
          <h6>About us</h6>
          <p class="text-justify">Buckle-up is the new Instagram for posting your content about travelling.</p>
        </div>

        <div class="col-xs-6 col-md-3">
        </div>

        <div class="col-xs-6 col-md-3">
          <h6>Links</h6>
          <ul class="footer-links">
            <li><a href="index.html">Home</a></li>
            <li><a href="team.html">Post</a></li>
            <li><a href="#">Popular</a></li>
            <li><a href="rooster.html">Profile</a></li>
          </ul>
        </div>
      </div>
      <hr>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-sm-6 col-xs-12">
          <p class="copyright-text">Copyright &copy; 2021 All Rights Reserved by 
       <a href="#">Buckle-up</a>.
          </p>
        </div>
      </div>
    </div>
</footer>


<!-- Back to top button -->
<a id="button"></a>
<script>
    var btn = $('#button');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});
</script>