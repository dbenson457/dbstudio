<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\UserCourse;
use App\Models\UserVideo;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($name)
    {
        $id = Course::where('name', '=', $name)->first();
        $userCourse = new UserCourse();
        $userCourse->userID = Auth::user()->id;
        $userCourse->courseID = $id->id;
        $userCourse->completed = false;
        $userCourse->created_at = now();
        $userCourse->save();

        $course = Course::find($id->id);
        $videos = Video::where('courseID', '=', $id->id)->get()->toArray();

        for ($i = 0 ; $i < count($videos); $i++){
            $search = UserVideo::where('videoID', '=', $videos[$i]['id'])
                ->where('userID', '=', Auth::user()->id)
                ->first();

            if (is_null($search)){
                $userVideo = new UserVideo();
                $userVideo->videoID = $videos[$i]['id'];
                $userVideo->userID = Auth::user()->id;
                $userVideo->courseID = $id->id;
                $userVideo->exercise_complete = false;
                $userVideo->created_at = now();
                $userVideo->save();
            }

        }
        $videos = Video::join('user_videos','videos.id', '=', 'user_videos.videoID')->where('videos.courseID', '=', $id->id)->get();


        return view('courses.show', ['course' => $course, 'videos' => $videos])->with('message', 'You have been enrolled!' );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserCourse::where('userID', '=', Auth::id())
            ->where('courseID', '=', $id)
            ->delete();

        UserVideo::where('userID', '=', Auth::id())
            ->where('courseID', '=', $id)
            ->delete();

        return back();

    }
}
