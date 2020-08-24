<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Zip;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ZipUController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('zip_u_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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

        return view('admin.zipUs.index');
    }
}
