<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center text-gray-500 hover:text-black"><a
                        href="{{url('courses')}}">{{ __('Courses') }}</a></li>
                <li class="flex items-center"><i class="fas fa-chevron-right px-3 text-black"
                                                 style="font-size: 15px"></i></li>
                <li class="flex items-center text-gray-500 hover:text-black"><a
                        href="{{route('courses.show',$course['id'])}}">{{$course['name']}}</a></li>
                <li class="flex items-center"><i class="fas fa-chevron-right px-3 text-black"
                                                 style="font-size: 15px"></i></li>
                <li class="flex items-center text-black">{{$video['title']}}</li>
            </ol>
        </h2>
    </x-slot>

    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white overflow-hidden shadow-xl bg-blue-400 sm:rounded-lg">
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="flex flex-col">
                        <div class="-my-2 sm:-mx-6 lg:-mx-8 px-3 py-6">
                            <div class="grid grid-cols-4">
                                <div
                                    class="flex font-semibold text-xl text-gray-800 leading-tigh align-middle inline-block sm:px-6 ml-5 ">
                                    <a href="{{route('courses.show',$course['id'])}}"
                                       class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Go back</a>
                                </div>
                                <div
                                    class="flex flex-col col-span-4 text-center font-semibold text-xl text-gray-800 leading-tigh mb-5 align-middle inline-block sm:px-6 ">
                                    <h1>{{$video['title']}}</h1>
                                </div>
                                <div
                                    class="flex flex-col col-span-2 px-8 py-5 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <iframe class="ml-3" src="https://www.youtube.com/embed/_5V_pA1Kqn4" width="500"
                                            height="380"></iframe>
                                    <div class="mt-4 ml-3">{{$video['video_info']}}</div>
                                    @if($video['file_url'] != null)
                                    <a href="{{$video['file_url']}}"
                                       target="_blank"
                                       class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <i class="fas fa-download text-white" style="font-size: 15px"></i>
                                        Download</a>
                                    @else
                                    @endif
                                </div>

                                <div
                                    class="flex flex-col col-span-2 px-8 py-5 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="mt-5 md:mt-0 md:col-span-2">
                                        <!-- display the errors -->
                                        @if ($errors->any())
                                            <div class="alert alert-danger p-5">
                                                <ul> @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li> @endforeach
                                                </ul>
                                            </div><br/> @endif
                                    <!-- display the success status -->
                                        @if (\Session::has('message'))
                                            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                                            <div class="alert alert-success px-5 mt-2">
                                                <h2>{{ \Session::get('message') }}</h2>
                                            </div><br/>
                                            </div>
                                        @endif

                                    </div>
                                    <form method="POST" action="{{route('userVideos.update', $video['videoID'])}}"
                                          enctype="multipart/form-data">
                                        @method('PATCH')
                                        @csrf
                                        <div
                                            class="flex flex-col col-span-4 text-center font-semibold text-lg text-gray-800 leading-tigh mb-5 align-middle inline-block sm:px-6 ">
                                            <h1>Quiz Questions!</h1>
                                        </div>
                                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 mb-2">

                                            <div class="col-span-6 sm:col-span-4">
                                                <label for="question1" class="block text-sm font-medium text-gray-700">Question
                                                    1</label>
                                                <p>{{$video_questions[0]['text']}}</p>
                                            </div>
                                            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                                                <div>
                                                    <label for="q1answer1"
                                                           class="block text-sm font-medium text-gray-700">Answer
                                                        1</label>
                                                    <input type="hidden" id="incorrect" name="q1answer1" value="0">
                                                    <input type="checkbox" id="correct" name="q1answer1" value="1">
                                                    <label for="correct">{{$question_answer1[0]['text']}}</label><br>
                                                    <input type="hidden" name="q1answer1real"
                                                           value="{{$question_answer1[0]['correct']}}"/>

                                                </div>

                                                <div>
                                                    <label for="q1answer2"
                                                           class="block text-sm font-medium text-gray-700">Answer
                                                        2</label>
                                                    <input type="hidden" id="incorrect" name="q1answer2" value="0">
                                                    <input type="checkbox" id="correct" name="q1answer2" value="1">
                                                    <label for="correct">{{$question_answer1[1]['text']}}</label><br>
                                                    <input type="hidden" name="q1answer2real"
                                                           value="{{$question_answer1[1]['correct']}}"/>


                                                </div>

                                                <div>
                                                    <label for="q1answer3"
                                                           class="block text-sm font-medium text-gray-700">Answer
                                                        3</label>
                                                    <input type="hidden" id="incorrect" name="q1answer3" value="0">
                                                    <input type="checkbox" id="correct" name="q1answer3" value="1">
                                                    <label for="correct">{{$question_answer1[2]['text']}}</label><br>
                                                    <input type="hidden" name="q1answer3real"
                                                           value="{{$question_answer1[2]['correct']}}"/>


                                                </div>

                                                <div>
                                                    <label for="q1answer4"
                                                           class="block text-sm font-medium text-gray-700">Answer
                                                        4</label>
                                                    <input type="hidden" id="incorrect" name="q1answer4" value="0">
                                                    <input type="checkbox" id="correct" name="q1answer4" value="1">
                                                    <label for="correct">{{$question_answer1[3]['text']}}</label><br>
                                                    <input type="hidden" name="q1answer4real"
                                                           value="{{$question_answer1[3]['correct']}}"/>


                                                </div>
                                            </div>
                                        </div>

                                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 mb-2">
                                            <div class="col-span-6 sm:col-span-4 ">
                                                <label for="question1" class="block text-sm font-medium text-gray-700">Question
                                                    2</label>
                                                <p>{{$video_questions[1]['text']}}</p>
                                            </div>
                                            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                                                <div>
                                                    <label for="q2answer1"
                                                           class="block text-sm font-medium text-gray-700">Answer
                                                        1</label>
                                                    <input type="hidden" id="incorrect" name="q2answer1" value="0">
                                                    <input type="checkbox" id="correct" name="q2answer1" value="1">
                                                    <label for="correct">{{$question_answer2[0]['text']}}</label><br>
                                                    <input type="hidden" name="q2answer1real"
                                                           value="{{$question_answer2[0]['correct']}}"/>

                                                </div>

                                                <div>
                                                    <label for="q2answer2"
                                                           class="block text-sm font-medium text-gray-700">Answer
                                                        2</label>
                                                    <input type="hidden" id="incorrect" name="q2answer2" value="0">
                                                    <input type="checkbox" id="correct" name="q2answer2" value="1">
                                                    <label for="correct">{{$question_answer2[1]['text']}}</label><br>
                                                    <input type="hidden" name="q2answer2real"
                                                           value="{{$question_answer2[1]['correct']}}"/>


                                                </div>

                                                <div>
                                                    <label for="q2answer3"
                                                           class="block text-sm font-medium text-gray-700">Answer
                                                        3</label>
                                                    <input type="hidden" id="incorrect" name="q2answer3" value="0">
                                                    <input type="checkbox" id="correct" name="q2answer3" value="1">
                                                    <label for="correct">{{$question_answer2[2]['text']}}</label><br>
                                                    <input type="hidden" name="q2answer3real"
                                                           value="{{$question_answer2[2]['correct']}}"/>


                                                </div>

                                                <div>
                                                    <label for="q2answer4"
                                                           class="block text-sm font-medium text-gray-700">Answer
                                                        4</label>
                                                    <input type="hidden" id="incorrect" name="q2answer4" value="0">
                                                    <input type="checkbox" id="correct" name="q2answer4" value="1">
                                                    <label for="correct">{{$question_answer2[3]['text']}}</label><br>
                                                    <input type="hidden" name="q2answer4real"
                                                           value="{{$question_answer2[3]['correct']}}"/>


                                                </div>
                                            </div>
                                        </div>

                                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 mb-2">
                                            <div class="col-span-6 sm:col-span-4 ">
                                                <label for="question3" class="block text-sm font-medium text-gray-700">Question
                                                    3</label>
                                                <p>{{$video_questions[2]['text']}}</p>
                                            </div>
                                            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                                                <div>
                                                    <label for="q3answer1"
                                                           class="block text-sm font-medium text-gray-700">Answer
                                                        1</label>
                                                    <input type="hidden" id="incorrect" name="q3answer1" value="0">
                                                    <input type="checkbox" id="correct" name="q3answer1" value="1">
                                                    <label for="correct">{{$question_answer3[0]['text']}}</label><br>
                                                    <input type="hidden" name="q3answer1real"
                                                           value="{{$question_answer3[0]['correct']}}"/>

                                                </div>

                                                <div>
                                                    <label for="q3answer2"
                                                           class="block text-sm font-medium text-gray-700">Answer
                                                        2</label>
                                                    <input type="hidden" id="incorrect" name="q3answer2" value="0">
                                                    <input type="checkbox" id="correct" name="q3answer2" value="1">
                                                    <label for="correct">{{$question_answer3[1]['text']}}</label><br>
                                                    <input type="hidden" name="q3answer2real"
                                                           value="{{$question_answer3[1]['correct']}}"/>


                                                </div>

                                                <div>
                                                    <label for="q3answer3"
                                                           class="block text-sm font-medium text-gray-700">Answer
                                                        3</label>
                                                    <input type="hidden" id="incorrect" name="q3answer3" value="0">
                                                    <input type="checkbox" id="correct" name="q3answer3" value="1">
                                                    <label for="correct">{{$question_answer3[2]['text']}}</label><br>
                                                    <input type="hidden" name="q3answer3real"
                                                           value="{{$question_answer3[2]['correct']}}"/>


                                                </div>

                                                <div>
                                                    <label for="q3answer4"
                                                           class="block text-sm font-medium text-gray-700">Answer
                                                        4</label>
                                                    <input type="hidden" id="incorrect" name="q3answer4" value="0">
                                                    <input type="checkbox" id="correct" name="q3answer4" value="1">
                                                    <label for="correct">{{$question_answer3[3]['text']}}</label><br>
                                                    <input type="hidden" name="q3answer4real"
                                                           value="{{$question_answer3[3]['correct']}}"/>


                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" id="courseID" name="courseID" value="{{$course['id']}}">

                                        <button type="submit"
                                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Submit
                                        </button>

                                </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
