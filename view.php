<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="view.css">
<title><?php echo basename(getcwd()); ?></title>
</head>

<script>

function on(arg) {
  document.getElementById("list").style.display = "none";
  document.getElementById("overlay").style.display = "flex";
  document.getElementById("image").src = arg;
  window.asScrollHash = arg;
}
function off() {
  document.getElementById("overlay").style.display = "none";
  document.getElementById("list").style.display = "block";
  document.getElementById("image").src = '';
  document.getElementById(window.asScrollHash).scrollIntoView();;
}
</script>

<body>
<h2><?php echo basename(getcwd());?></h2>
<div id="overlay" class="overlay" onclick="off()"><img id="image" class="large"></div>
<div class="list" width="100%">
    <ul id="list">
<?php
      foreach (glob("*.jpg") as $f) {
          echo "<li class=\"image\" id=\"" . $f . "\" onclick=\"on('" . $f . "')\">\n";
          echo "  <img class=\"content-image\" src=\"thumbs/" . $f . "\">\n";
          echo "</li>\n";
      }
?>
    </ul>
</div>
</body>
</html>

