<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class OtherImage extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'image'];
    private static $otherImage,$otherImages, $image, $imageName, $directory, $imageUrl, $imageExtension;

     public static function getImageUrl($image)
{
    self::$imageExtension = $image->getClientOriginalExtension();
    self::$imageName = rand(1,50000) . '_' . self::$imageExtension;
    self::$directory = 'upload/product-other-images/';
    $image->move(self::$directory, self::$imageName);
    self::$imageUrl = self::$directory . self::$imageName;
    return self::$imageUrl;
}

    public static function newOtherImage($images, $id) { 
       foreach ($images as $image) {
            self::$otherImage = new OtherImage();
            self::$otherImage->product_id = $id;
            self::$otherImage->image = self::getImageUrl($image);
            self::$otherImage->save();
        }
    }

    public static function updateOtherImage($images, $id) {
        foreach ($images as $image) 
            {
                $otherImage = self::where('product_id', $id)->first();
                if ($otherImage) {
                    // Delete the old image file
                    if (File::exists(public_path($otherImage->image))) {
                        File::delete(public_path($otherImage->image));
                    }
                    // Update with the new image
                    $otherImage->image = self::getImageUrl($image);
                    $otherImage->save();
                } else {
                    // If no existing image, create a new one
                    self::$otherImage = new OtherImage();
                    self::$otherImage->product_id = $id;
                    self::$otherImage->image = self::getImageUrl($image);
                    self::$otherImage->save();
                }
            }
    }

    public static function deleteOtherImage($id) {
        $otherImage = self::where('product_id', $id)->first();
        if ($otherImage) {
            
            if (File::exists(public_path($otherImage->image))) {
                File::delete(public_path($otherImage->image));
            }
            
            $otherImage->delete();
        }
    }

    // end function
    
}