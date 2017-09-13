<?php
namespace App\ThuongDQ\Facades;
use App\ThuongDQ\ToolFactory;
use Illuminate\Support\Facades\Facade;

class Tool extends Facade {
    protected static function getFacadeAccessor() {
        return ToolFactory::class;
    }
}