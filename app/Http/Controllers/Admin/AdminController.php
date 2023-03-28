<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{
    public function index(){
        $survey = DB::table('surveys')->count();
        $student = DB::table('users')->where('role' , 0)->count();

        $userChat = DB::table('chats AS chat')
            ->leftjoin('chats AS m2', function($join) {
                $join->on('chat.sender_id', '=', 'm2.sender_id');
                $join->on('chat.id', '<', 'm2.id');
            })->whereNull('m2.id')
            ->leftJoin('users', 'users.id' ,'chat.sender_id')
            ->where('users.role' , 0)->count();
            // $survey = DB::table('surveys')->orderBy('created_at', 'desc')->get();

            $surveyLatest = DB::table('surveys')->latest()->get();
            $surveyResponse = DB::table('answers')
            ->leftJoin('users' , 'users.id' , 'answers.user_id')
            ->leftJoin('questions' , 'questions.id' , 'answers.question_id')
            // ->where("answers.".$surveyLatest[0]->id, $surveyLatest[0]->id)
            ->get()->groupBy(function($data) {
                return $data->name;
            });
        return view('admin.dashboard' , compact('survey' , 'student' , 'userChat' , 'surveyLatest' , 'surveyResponse'));
    }
}
