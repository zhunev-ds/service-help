<?php

namespace App\Http\Controllers\Admin;

use App\AiisDataCompleteness;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAiisDataCompletenessRequest;
use App\Http\Requests\StoreAiisDataCompletenessRequest;
use App\Http\Requests\UpdateAiisDataCompletenessRequest;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use DateTime;

class AiisDataCompletenessController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('aiis_data_completeness_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AiisDataCompleteness::query()->select(sprintf('%s.*', (new AiisDataCompleteness)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'aiis_data_completeness_show';
                $editGate      = 'aiis_data_completeness_edit';
                $deleteGate    = 'aiis_data_completeness_delete';
                $crudRoutePart = 'aiis-data-completenesses';

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

            $table->editColumn('state', function ($row) {
                return $row->state ? $row->state : "";
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : "";
            });
            $table->editColumn('file', function ($row) {
                return $row->file ? '<a href="' . $row->file->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'file']);

            return $table->make(true);
        }

        return view('admin.aiisDataCompletenesses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('aiis_data_completeness_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.aiisDataCompletenesses.create');
    }

    public function store(StoreAiisDataCompletenessRequest $request)
    {
        $aiisDataCompleteness = AiisDataCompleteness::create($request->all());

        if ($request->input('file', false)) {
            $aiisDataCompleteness->addMedia(storage_path('tmp/uploads/' . $request->input('file')))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $aiisDataCompleteness->id]);
        }


        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if ($aiisDataCompleteness->file != null) {
            $reader = new Xlsx();
            $filePath = substr($aiisDataCompleteness->file->getUrl(), 1);
            $filePath = urldecode(iconv('UTF-8','CP1251',$filePath));
            $re = '/\d{2}\.\d{2}\.\d{2}/';
            preg_match_all($re, $filePath, $dateArray, PREG_SET_ORDER, 0);
            if ($dateArray == true) {
                $fileDateStr = implode('', array_shift($dateArray));
                $dateObject = date_create_from_format("d.m.y", $fileDateStr);
//                $dateObject = new DateTime($dateObject); // object DateTime
//                $dateObject = $dateObject->format('d.m.y');
                $fileDatePlus = $dateObject->modify('+1 day');
                $fileDatePlusStr = $fileDatePlus->format('d.m.y');
//                dd($fileDatePlusStr);
                $spreadsheet = $reader->load("$filePath");
                $sheet = $spreadsheet->getActiveSheet();
                $stack = array();
                for ($i = 8; $i <= 350; $i++) {
                    $s = 'I'.$i;
                    if ($dataToArray = $sheet->getCell($s)->getValue() != '') {
                        $dataToArray = $sheet->getCell($s)->getValue();
                        $ri = '/\d{2}\.\d{2}\.\d{2}/';
                        if (preg_match_all($ri, $dataToArray, $dateCellArray, PREG_SET_ORDER, 0) == true ) {
                            preg_match_all($ri, $dataToArray, $dateCellArray, PREG_SET_ORDER, 0);
                            $cellDateStr = implode('', array_shift($dateCellArray));
                            if ($fileDatePlusStr == $cellDateStr) {
                            } else {
                                array_push($stack, "$cellDateStr");
                            }
                        }
                        elseif ($dataToArray == "Фидер отключен" || $dataToArray == "фидер отключен") {

                        }
                        else {
                            array_push($stack, "$dataToArray");
                        }
                    }
                }
//            dd(count($stack));
                $allPoints = 236;
                $presentPoints = round(100 * ($allPoints - count($stack)) / $allPoints, 2);
//                dd($presentPoints);
                $aiisDataCompleteness->state = $presentPoints;
                $aiisDataCompleteness->save();
            }
        }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        return redirect()->route('admin.aiis-data-completenesses.index');
    }

    public function edit(AiisDataCompleteness $aiisDataCompleteness)
    {
        abort_if(Gate::denies('aiis_data_completeness_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.aiisDataCompletenesses.edit', compact('aiisDataCompleteness'));
    }

    public function update(UpdateAiisDataCompletenessRequest $request, AiisDataCompleteness $aiisDataCompleteness)
    {
        $aiisDataCompleteness->update($request->all());

        if ($request->input('file', false)) {
            if (!$aiisDataCompleteness->file || $request->input('file') !== $aiisDataCompleteness->file->file_name) {
                $aiisDataCompleteness->addMedia(storage_path('tmp/uploads/' . $request->input('file')))->toMediaCollection('file');
            }
        } elseif ($aiisDataCompleteness->file) {
            $aiisDataCompleteness->file->delete();
        }

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if ($aiisDataCompleteness->file != null) {
            $reader = new Xlsx();
            $filePath = substr($aiisDataCompleteness->file->getUrl(), 1);
            $filePath = urldecode(iconv('UTF-8','CP1251',$filePath));
            $re = '/\d{2}\.\d{2}\.\d{2}/';
            preg_match_all($re, $filePath, $dateArray, PREG_SET_ORDER, 0);
            if ($dateArray == true) {
                $fileDateStr = implode('', array_shift($dateArray));
                $dateObject = date_create_from_format("d.m.y", $fileDateStr);
//                $dateObject = new DateTime($dateObject); // object DateTime
//                $dateObject = $dateObject->format('d.m.y');
                $fileDatePlus = $dateObject->modify('+1 day');
                $fileDatePlusStr = $fileDatePlus->format('d.m.y');
//                dd($fileDatePlusStr);
                $spreadsheet = $reader->load("$filePath");
                $sheet = $spreadsheet->getActiveSheet();
                $stack = array();
                for ($i = 8; $i <= 350; $i++) {
                    $s = 'I'.$i;
                    if ($dataToArray = $sheet->getCell($s)->getValue() != '') {
                        $dataToArray = $sheet->getCell($s)->getValue();
                        $ri = '/\d{2}\.\d{2}\.\d{2}/';
                        if (preg_match_all($ri, $dataToArray, $dateCellArray, PREG_SET_ORDER, 0) == true ) {
                            preg_match_all($ri, $dataToArray, $dateCellArray, PREG_SET_ORDER, 0);
                            $cellDateStr = implode('', array_shift($dateCellArray));
                            if ($fileDatePlusStr == $cellDateStr) {
                            } else {
                                array_push($stack, "$cellDateStr");
                            }
                        }
                        elseif ($dataToArray == "Фидер отключен" || $dataToArray == "фидер отключен") {

                        }
                        else {
                            array_push($stack, "$dataToArray");
                        }
                    }
                }
//            dd(count($stack));
                $allPoints = 236;
                $presentPoints = round(100 * ($allPoints - count($stack)) / $allPoints, 2);
//                dd($presentPoints);
                $aiisDataCompleteness->state = $presentPoints;
                $aiisDataCompleteness->save();
            }
        }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        return redirect()->route('admin.aiis-data-completenesses.index');
    }

    public function show(AiisDataCompleteness $aiisDataCompleteness)
    {
        abort_if(Gate::denies('aiis_data_completeness_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.aiisDataCompletenesses.show', compact('aiisDataCompleteness'));
    }

    public function destroy(AiisDataCompleteness $aiisDataCompleteness)
    {
        abort_if(Gate::denies('aiis_data_completeness_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aiisDataCompleteness->delete();

        return back();
    }

    public function massDestroy(MassDestroyAiisDataCompletenessRequest $request)
    {
        AiisDataCompleteness::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('aiis_data_completeness_create') && Gate::denies('aiis_data_completeness_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AiisDataCompleteness();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
