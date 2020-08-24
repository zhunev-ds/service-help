<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreProposalRequest;
use App\Http\Requests\UpdateProposalRequest;
use App\Http\Resources\Admin\ProposalResource;
use App\Proposal;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProposalsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('proposal_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProposalResource(Proposal::all());
    }

    public function store(StoreProposalRequest $request)
    {
        $proposal = Proposal::create($request->all());

        if ($request->input('files', false)) {
            $proposal->addMedia(storage_path('tmp/uploads/' . $request->input('files')))->toMediaCollection('files');
        }

        return (new ProposalResource($proposal))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Proposal $proposal)
    {
        abort_if(Gate::denies('proposal_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProposalResource($proposal);
    }

    public function update(UpdateProposalRequest $request, Proposal $proposal)
    {
        $proposal->update($request->all());

        if ($request->input('files', false)) {
            if (!$proposal->files || $request->input('files') !== $proposal->files->file_name) {
                $proposal->addMedia(storage_path('tmp/uploads/' . $request->input('files')))->toMediaCollection('files');
            }
        } elseif ($proposal->files) {
            $proposal->files->delete();
        }

        return (new ProposalResource($proposal))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Proposal $proposal)
    {
        abort_if(Gate::denies('proposal_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $proposal->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
