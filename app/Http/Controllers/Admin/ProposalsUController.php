<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Proposal;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProposalsUController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('proposals_u_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Proposal::query()->select(sprintf('%s.*', (new Proposal)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'proposal_show';
                $editGate      = 'proposal_edit';
                $deleteGate    = 'proposal_delete';
                $crudRoutePart = 'proposals';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : "";
            });

            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : "";
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

        return view('admin.proposalsUs.index');
    }
}
