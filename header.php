<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="style/header.css" />
  </head>

  <body>
    <div class="container-header">
      <!-- desktop version -->
      <div class="inner-container desktop">
        <span class="logo left"
          ><a href="index.php"><img src="./images/buckle.png" alt=""/></a
        ></span>
        <ul class="left">
          <li class="desktop-li"><a href="index.php">Home</a></li>
          <li class="desktop-li"><a href="uploadpost.php">Post</a></li>
          <li class="desktop-li"><a href="userpage.php?user=<?php echo $id; ?>">Profile</a></li>
        </ul>

        <ul class="right">
          <li class="search-outer desktop-li">
            <div class="search-outer">
              <input action="Search.php" type="text" class="search" method="post" placeholder="Search Buckle-up" />
              <img
                src="https://assets-cdn.github.com/images/search-shortcut-hint.svg"
                class="search-hint"
                alt=""
              />
            </div>
          </li>
          <li class="desktop-li">
          <?php if( isset($_SESSION['username']) && !empty($_SESSION['username']) )
{
?>
<a class="bold" href="login.php">Sign In</a>
<?php }else{ ?>
  <a class="bold" href="logout.php">Sign Out</a>
            <?php } ?>
          </li>
        </ul>
      </div>





      <!-- mobile version -->
      <div class="inner-container mobile">
        <div class="mobile-logo"><img src="./images/buckle.png" /></div>
        <button class="svg-button">
          <svg
            height="28"
            class="octicon octicon-three-bars text-white"
            viewBox="0 0 12 16"
            version="1.1"
            width="30"
            aria-hidden="true"
          >
            <path
              fill-rule="evenodd"
              d="M11.41 9H.59C0 9 0 8.59 0 8c0-.59 0-1 .59-1H11.4c.59 0 .59.41.59 1 0 .59 0 1-.59 1h.01zm0-4H.59C0 5 0 4.59 0 4c0-.59 0-1 .59-1H11.4c.59 0 .59.41.59 1 0 .59 0 1-.59 1h.01zM.59 11H11.4c.59 0 .59.41.59 1 0 .59 0 1-.59 1H.59C0 13 0 12.59 0 12c0-.59 0-1 .59-1z"
            ></path>
          </svg>
        </button>
      </div>
    </div>
    <div class="drop-down-mobile">
      <ul class="mobile-ul">
        <li class="mobile-li"><a href="index.php">Home</a></li>
        <li class="mobile-li"><a href="uploadpost.php">Post</a></li>
        <li class="mobile-li"><a href="userpage.php?user=<?php echo $id; ?>">Profile</a></li>
        <li class="search-outer mobile-li">
          <div class="search-outer search-outer-mobile">
            <input
              type="text"
              class="search search-mobile"
              placeholder="Search Buckle-up"
            />
            <img
              src="https://assets-cdn.github.com/images/search-shortcut-hint.svg"
              class="search-hint"
              alt=""
            />
          </div>
        </li>
        <li class="mobile-li">
          <a class="bold" href="login.php">Sign In</a><br>
          <a class="bold" href="logout.php">Sign Out</a>
        </li>
      </ul>
    </div>
    <script src="main.js"></script>
  </body>
</html>

<script>
  let input = document.getElementsByClassName("search");
let searchhint = document.getElementsByClassName("search-hint");
let button = document.getElementsByClassName("svg-button");
let mobile = document.getElementsByClassName("drop-down-mobile");
let isOpen = false;

// show hide search hint
for (let i = 0; i < input.length; i++) {
  for (let i = 0; i < searchhint.length; i++) {
    input[i].addEventListener("focus", () => {
      searchhint[i].style.display = "none";
    });

    input[i].addEventListener("focusout", () => {
      searchhint[i].style.display = "block";
    });
  }
}

// show hide mobile drop down
button[0].addEventListener("click", () => {
  if (isOpen === false) {
    // mobile[0].classList.remove("hide-lg");
    mobile[0].style.height = "400px";
    isOpen = true;
  } else {
    // mobile[0].classList.add("hide-lg");
    mobile[0].style.height = "0";
    isOpen = false;
  }
});
</script>
