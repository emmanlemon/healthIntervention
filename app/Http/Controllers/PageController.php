<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;
use Auth;
use DB;

class PageController extends Controller
{
    public function index($pages){
        $role = Auth::user()->role;
        if($role == "0")
        {
            $column = [
                'chats.id as id',
                'message as message',
                'chats.created_at as created_at',
                'users.name as name',
                'users.role as role',
                'users.profile_photo_path as profile',
            ];

            $user = Auth::user()->id;
            $admin = 1;

            $admin = DB::table('users')
            ->where('users.role' , 1)
            ->get();

            $chat = DB::table('chats')
            ->select($column)
            ->leftJoin('users', 'users.id' , 'chats.sender_id')
            ->where('sender_id', 'users.role')
            ->orWhere('receiver_id', Auth::user()->id)
            ->orWhere('receiver_id', 'users.role')
            ->orWhere('sender_id', Auth::user()->id)
            ->get();
            
            return view('student.'.$pages.'.index' , compact('admin', 'chat'));
        }
        else
        {
            $student = DB::table('users')->where('role', 0)->get();
            $column = [
                'chat.sender_id',
                'chat.message', 
                'chat.created_at',
                'users.name as name',
                'users.profile_photo_path as profile',
            ];

            $userChat = DB::table('chats AS chat')
            ->leftjoin('chats AS m2', function($join) {
                $join->on('chat.sender_id', '=', 'm2.sender_id');
                $join->on('chat.id', '<', 'm2.id');
            })->whereNull('m2.id')
            ->select($column)
            ->leftJoin('users', 'users.id' ,'chat.sender_id')
            ->where('users.role' , 0)
            ->orderBy('chat.created_at', 'asc')->get();

            return view('admin.'.$pages.'.index', compact('student' , 'userChat'));
        }
    }
}
