<?php

namespace App\Http\Controllers\Admin;

use App\AiisDocumentationUpdate;
use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AiisDocumentationUpdateUController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('aiis_documentation_update_u_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AiisDocumentationUpdate::query()->select(sprintf('%s.*', (new AiisDocumentationUpdate)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'aiis_documentation_update_show';
                $editGate      = 'aiis_documentation_update_edit';
                $deleteGate    = 'aiis_documentation_update_delete';
                $crudRoutePart = 'aiis-documentation-updates';

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
            $table->editColumn('year', function ($row) {
                return $row->year ? $row->year : "";
            });
            $table->editColumn('verification_si', function ($row) {
                if (!$row->verification_si) {
                    return '';
                }

                $links = [];

                foreach ($row->verification_si as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('verification_aiis', function ($row) {
                if (!$row->verification_aiis) {
                    return '';
                }

                $links = [];

                foreach ($row->verification_aiis as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('actual_metr_data', function ($row) {
                return $row->actual_metr_data ? $row->actual_metr_data : "";
            });
            $table->editColumn('mapping', function ($row) {
                return $row->mapping ? $row->mapping : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'verification_si', 'verification_aiis']);

            return $table->make(true);
        }

        return view('admin.aiisDocumentationUpdateUs.index');
    }
}
