<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequestForm;
use App\Models\BookingRequest;
use App\Services\BookingRequestService;
use \Symfony\Component\HttpKernel\Exception\HttpException as Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BookingRequestController extends Controller
{
    protected $bookingRequestService;

    public function __construct(BookingRequestService $bookingRequestService)
    {
        $this->bookingRequestService = $bookingRequestService;
    }

    public function bookingRequest(BookingRequestForm $request)
    {
        try {
            $bookingRequest = $this->bookingRequestService->createRequest($request);
            return response()->json([
                'message' => 'Booking request submitted successfully!',
                'booking_id' => $bookingRequest->id
            ], 200);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->failure($exception->getMessage(), $exception->getStatusCode());
        }
    }
}
