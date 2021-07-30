<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center text-gray-500 hover:text-black"><a
                            href="{{url('courses')}}">{{ __('Courses') }}</a></li>
                    <li class="flex items-center"><i class="fas fa-chevron-right px-3 text-black"
                                                     style="font-size: 15px"></i></li>
                    <li class="flex items-center text-gray-500 hover:text-black"><a href="{{route('courses.show',$course['id'])}}">{{$course['name']}}</a></li>
                    <li class="flex items-center"><i class="fas fa-chevron-right px-3 text-black"
                                                     style="font-size: 15px"></i></li>
                    <li class="flex items-center">{{ __('Edit Course') }}</li>

                </ol>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg bg-blue-400">
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <!-- display the errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger p-5">
                            <ul> @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li> @endforeach
                            </ul>
                        </div><br /> @endif
                <!-- display the success status -->
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <p>{{ \Session::get('success') }}</p>
                        </div><br /> @endif
                </div>

                <!-- form to edit a new course -->
                <form class="form-horizontal" method="POST" action="{{route('courses.update', $course['id'])}} " enctype="multipart/form-data" >
                    @method('PATCH')
                    @csrf
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">

                            <div class="col-span-6 sm:col-span-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Course Name</label>
                                <input type="text" value="{{$course['name']}}" name="name" id="name" autocomplete="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>


                            <div class="col-span-6 sm:col-span-3">
                                <label for="difficulty" class="block text-sm font-medium text-gray-700">Difficulty</label>
                                <select id="difficulty" value="{{$course['difficulty']}}" name="difficulty" autocomplete="difficulty" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option>Beginner</option>
                                    <option>Intermediate</option>
                                    <option>Expert</option>
                                </select>
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">
                                    Description
                                </label>
                                <div class="mt-1">
                                    <textarea  id="description" name="description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md">{{$course['description']}} </textarea>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">
                                    Brief description of the course!
                                </p>
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="thumbnail_url" class="block text-sm font-medium text-gray-700">Thumbnail Upload</label>
                                <input type="file" name="thumbnail_url" class="mt-1 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 ">
                                <p class="mt-2 text-sm text-gray-500">
                                    Please upload an thumbnail image!
                                </p>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
</x-app-layout>
