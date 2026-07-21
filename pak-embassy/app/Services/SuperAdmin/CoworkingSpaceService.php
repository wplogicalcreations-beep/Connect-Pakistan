<?php

namespace App\Services\SuperAdmin;

use App\Models\CoworkingSpace;
use App\Models\BookingRequest;
use App\Models\Status;

class CoworkingSpaceService
{
    public function getAll($request)
    {
        $records = $request->per_page ?? 10;
        $sortBy = $request->sort_by ?? 'id';
        $sortOrder = $request->sort_order ?? 'desc';

        $coWorkingSpaces = CoworkingSpace::applyFilter($request)->orderBy($sortBy, $sortOrder)->paginate($records);

        return $coWorkingSpaces;
    }

    public function store(array $data)
    {
        do {
            $spaceId = str_pad(random_int(10000000, 99999999), 8, '0', STR_PAD_LEFT);
        } while (CoworkingSpace::where('space_id', $spaceId)->exists());
        $data['space_id'] = $spaceId;
        $space = CoworkingSpace::create($data);
        if (isset($data['image'])) {
            upload_image(
                $space,
                $data['image'],
                'coworking-spaces',
                'thumbnail',
                true,
                false
            );
        }

        return $space;
    }

    public function getSpacesRequest($request)
    {
        $records = $request->per_page ?? 10;
        $sortBy = $request->sort_by ?? 'id';
        $sortOrder = $request->sort_order ?? 'desc';

        $requests = BookingRequest::with('coworkingSpace', 'status')->applyFilter($request)->orderBy($sortBy, $sortOrder)->paginate($records);

        return $requests;
    }

    public function getSpaceRequestById($id)
    {
        $requests = BookingRequest::where('id',$id)->with('coworkingSpace', 'status', 'coworkingSpace.bookingRequests')->orderBy('id', 'desc')->first();

        return $requests;
    }

    public function acceptEnquiry($id)
    {
        $request = BookingRequest::where('id',$id)->first();
        $request->status_id = Status::getStatusIdBySlug(Status::APPROVED);
        $request->save();
    }

    public function rejectEnquiry($id)
    {
        $request = BookingRequest::where('id',$id)->first();
        $request->status_id = Status::getStatusIdBySlug(Status::REJECTED);
        $request->save();
    }

    public function inReviewEnquiry($id)
    {
        $request = BookingRequest::where('id',$id)->first();
        $request->status_id = Status::getStatusIdBySlug(Status::IN_REVIEW);
        $request->save();
    }

    public function getRequestsBySpace($spaceId, $request)
    {
        $records = $request->per_page ?? 10;
        $sortBy = $request->sort_by ?? 'id';
        $sortOrder = $request->sort_order ?? 'desc';

        $requests = BookingRequest::where('coworking_space_id', $spaceId)
            ->with('coworkingSpace', 'status', 'user')
            ->applyFilter($request)
            ->orderBy($sortBy, $sortOrder)
            ->paginate($records);

        return $requests;
    }
}