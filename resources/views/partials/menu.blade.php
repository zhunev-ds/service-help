<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <p class="brand-link" style="font-size: 28px; color: white;">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </p>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if ( Auth::user()->photo != null) {
                <img src="{{ Auth::user()->photo->url }}" class="img-circle elevation-2" alt="User Image" style="object-fit: cover;">
                } @endif
            </div>
            <div class="info">
                <p class="d-block" style="font-size: 22px; color: white;">{{ Auth::user()->name }} {{ Auth::user()->surname }}</p>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('to_aiis_u_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/report-us*') ? 'menu-open' : '' }} {{ request()->is('admin/tasks-calendars*') ? 'menu-open' : '' }} {{ request()->is('admin/journal-voiars*') ? 'menu-open' : '' }} {{ request()->is('admin/journal-ptos*') ? 'menu-open' : '' }} {{ request()->is('admin/zip-us*') ? 'menu-open' : '' }} {{ request()->is('admin/proposals-us*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fas fa-hammer nav-icon">
                            </i>
                            <p>
                                {{ trans('cruds.toAiisU.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('report_u_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.report-us.index") }}" class="nav-link {{ request()->is('admin/report-us') || request()->is('admin/report-us/*') ? 'active' : '' }}">
                                        <p>
                                            {{ trans('cruds.reportU.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('tasks_calendar_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tasks-calendars.index") }}" class="nav-link {{ request()->is('admin/tasks-calendars') || request()->is('admin/tasks-calendars/*') ? 'active' : '' }}">
                                        <p>
                                            {{ trans('cruds.tasksCalendar.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('journal_voiar_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.journal-voiars.index") }}" class="nav-link {{ request()->is('admin/journal-voiars') || request()->is('admin/journal-voiars/*') ? 'active' : '' }}">
                                        <p>
                                            {{ trans('cruds.journalVoiar.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('journal_pto_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.journal-ptos.index") }}" class="nav-link {{ request()->is('admin/journal-ptos') || request()->is('admin/journal-ptos/*') ? 'active' : '' }}">
                                        <p>
                                            {{ trans('cruds.journalPto.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('zip_u_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.zip-us.index") }}" class="nav-link {{ request()->is('admin/zip-us') || request()->is('admin/zip-us/*') ? 'active' : '' }}">
                                        <p>
                                            {{ trans('cruds.zipU.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('proposals_u_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.proposals-us.index") }}" class="nav-link {{ request()->is('admin/proposals-us') || request()->is('admin/proposals-us/*') ? 'active' : '' }}">
                                        <p>
                                            {{ trans('cruds.proposalsU.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('state_aiis_u_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/aiis-data-completeness-us*') ? 'menu-open' : '' }} {{ request()->is('admin/aiis-with-orem-requirements-us*') ? 'menu-open' : '' }} {{ request()->is('admin/aiis-documentation-update-us*') ? 'menu-open' : '' }} {{ request()->is('admin/data-collection-result-us*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fas fa-desktop nav-icon">
                            </i>
                            <p>
                                {{ trans('cruds.stateAiisU.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('aiis_data_completeness_u_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.aiis-data-completeness-us.index") }}" class="nav-link {{ request()->is('admin/aiis-data-completeness-us') || request()->is('admin/aiis-data-completeness-us/*') ? 'active' : '' }}">
                                        <p>
                                            {{ trans('cruds.aiisDataCompletenessU.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('aiis_with_orem_requirements_u_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.aiis-with-orem-requirements-us.index") }}" class="nav-link {{ request()->is('admin/aiis-with-orem-requirements-us') || request()->is('admin/aiis-with-orem-requirements-us/*') ? 'active' : '' }}">
                                        <p>
                                            {{ trans('cruds.aiisWithOremRequirementsU.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('aiis_documentation_update_u_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.aiis-documentation-update-us.index") }}" class="nav-link {{ request()->is('admin/aiis-documentation-update-us') || request()->is('admin/aiis-documentation-update-us/*') ? 'active' : '' }}">
                                        <p>
                                            {{ trans('cruds.aiisDocumentationUpdateU.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('data_collection_result_u_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.data-collection-result-us.index") }}" class="nav-link {{ request()->is('admin/data-collection-result-us') || request()->is('admin/data-collection-result-us/*') ? 'active' : '' }}">
                                        <p>
                                            {{ trans('cruds.dataCollectionResultU.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('to_aii_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/*') ? 'menu-open' : '' }} {{ request()->is('admin/zips*') ? 'menu-open' : '' }} {{ request()->is('admin/proposals*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fas fa-tools nav-icon">

                            </i>
                            <p>
                                {{ trans('cruds.toAii.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('report_pto_access')
                                <li class="nav-item has-treeview {{ request()->is('admin/reports*') ? 'menu-open' : '' }} {{ request()->is('admin/main-works*') ? 'menu-open' : '' }} {{ request()->is('admin/visual-inspection-of-aiis*') ? 'menu-open' : '' }} {{ request()->is('admin/result-visual-servers*') ? 'menu-open' : '' }} {{ request()->is('admin/result-visual-uspds*') ? 'menu-open' : '' }} {{ request()->is('admin/monitoring-status-of-mds*') ? 'menu-open' : '' }} {{ request()->is('admin/server-analysis*') ? 'menu-open' : '' }} {{ request()->is('admin/uspd-analysis*') ? 'menu-open' : '' }} {{ request()->is('admin/analysis-work-aiis*') ? 'menu-open' : '' }}">
                                    <a class="nav-link nav-dropdown-toggle" href="#">
                                        <p>
                                            {{ trans('cruds.reportPto.title') }}
                                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @can('report_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.reports.index") }}" class="nav-link {{ request()->is('admin/reports') || request()->is('admin/reports/*') ? 'active' : '' }}">
                                                    <p>
                                                        {{ trans('cruds.report.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('main_work_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.main-works.index") }}" class="nav-link {{ request()->is('admin/main-works') || request()->is('admin/main-works/*') ? 'active' : '' }}">
                                                    <p>
                                                        {{ trans('cruds.mainWork.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('visual_inspection_of_aii_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.visual-inspection-of-aiis.index") }}" class="nav-link {{ request()->is('admin/visual-inspection-of-aiis') || request()->is('admin/visual-inspection-of-aiis/*') ? 'active' : '' }}">
                                                    <p>
                                                        {{ trans('cruds.visualInspectionOfAii.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('result_visual_server_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.result-visual-servers.index") }}" class="nav-link {{ request()->is('admin/result-visual-servers') || request()->is('admin/result-visual-servers/*') ? 'active' : '' }}">
                                                    <p>
                                                        {{ trans('cruds.resultVisualServer.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('result_visual_uspd_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.result-visual-uspds.index") }}" class="nav-link {{ request()->is('admin/result-visual-uspds') || request()->is('admin/result-visual-uspds/*') ? 'active' : '' }}">
                                                    <p>
                                                        {{ trans('cruds.resultVisualUspd.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('monitoring_status_of_md_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.monitoring-status-of-mds.index") }}" class="nav-link {{ request()->is('admin/monitoring-status-of-mds') || request()->is('admin/monitoring-status-of-mds/*') ? 'active' : '' }}">
                                                    <p>
                                                        {{ trans('cruds.monitoringStatusOfMd.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('server_analysi_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.server-analysis.index") }}" class="nav-link {{ request()->is('admin/server-analysis') || request()->is('admin/server-analysis/*') ? 'active' : '' }}">
                                                    <p>
                                                        {{ trans('cruds.serverAnalysi.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('uspd_analysi_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.uspd-analysis.index") }}" class="nav-link {{ request()->is('admin/uspd-analysis') || request()->is('admin/uspd-analysis/*') ? 'active' : '' }}">
                                                    <p>
                                                        {{ trans('cruds.uspdAnalysi.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('analysis_work_aii_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.analysis-work-aiis.index") }}" class="nav-link {{ request()->is('admin/analysis-work-aiis') || request()->is('admin/analysis-work-aiis/*') ? 'active' : '' }}">
                                                    <p>
                                                        {{ trans('cruds.analysisWorkAii.title') }}
                                                    </p>
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                            @can('zip_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.zips.index") }}" class="nav-link {{ request()->is('admin/zips') || request()->is('admin/zips/*') ? 'active' : '' }}">
                                        <p>
                                            {{ trans('cruds.zip.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('proposal_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.proposals.index") }}" class="nav-link {{ request()->is('admin/proposals') || request()->is('admin/proposals/*') ? 'active' : '' }}">
                                        <p>
                                            {{ trans('cruds.proposal.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('task_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/tasks*') ? 'menu-open' : '' }} {{ request()->is('admin/task-statuses*') ? 'menu-open' : '' }} {{ request()->is('admin/task-tags*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-list">

                            </i>
                            <p>
                                {{ trans('cruds.taskManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('task_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tasks.index") }}" class="nav-link {{ request()->is('admin/tasks') || request()->is('admin/tasks/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.task.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('task_status_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.task-statuses.index") }}" class="nav-link {{ request()->is('admin/task-statuses') || request()->is('admin/task-statuses/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-server">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taskStatus.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('task_tag_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.task-tags.index") }}" class="nav-link {{ request()->is('admin/task-tags') || request()->is('admin/task-tags/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-server">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taskTag.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('state_aii_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/aiis-data-completenesses*') ? 'menu-open' : '' }} {{ request()->is('admin/aiis-with-orem-requirements*') ? 'menu-open' : '' }} {{ request()->is('admin/aiis-documentation-updates*') ? 'menu-open' : '' }} {{ request()->is('admin/data-collection-results*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fas fa-tv nav-icon">
                            </i>
                            <p>
                                {{ trans('cruds.stateAii.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('aiis_data_completeness_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.aiis-data-completenesses.index") }}" class="nav-link {{ request()->is('admin/aiis-data-completenesses') || request()->is('admin/aiis-data-completenesses/*') ? 'active' : '' }}">
                                        <p>
                                            {{ trans('cruds.aiisDataCompleteness.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('aiis_with_orem_requirement_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.aiis-with-orem-requirements.index") }}" class="nav-link {{ request()->is('admin/aiis-with-orem-requirements') || request()->is('admin/aiis-with-orem-requirements/*') ? 'active' : '' }}">
                                        <p>
                                            {{ trans('cruds.aiisWithOremRequirement.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('aiis_documentation_update_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.aiis-documentation-updates.index") }}" class="nav-link {{ request()->is('admin/aiis-documentation-updates') || request()->is('admin/aiis-documentation-updates/*') ? 'active' : '' }}">
                                        <p>
                                            {{ trans('cruds.aiisDocumentationUpdate.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('data_collection_result_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.data-collection-results.index") }}" class="nav-link {{ request()->is('admin/data-collection-results') || request()->is('admin/data-collection-results/*') ? 'active' : '' }}">
                                        <p>
                                            {{ trans('cruds.dataCollectionResult.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('locatoin_equipment_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/locations*') ? 'menu-open' : '' }} {{ request()->is('admin/mpoints*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fas fa-globe-americas nav-icon">
                                
                            </i>
                            <p>
                                {{ trans('cruds.locatoinEquipment.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('location_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.locations.index") }}" class="nav-link {{ request()->is('admin/locations') || request()->is('admin/locations/*') ? 'active' : '' }}">
                                        <p>
                                            {{ trans('cruds.location.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('mpoint_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.mpoints.index") }}" class="nav-link {{ request()->is('admin/mpoints') || request()->is('admin/mpoints/*') ? 'active' : '' }}">
                                        <p>
                                            {{ trans('cruds.mpoint.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('content_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/content-categories*') ? 'menu-open' : '' }} {{ request()->is('admin/content-tags*') ? 'menu-open' : '' }} {{ request()->is('admin/content-pages*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-book">

                            </i>
                            <p>
                                {{ trans('cruds.contentManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('content_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.content-categories.index") }}" class="nav-link {{ request()->is('admin/content-categories') || request()->is('admin/content-categories/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-folder">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contentCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('content_tag_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.content-tags.index") }}" class="nav-link {{ request()->is('admin/content-tags') || request()->is('admin/content-tags/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-tags">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contentTag.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('content_page_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.content-pages.index") }}" class="nav-link {{ request()->is('admin/content-pages') || request()->is('admin/content-pages/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-file">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contentPage.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/users*') ? 'menu-open' : '' }} {{ request()->is('admin/permissions*') ? 'menu-open' : '' }} {{ request()->is('admin/roles*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('content_categories')
                    <li class="nav-item">
                        <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon fas fa-briefcase">

                            </i>
                            <p>
                                {{ trans('cruds.role.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ trans('global.change_password') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                        <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
