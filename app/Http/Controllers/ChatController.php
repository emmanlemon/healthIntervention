<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;
use Auth;
use DB;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->role === 1){
            $chat = Chat::create([
                'receiver_id' => $request->input('receiver_id'),
                'sender_id' => $request->input('sender_id'),
                  'message' => $request->input('message')
            ]);
            return redirect()->back()->with('success', 'Your Message Send Successfully');
        }else{
            $chat = Chat::create([
                'receiver_id' => $request->input('receiver_id'),
                'sender_id' => $request->input('sender_id'),
                  'message' => $request->input('message')
            ]);
            return redirect()->back()->with('success', 'Your Message Send Successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = DB::table('users')->where('id', $id)->first();   
        $column = [
            'chats.id as id',
            'message as message',
            'chats.created_at as created_at',
            'users.name as name',
            'users.role as role',
            'users.profile_photo_path as profile',
        ];

        $chat = DB::table('chats')
        ->leftJoin('users' , 'users.id' , 'chats.sender_id')
        ->select($column)
        ->where('sender_id',  Auth::id())
        ->where('receiver_id',  $user->id)
        ->orWhere('receiver_id',  Auth::id())
        ->where('sender_id', $user->id)
        ->get();

        // $chat = DB::Table('chats as chat')
        // ->leftjoin('chats AS m2', function($join) {
        //     $join->on('chat.sender_id', '=', 'm2.sender_id');
        //     $join->on('chat.id', '<', 'm2.id');
        // })->whereNull('m2.id')->get();

        return view('admin.inbox.show', compact('chat' , 'user'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Chat::where('id', $id)->delete();
        return back()->with('delete', ' Your Message Deleted Successfully'); 
    }
}
