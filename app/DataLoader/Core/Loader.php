<?php

namespace App\DataLoader\Core;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\DataLoader\Core\DB as DBConfig;


class Loader {

    private static $data_chunks_by = 30 ;

    public static function apply($mapped_cols , $source_table , $dist_table)
    {

        $original_data = Extractor::process($source_table);

        $dist_columns = Schema::connection(DBConfig::$DIST)->getColumnListing($dist_table);
        $mapped_data = self::getMappedData($mapped_cols , $dist_columns , $original_data);

        return self::load($mapped_data , $dist_table);

    }


    public static function getMappedData($mapped_cols , $dist_columns , $data)
    {
        $data = self::convert_to_array($data);

        $mapped_data = [];

        foreach ($data as $key => $row) {

            foreach ($mapped_cols as $source_k => $dist_k) {

                    $row[$dist_k] = $row[$source_k];
                    unset($row[$source_k]);
                }

                foreach ($row as $key => $v) {
                    if (!in_array($key , $dist_columns)) {
                        unset($row[$key]);
                    }
                }
                $mapped_data[] = $row;
        }

        return $mapped_data;

    }

    public static function load($data  ,$dist_table)
    {
        $chunks = self::chunk_data($data);
        foreach ($chunks as $key => $chunk) {
            // dd($chunk);
            if($dist_table == 'courses'){
                foreach ($chunk as $key => $value) {
                    $chunk[$key]['start_date'] = isset($value['start_date']) ? date('Y-m-d H:i:s',$value['start_date']) : null;
                    $chunk[$key]['end_date'] = isset($value['end_date']) ? date('Y-m-d H:i:s',$value['end_date']) :null;
                    $chunk[$key]['start_register_date'] = isset($value['start_register_date']) ? date('Y-m-d H:i:s',$value['start_register_date']) : null;
                    $chunk[$key]['end_register_date'] = isset($value['end_register_date']) ? date('Y-m-d H:i:s',$value['end_register_date']) : null;
                }
            }

            if($dist_table == 'bank_invoices'){
                foreach ($chunk as $key => $value) {
                    $chunk[$key]['date'] = isset($value['date']) ? date('Y-m-d H:i:s',$value['date']) : null;
                    $chunk[$key]['payment_method_id'] = 4;
                }
            }

            if($dist_table =='course_sections'){
                foreach ($chunk as $key => $value) {
                    $chunk[$key]['title_ar'] = $value['title_en'];
                }
            }
            if($dist_table =='course_section_lectures'){
                foreach ($chunk as $key => $value) {
                    $chunk[$key]['title_ar'] = $value['title_en'];
                }
            }

            $inserted = DB::connection(DBConfig::$DIST)->table($dist_table)->insert($chunk);
        }

        return "DONE :)" ;
    }



    public static function chunk_data($data)
    {
        $data = json_decode(json_encode($data), true);
        return array_chunk($data , self::$data_chunks_by);
    }


    public static function convert_to_array($data)
    {
        return json_decode(json_encode($data), true);

    }
}
