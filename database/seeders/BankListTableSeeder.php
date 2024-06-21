<?php

namespace database\seeders;

use App\Models\BankList;
use Illuminate\Database\Seeder;

class BankListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banklist = [
            [
                'name_en'           => 'Al Ahli Bank of Kuwait - Egypt (ABK)',
                'name_ar'           => '(ABK) البنك الأهلي الكويتي - مصر ',
                'status'           =>  1,
            ], [
                'name_en'           => 'Banque du Caire',
                'name_ar'           => 'بنك القاهرة',
                'status' =>1,
            ], [
                'name_en'           => 'Egyptian Arab Land Bank',
                'name_ar'           => 'البنك العقاري المصري العربي',
                'status' =>1,
            ], [
                'name_en'           => 'National Bank of Egypt',
                'name_ar'           => 'البنك الأهلي المصري',
                'status' =>1
            ], [
                'name_en'           => 'Agricultural Bank of Egypt',
                'name_ar'           => 'البنك الزراعي المصري',
                'status' =>1
            ],[
                'name_en'           => 'Bank of Alexandria',
                'name_ar'           => 'بنك الاسكندرية',
                'status' =>1
            ],[
                'name_en'           => 'MID BANK',
                'name_ar'           => 'ميد بنك',
                'status' =>1
            ],[
                'name_en'           => 'Commercial International Bank (CIB)',
                'name_ar'           => '(CIB) البنك التجاري الدولي ',
                'status' =>1
            ],[
                'name_en'           => 'Industrial Development Bank of Egypt',
                'name_ar'           => 'بنك التنمية الصناعية المصري',
                'status' =>1
            ],[
                'name_en'           => 'Société Arabe Internationale de Banque (SAIB)',
                'name_ar'           => '(SAIB) الجمعية المصرفية العربية الدولية  ',
                'status' =>1
            ],[
                'name_en'           => 'Blom Bank',
                'name_ar'           => 'بنك بلوم',
                'status' =>1
            ],[
                'name_en'           => 'Credit Agricole Egypt',
                'name_ar'           => 'بنك كريدي أجريكول مصر',
                'status' =>1
            ],[
                'name_en'           => 'Emirates NBD',
                'name_ar'           => 'بنك الإمارات دبي الوطني',
                'status' =>1
            ],[
                'name_en'           => 'Suez Canal Bank',
                'name_ar'           => 'بنك قناة السويس',
                'status' =>1
            ],[
                'name_en'           => 'Qatar National Bank Al Ahli (QNB)',
                'name_ar'           => '(QNB) بنك قطر الوطني الأهلي  ',
                'status' =>1
            ],[
                'name_en'           => 'Banque Misr',
                'name_ar'           => 'بنك مصر',
                'status' =>1
            ],[
                'name_en'           => 'Bank Audi',
                'name_ar'           => 'بنك عودة',
                'status' =>1
            ],[
                'name_en'           => 'Ahli United Bank',
                'name_ar'           => 'البنك الأهلي المتحد',
                'status' =>1
            ],[
                'name_en'           => 'Faisal Islamic Bank of Egypt',
                'name_ar'           => 'بنك فيصل الاسلامي المصري',
                'status' =>1
            ],[
                'name_en'           => 'Housing and Development Bank',
                'name_ar'           => 'بنك الاسكان والتعمير',
                'status' =>1
            ],[
                'name_en'           => 'Al Baraka Bank of Egypt',
                'name_ar'           => 'بنك البركة مصر',
                'status' =>1
            ],[
                'name_en'           => 'National Bank of Kuwait (NBK)',
                'name_ar'           => '(NBK) بنك الكويت الوطني ',
                'status' =>1
            ],[
                'name_en'           => 'Abu Dhabi Islamic Bank (ADIB)',
                'name_ar'           => '(ADIB) مصرف أبوظبي الإسلامي',
                'status' =>1
            ],[
                'name_en'           => 'Abu Dhabi Commercial Bank - Egypt',
                'name_ar'           => 'بنك أبو ظبي التجاري - مصر',
                'status' =>1
            ],[
                'name_en'           => 'Egyptian Gulf Bank (EG BANK)',
                'name_ar'           => '(EG BANK) البنك المصري الخليجي ',
                'status' =>1
            ],[
                'name_en'           => 'Arab African International Bank',
                'name_ar'           => 'البنك العربي الأفريقي الدولي',
                'status' =>1
            ],[
                'name_en'           => 'HSBC Bank Egypt',
                'name_ar'           => 'HSBC بنك ',
                'status' =>1
            ],[
                'name_en'           => 'Arab Banking Corporation (ABC)',
                'name_ar'           => '(ABC) المؤسسة العربية المصرفية ',
                'status' =>1
            ],[
                'name_en'           => 'Export Development Bank of Egypt',
                'name_ar'           => 'البنك المصري لتنمية الصادرات',
                'status' =>1
            ],[
                'name_en'           => 'The United Bank of Egypt',
                'name_ar'           => 'بنك مصر المتحد',
                'status' =>1
            ],[
                'name_en'           => 'First Abu Dhabi Bank (FAB)',
                'name_ar'           => '(FAB) بنك أبوظبي الأول ',
                'status' =>1
            ],[
                'name_en'           => 'Citi Bank',
                'name_ar'           => 'سيتي بنك',
                'status' =>1
            ],[
                'name_en'           => 'Arab Bank Plc.',
                'name_ar'           => 'البنك العربي',
                'status' =>1
            ],[
                'name_en'           => 'National Bank of Greece',
                'name_ar'           => 'البنك الوطني اليوناني',
                'status' =>1
            ],[
                'name_en'           => 'Arab International Bank',
                'name_ar'           => 'البنك العربي الدولي',
                'status' =>1
            ],[
                'name_en'           => 'Arab Investment Bank(AIBK)',
                'name_ar'           => '(AIBK) بنك الاستثمار العربي',
                'status' =>1
            ],[
                'name_en'           => 'Attijari Wafa Bank Egypt',
                'name_ar'           => 'بنك التجاري وفا مصر',
                'status' =>1
            ],[
                'name_en'           => 'Mashreq Bank ',
                'name_ar'           => 'بنك المشرق',
                'status' =>1
            ],[
                'name_en'           => 'National Investment Bank',
                'name_ar'           => 'بنك الاستثمار القومي',
                'status' =>1
            ],[
                'name_en'           => 'Nasser Social Bank',
                'name_ar'           => 'بنك ناصر الإجتماعي',
                'status' =>1
            ],
        ];

        BankList::insert($banklist);
    }
}
