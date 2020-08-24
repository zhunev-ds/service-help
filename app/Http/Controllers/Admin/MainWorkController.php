<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMainWorkRequest;
use App\Http\Requests\StoreMainWorkRequest;
use App\Http\Requests\UpdateMainWorkRequest;
use App\MainWork;
use App\Report;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MainWorkController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('main_work_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MainWork::with(['quarter'])->select(sprintf('%s.*', (new MainWork)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'main_work_show';
                $editGate      = 'main_work_edit';
                $deleteGate    = 'main_work_delete';
                $crudRoutePart = 'main-works';

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

            $table->editColumn('comment', function ($row) {
                return $row->comment ? $row->comment : "";
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

            $table->rawColumns(['actions', 'placeholder', 'quarter', 'files']);

            return $table->make(true);
        }

        return view('admin.mainWorks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('main_work_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quarters = Report::all()->pluck('quarter', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.mainWorks.create', compact('quarters'));
    }

    public function store(StoreMainWorkRequest $request)
    {
        $mainWork = MainWork::create($request->all());

        foreach ($request->input('files', []) as $file) {
            $mainWork->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('files');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $mainWork->id]);
        }

        return redirect()->route('admin.main-works.index');
    }

    public function edit(MainWork $mainWork)
    {
        abort_if(Gate::denies('main_work_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quarters = Report::all()->pluck('quarter', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mainWork->load('quarter');

        return view('admin.mainWorks.edit', compact('quarters', 'mainWork'));
    }

    public function update(UpdateMainWorkRequest $request, MainWork $mainWork)
    {
        $mainWork->update($request->all());

        if (count($mainWork->files) > 0) {
            foreach ($mainWork->files as $media) {
                if (!in_array($media->file_name, $request->input('files', []))) {
                    $media->delete();
                }
            }
        }

        $media = $mainWork->files->pluck('file_name')->toArray();

        foreach ($request->input('files', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $mainWork->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('files');
            }
        }

        return redirect()->route('admin.main-works.index');
    }

    public function show(MainWork $mainWork)
    {
        abort_if(Gate::denies('main_work_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mainWork->load('quarter');

        return view('admin.mainWorks.show', compact('mainWork'));
    }

    public function destroy(MainWork $mainWork)
    {
        abort_if(Gate::denies('main_work_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mainWork->delete();

        return back();
    }

    public function massDestroy(MassDestroyMainWorkRequest $request)
    {
        MainWork::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('main_work_create') && Gate::denies('main_work_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MainWork();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
