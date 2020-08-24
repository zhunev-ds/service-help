<?php

namespace App\Http\Controllers\Admin;

use App\AiisDataCompleteness;
use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AiisDataCompletenessUController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('aiis_data_completeness_u_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AiisDataCompleteness::query()->select(sprintf('%s.*', (new AiisDataCompleteness)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'aiis_data_completeness_show';
                $editGate      = 'aiis_data_completeness_edit';
                $deleteGate    = 'aiis_data_completeness_delete';
                $crudRoutePart = 'aiis-data-completenesses';

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

            $table->editColumn('state', function ($row) {
                return $row->state ? $row->state : "";
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : "";
            });
            $table->editColumn('file', function ($row) {
                return $row->file ? '<a href="' . $row->file->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'file']);

            return $table->make(true);
        }
        $aiisDatas = AiisDataCompleteness::orderBy('date', 'desc')->take(3)->get();
        return view('admin.aiisDataCompletenessUs.index', compact('aiisDatas'));
    }
}
