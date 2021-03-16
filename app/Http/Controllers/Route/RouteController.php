<?php

namespace App\Http\Controllers\Route;

use App\course_model;
use App\Http\Controllers\Controller;
use App\Model\AppSettings;
use App\Model\BlogModel;
use App\Model\TestimonyModel;
use App\Traits\SendMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RouteController extends Controller
{
    //
    use SendMail;
    function __construct(
        User $user, TestimonyModel $testimonyModel, course_model $course_model, AppSettings $appSettings, BlogModel $blogModel
    ){
        $this->user = $user;
        $this->testimonyModel = $testimonyModel;
        $this->course_model = $course_model;
        $this->appSettings = $appSettings;
        $this->blogModel = $blogModel;
    }

    public function aboutUsPage(){
        $query = [
            ['status', 'active'],
            ['user_type', 'teacher'],
            ['yearly_subscription_status', 'yes'],
        ];
        $instructors = $this->user->getAllUsers($query);

        $testimonys = $this->testimonyModel->getAllTestimony();

        $view = [
            'instructors'=>$instructors,
            'testimonys'=>$testimonys,
            'instructors_count'=>$this->user->getAllUsers([
                ['status', 'active'],
                ['user_type', 'teacher'],
            ]),
            'student_count'=>$this->user->getAllUsers([
                ['status', 'active'],
                ['user_type', 'student'],
            ]),
            'course_count'=>$this->course_model->getAllCourse([
                ['deleted_at', null],
            ]),
        ];
        return view('front-end.about', $view);
    }

    public function contactUsPage(){
        $appSettings = $this->appSettings->getSingleModel();
        $view = [
            'appSettings'=>$appSettings,
        ];
        return view('front-end.contact', $view);
    }

    public function faqPage(){
        return view('front-end.faq');
    }

    public function blogPage(){
        $blogs = $this->blogModel->getAllBlogPost([
            ['status', 'confirm'],
        ]);
        return view('front-end.blog', ['blogs'=>$blogs]);
    }

    public function howItWorksPage(){
        return view('front-end.how-it-works');
    }

    protected function Validator($request){

        $this->validator = Validator::make($request->all(), [
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
    }

    public function contactUsMail(Request $request){
        // full_name email phone subject message
        $data = $request->all();

        try {
            $this->Validator($request); //validate fields

            $adminEmail = $this->appSettings->getSingleModel();

            $this->contactUsMailSend('Notification', $data['subject'], $data['phone'],  $data['email'], $data['full_name'], $data['message'], env('APP_NAME'), $this->base_url, $adminEmail->company_email_2);

            return redirect('/contact')->with('success_message', 'Mail Was Sent Successfully');

        } catch (Exception $exception) {

            $errorsArray = $exception->getMessage();
            return  redirect('contact')->with('error_message', $errorsArray);
        }
    }
}
