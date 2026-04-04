<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\CategoryController;

class SubCategory extends Model
{
    protected $fillable=['category_id','name','description','image','status'];

    public static function getImageUrl($request){
        $image=$request->file('image');
        if($image){
            $imageName=time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/sub-category-images'),$imageName);
            return 'images/sub-category-images/'.$imageName;
        }
    }

     public static function newSubCategory($request) {
    $subCategory = new SubCategory();
    $subCategory->category_id = $request->category_id;
    $subCategory->name        = $request->name;
    $subCategory->description = $request->description;
    $subCategory->image       = self::getImageUrl($request);
    // Ensure status has a default if the checkbox/radio wasn't selected
    $subCategory->status      = $request->status ?? 1; 
    $subCategory->save(); 
}

    public static function updatedSubCategory($request, $id) {
    $subCategory = self::findOrFail($id); // Use a variable name that matches the model
    
    if ($request->hasFile('image')) {
        if ($subCategory->image && file_exists(public_path($subCategory->image))) {
            unlink(public_path($subCategory->image));
        }
        $imageUrl = self::getImageUrl($request);
    } else {
        $imageUrl = $subCategory->image;
    }
    
    // Crucial: You must include category_id and the name here
    $subCategory->update([
        'category_id' => $request->category_id,
        'name'        => $request->name,
        'description' => $request->description,
        'image'       => $imageUrl,
        'status'      => $request->status,
    ]);
}
    // Inside app/Models/SubCategory.php

public static function deleteSubCategory($id)
{
    $subCategory = self::find($id);
    if ($subCategory) {
        $subCategory->delete();
    }
}

public function category()
{
    return $this->belongsTo(Category::class, 'category_id');
}

    //end function
}
