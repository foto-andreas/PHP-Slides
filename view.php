<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="view.css">
<title><?php echo basename(getcwd()); ?></title>
</head>

<script>

var cur = "";
var prev = [];
var next = [];

function on(arg) {
  setTimeout(() => {
    document.getElementById("list").style.display = "none";
    document.getElementById("overlay").style.display = "flex";
    document.getElementById("image").src = arg;
    window.asScrollHash = arg;
    cur = arg;
  });
}

function onNext() {
  if (next[cur] !== "") {
    on(next[cur]);
  }
}

function onPrev() {
  if (prev[cur] !== "") {
    on(prev[cur]);
  }
}

function off() {
  document.getElementById("overlay").style.display = "none";
  document.getElementById("list").style.display = "block";
  document.getElementById("image").src = '';
  document.getElementById(window.asScrollHash).scrollIntoView();;
  cur = "";
}

function setPrev(a, b) {
  prev[a] = b;
}
function setNext(a, b) {
  next[a] = b;
}

</script>

<body>
<h2><?php echo basename(getcwd());?></h2>
<div id="overlay" class="overlay">
  <div class="center">
    <div onclick="onPrev()" class="pfeil pfeilLinks"></div>
  </div>
  <img onclick="off()" id="image" class="large">
  <div class="center">
    <div onclick="onNext()" class="pfeil pfeilRechts"></div>
  </div>
</div>
<div class="list" width="100%">
    <ul id="list">
<?php
      $images = [];
      $last = "";
      $i = 0;
      foreach (glob("*.jpg") as $f) {
        $images[$i++] = $f;
        echo "<script>setPrev('" . $f . "','" . $last . "');</script>\n";
        echo "<script>setNext('" . $last . "','" . $f . "');</script>\n";
        $last = $f;
      }
      echo "<script>setNext('" . $last . "','');</script>\n";
      foreach ($images as $f) {
          echo "<li class=\"image\" id=\"" . $f . "\" onclick=\"on('" . $f . "')\">\n";
          echo "  <img class=\"content-image\" src=\"thumbs/" . $f . "\">\n";
          echo "</li>\n";
      }
?>
    </ul>
</div>
</body>
</html>

