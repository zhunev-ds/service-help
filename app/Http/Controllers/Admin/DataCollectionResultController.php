<?php

namespace App\Http\Controllers\Admin;

use App\DataCollectionResult;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDataCollectionResultRequest;
use App\Http\Requests\StoreDataCollectionResultRequest;
use App\Http\Requests\UpdateDataCollectionResultRequest;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DataCollectionResultController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('data_collection_result_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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

        return view('admin.dataCollectionResults.index');
    }

    public function create()
    {
        abort_if(Gate::denies('data_collection_result_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dataCollectionResults.create');
    }

    public function store(StoreDataCollectionResultRequest $request)
    {
        $dataCollectionResult = DataCollectionResult::create($request->all());

        foreach ($request->input('files', []) as $file) {
            $dataCollectionResult->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('files');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $dataCollectionResult->id]);
        }

        return redirect()->route('admin.data-collection-results.index');
    }

    public function edit(DataCollectionResult $dataCollectionResult)
    {
        abort_if(Gate::denies('data_collection_result_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dataCollectionResults.edit', compact('dataCollectionResult'));
    }

    public function update(UpdateDataCollectionResultRequest $request, DataCollectionResult $dataCollectionResult)
    {
        $dataCollectionResult->update($request->all());

        if (count($dataCollectionResult->files) > 0) {
            foreach ($dataCollectionResult->files as $media) {
                if (!in_array($media->file_name, $request->input('files', []))) {
                    $media->delete();
                }
            }
        }

        $media = $dataCollectionResult->files->pluck('file_name')->toArray();

        foreach ($request->input('files', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $dataCollectionResult->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('files');
            }
        }

        return redirect()->route('admin.data-collection-results.index');
    }

    public function show(DataCollectionResult $dataCollectionResult)
    {
        abort_if(Gate::denies('data_collection_result_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dataCollectionResults.show', compact('dataCollectionResult'));
    }

    public function destroy(DataCollectionResult $dataCollectionResult)
    {
        abort_if(Gate::denies('data_collection_result_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataCollectionResult->delete();

        return back();
    }

    public function massDestroy(MassDestroyDataCollectionResultRequest $request)
    {
        DataCollectionResult::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('data_collection_result_create') && Gate::denies('data_collection_result_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new DataCollectionResult();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
