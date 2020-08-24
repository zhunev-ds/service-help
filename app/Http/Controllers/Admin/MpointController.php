<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMpointRequest;
use App\Http\Requests\StoreMpointRequest;
use App\Http\Requests\UpdateMpointRequest;
use App\Location;
use App\Mpoint;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MpointController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('mpoint_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Mpoint::with(['location'])->select(sprintf('%s.*', (new Mpoint)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'mpoint_show';
                $editGate      = 'mpoint_edit';
                $deleteGate    = 'mpoint_delete';
                $crudRoutePart = 'mpoints';

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
            $table->addColumn('location_name', function ($row) {
                return $row->location ? $row->location->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'location']);

            return $table->make(true);
        }

        return view('admin.mpoints.index');
    }

    public function create()
    {
        abort_if(Gate::denies('mpoint_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locations = Location::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.mpoints.create', compact('locations'));
    }

    public function store(StoreMpointRequest $request)
    {
        $mpoint = Mpoint::create($request->all());

        return redirect()->route('admin.mpoints.index');
    }

    public function edit(Mpoint $mpoint)
    {
        abort_if(Gate::denies('mpoint_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locations = Location::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mpoint->load('location');

        return view('admin.mpoints.edit', compact('locations', 'mpoint'));
    }

    public function update(UpdateMpointRequest $request, Mpoint $mpoint)
    {
        $mpoint->update($request->all());

        return redirect()->route('admin.mpoints.index');
    }

    public function show(Mpoint $mpoint)
    {
        abort_if(Gate::denies('mpoint_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mpoint->load('location');

        return view('admin.mpoints.show', compact('mpoint'));
    }

    public function destroy(Mpoint $mpoint)
    {
        abort_if(Gate::denies('mpoint_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mpoint->delete();

        return back();
    }

    public function massDestroy(MassDestroyMpointRequest $request)
    {
        Mpoint::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
