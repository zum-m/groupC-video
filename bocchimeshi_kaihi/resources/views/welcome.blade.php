
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SkyWay - Room example</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <script src="https://cdn.webrtc.ecl.ntt.com/skyway-4.4.1.js"></script>
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
  </head>
  <body>
    <div class="container" align="center">
      <div class="Headline">
        <!-- <h1>ぼっち飯回避</h1> -->
        <img src="{{ asset('/img/ぼっち飯回避.jpg') }}"/>
      </div>  
      <div class="room">
        <video id="js-local-stream" autoplay loop  height="360"></video>
      </div>
      <div >
        <button id="js-join-trigger">
          Join
        </button>
      </div>
      <p class="meta" id="js-meta"></p>
    </div>
    <script src="{{ asset('/js/script.js') }}"></script>
  </body>
</html>

<!-- <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SkyWay - Room example</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <script src="https://cdn.webrtc.ecl.ntt.com/skyway-4.4.1.js"></script>
  </head>
  <body>
    <div class="container">
      <h1 class="heading">Room example</h1>
      <div class="room">
        <div>
          <video id="js-local-stream"></video>
          <button id="js-join-trigger">Join</button>
        </div>
        <div class="remote-streams" id="js-remote-streams"></div>
      </div>
      <p class="meta" id="js-meta"></p>
    </div>
    <script src="{{ asset('/js/script.js') }}"></script>
  </body>
</html> -->
