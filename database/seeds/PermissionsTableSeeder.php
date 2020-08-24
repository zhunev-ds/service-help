<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 18,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 19,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 20,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 21,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 22,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 23,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 24,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 25,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 26,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 27,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 28,
                'title' => 'task_create',
            ],
            [
                'id'    => 29,
                'title' => 'task_edit',
            ],
            [
                'id'    => 30,
                'title' => 'task_show',
            ],
            [
                'id'    => 31,
                'title' => 'task_delete',
            ],
            [
                'id'    => 32,
                'title' => 'task_access',
            ],
            [
                'id'    => 33,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 34,
                'title' => 'content_management_access',
            ],
            [
                'id'    => 35,
                'title' => 'content_category_create',
            ],
            [
                'id'    => 36,
                'title' => 'content_category_edit',
            ],
            [
                'id'    => 37,
                'title' => 'content_category_show',
            ],
            [
                'id'    => 38,
                'title' => 'content_category_delete',
            ],
            [
                'id'    => 39,
                'title' => 'content_category_access',
            ],
            [
                'id'    => 40,
                'title' => 'content_tag_create',
            ],
            [
                'id'    => 41,
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => 42,
                'title' => 'content_tag_show',
            ],
            [
                'id'    => 43,
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => 44,
                'title' => 'content_tag_access',
            ],
            [
                'id'    => 45,
                'title' => 'content_page_create',
            ],
            [
                'id'    => 46,
                'title' => 'content_page_edit',
            ],
            [
                'id'    => 47,
                'title' => 'content_page_show',
            ],
            [
                'id'    => 48,
                'title' => 'content_page_delete',
            ],
            [
                'id'    => 49,
                'title' => 'content_page_access',
            ],
            [
                'id'    => 50,
                'title' => 'to_aii_access',
            ],
            [
                'id'    => 51,
                'title' => 'locatoin_equipment_access',
            ],
            [
                'id'    => 52,
                'title' => 'location_create',
            ],
            [
                'id'    => 53,
                'title' => 'location_edit',
            ],
            [
                'id'    => 54,
                'title' => 'location_show',
            ],
            [
                'id'    => 55,
                'title' => 'location_delete',
            ],
            [
                'id'    => 56,
                'title' => 'location_access',
            ],
            [
                'id'    => 57,
                'title' => 'mpoint_create',
            ],
            [
                'id'    => 58,
                'title' => 'mpoint_edit',
            ],
            [
                'id'    => 59,
                'title' => 'mpoint_show',
            ],
            [
                'id'    => 60,
                'title' => 'mpoint_delete',
            ],
            [
                'id'    => 61,
                'title' => 'mpoint_access',
            ],
            [
                'id'    => 62,
                'title' => 'zip_create',
            ],
            [
                'id'    => 63,
                'title' => 'zip_edit',
            ],
            [
                'id'    => 64,
                'title' => 'zip_show',
            ],
            [
                'id'    => 65,
                'title' => 'zip_delete',
            ],
            [
                'id'    => 66,
                'title' => 'zip_access',
            ],
            [
                'id'    => 67,
                'title' => 'proposal_create',
            ],
            [
                'id'    => 68,
                'title' => 'proposal_edit',
            ],
            [
                'id'    => 69,
                'title' => 'proposal_show',
            ],
            [
                'id'    => 70,
                'title' => 'proposal_delete',
            ],
            [
                'id'    => 71,
                'title' => 'proposal_access',
            ],
            [
                'id'    => 72,
                'title' => 'report_pto_access',
            ],
            [
                'id'    => 73,
                'title' => 'report_create',
            ],
            [
                'id'    => 74,
                'title' => 'report_edit',
            ],
            [
                'id'    => 75,
                'title' => 'report_show',
            ],
            [
                'id'    => 76,
                'title' => 'report_delete',
            ],
            [
                'id'    => 77,
                'title' => 'report_access',
            ],
            [
                'id'    => 78,
                'title' => 'visual_inspection_of_aii_create',
            ],
            [
                'id'    => 79,
                'title' => 'visual_inspection_of_aii_edit',
            ],
            [
                'id'    => 80,
                'title' => 'visual_inspection_of_aii_show',
            ],
            [
                'id'    => 81,
                'title' => 'visual_inspection_of_aii_delete',
            ],
            [
                'id'    => 82,
                'title' => 'visual_inspection_of_aii_access',
            ],
            [
                'id'    => 83,
                'title' => 'monitoring_status_of_md_create',
            ],
            [
                'id'    => 84,
                'title' => 'monitoring_status_of_md_edit',
            ],
            [
                'id'    => 85,
                'title' => 'monitoring_status_of_md_show',
            ],
            [
                'id'    => 86,
                'title' => 'monitoring_status_of_md_delete',
            ],
            [
                'id'    => 87,
                'title' => 'monitoring_status_of_md_access',
            ],
            [
                'id'    => 88,
                'title' => 'to_aiis_u_access',
            ],
            [
                'id'    => 89,
                'title' => 'report_u_access',
            ],
            [
                'id'    => 90,
                'title' => 'journal_voiar_access',
            ],
            [
                'id'    => 91,
                'title' => 'zip_u_access',
            ],
            [
                'id'    => 92,
                'title' => 'proposals_u_access',
            ],
            [
                'id'    => 93,
                'title' => 'state_aii_access',
            ],
            [
                'id'    => 94,
                'title' => 'state_aiis_u_access',
            ],
            [
                'id'    => 95,
                'title' => 'aiis_data_completeness_create',
            ],
            [
                'id'    => 96,
                'title' => 'aiis_data_completeness_edit',
            ],
            [
                'id'    => 97,
                'title' => 'aiis_data_completeness_show',
            ],
            [
                'id'    => 98,
                'title' => 'aiis_data_completeness_delete',
            ],
            [
                'id'    => 99,
                'title' => 'aiis_data_completeness_access',
            ],
            [
                'id'    => 100,
                'title' => 'aiis_with_orem_requirement_create',
            ],
            [
                'id'    => 101,
                'title' => 'aiis_with_orem_requirement_edit',
            ],
            [
                'id'    => 102,
                'title' => 'aiis_with_orem_requirement_show',
            ],
            [
                'id'    => 103,
                'title' => 'aiis_with_orem_requirement_delete',
            ],
            [
                'id'    => 104,
                'title' => 'aiis_with_orem_requirement_access',
            ],
            [
                'id'    => 105,
                'title' => 'aiis_documentation_update_create',
            ],
            [
                'id'    => 106,
                'title' => 'aiis_documentation_update_edit',
            ],
            [
                'id'    => 107,
                'title' => 'aiis_documentation_update_show',
            ],
            [
                'id'    => 108,
                'title' => 'aiis_documentation_update_delete',
            ],
            [
                'id'    => 109,
                'title' => 'aiis_documentation_update_access',
            ],
            [
                'id'    => 110,
                'title' => 'aiis_data_completeness_u_access',
            ],
            [
                'id'    => 111,
                'title' => 'aiis_with_orem_requirements_u_access',
            ],
            [
                'id'    => 112,
                'title' => 'aiis_documentation_update_u_access',
            ],
            [
                'id'    => 113,
                'title' => 'main_work_create',
            ],
            [
                'id'    => 114,
                'title' => 'main_work_edit',
            ],
            [
                'id'    => 115,
                'title' => 'main_work_show',
            ],
            [
                'id'    => 116,
                'title' => 'main_work_delete',
            ],
            [
                'id'    => 117,
                'title' => 'main_work_access',
            ],
            [
                'id'    => 118,
                'title' => 'analysis_work_aii_create',
            ],
            [
                'id'    => 119,
                'title' => 'analysis_work_aii_edit',
            ],
            [
                'id'    => 120,
                'title' => 'analysis_work_aii_show',
            ],
            [
                'id'    => 121,
                'title' => 'analysis_work_aii_delete',
            ],
            [
                'id'    => 122,
                'title' => 'analysis_work_aii_access',
            ],
            [
                'id'    => 123,
                'title' => 'data_collection_result_create',
            ],
            [
                'id'    => 124,
                'title' => 'data_collection_result_edit',
            ],
            [
                'id'    => 125,
                'title' => 'data_collection_result_show',
            ],
            [
                'id'    => 126,
                'title' => 'data_collection_result_delete',
            ],
            [
                'id'    => 127,
                'title' => 'data_collection_result_access',
            ],
            [
                'id'    => 128,
                'title' => 'data_collection_result_u_access',
            ],
            [
                'id'    => 129,
                'title' => 'server_analysi_create',
            ],
            [
                'id'    => 130,
                'title' => 'server_analysi_edit',
            ],
            [
                'id'    => 131,
                'title' => 'server_analysi_show',
            ],
            [
                'id'    => 132,
                'title' => 'server_analysi_delete',
            ],
            [
                'id'    => 133,
                'title' => 'server_analysi_access',
            ],
            [
                'id'    => 134,
                'title' => 'uspd_analysi_create',
            ],
            [
                'id'    => 135,
                'title' => 'uspd_analysi_edit',
            ],
            [
                'id'    => 136,
                'title' => 'uspd_analysi_show',
            ],
            [
                'id'    => 137,
                'title' => 'uspd_analysi_delete',
            ],
            [
                'id'    => 138,
                'title' => 'uspd_analysi_access',
            ],
            [
                'id'    => 139,
                'title' => 'result_visual_server_create',
            ],
            [
                'id'    => 140,
                'title' => 'result_visual_server_edit',
            ],
            [
                'id'    => 141,
                'title' => 'result_visual_server_show',
            ],
            [
                'id'    => 142,
                'title' => 'result_visual_server_delete',
            ],
            [
                'id'    => 143,
                'title' => 'result_visual_server_access',
            ],
            [
                'id'    => 144,
                'title' => 'result_visual_uspd_create',
            ],
            [
                'id'    => 145,
                'title' => 'result_visual_uspd_edit',
            ],
            [
                'id'    => 146,
                'title' => 'result_visual_uspd_show',
            ],
            [
                'id'    => 147,
                'title' => 'result_visual_uspd_delete',
            ],
            [
                'id'    => 148,
                'title' => 'result_visual_uspd_access',
            ],
            [
                'id'    => 149,
                'title' => 'journal_pto_access',
            ],
            [
                'id'    => 150,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
