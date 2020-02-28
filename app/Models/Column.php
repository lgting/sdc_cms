<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    protected $guarded = ['_token','_method','file'];
    const StatusOptions = [0=>'隐藏',1=>'显示'];
    const AttributesOptions = [0=>'列表页',1=>'封面页',2=>'跳转地址'];

    static public function tree(){
        $sortingData = self::orderBy('id','desc')->get();
        return self::sorting($sortingData->toArray());
    }

    static public function treeOptions(){
        $sortingData = self::orderBy('id','desc')->get();
        return self::sorting($sortingData->toArray(),0,1,true);
    }

    static public function treeArray(){
        $tree = self::tree();
        $sortedArray = [];
        $manyLevelArrayTree = [];
        foreach($tree as $treeKey=>$treeValue)
        {
            $sortedArray[$treeValue['id']] = $tree[$treeKey];
        }
        foreach($sortedArray as $sortedArrayKey => $sortedArrayValue){
            if(isset($sortedArray[$sortedArrayValue['parent_id']])){
                $sortedArray[$sortedArrayValue['parent_id']]['children'][] = &$sortedArray[$sortedArrayValue['id']];
            }else{
                $manyLevelArrayTree[] = &$sortedArray[$sortedArrayValue['id']];
            }
        }
        return $manyLevelArrayTree;
    }


    static protected function sorting($sortingData,$parentId=0,$level=1,$text=false){
        static $sortedArray = [];
        foreach($sortingData as $sortingDataKey => $sortingDataValue){
            if ($sortingDataValue['parent_id'] == $parentId){
                $sortingDataValue['level'] = $level;
                if ($level > 1 && $text == true)
                    $sortingDataValue['name'] = str_repeat('--',$level).$sortingDataValue['name'];
                array_push($sortedArray,$sortingDataValue);
                self::sorting($sortingData,$sortingDataValue['id'],$level+1,$text);
            }
        }
        return $sortedArray;
    }
}
