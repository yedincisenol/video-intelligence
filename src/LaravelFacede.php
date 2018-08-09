<?php

namespace yedincisenol\VideoIntelligence;

use Illuminate\Support\Facades\Facade;

class LaravelFacede extends Facade {

    protected static function getFacadeAccessor() { return VideoIntelligence::class; }

}