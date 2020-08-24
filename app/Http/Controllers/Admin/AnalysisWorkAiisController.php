<?php

namespace App\Http\Controllers\Admin;

use App\AnalysisWorkAii;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAnalysisWorkAiiRequest;
use App\Http\Requests\StoreAnalysisWorkAiiRequest;
use App\Http\Requests\UpdateAnalysisWorkAiiRequest;
use App\Report;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AnalysisWorkAiisController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('analysis_work_aii_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AnalysisWorkAii::with(['quarter'])->select(sprintf('%s.*', (new AnalysisWorkAii)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'analysis_work_aii_show';
                $editGate      = 'analysis_work_aii_edit';
                $deleteGate    = 'analysis_work_aii_delete';
                $crudRoutePart = 'analysis-work-aiis';

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

            $table->editColumn('diagnostic', function ($row) {
                if (!$row->diagnostic) {
                    return '';
                }

                $links = [];

                foreach ($row->diagnostic as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'quarter', 'diagnostic']);

            return $table->make(true);
        }

        return view('admin.analysisWorkAiis.index');
    }

    public function create()
    {
        abort_if(Gate::denies('analysis_work_aii_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quarters = Report::all()->pluck('quarter', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.analysisWorkAiis.create', compact('quarters'));
    }

    public function store(StoreAnalysisWorkAiiRequest $request)
    {
        $analysisWorkAii = AnalysisWorkAii::create($request->all());

        foreach ($request->input('diagnostic', []) as $file) {
            $analysisWorkAii->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('diagnostic');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $analysisWorkAii->id]);
        }

        return redirect()->route('admin.analysis-work-aiis.index');
    }

    public function edit(AnalysisWorkAii $analysisWorkAii)
    {
        abort_if(Gate::denies('analysis_work_aii_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quarters = Report::all()->pluck('quarter', 'id')->prepend(trans('global.pleaseSelect'), '');

        $analysisWorkAii->load('quarter');

        return view('admin.analysisWorkAiis.edit', compact('quarters', 'analysisWorkAii'));
    }

    public function update(UpdateAnalysisWorkAiiRequest $request, AnalysisWorkAii $analysisWorkAii)
    {
        $analysisWorkAii->update($request->all());

        if (count($analysisWorkAii->diagnostic) > 0) {
            foreach ($analysisWorkAii->diagnostic as $media) {
                if (!in_array($media->file_name, $request->input('diagnostic', []))) {
                    $media->delete();
                }
            }
        }

        $media = $analysisWorkAii->diagnostic->pluck('file_name')->toArray();

        foreach ($request->input('diagnostic', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $analysisWorkAii->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('diagnostic');
            }
        }

        return redirect()->route('admin.analysis-work-aiis.index');
    }

    public function show(AnalysisWorkAii $analysisWorkAii)
    {
        abort_if(Gate::denies('analysis_work_aii_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $analysisWorkAii->load('quarter');

        return view('admin.analysisWorkAiis.show', compact('analysisWorkAii'));
    }

    public function destroy(AnalysisWorkAii $analysisWorkAii)
    {
        abort_if(Gate::denies('analysis_work_aii_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $analysisWorkAii->delete();

        return back();
    }

    public function massDestroy(MassDestroyAnalysisWorkAiiRequest $request)
    {
        AnalysisWorkAii::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('analysis_work_aii_create') && Gate::denies('analysis_work_aii_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AnalysisWorkAii();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
