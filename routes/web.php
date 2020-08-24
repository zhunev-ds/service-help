<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // Task Statuses
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tags
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::resource('task-tags', 'TaskTagController');

    // Tasks
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendars
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Content Categories
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tags
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

    // Content Pages
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::resource('content-pages', 'ContentPageController');

    // Locations
    Route::delete('locations/destroy', 'LocationController@massDestroy')->name('locations.massDestroy');
    Route::resource('locations', 'LocationController');

    // Mpoints
    Route::delete('mpoints/destroy', 'MpointController@massDestroy')->name('mpoints.massDestroy');
    Route::resource('mpoints', 'MpointController');

    // Zips
    Route::delete('zips/destroy', 'ZipController@massDestroy')->name('zips.massDestroy');
    Route::resource('zips', 'ZipController');

    // Proposals
    Route::delete('proposals/destroy', 'ProposalsController@massDestroy')->name('proposals.massDestroy');
    Route::post('proposals/media', 'ProposalsController@storeMedia')->name('proposals.storeMedia');
    Route::post('proposals/ckmedia', 'ProposalsController@storeCKEditorImages')->name('proposals.storeCKEditorImages');
    Route::resource('proposals', 'ProposalsController');

    // Reports
    Route::delete('reports/destroy', 'ReportController@massDestroy')->name('reports.massDestroy');
    Route::resource('reports', 'ReportController');

    // Visual Inspection Of Aiis
    Route::delete('visual-inspection-of-aiis/destroy', 'VisualInspectionOfAiisController@massDestroy')->name('visual-inspection-of-aiis.massDestroy');
    Route::post('visual-inspection-of-aiis/media', 'VisualInspectionOfAiisController@storeMedia')->name('visual-inspection-of-aiis.storeMedia');
    Route::post('visual-inspection-of-aiis/ckmedia', 'VisualInspectionOfAiisController@storeCKEditorImages')->name('visual-inspection-of-aiis.storeCKEditorImages');
    Route::resource('visual-inspection-of-aiis', 'VisualInspectionOfAiisController');

    // Monitoring Status Of Mds
    Route::delete('monitoring-status-of-mds/destroy', 'MonitoringStatusOfMdController@massDestroy')->name('monitoring-status-of-mds.massDestroy');
    Route::post('monitoring-status-of-mds/media', 'MonitoringStatusOfMdController@storeMedia')->name('monitoring-status-of-mds.storeMedia');
    Route::post('monitoring-status-of-mds/ckmedia', 'MonitoringStatusOfMdController@storeCKEditorImages')->name('monitoring-status-of-mds.storeCKEditorImages');
    Route::resource('monitoring-status-of-mds', 'MonitoringStatusOfMdController');

    // Report Us
    Route::resource('report-us', 'ReportUController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Journal Voiars
    Route::resource('journal-voiars', 'JournalVoiarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Zip Us
    Route::resource('zip-us', 'ZipUController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Proposals Us
    Route::resource('proposals-us', 'ProposalsUController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Aiis Data Completenesses
    Route::delete('aiis-data-completenesses/destroy', 'AiisDataCompletenessController@massDestroy')->name('aiis-data-completenesses.massDestroy');
    Route::post('aiis-data-completenesses/media', 'AiisDataCompletenessController@storeMedia')->name('aiis-data-completenesses.storeMedia');
    Route::post('aiis-data-completenesses/ckmedia', 'AiisDataCompletenessController@storeCKEditorImages')->name('aiis-data-completenesses.storeCKEditorImages');
    Route::resource('aiis-data-completenesses', 'AiisDataCompletenessController');

    // Aiis With Orem Requirements
    Route::delete('aiis-with-orem-requirements/destroy', 'AiisWithOremRequirementsController@massDestroy')->name('aiis-with-orem-requirements.massDestroy');
    Route::resource('aiis-with-orem-requirements', 'AiisWithOremRequirementsController');

    // Aiis Documentation Updates
    Route::delete('aiis-documentation-updates/destroy', 'AiisDocumentationUpdateController@massDestroy')->name('aiis-documentation-updates.massDestroy');
    Route::post('aiis-documentation-updates/media', 'AiisDocumentationUpdateController@storeMedia')->name('aiis-documentation-updates.storeMedia');
    Route::post('aiis-documentation-updates/ckmedia', 'AiisDocumentationUpdateController@storeCKEditorImages')->name('aiis-documentation-updates.storeCKEditorImages');
    Route::resource('aiis-documentation-updates', 'AiisDocumentationUpdateController');

    // Aiis Data Completeness Us
    Route::resource('aiis-data-completeness-us', 'AiisDataCompletenessUController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Aiis With Orem Requirements Us
    Route::resource('aiis-with-orem-requirements-us', 'AiisWithOremRequirementsUController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Aiis Documentation Update Us
    Route::resource('aiis-documentation-update-us', 'AiisDocumentationUpdateUController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Main Works
    Route::delete('main-works/destroy', 'MainWorkController@massDestroy')->name('main-works.massDestroy');
    Route::post('main-works/media', 'MainWorkController@storeMedia')->name('main-works.storeMedia');
    Route::post('main-works/ckmedia', 'MainWorkController@storeCKEditorImages')->name('main-works.storeCKEditorImages');
    Route::resource('main-works', 'MainWorkController');

    // Analysis Work Aiis
    Route::delete('analysis-work-aiis/destroy', 'AnalysisWorkAiisController@massDestroy')->name('analysis-work-aiis.massDestroy');
    Route::post('analysis-work-aiis/media', 'AnalysisWorkAiisController@storeMedia')->name('analysis-work-aiis.storeMedia');
    Route::post('analysis-work-aiis/ckmedia', 'AnalysisWorkAiisController@storeCKEditorImages')->name('analysis-work-aiis.storeCKEditorImages');
    Route::resource('analysis-work-aiis', 'AnalysisWorkAiisController');

    // Data Collection Results
    Route::delete('data-collection-results/destroy', 'DataCollectionResultController@massDestroy')->name('data-collection-results.massDestroy');
    Route::post('data-collection-results/media', 'DataCollectionResultController@storeMedia')->name('data-collection-results.storeMedia');
    Route::post('data-collection-results/ckmedia', 'DataCollectionResultController@storeCKEditorImages')->name('data-collection-results.storeCKEditorImages');
    Route::resource('data-collection-results', 'DataCollectionResultController');

    // Data Collection Result Us
    Route::resource('data-collection-result-us', 'DataCollectionResultUController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Server Analysis
    Route::delete('server-analysis/destroy', 'ServerAnalysisController@massDestroy')->name('server-analysis.massDestroy');
    Route::post('server-analysis/media', 'ServerAnalysisController@storeMedia')->name('server-analysis.storeMedia');
    Route::post('server-analysis/ckmedia', 'ServerAnalysisController@storeCKEditorImages')->name('server-analysis.storeCKEditorImages');
    Route::resource('server-analysis', 'ServerAnalysisController');

    // Uspd Analysis
    Route::delete('uspd-analysis/destroy', 'UspdAnalysisController@massDestroy')->name('uspd-analysis.massDestroy');
    Route::post('uspd-analysis/media', 'UspdAnalysisController@storeMedia')->name('uspd-analysis.storeMedia');
    Route::post('uspd-analysis/ckmedia', 'UspdAnalysisController@storeCKEditorImages')->name('uspd-analysis.storeCKEditorImages');
    Route::resource('uspd-analysis', 'UspdAnalysisController');

    // Result Visual Servers
    Route::delete('result-visual-servers/destroy', 'ResultVisualServerController@massDestroy')->name('result-visual-servers.massDestroy');
    Route::post('result-visual-servers/media', 'ResultVisualServerController@storeMedia')->name('result-visual-servers.storeMedia');
    Route::post('result-visual-servers/ckmedia', 'ResultVisualServerController@storeCKEditorImages')->name('result-visual-servers.storeCKEditorImages');
    Route::resource('result-visual-servers', 'ResultVisualServerController');

    // Result Visual Uspds
    Route::delete('result-visual-uspds/destroy', 'ResultVisualUspdController@massDestroy')->name('result-visual-uspds.massDestroy');
    Route::post('result-visual-uspds/media', 'ResultVisualUspdController@storeMedia')->name('result-visual-uspds.storeMedia');
    Route::post('result-visual-uspds/ckmedia', 'ResultVisualUspdController@storeCKEditorImages')->name('result-visual-uspds.storeCKEditorImages');
    Route::resource('result-visual-uspds', 'ResultVisualUspdController');

    // Journal Ptos
    Route::resource('journal-ptos', 'JournalPtoController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }
});
