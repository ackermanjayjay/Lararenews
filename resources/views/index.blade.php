<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
</head>

<body>
    {{-- Navbar --}}
    <div class="navbar bg-base-100 shadow-sm">
        <div class="flex-1">
            <a class="btn btn-ghost text-xl">Madders News</a>
        </div>
        <form class="search-form" method="GET" action="{{ url('/news/text') }}">
        <div class="flex gap-2">
            <input type="text" placeholder="Search" class="input input-bordered w-24 md:w-auto" name = "search" />
        </div>
      </form>
        <button class="btn btn-ghost btn-circle" type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </button>

    </div>
    <div class="text-center  p-5 gap-4">
        <h1 class="text-2xl font-bold">News</h1>
    </div>
    {{-- Content --}}

    <div class="mt-5 mx-5 justify-start grid grid-cols-3 gap-5">
        @if ($news->count() > 0)
            @foreach ($news as $item)
                <div class="card bg-base-80 w-75 shadow-sm">
                    <figure>
                        <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                            alt="Shoes" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">{{ $item['title'] }}</h2>
                        <p>{{$item['news_description']}}
                        </p>
                        <div class="badge badge-info">{{100 *$item['score']}} %</div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No news available.</p>
        @endif
    </div>

    </div>
</body>

</html>
