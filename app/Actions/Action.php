<?php

namespace App\Actions;

final class Action
{
    public static function dispatch(string $action_class, mixed ...$params): mixed
    {
        return app()->make($action_class)(...$params);
    }
}
