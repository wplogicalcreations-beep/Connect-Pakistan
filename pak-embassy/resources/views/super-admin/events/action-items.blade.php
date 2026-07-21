@extends("layouts.master")
@section("content")
    <div class="page-title">
        <h3 class="go-back" style="cursor: pointer; display: inline;" onclick="window.history.back()">
            <- Go Back
        </h3>
        <h3 class="d-inline ms-3">Action Items - {{ $event->name }}</h3>
    </div>
    <div class="card border-0 py-3 px-2">
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="text-end">
                    <a href="#" class="btn btn-success" 
                       data-bs-toggle="modal" 
                       data-bs-target="#addActionItemModal"
                       onclick="openAddActionItemModal({{ $event->id }})">
                        + Add New Action
                    </a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive view-table">
                    <table class="table table-striped table-hover">
                        <thead class="table-light" style="background-color: #d4edda;">
                            <tr>
                                <th>Event Name</th>
                                <th>Action</th>
                                <th>Description</th>
                                <th>Assigned To</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Comment</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="actionItemsTableBody">
                            @forelse($actionItems as $item)
                                @php
                                    $statusClass = $item->status === 'completed' ? 'bg-success' : 
                                                   ($item->status === 'in_progress' ? 'bg-warning' : 
                                                   ($item->status === 'cancelled' ? 'bg-danger' : 'bg-secondary'));
                                    $statusLabel = $item->status === 'completed' ? 'Completed' : 
                                                   ($item->status === 'in_progress' ? 'In Progress' : 
                                                   ($item->status === 'cancelled' ? 'Cancelled' : 'Pending'));
                                @endphp
                                <tr id="action-item-row-{{ $item->id }}">
                                    <td>{{ $event->name }}</td>
                                    <td>{{ $item->action ?? '-' }}</td>
                                    <td>{{ $item->description ?? '-' }}</td>
                                    <td>{{ $item->assignedUser ? $item->assignedUser->name : '-' }}</td>
                                    <td>{{ $item->due_date ? \Carbon\Carbon::parse($item->due_date)->format('d/m/Y') : '-' }}</td>
                                    <td><span class="badge {{ $statusClass }}">{{ $statusLabel }}</span></td>
                                    <td>{{ $item->comment ?? '---' }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" 
                                                onclick="openEditActionItemModal({{ $item->id }})"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editActionItemModal">
                                            Edit
                                        </button>
                                        <button class="btn btn-sm btn-danger" 
                                                onclick="deleteActionItem({{ $item->id }}, {{ $event->id }})">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No action items found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Action Item Modal (Reusable) -->
    <div class="modal fade" id="editActionItemModal" tabindex="-1" aria-labelledby="editActionItemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-dark" id="editActionItemModalLabel">Edit Action Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editActionItemForm">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" id="edit-action-item-id" name="action_item_id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="edit-action" 
                                           name="action" placeholder="Action" required>
                                    <label for="edit-action">Action</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <textarea class="form-control" id="edit-description" 
                                              name="description" placeholder="Description" style="height: 100px;"></textarea>
                                    <label for="edit-description">Description</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <select class="form-select" id="edit-assigned_to" 
                                            name="assigned_to" aria-label="Assigned To">
                                        <option value="">Select User</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="edit-assigned_to">Assigned To</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="edit-due_date" 
                                           name="due_date" placeholder="Due Date">
                                    <label for="edit-due_date">Due Date</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <select class="form-select" id="edit-status" 
                                            name="status" aria-label="Status" required>
                                        <option value="pending">Pending</option>
                                        <option value="in_progress">In Progress</option>
                                        <option value="completed">Completed</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                    <label for="edit-status">Status</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <textarea class="form-control" id="edit-comment" 
                                              name="comment" placeholder="Comment" style="height: 100px;"></textarea>
                                    <label for="edit-comment">Comment</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary my-3 button-style" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success my-3">Update Action</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add New Action Item Modal -->
    <div class="modal fade" id="addActionItemModal" tabindex="-1" aria-labelledby="addActionItemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-dark" id="addActionItemModalLabel">Add New Action Items</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addActionItemForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="action" 
                                           name="action" placeholder="Action" required>
                                    <label for="action">Action</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <textarea class="form-control" id="description" 
                                              name="description" placeholder="Description" style="height: 100px;"></textarea>
                                    <label for="description">Description</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <select class="form-select" id="assigned_to" 
                                            name="assigned_to" aria-label="Assigned To">
                                        <option value="">Select User</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="assigned_to">Assigned To</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="due_date" 
                                           name="due_date" placeholder="Due Date">
                                    <label for="due_date">Due Date</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <select class="form-select" id="status" 
                                            name="status" aria-label="Status" required>
                                        <option value="pending">Pending</option>
                                        <option value="in_progress">In Progress</option>
                                        <option value="completed">Completed</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                    <label for="status">Status</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <textarea class="form-control" id="comment" 
                                              name="comment" placeholder="Comment" style="height: 100px;"></textarea>
                                    <label for="comment">Comment</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary my-3 button-style" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success my-3">Add New Action</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section("js-file")
    <script>
        function openAddActionItemModal(eventId) {
            // Form is already in the modal, just need to ensure eventId is available
            window.currentEventId = eventId;
        }

        // Handle form submission
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('addActionItemForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    submitActionItem({{ $event->id }});
                });
            }
        });

        function submitActionItem(eventId) {
            const form = document.getElementById('addActionItemForm');
            if (!form) return;

            const formData = new FormData(form);
            const url = "{{ route('events.action-items.store', ['event' => $event->id]) }}";

            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    $('#addActionItemModal').modal('hide');
                    showToast("Action item created successfully!");
                    form.reset();
                    // Reload the page to show the new action item
                    window.location.reload();
                } else {
                    showToast("Error creating action item: " + (data.error || 'Unknown error'));
                }
            })
            .catch(err => {
                console.error('Error submitting action item:', err);
                showToast("Error creating action item.");
            });
        }

        // Store action items data for edit
        const actionItemsData = @json($actionItemsData);

        function openEditActionItemModal(actionItemId) {
            const itemData = actionItemsData[actionItemId];
            if (!itemData) return;

            // Populate form fields
            document.getElementById('edit-action-item-id').value = itemData.id;
            document.getElementById('edit-action').value = itemData.action || '';
            document.getElementById('edit-description').value = itemData.description || '';
            document.getElementById('edit-assigned_to').value = itemData.assigned_to || '';
            document.getElementById('edit-due_date').value = itemData.due_date || '';
            document.getElementById('edit-status').value = itemData.status || 'pending';
            document.getElementById('edit-comment').value = itemData.comment || '';
        }

        // Handle edit form submission
        document.addEventListener('DOMContentLoaded', function() {
            const editForm = document.getElementById('editActionItemForm');
            if (editForm) {
                editForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const actionItemId = document.getElementById('edit-action-item-id').value;
                    if (actionItemId) {
                        updateActionItem(actionItemId, {{ $event->id }});
                    }
                });
            }
        });

        function updateActionItem(actionItemId, eventId) {
            const form = document.getElementById('editActionItemForm');
            if (!form) return;

            const formData = new FormData(form);
            const url = "{{ route('events.action-items.update', ['actionItem' => ':id']) }}".replace(':id', actionItemId);

            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    $('#editActionItemModal').modal('hide');
                    showToast("Action item updated successfully!");
                    // Reload the page to show updated data
                    window.location.reload();
                } else {
                    showToast("Error updating action item: " + (data.error || 'Unknown error'));
                }
            })
            .catch(err => {
                console.error('Error updating action item:', err);
                showToast("Error updating action item.");
            });
        }

        function deleteActionItem(actionItemId, eventId) {
            if (!confirm('Are you sure you want to delete this action item?')) {
                return;
            }

            const url = "{{ route('events.action-items.delete', ['actionItem' => ':id']) }}".replace(':id', actionItemId);

            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.error || 'Failed to delete action item');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showToast("Action item deleted successfully!");
                    // Remove the row from table
                    const row = document.getElementById(`action-item-row-${actionItemId}`);
                    if (row) {
                        row.remove();
                    }
                } else {
                    showToast("Error deleting action item: " + (data.error || 'Unknown error'));
                }
            })
            .catch(err => {
                console.error('Error deleting action item:', err);
                showToast("Error deleting action item: " + err.message);
            });
        }
    </script>
@endsection

