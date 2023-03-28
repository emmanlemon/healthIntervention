<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use DB;

class PrintController extends Controller
{
    public function printSurvey($printId){
    $column = [
        'users.name as name',
        'questions.id as id',
        'questions.question as question',
        'questions.survey_id as survey_id',
        'surveys.title as title',
        'surveys.created_at as created_at',
        'surveys.description as description'
    ];
    $printSurvey = DB::table('surveys')
    ->select($column)
    ->leftjoin('questions', 'questions.survey_id', 'surveys.id')
    ->leftjoin('users', 'users.id', 'surveys.user_id')
    ->where('surveys.id', $printId)->get();
    return view('components.organism.printSurvey' , compact('printSurvey'));
    }

    public function printSurveyResult(Survey $survey){
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

        return view('components.organism.printSurveyResult', compact('survey' , 'surveyResponse' , 'answer'));
    }

    public function printSurveyUserAnswer(Survey $survey){
        $survey = $survey->load('questions.answers');
        dd($survey);
        // $column = [
        //     'questions.question as question',
        //     'answers.survey_id as survey_id',
        //     'answers.question_id as question_id',
        //     DB::raw('answers.answer AS answer'),
        //     DB::raw('COUNT(answers.answer) AS answerCount'),
        // ];

        // $surveyResponse = DB::table('answers')
        // ->leftJoin('users' , 'users.id' , 'answers.user_id')
        // ->leftJoin('questions' , 'questions.id' , 'answers.question_id')
        // ->where('answers.survey_id', $survey->id)
        // ->get()->groupBy(function($data) {
        //     return $data->name;
        // });;
        // $survey = $survey->load('questions.answers.responses');

        // $answer = DB::table('answers')
        // ->select($column)
        // ->leftJoin('questions' , 'questions.id' , 'answers.question_id')
        // ->groupBy('answers.question_id')
        // ->groupBy('answers.answer')
        // ->where('answers.survey_id', $survey->id)
        // ->get()->groupBy(function($data) {
        //     return $data->question;
        // });

        // return view('components.organism.printAnswerUser', compact('survey' , 'surveyResponse' , 'answer'));
    }

}
