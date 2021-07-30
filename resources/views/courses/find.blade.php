<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Search Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg  bg-blue-400">
                <div class="grid grid-cols-5">
                    <div
                        class="flex flex-col w-64 h-100 px-4 py-8 bg-white border-r dark:bg-gray-800 dark:border-gray-600 col-span-1">

                        <div class="flex flex-col justify-between flex-1 mt-6">
                            <nav>
                                <a class="
                                @if($filter == 'all')
                                    bg-gray-300
                                @endif
                                flex items-center px-4 py-2 text-gray-700 rounded-md dark:bg-gray-700 dark:text-gray-200"
                                   href="{{url('search/find', 'all')}}">
                                    <span class="mx-4 font-medium">View All</span>
                                </a>

                                <a class="
                                @if($filter == 'Beginner')
                                    bg-gray-300
                                    @endif
                                    flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-200 transform rounded-md dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-gray-200 hover:text-gray-700"
                                   href="{{url('search/find', 'Beginner')}}">
                                    <span class="mx-4 font-medium">Beginner</span>
                                </a>

                                <a class="
                                @if($filter == 'Intermediate')
                                    bg-gray-300
                                    @endif
                                    flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-200 transform rounded-md dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-gray-200 hover:text-gray-700"
                                   href="{{url('search/find', 'Intermediate')}}">
                                    <span class="mx-4 font-medium">Intermediate</span>
                                </a>

                                <a class="
                                @if($filter == 'Expert')
                                    bg-gray-300
                                    @endif
                                    flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-200 transform rounded-md dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-gray-200 hover:text-gray-700"
                                   href="{{url('search/find', 'Expert')}}">
                                    <span class="mx-4 font-medium">Expert</span>
                                </a>
                            </nav>
                        </div>

                    </div>

                    <div class="flex flex-col col-span-4 px-8 py-5">
                        @if (\Session::has('message'))
                            <div class="alert alert-success py-3 text-red-600">
                                <h2>{{ \Session::get('message') }}</h2>
                            </div><br /> @endif
                            @if($courses != null)
                        <div class="py-3">
                            {{ $courses->links() }}
                        </div>
                        <div class="flex flex-wrap -m-4">
                            <!-- for loop to print all available courses -->
                        @foreach($courses as $course)
                                <div class="xl:w-1/3 md:w-1/2 p-4">
                                    <div class="bg-gray-100 p-6 rounded-lg">
                                        <img class="h-40 rounded w-full object-cover object-center mb-6"
                                             src="{{ asset('storage/images/'.$course['thumbnail_url'])}}"
                                             alt="content">
                                        <h3 class="tracking-widest text-indigo-500 text-small font-medium title-font">
                                            {{$course['difficulty']}}</h3>
                                        <h2 class="text-lg text-gray-900 font-medium title-font mb-4">{{$course['name']}}</h2>
                                        <p class="leading-relaxed text-base">{{substr($course['description'], 0,  90). '...'}}</p>

                                        <div class="flex flex-row mt-3">
                                                <a href="{{url('course', $course['name'])}}"
                                                   class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    Enroll
                                                </a>
                                            </div>

                                    </div>

                                </div>
                            @endforeach
                            @else
                                <div class="flex flex-row mt-3">No Courses Available</div>
                                @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
