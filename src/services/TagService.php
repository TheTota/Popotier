<?php

namespace src\services;

use src\models\TagEntity;

class TagService
{

    public static function fetchAll()
    {
        $db = DataBaseService::getInstance()->getDb();

        $tags = $db->query("SELECT * FROM Tag")->fetchAll();

        $tagArray = [];

        foreach ($tags as $tag) {
            array_push($tagArray,
                new TagEntity(
                    $tag['id'],
                    $tag['nom']
                ));
        }

        return $tagArray;
    }

    public static function findById($id)
    {
        $db = DataBaseService::getInstance()->getDb();

        return $db->prepare("SELECT * FROM Tag WHERE id = ?")->execute([$id]);
    }

    public static function findByName($tagName)
    {
        $db = DataBaseService::getInstance()->getDb();

        $tag = $db->query("SELECT * FROM Tag WHERE nom = '" . $tagName . "'")->fetch();

        if ($tag) {
            return new TagEntity(
                $tag['id'],
                $tag['nom']
            );
        } else {
            return false;
        }
    }

    public static function add(TagEntity $tagEntity)
    {
        $db = DataBaseService::getInstance()->getDb();
        if ($db->prepare("INSERT INTO Tag (nom) VALUES (?);")->execute([$tagEntity->getName()])) {
            return $db->lastInsertId();
        } else {
            return false;
        }
    }

    public static function update($tagId, $value)
    {
        $db = DataBaseService::getInstance()->getDb();
        return $db->prepare("UPDATE Tag SET nom = '$value' WHERE id = '$tagId'")->execute();

    }

    public static function delete($tagId)
    {
        $db = DataBaseService::getInstance()->getDb();
        return $db->prepare("DELETE FROM Tag WHERE id = ?")->execute([$tagId]);
    }

    public static function addTagToRecipe($tagId, $recipeId)
    {
        $db = DataBaseService::getInstance()->getDb();

        return $db->prepare("INSERT INTO Tag_Recette VALUES (?, ?)")->execute([$tagId, $recipeId]);
    }

    public static function deleteByRecipe($recipeId)
    {
        $db = DataBaseService::getInstance()->getDb();

        return $db->prepare("DELETE FROM Tag_Recette WHERE id_recette = ?")->execute([$recipeId]);
    }

    public static function findByRecipe($recipeId)
    {
        $db = DataBaseService::getInstance()->getDb();

        $tags = $db->query("SELECT id, nom FROM Tag JOIN Tag_Recette ON Tag.id = Tag_Recette.id_tag WHERE id_recette = '". $recipeId ."'")->fetchAll();

        if ($tags) {
            $tagArray = [];
            foreach ($tags as $tag) {
                array_push($tagArray,
                    $tag['nom']
                );
            }
            return $tagArray;
        } else {
            return false;
        }
    }
}