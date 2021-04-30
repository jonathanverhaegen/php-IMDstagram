<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style/header.css">
</head>

<script
src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script>
$(function() {
$(".toggle").on("click", function() {
    if ($(".item").hasClass("active")) {
        $(".item").removeClass("active");
    } else {
        $(".item").addClass("active");
    }
});
});
</script>

<body>
  <div class="buckle-main">
      <!-- Header -->
      <header>
          <div class="container">
              <nav>
                  <div class="logo">
                      <a href="#"><img src="img/Favicon.png" alt="logo"></a>
                  </div>
                  <!-- toggle bar -->
                  <div class="toggle-bar" type="button">
                      <span></span>
                      <span></span>
                      <span></span>
                  </div>
                  <div class="navigation-bar">
                      <ul>
                          <li><a href="index.html">Home</a></li>
                          <li><a href="team.html">Zoeken</a></li>
                          <li><a href="#">Profiel</a></li>
                          <li class="discord-btn"><a href="uploadpost.php">Upload</a></li>
                      </ul>
                  </div>
              </nav>
          </div>
      </header>

      <script>
        $('toggle-bar').on('click', function (event) {
            $('this').toggleClass('open');
            $('.navigation-bar').slideToggle('200');
        })
      </script>