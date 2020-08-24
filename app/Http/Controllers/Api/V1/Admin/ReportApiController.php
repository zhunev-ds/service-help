<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Http\Resources\Admin\ReportResource;
use App\Report;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReportApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReportResource(Report::with(['responsible', 'brigades'])->get());
    }

    public function store(StoreReportRequest $request)
    {
        $report = Report::create($request->all());
        $report->brigades()->sync($request->input('brigades', []));

        return (new ReportResource($report))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Report $report)
    {
        abort_if(Gate::denies('report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReportResource($report->load(['responsible', 'brigades']));
    }

    public function update(UpdateReportRequest $request, Report $report)
    {
        $report->update($request->all());
        $report->brigades()->sync($request->input('brigades', []));

        return (new ReportResource($report))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Report $report)
    {
        abort_if(Gate::denies('report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $report->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
