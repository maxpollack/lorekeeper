<?php

namespace App\Services;

use App\Models\Shop\Shop;
<<<<<<< HEAD
use App\Models\Shop\ShopLimit;
use App\Models\Shop\ShopStock;
=======
use DB;
>>>>>>> upstream/develop

class ShopService extends Service {
    /*
    |--------------------------------------------------------------------------
    | Shop Service
    |--------------------------------------------------------------------------
    |
    | Handles the creation and editing of shops and shop stock.
    |
    */

    /**********************************************************************************************

        SHOPS

    **********************************************************************************************/

    /**
     * Creates a new shop.
     *
<<<<<<< HEAD
     * @param  array                  $data
     * @param  \App\Models\User\User  $user
     * @return bool|\App\Models\Shop\Shop
=======
     * @param array                 $data
     * @param \App\Models\User\User $user
     *
     * @return \App\Models\Shop\Shop|bool
>>>>>>> upstream/develop
     */
    public function createShop($data, $user) {
        DB::beginTransaction();

        try {
            $data = $this->populateShopData($data);

            $image = null;
            if (isset($data['image']) && $data['image']) {
                $data['has_image'] = 1;
                $image = $data['image'];
                unset($data['image']);
            } else {
                $data['has_image'] = 0;
            }

            $shop = Shop::create($data);

            if ($image) {
                $this->handleImage($image, $shop->shopImagePath, $shop->shopImageFileName);
            }

            return $this->commitReturn($shop);
<<<<<<< HEAD
        } catch(\Exception $e) {
=======
        } catch (\Exception $e) {
>>>>>>> upstream/develop
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Updates a shop.
     *
<<<<<<< HEAD
     * @param  \App\Models\Shop\Shop  $shop
     * @param  array                  $data
     * @param  \App\Models\User\User  $user
     * @return bool|\App\Models\Shop\Shop
=======
     * @param \App\Models\Shop\Shop $shop
     * @param array                 $data
     * @param \App\Models\User\User $user
     *
     * @return \App\Models\Shop\Shop|bool
>>>>>>> upstream/develop
     */
    public function updateShop($shop, $data, $user) {
        DB::beginTransaction();

        try {
            // More specific validation
            if (Shop::where('name', $data['name'])->where('id', '!=', $shop->id)->exists()) {
                throw new \Exception('The name has already been taken.');
            }

            $data = $this->populateShopData($data, $shop);

            $image = null;
<<<<<<< HEAD
            if(isset($data['image']) && $data['image']) {
=======
            if (isset($data['image']) && $data['image']) {
>>>>>>> upstream/develop
                $data['has_image'] = 1;
                $image = $data['image'];
                unset($data['image']);
            }

            $shop->update($data);

            if ($shop) {
                $this->handleImage($image, $shop->shopImagePath, $shop->shopImageFileName);
            }

            return $this->commitReturn($shop);
<<<<<<< HEAD
        } catch(\Exception $e) {
=======
        } catch (\Exception $e) {
>>>>>>> upstream/develop
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Updates shop stock.
     *
<<<<<<< HEAD
     * @param  \App\Models\Shop\Shop  $shop
     * @param  array                  $data
     * @param  \App\Models\User\User  $user
     * @return bool|\App\Models\Shop\Shop
=======
     * @param \App\Models\Shop\Shop $shop
     * @param array                 $data
     * @param \App\Models\User\User $user
     *
     * @return \App\Models\Shop\Shop|bool
>>>>>>> upstream/develop
     */
    public function updateShopStock($shop, $data, $user) {
        DB::beginTransaction();

        try {
<<<<<<< HEAD
            if(!$data['stock_type']) throw new \Exception("Please select a stock type.");
            if(!$data['item_id']) throw new \Exception("You must select an item.");

            $shop->stock()->create([
                'shop_id'               => $shop->id,
                'item_id'               => $data['item_id'],
                'currency_id'           => $data['currency_id'],
                'cost'                  => $data['cost'],
                'use_user_bank'         => isset($data['use_user_bank']),
                'use_character_bank'    => isset($data['use_character_bank']),
                'is_fto'                => isset($data['is_fto']),
                'is_limited_stock'      => isset($data['is_limited_stock']),
                'quantity'              => isset($data['is_limited_stock']) ? $data['quantity'] : 0,
                'purchase_limit'        => $data['purchase_limit'],
                'purchase_limit_timeframe' => $data['purchase_limit_timeframe'],
                'stock_type'            => $data['stock_type'],
                'is_visible'            => isset($data['is_visible']) ? $data['is_visible'] : 0,
                'restock'               => isset($data['restock']) ? $data['restock'] : 0,
                'restock_quantity'      => isset($data['restock']) && isset($data['quantity']) ? $data['quantity'] : 1,
                'restock_interval'      => isset($data['restock_interval']) ? $data['restock_interval'] : 2,
                'range'                 => isset($data['range']) ? $data['range'] : 0,
            ]);

            return $this->commitReturn($shop);
        } catch(\Exception $e) {
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }

    /**
     * Updates shop stock.
     *
     * @param  \App\Models\Shop\Shop  $shop
     * @param  array                  $data
     * @param  \App\Models\User\User  $user
     * @return bool|\App\Models\Shop\Shop
     */
    public function editShopStock($stock, $data, $user)
    {
        DB::beginTransaction();

        try {
            if(!$data['stock_type']) throw new \Exception("Please select a stock type.");
            if(!$data['item_id']) throw new \Exception("You must select an item.");

            $stock->update([
                'shop_id'               => $stock->shop->id,
                'item_id'               => $data['item_id'],
                'currency_id'           => $data['currency_id'],
                'cost'                  => $data['cost'],
                'use_user_bank'         => isset($data['use_user_bank']),
                'use_character_bank'    => isset($data['use_character_bank']),
                'is_fto'                => isset($data['is_fto']),
                'is_limited_stock'      => isset($data['is_limited_stock']),
                'quantity'              => isset($data['is_limited_stock']) ? $data['quantity'] : 0,
                'purchase_limit'        => $data['purchase_limit'],
                'purchase_limit_timeframe' => $data['purchase_limit_timeframe'],
                'stock_type'            => $data['stock_type'],
                'is_visible'            => isset($data['is_visible']) ? $data['is_visible'] : 0,
                'restock'               => isset($data['restock']) ? $data['restock'] : 0,
                'restock_quantity'      => isset($data['restock']) && isset($data['quantity']) ? $data['quantity'] : 1,
                'restock_interval'      => isset($data['restock_interval']) ? $data['restock_interval'] : 2,
                'range'                 => isset($data['range']) ? $data['range'] : 0,
                'disallow_transfer'     => isset($data['disallow_transfer']) ? $data['disallow_transfer'] : 0
            ]);

            return $this->commitReturn($stock);
        } catch(\Exception $e) {
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }

    public function deleteStock($stock)
    {
        DB::beginTransaction();

        try {

            $stock->delete();

            return $this->commitReturn(true);
        } catch(\Exception $e) {
=======
            if (isset($data['item_id'])) {
                foreach ($data['item_id'] as $key => $itemId) {
                    if ($data['cost'][$key] == null) {
                        throw new \Exception('One or more of the items is missing a cost.');
                    }
                    if ($data['cost'][$key] < 0) {
                        throw new \Exception('One or more of the items has a negative cost.');
                    }
                }

                // Clear the existing shop stock
                $shop->stock()->delete();

                foreach ($data['item_id'] as $key => $itemId) {
                    $shop->stock()->create([
                        'shop_id'               => $shop->id,
                        'item_id'               => $data['item_id'][$key],
                        'currency_id'           => $data['currency_id'][$key],
                        'cost'                  => $data['cost'][$key],
                        'use_user_bank'         => isset($data['use_user_bank'][$key]),
                        'use_character_bank'    => isset($data['use_character_bank'][$key]),
                        'is_limited_stock'      => isset($data['is_limited_stock'][$key]),
                        'quantity'              => isset($data['is_limited_stock'][$key]) ? $data['quantity'][$key] : 0,
                        'purchase_limit'        => $data['purchase_limit'][$key],
                    ]);
                }
            } else {
                // Clear the existing shop stock
                $shop->stock()->delete();
            }

            return $this->commitReturn($shop);
        } catch (\Exception $e) {
>>>>>>> upstream/develop
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
<<<<<<< HEAD
     * Processes user input for creating/updating a shop.
     *
     * @param  array                  $data
     * @param  \App\Models\Shop\Shop  $shop
     * @return array
     */
    private function populateShopData($data, $shop = null)
    {
        if(isset($data['description']) && $data['description']) $data['parsed_description'] = parse($data['description']);
        $data['is_active'] = isset($data['is_active']);
        $data['is_staff'] = isset($data['is_staff']);
        $data['use_coupons'] = isset($data['use_coupons']);
        $data['allowed_coupons'] = isset($data['allowed_coupons']) ? $data['allowed_coupons'] : null;

        if(isset($data['remove_image']))
        {
            if($shop && $shop->has_image && $data['remove_image'])
            {
                $data['has_image'] = 0;
                $this->deleteImage($shop->shopImagePath, $shop->shopImageFileName);
            }
            unset($data['remove_image']);
        }

        return $data;
    }

    /**
=======
>>>>>>> upstream/develop
     * Deletes a shop.
     *
     * @param \App\Models\Shop\Shop $shop
     *
     * @return bool
     */
    public function deleteShop($shop) {
        DB::beginTransaction();

        try {
            // Delete shop stock
            $shop->stock()->delete();

<<<<<<< HEAD
            if($shop->has_image) $this->deleteImage($shop->shopImagePath, $shop->shopImageFileName);
            $shop->delete();

            return $this->commitReturn(true);
        } catch(\Exception $e) {
=======
            if ($shop->has_image) {
                $this->deleteImage($shop->shopImagePath, $shop->shopImageFileName);
            }
            $shop->delete();

            return $this->commitReturn(true);
        } catch (\Exception $e) {
>>>>>>> upstream/develop
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Sorts shop order.
     *
     * @param array $data
     *
     * @return bool
     */
    public function sortShop($data) {
        DB::beginTransaction();

        try {
            // explode the sort array and reverse it since the order is inverted
            $sort = array_reverse(explode(',', $data));

            foreach ($sort as $key => $s) {
                Shop::where('id', $s)->update(['sort' => $key]);
            }

            return $this->commitReturn(true);
<<<<<<< HEAD
        } catch(\Exception $e) {
=======
        } catch (\Exception $e) {
>>>>>>> upstream/develop
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

<<<<<<< HEAD
    public function restrictShop($data, $id)
    {
        DB::beginTransaction();

        try {
            if(!isset($data['is_restricted'])) $data['is_restricted'] = 0;

            $shop = Shop::find($id);
            $shop->is_restricted = $data['is_restricted'];
            $shop->save();

            $shop->limits()->delete();

            if(isset($data['item_id'])) {
                foreach($data['item_id'] as $key => $type)
                {
                    ShopLimit::create([
                        'shop_id'       => $shop->id,
                        'item_id' => $type,
                    ]);
                }
            }

            return $this->commitReturn(true);
        } catch(\Exception $e) {
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
=======
    /**
     * Processes user input for creating/updating a shop.
     *
     * @param array                 $data
     * @param \App\Models\Shop\Shop $shop
     *
     * @return array
     */
    private function populateShopData($data, $shop = null) {
        if (isset($data['description']) && $data['description']) {
            $data['parsed_description'] = parse($data['description']);
        } else {
            $data['parsed_description'] = null;
        }
        $data['is_active'] = isset($data['is_active']);

        if (isset($data['remove_image'])) {
            if ($shop && $shop->has_image && $data['remove_image']) {
                $data['has_image'] = 0;
                $this->deleteImage($shop->shopImagePath, $shop->shopImageFileName);
            }
            unset($data['remove_image']);
        }

        return $data;
>>>>>>> upstream/develop
    }
}
