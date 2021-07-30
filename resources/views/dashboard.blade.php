<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <section class="text-gray-600 body-font">


                    <div class="container px-16 py-16 mx-auto flex flex-wrap">
                        <div class="grid grid-cols-3">
                            <div class="max-w-sm overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800 col-span-1 px-4">
                                <img class="object-cover object-center w-full h-56" src="{{ Auth::user()->profile_photo_url }}" alt="avatar">

                                <div class="px-6 py-4">
                                    <h1 class="text-xl font-semibold text-gray-800 dark:text-white">
                                        {{ Auth::user()->name }}
                                        @if (Auth::user() && Auth::user()->Role == 'Creator')
                                            ({{ Auth::user()->Role }})
                                            @endif
                                    </h1>
                                    <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                        <i class="fas fa-user text-blue-900" style="font-size: 30px"></i>
                                        <h1 class="px-2 text-sm">{{ Auth::user()->username }}</h1>
                                    </div>

                                    <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                        <i class="fas fa-calendar-day text-blue-900" style="font-size: 30px"></i>
                                        <h1 class="px-2 text-sm">{{ Auth::user()->dob }}</h1>
                                    </div>

                                    <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                                         <i class="fas fa-envelope text-blue-900" style="font-size: 30px"></i>
                                        <h1 class="px-2 text-sm">{{ Auth::user()->email }}</h1>
                                    </div>
                                </div>
                            </div>
                            @if (Auth::user() && Auth::user()->Role == 'Creator')
                            <div class="flex flex-wrap col-span-2">
                                <div class="px-8  md:w-full">
                                    <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8 sm:flex-row flex-col">
                                        <div class="w-16 h-16 sm:mr-8 sm:mb-0 mb-4 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0">
                                            <i class="fas fa-book text-blue-900" style="font-size: 30px"></i>
                                        </div>
                                        <div class="flex-grow">
                                            <h2 class="text-gray-900 text-lg title-font font-medium mb-3">View Courses</h2>
                                            <h3 class="leading-relaxed text-base">View and add video lessons to courses!</h3>
                                            <a href="{{url('courses')}}" class="mt-3 text-blue-500 inline-flex items-center">View All Courses
                                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-8 md:w-full ">
                                    <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8 sm:flex-row flex-col">
                                        <div class="w-16 h-16 sm:mr-8 sm:mb-0 mb-4 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0">
                                            <i class="fas fa-plus-circle text-blue-900" style="font-size: 30px"></i>
                                        </div>
                                        <div class="flex-grow">
                                            <h2 class="text-gray-900 text-lg title-font font-medium mb-3">Create New Course</h2>
                                            <a href="{{route('courses.create')}}" class="mt-3 text-indigo-500 inline-flex items-center">New Course
                                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="flex flex-wrap col-span-2">
                                <div class="px-8  md:w-full">
                                    <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8 sm:flex-row flex-col">
                                        <div class="w-16 h-16 sm:mr-8 sm:mb-0 mb-4 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0">
                                            <i class="fas fa-book text-blue-900" style="font-size: 30px"></i>
                                        </div>
                                        <div class="flex-grow">
                                            <h2 class="text-gray-900 text-lg title-font font-medium mb-2">My Courses</h2>
                                            <a href="{{url('courses')}}" class="mt-3 text-blue-500 inline-flex items-center">View My Courses
                                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-8 md:w-full ">
                                    <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8 sm:flex-row flex-col">
                                        <div class="w-16 h-16 sm:mr-8 sm:mb-0 mb-4 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0">
                                            <i class="fas fa-plus text-blue-900" style="font-size: 30px"></i>
                                        </div>
                                        <div class="flex-grow">
                                            <h2 class="text-gray-900 text-lg title-font font-medium mb-3">Find Courses</h2>
                                            <p class="leading-relaxed text-base">Search for a new course to Start! Expand your Bass knowledge today!</p>
                                            <a class="mt-3 text-indigo-500 inline-flex items-center">Find New Courses
                                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                @endif
                        </div>


                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
