<?php

namespace App\Http\Controllers\Admin;

use App\AiisDataCompleteness;
use App\AiisDocumentationUpdate;
use App\AiisWithOremRequirement;
use App\DataCollectionResult;
use App\Task;

class HomeController
{
    public function index()
    {
        $events = Task::whereNotNull('due_date')->get();
        $tasks = Task::orderBy('due_date', 'desc')->where('status_id', "3")->take(30)->get();
        $orems = AiisWithOremRequirement::orderBy('data', 'desc')->take(1)->get();
        $aiisDatas = AiisDataCompleteness::orderBy('date', 'desc')->take(3)->get();
        $year = date('Y')+1;
        $year2 = date('Y')+2;
        $year3 = date('Y')+3;
        $aiisUpdates = AiisDocumentationUpdate::orderBy('id', "asc")->where('year', "$year")->take(5)->get();
        $aiisUpdates2 = AiisDocumentationUpdate::orderBy('id', "asc")->where('year', "$year2")->take(5)->get();
        $aiisUpdates3 = AiisDocumentationUpdate::orderBy('id', "asc")->where('year', "$year3")->take(5)->get();
        $dataCollectionResults = DataCollectionResult::orderBy('id', "desc")->get();
        $dataCollectionResultsStatus = true;
        foreach ($dataCollectionResults as $dataCollectionResult){
            if ($dataCollectionResult->considered_metrological == "false") {
                $dataCollectionResultsStatus = false;
                break;
            }
        }
        $yearNow = date('Y');
        $yearNowBackOne = date('Y')-1;
        $yearNowBackTwo = date('Y')-2;
        $AllTasksNow = Task::orderBy('due_date', 'desc')->whereYear('due_date', '=', $yearNow)->count();
        $AllTasksBackOne = Task::orderBy('due_date', 'desc')->whereYear('due_date', '=', $yearNowBackOne)->count();
        $AllTasksBackTwo = Task::orderBy('due_date', 'desc')->whereYear('due_date', '=', $yearNowBackTwo)->count();
        $AllDepartureNow = Task::orderBy('due_date', 'desc')->whereYear('due_date', '=', $yearNow)->whereHas('tags', function ($query) {$query->where('task_tag_id', 1);})->count();
        $AllDepartureBackOne = Task::orderBy('due_date', 'desc')->whereYear('due_date', '=', $yearNowBackOne)->whereHas('tags', function ($query) {$query->where('task_tag_id', 1);})->count();
        $AllDepartureBackTwo = Task::orderBy('due_date', 'desc')->whereYear('due_date', '=', $yearNowBackTwo)->whereHas('tags', function ($query) {$query->where('task_tag_id', 1);})->count();

        return view('home', compact('events', 'tasks', 'orems', 'aiisDatas', 'aiisUpdates', 'aiisUpdates2', 'aiisUpdates3', 'dataCollectionResults', 'dataCollectionResultsStatus', 'AllTasksNow', 'AllTasksBackOne', 'AllTasksBackTwo', 'AllDepartureNow', 'AllDepartureBackOne', 'AllDepartureBackTwo'));
    }
}
