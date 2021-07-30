<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\QuizAnswer;
use App\Models\QuizQuestion;
use App\Models\UserCourse;
use App\Models\UserVideo;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{

    /**
     *
     * Function to display all courses
     * @param Request $request
     * @return view with arrays
     */
    public function index(Request $request)
    {

        $list = Course::all()->toArray();

        if (Auth::user()->Role == 'User') {
            $list = UserCourse::join('courses', 'courses.id', '=', 'user_courses.courseID')
                ->where('userID', '=', Auth::id())
                ->get()->toArray();
        }

        $courses = $this->paginate($request, $list);

        $filter = 'all';

        return view('courses/list', ['courses' => $courses, 'filter' => $filter]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.new');
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
        $course = $this->validate(request(), [
            'name' => 'required',
            'description' => 'required',
            'difficulty' => 'required',
            'thumbnail_url' => 'required'
        ]);
//Handles the uploading of the image
        if ($request->hasFile('thumbnail_url')) {
//Gets the filename with the extension
            $fileNameWithExt = $request->file('thumbnail_url')->getClientOriginalName();
//just gets the filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
//Just gets the extension
            $extension = $request->file('thumbnail_url')->getClientOriginalExtension();
//Gets the filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
//Uploads the image
            $path = $request->file('thumbnail_url')->storeAs('public/images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
// create a course object and set its values from the input
        $course = new Course();
        $course->name = $request->input('name');
        $course->description = $request->input('description');
        $course->difficulty = $request->input('difficulty');
        $course->thumbnail_url = $fileNameToStore;
        $course->created_at = now();

// save the course object
        $course->save();
// generate a redirect HTTP response with a success message
        return view('videos.new', compact('course'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->Role == 'Creator'){
            $course = Course::find($id);
            $videos = Video::where('courseID', '=', $id)->get()->toArray();
        }

        else{
        $course = Course::find($id);
        $videos = Video::join('user_videos','videos.id', '=', 'user_videos.videoID')
        ->where('videos.courseID', '=', $id)
            ->get();
        }

        return view('courses.show', compact('course', 'videos'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::find($id);
        return view('courses.edit', compact('course'));
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
        $course = Course::find($id);
        $this->validate(request(), [
            'name' => 'required',
            'description' => 'required',
            'difficulty' => 'required'
        ]);
        $course->name = $request->input('name');
        $course->description = $request->input('description');
        $course->difficulty = $request->input('difficulty');
        $course->updated_at = now();
//Handles the uploading of the image
        if ($request->hasFile('thumbnail_url')) {
//Gets the filename with the extension
            $fileNameWithExt = $request->file('thumbnail_url')->getClientOriginalName();
//just gets the filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
//Just gets the extension
            $extension = $request->file('thumbnail_url')->getClientOriginalExtension();
//Gets the filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
//Uploads the image
            $path = $request->file('thumbnail_url')->storeAs('public/images', $fileNameToStore);
            $course->thumbnail_url = $fileNameToStore;
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $course->save();
        return back()->with('success', $course->name . ' has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $query = Video::where('courseID', '=', $id)->get()->all();
        if ($query == null) {
            $course = Course::find($id);
            $course->delete();
            UserCourse::where('courseID', '=', $id)->delete();
            UserVideo::where('courseID', '=', $id)->delete();

            return back()->with('message', 'Course Deleted!');
        } else {
            return back()->with('message', 'Please delete all videos first!');
        }
    }

    /**
     *
     * Function to display all courses not taken by user
     * @param Request $request
     * @return View
     */
    public function findCourses(Request $request)
    {


        $list = Course::leftJoin('user_courses', 'courses.id', '=', 'user_courses.courseID')
            ->where('userID', '=', null)
            ->orWhere('userID', '!=', Auth::id())
            ->get()
            ->toArray();


        $courses = $this->paginate($request, $list);
        $filter = 'all';

        return view('courses/find', ['courses' => $courses, 'filter'=> $filter]);
    }

    /**
     *
     * function  to paginate the results
     *
     * @param Request $request
     * @param $list
     * @return LengthAwarePaginator
     */
    public function paginate(Request $request, $list){

        if(count($list)>0){
            // Get current page form url e.x. &page=1
            $currentPage = LengthAwarePaginator::resolveCurrentPage();

            // Define how many products we want to be visible in each page
            $perPage = 3;

            // Slice the collection to get the products to display in current page
            $currentPageCourses = collect($list)->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

            // Create our paginator and pass it to the view
            $courses = new LengthAwarePaginator($currentPageCourses, count($list), $perPage);

            // set url path for generted links
            $courses->setPath($request->url());}
        else{
            $courses = null;
        }

        return $courses;
    }

    /**
     *
     * function to filter couses on courses page
     * @param Request $request
     * @param $filter
     * @return View
     */
    public function filter (Request $request, $filter){
        $query = '';
        switch ($filter){
            case 'all':
                return  $this->index($request);

            case 'Beginner':
                $query = 'Beginner';
                break;
            case 'Intermediate':
                $query = 'Intermediate';
                break;
            case 'Expert':
                $query = 'Expert';
                break;
        }

        $list = Course::where('difficulty', '=', $query)->get()->toArray();

        if (Auth::user()->Role == 'User') {
            $list = UserCourse::join('courses', 'courses.id', '=', 'user_courses.courseID')
                ->where('userID', '=', Auth::id())
                ->where('difficulty', '=', $query)
                ->get()->toArray();
        }

        $courses = $this->paginate($request, $list);

        return view('courses/list', ['courses' => $courses, 'filter'=> $filter]);
    }

    /**
     *
     * function to filter on  search  page
     * @param Request $request
     * @param $filter
     * @return View
     */
    public function filterFind (Request $request, $filter){
        $query = '';
        switch ($filter){
            case 'all':
                return $this->findCourses($request);
            case 'Beginner':
                $query = 'Beginner';
                break;
            case 'Intermediate':
                $query = 'Intermediate';
                break;
            case 'Expert':
                $query = 'Expert';
                break;
        }

        $list = Course::leftJoin('user_courses', 'courses.id', '=', 'user_courses.courseID')
            ->where('userID', '=', null)
            ->where('difficulty', '=', $query)
            ->get()
            ->toArray();

        $courses = $this->paginate($request, $list);


        return view('courses/find', ['courses' => $courses, 'filter'=> $filter]);
    }



}
