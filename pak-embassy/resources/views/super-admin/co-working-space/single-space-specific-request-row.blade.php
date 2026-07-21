<tr id="space-request-{{ $request->id }}">
    <td class="request-request-id">#{{ $request->id }}</td>
    <td class="request-name">{{ $request->first_name }} {{ $request->last_name }}</td>
    <td class="request-email">{{ $request->email }}</td>
    <td class="request-phone">{{ $request->phone_number }}</td>
    <td class="request-company">{{ $request->company_name ?? '-' }}</td>
    <td class="request-people-count">{{ $request->people_count }}</td>
    <td class="request-start-date">{{ $request->estimated_start_date ? $request->estimated_start_date->format('Y-m-d') : '-' }}</td>
    <td class="text-end request-status"><span class="badge bg-success-2 p-2">{{ $request->status?->name ?? 'New' }}</span></td>
    <td>
        <div class="dropdown">
            <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
                Select
            </a>

            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); openEnquiryModal('{{ route('co-working-space.enquiry', ['id' => $request->id]) }}')">
                        <img src="{{ asset('images/Bookings.svg') }}" class="me-2" alt="View-icon"> View
                    </a>
                </li>
            </ul>
        </div>
    </td>
</tr>

