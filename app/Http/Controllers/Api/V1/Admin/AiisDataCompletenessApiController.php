<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\AiisDataCompleteness;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAiisDataCompletenessRequest;
use App\Http\Requests\UpdateAiisDataCompletenessRequest;
use App\Http\Resources\Admin\AiisDataCompletenessResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AiisDataCompletenessApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('aiis_data_completeness_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AiisDataCompletenessResource(AiisDataCompleteness::all());
    }

    public function store(StoreAiisDataCompletenessRequest $request)
    {
        $aiisDataCompleteness = AiisDataCompleteness::create($request->all());

        if ($request->input('file', false)) {
            $aiisDataCompleteness->addMedia(storage_path('tmp/uploads/' . $request->input('file')))->toMediaCollection('file');
        }

        return (new AiisDataCompletenessResource($aiisDataCompleteness))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AiisDataCompleteness $aiisDataCompleteness)
    {
        abort_if(Gate::denies('aiis_data_completeness_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AiisDataCompletenessResource($aiisDataCompleteness);
    }

    public function update(UpdateAiisDataCompletenessRequest $request, AiisDataCompleteness $aiisDataCompleteness)
    {
        $aiisDataCompleteness->update($request->all());

        if ($request->input('file', false)) {
            if (!$aiisDataCompleteness->file || $request->input('file') !== $aiisDataCompleteness->file->file_name) {
                $aiisDataCompleteness->addMedia(storage_path('tmp/uploads/' . $request->input('file')))->toMediaCollection('file');
            }
        } elseif ($aiisDataCompleteness->file) {
            $aiisDataCompleteness->file->delete();
        }

        return (new AiisDataCompletenessResource($aiisDataCompleteness))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AiisDataCompleteness $aiisDataCompleteness)
    {
        abort_if(Gate::denies('aiis_data_completeness_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aiisDataCompleteness->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
