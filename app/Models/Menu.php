<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Traits\ModelTree;

class Menu extends Model
{
    protected $guarded = ['_method','_token'];
    protected $sortableColumn = 'sortable';
    protected $parentColumn = 'parent_id';

    /**
      * @Author: sdc-studio
      * @Date: 2020-02-26 11:23:54
      * @Desc: Relation roles
      * @Return: BelongsToMany
    */
    public function roles() : BelongsToMany{
        $relatedModel = config('admin.database.roles_model');
        $pivotTable = config('admin.database.role_menu_table');
        return $this->belongsToMany($relatedModel,$pivotTable,'menu_id','role_id');
    }

    public static function tree(){
        $sortingData = self::orderBy('id','desc')->get();
        return self::sorting($sortingData,0,1,true);
    }

    /**
      * @Author: sdc-studio
      * @Date: 2020-02-26 13:01:58
      * @Desc: all menus
      * @Return: array
    */
    public function allNodes() : array{
        $queryObject = $this->orderBy($this->sortableColumn,'ASC');
        if (config('admin.check_role_menu') !== false){
            $queryObject->with('roles');
        }
        return $queryObject->get()->toArray();
    }
    /**
      * @Author: sdc-studio
      * @Date: 2020-02-26 13:38:19
      * @Desc: generated tree array
      * @Return: array
    */
    protected function buildNestedArray(array $nodes = [], $parentId = 0)
    {
        $branch = [];

        if (empty($nodes)) {
            $nodes = $this->allNodes();
        }

        foreach ($nodes as $node) {
            if ($node[$this->parentColumn] == $parentId) {
                $children = $this->buildNestedArray($nodes, $node[$this->getKeyName()]);

                if ($children) {
                    $node['children'] = $children;
                }

                $branch[] = $node;
            }
        }

        return $branch;
    }

    public static function toTree(){
        $self = new static();
        return $self->buildNestedArray();
    }

    static protected function sorting($sortingData,$parentId=0,$level=1,$text=false){
        static $sortedArray = [];
        foreach($sortingData as $sortingDataKey => $sortingDataValue){
            if ($sortingDataValue['parent_id'] == $parentId){
                $sortingDataValue['level'] = $level;
                if ($level > 1 && $text == true)
                    $sortingDataValue['title'] = str_repeat('--',$level).$sortingDataValue['title'];
                array_push($sortedArray,$sortingDataValue);
                self::sorting($sortingData,$sortingDataValue['id'],$level+1,$text);
            }
        }
        return $sortedArray;
    }
}
