<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreResultVisualUspdRequest;
use App\Http\Requests\UpdateResultVisualUspdRequest;
use App\Http\Resources\Admin\ResultVisualUspdResource;
use App\ResultVisualUspd;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResultVisualUspdApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('result_visual_uspd_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ResultVisualUspdResource(ResultVisualUspd::with(['quarter', 'location'])->get());
    }

    public function store(StoreResultVisualUspdRequest $request)
    {
        $resultVisualUspd = ResultVisualUspd::create($request->all());

        if ($request->input('photo', false)) {
            $resultVisualUspd->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        return (new ResultVisualUspdResource($resultVisualUspd))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ResultVisualUspd $resultVisualUspd)
    {
        abort_if(Gate::denies('result_visual_uspd_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ResultVisualUspdResource($resultVisualUspd->load(['quarter', 'location']));
    }

    public function update(UpdateResultVisualUspdRequest $request, ResultVisualUspd $resultVisualUspd)
    {
        $resultVisualUspd->update($request->all());

        if ($request->input('photo', false)) {
            if (!$resultVisualUspd->photo || $request->input('photo') !== $resultVisualUspd->photo->file_name) {
                if ($resultVisualUspd->photo) {
                    $resultVisualUspd->photo->delete();
                }

                $resultVisualUspd->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($resultVisualUspd->photo) {
            $resultVisualUspd->photo->delete();
        }

        return (new ResultVisualUspdResource($resultVisualUspd))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ResultVisualUspd $resultVisualUspd)
    {
        abort_if(Gate::denies('result_visual_uspd_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $resultVisualUspd->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
