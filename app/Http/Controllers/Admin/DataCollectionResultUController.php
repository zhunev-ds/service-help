<?php

namespace App\Http\Controllers\Admin;

use App\DataCollectionResult;
use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DataCollectionResultUController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('data_collection_result_u_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DataCollectionResult::query()->select(sprintf('%s.*', (new DataCollectionResult)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'data_collection_result_show';
                $editGate      = 'data_collection_result_edit';
                $deleteGate    = 'data_collection_result_delete';
                $crudRoutePart = 'data-collection-results';

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

            $table->editColumn('change_character', function ($row) {
                return $row->change_character ? $row->change_character : "";
            });
            $table->editColumn('considered_metrological', function ($row) {
                return $row->considered_metrological ? DataCollectionResult::CONSIDERED_METROLOGICAL_RADIO[$row->considered_metrological] : '';
            });
            $table->editColumn('files', function ($row) {
                if (!$row->files) {
                    return '';
                }

                $links = [];

                foreach ($row->files as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'files']);

            return $table->make(true);
        }

        return view('admin.dataCollectionResultUs.index');
    }
}
