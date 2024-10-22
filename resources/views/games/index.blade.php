<x-app-layout>
    <div class="container px-4 mx-auto"> <!--Container -->
        <h2 class="font-semibold text-blue-500 uppercase trackinkg-wide">
            Popular Games
        </h2>

        <livewire:popular-games />

        <div class="flex flex-col my-10 lg:flex-row">
            <livewire:recently-reviewed />

            <div class="mt-12 lg:w-1/4 lg:mt-0">
                <h2 class="font-semibold text-blue-500 uppercase trackinkg-wide">
                    Most Anticipated
                </h2>

               <livewire:most-anticipated />

                <h2 class="mt-6 font-semibold text-blue-500 uppercase trackinkg-wide">
                    Coming Soon
                </h2>

                <livewire:coming-soon />
            </div>
        </div><!-- End Container -->
    </div>
</x-app-layout>
