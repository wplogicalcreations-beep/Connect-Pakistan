<div class="iq-sidebar">
  <div id="sidebar-scrollbar" class="overflow-auto" tabindex="-1">
    <div class="scroll-content">
      <nav class="iq-sidebar-menu">
        <ul id="iq-sidebar-toggle" class="iq-menu list-unstyled">
          <div class="main-logo">
            <img src="{{ asset('images/Logo.png') }}" alt="Project Logo">
            <div class="close-sidebar">
              <i class="fa-solid fa-xmark"></i>
            </div>
          </div>

          {{-- Dashboard --}}
          @can('view_pak_embassy_dashboard')
          <li class="{{ Request::is('dashboard') ? 'active mainDash show' : '' }}">
            <a href="{{ url('dashboard') }}" class="text-decoration-none">
              <img class="mr-2 radius-image" src="{{ asset('images/dash-logo.svg') }}" alt="Dashboard logo">
              Dashboard
            </a>
          </li>
          @endcan

          {{-- User Management --}}
          @canany(['manage_individual_users', 'manage_organization_users'])
          @php
            $umActive = Request::is('skilled-individuals') || Request::is('organizations') || Request::routeIs('skilled_individuals.show') || Request::routeIs('organizations.show');
          @endphp
          <li class="liMain {{ $umActive ? 'active' : '' }}">
            <a href="#Complaints" class="activeParent" data-bs-toggle="collapse" aria-expanded="{{ $umActive ? 'true' : 'false' }}">
              <img class="mr-2 radius-image sub-side" src="{{ asset('images/user_management.svg') }}" alt="User Management">
              <span class="parent">User Management</span>
              <i class="fa-solid fa-angle-down text-light"></i>
            </a>
            <ul id="Complaints" class="iq-submenu collapse child {{ $umActive ? 'show' : '' }}">
              @can('manage_individual_users')
              <li id="child">
                <a href="{{ url('skilled-individuals') }}" class="{{ Request::is('skilled-individuals') || Request::routeIs('skilled_individuals.show') ? 'childActive' : '' }}"><span>Skilled Individuals</span></a>
              </li>
              @endcan
              @can('manage_organization_users')
              <li id="child">
                <a href="{{ url('organizations') }}" class="{{ Request::is('organizations') || Request::routeIs('organizations.show') ? 'childActive' : '' }}"><span>Organizations</span></a>
              </li>
              @endcan
            </ul>
          </li>
          @endcanany

          {{-- Event Management --}}
          @can('manage_events')
          <li class="{{ Request::is('events') ? 'active' : '' }}">
            <a href="{{ url('events') }}" class="text-decoration-none">
              <img class="mr-2 radius-image sub-side" src="{{ asset('images/event-mgt.svg') }}" alt="Events logo">
              Event Management
            </a>
          </li>
          @endcan

          {{-- Jobs Board --}}
          @can('manage_jobs_boards')
          <li class="{{ Request::is('jobs-board') ? 'active' : '' }}">
            <a href="{{ route('jobs-board.index') }}" class="text-decoration-none">
              <img class="mr-2 radius-image sub-side" src="{{ asset('images/jobs-boards.svg') }}" alt="Jobs Board">
              Jobs Board
            </a>
          </li>
          @endcan

          {{-- Matchmaking --}}
          @canany(['manage_individual_matchmaking', 'manage_organization_matchmaking'])
          @php
            $mmActive = Request::is('match-making/individual') || Request::is('match-making/organization') || Request::routeIs('individual.view-match-making-individual') || Request::routeIs('organization.view-match-making-organization');
          @endphp
          <li class="liMain {{ $mmActive ? 'active' : '' }}">
              <a href="#match-making" class="activeParent" data-bs-toggle="collapse"
                  aria-expanded="{{ $mmActive ? 'true' : 'false' }}">
                  <img class="mr-2 radius-image sub-side" src="{{asset('images/matchmaking.svg')}}"
                        alt="Booking Logo">
                  <span class="parent">Matchmaking</span>
                  <i class="fa-solid fa-angle-down text-light"></i>
              </a>
              <ul id="match-making" class="iq-submenu collapse child {{ $mmActive ? 'show' : '' }}">
                  @can('manage_individual_matchmaking')
                  <li id="child">
                      <a href="{{ route('individual.index') }}" class="{{ Request::is('match-making/individual') || Request::routeIs('individual.view-match-making-individual') ? 'childActive' : '' }}">
                          <span>Individuals</span>
                      </a>
                  </li>
                  @endcan
                  @can('manage_organization_matchmaking')
                  <li id="child">
                      <a href="{{ route('organization.index') }}" class="{{ Request::is('match-making/organization') || Request::routeIs('organization.view-match-making-organization') ? 'childActive' : '' }}">
                          <span>Organizations</span>
                      </a>
                  </li>
                  @endcan
              </ul>
          </li>
          @endcanany

          {{-- Co-WorkSpace --}}
          @can('manage_co_workspace')
          @php
            $cwActive = Request::is('co-working-space') || Request::is('co-working-space/requests') || Request::is('create-co-working-space');
          @endphp
          <li class="liMain {{ $cwActive ? 'active' : '' }}">
            <a href="#Logs" class="activeParent" data-bs-toggle="collapse" aria-expanded="{{ $cwActive ? 'true' : 'false' }}">
              <img class="mr-2 radius-image sub-side" src="{{ asset('images/cow-wrkr.svg') }}" alt="Co-WorkSpace">
              <span class="parent">Co-working Space</span>
              <i class="fa-solid fa-angle-down text-light"></i>
            </a>
            <ul id="Logs" class="iq-submenu collapse child {{ $cwActive ? 'show' : '' }}">
              @can('view_co_workspace')
              <li id="child">
                <a href="{{ url('co-working-space') }}" class="{{ Request::is('co-working-space') || Request::is('create-co-working-space') ? 'childActive' : '' }}"><span>List</span></a>
              </li>
              @endcan
              @can('view_co_workspace_request')
              <li id="child">
                <a href="{{ url('co-working-space/requests') }}" class="{{ Request::is('co-working-space/requests') ? 'childActive' : '' }}"><span>Requests</span></a>
              </li>
              @endcan
            </ul>
          </li>
          @endcan

          {{-- CRM --}}
          @can('manage_crm_dashboard')
          @php
            $crmActive = Request::is('crm/dashboard') || Request::is('crm/dashboard/*') || Request::is('crm/leads');
          @endphp
          <li class="liMain {{ $crmActive ? 'active' : '' }}">
            <a href="#commission-slabs" class="activeParent" data-bs-toggle="collapse" aria-expanded="{{ $crmActive ? 'true' : 'false' }}">
              <img class="mr-2 radius-image sub-side" src="{{ asset('images/crm-logo.svg') }}" alt="CRM">
              <span class="parent">CRM</span>
              <i class="fa-solid fa-angle-down text-light"></i>
            </a>
            <ul id="commission-slabs" class="iq-submenu collapse child {{ $crmActive ? 'show' : '' }}">
              @can('view_crm_dashboard')
              <li id="child">
                <a href="{{ url('crm/dashboard') }}" class="{{ Request::is('crm/dashboard') || Request::is('crm/dashboard/*') ? 'childActive' : '' }}"><span>Dashboard</span></a>
              </li>
              @endcan
              {{-- uncomment later --}}
              {{-- <li id="child">
                <a href="{{ url('crm/leads') }}" class="{{ Request::is('crm/leads') ? 'childActive' : '' }}"><span>Leads</span></a>
              </li> --}}
            </ul>
          </li>
          @endcan

          {{-- ACL --}}
          @canany(['manage_users', 'manage_roles', 'manage_permissions'])
          @php
            $aclActive = Request::is('users') || Request::is('acl') || Request::is('acl/assign-permissions') || Request::is('departments');
          @endphp
          <li class="liMain {{ $aclActive ? 'active' : '' }}">
            <a href="#game-center" class="activeParent" data-bs-toggle="collapse" aria-expanded="{{ $aclActive ? 'true' : 'false' }}">
              <img class="mr-2 radius-image sub-side" src="{{ asset('images/acl-logo.svg') }}" alt="ACL">
              <span class="parent">ACL</span>
              <i class="fa-solid fa-angle-down text-light"></i>
            </a>
            <ul id="game-center" class="iq-submenu collapse child {{ $aclActive ? 'show' : '' }}">
              @can('manage_users')
              <li id="child">
                <a href="{{ url('users') }}" class="{{ Request::is('users') ? 'childActive' : '' }}"><span>User</span></a>
              </li>
              @endcan
              @can('manage_roles')
              <li id="child">
                <a href="{{ url('acl') }}" class="{{ Request::is('acl') ? 'childActive' : '' }}"><span>Roles</span></a>
              </li>
              @endcan
              @can('manage_permissions')
              <li id="child">
                <a href="{{ route('acl.assignPermissionsForm') }}" class="{{ Route::is('acl.assignPermissionsForm') ? 'childActive' : '' }}"><span>Manage Permissions</span></a>
              </li>
              @endcan
              <li id="child">
                <a href="{{ url('departments') }}" class="{{ Request::is('departments') ? 'childActive' : '' }}"><span>Department</span></a>
              </li>
            </ul>
          </li>
          @endcanany

          {{-- Lovs --}}
          @canany(['manage_skills', 'manage_levels', 'manage_influence_ability', 'manage_industry_area', 'manage_work_domain'])
          @php
            $lovActive = Request::is('skill.index') || Request::is('lov/*') || Request::routeIs('lov.category.index');
          @endphp
          <li class="liMain {{ $lovActive ? 'active' : '' }}">
            <a href="#lov" class="activeParent" data-bs-toggle="collapse" aria-expanded="{{ $lovActive ? 'true' : 'false' }}">
              <img class="mr-2 radius-image sub-side" src="{{ asset('images/acl-logo.svg') }}" alt="Lovs">
              <span class="parent">Lovs</span>
              <i class="fa-solid fa-angle-down text-light"></i>
            </a>
            <ul id="lov" class="iq-submenu collapse child {{ $lovActive ? 'show' : '' }}">
              <!-- @can('manage_skills')
              <li id="child">
                <a href="{{ route('skill.index') }}" class="{{ Route::is('skill.index') ? 'childActive' : '' }}"><span>Skills</span></a>
              </li>
              @endcan -->
              @canany(['manage_levels', 'manage_influence_ability', 'manage_industry_area', 'manage_work_domain'])
              <li id="child">
                <a href="{{ route('lov.category.index', 'individual') }}" 
                   class="{{ Request::routeIs('lov.category.index') && request()->route('category') == 'individual' ? 'childActive' : '' }}">
                  <span>Individual</span>
                </a>
              </li>
              @endcanany
              <li id="child">
                <a href="{{ route('lov.category.index', 'business') }}" 
                   class="{{ Request::routeIs('lov.category.index') && request()->route('category') == 'business' ? 'childActive' : '' }}">
                  <span>Business</span>
                </a>
              </li>
              <li id="child">
                <a href="{{ route('lov.category.index', 'embassy') }}" 
                   class="{{ Request::routeIs('lov.category.index') && request()->route('category') == 'embassy' ? 'childActive' : '' }}">
                  <span>Embassy</span>
                </a>
              </li>
            </ul>
          </li>
          @endcanany

          {{-- Knowledge Base --}}
          <li class="{{ request()->is('knowledge.*') ? 'active' : '' }}">
            <a href="{{ route('knowledge.index') }}" class="text-decoration-none"><img class="mr-2 radius-image sub-side" src="{{ asset('images/knwldge-base.svg') }}" alt="Knowledge Base">Knowledge Base</a>
          </li>

          {{-- Home Page Template --}}
          @can('manage_home_page_template')
          <li class="{{ request()->is('home-page-template') || request()->is('template/setting') || request()->is('preview-template') ? 'active' : '' }}">
            <a href="{{ url('home-page-template') }}" class="text-decoration-none"><img class="mr-2 radius-image sub-side" style="background: #dfdfdf" src="{{ asset('images/LandingPageManagement.svg') }}" alt="Home Page Template">Home Page Template</a>
          </li>
          @endcan

          {{-- Reports --}}
          @can('manage_reports')
          @php
            $reportsActive = Request::is('users-reports') || Request::is('jobs-reports') || Request::is('event-reports') || Request::is('match-making-reports') || Request::is('co-working-space-reports');
          @endphp
          <li class="liMain {{ $reportsActive ? 'active' : '' }}">
            <a href="#Reports" class="activeParent" data-bs-toggle="collapse" aria-expanded="{{ $reportsActive ? 'true' : 'false' }}">
              <img class="mr-2 radius-image sub-side" src="{{ asset('images/reports-logo.svg') }}" alt="Reports">
              <span class="parent">Report</span>
              <i class="fa-solid fa-angle-down text-light"></i>
            </a>
            <ul id="Reports" class="iq-submenu collapse child {{ $reportsActive ? 'show' : '' }}">
              @php $r = request()->path(); @endphp
              @can('view_user_registration_report')
              <li id="child"><a href="{{ url('users-reports') }}" class="{{ $r === 'users-reports' ? 'childActive' : '' }}"><span>User Registration</span></a></li>
              @endcan
              @can('view_job_posting_report')
              <li id="child"><a href="{{ url('jobs-reports') }}" class="{{ $r === 'jobs-reports' ? 'childActive' : '' }}"><span>Job Postings Report</span></a></li>
              @endcan
              @can('view_events_report')
              <li id="child"><a href="{{ url('event-reports') }}" class="{{ $r === 'event-reports' ? 'childActive' : '' }}"><span>Events Report</span></a></li>
              @endcan
              @can('view_MATCHMAKING_report')
              <li id="child"><a href="{{ url('match-making-reports') }}" class="{{ $r === 'match-making-reports' ? 'childActive' : '' }}"><span>Matchmaking Report</span></a></li>
              @endcan
              @can('view_co_workspace_report')
              <li id="child"><a href="{{ url('co-working-space-reports') }}" class="{{ $r === 'co-working-space-reports' ? 'childActive' : '' }}"><span>Co-Workspace Report</span></a></li>
              @endcan
            </ul>
          </li>
          @endcan

          {{-- Settings --}}
          @can('manage_general_settings')
          @php
            $settingsActive = Request::is('settings/general') || Request::is('other-pages.html') || Request::is('subscription.html');
          @endphp
          <li class="liMain {{ $settingsActive ? 'active' : '' }}">
            <a href="#Settings" class="activeParent" data-bs-toggle="collapse" aria-expanded="{{ $settingsActive ? 'true' : 'false' }}">
              <img class="mr-2 radius-image sub-side" src="{{ asset('images/Settings.svg') }}" alt="Settings">
              <span class="parent">Settings</span>
              <i class="fa-solid fa-angle-down text-light"></i>
            </a>
            <ul id="Settings" class="iq-submenu collapse child {{ $settingsActive ? 'show' : '' }}">
              @can('view_general_settings')
              <li id="child"><a href="{{ route('settings.general.index') }}" class="{{ request()->is('settings/general') ? 'childActive' : '' }}"><span>General Settings</span></a></li>
              @endcan
              {{-- uncomment later --}}
              {{-- <li id="child"><a href="other-pages.html" class="{{ request()->is('other-pages.html') ? 'childActive' : '' }}"><span>Other Pages</span></a></li>
              <li id="child"><a href="subscription.html" class="{{ request()->is('subscription.html') ? 'childActive' : '' }}"><span>Subscription</span></a></li> --}}
            </ul>
          </li>
          @endcan

        </ul>
      </nav>
    </div>
  </div>
</div>
