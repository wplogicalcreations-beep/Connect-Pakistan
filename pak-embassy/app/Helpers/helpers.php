<?php

use App\Models\BookingRequest;
use App\Models\CoworkingSpace;
use App\Models\Event;
use App\Models\JobApplication;
use App\Models\JobApplicationDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (! function_exists('safe_upload_name')) {
    /**
     * Build a storage file name from an upload without trusting the client-supplied name:
     * strips directory parts (path traversal) and non-alphanumeric characters.
     */
    function safe_upload_name(object $file, bool $rename = true): string
    {
        $extension = strtolower(preg_replace('/[^A-Za-z0-9]/', '', (string) $file->getClientOriginalExtension()));

        // Never keep a server-executable extension; fall back to the type detected from the content.
        if (preg_match('/^(php\d*|phtml|phar|pht|phps|cgi|pl|py|sh|asp|aspx|jsp|htaccess|exe|bat|cmd|html?)$/', $extension)) {
            $guessed = method_exists($file, 'guessExtension') ? $file->guessExtension() : null;
            $extension = $guessed && $guessed !== $extension ? $guessed : 'bin';
        }

        if ($rename) {
            return Str::random(10) . '-' . time() . '.' . $extension;
        }

        $baseName = Str::slug(pathinfo(basename(str_replace('\\', '/',(string) $file->getClientOriginalName())), PATHINFO_FILENAME));

        return ($baseName !== '' ? $baseName : Str::random(10)) . '.' . $extension;
    }
}

if (! function_exists('upload_image')) {
    function upload_image(object $model, object $file, string $path, string $type = null, bool $rename = true, bool $unlink = false, string $oldPath = null)
    {
      // Ensure directory exists
        if (!Storage::exists("public/{$path}")) {
            Storage::makeDirectory("public/{$path}");
        }

        // Generate file name
        $name = safe_upload_name($file, $rename);

        // Store file
        Storage::disk('public')->putFileAs($path, $file, $name);

        // File relative path
        $relativePath = "{$path}/{$name}";

        // Save in related images table
        $image = $model->images()->updateOrCreate(
            [
                'type' => $type,
                'imageable_id' => $model->id,
                'imageable_type' => get_class($model),
            ],
            [
                'path' => $relativePath,
            ]
        );

        // Remove old file if needed
        if ($unlink && $oldPath && Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }

        // Return saved image instance
        return $image;
    }
}


if (! function_exists('upload_file')) {
    function upload_file(object $model, object $file, string $path, string $type = null, bool $rename = true, bool $unlink = false, string $oldPath = null)
    {
      // Ensure directory exists
        if (!Storage::exists("public/{$path}")) {
            Storage::makeDirectory("public/{$path}");
        }

        // Generate file name
        $name = safe_upload_name($file, $rename);

        // Store file
        Storage::disk('public')->putFileAs($path, $file, $name);

        // File relative path
        $relativePath = "{$path}/{$name}";


        // Remove old file if needed
        if ($unlink && $oldPath && Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }

        // Return saved image instance
        return $relativePath;
    }
}
if (! function_exists('isUserEnrolledInEvent')) {
    function isUserEnrolledInEvent($user , Event|int $event): bool
    {
        if (! $user) {
            return false;
        }

        $eventId = $event instanceof Event ? $event->id : $event;

        return $user->events->contains($eventId);
    }
}

if (!function_exists('hasAppliedForJob')) {
    function hasAppliedForJob($user, $job)
    {
        return JobApplication::where('user_id', $user->id)
            ->where('job_post_id', $job->id)
            ->exists();
    }
}

if (!function_exists('hasRequestedBooking')) {
    /**
     * Check if a user has already requested a booking for a coworking space
     *
     * @param User|null $user
     * @param CoworkingSpace|int $coworkingSpace
     * @return bool
     */
    function hasRequestedBooking($user, $coworkingSpace): bool
    {
        if (!$user) {
            return false;
        }

        $coworkingSpaceId = $coworkingSpace instanceof CoworkingSpace ? $coworkingSpace->id : $coworkingSpace;

        return BookingRequest::where('user_id', $user->id)
            ->where('coworking_space_id', $coworkingSpaceId)
            ->exists();
    }
}

if (!function_exists('hasActiveBookingRequest')) {
    /**
     * Check if a user has an active booking request (alias for hasRequestedBooking)
     *
     * @param User|null $user
     * @param CoworkingSpace|int $coworkingSpace
     * @return bool
     */
    function hasActiveBookingRequest($user, $coworkingSpace): bool
    {
        return hasRequestedBooking($user, $coworkingSpace);
    }
}

if (!function_exists('eventDuration')) {
    function eventDuration($startTime, $endTime)
    {
        $start = Carbon::parse($startTime);
        $end   = Carbon::parse($endTime);

        $diffInHours = $start->diffInHours($end);
        $diffInMinutes = $start->diffInMinutes($end) % 60;

        if ($diffInHours > 0 && $diffInMinutes > 0) {
            return $diffInHours . ' hrs ' . $diffInMinutes . ' mins';
        } elseif ($diffInHours > 0) {
            return $diffInHours . ' hrs';
        } else {
            return $diffInMinutes . ' mins';
        }
    }
}

if (!function_exists('render_rows')) {
    /**
     * Render rows for any collection or paginator with a given view.
     *
     * @param  \Illuminate\Support\Collection|\Illuminate\Pagination\LengthAwarePaginator  $items
     * @param  string  $view
     * @param  string  $variableName
     * @return string
     */
    function render_rows($items, string $view, string $variableName = 'item'): string
    {
        $rows = '';
        $serialNumber = $items instanceof \Illuminate\Pagination\LengthAwarePaginator
            ? $items->firstItem()
            : 1;

        if($items->count() > 0)
        {
            foreach ($items as $index => $item) {
                $rows .= view($view, [
                    $variableName => $item,
                    'serialNumber' => $serialNumber + $index,
                ])->render();
            }
        }
        else {
            $rows .= '<tr id="no-record-row"><td colspan="16" class="text-center">No record found</td></tr>';
        }

        return $rows;
    }
}

if (!function_exists('formatPageName')) {
    function formatPageName($name)
    {
        // Remove "_page", replace underscores with space, and make uppercase
        return strtoupper(str_replace('_', ' ', str_replace('_page', '', $name)));
    }
}

if (!function_exists('clean_html')) {
    /**
     * Sanitise rich text (e.g. CKEditor output) for raw output with {!! !!}.
     * Keeps formatting tags, strips scripts, event handlers and javascript: URLs.
     */
    function clean_html($html): string
    {
        static $purifier = null;

        if ($html === null || $html === '') {
            return '';
        }

        if ($purifier === null) {
            $cachePath = storage_path('framework/cache/htmlpurifier');
            if (!is_dir($cachePath)) {
                mkdir($cachePath, 0755, true);
            }

            $config = \HTMLPurifier_Config::createDefault();
            $config->set('Cache.SerializerPath', $cachePath);
            $config->set('HTML.SafeIframe', true);
            $config->set('URI.SafeIframeRegexp', '%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%');
            $config->set('Attr.AllowedFrameTargets', ['_blank']);
            $purifier = new \HTMLPurifier($config);
        }

        return $purifier->purify((string) $html);
    }
}




