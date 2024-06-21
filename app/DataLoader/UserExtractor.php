<?php

namespace App\DataLoader; 
use App\DataLoader\Interfaces\Extractor;

class UserExtractor implements Extractor {

    public $mapped_cols = [
        'username'=>'user_name',
        'country'=>'birth_country',
        'ID_type' =>'identity_type',
        'ID_number' =>'identity_number',
        'fullname' =>'full_name_ar',
        'fullname' =>'full_name_en',
    ];

    public $source_table = 'users';
    public $dist_table = 'user';
    
}


?>