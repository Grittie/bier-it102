<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <h1 class=" text-2xl font-medium text-gray-900">
        Welcome to Beertracker
    </h1>
    <p class="mt-4 text-gray-500 text-sm leading-relaxed">
        Beertracker is your go-to site for tracking the amount of beer everyone is pitching 😉 in for, without the hassle of tikkies 🍻
    </p>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
    <div>
        <div class="flex items-center">
            💦
            <h2 class="ml-3 text-xl font-semibold text-gray-900">
                <a>All time liters beer consumed</a>
            </h2>
        </div>
        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            A total of {{ App\Models\Score::getTotalPitchers() }} pitchers have been drunk, resulting in {{ App\Models\Score::getTotalLiter() }} liters of beer having been consumed! 🥴
        </p>
    </div>

    <div>
        <div class="flex items-center">
            💸
            <h2 class="ml-3 text-xl font-semibold text-gray-900">
                <a>All time money spent </a>
            </h2>
        </div>
        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            A total of {{ App\Models\Score::getTotalPitchers() }} pitchers have been drunk, resulting in €{{ App\Models\Score::getTotalPrice() }},- having been spent on pitchers! 🥴
        </p>
    </div>

    <div>
    <div class="flex items-center">
        📊
        <h2 class="ml-3 text-xl font-semibold text-gray-900">
            <a>Yearly stats </a>
        </h2>
    </div>
    <p class="mt-4 text-gray-500 text-sm leading-relaxed">
        Year 1: {{ DB::table('scoresy1')->sum('pitchers') }} pitchers, 
        {{ DB::table('scoresy1')->sum('pitchers') * 1.8 }} liters, 
        €{{ DB::table('scoresy1')->sum('pitchers') * 14 }},- <br>

        Year 2: {{ DB::table('scoresy2')->sum('pitchers') }} pitchers, 
        {{ DB::table('scoresy2')->sum('pitchers') * 1.8 }} liters, 
        €{{ DB::table('scoresy2')->sum('pitchers') * 14 }},- <br>

        Current Year: {{ DB::table('scores')->sum('pitchers') }} pitchers, 
        {{ DB::table('scores')->sum('pitchers') * 1.8 }} liters, 
        €{{ DB::table('scores')->sum('pitchers') * 14 }},-
    </p>
    </div>

    <div>
    <div class="flex items-center">
        🏆
        <h2 class="ml-3 text-xl font-semibold text-gray-900">
            <a>All-Time Top 3 Users</a>
        </h2>
    </div>
    <p class="mt-4 text-gray-500 text-sm leading-relaxed">
        @php
            $topUsers = collect([
                DB::table('scores')
                    ->join('users', 'scores.user_id', '=', 'users.id')
                    ->select('users.name', DB::raw('SUM(scores.pitchers) as total_pitchers'))
                    ->groupBy('users.id', 'users.name')
                    ->get(),
                DB::table('scoresy1')
                    ->join('users', 'scoresy1.user_id', '=', 'users.id')
                    ->select('users.name', DB::raw('SUM(scoresy1.pitchers) as total_pitchers'))
                    ->groupBy('users.id', 'users.name')
                    ->get(),
                DB::table('scoresy2')
                    ->join('users', 'scoresy2.user_id', '=', 'users.id')
                    ->select('users.name', DB::raw('SUM(scoresy2.pitchers) as total_pitchers'))
                    ->groupBy('users.id', 'users.name')
                    ->get(),
            ])
            ->flatten()
            ->groupBy('name')
            ->map(function ($group) {
                return $group->sum('total_pitchers');
            })
            ->sortDesc()
            ->take(3);
        @endphp

        @foreach ($topUsers as $name => $totalPitchers)
            {{ $loop->iteration }}. {{ $name }}: {{ $totalPitchers }} pitchers <br>
        @endforeach
    </p>
</div>

</div>

</div>