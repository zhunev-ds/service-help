<?php

namespace App\Http\Controllers\Admin;

use App\AiisDataCompleteness;
use App\AnalysisWorkAii;
use App\Http\Controllers\Controller;
use App\Location;
use App\MainWork;
use App\MonitoringStatusOfMd;
use App\Mpoint;
use App\Report;
use App\ResultVisualServer;
use App\ResultVisualUspd;
use App\ServerAnalysi;
use App\UspdAnalysi;
use App\VisualInspectionOfAii;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Traits\MediaUploadingTrait;

class ReportUController extends Controller
{
    use MediaUploadingTrait;
    
    public function index(Request $request)
    {
        $reports = Report::orderBy('id', 'desc')->get();
        $mainWorks = MainWork::orderBy('id', 'asc')->get();
        $locations = Location::orderBy('id', 'asc')->get();
        $mpoints = Mpoint::orderBy('id', 'asc')->get();
        $visualInspections = VisualInspectionOfAii::orderBy('id', 'asc')->get();
        $visualServers = ResultVisualServer::orderBy('id', 'asc')->get();
        $visualUspd = ResultVisualUspd::orderBy('id', 'asc')->get();
        $aiisAnalysis = MonitoringStatusOfMd::orderBy('id', 'asc')->get();
        $serverAnalysis = ServerAnalysi::orderBy('id', 'asc')->get();
        $uspdAnalysis = UspdAnalysi::orderBy('id', 'asc')->get();
        $aiisKUEAnalysis = AnalysisWorkAii::orderBy('id', 'asc')->get();
        return view('admin.reportUs.index', compact('reports', 'mainWorks', 'locations', 'mpoints', 'visualInspections', 'visualServers', 'visualUspd', 'aiisAnalysis', 'serverAnalysis', 'uspdAnalysis', 'aiisKUEAnalysis'));
    }
}
