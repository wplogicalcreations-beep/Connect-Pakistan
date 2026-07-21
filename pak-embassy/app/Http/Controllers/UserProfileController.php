<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Certificate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserProfileController extends Controller
{
    // Education methods
    public function storeEducation(Request $request)
    {
        // Check if it's multiple educations (from main modal) or single education (from edit modal)
        if ($request->has('educations') && is_array($request->input('educations'))) {
            // Multiple educations from main modal
            $request->validate([
                'educations' => 'required|array|min:1',
                'educations.*.degree_type' => 'required|string|max:255',
                'educations.*.institution' => 'required|string|max:255',
                'educations.*.degree_name' => 'required|string|max:255',
                'educations.*.country_id' => 'required|exists:countries,id',
                'educations.*.start_date' => 'required|date',
                'educations.*.end_date' => 'nullable|date|after:educations.*.start_date',
                'educations.*.currently_studying' => 'required|boolean',
                'educations.*.description' => 'nullable|string'
            ]);

            $educations = $request->input('educations');
            $createdEducations = [];

            foreach ($educations as $educationData) {
                // Convert boolean strings to actual booleans
                $educationData['currently_studying'] = filter_var($educationData['currently_studying'], FILTER_VALIDATE_BOOLEAN);
                
                // Create each education record
                $education = Auth::user()->educations()->create($educationData);
                $createdEducations[] = $education;
            }

            return response()->json([
                'success' => true,
                'message' => 'Education(s) added successfully',
                'educations' => $createdEducations
            ]);
        } else {
            // Single education from edit modal
            $request->validate([
                'degree_type' => 'required|string|max:255',
                'institution' => 'required|string|max:255',
                'degree_name' => 'required|string|max:255',
                'country_id' => 'required|exists:countries,id',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after:start_date',
                'currently_studying' => 'required|boolean',
                'description' => 'nullable|string'
            ]);

            $education = Auth::user()->educations()->create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Education added successfully',
                'education' => $education
            ]);
        }
    }

    public function updateEducation(Request $request, $id)
    {
        $education = Auth::user()->educations()->findOrFail($id);

        $request->validate([
            'degree_type' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'degree_name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'currently_studying' => 'required|boolean',
            'description' => 'nullable|string'
        ]);

        $education->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Education updated successfully',
            'education' => $education
        ]);
    }

    public function getEducation($id)
    {
        $education = Auth::user()->educations()->findOrFail($id);

        return response()->json([
            'success' => true,
            'education' => $education
        ]);
    }

    public function deleteEducation($id)
    {
        $education = Auth::user()->educations()->findOrFail($id);
        $education->delete();

        return response()->json([
            'success' => true,
            'message' => 'Education deleted successfully'
        ]);
    }

    // Experience methods
    public function storeExperience(Request $request)
    {
        $request->validate([
            'experiences' => 'required|array|min:1',
            'experiences.*.job_title' => 'required|string|max:255',
            'experiences.*.company_name' => 'required|string|max:255',
            'experiences.*.country_id' => 'required|exists:countries,id',
            'experiences.*.job_type' => 'nullable|string|max:255',
            'experiences.*.start_date' => 'required|date',
            'experiences.*.end_date' => 'nullable|date|after:experiences.*.start_date',
            'experiences.*.currently_working' => 'required|boolean',
            'experiences.*.description' => 'nullable|string'
        ]);

        $experiences = $request->input('experiences');
        $createdExperiences = [];

        foreach ($experiences as $experienceData) {
            // Convert boolean strings to actual booleans
            $experienceData['currently_working'] = filter_var($experienceData['currently_working'], FILTER_VALIDATE_BOOLEAN);
            
            // Create each experience record
            $experience = Auth::user()->experiences()->create($experienceData);
            $createdExperiences[] = $experience;
        }

        return response()->json([
            'success' => true,
            'message' => 'Experience(s) added successfully',
            'experiences' => $createdExperiences
        ]);
    }

    public function updateExperience(Request $request, $id)
    {
        $experience = Auth::user()->experiences()->findOrFail($id);

        $request->validate([
            'job_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'job_type' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'currently_working' => 'required|boolean',
            'description' => 'nullable|string'
        ]);

        $experience->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Experience updated successfully',
            'experience' => $experience
        ]);
    }

    public function getExperience($id)
    {
        $experience = Auth::user()->experiences()->findOrFail($id);

        return response()->json([
            'success' => true,
            'experience' => $experience
        ]);
    }

    public function deleteExperience($id)
    {
        $experience = Auth::user()->experiences()->findOrFail($id);
        $experience->delete();

        return response()->json([
            'success' => true,
            'message' => 'Experience deleted successfully'
        ]);
    }

    // Certificate methods
    public function storeCertificate(Request $request)
    {
        // Check if it's multiple certificates (from main modal) or single certificate (from edit modal)
        if ($request->has('certificates') && is_array($request->input('certificates'))) {
            // Multiple certificates from main modal
            $request->validate([
                'certificates' => 'required|array|min:1',
                'certificates.*.title' => 'required|string|max:255',
                'certificates.*.institution' => 'nullable|string|max:255',
                'certificates.*.grade' => 'nullable|string|max:255',
                'certificates.*.start_date' => 'nullable|date',
                'certificates.*.end_date' => 'nullable|date|after:certificates.*.start_date'
            ]);

            $certificates = $request->input('certificates');
            $createdCertificates = [];

            foreach ($certificates as $certificateData) {
                // Create each certificate record
                $certificate = Auth::user()->certificates()->create($certificateData);
                $createdCertificates[] = $certificate;
            }

            return response()->json([
                'success' => true,
                'message' => 'Certificate(s) added successfully',
                'certificates' => $createdCertificates
            ]);
        } else {
            // Single certificate from edit modal
            $request->validate([
                'title' => 'required|string|max:255',
                'institution' => 'nullable|string|max:255',
                'grade' => 'nullable|string|max:255',
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date|after:start_date'
            ]);

            $certificate = Auth::user()->certificates()->create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Certificate added successfully',
                'certificate' => $certificate
            ]);
        }
    }

    public function updateCertificate(Request $request, $id)
    {
        $certificate = Auth::user()->certificates()->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'institution' => 'nullable|string|max:255',
            'grade' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date'
        ]);

        $certificate->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Certificate updated successfully',
            'certificate' => $certificate
        ]);
    }

    public function getCertificate($id)
    {
        $certificate = Auth::user()->certificates()->findOrFail($id);

        return response()->json([
            'success' => true,
            'certificate' => $certificate
        ]);
    }

    public function deleteCertificate($id)
    {
        $certificate = Auth::user()->certificates()->findOrFail($id);
        $certificate->delete();

        return response()->json([
            'success' => true,
            'message' => 'Certificate deleted successfully'
        ]);
    }

    // Get all profile data
    public function getProfileData()
    {
        $user = Auth::user()->load([
            'educations.country',
            'experiences.country',
            'certificates',
            'skills'
        ]);

        return response()->json([
            'success' => true,
            'user' => $user
        ]);
    }

    // Get countries for dropdowns
    public function getCountries()
    {
        $countries = \App\Models\Country::orderBy('name')->get();

        return response()->json([
            'success' => true,
            'countries' => $countries
        ]);
    }
}
