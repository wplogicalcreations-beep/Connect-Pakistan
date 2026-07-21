@extends("layouts.master")
@section("content")
    <div class="page-content">
        <div class="page-title">
            <h3>Assign Permissions</h3>
            <div class="row">
                <div class="col-md-4 col-12 mb-2">
                    <div class="form-floating">
                        <select class="form-select" id="roleSelect" name="role" aria-label="Role select">
                            <option  value="" selected disabled>Select Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <label for="role">Role Name</label>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="page-title">
            <h3>Assign Permission to the Role</h3>
        </div>
        <form id="assignPermissionsForm" method="POST" action="{{ route('acl.assignPermissions') }}">
            @csrf
            <input type="hidden" name="role" id="hiddenRoleId">
            <div class="row g-3 align-items-stretch">
                @foreach($modules as $module)
                    <div class="col-md-4 d-flex mb-2">
                        <div class="card permission-card border-0 p-3 flex-grow-1">
                            <h5 class="fw-bold">{{ ucfirst(str_replace('_', ' ', $module->name)) }}</h5>
                            @foreach($module->permissions as $permission)
                                <div class="form-check">
                                    <input 
                                        type="checkbox" 
                                        class="form-check-input" 
                                        name="permissions[]" 
                                        value="{{ $permission->name }}"
                                        id="perm_{{ $permission->id }}"
                                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="perm_{{ $permission->id }}">
                                        {{ str_replace('_', ' ', $permission->name) }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-12 text-end">
                <a type="button" class="btn btn-outline-secondary my-3 button-style" href="role.html">Close</a>
                <button type="submit" class="btn btn-common-bg my-3">Save</button>
            </div>
        </form>
    </div>

    @section("js-file")
        <script>
            const rolePermissionsMap = @json($rolePermissionsMap ?? []);
            const roleSelect = document.getElementById('roleSelect');
            const hiddenRoleId = document.getElementById('hiddenRoleId');
            
            function uncheckAll() {
                document.querySelectorAll('.perm-checkbox').forEach(cb => { cb.checked = false; });
                document.querySelectorAll('.group-toggle').forEach(cb => { cb.checked = false; });
            }

            roleSelect?.addEventListener('change', function() {
                const roleId = this.value;
                hiddenRoleId.value = roleId || '';
                uncheckAll();
                const assigned = rolePermissionsMap[roleId] || [];
                if (assigned.length) {
                    assigned.forEach(pid => {
                        const box = document.querySelector(`.perm-checkbox[value="${pid}"]`);
                        if (box) box.checked = true;
                    });
                }
            });

            document.getElementById('assignPermissionsForm')?.addEventListener('submit', function(e) {
                e.preventDefault();
                let errorMessage = null;
                if (!hiddenRoleId.value) {
                    errorMessage = 'Please select a role first.';
                } 
                else if (document.querySelectorAll('input[name="permissions[]"]:checked').length === 0) {
                    errorMessage = 'Please select at least one permission.';
                }
                if (errorMessage) {
                    if (typeof showToast === 'function') {
                        showToast(errorMessage);
                    } else {
                        alert(errorMessage);
                    }
                    return;
                }

                let form = $(this);
                let formData = new FormData(this);

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success) {
                            if (typeof showToast === 'function') {
                                showToast('Permissions updated successfully!');
                            } else {
                                alert('Permissions updated successfully!');
                            }
                        } else {
                            if (typeof showToast === 'function') {
                                showToast('Something went wrong');
                            } else {
                                alert('Something went wrong');
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Error submitting form');
                    }
                });
            });

                $('#roleSelect').on('change', function () {
                    let selectedRole = $(this).val();

                    $.ajax({
                        url: "{{ route('roles.getPermissions') }}", 
                        type: "GET",
                        data: { role: selectedRole },
                        success: function (response) {
                            if (response.permissions) {
                                // First uncheck all
                                $('input[name="permissions[]"]').prop('checked', false);

                                // Now check only the ones that match
                                response.permissions.forEach(function (perm) {
                                    $('#perm_' + perm.id).prop('checked', true);
                                });
                            }
                        },
                        error: function (xhr) {
                            console.error("Error:", xhr.responseText);
                        }
                    });
                });
        </script>
    @endsection
@endsection