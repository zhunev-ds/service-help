<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyResultVisualUspdRequest;
use App\Http\Requests\StoreResultVisualUspdRequest;
use App\Http\Requests\UpdateResultVisualUspdRequest;
use App\Location;
use App\Report;
use App\ResultVisualUspd;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ResultVisualUspdController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('result_visual_uspd_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ResultVisualUspd::with(['quarter', 'location'])->select(sprintf('%s.*', (new ResultVisualUspd)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'result_visual_uspd_show';
                $editGate      = 'result_visual_uspd_edit';
                $deleteGate    = 'result_visual_uspd_delete';
                $crudRoutePart = 'result-visual-uspds';

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

            $table->rawColumns(['actions', 'placeholder', 'quarter', 'location', 'photo']);

            return $table->make(true);
        }

        return view('admin.resultVisualUspds.index');
    }

    public function create()
    {
        abort_if(Gate::denies('result_visual_uspd_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quarters = Report::all()->pluck('quarter', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locations = Location::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.resultVisualUspds.create', compact('quarters', 'locations'));
    }

    public function store(StoreResultVisualUspdRequest $request)
    {
        $resultVisualUspd = ResultVisualUspd::create($request->all());

        foreach ($request->input('photo', []) as $file) {
            $resultVisualUspd->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $resultVisualUspd->id]);
        }

        return redirect()->route('admin.result-visual-uspds.index');
    }

    public function edit(ResultVisualUspd $resultVisualUspd)
    {
        abort_if(Gate::denies('result_visual_uspd_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quarters = Report::all()->pluck('quarter', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locations = Location::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $resultVisualUspd->load('quarter', 'location');

        return view('admin.resultVisualUspds.edit', compact('quarters', 'locations', 'resultVisualUspd'));
    }

    public function update(UpdateResultVisualUspdRequest $request, ResultVisualUspd $resultVisualUspd)
    {
        $resultVisualUspd->update($request->all());

        if (count($resultVisualUspd->photo) > 0) {
            foreach ($resultVisualUspd->photo as $media) {
                if (!in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        }

        $media = $resultVisualUspd->photo->pluck('file_name')->toArray();

        foreach ($request->input('photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $resultVisualUspd->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photo');
            }
        }

        return redirect()->route('admin.result-visual-uspds.index');
    }

    public function show(ResultVisualUspd $resultVisualUspd)
    {
        abort_if(Gate::denies('result_visual_uspd_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $resultVisualUspd->load('quarter', 'location');

        return view('admin.resultVisualUspds.show', compact('resultVisualUspd'));
    }

    public function destroy(ResultVisualUspd $resultVisualUspd)
    {
        abort_if(Gate::denies('result_visual_uspd_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $resultVisualUspd->delete();

        return back();
    }

    public function massDestroy(MassDestroyResultVisualUspdRequest $request)
    {
        ResultVisualUspd::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('result_visual_uspd_create') && Gate::denies('result_visual_uspd_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ResultVisualUspd();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
