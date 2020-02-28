<?php

namespace App\Models;

use App\Models\Model as Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
class Field extends Model
{
    protected $guarded = ['_token','_method'];
    const TYPE_STRING = 0;
    const TYPE_RADIO = 1;
    const TYPE_CHECKBOX = 2;
    const TYPE_TEXT = 3;
    const TYPE_FILE = 4;
    const TYPE_INT = 5;
    const TYPE_FLOAT = 6;
    const TYPE_SELECT = 7;
    const TYPE_EDITOR = 8;
    const TypeOptions = [
        self::TYPE_STRING => '单行文本',
        self::TYPE_RADIO => '单选按钮',
        self::TYPE_CHECKBOX => '复选框',
        self::TYPE_TEXT => '文本域',
        self::TYPE_FILE => '附件',
        self::TYPE_INT => '整数',
        self::TYPE_FLOAT => '浮点数',
        self::TYPE_SELECT => '下拉框',
        self::TYPE_EDITOR => '富文本框',
    ];

    static public function addField($form){
        $model = Models::where('id',$form['model_id'])->first();
        Schema::table($model->table_name,function (Blueprint $table) use ($form){
            switch($form['type']){
                case self::TYPE_STRING:
                    $table->string($form['en_name'])->nullable()->comment($form['zh_name']);
                break;
                case self::TYPE_RADIO:
                    $table->unsignedTinyInteger($form['en_name'])->nullable()->comment($form['zh_name']);
                break;
                case self::TYPE_CHECKBOX:
                    $table->string($form['en_name'],10)->nullable()->comment($form['zh_name']);
                break;
                case self::TYPE_TEXT:
                    $table->text($form['en_name'])->nullable()->comment($form['zh_name']);
                break;
                case self::TYPE_FILE:
                    $table->string($form['en_name'])->nullable()->comment($form['zh_name']);
                break;
                case self::TYPE_INT:
                    $table->Integer($form['en_name'])->nullable()->comment($form['zh_name']);
                break;
                case self::TYPE_FLOAT:
                    $table->decimal($form['en_name'],8,2)->nullable()->comment($form['zh_name']);
                break;
                case self::TYPE_SELECT:
                    $table->unsignedTinyInteger($form['en_name'])->nullable()->comment($form['zh_name']);
                break;
                case self::TYPE_EDITOR:
                    $table->longText($form['en_name'])->nullable()->comment($form['zh_name']);
                break;
                default:
                    $table->string($form['en_name'])->nullable()->comment($form['zh_name']);
            }
        });
    }

    static public function deleteField($table_name,$field){
        Schema::table($table_name,function (Blueprint $table) use ($field){
            $table->dropColumn($field);
        });
    }

    static public function renameField($table_name,$old_field,$new_field){
        Schema::table($table_name,function (Blueprint $table) use($old_field,$new_field){
            $table->renameColumn($old_field,$new_field);
        });
    }

    static public function changeField($form){
        $model = Models::where('id',$form['model_id'])->first();
        self::deleteField($model->table_name,$form['en_name']);
        Schema::table($model->table_name,function (Blueprint $table) use ($form){
            switch($form['type']){
                case self::TYPE_STRING:
                    $table->string($form['en_name'])->nullable()->comment($form['zh_name']);
                break;
                case self::TYPE_RADIO:
                    $table->unsignedTinyInteger($form['en_name'])->nullable()->comment($form['zh_name']);
                break;
                case self::TYPE_CHECKBOX:
                    $table->string($form['en_name'],10)->nullable()->comment($form['zh_name']);
                break;
                case self::TYPE_TEXT:
                    $table->text($form['en_name'])->nullable()->comment($form['zh_name']);
                break;
                case self::TYPE_FILE:
                    $table->string($form['en_name'])->nullable()->comment($form['zh_name']);
                break;
                case self::TYPE_INT:
                    $table->Integer($form['en_name'])->nullable()->comment($form['zh_name']);
                break;
                case self::TYPE_FLOAT:
                    $table->decimal($form['en_name'],8,2)->nullable()->comment($form['zh_name']);
                break;
                case self::TYPE_SELECT:
                    $table->unsignedTinyInteger($form['en_name'])->nullable()->comment($form['zh_name']);
                break;
                case self::TYPE_EDITOR:
                    $table->longText($form['en_name'])->nullable()->comment($form['zh_name']);
                break;
                default:
                    $table->string($form['en_name'])->nullable()->comment($form['zh_name']);
            }
        });
    }

}
