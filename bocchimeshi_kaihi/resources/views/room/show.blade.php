<head>
    <script src="https://cdn.webrtc.ecl.ntt.com/skyway-4.4.1.js"></script> 
</head>
<body>
     <script src="{{ asset('/js/sample.js') }}"></script> 
      <div class="container" align="center">
        <div class="room">
          <video id="js-local-stream" autoplay loop  height="360"></video>
        </div>
        <div class="remote-streams" id="js-remote-streams"></div>
        <p>{{$id}}</p>
        <div>
            <input type="hidden" id="js-room-id" value="{{$id}}">
            <button id="js-join-trigger" class=btn onclick="disabled = true;">
              開始
            </button>
            
            <form action="{{ url('/dashboard') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{Auth::user()->id}}" />
                <input type="hidden" name="room_status" value=0 />
                <button id="js-leave-trigger">退室</button>
              </form>
        </div>
      </div>
      <p class="meta" id="js-meta"></p>
    </div>
    <script src="{{ asset('/js/script.js') }}"></script> 
   
</body>