<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreUspdAnalysiRequest;
use App\Http\Requests\UpdateUspdAnalysiRequest;
use App\Http\Resources\Admin\UspdAnalysiResource;
use App\UspdAnalysi;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UspdAnalysisApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('uspd_analysi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UspdAnalysiResource(UspdAnalysi::with(['quarter', 'location'])->get());
    }

    public function store(StoreUspdAnalysiRequest $request)
    {
        $uspdAnalysi = UspdAnalysi::create($request->all());

        if ($request->input('files', false)) {
            $uspdAnalysi->addMedia(storage_path('tmp/uploads/' . $request->input('files')))->toMediaCollection('files');
        }

        return (new UspdAnalysiResource($uspdAnalysi))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(UspdAnalysi $uspdAnalysi)
    {
        abort_if(Gate::denies('uspd_analysi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UspdAnalysiResource($uspdAnalysi->load(['quarter', 'location']));
    }

    public function update(UpdateUspdAnalysiRequest $request, UspdAnalysi $uspdAnalysi)
    {
        $uspdAnalysi->update($request->all());

        if ($request->input('files', false)) {
            if (!$uspdAnalysi->files || $request->input('files') !== $uspdAnalysi->files->file_name) {
                if ($uspdAnalysi->files) {
                    $uspdAnalysi->files->delete();
                }

                $uspdAnalysi->addMedia(storage_path('tmp/uploads/' . $request->input('files')))->toMediaCollection('files');
            }
        } elseif ($uspdAnalysi->files) {
            $uspdAnalysi->files->delete();
        }

        return (new UspdAnalysiResource($uspdAnalysi))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(UspdAnalysi $uspdAnalysi)
    {
        abort_if(Gate::denies('uspd_analysi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $uspdAnalysi->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
