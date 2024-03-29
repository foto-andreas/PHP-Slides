<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="view.css"/>
<title><?php echo basename(getcwd()); ?></title>
</head>

<script>
var cur = "";
var prev = [];
var next = [];

document.addEventListener('keydown', (event) => {
  if (event.defaultPrevented) {
    return;
  }
  switch (event.key) {
    case 'Right':
    case 'ArrowRight':
      onNext();
      break
    case 'Left':
    case 'ArrowLeft':
      onPrev();
      break;
    case 'Esc':
    case 'Escape':
      off();
      break;
    default:
      return;
  }
  event.preventDefault();
});

var startX = null;
var startY = null;

// thanks for touch-events to https://stackoverflow.com/users/7852/givanse

document.addEventListener('touchstart', (event) => {
  if (event.defaultPrevented) {
    return;
  }
  startX = event.touches[0].clientX;
  startY = event.touches[0].clientY;
  event.preventDefault();
});

document.addEventListener('touchmove', (event) => {
  if ((!startX && !startY) || event.defaultPrevented) {
    return;
  }
  var xDiff = startX - event.touches[0].clientX;
  var yDiff = startY - event.touches[0].clientY;
  if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {
    if ( xDiff > 0 ) {
      onNext(); 
    } else {
      onPrev();
    }                       
  } else {
    if ( yDiff > 0 ) {
      /* up swipe */ 
    } else { 
      /* down swipe */
    }                                                                 
  }
  startX = null;
  startY = null;
  event.preventDefault();
});

function on(arg) {
  setTimeout(() => {
    document.getElementById("list").style.display = "none";
    document.getElementById("overlay").style.display = "flex";
    if (arg.endsWith('.mov') || arg.endsWith('.MOV') || arg.endsWith('.mp4') || arg.endsWith('.MP4')) {
      document.getElementById("video").src = arg;
      document.getElementById("video").style.display = 'flex';
      document.getElementById("image").style.display = 'none';
    } else {
      document.getElementById("image").src = arg;
      document.getElementById("image").style.display = 'flex';
      document.getElementById("video").style.display = 'none';
    }
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
  document.getElementById("video").src = '';
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

<body data-swipe-threshold="100" data-swipe-timeout="250">
<h2><?php echo basename(getcwd());?></h2>
<div id="overlay" class="overlay">
  <div class="center">
    <div onclick="onPrev()" class="pfeil pfeilLinks"></div>
  </div>
  <div class="fullwidth">
    <img onclick="off()" id="image" class="large">
    <video onclick="off()" controls="true" id="video" class="large" autoplay playsinline loop muted>
  </div>
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
      function endsWith($haystack, $needle) {
        return substr_compare($haystack, $needle, -strlen($needle)) === 0;
      }
      $files = glob("images/*.{jpg,jpeg,png,mp4,mov,JPG,JPEG,PNG,MP4,MOV}", GLOB_BRACE);
      natsort($files);
      foreach ($files as $f) {
        $images[$i++] = $f;
        echo "<script>setPrev('" . $f . "','" . $last . "');</script>\n";
        echo "<script>setNext('" . $last . "','" . $f . "');</script>\n";
        $last = $f;
      }
      echo "<script>setNext('" . $last . "','');</script>\n";
      foreach ($images as $f) {
        $extra = "";
        if (endsWith($f, ".mp4") || endsWith($f, ".MP4") || endsWith($f, ".mov") || endsWith($f, ".MOV")) {
          $extra = ".jpg";
        }
        $b = basename($f);
        echo "<li class=\"image\" id=\"" . $f . "\" onclick=\"on('" . $f . "')\">\n";
        echo "  <img loading=\"lazy\" title=\"$b\" class=\"content-image\" src=\"thumbs/" . $b . $extra . "\">\n";
        echo "</li>\n";
      }
    ?>
  </ul>
</div>
</body>
</html>
