<?php

namespace App\Services;

use App\Models\SearchProfile;

class SearchProfileService extends DefaultService
{
    public $modelName = SearchProfile::class;
    public function store($params)
    {
        $params = $this->prepareArray($params);

        $model = parent::store($params);

        $this->saveRelatedData($model, $params);

        return $model;
    }

    public function update($params)
    {
        $params = $this->prepareArray($params);

        $model = parent::update($params);

        $this->saveRelatedData($model, $params);

        return $model;
    }


    public function saveRelatedData($model, $params)
    {
        if (isset($params['search_profile_fields'])) {
            (new SearchProfileFieldService())->saveMany($params['search_profile_fields'], [
                'search_profile_id' => $model->id,
            ]);
        }

    }

    public function prepareArray($params){
        if(isset($params['propertyType']))
            $params['property_type']=$params['propertyType'];
        if(isset($params['searchFields'])){
            $params = $this->prepareFields($params);
        }
        return $params;
    }

    public function prepareFields($params){
        $result =[];
        foreach($params['searchFields']  as $key=> $param){
            if( is_array($param) )
                $result[]=['field_name'=>$key,'min_range_value'=>$param[0] ?? null ,'max_range_value'=>$param[1] ?? null,'field_type'=>'range'];
            else
                $result[]=['field_name'=>$key,'exact_value'=>$param,'field_type'=>'direct'];
        }
        $params['search_profile_fields'] = $result;
        return $params;
    }
}
