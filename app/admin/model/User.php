<?php


namespace app\admin\model;


class User extends Base
{

    public static function __make(Query $query)
    {
        return (new self())->setQuery($query);
    }

    public function getUser()
    {
        return self::select();
    }
}