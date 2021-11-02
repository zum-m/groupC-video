
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SkyWay - Room example</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/autojoin.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/button.css') }}">
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
  </head>
  <body>
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
      <div class="container" align="center">
        <div class="Headline">
              <img src="{{ asset('/img/ぼっち飯回避.jpg') }}"/>
        </div>  

        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <div>
                      <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">My room</a>
                    </div>
                @else
                    <div>
                      <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
                    </div>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif
      </div>
    </div>
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
