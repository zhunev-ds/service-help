<?php

namespace App\Http\Controllers\Admin;

use App\AiisWithOremRequirement;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAiisWithOremRequirementRequest;
use App\Http\Requests\StoreAiisWithOremRequirementRequest;
use App\Http\Requests\UpdateAiisWithOremRequirementRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AiisWithOremRequirementsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('aiis_with_orem_requirement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AiisWithOremRequirement::query()->select(sprintf('%s.*', (new AiisWithOremRequirement)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'aiis_with_orem_requirement_show';
                $editGate      = 'aiis_with_orem_requirement_edit';
                $deleteGate    = 'aiis_with_orem_requirement_delete';
                $crudRoutePart = 'aiis-with-orem-requirements';

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

            $table->editColumn('state_p_313', function ($row) {
                return $row->state_p_313 ? AiisWithOremRequirement::STATE_P_313_SELECT[$row->state_p_313] : '';
            });
            $table->editColumn('state_p_314', function ($row) {
                return $row->state_p_314 ? AiisWithOremRequirement::STATE_P_314_SELECT[$row->state_p_314] : '';
            });
            $table->editColumn('state_p_315', function ($row) {
                return $row->state_p_315 ? AiisWithOremRequirement::STATE_P_315_SELECT[$row->state_p_315] : '';
            });
            $table->editColumn('state_pf_2', function ($row) {
                return $row->state_pf_2 ? AiisWithOremRequirement::STATE_PF_2_SELECT[$row->state_pf_2] : '';
            });
            $table->editColumn('state_pf_4', function ($row) {
                return $row->state_pf_4 ? AiisWithOremRequirement::STATE_PF_4_SELECT[$row->state_pf_4] : '';
            });
            $table->editColumn('state_pf_7', function ($row) {
                return $row->state_pf_7 ? AiisWithOremRequirement::STATE_PF_7_SELECT[$row->state_pf_7] : '';
            });
            $table->editColumn('state_pf_8', function ($row) {
                return $row->state_pf_8 ? AiisWithOremRequirement::STATE_PF_8_SELECT[$row->state_pf_8] : '';
            });
            $table->editColumn('state_pf_9', function ($row) {
                return $row->state_pf_9 ? AiisWithOremRequirement::STATE_PF_9_SELECT[$row->state_pf_9] : '';
            });
            $table->editColumn('state_pf_10', function ($row) {
                return $row->state_pf_10 ? AiisWithOremRequirement::STATE_PF_10_SELECT[$row->state_pf_10] : '';
            });
            $table->editColumn('state_pf_11', function ($row) {
                return $row->state_pf_11 ? AiisWithOremRequirement::STATE_PF_11_SELECT[$row->state_pf_11] : '';
            });
            $table->editColumn('state_pf_13', function ($row) {
                return $row->state_pf_13 ? AiisWithOremRequirement::STATE_PF_13_SELECT[$row->state_pf_13] : '';
            });
            $table->editColumn('state_pf_16', function ($row) {
                return $row->state_pf_16 ? AiisWithOremRequirement::STATE_PF_16_SELECT[$row->state_pf_16] : '';
            });
            $table->editColumn('state_pf_24', function ($row) {
                return $row->state_pf_24 ? AiisWithOremRequirement::STATE_PF_24_SELECT[$row->state_pf_24] : '';
            });
            $table->editColumn('state_pf_28', function ($row) {
                return $row->state_pf_28 ? AiisWithOremRequirement::STATE_PF_28_SELECT[$row->state_pf_28] : '';
            });
            $table->editColumn('state_pf_32', function ($row) {
                return $row->state_pf_32 ? AiisWithOremRequirement::STATE_PF_32_SELECT[$row->state_pf_32] : '';
            });
            $table->editColumn('state_pf_40', function ($row) {
                return $row->state_pf_40 ? AiisWithOremRequirement::STATE_PF_40_SELECT[$row->state_pf_40] : '';
            });
            $table->editColumn('state_pf_41', function ($row) {
                return $row->state_pf_41 ? AiisWithOremRequirement::STATE_PF_41_SELECT[$row->state_pf_41] : '';
            });
            $table->editColumn('state_pf_42', function ($row) {
                return $row->state_pf_42 ? AiisWithOremRequirement::STATE_PF_42_SELECT[$row->state_pf_42] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.aiisWithOremRequirements.index');
    }

    public function create()
    {
        abort_if(Gate::denies('aiis_with_orem_requirement_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.aiisWithOremRequirements.create');
    }

    public function store(StoreAiisWithOremRequirementRequest $request)
    {
        $aiisWithOremRequirement = AiisWithOremRequirement::create($request->all());

        return redirect()->route('admin.aiis-with-orem-requirements.index');
    }

    public function edit(AiisWithOremRequirement $aiisWithOremRequirement)
    {
        abort_if(Gate::denies('aiis_with_orem_requirement_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.aiisWithOremRequirements.edit', compact('aiisWithOremRequirement'));
    }

    public function update(UpdateAiisWithOremRequirementRequest $request, AiisWithOremRequirement $aiisWithOremRequirement)
    {
        $aiisWithOremRequirement->update($request->all());

        return redirect()->route('admin.aiis-with-orem-requirements.index');
    }

    public function show(AiisWithOremRequirement $aiisWithOremRequirement)
    {
        abort_if(Gate::denies('aiis_with_orem_requirement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.aiisWithOremRequirements.show', compact('aiisWithOremRequirement'));
    }

    public function destroy(AiisWithOremRequirement $aiisWithOremRequirement)
    {
        abort_if(Gate::denies('aiis_with_orem_requirement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aiisWithOremRequirement->delete();

        return back();
    }

    public function massDestroy(MassDestroyAiisWithOremRequirementRequest $request)
    {
        AiisWithOremRequirement::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
