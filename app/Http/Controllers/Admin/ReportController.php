<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyReportRequest;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Report;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Report::with(['responsible', 'brigades'])->select(sprintf('%s.*', (new Report)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'report_show';
                $editGate      = 'report_edit';
                $deleteGate    = 'report_delete';
                $crudRoutePart = 'reports';

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
            $table->editColumn('quarter', function ($row) {
                return $row->quarter ? $row->quarter : "";
            });
            $table->addColumn('responsible_surname', function ($row) {
                return $row->responsible ? $row->responsible->surname : '';
            });

            $table->editColumn('responsible.name', function ($row) {
                return $row->responsible ? (is_string($row->responsible) ? $row->responsible : $row->responsible->name) : '';
            });
            $table->editColumn('brigade', function ($row) {
                $labels = [];

                foreach ($row->brigades as $brigade) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $brigade->surname);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('recommendations', function ($row) {
                return $row->recommendations ? $row->recommendations : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'responsible', 'brigade']);

            return $table->make(true);
        }

        return view('admin.reports.index');
    }

    public function create()
    {
        abort_if(Gate::denies('report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $responsibles = User::all()->pluck('surname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $brigades = User::all()->pluck('surname', 'id');

        return view('admin.reports.create', compact('responsibles', 'brigades'));
    }

    public function store(StoreReportRequest $request)
    {
        $report = Report::create($request->all());
        $report->brigades()->sync($request->input('brigades', []));

        return redirect()->route('admin.reports.index');
    }

    public function edit(Report $report)
    {
        abort_if(Gate::denies('report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $responsibles = User::all()->pluck('surname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $brigades = User::all()->pluck('surname', 'id');

        $report->load('responsible', 'brigades');

        return view('admin.reports.edit', compact('responsibles', 'brigades', 'report'));
    }

    public function update(UpdateReportRequest $request, Report $report)
    {
        $report->update($request->all());
        $report->brigades()->sync($request->input('brigades', []));

        return redirect()->route('admin.reports.index');
    }

    public function show(Report $report)
    {
        abort_if(Gate::denies('report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $report->load('responsible', 'brigades');

        return view('admin.reports.show', compact('report'));
    }

    public function destroy(Report $report)
    {
        abort_if(Gate::denies('report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $report->delete();

        return back();
    }

    public function massDestroy(MassDestroyReportRequest $request)
    {
        Report::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
