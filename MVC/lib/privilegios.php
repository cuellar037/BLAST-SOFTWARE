<?php 

enum Privilegios: int {
    case User = 1;
    case Doctor = 2;
    case Admin = 4;
    public function get(): int{
        return match ($this) {
            static::User => 1,
            static::Doctor => 2,
            static::Admin => 4,
        };
    }

    public static function check($rol) {
        return ($rol & $_SESSION["privilegios"]) == $rol ? true : false;
    }
}