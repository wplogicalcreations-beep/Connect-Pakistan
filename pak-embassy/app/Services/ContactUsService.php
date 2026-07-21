<?php

namespace App\Services;

use App\Models\ContactUs;

class ContactUsService
{
    public function store($request)
    {
        return ContactUs::create($request);
    }
}