<tr id="space-{{ $space->id }}">
    <td class="space-id">{{ $space->space_id ?? '-' }}</td>
    <td class="space-name">{{ $space->name }}</td>
    <td class="space-email">{{ $space->email }}</td>
    <td class="space-phone">{{ $space->phone }}</td>
    <td class="space-price">SAR {{ $space->starting_price }}</td>
    <td class="space-rental">{{ $space->month_rentals }} Months</td>
    <td class="space-people text-center">{{ $space->people }}</td>
    <td>
        <div class="dropdown">
            <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                Select
            </a>

            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" 
                        href="{{ route('co-working-space.show',['space' => $space->id]) }}">
                        <img src="images/Bookings.svg" class="me-2" alt="View-icon">View 
                    </a>
                </li>
            </ul>
        </div>
    </td>
    <td>
        <div class="dropdown">
            <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
                Select
            </a>

            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); openEnquiryModal('{{ route('co-working-space.enquiry', ['id' => $space->id]) }}')">
                        <img src="{{ asset('images/Bookings.svg') }}" class="me-2" alt="View-icon"> View
                    </a>
                </li>
            </ul>
        </div>
    </td>
</tr>