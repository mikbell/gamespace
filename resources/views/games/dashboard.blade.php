<x-app-layout>
    <div class="container px-4 mx-auto"> <!--Container -->
        <h1 class="mb-4 text-3xl font-semibold uppercase">
            Dashboard
        </h1>

        <a href="{{ route('games.popular-games') }}" class="flex items-center text-blue-500 group">
            <h2 class="font-semibold uppercase trackinkg-wide">
                Popular Games
            </h2>

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round"
                class="h-5 transition duration-150 ease-in-out group-hover:translate-x-2">
                <path d="m9 18 6-6-6-6" />
            </svg>
        </a>


        <livewire:popular-games />

        <div class="flex flex-col my-10 lg:flex-row">

            <livewire:recently-reviewed />

            <div class="mt-12 lg:w-1/4 lg:mt-0">
                <a href="{{ route('games.most-anticipated') }}" class="flex items-center text-blue-500 group">
                    <h2 class="font-semibold uppercase trackinkg-wide">
                        Most Anticipated
                    </h2>

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="h-5 transition duration-150 ease-in-out group-hover:translate-x-2">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                </a>
                <livewire:most-anticipated />

                <a href="{{ route('games.coming-soon') }}" class="flex items-center mt-6 text-blue-500 group">
                    <h2 class="font-semibold uppercase trackinkg-wide">
                        Coming Soon
                    </h2>

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="h-5 transition duration-150 ease-in-out group-hover:translate-x-2">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                </a>
                <livewire:coming-soon />
            </div>
        </div>
    </div><!-- End Container -->
</x-app-layout>
