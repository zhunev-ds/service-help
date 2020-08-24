<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUspdAnalysiRequest;
use App\Http\Requests\StoreUspdAnalysiRequest;
use App\Http\Requests\UpdateUspdAnalysiRequest;
use App\Location;
use App\Report;
use App\UspdAnalysi;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UspdAnalysisController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('uspd_analysi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UspdAnalysi::with(['quarter', 'location'])->select(sprintf('%s.*', (new UspdAnalysi)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'uspd_analysi_show';
                $editGate      = 'uspd_analysi_edit';
                $deleteGate    = 'uspd_analysi_delete';
                $crudRoutePart = 'uspd-analysis';

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

            $table->addColumn('location_name', function ($row) {
                return $row->location ? $row->location->name : '';
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

            $table->rawColumns(['actions', 'placeholder', 'quarter', 'location', 'files']);

            return $table->make(true);
        }

        return view('admin.uspdAnalysis.index');
    }

    public function create()
    {
        abort_if(Gate::denies('uspd_analysi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quarters = Report::all()->pluck('quarter', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locations = Location::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.uspdAnalysis.create', compact('quarters', 'locations'));
    }

    public function store(StoreUspdAnalysiRequest $request)
    {
        $uspdAnalysi = UspdAnalysi::create($request->all());

        foreach ($request->input('files', []) as $file) {
            $uspdAnalysi->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('files');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $uspdAnalysi->id]);
        }

        return redirect()->route('admin.uspd-analysis.index');
    }

    public function edit(UspdAnalysi $uspdAnalysi)
    {
        abort_if(Gate::denies('uspd_analysi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quarters = Report::all()->pluck('quarter', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locations = Location::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $uspdAnalysi->load('quarter', 'location');

        return view('admin.uspdAnalysis.edit', compact('quarters', 'locations', 'uspdAnalysi'));
    }

    public function update(UpdateUspdAnalysiRequest $request, UspdAnalysi $uspdAnalysi)
    {
        $uspdAnalysi->update($request->all());

        if (count($uspdAnalysi->files) > 0) {
            foreach ($uspdAnalysi->files as $media) {
                if (!in_array($media->file_name, $request->input('files', []))) {
                    $media->delete();
                }
            }
        }

        $media = $uspdAnalysi->files->pluck('file_name')->toArray();

        foreach ($request->input('files', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $uspdAnalysi->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('files');
            }
        }

        return redirect()->route('admin.uspd-analysis.index');
    }

    public function show(UspdAnalysi $uspdAnalysi)
    {
        abort_if(Gate::denies('uspd_analysi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $uspdAnalysi->load('quarter', 'location');

        return view('admin.uspdAnalysis.show', compact('uspdAnalysi'));
    }

    public function destroy(UspdAnalysi $uspdAnalysi)
    {
        abort_if(Gate::denies('uspd_analysi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $uspdAnalysi->delete();

        return back();
    }

    public function massDestroy(MassDestroyUspdAnalysiRequest $request)
    {
        UspdAnalysi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('uspd_analysi_create') && Gate::denies('uspd_analysi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new UspdAnalysi();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
