<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LovType extends Model
{
    use SoftDeletes;

    // Categories
    const CATEGORY_INDIVIDUAL = 'individual';
    const CATEGORY_BUSINESS = 'business';
    const CATEGORY_EMBASSY = 'embassy';

    // Individual Category LOV Types
    const LEVEL             = 'level';
    const INFLUENCE_ABILITY = 'influence-ability';
    const INDUSTRY_AREA     = 'industry-area';
    const WORK_DOMAIN       = 'work-domain';
    const SKILLS            = 'skills';

    // Business Category LOV Types
    const COMPANY_TYPE = 'company-type';
    const INDUSTRY_TYPE_KSA = 'industry-type-ksa';
    const PRODUCT_NAME = 'product-name';
    const SERVICE_DOMAIN = 'service-domain';
    const SERVICE_SKILLS = 'service-skills';
    const SKILLS_BUSINESS = 'skills'; // Skills for business category

    // Embassy Category LOV Types
    const EVENT_DOMAIN = 'event-domain';
    const EVENT_MODE = 'event-mode';
    const LEAD_TYPE = 'lead-type';
    const CUSTOMERS = 'customers';

    protected $fillable = [
        'name',
        'slug',
        'category'
    ];

    public static function idFromSlug(string $slug): ?int
    {
        return static::where('slug', $slug)->value('id');
    }

    /**
     * Scope to filter by category
     */
    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Get all LOV types for a specific category
     */
    public static function getByCategory(string $category)
    {
        return static::byCategory($category)->get();
    }

    /**
     * Relationship to lovs
     */
    public function lovs()
    {
        return $this->hasMany(Lov::class);
    }
}
