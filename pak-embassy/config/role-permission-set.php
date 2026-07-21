<?php

use App\Contracts\IPermissionModules;
use App\Contracts\IRole;
use App\Contracts\IUserPermissions;

return [
    'roles-set' => [
        IRole::SUPER_ADMIN => 'Super Admin',
        IRole::CUSTOMER => 'Customer',
        IRole::ORGANIZATION_ADMIN => 'Organization Admin'
    ],
    'permission-set' => [
        IUserPermissions::VIEW_PAK_EMBASSY_DASHBOARD => 'View Pak Embassy Dashboard',

        IUserPermissions::VIEW_INDIVIDUAL_USERS => 'View Individual Users',
        IUserPermissions::EDIT_INDIVIDUAL_USERS => 'Edit Individual Users',
        IUserPermissions::DELETE_INDIVIDUAL_USERS => 'Delete Individual Users',

        IUserPermissions::VIEW_ORGANIZATION_USERS => 'View Organization Users',
        IUserPermissions::EDIT_ORGANIZATION_USERS => 'Edit Organization Users',
        IUserPermissions::DELETE_ORGANIZATION_USERS => 'Delete Organization Users',

        IUserPermissions::VIEW_EVENTS => 'View Events',
        IUserPermissions::CREATE_EVENTS => 'Create Events',
        IUserPermissions::EDIT_EVENTS => 'Edit Events',
        IUserPermissions::DELETE_EVENTS => 'Delete Events',

        IUserPermissions::VIEW_JOBS_BOARD => 'View Jobs Board',
        IUserPermissions::EDIT_JOBS_BOARD => 'Edit Jobs Board',

        IUserPermissions::VIEW_INDIVIDUAL_MATCHMAKING => 'View Individual Matchmaking',

        IUserPermissions::VIEW_ORGANIZATION_MATCHMAKING => 'View Organization Matchmaking',

        IUserPermissions::VIEW_CO_WORKSPACE => 'View Co Workspace',
        IUserPermissions::CREATE_CO_WORKSPACE => 'Create Co Workspace',
        IUserPermissions::VIEW_CO_WORKSPACE_REQUEST => 'View Co Workspace request',

        IUserPermissions::VIEW_CRM_DASHBOARD => 'View Crm dashboard',

        IUserPermissions::VIEW_USER => 'View User',
        IUserPermissions::EDIT_USER => 'Edit User',
        IUserPermissions::DELETE_USER => 'Delete User',
        IUserPermissions::CREATE_USER => 'Create User',

        IUserPermissions::VIEW_ROLE => 'View Role',
        IUserPermissions::EDIT_ROLE => 'Edit Role',
        IUserPermissions::DELETE_ROLE => 'Delete Role',
        IUserPermissions::CREATE_ROLE => 'Create Role',

        IUserPermissions::VIEW_DEPARTMENT => 'View Department',
        IUserPermissions::EDIT_DEPARTMENT => 'Edit Department',
        IUserPermissions::DELETE_DEPARTMENT => 'Delete Department',
        IUserPermissions::CREATE_DEPARTMENT => 'Create Department',

        IUserPermissions::VIEW_PERMISSIONS => 'View Permissions',
        IUserPermissions::EDIT_PERMISSIONS => 'Edit Permissions',

        IUserPermissions::VIEW_SKILLS => 'View Skills',
        IUserPermissions::EDIT_SKILLS => 'Edit Skills',
        IUserPermissions::DELETE_SKILLS => 'Delete Skills',
        IUserPermissions::CREATE_SKILLS => 'Create Skills',

        IUserPermissions::VIEW_LEVELS => 'View Levels',
        IUserPermissions::EDIT_LEVELS => 'Edit Levels',
        IUserPermissions::DELETE_LEVELS => 'Delete Levels',
        IUserPermissions::CREATE_LEVELS => 'Create Levels',

        IUserPermissions::VIEW_INFLUENCE_ABILITY => 'View Influence Ability',
        IUserPermissions::EDIT_INFLUENCE_ABILITY => 'Edit Influence Ability',
        IUserPermissions::DELETE_INFLUENCE_ABILITY => 'Delete Influence Ability',
        IUserPermissions::CREATE_INFLUENCE_ABILITY => 'Create Influence Ability',

        IUserPermissions::VIEW_INDUSTRY_AREA => 'View Industry Area',
        IUserPermissions::EDIT_INDUSTRY_AREA => 'Edit Industry Area',
        IUserPermissions::DELETE_INDUSTRY_AREA => 'Delete Industry Area',
        IUserPermissions::CREATE_INDUSTRY_AREA => 'Create Industry Area',

        IUserPermissions::VIEW_WORK_DOMAIN => 'View Work Domain',
        IUserPermissions::EDIT_WORK_DOMAIN => 'Edit Work Domain',
        IUserPermissions::DELETE_WORK_DOMAIN => 'Delete Work Domain',
        IUserPermissions::CREATE_WORK_DOMAIN => 'Create Work Domain',

        IUserPermissions::VIEW_HOME_PAGE_TEMPLATE => 'View Home Page Template',
        IUserPermissions::EDIT_HOME_PAGE_TEMPLATE => 'Edit Home Page Template',

        IUserPermissions::VIEW_USER_REGISTRATION_REPORT => 'View User Registeration report',
        IUserPermissions::VIEW_JOB_POSTING_REPORT => 'View Job Posting Report',
        IUserPermissions::VIEW_EVENTS_REPORT => 'View Events Report',
        IUserPermissions::VIEW_CO_WORKSPACE_REPORT => 'View Co Workspace Report ',
        IUserPermissions::VIEW_MATCHMAKING_REPORT => 'View Matchmaking Report',

        IUserPermissions::VIEW_GENERAL_SETTINGS => 'View General Settings',
        IUserPermissions::EDIT_GENERAL_SETTINGS => 'Edit General Settings',

        // IUserPermissions::VIEW_LEADS => 'View Leads',
        // IUserPermissions::EDIT_LEADS => 'Edit Leads',
        // IUserPermissions::DELETE_LEADS => 'Delete Vendor Commission',
        // IUserPermissions::CREATE_LEADS => 'Create Vendor Commission',
    ],
    'module-permission-set' => [
        IRole::SUPER_ADMIN => config('modules-permission'),
    ]
];
