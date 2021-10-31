<head>
    <link rel="stylesheet" href="{{ asset('css/tag.css') }}">
</head>
<body>
	<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
		{{ __('タグ追加') }}
		</h2>
	</x-slot>
	<div class="text-center">
		<p>あなたのタグ</p>
	　@foreach($tags as $tag)
			<span class="tag">#{{$tag}}</span>
		@endforeach
	</div>
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
		<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
			<div class="p-6 bg-white border-b border-gray-200">
			@include('common.errors')
			<form class="mb-6" action="{{ route('tag.store') }}" method="POST">
				@csrf
				<div class="flex flex-col mb-4">
				<label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="">タグ(例：#タグ1#タグ2)</label>
				<input class="border py-2 px-3 text-grey-darkest" type="text" name="tag" id="tag" value="#">
				</div>
				<button type="submit" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
				追加
				</button>
			</form>
			</div>
		</div>
		</div>
	</div>
	</x-app-layout>
</body>