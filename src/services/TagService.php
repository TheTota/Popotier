<?php

namespace Src\Services;

use Src\Models\TagEntity;

class TagService{

    public static function fetchAll(){
        $db = DataBaseService::getInstance()->getDb();

        $tags = $db->query("SELECT * FROM Tag")->fetchAll();

        $tagArray = [];

        foreach ($tags as $tag){
            array_push($tagArray,
            new TagEntity(
                $tag['id'],
                $tag['nom']
            ));
        }

        return $tagArray;
    }

    public function findById($id){

    }

    public static function add(TagEntity $tagEntity){
        $db = DataBaseService::getInstance()->getDb();
        return $db->prepare("INSERT INTO Tag (nom) VALUES (?);")->execute([$tagEntity->getName()]);
    }

    public function update(TagEntity $tag){

    }

    public static function delete($tagId){
        $db = DataBaseService::getInstance()->getDb();
        return $db->prepare("DELETE FROM Tag WHERE id = ?")->execute([$tagId]);
    }
}