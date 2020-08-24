<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMpointRequest;
use App\Http\Requests\UpdateMpointRequest;
use App\Http\Resources\Admin\MpointResource;
use App\Mpoint;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MpointApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('mpoint_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MpointResource(Mpoint::with(['location'])->get());
    }

    public function store(StoreMpointRequest $request)
    {
        $mpoint = Mpoint::create($request->all());

        return (new MpointResource($mpoint))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Mpoint $mpoint)
    {
        abort_if(Gate::denies('mpoint_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MpointResource($mpoint->load(['location']));
    }

    public function update(UpdateMpointRequest $request, Mpoint $mpoint)
    {
        $mpoint->update($request->all());

        return (new MpointResource($mpoint))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Mpoint $mpoint)
    {
        abort_if(Gate::denies('mpoint_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mpoint->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
