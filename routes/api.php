<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
    Route::apiResource('users', 'UsersApiController');

    // Task Statuses
    Route::apiResource('task-statuses', 'TaskStatusApiController');

    // Task Tags
    Route::apiResource('task-tags', 'TaskTagApiController');

    // Tasks
    Route::post('tasks/media', 'TaskApiController@storeMedia')->name('tasks.storeMedia');
    Route::apiResource('tasks', 'TaskApiController');

    // Content Categories
    Route::apiResource('content-categories', 'ContentCategoryApiController');

    // Content Tags
    Route::apiResource('content-tags', 'ContentTagApiController');

    // Content Pages
    Route::post('content-pages/media', 'ContentPageApiController@storeMedia')->name('content-pages.storeMedia');
    Route::apiResource('content-pages', 'ContentPageApiController');

    // Locations
    Route::apiResource('locations', 'LocationApiController');

    // Mpoints
    Route::apiResource('mpoints', 'MpointApiController');

    // Zips
    Route::apiResource('zips', 'ZipApiController');

    // Proposals
    Route::post('proposals/media', 'ProposalsApiController@storeMedia')->name('proposals.storeMedia');
    Route::apiResource('proposals', 'ProposalsApiController');

    // Reports
    Route::apiResource('reports', 'ReportApiController');

    // Visual Inspection Of Aiis
    Route::post('visual-inspection-of-aiis/media', 'VisualInspectionOfAiisApiController@storeMedia')->name('visual-inspection-of-aiis.storeMedia');
    Route::apiResource('visual-inspection-of-aiis', 'VisualInspectionOfAiisApiController');

    // Monitoring Status Of Mds
    Route::post('monitoring-status-of-mds/media', 'MonitoringStatusOfMdApiController@storeMedia')->name('monitoring-status-of-mds.storeMedia');
    Route::apiResource('monitoring-status-of-mds', 'MonitoringStatusOfMdApiController');

    // Aiis Data Completenesses
    Route::post('aiis-data-completenesses/media', 'AiisDataCompletenessApiController@storeMedia')->name('aiis-data-completenesses.storeMedia');
    Route::apiResource('aiis-data-completenesses', 'AiisDataCompletenessApiController');

    // Aiis With Orem Requirements
    Route::apiResource('aiis-with-orem-requirements', 'AiisWithOremRequirementsApiController');

    // Aiis Documentation Updates
    Route::post('aiis-documentation-updates/media', 'AiisDocumentationUpdateApiController@storeMedia')->name('aiis-documentation-updates.storeMedia');
    Route::apiResource('aiis-documentation-updates', 'AiisDocumentationUpdateApiController');

    // Main Works
    Route::post('main-works/media', 'MainWorkApiController@storeMedia')->name('main-works.storeMedia');
    Route::apiResource('main-works', 'MainWorkApiController');

    // Analysis Work Aiis
    Route::post('analysis-work-aiis/media', 'AnalysisWorkAiisApiController@storeMedia')->name('analysis-work-aiis.storeMedia');
    Route::apiResource('analysis-work-aiis', 'AnalysisWorkAiisApiController');

    // Data Collection Results
    Route::post('data-collection-results/media', 'DataCollectionResultApiController@storeMedia')->name('data-collection-results.storeMedia');
    Route::apiResource('data-collection-results', 'DataCollectionResultApiController');

    // Server Analysis
    Route::post('server-analysis/media', 'ServerAnalysisApiController@storeMedia')->name('server-analysis.storeMedia');
    Route::apiResource('server-analysis', 'ServerAnalysisApiController');

    // Uspd Analysis
    Route::post('uspd-analysis/media', 'UspdAnalysisApiController@storeMedia')->name('uspd-analysis.storeMedia');
    Route::apiResource('uspd-analysis', 'UspdAnalysisApiController');

    // Result Visual Servers
    Route::post('result-visual-servers/media', 'ResultVisualServerApiController@storeMedia')->name('result-visual-servers.storeMedia');
    Route::apiResource('result-visual-servers', 'ResultVisualServerApiController');

    // Result Visual Uspds
    Route::post('result-visual-uspds/media', 'ResultVisualUspdApiController@storeMedia')->name('result-visual-uspds.storeMedia');
    Route::apiResource('result-visual-uspds', 'ResultVisualUspdApiController');
});
