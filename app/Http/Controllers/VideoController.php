<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\QuizAnswer;
use App\Models\QuizQuestion;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Scalar\String_;
use Psy\Util\Str;

class VideoController extends Controller
{

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function addVideo($id)
    {
        $course = Course::find($id);
        return view('videos.new', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // form validation
        $video = $this->validate(request(), [
            'title' => 'required',
            'video_url' => 'required',
            'description' => 'required',
            'question1' => 'required',
            'q1answer1' => 'required',
            'q1answer2' => 'required',
            'q1answer3' => 'required',
            'q1answer4' => 'required',
            'q1answer1true' => 'required',
            'q1answer2true' => 'required',
            'q1answer3true' => 'required',
            'q1answer4true' => 'required',
            'question2' => 'required',
            'q2answer1' => 'required',
            'q2answer2' => 'required',
            'q2answer3' => 'required',
            'q2answer4' => 'required',
            'q2answer1true' => 'required',
            'q2answer2true' => 'required',
            'q2answer3true' => 'required',
            'q2answer4true' => 'required',
            'question3' => 'required',
            'q3answer1' => 'required',
            'q3answer2' => 'required',
            'q3answer3' => 'required',
            'q3answer4' => 'required',
            'q3answer1true' => 'required',
            'q3answer2true' => 'required',
            'q3answer3true' => 'required',
            'q3answer4true' => 'required',

        ]);


        $video = new Video();
        $video->title = $request->input('title');
        $video->video_url = $request->input('video_url');
        $video->courseID = $request->input('courseID');
        $video->video_info = $request->input('description');
        $video->file_url = $request->input('file_url');
        $video->created_at = now();

// save the video object
        $video->save();

        for ($i = 1; $i < 4; $i++) {
            $question = new QuizQuestion();
            $question->videoID = $video['id'];
            $question->text = $request->input('question' . $i);
            $question->created_at = now();
            $question->save();
            for ($j = 1; $j < 5; $j++) {
                $this->setAnswers($question['id'], $request->input('q' . $i . 'answer' . $j), $request->input('q' . $i . 'answer' . $j . 'true'));
            }
        }


// generate a redirect HTTP response with a success message
        return back()->with('success', 'Video has been added to this course!');
    }

    /**
     *
     * function to set and store answer for a given question
     * @param int $qid
     * @param string $answer
     * @param string $correct
     */
    public function setAnswers(int $qid, string $answer, string $correct)
    {
        $quiz_answer = new QuizAnswer();
        $quiz_answer->text = $answer;
        $quiz_answer->questionID = $qid;
        $quiz_answer->created_at = now();

        if ($correct == 'correct') {
            $quiz_answer->correct = true;
        } else {
            $quiz_answer->correct = false;
        }
        $quiz_answer->save();


    }

    /**
     *
     *
     * function to update answers to  a given question
     *
     * @param int $qid
     * @param string $answer
     * @param string $correct
     * @param int $position
     */
    public function updateAnswers(int $qid, string $answer, string $correct, int $position)
    {
        $query = QuizAnswer::where('questionID', '=', $qid)->get()->all();
        $query[$position]->text = $answer;
        $query[$position]->updated_at = now();
        if ($correct == 'correct') {
            $query[$position]->correct = true;
        } else {
            $query[$position]->correct = false;
        }
        $query[$position]->save();

    }



    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $video = Video::join('user_videos','videos.id', '=', 'user_videos.videoID')
            ->where('videos.id', '=', $id)
            ->first();
        $course = Course::find($video['courseID'])->first();
        $video_questions = QuizQuestion::where('videoID', '=', $id)->get()->toArray();
        $video_questions_keys = QuizQuestion::where('videoID', '=', $id)->get('id')->toArray();
        $video_question_1_answers = QuizAnswer::where('questionID', '=', $video_questions_keys[0])->get()->toArray();
        $video_question_2_answers = QuizAnswer::where('questionID', '=', $video_questions_keys[1])->get()->toArray();
        $video_question_3_answers = QuizAnswer::where('questionID', '=', $video_questions_keys[2])->get()->toArray();

        return view('videos.show', ['course'=>$course, 'video'=>$video,
            'video_questions'=>$video_questions,
            'question_answer1'=>$video_question_1_answers,
            'question_answer2'=>$video_question_2_answers,
                'question_answer3'=>$video_question_3_answers]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $video = Video::find($id);
        $course = Course::find($video['courseID']);
        $video_questions = QuizQuestion::where('videoID', '=', $id)->get()->toArray();
        $video_questions_keys = QuizQuestion::where('videoID', '=', $id)->get('id')->toArray();
        $video_question_1_answers = QuizAnswer::where('questionID', '=', $video_questions_keys[0])->get()->toArray();
        $video_question_2_answers = QuizAnswer::where('questionID', '=', $video_questions_keys[1])->get()->toArray();
        $video_question_3_answers = QuizAnswer::where('questionID', '=', $video_questions_keys[2])->get()->toArray();

        return view('videos.edit', compact('video', 'course', 'video_questions', 'video_question_1_answers', 'video_question_2_answers', 'video_question_3_answers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // form validation

        $video = $this->validate(request(), [
            'title' => 'required',
            'video_url' => 'required',
            'description' => 'required',
            'question1' => 'required',
            'q1answer1' => 'required',
            'q1answer2' => 'required',
            'q1answer3' => 'required',
            'q1answer4' => 'required',
            'q1answer1true' => 'required',
            'q1answer2true' => 'required',
            'q1answer3true' => 'required',
            'q1answer4true' => 'required',
            'question2' => 'required',
            'q2answer1' => 'required',
            'q2answer2' => 'required',
            'q2answer3' => 'required',
            'q2answer4' => 'required',
            'q2answer1true' => 'required',
            'q2answer2true' => 'required',
            'q2answer3true' => 'required',
            'q2answer4true' => 'required',
            'question3' => 'required',
            'q3answer1' => 'required',
            'q3answer2' => 'required',
            'q3answer3' => 'required',
            'q3answer4' => 'required',
            'q3answer1true' => 'required',
            'q3answer2true' => 'required',
            'q3answer3true' => 'required',
            'q3answer4true' => 'required',

        ]);

        $video = Video::find($id);
// find video object and set its values from the input
        $video->file_url = $request->input('file_url');
        $video->title = $request->input('title');
        $video->video_url = $request->input('video_url');
        $video->courseID = $request->input('courseID');
        $video->video_info = $request->input('description');
        $video->updated_at = now();

// save the video object
        $video->save();

        $question_array = QuizQuestion::where('videoID', '=', $video['id'])->get()->all();
        for ($i = 1; $i < 4; $i++) {
            $question = $question_array[$i-1];
            $question->text = $request->input('question' . $i);
            $question->updated_at = now();
            $question->save();
            for ($j = 1; $j < 5; $j++) {
                $this->updateAnswers($question['id'], $request->input('q' . $i . 'answer' . $j), $request->input('q' . $i . 'answer' . $j . 'true'),$j-1);
            }

        }


// generate a redirect HTTP response with a success message
        return back()->with('success', 'Video has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $video_questions = QuizQuestion::where('videoID', '=', $id)->get()->toArray();

        for ($i=0; $i < count($video_questions); $i++){
            QuizAnswer::where('questionID', '=', $video_questions[$i]['id'])->delete();
        }
        Video::find($id)->delete();
        QuizQuestion::where('videoID', '=', $id)->delete();

        return back();

    }

}
