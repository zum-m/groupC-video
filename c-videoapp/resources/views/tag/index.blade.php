<head>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="{{ asset('css/tag.css') }}">
</head>
<body>
    <!-- jqueryの読み込み -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <!-- BootstrapのJS読み込み -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
    <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('タグ一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
            <table class="text-center w-full border-collapse">
                <thead>
                <tr>
                    <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-lg text-grey-dark border-b border-grey-light">タグ一覧</th>
                </tr>
                </thead>
                <tbody>
                　@foreach($tags as $tag)
                        <!-- <span class="badge badge-pill badge-info">{{$tag->name}}</span> -->
                        <span class="tag">{{$tag->name}}</span>

                @endforeach
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
    </x-app-layout>
</body>
