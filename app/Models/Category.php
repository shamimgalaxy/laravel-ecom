<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image', 'status'];

    public static function getImageUrl($request) {
        $image = $request->file('image');
        if ($image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $directory = 'upload/category-images/';
            $image->move($directory, $imageName);
            return $directory . $imageName;
        }
        return null;
    }

    public static function newCategory($request) {
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->image = self::getImageUrl($request);
        $category->status = $request->status;
        $category->save(); 
    }

    public static function updatedCategory($request, $id) {
        $category = self::findOrFail($id);
        $category = self::findOrFail($id);
        if ($request->hasFile('image')) {
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }
            $imageUrl = self::getImageUrl($request);
        } else {
            $imageUrl = $category->image;
        }
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageUrl,
            'status' => $request->status,
        ]);
    }
    public static function deleteCategory($id)
{
    $category = self::findOrFail($id);

    // Check if the image exists in the public folder and delete it
    if ($category->image && file_exists(public_path($category->image))) {
        unlink(public_path($category->image));
    }

    $category->delete();
}

public function subCategories()
{
    return $this->hasMany(SubCategory::class);
}

//end function
}