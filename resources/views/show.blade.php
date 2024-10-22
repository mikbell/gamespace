<x-app-layout>
    <div class="container px-4 mx-auto"> <!--Container -->
        <div class="flex flex-col pb-12 border-b border-gray-800 lg:flex-row"> <!-- Game Details -->
            <div class="flex-none bg-gray-600 w-60 h-96">
            </div>
            <div class="ml-0 lg:ml-12">
                <h2 class="text-4xl font-semibold leading-tight">Game Title</h2>
                <div>
                    <span>Genre, Genre</span>
                    &middot;
                    <span>Publisher</span>
                    &middot;
                    <span>Console</span>
                </div>

                <div class="flex flex-wrap items-center mt-8">
                    <div class="flex items-center">
                        <div class="w-16 h-16 bg-gray-800 rounded-full">
                            <div class="flex items-center justify-center h-full text-xs font-semibold">80%</div>
                        </div>
                        <div class="ml-4 text-xs">
                            Member <br> score
                        </div>

                        <div class="w-16 h-16 ml-12 bg-gray-800 rounded-full">
                            <div class="flex items-center justify-center h-full text-xs font-semibold">80%</div>
                        </div>

                        <div class="ml-4 text-xs">
                            Critic <br> score
                        </div>
                    </div>

                    <div class="flex gap-4 mt-4 lg:mt-0 lg:ml-12">
                        <div class="flex items-center justify-center bg-gray-800 rounded-full">
                            <a href="#" class="hover:text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-globe">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20" />
                                    <path d="M2 12h20" />
                                </svg>
                            </a>
                        </div>

                        <div class="flex items-center justify-center bg-gray-800 rounded-full">
                            <a href="#" class="hover:text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram">
                                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5" />
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                    <line x1="17.5" x2="17.51" y1="6.5" y2="6.5" />
                                </svg>
                            </a>
                        </div>

                        <div class="flex items-center justify-center bg-gray-800 rounded-full">

                            <a href="#" class="hover:text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-twitter">
                                    <path
                                        d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z" />
                                </svg>
                            </a>
                        </div>

                        <div class="flex items-center justify-center bg-gray-800 rounded-full">
                            <a href="#" class="hover:text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <p class="max-w-3xl mt-6 text-gray-400">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem,
                    et doloremque! Quia ut
                    maiores doloremque, deserunt consectetur temporibus illum sed laborum ea minus, saepe nesciunt,
                    praesentium maxime. Debitis placeat nisi, similique praesentium omnis libero beatae! Illum veniam
                    nobis odit veritatis perspiciatis ratione maiores. Magni quod enim, eum sapiente aliquid assumenda?
                </p>

                <div class="mt-12">
                    <button
                        class="flex p-4 font-semibold text-white transition duration-150 ease-in-out bg-blue-500 rounded hover:bg-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-play">
                            <polygon points="6 3 20 12 6 21 6 3" />
                        </svg>
                        <span class="ml-2">
                            Play Trailer
                        </span>
                    </button>
                </div>
            </div>
        </div><!-- End Game Details -->

        <div class="pb-12 mt-8 border-b border-gray-800"> <!-- Game Images -->
            <h2 class="font-semibold text-blue-500 uppercase trackinkg-wide">
                Images
            </h2>

            <div class="grid grid-cols-1 gap-12 mt-8 md:grid-cols-2 lg:grid-cols-3">
                <div class="w-full h-64 transition duration-150 ease-in-out bg-gray-600 hover:opacity-75"></div>
                <div class="w-full h-64 transition duration-150 ease-in-out bg-gray-600 hover:opacity-75"></div>
                <div class="w-full h-64 transition duration-150 ease-in-out bg-gray-600 hover:opacity-75"></div>
                <div class="w-full h-64 transition duration-150 ease-in-out bg-gray-600 hover:opacity-75"></div>
                <div class="w-full h-64 transition duration-150 ease-in-out bg-gray-600 hover:opacity-75"></div>
                <div class="w-full h-64 transition duration-150 ease-in-out bg-gray-600 hover:opacity-75"></div>
            </div>
        </div> <!-- End Game Images -->


        <div class="pb-12 mt-8"> <!-- Similar Games -->
            <h2 class="font-semibold text-blue-500 uppercase trackinkg-wide">
                Similar Games
            </h2>

            <div class="grid grid-cols-1 gap-12 text-sm md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6">
                <div class="mt-8">
                    <div class="relative inline-block">
                        <a href="#">
                            <div class="w-48 transition duration-150 ease-in-out bg-gray-600 h-72 hover:opacity-75">
                            </div>
                        </a>

                        <div class="absolute bottom-0 right-0 w-16 h-16 -mb-5 -mr-5 bg-gray-800 rounded-full">
                            <div class="flex items-center justify-center h-full text-xs font-semibold">80%</div>
                        </div>
                    </div>

                    <a href="#"
                        class="block mt-8 text-base font-semibold leading-tight hover:text-gray-400">Game
                        Title</a>
                    <div class="mt-1 text-gray-400">Playstation 4</div>
                </div>

                <div class="mt-8">
                    <div class="relative inline-block">
                        <a href="#">
                            <div class="w-48 transition duration-150 ease-in-out bg-gray-600 h-72 hover:opacity-75">
                            </div>
                        </a>

                        <div class="absolute bottom-0 right-0 w-16 h-16 -mb-5 -mr-5 bg-gray-800 rounded-full">
                            <div class="flex items-center justify-center h-full text-xs font-semibold">80%</div>
                        </div>
                    </div>

                    <a href="#"
                        class="block mt-8 text-base font-semibold leading-tight hover:text-gray-400">Game
                        Title</a>
                    <div class="mt-1 text-gray-400">Playstation 4</div>
                </div>

                <div class="mt-8">
                    <div class="relative inline-block">
                        <a href="#">
                            <div class="w-48 transition duration-150 ease-in-out bg-gray-600 h-72 hover:opacity-75">
                            </div>
                        </a>

                        <div class="absolute bottom-0 right-0 w-16 h-16 -mb-5 -mr-5 bg-gray-800 rounded-full">
                            <div class="flex items-center justify-center h-full text-xs font-semibold">80%</div>
                        </div>
                    </div>

                    <a href="#"
                        class="block mt-8 text-base font-semibold leading-tight hover:text-gray-400">Game
                        Title</a>
                    <div class="mt-1 text-gray-400">Playstation 4</div>
                </div>

                <div class="mt-8">
                    <div class="relative inline-block">
                        <a href="#">
                            <div class="w-48 transition duration-150 ease-in-out bg-gray-600 h-72 hover:opacity-75">
                            </div>
                        </a>

                        <div class="absolute bottom-0 right-0 w-16 h-16 -mb-5 -mr-5 bg-gray-800 rounded-full">
                            <div class="flex items-center justify-center h-full text-xs font-semibold">80%</div>
                        </div>
                    </div>

                    <a href="#"
                        class="block mt-8 text-base font-semibold leading-tight hover:text-gray-400">Game
                        Title</a>
                    <div class="mt-1 text-gray-400">Playstation 4</div>
                </div>

                <div class="mt-8">
                    <div class="relative inline-block">
                        <a href="#">
                            <div class="w-48 transition duration-150 ease-in-out bg-gray-600 h-72 hover:opacity-75">
                            </div>
                        </a>

                        <div class="absolute bottom-0 right-0 w-16 h-16 -mb-5 -mr-5 bg-gray-800 rounded-full">
                            <div class="flex items-center justify-center h-full text-xs font-semibold">80%</div>
                        </div>
                    </div>

                    <a href="#"
                        class="block mt-8 text-base font-semibold leading-tight hover:text-gray-400">Game
                        Title</a>
                    <div class="mt-1 text-gray-400">Playstation 4</div>
                </div>

                <div class="mt-8">
                    <div class="relative inline-block">
                        <a href="#">
                            <div class="w-48 transition duration-150 ease-in-out bg-gray-600 h-72 hover:opacity-75">
                            </div>
                        </a>

                        <div class="absolute bottom-0 right-0 w-16 h-16 -mb-5 -mr-5 bg-gray-800 rounded-full">
                            <div class="flex items-center justify-center h-full text-xs font-semibold">80%</div>
                        </div>
                    </div>

                    <a href="#"
                        class="block mt-8 text-base font-semibold leading-tight hover:text-gray-400">Game
                        Title</a>
                    <div class="mt-1 text-gray-400">Playstation 4</div>
                </div>
            </div>
        </div> <!-- End Container -->
</x-app-layout>
