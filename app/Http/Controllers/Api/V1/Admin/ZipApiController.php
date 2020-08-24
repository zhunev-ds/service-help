<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreZipRequest;
use App\Http\Requests\UpdateZipRequest;
use App\Http\Resources\Admin\ZipResource;
use App\Zip;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ZipApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('zip_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ZipResource(Zip::all());
    }

    public function store(StoreZipRequest $request)
    {
        $zip = Zip::create($request->all());

        return (new ZipResource($zip))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Zip $zip)
    {
        abort_if(Gate::denies('zip_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ZipResource($zip);
    }

    public function update(UpdateZipRequest $request, Zip $zip)
    {
        $zip->update($request->all());

        return (new ZipResource($zip))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Zip $zip)
    {
        abort_if(Gate::denies('zip_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $zip->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
