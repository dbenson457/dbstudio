<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (Auth::user() && Auth::user()->Role == 'Creator')
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center">{{ __('Courses') }}</li>
                </ol>
            @else
                {{ __('My Courses') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg bg-blue-400">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="grid grid-cols-5">
                    <div
                        class="flex flex-col w-64 h-100 px-4 py-8 bg-white border-r dark:bg-gray-800 dark:border-gray-600 col-span-1">
                        @if (Auth::user() && Auth::user()->Role == 'Creator')

                            <a href="{{route('courses.create')}}"
                               class="flex items-center px-2 py-2 my-3 font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-900 rounded-md dark:bg-gray-800 hover:bg-blue-700 dark:hover:bg-gray-700 focus:outline-none focus:bg-blue-500 dark:focus:bg-gray-700">
                                <i class="fas fa-plus text-white" style="font-size: 20px"></i>
                                <span class="mx-1">Add New Course</span>
                            </a>


                            <div class="flex flex-col justify-between flex-1 mt-6">
                                <nav>
                                    <a class="
                                            @if($filter == 'all')
                                        bg-gray-300
                                        @endif
                                        flex items-center px-4 py-2 text-gray-700 transition-colors duration-200 transform rounded-md dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-gray-200 hover:text-gray-700"
                                       href="{{url('courses/filter', 'all')}}">

                                        <span class="mx-4 font-medium">View All</span>
                                    </a>

                                    <a class="
                                        @if($filter == 'Beginner')
                                        bg-gray-300
                                        @endif
                                        flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-200 transform rounded-md dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-gray-200 hover:text-gray-700"
                                       href="{{url('courses/filter', 'Beginner')}}">
                                        <span class="mx-4 font-medium">Beginner</span>
                                    </a>

                                    <a class="
                                        @if($filter == 'Intermediate')
                                        bg-gray-300
                                        @endif
                                        flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-200 transform rounded-md dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-gray-200 hover:text-gray-700"
                                       href="{{url('courses/filter', 'Intermediate')}}">
                                        <span class="mx-4 font-medium">Intermediate</span>
                                    </a>

                                    <a class="
                                        @if($filter == 'Expert')
                                        bg-gray-300
                                        @endif
                                        flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-200 transform rounded-md dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-gray-200 hover:text-gray-700"
                                       href="{{url('courses/filter', 'Expert')}}">
                                        <span class="mx-4 font-medium">Expert</span>
                                    </a>

                                </nav>
                            </div>
                        @else
                            <div class="flex flex-col justify-between flex-1 mt-6">
                                <nav>
                                    <a class="
                                            @if($filter == 'all')
                                        bg-gray-300
@endif
                                        flex items-center px-4 py-2 text-gray-700 transition-colors duration-200 transform rounded-md dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-gray-200 hover:text-gray-700"
                                       href="{{url('courses/filter', 'all')}}">

                                        <span class="mx-4 font-medium">View All</span>
                                    </a>

                                    <a class="
                                        @if($filter == 'Beginner')
                                        bg-gray-300
@endif
                                        flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-200 transform rounded-md dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-gray-200 hover:text-gray-700"
                                       href="{{url('courses/filter', 'Beginner')}}">
                                        <span class="mx-4 font-medium">Beginner</span>
                                    </a>

                                    <a class="
                                        @if($filter == 'Intermediate')
                                        bg-gray-300
@endif
                                        flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-200 transform rounded-md dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-gray-200 hover:text-gray-700"
                                       href="{{url('courses/filter', 'Intermediate')}}">
                                        <span class="mx-4 font-medium">Intermediate</span>
                                    </a>

                                    <a class="
                                        @if($filter == 'Expert')
                                        bg-gray-300
@endif
                                        flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-200 transform rounded-md dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-gray-200 hover:text-gray-700"
                                       href="{{url('courses/filter', 'Expert')}}">
                                        <span class="mx-4 font-medium">Expert</span>
                                    </a>

                                </nav>
                            </div>
                        @endif

                    </div>

                    <div class="flex flex-col col-span-4 px-8 py-5">
                        @if (\Session::has('message'))

                            <div class="alert alert-success py-3 text-white">
                                <h2>{{ \Session::get('message') }}</h2>
                            </div><br/>
                        @endif
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
                                            <h3 class="tracking-widest text-indigo-500 text-xs font-medium title-font">
                                                {{$course['difficulty']}}</h3>
                                            <h2 class="text-lg text-gray-900 font-medium title-font mb-4">{{$course['name']}}</h2>
                                            <p class="leading-relaxed text-base">{{substr($course['description'], 0,  90). '...'}}</p>
                                            @if (Auth::user() && Auth::user()->Role == 'Creator')
                                                <div class="flex flex-row">
                                                    <a href="{{route('courses.show', $course['id'])}}"
                                                       class=" inline-block bg-green-600 text-white text-sm font-semibold rounded-md px-3 py-2 hover:bg-green-700 mr-2">
                                                        Edit
                                                    </a>

                                                    <form action="{{route('courses.destroy', $course['id'])}}"
                                                          method="post"> @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="submit"
                                                                class=" inline-block bg-red-700 text-white text-sm font-semibold rounded-md px-3 py-2 hover:bg-red-800">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                @if($course['completed'] == true)
                                                <div class="flex flex-row mt-3">
                                                        <p class="text-green-600 m-1 mt-2">Course Completed!</p>
                                                </div>
                                            @endif
                                            <div class="flex flex-row mt-3">
                                                <a href="{{route('courses.show',$course['id'])}}"
                                                   class=" inline-block bg-green-600 text-white text-sm font-semibold rounded-md px-3 py-2 hover:bg-green-700 mr-2">
                                                    Open </span>
                                                </a>
                                                <form class="delete"
                                                      action="{{route('userCourses.destroy', $course['id'])}}"
                                                      method="post"> @csrf
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit" value="Delete"
                                                            class=" inline-block bg-red-700 text-white text-sm font-semibold rounded-md px-3 py-2 hover:bg-red-800">
                                                        Un-enroll </span>
                                                    </button>
                                                </form>

                                            </div>


                                        @endif

                                    </div>

                            </div>
                            @endforeach
                        @else
                        <!-- shows if no courses have been enrolled/created -->
                            @if (Auth::user() && Auth::user()->Role == 'Creator')
                                <div class="flex flex-row mt-3">No Courses Available</div>
                                <div class="flex flex-row mt-3">
                                    <a href="{{ route('courses.create') }}"
                                       class=" inline-block bg-green-600 text-white text-sm font-semibold rounded-md px-3 py-2 hover:bg-green-700 mr-2">
                                        Create course </span>
                                    </a>
                                </div>
                            @else
                                <div class="flex flex-row mt-3">No courses enrolled</div>
                                <div class="flex flex-row mt-3">
                                    <a href="{{ url('search') }}"
                                       class=" inline-block bg-green-600 text-white text-sm font-semibold rounded-md px-3 py-2 hover:bg-green-700 mr-2">
                                        Find a Course! </span>
                                    </a>
                                    @endif

                                    @endif
                                </div>
                                </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


</x-app-layout>


