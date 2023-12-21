<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Place extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner_id',
        'name',
        'slug',
        'slogan',
        'description',
        'is_approved',
        'is_active',
        'longitude',
        'latitude',
        'email',
        'phone',
        'website',
        'address',
        'city',
        'country',
        'zip_code',
        'max_guests',
        'num_bedrooms',
        'num_beds',
        'num_baths',
        'superficy',
        'check_in_hour',
        'check_out_hour',
        'cancellation_policy',
        'min_stay',
        'max_stay',
        'price',
        'currency',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'owner_id' => 'integer',
        'is_approved' => 'boolean',
        'is_active' => 'boolean',
        'longitude' => 'float',
        'latitude' => 'float',
    ];

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function reservations(): MorphMany
    {
        return $this->morphMany(Reservation::class, 'reservationable');
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favoriteable');
    }

    public function phones(): MorphMany
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }

    public function contacts(): MorphMany
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
