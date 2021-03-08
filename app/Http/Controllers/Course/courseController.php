<?php

namespace App\Http\Controllers\Course;

// namespace App\Http\Controllers\Course;

// use App\Model\Like;
use App\User;
use Exception;
use App\Model\Like;
use App\priceModel;
use App\course_model;
use App\Model\Review;
use App\Model\Subscribe;
use App\Traits\Generics;
use App\Traits\UsersArray;
use App\Model\SavedCourses;
use App\Traits\appFunction;
use Illuminate\Http\Request;
use App\course_category_model;
use App\Model\courseEnrollment;
use App\Model\live_stream_model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\FireBaseNotification;
use Illuminate\Support\Facades\Validator;

class courseController extends Controller
{
    use Generics;
    use appFunction;
    use FireBaseNotification;
    use UsersArray;

    function __construct(
        Like $like, course_model $course_model, course_category_model $course_category_model, Review $review, live_stream_model $live_stream_model, SavedCourses $savedCourses, User $user, Subscribe $subscribe, courseEnrollment $courseEnrollment
    ){
        $this->middleware('auth',  ['except' => ['activateCoursesStatus']]);
        $this->like = $like;
        $this->course_model = $course_model;
        $this->course_category_model = $course_category_model;
        $this->review = $review;
        $this->live_stream_model = $live_stream_model;
        $this->savedCourses = $savedCourses;
        $this->user = $user;
        $this->subscribe = $subscribe;
        $this->courseEnrollment = $courseEnrollment;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_category = course_category_model::all();
        $all_price = priceModel::all();
        $user = auth()->user();
        $view = [
            'category' => $all_category,
            'pricing' => $all_price,
            'user' => $user,
        ];
        // return $view;
        return view('dashboard.create-course', $view);
    }
    /**
     *  Show the form for updating course.
     *
     * @return \Illuminate\Http\Response
     */
    public function update_page($id)
    {
        $course = course_model::find($id);
        $all_category = course_category_model::all();
        $all_price = priceModel::all();
        $view = [
            'course' => $course,
            'category' => $all_category,
            'pricing' => $all_price,
        ];
        // return $view;
        return view('dashboard.edit-course', $view);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = $request->user();
        //return $user;

        try {
            if (!$request->isMethod('POST')) {
                throw new Exception('This is not a valid request.');
            }
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:40|unique:course_tb,name',
                'category' => 'required|string',
                'caption' => 'required|string|max:100',
                'pricing' => 'required|string',
                'desc' => 'required',
                'url' => 'required',
                'cover_img' => 'required|file|image|mimes:jpeg,png,gif|max:4048',
                'cover_video' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status' => false]);
            }

            $unique_id = $this->createUniqueId('price_tb', 'unique_id');
            $title = $request->input('title');
            $category = $request->input('category');
            $caption = $request->input('caption');
            $pricing = $request->input('pricing');
            $description = $request->input('desc');
            $url = $request->input('url');
            $cover_img = $request->file('cover_img');
            $cover_video = $request->input('cover_video');
            $user_id = $user['unique_id'];

            // generate file name
            $img_name = $this->gen_file_name($user, $title, $cover_img);
            $upload_img = $cover_img->storeAs(
                'public/course-img',
                $img_name
            );
            // return [$caption];

            $new_course = course_model::create([
                'unique_id' => $unique_id,
                'name' => $title,
                'category_id' => $category,
                'user_id' => $user_id,
                'short_caption' => $caption,
                'pricing' => $pricing,
                'description' => $description,
                'course_urls' => $url,
                'cover_image' => $img_name,
                'intro_video' => $cover_video,
                'views' => 0,
            ]);

            if (!$new_course->unique_id) {
                throw new Exception($this->errorMsgs(14)['msg']);
            } else {
                $condition = [
                    ['teacher_unique_id', $user->unique_id],
                ];
                $users_array = $this->subscribe->getAllSubscribers($condition);
                $user_array = [];
                foreach ($users_array as $item => $each_users_array){
                    $query = [
                        ['unique_id', $each_users_array->user_unique_id]
                    ];
                    $user_object = $this->user->getSingleUser($query);
                    array_push($user_array, $user_object);

                }

                $title_ = 'A New Course titled '.$title.' Was Just Uploaded, by '.$user->name.' '.$user->last_name;

                $link = 'htpps://centadesk.com';

                $notification_type = 'Course Upload';

                $user_to_recieve_notification = $user_array;
                $notification_details = [$title_, $caption, $pricing];
                $notification_details_key = ['course_title', 'course_desc', 'pricing'];

                $this->NotificationsHandler($title_, $link, $notification_type, $notification_details, $notification_details_key, $user_to_recieve_notification);
                $error = 'Course Created!';
                return response()->json(["message" => $error, 'status' => true]);
            }
        } catch (Exception $e) {

            $error = $e->getMessage();
            $error = [
                'errors' => [$error],
            ];
            return response()->json(["errors" => $error, 'status' => false]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the teacher created courses.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show() {
        $user = auth()->user();

        if ($user->user_type === 'admin' || $user->user_type === 'super_admin') {

            $condition = [
                ['deleted_at', null]
            ];
            $courses = $this->course_model->getAllCourse($condition);
        } else {

            $condition = [
                ['user_id', $user->unique_id]
            ];
            $courses = $this->course_model->getAllCourse($condition);
        }

        foreach ($courses as $each_courses) {

            $condition = [
                ['course_unique_id', $each_courses->unique_id],
                ['like_type', 'like'],
            ];

            $likesCount = $this->like->getAllLikes($condition);

            $each_courses->likes = $likesCount->count();

            $each_courses->user;
        }

        $view = [
            'courses' => $courses,
            'user' => $user,
        ];

        return view('dashboard.view-courses', $view);
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function showCourses($id = null){
        //
        $condition = [
            ['unique_id', $id]
        ];
        $course = $this->course_model->getSingleCourse($condition);

        $course->views += 1;
        $course->save();

        //function that returns an array of users that likes this course and also the course like count
        $likes_array = $this->returnUserArrayForDislikes($course->unique_id);
        $course->likes = $likes_array['like_count'];
        $course->likes_user_array = $likes_array['like_user_array'];

        //function that returns an array of users that dislikes this course and also the course dislike count
        $dislike_array = $this->returnUsersArrayForLikes($course->unique_id);
        $course->dislikes = $dislike_array['dislike_count'];
        $course->dislike_user_array = $dislike_array['dislike_user_array'];

        $course->user;

        $course->price;

        $review_condition = [
            ['course_unique_id', $course->unique_id]
        ];
        $reviews = $this->review->getAllReviews($review_condition);
        $course->reviews = $reviews;
        foreach ($reviews as $each_review){
            $each_review->users;
        }

        $user_array_hold = $this->returnArrayForUsersSavedCourse($course->unique_id);
        $course->user_array_hold = $user_array_hold;

        $course_download_links = explode("++", $course->course_urls);
        $course->course_download_links = $course_download_links;

        $array_of_subscribers = $this->returnArrayForSubscribeUsers($course->user->unique_id);
        $course->array_of_subscribers = $array_of_subscribers;
        $course->courseEnrollment;
        $arrays = [];
        foreach ($course->courseEnrollment as $each_enrollment){
            array_push($arrays, $each_enrollment->user_enrolling);
        }
        $course->array_of_enrolled_users = $arrays;

        $conditions = [
            ['course_id',$course->unique_id],
        ];
        $enrolls = $this->courseEnrollment->getAllEnrolls($conditions);
        // return ['course'=>$course, 'enrolls'=> $enrolls];

        return view('dashboard.view_course', ['course'=>$course, 'enrolls'=> $enrolls]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $request->user();
        // return $user;

        try {
            if (!$request->isMethod('POST')) {
                throw new Exception('This is not a valid request.');
            }
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:40|',
                'category' => 'required|string',
                'caption' => 'required|string|max:100',
                'pricing' => 'required|string',
                'desc' => 'required|min:50',
                'url' => 'required',
                'cover_video' => 'required|string',
            ]);
            // return 'msg';
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status' => false]);
            }

            $title = $request->input('title');
            $category = $request->input('category');
            $caption = $request->input('caption');
            $pricing = $request->input('pricing');
            $description = $request->input('desc');
            $url = $request->input('url');
            $cover_img = $request->file('cover_img');
            $cover_video = $request->input('cover_video');
            $user_id = $user['unique_id'];

            $course = course_model::find($id);

            if ($request->file('cover_img')) {
                $validator = Validator::make($request->all(), [
                    'cover_img' => 'required|file|image|mimes:jpeg,png,gif|max:4048',
                ]);
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors(), 'status' => false]);
                }
                $img_name = $this->gen_file_name($user, $title, $cover_img);
                $upload_img = $cover_img->storeAs(
                    'public/course-img',
                    $img_name
                );
                $course->cover_image = $img_name;
            }

            $course->name = $title;
            $course->category_id = $category;
            $course->short_caption = $caption;
            $course->pricing = $pricing;
            $course->description = $description;
            $course->course_urls = $url;
            $course->intro_video = $cover_video;
            $updated = $course->save();


            if (!$updated) {
                throw new Exception($this->errorMsgs(14)['msg']);
            } else {
                $error = 'Course Updated!';
                return response()->json(["message" => $error, 'status' => true]);
            }
        } catch (Exception $e) {

            $error = $e->getMessage();
            $error = [
                'errors' => [$error],
            ];
            return response()->json(["errors" => $error, 'status' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    function handleValidations(array $data)
    {

        $validator = Validator::make($data, [
            'dataArray' => 'required|string'
        ]);

        return $validator;
    }

    public function activateCoursesStatus(Request $request)
    {
        try {

            $validation = $this->handleValidations($request->all());
            if ($validation->fails()) {
                return response()->json(['error_code' => 1, 'error_message' => $validation->messages()]);
            }

            $dataArray = explode('|', $request->dataArray);

            foreach ($dataArray as $eachDataArray) {

                //update the course status to confirmed
                $course = $this->course_model->selectSingleCourse($eachDataArray);
                $course->status = 'confirmed';
                $course->save();
            }
            return response()->json(['error_code' => 0, 'success_statement' => 'Selected Courses has been confirmed successfully']);
        } catch (Exception $exception) {

            $error = $exception->getMessage();
            return response()->json(['error_code' => 1, 'error_message' => ['general_error' => [$error]]]);
        }
    }
    /**
     * Function to soft delete courses.
     *
     * @param Request $request
     * @param string $id
     * @return void
     */
    public function soft_delete(Request $request, $id)
    {
        try {
            if (!$id) {
                throw new Exception($this->errorMsgs(15)['msg']);
            }
            $deleted = course_model::find($id)->delete();

            if (!$deleted) {
                throw new Exception($this->errorMsgs(14)['msg']);
            } else {
                $error = 'Course Deleted Successfully!';
                return response()->json(["message" => $error, 'status' => true]);
            }
        } catch (Exception $e) {

            $error = $e->getMessage();
            $error = [
                'errors' => [$error],
            ];
            return response()->json(["errors" => $error, 'status' => false]);
        }
    }

    public function viewExplore(){

        $condition = [
            ['status', 'confirmed']
        ];

        $course = $this->course_model->getAllCourse($condition);

        foreach ($course as $each_course){

            $each_course->user;

            $each_course->price;

            $each_course->category;

            $conditions = [
                ['course_unique_id', $each_course->unique_id ]
            ];
            $reviews = $this->review->getAllReviews($conditions);
            $each_course->reviews = $reviews;
            $each_course->count_review = $this->calculateRatings($reviews);

        }


        $condition = [
            ['status', 'live']
        ];

        $live_streams = $this->live_stream_model->get_all($condition);

        $view = [
            'course'=>$course,
            'live_streams'=>$live_streams
        ];

        return view('dashboard.explore', $view);
    }

    public function exploreCategory($unique_id = null){

        $conditions = [
            ['unique_id', $unique_id]
        ];
        $course_category_model = $this->course_category_model->getSingleCategories($conditions);

        $condition = [
            ['status', 'confirmed'],
            ['category_id', $unique_id]
        ];
        $course = $this->course_model->getAllCourse($condition);

        foreach ($course as $each_course){

            $each_course->user;

            $each_course->price;

            $each_course->category;

            $conditions = [
                ['course_unique_id', $each_course->unique_id ]
            ];
            $reviews = $this->review->getAllReviews($conditions);
            $each_course->reviews = $reviews;
            $each_course->count_review = $this->calculateRatings($reviews);

        }

        return view('dashboard.explore_categories', ['course'=>$course, 'course_category_model'=>$course_category_model]);
    }
}
