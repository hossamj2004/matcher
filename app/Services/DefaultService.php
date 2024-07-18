<?php
namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;

Abstract class DefaultService
{
    public function store($params)
    {
        $modelName = $this->modelName;
        $modelObject = new $modelName;
        $modelObject->fill($params);
        $modelObject->save();
        return $modelObject;
    }

    public function update($params)
    {
        $modelName = $this->modelName;
        $modelObject = $modelName::findOrFail($params['id']);
        $modelObject->fill($params);
        $modelObject->save();
        return $modelObject;
    }
    public function saveMany($params, $extraParams = []): void
    {
        foreach ($params as $param) {
            $param = array_merge($param, $extraParams);
            $this->saveOne($param);
        }
    }
    public function saveOne($param)
    {
        if (isset($param['id'])) {
            return $this->update($param);
        } else {
            return $this->store($param);
        }
    }
    public function storeAndCommit($params)
    {
        DB::beginTransaction();
        try {
            $result = $this->store($params);
            DB::commit();
            $result->refresh();
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateAndCommit($params)
    {
        DB::beginTransaction();
        try {
            $result = $this->update($params);
            DB::commit();
            $result->refresh();
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

}
