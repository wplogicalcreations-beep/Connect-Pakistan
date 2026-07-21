<?php

use App\Contracts\IPermissionModules;
use \App\Contracts\IUserPermissions;

return [
    IPermissionModules::DASHBOARD_MODULE => [
        IUserPermissions::VIEW_PAK_EMBASSY_DASHBOARD,
    ],
    IPermissionModules::INDIVIDUAL_USER_MANAGEMENT_MODULE => [
        IUserPermissions::VIEW_INDIVIDUAL_USERS,
        IUserPermissions::EDIT_INDIVIDUAL_USERS,
        IUserPermissions::DELETE_INDIVIDUAL_USERS,
    ],
    IPermissionModules::ORGANIZATION_USER_MANAGEMENT_MODULE => [
        IUserPermissions::VIEW_ORGANIZATION_USERS,
        IUserPermissions::EDIT_ORGANIZATION_USERS,
        IUserPermissions::DELETE_ORGANIZATION_USERS,
    ],
    IPermissionModules::EVENT_MANAGEMENT_MODULE => [
        IUserPermissions::VIEW_EVENTS,
        IUserPermissions::CREATE_EVENTS,
        IUserPermissions::EDIT_EVENTS,
        IUserPermissions::DELETE_EVENTS,
    ],
    IPermissionModules::JOBS_BOARD_MODULE => [
        IUserPermissions::VIEW_JOBS_BOARD,
        IUserPermissions::EDIT_JOBS_BOARD,
    ],
    IPermissionModules::INDIVIDUAL_MATCHMAKING_MODULE => [
        IUserPermissions::VIEW_INDIVIDUAL_MATCHMAKING,
    ],
    IPermissionModules::ORGANIZATION_MATCHMAKING_MODULE => [
        IUserPermissions::VIEW_ORGANIZATION_MATCHMAKING,
    ],
    IPermissionModules::CO_WORKSPACE_MODULE => [
        IUserPermissions::VIEW_CO_WORKSPACE,
        IUserPermissions::CREATE_CO_WORKSPACE,
        IUserPermissions::VIEW_CO_WORKSPACE_REQUEST,
    ],
    IPermissionModules::CRM_DASHBOARD_MODULE => [
        IUserPermissions::VIEW_CRM_DASHBOARD,
    ],
    IPermissionModules::USERS_MODULE => [
        IUserPermissions::VIEW_USER,
        IUserPermissions::EDIT_USER,
        IUserPermissions::DELETE_USER,
        IUserPermissions::CREATE_USER,
    ],
    IPermissionModules::ROLES_MODULE => [
        IUserPermissions::VIEW_ROLE,
        IUserPermissions::EDIT_ROLE,
        IUserPermissions::DELETE_ROLE,
        IUserPermissions::CREATE_ROLE,
    ],
    IPermissionModules::DEPARTMENTS_MODULE => [
        IUserPermissions::VIEW_DEPARTMENT,
        IUserPermissions::EDIT_DEPARTMENT,
        IUserPermissions::DELETE_DEPARTMENT,
        IUserPermissions::CREATE_DEPARTMENT,
    ],
    IPermissionModules::MANAGE_PERMISSION_MODULE => [
        IUserPermissions::VIEW_PERMISSIONS,
        IUserPermissions::EDIT_PERMISSIONS,
    ],
    IPermissionModules::SKILLS_MODULE => [
        IUserPermissions::VIEW_SKILLS,
        IUserPermissions::EDIT_SKILLS,
        IUserPermissions::DELETE_SKILLS,
        IUserPermissions::CREATE_SKILLS,
    ],
    IPermissionModules::LEVELS_MODULE => [
        IUserPermissions::VIEW_LEVELS,
        IUserPermissions::EDIT_LEVELS,
        IUserPermissions::DELETE_LEVELS,
        IUserPermissions::CREATE_LEVELS,
    ],
    IPermissionModules::INFLUENCE_ABILITY_MODULE => [
        IUserPermissions::VIEW_INFLUENCE_ABILITY,
        IUserPermissions::EDIT_INFLUENCE_ABILITY,
        IUserPermissions::DELETE_INFLUENCE_ABILITY,
        IUserPermissions::CREATE_INFLUENCE_ABILITY,
    ],
    IPermissionModules::INDUSTRY_AREA_MODULE => [
        IUserPermissions::VIEW_INDUSTRY_AREA,
        IUserPermissions::EDIT_INDUSTRY_AREA,
        IUserPermissions::DELETE_INDUSTRY_AREA,
        IUserPermissions::CREATE_INDUSTRY_AREA,
    ],
    IPermissionModules::WORD_DOMAIN_MODULE => [
        IUserPermissions::VIEW_WORK_DOMAIN,
        IUserPermissions::EDIT_WORK_DOMAIN,
        IUserPermissions::DELETE_WORK_DOMAIN,
        IUserPermissions::CREATE_WORK_DOMAIN,
    ],
    IPermissionModules::HOME_PAGE_TEMPLATE_MODULE => [
        IUserPermissions::VIEW_HOME_PAGE_TEMPLATE,
        IUserPermissions::EDIT_HOME_PAGE_TEMPLATE,
    ],
    IPermissionModules::REPORTS_MODULE => [
        IUserPermissions::VIEW_USER_REGISTRATION_REPORT,
        IUserPermissions::VIEW_JOB_POSTING_REPORT,
        IUserPermissions::VIEW_EVENTS_REPORT,
        IUserPermissions::VIEW_CO_WORKSPACE_REPORT,
        IUserPermissions::VIEW_MATCHMAKING_REPORT,
    ],
    IPermissionModules::GENERAL_SETTINGS_MODULE => [
        IUserPermissions::VIEW_GENERAL_SETTINGS,
        IUserPermissions::EDIT_GENERAL_SETTINGS,
    ],
    // IPermissionModules::LEADS_MODULE => [
    //     IUserPermissions::VIEW_LEADS,
    //     IUserPermissions::EDIT_LEADS,
    //     IUserPermissions::DELETE_LEADS,
    //     IUserPermissions::CREATE_LEADS,
    // ],
];
