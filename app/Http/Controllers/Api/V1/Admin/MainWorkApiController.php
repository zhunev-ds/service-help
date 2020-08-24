<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMainWorkRequest;
use App\Http\Requests\UpdateMainWorkRequest;
use App\Http\Resources\Admin\MainWorkResource;
use App\MainWork;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MainWorkApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('main_work_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MainWorkResource(MainWork::with(['quarter'])->get());
    }

    public function store(StoreMainWorkRequest $request)
    {
        $mainWork = MainWork::create($request->all());

        if ($request->input('files', false)) {
            $mainWork->addMedia(storage_path('tmp/uploads/' . $request->input('files')))->toMediaCollection('files');
        }

        return (new MainWorkResource($mainWork))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MainWork $mainWork)
    {
        abort_if(Gate::denies('main_work_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MainWorkResource($mainWork->load(['quarter']));
    }

    public function update(UpdateMainWorkRequest $request, MainWork $mainWork)
    {
        $mainWork->update($request->all());

        if ($request->input('files', false)) {
            if (!$mainWork->files || $request->input('files') !== $mainWork->files->file_name) {
                if ($mainWork->files) {
                    $mainWork->files->delete();
                }

                $mainWork->addMedia(storage_path('tmp/uploads/' . $request->input('files')))->toMediaCollection('files');
            }
        } elseif ($mainWork->files) {
            $mainWork->files->delete();
        }

        return (new MainWorkResource($mainWork))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MainWork $mainWork)
    {
        abort_if(Gate::denies('main_work_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mainWork->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
