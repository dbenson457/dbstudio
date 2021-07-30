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
                    <li class="flex items-center text-gray-500 hover:text-black ">{{$video['title']}}</li>
                    <li class="flex items-center"><i class="fas fa-chevron-right px-3 text-black"
                                                     style="font-size: 15px"></i></li>
                    <li class="flex items-center">{{ __('Edit Video Lesson') }}</li>
                </ol>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg bg-blue-400">
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <!-- display the errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger px-5 py-2">
                            <ul> @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li> @endforeach
                            </ul>
                        </div><br /> @endif
                <!-- display the success status -->
                    @if (\Session::has('success'))
                        <div class="alert alert-success px-5 py-2">
                            <h2>{{ \Session::get('success') }}</h2>
                        </div><br /> @endif
                </div>
                <p class="m-5 text-red-600">* Please fill in all details</p>
                <form method="POST" action="{{route('videos.update', $video['id'])}}" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="shadow sm:rounded-md sm:overflow-hidden">

                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                            <h1>Enter Video Information</h1>
                            <div class="col-span-6 sm:col-span-4">
                                <label for="title" class="block text-sm font-medium text-gray-700">Video Title</label>
                                <input type="text" name="title" id="title" value="{{$video['title']}}" autocomplete="title" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="video_url" class="block text-sm font-medium text-gray-700">Video Embed URL</label>
                                <input type="text" name="video_url" id="video_url" value="{{$video['video_url']}}" placeholder="https://example.co.uk" autocomplete="video_url" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <input type="hidden" name="courseID" id="courseID" value="{{$course['id']}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">
                                    Video Description
                                </label>
                                <div class="mt-1">
                                    <textarea id="description" name="description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md">{{$video['video_info']}}</textarea>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">
                                    Description of the video
                                </p>
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="file_url" class="block text-sm font-medium text-gray-700">Optional File</label>
                                <input type="text" name="file_url" id="file_url" value="{{$video['file_url']}}" autocomplete="file_url" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <p class="mt-2 text-sm text-gray-500">
                                    Please paste a link to the file you would like users to download!
                                </p>
                            </div>
                            <hr class="solid">
                            <h1>Test Questions</h1>
                            <div class="col-span-6 sm:col-span-4">
                                <label for="question1" class="block text-sm font-medium text-gray-700">Question 1</label>
                                <input type="text" name="question1" id="question1" value="{{$video_questions[0]['text']}}" autocomplete="question1" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                                <div>
                                    <label for="q1answer1" class="block text-sm font-medium text-gray-700">Answer 1</label>
                                    <input id="q1answer1" name="q1answer1" value="{{$video_question_1_answers[0]['text']}}" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    @if($video_question_1_answers[0]['correct'] == true)
                                    <input type="radio" id="correct" name="q1answer1true" value="correct" checked="checked">
                                    <label for="correct">Correct</label><br>
                                    <input type="radio" id="incorrect" name="q1answer1true" value="incorrect">
                                    <label for="incorrect">Incorrect</label><br>
                                    @else
                                        <input type="radio" id="correct" name="q1answer1true" value="correct">
                                        <label for="correct">Correct</label><br>
                                        <input type="radio" id="incorrect" name="q1answer1true" value="incorrect" checked="checked">
                                        <label for="incorrect">Incorrect</label><br>
                                    @endif

                                </div>

                                <div>
                                    <label for="q1answer2" class="block text-sm font-medium text-gray-700">Answer 2</label>
                                    <input id="q1answer2" name="q1answer2" value="{{$video_question_1_answers[1]['text']}}" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    @if($video_question_1_answers[1]['correct'] == true)
                                        <input type="radio" id="correct" name="q1answer2true" value="correct" checked="checked">
                                        <label for="correct">Correct</label><br>
                                        <input type="radio" id="incorrect" name="q1answer2true" value="incorrect">
                                        <label for="incorrect">Incorrect</label><br>
                                    @else
                                        <input type="radio" id="correct" name="q1answer2true" value="correct">
                                        <label for="correct">Correct</label><br>
                                        <input type="radio" id="incorrect" name="q1answer2true" value="incorrect" checked="checked">
                                        <label for="incorrect">Incorrect</label><br>
                                    @endif
                                </div>

                                <div>
                                    <label for="q1answer3" class="block text-sm font-medium text-gray-700">Answer 3</label>
                                    <input id="q1answer3" name="q1answer3" value="{{$video_question_1_answers[2]['text']}}" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    @if($video_question_1_answers[2]['correct'] == true)
                                        <input type="radio" id="correct" name="q1answer3true" value="correct" checked="checked">
                                        <label for="correct">Correct</label><br>
                                        <input type="radio" id="incorrect" name="q1answer3true" value="incorrect">
                                        <label for="incorrect">Incorrect</label><br>
                                    @else
                                        <input type="radio" id="correct" name="q1answer3true" value="correct">
                                        <label for="correct">Correct</label><br>
                                        <input type="radio" id="incorrect" name="q1answer3true" value="incorrect" checked="checked">
                                        <label for="incorrect">Incorrect</label><br>
                                    @endif
                                </div>

                                <div>
                                    <label for="q1answer4" class="block text-sm font-medium text-gray-700">Answer 4</label>
                                    <input id="q1answer4" name="q1answer4" value="{{$video_question_1_answers[3]['text']}}" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    @if($video_question_1_answers[3]['correct'] == true)
                                        <input type="radio" id="correct" name="q1answer4true" value="correct" checked="checked">
                                        <label for="correct">Correct</label><br>
                                        <input type="radio" id="incorrect" name="q1answer4true" value="incorrect">
                                        <label for="incorrect">Incorrect</label><br>
                                    @else
                                        <input type="radio" id="correct" name="q1answer4true" value="correct">
                                        <label for="correct">Correct</label><br>
                                        <input type="radio" id="incorrect" name="q1answer4true" value="incorrect" checked="checked">
                                        <label for="incorrect">Incorrect</label><br>
                                    @endif
                                </div>
                            </div>

                            <hr class="dotted mx-16">
                            <div class="col-span-6 sm:col-span-4">
                                <label for="question2" class="block text-sm font-medium text-gray-700">Question 2</label>
                                <input type="text" name="question2" id="question2" value="{{$video_questions[1]['text']}}" autocomplete="question2" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                                <div>
                                    <label for="q2answer1" class="block text-sm font-medium text-gray-700">Answer 1</label>
                                    <input id="q2answer1" name="q2answer1" value="{{$video_question_2_answers[0]['text']}}" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    @if($video_question_2_answers[0]['correct'] == true)
                                        <input type="radio" id="correct" name="q2answer1true" value="correct" checked="checked">
                                        <label for="correct">Correct</label><br>
                                        <input type="radio" id="incorrect" name="q2answer1true" value="incorrect">
                                        <label for="incorrect">Incorrect</label><br>
                                    @else
                                        <input type="radio" id="correct" name="q2answer1true" value="correct">
                                        <label for="correct">Correct</label><br>
                                        <input type="radio" id="incorrect" name="q2answer1true" value="incorrect" checked="checked">
                                        <label for="incorrect">Incorrect</label><br>
                                    @endif
                                </div>

                                <div>
                                    <label for="q2answer2" class="block text-sm font-medium text-gray-700">Answer 2</label>
                                    <input id="q2answer2" name="q2answer2" value="{{$video_question_2_answers[1]['text']}}" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    @if($video_question_2_answers[1]['correct'] == true)
                                        <input type="radio" id="correct" name="q2answer2true" value="correct" checked="checked">
                                        <label for="correct">Correct</label><br>
                                        <input type="radio" id="incorrect" name="q2answer2true" value="incorrect">
                                        <label for="incorrect">Incorrect</label><br>
                                    @else
                                        <input type="radio" id="correct" name="q2answer2true" value="correct">
                                        <label for="correct">Correct</label><br>
                                        <input type="radio" id="incorrect" name="q2answer2true" value="incorrect" checked="checked">
                                        <label for="incorrect">Incorrect</label><br>
                                    @endif
                                </div>

                                <div>
                                    <label for="q2answer3" class="block text-sm font-medium text-gray-700">Answer 3</label>
                                    <input id="q2answer3" name="q2answer3" value="{{$video_question_2_answers[2]['text']}}" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    @if($video_question_2_answers[2]['correct'] == true)
                                        <input type="radio" id="correct" name="q2answer3true" value="correct" checked="checked">
                                        <label for="correct">Correct</label><br>
                                        <input type="radio" id="incorrect" name="q2answer3true" value="incorrect">
                                        <label for="incorrect">Incorrect</label><br>
                                    @else
                                        <input type="radio" id="correct" name="q2answer3true" value="correct">
                                        <label for="correct">Correct</label><br>
                                        <input type="radio" id="incorrect" name="q2answer3true" value="incorrect" checked="checked">
                                        <label for="incorrect">Incorrect</label><br>
                                    @endif
                                </div>

                                <div>
                                    <label for="q2answer4" class="block text-sm font-medium text-gray-700">Answer 4</label>
                                    <input id="q2answer4" name="q2answer4" value="{{$video_question_2_answers[3]['text']}}" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    @if($video_question_2_answers[3]['correct'] == true)
                                        <input type="radio" id="correct" name="q2answer4true" value="correct" checked="checked">
                                        <label for="correct">Correct</label><br>
                                        <input type="radio" id="incorrect" name="q2answer4true" value="incorrect">
                                        <label for="incorrect">Incorrect</label><br>
                                    @else
                                        <input type="radio" id="correct" name="q2answer4true" value="correct">
                                        <label for="correct">Correct</label><br>
                                        <input type="radio" id="incorrect" name="q2answer4true" value="incorrect" checked="checked">
                                        <label for="incorrect">Incorrect</label><br>
                                    @endif
                                </div>
                            </div>
                            <hr class="dotted mx-16">
                            <div class="col-span-6 sm:col-span-4">
                                <label for="question3" class="block text-sm font-medium text-gray-700">Question 3</label>
                                <input type="text" name="question3" id="question3" value="{{$video_questions[2]['text']}}" autocomplete="question3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                                <div>
                                    <label for="q3answer1" class="block text-sm font-medium text-gray-700">Answer 1</label>
                                    <input id="q3answer1" name="q3answer1" value="{{$video_question_3_answers[0]['text']}}" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    @if($video_question_3_answers[0]['correct'] == true)
                                        <input type="radio" id="correct" name="q3answer1true" value="correct" checked="checked">
                                        <label for="correct">Correct</label><br>
                                        <input type="radio" id="incorrect" name="q3answer1true" value="incorrect">
                                        <label for="incorrect">Incorrect</label><br>
                                    @else
                                        <input type="radio" id="correct" name="q3answer1true" value="correct">
                                        <label for="correct">Correct</label><br>
                                        <input type="radio" id="incorrect" name="q3answer1true" value="incorrect" checked="checked">
                                        <label for="incorrect">Incorrect</label><br>
                                    @endif
                                </div>

                                <div>
                                    <label for="q3answer2" class="block text-sm font-medium text-gray-700">Answer 2</label>
                                    <input id="q3answer2" name="q3answer2" value="{{$video_question_3_answers[1]['text']}}" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    @if($video_question_3_answers[1]['correct'] == true)
                                        <input type="radio" id="correct" name="q3answer2true" value="correct" checked="checked">
                                        <label for="correct">Correct</label><br>
                                        <input type="radio" id="incorrect" name="q3answer2true" value="incorrect">
                                        <label for="incorrect">Incorrect</label><br>
                                    @else
                                        <input type="radio" id="correct" name="q3answer2true" value="correct">
                                        <label for="correct">Correct</label><br>
                                        <input type="radio" id="incorrect" name="q3answer2true" value="incorrect" checked="checked">
                                        <label for="incorrect">Incorrect</label><br>
                                    @endif
                                </div>

                                <div>
                                    <label for="q3answer3" class="block text-sm font-medium text-gray-700">Answer 3</label>
                                    <input id="q3answer3" name="q3answer3" value="{{$video_question_3_answers[2]['text']}}" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    @if($video_question_3_answers[2]['correct'] == true)
                                        <input type="radio" id="correct" name="q3answer3true" value="correct" checked="checked">
                                        <label for="correct">Correct</label><br>
                                        <input type="radio" id="incorrect" name="q3answer3true" value="incorrect">
                                        <label for="incorrect">Incorrect</label><br>
                                    @else
                                        <input type="radio" id="correct" name="q3answer3true" value="correct">
                                        <label for="correct">Correct</label><br>
                                        <input type="radio" id="incorrect" name="q3answer3true" value="incorrect" checked="checked">
                                        <label for="incorrect">Incorrect</label><br>
                                    @endif
                                </div>

                                <div>
                                    <label for="q3answer4" class="block text-sm font-medium text-gray-700">Answer 4</label>
                                    <input id="q3answer4" name="q3answer4" value="{{$video_question_3_answers[3]['text']}}" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                    @if($video_question_3_answers[3]['correct'] == true)
                                        <input type="radio" id="correct" name="q3answer4true" value="correct" checked="checked">
                                        <label for="correct">Correct</label><br>
                                        <input type="radio" id="incorrect" name="q3answer4true" value="incorrect">
                                        <label for="incorrect">Incorrect</label><br>
                                    @else
                                        <input type="radio" id="correct" name="q3answer4true" value="correct">
                                        <label for="correct">Correct</label><br>
                                        <input type="radio" id="incorrect" name="q3answer4true" value="incorrect" checked="checked">
                                        <label for="incorrect">Incorrect</label><br>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Save
                            </button>
                            <a href="{{route('courses.show',$course['id'])}}"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancel
                            </a>
                                </div>
                            </td>
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
