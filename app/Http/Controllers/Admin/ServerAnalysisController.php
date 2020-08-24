<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyServerAnalysiRequest;
use App\Http\Requests\StoreServerAnalysiRequest;
use App\Http\Requests\UpdateServerAnalysiRequest;
use App\Report;
use App\ServerAnalysi;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ServerAnalysisController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('server_analysi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ServerAnalysi::with(['quarter'])->select(sprintf('%s.*', (new ServerAnalysi)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'server_analysi_show';
                $editGate      = 'server_analysi_edit';
                $deleteGate    = 'server_analysi_delete';
                $crudRoutePart = 'server-analysis';

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

            $table->rawColumns(['actions', 'placeholder', 'quarter', 'files']);

            return $table->make(true);
        }

        return view('admin.serverAnalysis.index');
    }

    public function create()
    {
        abort_if(Gate::denies('server_analysi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quarters = Report::all()->pluck('quarter', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.serverAnalysis.create', compact('quarters'));
    }

    public function store(StoreServerAnalysiRequest $request)
    {
        $serverAnalysi = ServerAnalysi::create($request->all());

        foreach ($request->input('files', []) as $file) {
            $serverAnalysi->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('files');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $serverAnalysi->id]);
        }

        return redirect()->route('admin.server-analysis.index');
    }

    public function edit(ServerAnalysi $serverAnalysi)
    {
        abort_if(Gate::denies('server_analysi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quarters = Report::all()->pluck('quarter', 'id')->prepend(trans('global.pleaseSelect'), '');

        $serverAnalysi->load('quarter');

        return view('admin.serverAnalysis.edit', compact('quarters', 'serverAnalysi'));
    }

    public function update(UpdateServerAnalysiRequest $request, ServerAnalysi $serverAnalysi)
    {
        $serverAnalysi->update($request->all());

        if (count($serverAnalysi->files) > 0) {
            foreach ($serverAnalysi->files as $media) {
                if (!in_array($media->file_name, $request->input('files', []))) {
                    $media->delete();
                }
            }
        }

        $media = $serverAnalysi->files->pluck('file_name')->toArray();

        foreach ($request->input('files', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $serverAnalysi->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('files');
            }
        }

        return redirect()->route('admin.server-analysis.index');
    }

    public function show(ServerAnalysi $serverAnalysi)
    {
        abort_if(Gate::denies('server_analysi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $serverAnalysi->load('quarter');

        return view('admin.serverAnalysis.show', compact('serverAnalysi'));
    }

    public function destroy(ServerAnalysi $serverAnalysi)
    {
        abort_if(Gate::denies('server_analysi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $serverAnalysi->delete();

        return back();
    }

    public function massDestroy(MassDestroyServerAnalysiRequest $request)
    {
        ServerAnalysi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('server_analysi_create') && Gate::denies('server_analysi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ServerAnalysi();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
