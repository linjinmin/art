<?php
/**
 * Created by PhpStorm.
 * User: lin
 * Date: 16/05/2017
 * Time: 16:16
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

trait TableTrait
{


    public function getPaginate(Request $request, $object, array $filters=[], array $columns=['*'], $perPage=15, $pageName='page', $page=null)
    {


        if (!count($filters)){
            return $object->paginate($perPage, $columns, $pageName, $page);
        }

        $appends = [];

        foreach ($filters as $filter_name => $filter){
            if (!is_null($request->input($filter_name))){
                $appends = [
                    $filter_name => $request->input($filter_name),
                ];

                $whereType = $filter['where'];
                if (is_callable($whereType)){
                    $object->where(function($query) use ($whereType, $filter_name, $request){
                        $whereType($query, $filter_name, $request->input($filter_name));
                    });
                } else {
                    $object->where(function($query) use ($whereType, $filter_name, $request){
                        if ($whereType == 'like'){
                            $query->where($filter_name, 'like', '%' . $request->input($filter_name) . '%');
                        } elseif ($whereType == 'euqals' || $whereType == '='){
                            $query->where($filter_name, '=', $request->input($filter_name));
                        }

                    });
                }
            }


        }

        $object = $object->paginate($perPage, $columns, $pageName, $page);
        foreach ($appends as $append){
            $object->appends($append);
        };
        return $object;


    }





}