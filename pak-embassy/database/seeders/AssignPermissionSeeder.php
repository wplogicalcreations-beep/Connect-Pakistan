<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Contracts\IRole;
use App\Contracts\IUserPermissions;
use App\Contracts\IPermissionModules;

class AssignPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Clean old data
        Permission::query()->delete();
        Module::query()->delete();
        // Create super admin role
        $superAdminRole = Role::firstOrCreate([
            'name' => IRole::SUPER_ADMIN,
            'guard_name' => 'web'
        ]);

        // Mapping: Modules => Permissions
        $modules = [
            IPermissionModules::DASHBOARD_MODULE => [
                IUserPermissions::VIEW_PAK_EMBASSY_DASHBOARD,
            ],
            IPermissionModules::INDIVIDUAL_USER_MANAGEMENT_MODULE => [
                IUserPermissions::MANAGE_INDIVIDUAL_USERS,
                IUserPermissions::VIEW_INDIVIDUAL_USERS,
                IUserPermissions::EDIT_INDIVIDUAL_USERS,
                IUserPermissions::DELETE_INDIVIDUAL_USERS,
            ],
            IPermissionModules::ORGANIZATION_USER_MANAGEMENT_MODULE => [
                IUserPermissions::MANAGE_ORGANIZATION_USERS,
                IUserPermissions::VIEW_ORGANIZATION_USERS,
                IUserPermissions::EDIT_ORGANIZATION_USERS,
                IUserPermissions::DELETE_ORGANIZATION_USERS,
            ],
            IPermissionModules::EVENT_MANAGEMENT_MODULE => [
                IUserPermissions::MANAGE_EVENTS,
                IUserPermissions::VIEW_EVENTS,
                IUserPermissions::CREATE_EVENTS,
                IUserPermissions::EDIT_EVENTS,
                IUserPermissions::DELETE_EVENTS,
            ],
            IPermissionModules::JOBS_BOARD_MODULE => [
                IUserPermissions::MANAGE_JOBS_BOARD,
                IUserPermissions::VIEW_JOBS_BOARD,
                IUserPermissions::EDIT_JOBS_BOARD,
            ],
            IPermissionModules::INDIVIDUAL_MATCHMAKING_MODULE => [
                IUserPermissions::MANAGE_INDIVIDUAL_MATCHMAKING,
                IUserPermissions::VIEW_INDIVIDUAL_MATCHMAKING,
            ],
            IPermissionModules::ORGANIZATION_MATCHMAKING_MODULE => [
                IUserPermissions::MANAGE_ORGANIZATION_MATCHMAKING,
                IUserPermissions::VIEW_ORGANIZATION_MATCHMAKING,
            ],
            IPermissionModules::CO_WORKSPACE_MODULE => [
                IUserPermissions::MANAGE_CO_WORKSPACE,
                IUserPermissions::VIEW_CO_WORKSPACE,
                IUserPermissions::CREATE_CO_WORKSPACE,
                IUserPermissions::VIEW_CO_WORKSPACE_REQUEST,
            ],
            IPermissionModules::CRM_DASHBOARD_MODULE => [
                IUserPermissions::MANAGE_CRM_DASHBOARD,
                IUserPermissions::VIEW_CRM_DASHBOARD,
            ],
            IPermissionModules::USERS_MODULE => [
                IUserPermissions::MANAGE_USERS,
                IUserPermissions::VIEW_USER,
                IUserPermissions::EDIT_USER,
                IUserPermissions::DELETE_USER,
                IUserPermissions::CREATE_USER,
            ],
            IPermissionModules::ROLES_MODULE => [
                IUserPermissions::MANAGE_ROLES,
                IUserPermissions::VIEW_ROLE,
                IUserPermissions::EDIT_ROLE,
                IUserPermissions::DELETE_ROLE,
                IUserPermissions::CREATE_ROLE,
            ],
            IPermissionModules::DEPARTMENTS_MODULE => [
                IUserPermissions::MANAGE_DEPARTMENTS,
                IUserPermissions::VIEW_DEPARTMENT,
                IUserPermissions::EDIT_DEPARTMENT,
                IUserPermissions::DELETE_DEPARTMENT,
                IUserPermissions::CREATE_DEPARTMENT,
            ],
            IPermissionModules::MANAGE_PERMISSION_MODULE => [
                IUserPermissions::MANAGE_PERMISSIONS,
                IUserPermissions::VIEW_PERMISSIONS,
                IUserPermissions::EDIT_PERMISSIONS,
            ],
            IPermissionModules::SKILLS_MODULE => [
                IUserPermissions::MANAGE_SKILLS,
                IUserPermissions::VIEW_SKILLS,
                IUserPermissions::EDIT_SKILLS,
                IUserPermissions::DELETE_SKILLS,
                IUserPermissions::CREATE_SKILLS,
            ],
            IPermissionModules::LEVELS_MODULE => [
                IUserPermissions::MANAGE_LEVELS,
                IUserPermissions::VIEW_LEVELS,
                IUserPermissions::EDIT_LEVELS,
                IUserPermissions::DELETE_LEVELS,
                IUserPermissions::CREATE_LEVELS,
            ],
            IPermissionModules::INFLUENCE_ABILITY_MODULE => [
                IUserPermissions::MANAGE_INFLUENCE_ABILITY,
                IUserPermissions::VIEW_INFLUENCE_ABILITY,
                IUserPermissions::EDIT_INFLUENCE_ABILITY,
                IUserPermissions::DELETE_INFLUENCE_ABILITY,
                IUserPermissions::CREATE_INFLUENCE_ABILITY,
            ],
            IPermissionModules::INDUSTRY_AREA_MODULE => [
                IUserPermissions::MANAGE_INDUSTRY_AREA,
                IUserPermissions::VIEW_INDUSTRY_AREA,
                IUserPermissions::EDIT_INDUSTRY_AREA,
                IUserPermissions::DELETE_INDUSTRY_AREA,
                IUserPermissions::CREATE_INDUSTRY_AREA,
            ],
            IPermissionModules::WORD_DOMAIN_MODULE => [
                IUserPermissions::MANAGE_WORK_DOMAIN,
                IUserPermissions::VIEW_WORK_DOMAIN,
                IUserPermissions::EDIT_WORK_DOMAIN,
                IUserPermissions::DELETE_WORK_DOMAIN,
                IUserPermissions::CREATE_WORK_DOMAIN,
            ],
            IPermissionModules::HOME_PAGE_TEMPLATE_MODULE => [
                IUserPermissions::MANAGE_HOME_PAGE_TEMPLATE,
                IUserPermissions::VIEW_HOME_PAGE_TEMPLATE,
                IUserPermissions::EDIT_HOME_PAGE_TEMPLATE,
            ],
            IPermissionModules::REPORTS_MODULE => [
                IUserPermissions::MANAGE_REPORTS,
                IUserPermissions::VIEW_USER_REGISTRATION_REPORT,
                IUserPermissions::VIEW_JOB_POSTING_REPORT,
                IUserPermissions::VIEW_EVENTS_REPORT,
                IUserPermissions::VIEW_CO_WORKSPACE_REPORT,
                IUserPermissions::VIEW_MATCHMAKING_REPORT,
            ],
            IPermissionModules::GENERAL_SETTINGS_MODULE => [
                IUserPermissions::MANAGE_GENERAL_SETTINGS,
                IUserPermissions::VIEW_GENERAL_SETTINGS,
                IUserPermissions::EDIT_GENERAL_SETTINGS,
            ],
        ];

        // Insert modules and related permissions
        foreach ($modules as $moduleConst => $permissions) {
            // Create module record
            $module = Module::firstOrCreate(['name' => $moduleConst]);

            // Add permissions under this module
            foreach ($permissions as $permissionName) {
                $permission = Permission::firstOrCreate([
                    'name'       => $permissionName,
                    'guard_name' => 'web',
                    'module_id'  => $module->id,
                ]);

                $superAdminRole->givePermissionTo($permission);
            }
        }

    }

}
