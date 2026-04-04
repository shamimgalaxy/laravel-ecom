<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productt extends Model // Fixed typo from 'productt'
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'sub_category_id', 'brand_id', 'unit_id', 'name', 
        'code', 'model', 'stock_amount', 'regular_price', 'selling_price', 
        'short_description', 'long_description', 'image', 'hit_count', 
        'sales_count', 'featured_status', 'status'
    ];

    public static function getImageUrl($request) { 
        $image = $request->file('image');
        if ($image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $directory = 'upload/product-images/';
            $image->move($directory, $imageName);
            return $directory . $imageName;
        }
        return null;
    }

    public static function newProduct($request) {
        $product = new self();
        $product->name               = $request->name;
        $product->category_id        = $request->category_id;
        $product->sub_category_id    = $request->sub_category_id;
        $product->brand_id           = $request->brand_id;
        $product->unit_id            = $request->unit_id;
        $product->code               = $request->code;
        $product->model              = $request->model;
        $product->stock_amount       = $request->stock_amount;
        $product->regular_price      = $request->regular_price;
        $product->selling_price      = $request->selling_price;
        $product->short_description  = $request->short_description;
        $product->long_description   = $request->long_description;
        $product->image              = self::getImageUrl($request);
        $product->hit_count          = $request->hit_count ?? 0;
        $product->sales_count        = $request->sales_count ?? 0;
        $product->featured_status    = $request->featured_status ?? 0;
        $product->status             = $request->status;
        
        $product->save();
        return $product;
    }

    public static function updatedProduct($request, $id) {
        $product = self::findOrFail($id);
        $image = $request->file('image');

        if ($image) {
            // Optional: Delete the old image file here if it exists
            if (file_exists($product->image)) {
                unlink($product->image);
            }
            $imageUrl = self::getImageUrl($request);
        } else {
            $imageUrl = $product->image; // Keep existing image
        }

        $product->update([
            'category_id'       => $request->category_id,
            'sub_category_id'   => $request->sub_category_id,
            'brand_id'          => $request->brand_id,
            'unit_id'           => $request->unit_id,
            'name'              => $request->name,
            'code'              => $request->code,
            'model'             => $request->model,
            'stock_amount'      => $request->stock_amount,
            'regular_price'     => $request->regular_price,
            'selling_price'     => $request->selling_price,
            'short_description' => $request->short_description,
            'long_description'  => $request->long_description,
            'image'             => $imageUrl,
            'featured_status'   => $request->featured_status ?? 0,
            'status'            => $request->status,
        ]);

        return $product;
    }

    public static function deleteProduct($id) {
        $product = self::findOrFail($id);

        // Optional: Delete the image file here if it exists
        if (file_exists($product->image)) {
            unlink($product->image);
        }

        $product->delete();
    }

    ### Relationships

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function sub_category() {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function unit() {
        return $this->belongsTo(Unit::class);
    }

    public function other_images() {
        return $this->hasMany(OtherImage::class, 'product_id', 'id');
    }

    public function otherImages()
{
    // If your foreign key in the other_images table is 'product_id'
    return $this->hasMany(OtherImage::class, 'product_id'); 
}
}