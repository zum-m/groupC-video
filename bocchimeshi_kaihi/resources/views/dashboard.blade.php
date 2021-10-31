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
          <div class="room">
            <video id="js-local-stream" autoplay loop  height="360"></video>
          </div>
          <div>
            <h3>身だしなみは整いましたか？</h3>
            <form class="mb-6" action="{{ route('room.update',Auth::user()->id) }}" method="POST">
              @method('put')
              @csrf
              <div class="flex flex-col mb-4">
                <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="room_name">ルーム名</label>
                <input class="border py-2 px-3 text-grey-darkest" type="text" name="room_name" id="room_name" value="{{Auth::user()->room_name}}">
              </div>
              <div class="flex justify-evenly">
                <button type="submit" class="w-5/12 py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                  変更
                </button>
              </div>
            </form>
            </p>
            <form action="{{ url('/join')}}" method="POST">
              @csrf
              <input type="hidden" name="id" value="{{Auth::user()->id}}" />
              <input type="hidden" name="room_status" value=1 />
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