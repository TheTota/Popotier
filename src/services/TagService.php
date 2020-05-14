<?php

namespace src\services;

use src\models\TagEntity;

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

    public static function update($tagId, $value){
        $db = DataBaseService::getInstance()->getDb();
        return $db->prepare("UPDATE Tag SET nom = '$value' WHERE id = '$tagId'")->execute();

    }

    public static function delete($tagId){
        $db = DataBaseService::getInstance()->getDb();
        return $db->prepare("DELETE FROM Tag WHERE id = ?")->execute([$tagId]);
    }
}