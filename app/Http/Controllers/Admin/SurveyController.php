<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\DB;
use Auth;


class SurveyController extends Controller
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
        $user = Auth()->user()->id;
        DB::table('surveys')->select(array('id' => $request));
        $survey = Survey::create($request->except('questions' , '_token'));
        $survey->questions()->createMany($request->questions);
        return back()->with('success', 'New Survey Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
        if (Auth::user()->role == 1) {
            $column = [
                'users.name as name',
                'questions.id as id',
                'questions.question as question',
                'questions.survey_id as survey_id',
                'surveys.title as title',
                'surveys.created_at as created_at',
                'surveys.description as description'
            ];
            $surveys = DB::table('surveys')
            ->select($column)
            ->leftjoin('questions', 'questions.survey_id', 'surveys.id')
            ->leftjoin('users', 'users.id', 'surveys.user_id')
            ->where('surveys.id', $survey->id)->get();
            $surveyQuestion = $survey->load('questions');
            return view('admin.survey.show', compact('surveys', 'surveyQuestion'));
        }else{
            $column = [
                'users.name as name',
                'questions.id as id',
                'questions.question as question',
                'questions.survey_id as survey_id',
                'surveys.title as title',
                'surveys.created_at as created_at',
                'surveys.description as description'
            ];
            $surveys = DB::table('surveys')
            ->select($column)
            ->leftjoin('questions', 'questions.survey_id', 'surveys.id')
            ->leftjoin('users', 'users.id', 'surveys.user_id')
            ->where('surveys.id', $survey->id)->get();
            $surveyQuestion = $survey->load('questions');
            return view('student.questionnaire.show', compact('surveys', 'surveyQuestion'));
        }
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
    public function destroy(Survey $survey)
    {
        $survey->delete();
        return back()->with('delete', ' Survey Deleted Successfully'); 
    }

    public function viewResult(Survey $survey)
    {
        $column = [
            'questions.question as question',
            'answers.survey_id as survey_id',
            'answers.question_id as question_id',
            DB::raw('answers.answer AS answer'),
            DB::raw('COUNT(answers.answer) AS answerCount'),
        ];

        $surveyResponse = DB::table('answers')
        ->leftJoin('users' , 'users.id' , 'answers.user_id')
        ->leftJoin('questions' , 'questions.id' , 'answers.question_id')
        ->where('answers.survey_id', $survey->id)
        ->get()->groupBy(function($data) {
            return $data->name;
        });
        $survey = $survey->load('questions.answers.responses');

        $answer = DB::table('answers')
        ->select($column)
        ->leftJoin('questions' , 'questions.id' , 'answers.question_id')
        ->groupBy('answers.question_id')
        ->groupBy('answers.answer')
        ->where('answers.survey_id', $survey->id)
        ->get()->groupBy(function($data) {
            return $data->question;
        });

        return view('admin.survey.showResult', compact('survey' , 'surveyResponse' , 'answer'));
    }

    public function editQuestion(Request $request , $id)
    {
        $survey = Survey::findOrFail($id);
        $survey->title = $request->title;
        $survey->description = $request->description;
        $survey->user_id = Auth::user()->id;
        foreach ($request->questionId as $key => $value) {
            $data = [             
                'question' => $request->question[$key],
            ];         
            Question::where('id',$request->questionId[$key])
            ->update($data); 
        }
        $survey->save();
        return back()->with('update', 'Survey Update Successfully');
    }
}
