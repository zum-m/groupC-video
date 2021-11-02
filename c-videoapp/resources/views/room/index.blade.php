<head>
    <link rel="stylesheet" href="{{ asset('css/tag.css') }}">
</head>
<body>
    <x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('ルーム一覧') }}
      </h2>
    </x-slot>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <table class="text-center w-full border-collapse">
              <thead>
                <tr>
                  <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-lg text-grey-dark border-b border-grey-light">ルーム一覧</th>
                </tr>
              </thead>

              <tbody>
                
                @foreach (array_map(NULL, $rooms, $commons_tags, $owners_tags, $owners_id) as [$room, $common_tags, $owner_tags, $owner_id])
                  <tr class="hover:bg-grey-lighter">
                    <td class="py-4 px-6 border-b border-grey-light">
                      <h3 class="text-left font-bold text-lg text-grey-dark">{{$room}}</h3>
                    <div class="flex tag-list">
                      <p>ルーム所有者のタグ:<p>
                      @foreach ($owner_tags as $owner_tag)
                        @if(in_array($owner_tag, $common_tags))
                          <span class="common_tag">#{{$owner_tag}}</span>
                        @else
                          <span class="tag">#{{$owner_tag}}</span>
                        @endif
                      @endforeach
                    </div>
                    <form action="{{ url('/join')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$owner_id}}" />
                        <input type="submit" name="submit" value="入室！" class=btn/>
                      </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </x-app-layout>
</body>