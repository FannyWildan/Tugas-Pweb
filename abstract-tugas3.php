<?php

abstract class AbstractModel
{
    abstract static function select(); // SHOW ALL
    abstract static function insert($data); // SHOW SPECIFIC
    abstract static function delete(); // ADD DATA FORM
    abstract static function joinRoles($data); // SAVE DATA
    abstract static function fresh(); // EDIT SPECIFIC
    abstract static function selectById($data); // UPDATE DATA
    abstract static function selectWhere($clause);
    abstract static function updateById($data);
    abstract static function updateWhere($clause);
    abstract static function deleteById($data);
    abstract static function deleteWhere($clause);
    abstract static function getRoles($id);
}
