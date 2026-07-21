<?php

namespace App\Contracts;

interface IUserPermissions
{
    public const DASHBOARD = 'dashboard';
    public const VIEW_PAK_EMBASSY_DASHBOARD = 'view_pak_embassy_dashboard';

    public const MANAGE_INDIVIDUAL_USERS = 'manage_individual_users';
    public const VIEW_INDIVIDUAL_USERS = 'view_individual_users';
    public const EDIT_INDIVIDUAL_USERS = 'edit_individual_users';
    public const DELETE_INDIVIDUAL_USERS = 'delete_individual_users';

    public const MANAGE_ORGANIZATION_USERS = 'manage_organization_users';
    public const VIEW_ORGANIZATION_USERS = 'view_organization_users';
    public const EDIT_ORGANIZATION_USERS = 'edit_organization_users';
    public const DELETE_ORGANIZATION_USERS = 'delete_organization_users';

    public const MANAGE_EVENTS = 'manage_events';
    public const VIEW_EVENTS = 'view_events';
    public const CREATE_EVENTS = 'create_events';
    public const EDIT_EVENTS = 'edit_events';
    public const DELETE_EVENTS = 'delete_events';

    public const MANAGE_JOBS_BOARD = 'manage_jobs_boards';
    public const VIEW_JOBS_BOARD = 'view_jobs_boards';
    public const EDIT_JOBS_BOARD = 'edit_jobs_boards';

    public const MANAGE_INDIVIDUAL_MATCHMAKING = 'manage_individual_matchmaking';
    public const VIEW_INDIVIDUAL_MATCHMAKING = 'view_individual_matchmaking';

    public const MANAGE_ORGANIZATION_MATCHMAKING = 'manage_organization_matchmaking';
    public const VIEW_ORGANIZATION_MATCHMAKING = 'view_organization_matchmaking';

    public const MANAGE_CO_WORKSPACE = 'manage_co_workspace';
    public const VIEW_CO_WORKSPACE = 'view_co_workspace';
    public const CREATE_CO_WORKSPACE = 'create_co_workspace';
    public const VIEW_CO_WORKSPACE_REQUEST = 'view_co_workspace_request';

    public const MANAGE_CRM_DASHBOARD = 'manage_crm_dashboard';
    public const VIEW_CRM_DASHBOARD = 'view_crm_dashboard';

    public const MANAGE_USERS = 'manage_users';
    public const VIEW_USER = 'view_user';
    public const EDIT_USER = 'edit_user';
    public const DELETE_USER = 'delete_user';
    public const CREATE_USER = 'create_user';

    public const MANAGE_ROLES = 'manage_roles';
    public const VIEW_ROLE = 'view_role';
    public const EDIT_ROLE = 'edit_role';
    public const DELETE_ROLE = 'delete_role';
    public const CREATE_ROLE = 'create_role';

    public const MANAGE_DEPARTMENTS = 'manage_departments';
    public const VIEW_DEPARTMENT = 'view_department';
    public const EDIT_DEPARTMENT = 'edit_department';
    public const DELETE_DEPARTMENT = 'delete_department';
    public const CREATE_DEPARTMENT = 'create_department';

    public const MANAGE_PERMISSIONS = 'manage_permissions';
    public const VIEW_PERMISSIONS = 'view_permissions';
    public const EDIT_PERMISSIONS = 'edit_permissions';

    public const MANAGE_SKILLS = 'manage_skills';
    public const VIEW_SKILLS = 'view_skills';
    public const EDIT_SKILLS = 'edit_skills';
    public const DELETE_SKILLS = 'delete_skills';
    public const CREATE_SKILLS = 'create_skills';

    public const MANAGE_LEVELS = 'manage_levels';
    public const VIEW_LEVELS = 'view_levels';
    public const EDIT_LEVELS = 'edit_levels';
    public const DELETE_LEVELS = 'delete_levels';
    public const CREATE_LEVELS = 'create_levels';

    public const MANAGE_INFLUENCE_ABILITY = 'manage_influence_ability';
    public const VIEW_INFLUENCE_ABILITY = 'view_influence_ability';
    public const EDIT_INFLUENCE_ABILITY = 'edit_influence_ability';
    public const DELETE_INFLUENCE_ABILITY = 'delete_influence_ability';
    public const CREATE_INFLUENCE_ABILITY = 'create_influence_ability';

    public const MANAGE_INDUSTRY_AREA = 'manage_industry_area';
    public const VIEW_INDUSTRY_AREA = 'view_industry_area';
    public const EDIT_INDUSTRY_AREA = 'edit_industry_area';
    public const DELETE_INDUSTRY_AREA = 'delete_industry_area';
    public const CREATE_INDUSTRY_AREA = 'create_industry_area';

    public const MANAGE_WORK_DOMAIN = 'manage_work_domain';
    public const VIEW_WORK_DOMAIN = 'view_work_domain';
    public const EDIT_WORK_DOMAIN = 'edit_work_domain';
    public const DELETE_WORK_DOMAIN = 'delete_work_domain';
    public const CREATE_WORK_DOMAIN = 'create_work_domain';

    public const MANAGE_HOME_PAGE_TEMPLATE = 'manage_home_page_template';
    public const VIEW_HOME_PAGE_TEMPLATE = 'view_home_page_template';
    public const EDIT_HOME_PAGE_TEMPLATE = 'edit_home_page_template';

    public const MANAGE_REPORTS = 'manage_reports';
    public const VIEW_USER_REGISTRATION_REPORT = 'view_user_registration_report';
    public const VIEW_JOB_POSTING_REPORT = 'view_job_posting_report';
    public const VIEW_EVENTS_REPORT = 'view_events_report';
    public const VIEW_CO_WORKSPACE_REPORT = 'view_co_workspace_report';
    public const VIEW_MATCHMAKING_REPORT = 'view_MATCHMAKING_report';

    public const MANAGE_GENERAL_SETTINGS = 'manage_general_settings';
    public const VIEW_GENERAL_SETTINGS = 'view_general_settings';
    public const EDIT_GENERAL_SETTINGS = 'edit_general_settings';

    // public const LEADS = 'leads';
    // public const VIEW_LEADS= 'view_leads';
    // public const EDIT_LEADS = 'edit_leads';
    // public const DELETE_LEADS = 'delete_leads';
    // public const CREATE_LEADS = 'create_leads';
}
