<?php

namespace App\Services;

use App\Models\BookingRequest;

class BookingRequestService
{
    public function createRequest($request)
    {
        $bookingRequest = BookingRequest::create([
                'user_id' => auth()->id(),
                'coworking_space_id' => $request->coworking_space_id,
                'people_count' => $request->people_count,
                'space_type' => $request->space_type,
                'duration' => $request->duration,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'company_name' => $request->company_name,
                'estimated_start_date' => $request->estimated_start_date,
                'status' => 'pending',
            ]);
        return $bookingRequest;
    }
}