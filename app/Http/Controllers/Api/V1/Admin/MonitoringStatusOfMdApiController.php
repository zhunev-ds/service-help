<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMonitoringStatusOfMdRequest;
use App\Http\Requests\UpdateMonitoringStatusOfMdRequest;
use App\Http\Resources\Admin\MonitoringStatusOfMdResource;
use App\MonitoringStatusOfMd;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MonitoringStatusOfMdApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('monitoring_status_of_md_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MonitoringStatusOfMdResource(MonitoringStatusOfMd::with(['quarter', 'point'])->get());
    }

    public function store(StoreMonitoringStatusOfMdRequest $request)
    {
        $monitoringStatusOfMd = MonitoringStatusOfMd::create($request->all());

        if ($request->input('files', false)) {
            $monitoringStatusOfMd->addMedia(storage_path('tmp/uploads/' . $request->input('files')))->toMediaCollection('files');
        }

        return (new MonitoringStatusOfMdResource($monitoringStatusOfMd))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MonitoringStatusOfMd $monitoringStatusOfMd)
    {
        abort_if(Gate::denies('monitoring_status_of_md_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MonitoringStatusOfMdResource($monitoringStatusOfMd->load(['quarter', 'point']));
    }

    public function update(UpdateMonitoringStatusOfMdRequest $request, MonitoringStatusOfMd $monitoringStatusOfMd)
    {
        $monitoringStatusOfMd->update($request->all());

        if ($request->input('files', false)) {
            if (!$monitoringStatusOfMd->files || $request->input('files') !== $monitoringStatusOfMd->files->file_name) {
                if ($monitoringStatusOfMd->files) {
                    $monitoringStatusOfMd->files->delete();
                }

                $monitoringStatusOfMd->addMedia(storage_path('tmp/uploads/' . $request->input('files')))->toMediaCollection('files');
            }
        } elseif ($monitoringStatusOfMd->files) {
            $monitoringStatusOfMd->files->delete();
        }

        return (new MonitoringStatusOfMdResource($monitoringStatusOfMd))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MonitoringStatusOfMd $monitoringStatusOfMd)
    {
        abort_if(Gate::denies('monitoring_status_of_md_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $monitoringStatusOfMd->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
