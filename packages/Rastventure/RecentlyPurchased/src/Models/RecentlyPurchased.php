<?php

namespace Rastventure\RecentlyPurchased\Models;

use Illuminate\Database\Eloquent\Model;
use Rastventure\RecentlyPurchased\Contracts\RecentlyPurchased as RecentlyPurchasedContract;

class RecentlyPurchased extends Model implements RecentlyPurchasedContract
{
    protected $fillable = [];
}