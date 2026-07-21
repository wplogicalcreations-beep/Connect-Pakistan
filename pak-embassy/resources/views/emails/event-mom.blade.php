<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minutes of Meeting</title>
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
            background-color: #28a745;
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
        .event-info {
            background-color: white;
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
            border-left: 4px solid #28a745;
        }
        .mom-content {
            background-color: white;
            padding: 20px;
            margin: 15px 0;
            border-radius: 5px;
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
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Minutes of Meeting Available</h2>
    </div>
    
    <div class="content">
        <p>Hello,</p>
        
        <p>The Minutes of Meeting for the following event is now available:</p>
        
        <div class="event-info">
            <h3 style="margin-top: 0; color: #28a745;">{{ $event->name }}</h3>
            <p><strong>Event Date:</strong> {{ \Carbon\Carbon::parse($event->start_date)->format('F d, Y') }}</p>
            @if($event->location)
            <p><strong>Location:</strong> {{ $event->location }}</p>
            @endif
        </div>
        
        <div class="mom-content">
            <h4 style="margin-top: 0;">Minutes of Meeting:</h4>
            <div>
                {!! $momContent !!}
            </div>
        </div>
        
        <p>You can also view the Minutes of Meeting in your dashboard by visiting the event details page.</p>
        
        <a href="{{ $eventDetailUrl }}" class="btn">View Event Details</a>
    </div>
    
    <div class="footer">
        <p>This is an automated notification from Pakistan Embassy Portal.</p>
        <p>Please do not reply to this email.</p>
    </div>
</body>
</html>

