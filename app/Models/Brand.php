<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

    // Added 'brand_id' here if it actually exists in your migration
    protected $fillable = [ 'name', 'description', 'image', 'status'];

    public static function getImageUrl($request) {
        $image = $request->file('image');
        if ($image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $directory = 'upload/brand-images/';
            // Ensure the directory exists in the public folder
            $image->move(public_path($directory), $imageName); 
            return $directory . $imageName; 
        }
        return null;
    }

    public static function newBrand($request) {
        $brand = new self();
        // Only keep this line if 'brand_id' exists in your database table!
        $brand->name        = $request->name;
        $brand->description = $request->description;
        $brand->image       = self::getImageUrl($request);
        $brand->status      = $request->status;
        $brand->save(); 
    }

    public static function updatedBrand($request, $id) {
        $brand = self::findOrFail($id);
        
        $imageUrl = $brand->image; // Default to old image
        if ($request->hasFile('image')) {
            if ($brand->image && file_exists(public_path($brand->image))) {
                unlink(public_path($brand->image));
            }
            $imageUrl = self::getImageUrl($request);
        }

        $brand->update([
            'brand_id'    => $request->brand_id,
            'name'        => $request->name,
            'description' => $request->description,
            'image'       => $imageUrl,
            'status'      => $request->status,
        ]);
    }

    // ... deleteBrand logic is fine as is
}