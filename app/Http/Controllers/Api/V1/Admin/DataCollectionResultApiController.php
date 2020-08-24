<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\DataCollectionResult;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreDataCollectionResultRequest;
use App\Http\Requests\UpdateDataCollectionResultRequest;
use App\Http\Resources\Admin\DataCollectionResultResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DataCollectionResultApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('data_collection_result_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DataCollectionResultResource(DataCollectionResult::all());
    }

    public function store(StoreDataCollectionResultRequest $request)
    {
        $dataCollectionResult = DataCollectionResult::create($request->all());

        if ($request->input('files', false)) {
            $dataCollectionResult->addMedia(storage_path('tmp/uploads/' . $request->input('files')))->toMediaCollection('files');
        }

        return (new DataCollectionResultResource($dataCollectionResult))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DataCollectionResult $dataCollectionResult)
    {
        abort_if(Gate::denies('data_collection_result_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DataCollectionResultResource($dataCollectionResult);
    }

    public function update(UpdateDataCollectionResultRequest $request, DataCollectionResult $dataCollectionResult)
    {
        $dataCollectionResult->update($request->all());

        if ($request->input('files', false)) {
            if (!$dataCollectionResult->files || $request->input('files') !== $dataCollectionResult->files->file_name) {
                if ($dataCollectionResult->files) {
                    $dataCollectionResult->files->delete();
                }

                $dataCollectionResult->addMedia(storage_path('tmp/uploads/' . $request->input('files')))->toMediaCollection('files');
            }
        } elseif ($dataCollectionResult->files) {
            $dataCollectionResult->files->delete();
        }

        return (new DataCollectionResultResource($dataCollectionResult))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DataCollectionResult $dataCollectionResult)
    {
        abort_if(Gate::denies('data_collection_result_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataCollectionResult->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
