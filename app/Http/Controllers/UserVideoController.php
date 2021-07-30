<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\QuizQuestion;
use App\Models\UserCourse;
use App\Models\UserVideo;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserVideoController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'q1answer1' => 'required',
            'q1answer2' => 'required',
            'q1answer3' => 'required',
            'q1answer4' => 'required',
            'q2answer1' => 'required',
            'q2answer2' => 'required',
            'q2answer3' => 'required',
            'q2answer4' => 'required',
            'q3answer1' => 'required',
            'q3answer2' => 'required',
            'q3answer3' => 'required',
            'q3answer4' => 'required',

        ]);

        $userVideo = UserVideo::where('userID', '=', Auth::id())->where('videoID', '=', $id)->first();
        $question1count = 0;
        $question2count = 0;
        $question3count = 0;
        for ($i = 1; $i < 4; $i++){
            for ($j = 1; $j < 5; $j++)
            if ($request->input('q'.$i.'answer'.$j) == $request->input('q'.$i.'answer'.$j.'real')){
                ${'question'.$i.'count'}++;
            }
            else {
                ${'question'.$i.'count'}--;
            }
            if (${'question'.$i.'count'} == 4){
                ${'question'.$i.'count'} = true;
            }else{
                ${'question'.$i.'count'} = false;
            }
        }

        if ($question1count == 1 && $question2count == 1 && $question3count == 1 ){
            $this->checkCourse($request->input('courseID'));
            $userVideo->exercise_complete = true;
            $userVideo->save();
            $message = 'Well Done! All questions correct! You have completed this video lesson!';

        }
        else{
            $answers=[$question1count, $question2count, $question3count];
            $falseAnswers = array_keys( $answers, 0);
            $message  = count($falseAnswers).' question(s) Incorrect! You have not passed this time. Watch the video again and try the questions one more time!';

        }

// generate a redirect HTTP response with a success message
        return back()->with('message', ''.$message.'');
    }

    /**
     * function to check if course has been completed
     * @param $id
     * @return bool
     */
    public function checkCourse($id){
        $courseVideos = UserVideo::join('videos', 'videos.id', '=', 'user_videos.videoID')
            ->where('videos.courseID', '=', $id)->get()->toArray();

        for ($i = 0;$i <count($courseVideos); $i++ ){
            if ($courseVideos[$i]['exercise_complete'] = false){
                return false;
            }
            else{
                $userCourse = UserCourse::where('courseID', '=', $id)
                    ->where('userID', '=', Auth::id())
                    ->first();
                $userCourse->completed = true;
                $userCourse->save();
            }
        }

        return true;
    }
}
