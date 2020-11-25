<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $table = 'service_catagories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'listing_order',
        'visibility',
        'deleted_at',
    ];

    public function getServiceCategory($id = false) {
        $query = $this->where('visibility', 0)->whereNull('deleted_at');
        if($id) {
            $query = $query->where('id', $id);
        }
        return $query;
    }
}
