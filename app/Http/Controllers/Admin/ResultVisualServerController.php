<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyResultVisualServerRequest;
use App\Http\Requests\StoreResultVisualServerRequest;
use App\Http\Requests\UpdateResultVisualServerRequest;
use App\Report;
use App\ResultVisualServer;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ResultVisualServerController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('result_visual_server_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ResultVisualServer::with(['quarter'])->select(sprintf('%s.*', (new ResultVisualServer)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'result_visual_server_show';
                $editGate      = 'result_visual_server_edit';
                $deleteGate    = 'result_visual_server_delete';
                $crudRoutePart = 'result-visual-servers';

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

            $table->editColumn('resut', function ($row) {
                return $row->resut ? $row->resut : "";
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

            $table->rawColumns(['actions', 'placeholder', 'quarter', 'photo']);

            return $table->make(true);
        }

        return view('admin.resultVisualServers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('result_visual_server_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quarters = Report::all()->pluck('quarter', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.resultVisualServers.create', compact('quarters'));
    }

    public function store(StoreResultVisualServerRequest $request)
    {
        $resultVisualServer = ResultVisualServer::create($request->all());

        foreach ($request->input('photo', []) as $file) {
            $resultVisualServer->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $resultVisualServer->id]);
        }

        return redirect()->route('admin.result-visual-servers.index');
    }

    public function edit(ResultVisualServer $resultVisualServer)
    {
        abort_if(Gate::denies('result_visual_server_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quarters = Report::all()->pluck('quarter', 'id')->prepend(trans('global.pleaseSelect'), '');

        $resultVisualServer->load('quarter');

        return view('admin.resultVisualServers.edit', compact('quarters', 'resultVisualServer'));
    }

    public function update(UpdateResultVisualServerRequest $request, ResultVisualServer $resultVisualServer)
    {
        $resultVisualServer->update($request->all());

        if (count($resultVisualServer->photo) > 0) {
            foreach ($resultVisualServer->photo as $media) {
                if (!in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        }

        $media = $resultVisualServer->photo->pluck('file_name')->toArray();

        foreach ($request->input('photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $resultVisualServer->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photo');
            }
        }

        return redirect()->route('admin.result-visual-servers.index');
    }

    public function show(ResultVisualServer $resultVisualServer)
    {
        abort_if(Gate::denies('result_visual_server_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $resultVisualServer->load('quarter');

        return view('admin.resultVisualServers.show', compact('resultVisualServer'));
    }

    public function destroy(ResultVisualServer $resultVisualServer)
    {
        abort_if(Gate::denies('result_visual_server_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $resultVisualServer->delete();

        return back();
    }

    public function massDestroy(MassDestroyResultVisualServerRequest $request)
    {
        ResultVisualServer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('result_visual_server_create') && Gate::denies('result_visual_server_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ResultVisualServer();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
