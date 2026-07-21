<?php

use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Generate Random String
 *
 * @param $length
 * @return string
 */
function STR_RANDOM($length): string
{
    return Str::random($length);
}

/**
 * Upload Given File
 * @param object $file
 * @param string $path
 * @param bool $rename
 * @param bool $unlink
 * @param string|null $oldPath
 *
 * @return bool|string
 *
 */
function UPLOAD_FILE(object $file, string $path, $rename = true, bool $unlink = false, string $oldPath = null)
{
    $name = $rename ? STR_RANDOM(10) . '-' . time() . '.' . $file->getClientOriginalExtension() : $file->getClientOriginalName();
    if (MAKE_DIR($path)) {
        Storage::disk('public')->putFileAs($path, $file, $name);
        $full_image_name = '/storage/' . $path . '/' . $name;
        !$unlink ?: REMOVE_FILE($oldPath);
        return $full_image_name;
    }

    return false;
}

/**
 * Create New Directory
 *
 * @param string $name
 * @return bool
 */
function MAKE_DIR(string $name): bool
{
    if (!Storage::disk('public')->exists($name)) {
        Storage::disk('public')->makeDirectory($name);
    }

    return true;
}

/**
 * Remove Existing File
 *
 * @param string $filepath
 * @return bool
 */
function REMOVE_FILE(string $filepath): bool
{
    return Storage::deleteDirectory($filepath);
}