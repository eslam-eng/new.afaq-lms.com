<?php

namespace App\Http\Controllers\Actions\Migration;

use Illuminate\Support\Facades\DB;

class MigrateOldData
{
    public function migration($table)
    {
        $old_data =  array_map(function ($value) {
            return (array)$value;
        }, self::getOldTableData($table));

        return $old_data;
    }

    protected function getOldTableData($table)
    {
        return DB::connection('afaq_source')->table($table)->get()->toArray();
    }
}
