<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMonitoringStatusOfMdRequest;
use App\Http\Requests\StoreMonitoringStatusOfMdRequest;
use App\Http\Requests\UpdateMonitoringStatusOfMdRequest;
use App\MonitoringStatusOfMd;
use App\Mpoint;
use App\Report;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MonitoringStatusOfMdController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('monitoring_status_of_md_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MonitoringStatusOfMd::with(['quarter', 'point'])->select(sprintf('%s.*', (new MonitoringStatusOfMd)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'monitoring_status_of_md_show';
                $editGate      = 'monitoring_status_of_md_edit';
                $deleteGate    = 'monitoring_status_of_md_delete';
                $crudRoutePart = 'monitoring-status-of-mds';

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
            $table->addColumn('quarter_quarter', function ($row) {
                return $row->quarter ? $row->quarter->quarter : '';
            });

            $table->addColumn('point_name', function ($row) {
                return $row->point ? $row->point->name : '';
            });

            $table->editColumn('result', function ($row) {
                return $row->result ? $row->result : "";
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

            $table->rawColumns(['actions', 'placeholder', 'quarter', 'point', 'files']);

            return $table->make(true);
        }

        return view('admin.monitoringStatusOfMds.index');
    }

    public function create()
    {
        abort_if(Gate::denies('monitoring_status_of_md_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quarters = Report::all()->pluck('quarter', 'id')->prepend(trans('global.pleaseSelect'), '');

        $points = Mpoint::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.monitoringStatusOfMds.create', compact('quarters', 'points'));
    }

    public function store(StoreMonitoringStatusOfMdRequest $request)
    {
        $monitoringStatusOfMd = MonitoringStatusOfMd::create($request->all());

        foreach ($request->input('files', []) as $file) {
            $monitoringStatusOfMd->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('files');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $monitoringStatusOfMd->id]);
        }

        return redirect()->route('admin.monitoring-status-of-mds.index');
    }

    public function edit(MonitoringStatusOfMd $monitoringStatusOfMd)
    {
        abort_if(Gate::denies('monitoring_status_of_md_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quarters = Report::all()->pluck('quarter', 'id')->prepend(trans('global.pleaseSelect'), '');

        $points = Mpoint::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $monitoringStatusOfMd->load('quarter', 'point');

        return view('admin.monitoringStatusOfMds.edit', compact('quarters', 'points', 'monitoringStatusOfMd'));
    }

    public function update(UpdateMonitoringStatusOfMdRequest $request, MonitoringStatusOfMd $monitoringStatusOfMd)
    {
        $monitoringStatusOfMd->update($request->all());

        if (count($monitoringStatusOfMd->files) > 0) {
            foreach ($monitoringStatusOfMd->files as $media) {
                if (!in_array($media->file_name, $request->input('files', []))) {
                    $media->delete();
                }
            }
        }

        $media = $monitoringStatusOfMd->files->pluck('file_name')->toArray();

        foreach ($request->input('files', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $monitoringStatusOfMd->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('files');
            }
        }

        return redirect()->route('admin.monitoring-status-of-mds.index');
    }

    public function show(MonitoringStatusOfMd $monitoringStatusOfMd)
    {
        abort_if(Gate::denies('monitoring_status_of_md_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $monitoringStatusOfMd->load('quarter', 'point');

        return view('admin.monitoringStatusOfMds.show', compact('monitoringStatusOfMd'));
    }

    public function destroy(MonitoringStatusOfMd $monitoringStatusOfMd)
    {
        abort_if(Gate::denies('monitoring_status_of_md_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $monitoringStatusOfMd->delete();

        return back();
    }

    public function massDestroy(MassDestroyMonitoringStatusOfMdRequest $request)
    {
        MonitoringStatusOfMd::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('monitoring_status_of_md_create') && Gate::denies('monitoring_status_of_md_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MonitoringStatusOfMd();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
