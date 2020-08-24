<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyZipRequest;
use App\Http\Requests\StoreZipRequest;
use App\Http\Requests\UpdateZipRequest;
use App\Zip;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ZipController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('zip_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Zip::query()->select(sprintf('%s.*', (new Zip)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'zip_show';
                $editGate      = 'zip_edit';
                $deleteGate    = 'zip_delete';
                $crudRoutePart = 'zips';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('count', function ($row) {
                return $row->count ? $row->count : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.zips.index');
    }

    public function create()
    {
        abort_if(Gate::denies('zip_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.zips.create');
    }

    public function store(StoreZipRequest $request)
    {
        $zip = Zip::create($request->all());

        return redirect()->route('admin.zips.index');
    }

    public function edit(Zip $zip)
    {
        abort_if(Gate::denies('zip_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.zips.edit', compact('zip'));
    }

    public function update(UpdateZipRequest $request, Zip $zip)
    {
        $zip->update($request->all());

        return redirect()->route('admin.zips.index');
    }

    public function show(Zip $zip)
    {
        abort_if(Gate::denies('zip_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.zips.show', compact('zip'));
    }

    public function destroy(Zip $zip)
    {
        abort_if(Gate::denies('zip_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $zip->delete();

        return back();
    }

    public function massDestroy(MassDestroyZipRequest $request)
    {
        Zip::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
