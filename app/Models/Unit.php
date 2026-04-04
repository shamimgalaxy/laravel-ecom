<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    // Allows these fields to be filled via create() or update()
    protected $fillable = ['name', 'code','description', 'status'];

    /**
     * Create a new unit
     */
    public static function newUnit($request) 
    {
        // Using create() leverages your $fillable array automatically
        return self::create($request->all());
    }

    /**
     * Update an existing unit
     */
    public static function updatedUnit($request, $id) 
    {
        $unit = self::findOrFail($id);
        $unit->update($request->all());
        return $unit;
    }

    /**
     * Delete unit and its associated file
     */
    public static function deleteUnit($id)
    {
        $unit = self::findOrFail($id);

        // Delete the file if it exists
        if ($unit->image && file_exists(public_path($unit->image))) {
            unlink(public_path($unit->image));
        }

        return $unit->delete();
    }
}