<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="footer.css">
</head>


<!-- Site footer -->
<footer class="site-footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-6">
          <h6>Over ons</h6>
          <p class="text-justify">Tekstje</p>
        </div>

        <div class="col-xs-6 col-md-3">
        </div>

        <div class="col-xs-6 col-md-3">
          <h6>Menu</h6>
          <ul class="footer-links">
            <li><a href="#">-</a></li>
            <li><a href="#">-</a></li>
            <li><a href="#">-</a></li>
            <li><a href="#">-</a></li>
            <li><a href="#">-</a></li>
            <li><a href="#">-</a></li>
          </ul>
        </div>
      </div>
      <hr>
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