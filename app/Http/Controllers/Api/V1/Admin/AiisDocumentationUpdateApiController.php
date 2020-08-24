<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\AiisDocumentationUpdate;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAiisDocumentationUpdateRequest;
use App\Http\Requests\UpdateAiisDocumentationUpdateRequest;
use App\Http\Resources\Admin\AiisDocumentationUpdateResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AiisDocumentationUpdateApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('aiis_documentation_update_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AiisDocumentationUpdateResource(AiisDocumentationUpdate::all());
    }

    public function store(StoreAiisDocumentationUpdateRequest $request)
    {
        $aiisDocumentationUpdate = AiisDocumentationUpdate::create($request->all());

        if ($request->input('verification_si', false)) {
            $aiisDocumentationUpdate->addMedia(storage_path('tmp/uploads/' . $request->input('verification_si')))->toMediaCollection('verification_si');
        }

        if ($request->input('verification_aiis', false)) {
            $aiisDocumentationUpdate->addMedia(storage_path('tmp/uploads/' . $request->input('verification_aiis')))->toMediaCollection('verification_aiis');
        }

        return (new AiisDocumentationUpdateResource($aiisDocumentationUpdate))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AiisDocumentationUpdate $aiisDocumentationUpdate)
    {
        abort_if(Gate::denies('aiis_documentation_update_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AiisDocumentationUpdateResource($aiisDocumentationUpdate);
    }

    public function update(UpdateAiisDocumentationUpdateRequest $request, AiisDocumentationUpdate $aiisDocumentationUpdate)
    {
        $aiisDocumentationUpdate->update($request->all());

        if ($request->input('verification_si', false)) {
            if (!$aiisDocumentationUpdate->verification_si || $request->input('verification_si') !== $aiisDocumentationUpdate->verification_si->file_name) {
                if ($aiisDocumentationUpdate->verification_si) {
                    $aiisDocumentationUpdate->verification_si->delete();
                }

                $aiisDocumentationUpdate->addMedia(storage_path('tmp/uploads/' . $request->input('verification_si')))->toMediaCollection('verification_si');
            }
        } elseif ($aiisDocumentationUpdate->verification_si) {
            $aiisDocumentationUpdate->verification_si->delete();
        }

        if ($request->input('verification_aiis', false)) {
            if (!$aiisDocumentationUpdate->verification_aiis || $request->input('verification_aiis') !== $aiisDocumentationUpdate->verification_aiis->file_name) {
                if ($aiisDocumentationUpdate->verification_aiis) {
                    $aiisDocumentationUpdate->verification_aiis->delete();
                }

                $aiisDocumentationUpdate->addMedia(storage_path('tmp/uploads/' . $request->input('verification_aiis')))->toMediaCollection('verification_aiis');
            }
        } elseif ($aiisDocumentationUpdate->verification_aiis) {
            $aiisDocumentationUpdate->verification_aiis->delete();
        }

        return (new AiisDocumentationUpdateResource($aiisDocumentationUpdate))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AiisDocumentationUpdate $aiisDocumentationUpdate)
    {
        abort_if(Gate::denies('aiis_documentation_update_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aiisDocumentationUpdate->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
