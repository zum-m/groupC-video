<head>
  <link rel="stylesheet" href="{{ asset('css/tag.css') }}">
</head>
<body>
  <x-app-layout>
      <x-slot name="header">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              {{ __('My Room') }}
          </h2>
      </x-slot>

      <script src="{{ asset('/js/sample.js') }}"></script> 
        <div class="container" align="center">
          <!-- <div class="Headline">
            <img src="{{ asset('/img/ぼっち飯回避.jpg') }}"/>
          </div>   -->
          <div class="room">
            <video id="js-local-stream" autoplay loop  height="360"></video>
          </div>
          <!-- <div class="remote-streams" id="js-remote-streams"></div> -->
          <div>
            <h3>身だしなみは整いましたか？</h3>
            <p>ルーム名：{{ Auth::user()->room_name }}(ここにルーム名編集のボタン)</p>
            <form action="{{ url('/join')}}" method="POST">
              @csrf
              <input type="hidden" name="id" value="{{Auth::user()->id}}" />
              <input type="submit" name="submit" value="入室！" class=btn/>
            </form>
          </div>
          <x-nav-link :href="route('room.index')" :active="request()->routeIs('room.index')">
          ルームを探す！
          </x-nav-link>
          </div>
        </div>
        <p class="meta" id="js-meta"></p>
      </div>
      <script src="{{ asset('/js/script.js') }}"></script>
    
  </x-app-layout>
</body>