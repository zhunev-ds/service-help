<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreResultVisualServerRequest;
use App\Http\Requests\UpdateResultVisualServerRequest;
use App\Http\Resources\Admin\ResultVisualServerResource;
use App\ResultVisualServer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResultVisualServerApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('result_visual_server_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ResultVisualServerResource(ResultVisualServer::with(['quarter'])->get());
    }

    public function store(StoreResultVisualServerRequest $request)
    {
        $resultVisualServer = ResultVisualServer::create($request->all());

        if ($request->input('photo', false)) {
            $resultVisualServer->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        return (new ResultVisualServerResource($resultVisualServer))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ResultVisualServer $resultVisualServer)
    {
        abort_if(Gate::denies('result_visual_server_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ResultVisualServerResource($resultVisualServer->load(['quarter']));
    }

    public function update(UpdateResultVisualServerRequest $request, ResultVisualServer $resultVisualServer)
    {
        $resultVisualServer->update($request->all());

        if ($request->input('photo', false)) {
            if (!$resultVisualServer->photo || $request->input('photo') !== $resultVisualServer->photo->file_name) {
                if ($resultVisualServer->photo) {
                    $resultVisualServer->photo->delete();
                }

                $resultVisualServer->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($resultVisualServer->photo) {
            $resultVisualServer->photo->delete();
        }

        return (new ResultVisualServerResource($resultVisualServer))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ResultVisualServer $resultVisualServer)
    {
        abort_if(Gate::denies('result_visual_server_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $resultVisualServer->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
