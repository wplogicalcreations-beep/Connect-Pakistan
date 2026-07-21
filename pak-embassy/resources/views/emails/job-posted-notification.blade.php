<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Job Posted</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 0 0 5px 5px;
        }
        .job-info {
            background-color: white;
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
            border-left: 4px solid #007bff;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 12px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="content">
        <p>Hello Admin,</p>
        
        <p>A new job has been posted on the platform:</p>
        
        <div class="job-info">
            <h3 style="margin-top: 0; color: #007bff;">{{ $job->title }}</h3>
            @if($organization)
            <p><strong>Posted by:</strong> {{ $organization->name }}</p>
            @endif
            @if($job->location)
            <p><strong>Location:</strong> {{ $job->location }}</p>
            @endif
            @if($job->job_type)
            <p><strong>Job Type:</strong> {{ \App\Models\JobPost::JOB_TYPES[$job->job_type] ?? $job->job_type }}</p>
            @endif
            @if($job->posted_at)
            <p><strong>Posted Date:</strong> {{ \Carbon\Carbon::parse($job->posted_at)->format('F d, Y') }}</p>
            @endif
        </div>
        
        @if($job->description)
        <div style="background-color: white; padding: 15px; margin: 15px 0; border-radius: 5px;">
            <h4 style="margin-top: 0;">Job Description:</h4>
            <div>
                {!! \Illuminate\Support\Str::limit(strip_tags($job->description), 200) !!}
            </div>
        </div>
        @endif
        
        <p>Please review the job posting in the admin dashboard.</p>
        
        <a href="{{ $jobDetailUrl }}" class="btn">View Job Board</a>
    </div>
    
    <div class="footer">
        <p>This is an automated notification from Pakistan Embassy Portal.</p>
        <p>Please do not reply to this email.</p>
    </div>
</body>
</html>

