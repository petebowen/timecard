<?php

namespace App\Models;

use Alsofronie\Uuid\UuidModelTrait;
use Illuminate\Database\Eloquent\Model;
use Validator;

class BaseModel extends Model
{
    
    public $incrementing = false;

    protected $duplicateFields = [];//array of fields to check for duplicates
    protected $rules = [];//array of validation rules
    protected $defaults = [];//property=>value
    protected $dates = [];
    protected $cascadeDelete = [];//array of relationships to delete

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->stripCommasFromDuplicateFields($model);
            return $model->validate($model);
        });

        static::creating(function ($model) {
            
            $model->setDefaults($model);
            $model->beforeCreate($model);
        });

        static::created(function ($model) {
            $model->afterCreate($model);
        });

       
        static::deleting(function ($model) {
            
            foreach ($model->cascadeDelete as $relationship) {
                if (!$model->{$relationship}) {
                    //ignore it
                } elseif ($model->{$relationship} instanceof Model) {
                    $model->{$relationship}->delete();
                } else {
                    foreach ($model->{$relationship} as $child) {
                        $child->delete();
                    }
                }
            }
        });
    }


    //commas in these fields screw up the validation so for now just turn them into dashes
    public function stripCommasFromDuplicateFields($model)
    {
        foreach ($model->duplicateFields as $field) {
            if (isset($model->{$field})) {
                $model->{$field} = str_replace(',', '-', $model->{$field});
            }
        }
        return $model;
    }

    public function validate($model)
    {
        
        $data = $model->toArray();
        $table = $model->getTable();

        //build up the duplicate prevention rule
        //the rule name is the first value in the duplicate fields array, the rest are tacked on afterwards
        if (!empty($model->duplicateFields)) {
            $ruleField = $model->duplicateFields[0];

            $array = [$table, $ruleField, $model->id,'id',];
        
            for ($i=1; $i < count($model->duplicateFields); $i++) {
                if (array_key_exists($model->duplicateFields[$i], $data)) {
                    $array[] = $model->duplicateFields[$i];
                    $array[] = $data[$model->duplicateFields[$i]];
                    //get rid of commas for the moment because they're used in the rules
                    //$array[] = str_replace(',' , '-', $data[$model->duplicateFields[$i]]);
                }
            }
  
            $this->rules[$ruleField] = 'unique:' . implode(',', $array);
        }

        $validator = Validator::make($data, $this->rules);

        if ($validator->fails()) {
            return false;
        }
        return true;
    }

    public function setDefaults($model)
    {
        foreach ($model->defaults as $key => $value) {
            if (!isset($model->{$key})) {
                $model->{$key} = $value;
            }
        }
    }

    public function beforeCreate($model)
    {
        return $model;
    }

    public function afterCreate($model)
    {
        return $model;
    }
}
