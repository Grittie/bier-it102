<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <h1 class=" text-2xl font-medium text-gray-900">
        Welcome to the Beertracker
    </h1>
    <p class="mt-4 text-gray-500 text-sm leading-relaxed">
        Beertracker is your one-stop shop for checking out who has been contributing to the great cause of beer.
    </p>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
    <div>
        <div class="flex items-center">
            💦
            <h2 class="ml-3 text-xl font-semibold text-gray-900">
                <a>Liters bier gedronken</a>
            </h2>
        </div>
        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            Since 02/09/24 a total of {{ App\Models\Score::getTotalPitchers() }} pitchers have been drunk, resulting in {{ App\Models\Score::getTotalLiter() }} liters of beer having been consumed! 🥴
        </p>
    </div>

    <div>
        <div class="flex items-center">
            💸
            <h2 class="ml-3 text-xl font-semibold text-gray-900">
                <a>Euries besteed</a>
            </h2>
        </div>
        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            Since 02/09/24 a total of {{ App\Models\Score::getTotalPitchers() }} pitchers have been drunk, resulting in €{{ App\Models\Score::getTotalPrice() }},- having been spent on pitchers! 🥴
        </p>
    </div>
</div>
