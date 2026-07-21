<tr>
    <td>{{ $serialNumber }}</td>
    <td>{{ $match['individual_name'] }}</td>
    <td>{{ $match['company_name'] }}</td>
    <td>{{ $match['skill_match'] }}</td>
    <td>{{ $match['industry'] }}</td>
    <td>{{ $match['domain'] }}</td>
    <td>{{ $match['match_date'] }}</td>
    <td>
        <span class="badge {{ $match['status'] == 'Active' ? 'bg-success' : 'bg-danger' }}">
            {{ $match['status'] }}
        </span>
    </td>
</tr>