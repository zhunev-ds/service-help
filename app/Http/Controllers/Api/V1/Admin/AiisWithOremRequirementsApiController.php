<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\AiisWithOremRequirement;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAiisWithOremRequirementRequest;
use App\Http\Requests\UpdateAiisWithOremRequirementRequest;
use App\Http\Resources\Admin\AiisWithOremRequirementResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AiisWithOremRequirementsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('aiis_with_orem_requirement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AiisWithOremRequirementResource(AiisWithOremRequirement::all());
    }

    public function store(StoreAiisWithOremRequirementRequest $request)
    {
        $aiisWithOremRequirement = AiisWithOremRequirement::create($request->all());

        return (new AiisWithOremRequirementResource($aiisWithOremRequirement))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AiisWithOremRequirement $aiisWithOremRequirement)
    {
        abort_if(Gate::denies('aiis_with_orem_requirement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AiisWithOremRequirementResource($aiisWithOremRequirement);
    }

    public function update(UpdateAiisWithOremRequirementRequest $request, AiisWithOremRequirement $aiisWithOremRequirement)
    {
        $aiisWithOremRequirement->update($request->all());

        return (new AiisWithOremRequirementResource($aiisWithOremRequirement))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AiisWithOremRequirement $aiisWithOremRequirement)
    {
        abort_if(Gate::denies('aiis_with_orem_requirement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aiisWithOremRequirement->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
