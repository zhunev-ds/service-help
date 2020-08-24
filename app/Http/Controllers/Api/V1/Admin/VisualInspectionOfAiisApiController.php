<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreVisualInspectionOfAiiRequest;
use App\Http\Requests\UpdateVisualInspectionOfAiiRequest;
use App\Http\Resources\Admin\VisualInspectionOfAiiResource;
use App\VisualInspectionOfAii;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VisualInspectionOfAiisApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('visual_inspection_of_aii_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VisualInspectionOfAiiResource(VisualInspectionOfAii::with(['quarter', 'point'])->get());
    }

    public function store(StoreVisualInspectionOfAiiRequest $request)
    {
        $visualInspectionOfAii = VisualInspectionOfAii::create($request->all());

        if ($request->input('photo', false)) {
            $visualInspectionOfAii->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        return (new VisualInspectionOfAiiResource($visualInspectionOfAii))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(VisualInspectionOfAii $visualInspectionOfAii)
    {
        abort_if(Gate::denies('visual_inspection_of_aii_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VisualInspectionOfAiiResource($visualInspectionOfAii->load(['quarter', 'point']));
    }

    public function update(UpdateVisualInspectionOfAiiRequest $request, VisualInspectionOfAii $visualInspectionOfAii)
    {
        $visualInspectionOfAii->update($request->all());

        if ($request->input('photo', false)) {
            if (!$visualInspectionOfAii->photo || $request->input('photo') !== $visualInspectionOfAii->photo->file_name) {
                if ($visualInspectionOfAii->photo) {
                    $visualInspectionOfAii->photo->delete();
                }

                $visualInspectionOfAii->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($visualInspectionOfAii->photo) {
            $visualInspectionOfAii->photo->delete();
        }

        return (new VisualInspectionOfAiiResource($visualInspectionOfAii))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(VisualInspectionOfAii $visualInspectionOfAii)
    {
        abort_if(Gate::denies('visual_inspection_of_aii_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $visualInspectionOfAii->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
