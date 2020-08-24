<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\AnalysisWorkAii;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAnalysisWorkAiiRequest;
use App\Http\Requests\UpdateAnalysisWorkAiiRequest;
use App\Http\Resources\Admin\AnalysisWorkAiiResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AnalysisWorkAiisApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('analysis_work_aii_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AnalysisWorkAiiResource(AnalysisWorkAii::with(['quarter'])->get());
    }

    public function store(StoreAnalysisWorkAiiRequest $request)
    {
        $analysisWorkAii = AnalysisWorkAii::create($request->all());

        if ($request->input('diagnostic', false)) {
            $analysisWorkAii->addMedia(storage_path('tmp/uploads/' . $request->input('diagnostic')))->toMediaCollection('diagnostic');
        }

        return (new AnalysisWorkAiiResource($analysisWorkAii))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AnalysisWorkAii $analysisWorkAii)
    {
        abort_if(Gate::denies('analysis_work_aii_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AnalysisWorkAiiResource($analysisWorkAii->load(['quarter']));
    }

    public function update(UpdateAnalysisWorkAiiRequest $request, AnalysisWorkAii $analysisWorkAii)
    {
        $analysisWorkAii->update($request->all());

        if ($request->input('diagnostic', false)) {
            if (!$analysisWorkAii->diagnostic || $request->input('diagnostic') !== $analysisWorkAii->diagnostic->file_name) {
                if ($analysisWorkAii->diagnostic) {
                    $analysisWorkAii->diagnostic->delete();
                }

                $analysisWorkAii->addMedia(storage_path('tmp/uploads/' . $request->input('diagnostic')))->toMediaCollection('diagnostic');
            }
        } elseif ($analysisWorkAii->diagnostic) {
            $analysisWorkAii->diagnostic->delete();
        }

        return (new AnalysisWorkAiiResource($analysisWorkAii))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AnalysisWorkAii $analysisWorkAii)
    {
        abort_if(Gate::denies('analysis_work_aii_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $analysisWorkAii->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
