<?php

namespace App\Services;

use App\Models\Property;

class PropertyService extends DefaultService
{
    public $modelName = Property::class;
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
        if (isset($params['property_fields'])) {
            (new PropertyFieldService())->saveMany($params['property_fields'], [
                'property_id' => $model->id,
            ]);
        }

    }

    public function prepareArray($params){
        if(isset($params['propertyType']))
            $params['property_type']=$params['propertyType'];
        if(isset($params['fields']))
            $params = $this->prepareFields($params);
        return $params;
    }

    public function prepareFields($params){
        $result =[];
        foreach($params['fields'] as $key=> $param){
            if(isset($param))
            $result[]=['field_name'=>$key,'field_value'=>$param];
        }
        $params['property_fields'] = $result;
        return $params;
    }
}
