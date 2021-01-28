<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    function __construct(User $user)
    {
        $this->middleware('auth');
        $this->user = $user;
    }

    public function showAllStudents(){

        $condition = [
            ['is_blocked', 'no'],
            ['user_type', 'student'],
        ];
        $all_students = $this->user->getAllUsers($condition);

        $condition = [
            ['is_blocked', 'no'],
            ['user_type', 'student'],
            ['status', 'active'],
        ];
        $active_students = $this->user->getAllUsers($condition);

        $condition = [
            ['is_blocked', 'no'],
            ['user_type', 'student'],
            ['status', 'in-active'],
        ];
        $inactive_students = $this->user->getAllUsers($condition);

        $data = ['all_students'=>$all_students, 'active_students'=>$active_students, 'inactive_students'=>$inactive_students];

        return view('dashboard.all_students', $data);

    }

    public function showAllInstructor(){

        $condition = [
            ['is_blocked', 'no'],
            ['user_type', 'teacher'],
        ];
        $all_teacher= $this->user->getAllUsers($condition);

        $condition = [
            ['is_blocked', 'no'],
            ['user_type', 'teacher'],
            ['status', 'active'],
        ];
        $active_teacher = $this->user->getAllUsers($condition);

        $condition = [
            ['is_blocked', 'no'],
            ['user_type', 'teacher'],
            ['status', 'in-active'],
        ];
        $inactive_teacher = $this->user->getAllUsers($condition);

        $data = ['all_teacher'=>$all_teacher, 'active_teacher'=>$active_teacher, 'inactive_teacher'=>$inactive_teacher];

        return view('dashboard.all_instructors', $data);

    }
}
