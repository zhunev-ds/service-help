<?php

namespace App\Http\Controllers\Admin;

use App\AiisDocumentationUpdate;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAiisDocumentationUpdateRequest;
use App\Http\Requests\StoreAiisDocumentationUpdateRequest;
use App\Http\Requests\UpdateAiisDocumentationUpdateRequest;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AiisDocumentationUpdateController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('aiis_documentation_update_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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

        return view('admin.aiisDocumentationUpdates.index');
    }

    public function create()
    {
        abort_if(Gate::denies('aiis_documentation_update_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.aiisDocumentationUpdates.create');
    }

    public function store(StoreAiisDocumentationUpdateRequest $request)
    {
        $aiisDocumentationUpdate = AiisDocumentationUpdate::create($request->all());

        foreach ($request->input('verification_si', []) as $file) {
            $aiisDocumentationUpdate->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('verification_si');
        }

        foreach ($request->input('verification_aiis', []) as $file) {
            $aiisDocumentationUpdate->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('verification_aiis');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $aiisDocumentationUpdate->id]);
        }

        return redirect()->route('admin.aiis-documentation-updates.index');
    }

    public function edit(AiisDocumentationUpdate $aiisDocumentationUpdate)
    {
        abort_if(Gate::denies('aiis_documentation_update_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.aiisDocumentationUpdates.edit', compact('aiisDocumentationUpdate'));
    }

    public function update(UpdateAiisDocumentationUpdateRequest $request, AiisDocumentationUpdate $aiisDocumentationUpdate)
    {
        $aiisDocumentationUpdate->update($request->all());

        if (count($aiisDocumentationUpdate->verification_si) > 0) {
            foreach ($aiisDocumentationUpdate->verification_si as $media) {
                if (!in_array($media->file_name, $request->input('verification_si', []))) {
                    $media->delete();
                }
            }
        }

        $media = $aiisDocumentationUpdate->verification_si->pluck('file_name')->toArray();

        foreach ($request->input('verification_si', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $aiisDocumentationUpdate->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('verification_si');
            }
        }

        if (count($aiisDocumentationUpdate->verification_aiis) > 0) {
            foreach ($aiisDocumentationUpdate->verification_aiis as $media) {
                if (!in_array($media->file_name, $request->input('verification_aiis', []))) {
                    $media->delete();
                }
            }
        }

        $media = $aiisDocumentationUpdate->verification_aiis->pluck('file_name')->toArray();

        foreach ($request->input('verification_aiis', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $aiisDocumentationUpdate->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('verification_aiis');
            }
        }

        return redirect()->route('admin.aiis-documentation-updates.index');
    }

    public function show(AiisDocumentationUpdate $aiisDocumentationUpdate)
    {
        abort_if(Gate::denies('aiis_documentation_update_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.aiisDocumentationUpdates.show', compact('aiisDocumentationUpdate'));
    }

    public function destroy(AiisDocumentationUpdate $aiisDocumentationUpdate)
    {
        abort_if(Gate::denies('aiis_documentation_update_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aiisDocumentationUpdate->delete();

        return back();
    }

    public function massDestroy(MassDestroyAiisDocumentationUpdateRequest $request)
    {
        AiisDocumentationUpdate::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('aiis_documentation_update_create') && Gate::denies('aiis_documentation_update_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AiisDocumentationUpdate();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
