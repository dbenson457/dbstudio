<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center text-gray-500 hover:text-black"><a
                        href="{{url('courses')}}">{{ __('Courses') }}</a></li>
                <li class="flex items-center"><i class="fas fa-chevron-right px-3 text-black"
                                                 style="font-size: 15px"></i></li>
                <li class="flex items-center text-black">{{$course['name']}}</li>
            </ol>
        </h2>
    </x-slot>

    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white overflow-hidden shadow-xl bg-blue-400 sm:rounded-lg">
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="flex flex-col">
                        <div class="-my-2 sm:-mx-6 lg:-mx-8 px-3 py-6">
                            @if (Auth::user() && Auth::user()->Role == 'User')
                                <h1 class="px-10 mb-5 text-xl">Select Video Lesson</h1>
                                @if (\Session::has('message'))
                                    <div class="alert alert-success py-3 text-black">
                                        <h2>{{ \Session::get('message') }}</h2>
                                    </div><br/>
                                @endif
                            @endif
                            <div class="flex flex-row">

                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    @if (Auth::user() && Auth::user()->Role == 'Creator')

                                        <a href="{{url('courses/'.$course['id'].'/edit')}}"
                                           class=" mb-5 ml-3 inline-block bg-green-600 text-white text-sm font-semibold rounded-md px-3 py-2 hover:bg-green-700 mr-2">
                                            <i class="fas fa-edit text-white" style="font-size: 15px"></i> Edit Course
                                            Info
                                        </a>
                                        <a href="{{url('add-video', $course['id'])}}"
                                           class=" inline-block bg-green-600 text-white text-sm font-semibold rounded-md px-3 py-2 hover:bg-green-700 mr-2">
                                            <i class="fas fa-plus text-white" style="font-size: 15px"></i> Add Video
                                            Lesson
                                        </a>
                                    @endif
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Title
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Description
                                                </th>
                                                @if (Auth::user() && Auth::user()->Role == 'User')
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Status
                                                    </th>
                                                @endif
                                                <th scope="col" class="relative px-6 py-3">
                                                    <span class="sr-only">Edit</span>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                            <!-- for loop to show all videos on a selected course -->
                                            @foreach($videos as $video)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{$video['title']}}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900" >{{substr($video['video_info'], 0,  100). '...'}}
                                                        </div>
                                                    </td>
                                                    @if (Auth::user() && Auth::user()->Role == 'User')

                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            @if($video['exercise_complete'] == true)
                                                                <span
                                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                      Completed
                                                    </span>
                                                            @else
                                                                <span
                                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-200 text-red-800">
                                                      Incomplete
                                                    </span>
                                                            @endif
                                                            @endif

                                                        </td>
                                                        @if (Auth::user() && Auth::user()->Role == 'Creator')
                                                            <td>
                                                                <div class="flex flex-row">
                                                                    <a href="{{route('videos.edit',$video['id'])}}"
                                                                       class=" inline-block bg-green-600 text-white text-sm font-semibold rounded-md px-3 py-2 hover:bg-green-700 mr-2">
                                                                        Edit </span>
                                                                    </a>
                                                                    <form
                                                                        action="{{route('videos.destroy', $video['id'])}}"
                                                                        method="post"> @csrf
                                                                        <input name="_method" type="hidden"
                                                                               value="DELETE">
                                                                        <button type="submit"
                                                                                class=" inline-block bg-red-700 text-white text-sm font-semibold rounded-md px-3 py-2 hover:bg-red-800">
                                                                            Delete </span>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        @else
                                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                                <a href="{{route('videos.show', $video['videoID'])}}"
                                                                   class=" inline-block bg-green-600 text-white text-sm font-semibold rounded-md px-3 py-2 hover:bg-green-700 mr-2">
                                                                    Open</a>
                                                            </td>
                                                        @endif
                                                    </tr>
                                            @endforeach

                                            <!-- More people... -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
