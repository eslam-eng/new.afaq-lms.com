<?php

namespace App\DataLoader\Core;
use Illuminate\Support\Facades\DB;
use App\DataLoader\Core\DB as DBConfig;
class Extractor {


    public function process($table)
    {
        return collect(DB::connection(DBConfig::$SOURCE)->table($table)->get())->toArray();
    }


}