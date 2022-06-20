<?php
/**
 * Created by PhpStorm.
 * User: shazaraj
 * Date: 20/6/2022
 * Time: 11:42 AM
 */
namespace App\Traits;


trait Helper
{
    public function destroyController($model, $id)
    {

        $item = $model::findorFail($id);
        if ($item) {

            $item->delete();
        }
        return response()->json(['status' => 200, 'success' => 'Deleted']);
    }

    public function editController($model, $id)
    {

        $item = $model::findorFail($id);
        return response()->json($item);
    }

}
