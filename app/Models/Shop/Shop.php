<?php

namespace App\Models\Shop;

use App\Models\Model;

class Shop extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'name', 'sort', 'has_image', 'description', 'parsed_description', 'is_active', 'is_staff', 'use_coupons', 'is_restricted', 'is_fto', 'allowed_coupons'
=======
        'name', 'sort', 'has_image', 'description', 'parsed_description', 'is_active',
>>>>>>> upstream/develop
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shops';
<<<<<<< HEAD

=======
>>>>>>> upstream/develop
    /**
     * Validation rules for creation.
     *
     * @var array
     */
    public static $createRules = [
        'name'        => 'required|unique:item_categories|between:3,100',
        'description' => 'nullable',
        'image'       => 'mimes:png',
    ];

    /**
     * Validation rules for updating.
     *
     * @var array
     */
    public static $updateRules = [
        'name'        => 'required|between:3,100',
        'description' => 'nullable',
        'image'       => 'mimes:png',
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the shop stock.
     */
<<<<<<< HEAD
    public function stock()
    {
=======
    public function stock() {
>>>>>>> upstream/develop
        return $this->hasMany('App\Models\Shop\ShopStock');
    }

    /**
     * Get the shop stock as items for display purposes.
     */
<<<<<<< HEAD
    public function displayStock()
    {
        return $this->belongsToMany('App\Models\Item\Item', 'shop_stock')->withPivot('item_id', 'currency_id', 'cost', 'use_user_bank', 'use_character_bank', 'is_limited_stock', 'quantity', 'purchase_limit', 'purchase_limit_timeframe', 'id', 'is_visible', 'disallow_transfer')->wherePivot('is_visible', 1);
    }

    public function limits()
    {
        return $this->hasMany('App\Models\Shop\ShopLimit', 'shop_id');
=======
    public function displayStock() {
        return $this->belongsToMany('App\Models\Item\Item', 'shop_stock')->withPivot('item_id', 'currency_id', 'cost', 'use_user_bank', 'use_character_bank', 'is_limited_stock', 'quantity', 'purchase_limit', 'id');
>>>>>>> upstream/develop
    }

    /**********************************************************************************************

        ACCESSORS

    **********************************************************************************************/

    /**
     * Displays the shop's name, linked to its purchase page.
     *
     * @return string
     */
    public function getDisplayNameAttribute() {
        return '<a href="'.$this->url.'" class="display-shop">'.$this->name.'</a>';
    }

    /**
     * Gets the file directory containing the model's image.
     *
     * @return string
     */
    public function getImageDirectoryAttribute() {
        return 'images/data/shops';
    }

    /**
     * Gets the file name of the model's image.
     *
     * @return string
     */
    public function getShopImageFileNameAttribute() {
        return $this->id.'-image.png';
    }

    /**
     * Gets the path to the file directory containing the model's image.
     *
     * @return string
     */
    public function getShopImagePathAttribute() {
        return public_path($this->imageDirectory);
    }

    /**
     * Gets the URL of the model's image.
     *
     * @return string
     */
    public function getShopImageUrlAttribute() {
        if (!$this->has_image) {
            return null;
        }

        return asset($this->imageDirectory.'/'.$this->shopImageFileName);
    }

    /**
     * Gets the URL of the model's encyclopedia page.
     *
     * @return string
     */
    public function getUrlAttribute() {
        return url('shops/'.$this->id);
    }

<<<<<<< HEAD
    /**********************************************************************************************

        OTHER FUNCTIONS

    **********************************************************************************************/

    /**
     * Gets all the coupons useable in the shop
     */
    public function getAllAllowedCouponsAttribute()
    {
        if(!$this->use_coupons || !$this->allowed_coupons) return;
        // Get the coupons from the id in allowed_coupons
        $coupons = \App\Models\Item\Item::whereIn('id', json_decode($this->allowed_coupons, 1))->get();
        return $coupons;
=======
    /**
     * Gets the admin edit URL.
     *
     * @return string
     */
    public function getAdminUrlAttribute() {
        return url('admin/data/shops/edit/'.$this->id);
    }

    /**
     * Gets the power required to edit this model.
     *
     * @return string
     */
    public function getAdminPowerAttribute() {
        return 'edit_data';
>>>>>>> upstream/develop
    }
}
