<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('my_custom_helper')) {
    function category_name($id)
    {
        $category_name = DB::table('categories')->select('name')->where("id", $id)->get();
        return $category_name[0]->name;
    }
}
