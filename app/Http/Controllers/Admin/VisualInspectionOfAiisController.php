<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyVisualInspectionOfAiiRequest;
use App\Http\Requests\StoreVisualInspectionOfAiiRequest;
use App\Http\Requests\UpdateVisualInspectionOfAiiRequest;
use App\Mpoint;
use App\Report;
use App\VisualInspectionOfAii;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class VisualInspectionOfAiisController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('visual_inspection_of_aii_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = VisualInspectionOfAii::with(['quarter', 'point'])->select(sprintf('%s.*', (new VisualInspectionOfAii)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'visual_inspection_of_aii_show';
                $editGate      = 'visual_inspection_of_aii_edit';
                $deleteGate    = 'visual_inspection_of_aii_delete';
                $crudRoutePart = 'visual-inspection-of-aiis';

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
            $table->editColumn('photo', function ($row) {
                if (!$row->photo) {
                    return '';
                }

                $links = [];

                foreach ($row->photo as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'quarter', 'point', 'photo']);

            return $table->make(true);
        }

        return view('admin.visualInspectionOfAiis.index');
    }

    public function create()
    {
        abort_if(Gate::denies('visual_inspection_of_aii_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quarters = Report::all()->pluck('quarter', 'id')->prepend(trans('global.pleaseSelect'), '');

        $points = Mpoint::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.visualInspectionOfAiis.create', compact('quarters', 'points'));
    }

    public function store(StoreVisualInspectionOfAiiRequest $request)
    {
        $visualInspectionOfAii = VisualInspectionOfAii::create($request->all());

        foreach ($request->input('photo', []) as $file) {
            $visualInspectionOfAii->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $visualInspectionOfAii->id]);
        }

        return redirect()->route('admin.visual-inspection-of-aiis.index');
    }

    public function edit(VisualInspectionOfAii $visualInspectionOfAii)
    {
        abort_if(Gate::denies('visual_inspection_of_aii_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quarters = Report::all()->pluck('quarter', 'id')->prepend(trans('global.pleaseSelect'), '');

        $points = Mpoint::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $visualInspectionOfAii->load('quarter', 'point');

        return view('admin.visualInspectionOfAiis.edit', compact('quarters', 'points', 'visualInspectionOfAii'));
    }

    public function update(UpdateVisualInspectionOfAiiRequest $request, VisualInspectionOfAii $visualInspectionOfAii)
    {
        $visualInspectionOfAii->update($request->all());

        if (count($visualInspectionOfAii->photo) > 0) {
            foreach ($visualInspectionOfAii->photo as $media) {
                if (!in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        }

        $media = $visualInspectionOfAii->photo->pluck('file_name')->toArray();

        foreach ($request->input('photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $visualInspectionOfAii->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photo');
            }
        }

        return redirect()->route('admin.visual-inspection-of-aiis.index');
    }

    public function show(VisualInspectionOfAii $visualInspectionOfAii)
    {
        abort_if(Gate::denies('visual_inspection_of_aii_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $visualInspectionOfAii->load('quarter', 'point');

        return view('admin.visualInspectionOfAiis.show', compact('visualInspectionOfAii'));
    }

    public function destroy(VisualInspectionOfAii $visualInspectionOfAii)
    {
        abort_if(Gate::denies('visual_inspection_of_aii_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $visualInspectionOfAii->delete();

        return back();
    }

    public function massDestroy(MassDestroyVisualInspectionOfAiiRequest $request)
    {
        VisualInspectionOfAii::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('visual_inspection_of_aii_create') && Gate::denies('visual_inspection_of_aii_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new VisualInspectionOfAii();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
