<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreServerAnalysiRequest;
use App\Http\Requests\UpdateServerAnalysiRequest;
use App\Http\Resources\Admin\ServerAnalysiResource;
use App\ServerAnalysi;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ServerAnalysisApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('server_analysi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ServerAnalysiResource(ServerAnalysi::with(['quarter'])->get());
    }

    public function store(StoreServerAnalysiRequest $request)
    {
        $serverAnalysi = ServerAnalysi::create($request->all());

        if ($request->input('files', false)) {
            $serverAnalysi->addMedia(storage_path('tmp/uploads/' . $request->input('files')))->toMediaCollection('files');
        }

        return (new ServerAnalysiResource($serverAnalysi))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ServerAnalysi $serverAnalysi)
    {
        abort_if(Gate::denies('server_analysi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ServerAnalysiResource($serverAnalysi->load(['quarter']));
    }

    public function update(UpdateServerAnalysiRequest $request, ServerAnalysi $serverAnalysi)
    {
        $serverAnalysi->update($request->all());

        if ($request->input('files', false)) {
            if (!$serverAnalysi->files || $request->input('files') !== $serverAnalysi->files->file_name) {
                if ($serverAnalysi->files) {
                    $serverAnalysi->files->delete();
                }

                $serverAnalysi->addMedia(storage_path('tmp/uploads/' . $request->input('files')))->toMediaCollection('files');
            }
        } elseif ($serverAnalysi->files) {
            $serverAnalysi->files->delete();
        }

        return (new ServerAnalysiResource($serverAnalysi))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ServerAnalysi $serverAnalysi)
    {
        abort_if(Gate::denies('server_analysi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $serverAnalysi->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
