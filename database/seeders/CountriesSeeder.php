<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "parent_id" => null,
                "country_code" => "AF",
                "country_enName" => "Afghanistan",
                "country_arName" => "أفغانستان",
                "country_enNationality" => "Afghan",
                "country_arNationality" => "أفغانستاني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "AL",
                "country_enName" => "Albania",
                "country_arName" => "ألبانيا",
                "country_enNationality" => "Albanian",
                "country_arNationality" => "ألباني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "AX",
                "country_enName" => "Aland Islands",
                "country_arName" => "جزر آلاند",
                "country_enNationality" => "Aland Islander",
                "country_arNationality" => "آلاندي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "DZ",
                "country_enName" => "Algeria",
                "country_arName" => "الجزائر",
                "country_enNationality" => "Algerian",
                "country_arNationality" => "جزائري",
                "order" => 8
            ],
            [
                "parent_id" => null,
                "country_code" => "AS",
                "country_enName" => "American Samoa",
                "country_arName" => "ساموا-الأمريكي",
                "country_enNationality" => "American Samoan",
                "country_arNationality" => "أمريكي سامواني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "AD",
                "country_enName" => "Andorra",
                "country_arName" => "أندورا",
                "country_enNationality" => "Andorran",
                "country_arNationality" => "أندوري",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "AO",
                "country_enName" => "Angola",
                "country_arName" => "أنغولا",
                "country_enNationality" => "Angolan",
                "country_arNationality" => "أنقولي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "AI",
                "country_enName" => "Anguilla",
                "country_arName" => "أنغويلا",
                "country_enNationality" => "Anguillan",
                "country_arNationality" => "أنغويلي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "AQ",
                "country_enName" => "Antarctica",
                "country_arName" => "أنتاركتيكا",
                "country_enNationality" => "Antarctican",
                "country_arNationality" => "أنتاركتيكي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "AG",
                "country_enName" => "Antigua and Barbuda",
                "country_arName" => "أنتيغوا وبربودا",
                "country_enNationality" => "Antiguan",
                "country_arNationality" => "بربودي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "AR",
                "country_enName" => "Argentina",
                "country_arName" => "الأرجنتين",
                "country_enNationality" => "Argentinian",
                "country_arNationality" => "أرجنتيني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "AM",
                "country_enName" => "Armenia",
                "country_arName" => "أرمينيا",
                "country_enNationality" => "Armenian",
                "country_arNationality" => "أرميني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "AW",
                "country_enName" => "Aruba",
                "country_arName" => "أروبه",
                "country_enNationality" => "Aruban",
                "country_arNationality" => "أوروبهيني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "AU",
                "country_enName" => "Australia",
                "country_arName" => "أستراليا",
                "country_enNationality" => "Australian",
                "country_arNationality" => "أسترالي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "AT",
                "country_enName" => "Austria",
                "country_arName" => "النمسا",
                "country_enNationality" => "Austrian",
                "country_arNationality" => "نمساوي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "AZ",
                "country_enName" => "Azerbaijan",
                "country_arName" => "أذربيجان",
                "country_enNationality" => "Azerbaijani",
                "country_arNationality" => "أذربيجاني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "BS",
                "country_enName" => "Bahamas",
                "country_arName" => "الباهاماس",
                "country_enNationality" => "Bahamian",
                "country_arNationality" => "باهاميسي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "BH",
                "country_enName" => "Bahrain",
                "country_arName" => "البحرين",
                "country_enNationality" => "Bahraini",
                "country_arNationality" => "بحريني",
                "order" => 5
            ],
            [
                "parent_id" => null,
                "country_code" => "BD",
                "country_enName" => "Bangladesh",
                "country_arName" => "بنغلاديش",
                "country_enNationality" => "Bangladeshi",
                "country_arNationality" => "بنغلاديشي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "BB",
                "country_enName" => "Barbados",
                "country_arName" => "بربادوس",
                "country_enNationality" => "Barbadian",
                "country_arNationality" => "بربادوسي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "BY",
                "country_enName" => "Belarus",
                "country_arName" => "روسيا البيضاء",
                "country_enNationality" => "Belarusian",
                "country_arNationality" => "روسي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "BE",
                "country_enName" => "Belgium",
                "country_arName" => "بلجيكا",
                "country_enNationality" => "Belgian",
                "country_arNationality" => "بلجيكي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "BZ",
                "country_enName" => "Belize",
                "country_arName" => "بيليز",
                "country_enNationality" => "Belizean",
                "country_arNationality" => "بيليزي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "BJ",
                "country_enName" => "Benin",
                "country_arName" => "بنين",
                "country_enNationality" => "Beninese",
                "country_arNationality" => "بنيني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "BL",
                "country_enName" => "Saint Barthelemy",
                "country_arName" => "سان بارتيلمي",
                "country_enNationality" => "Saint Barthelmian",
                "country_arNationality" => "سان بارتيلمي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "BM",
                "country_enName" => "Bermuda",
                "country_arName" => "جزر برمودا",
                "country_enNationality" => "Bermudan",
                "country_arNationality" => "برمودي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "BT",
                "country_enName" => "Bhutan",
                "country_arName" => "بوتان",
                "country_enNationality" => "Bhutanese",
                "country_arNationality" => "بوتاني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "BO",
                "country_enName" => "Bolivia",
                "country_arName" => "بوليفيا",
                "country_enNationality" => "Bolivian",
                "country_arNationality" => "بوليفي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "BA",
                "country_enName" => "Bosnia and Herzegovina",
                "country_arName" => "البوسنة و الهرسك",
                "country_enNationality" => "Bosnian / Herzegovinian",
                "country_arNationality" => "بوسني/هرسكي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "BW",
                "country_enName" => "Botswana",
                "country_arName" => "بوتسوانا",
                "country_enNationality" => "Botswanan",
                "country_arNationality" => "بوتسواني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "BV",
                "country_enName" => "Bouvet Island",
                "country_arName" => "جزيرة بوفيه",
                "country_enNationality" => "Bouvetian",
                "country_arNationality" => "بوفيهي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "BR",
                "country_enName" => "Brazil",
                "country_arName" => "البرازيل",
                "country_enNationality" => "Brazilian",
                "country_arNationality" => "برازيلي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "IO",
                "country_enName" => "British Indian Ocean Territory",
                "country_arName" => "إقليم المحيط الهندي البريطاني",
                "country_enNationality" => "British Indian Ocean Territory",
                "country_arNationality" => "إقليم المحيط الهندي البريطاني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "BN",
                "country_enName" => "Brunei Darussalam",
                "country_arName" => "بروني",
                "country_enNationality" => "Bruneian",
                "country_arNationality" => "بروني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "BG",
                "country_enName" => "Bulgaria",
                "country_arName" => "بلغاريا",
                "country_enNationality" => "Bulgarian",
                "country_arNationality" => "بلغاري",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "BF",
                "country_enName" => "Burkina Faso",
                "country_arName" => "بوركينا فاسو",
                "country_enNationality" => "Burkinabe",
                "country_arNationality" => "بوركيني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "BI",
                "country_enName" => "Burundi",
                "country_arName" => "بوروندي",
                "country_enNationality" => "Burundian",
                "country_arNationality" => "بورونيدي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "KH",
                "country_enName" => "Cambodia",
                "country_arName" => "كمبوديا",
                "country_enNationality" => "Cambodian",
                "country_arNationality" => "كمبودي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "CM",
                "country_enName" => "Cameroon",
                "country_arName" => "كاميرون",
                "country_enNationality" => "Cameroonian",
                "country_arNationality" => "كاميروني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "CA",
                "country_enName" => "Canada",
                "country_arName" => "كندا",
                "country_enNationality" => "Canadian",
                "country_arNationality" => "كندي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "CV",
                "country_enName" => "Cape Verde",
                "country_arName" => "الرأس الأخضر",
                "country_enNationality" => "Cape Verdean",
                "country_arNationality" => "الرأس الأخضر",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "KY",
                "country_enName" => "Cayman Islands",
                "country_arName" => "جزر كايمان",
                "country_enNationality" => "Caymanian",
                "country_arNationality" => "كايماني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "CF",
                "country_enName" => "Central African Republic",
                "country_arName" => "جمهورية أفريقيا الوسطى",
                "country_enNationality" => "Central African",
                "country_arNationality" => "أفريقي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "TD",
                "country_enName" => "Chad",
                "country_arName" => "تشاد",
                "country_enNationality" => "Chadian",
                "country_arNationality" => "تشادي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "CL",
                "country_enName" => "Chile",
                "country_arName" => "شيلي",
                "country_enNationality" => "Chilean",
                "country_arNationality" => "شيلي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "CN",
                "country_enName" => "China",
                "country_arName" => "الصين",
                "country_enNationality" => "Chinese",
                "country_arNationality" => "صيني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "CX",
                "country_enName" => "Christmas Island",
                "country_arName" => "جزيرة عيد الميلاد",
                "country_enNationality" => "Christmas Islander",
                "country_arNationality" => "جزيرة عيد الميلاد",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "CC",
                "country_enName" => "Cocos (Keeling) Islands",
                "country_arName" => "جزر كوكوس",
                "country_enNationality" => "Cocos Islander",
                "country_arNationality" => "جزر كوكوس",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "CO",
                "country_enName" => "Colombia",
                "country_arName" => "كولومبيا",
                "country_enNationality" => "Colombian",
                "country_arNationality" => "كولومبي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "KM",
                "country_enName" => "Comoros",
                "country_arName" => "جزر القمر",
                "country_enNationality" => "Comorian",
                "country_arNationality" => "جزر القمر",
                "order" => 16
            ],
            [
                "parent_id" => null,
                "country_code" => "CG",
                "country_enName" => "Congo",
                "country_arName" => "الكونغو",
                "country_enNationality" => "Congolese",
                "country_arNationality" => "كونغي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "CK",
                "country_enName" => "Cook Islands",
                "country_arName" => "جزر كوك",
                "country_enNationality" => "Cook Islander",
                "country_arNationality" => "جزر كوك",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "CR",
                "country_enName" => "Costa Rica",
                "country_arName" => "كوستاريكا",
                "country_enNationality" => "Costa Rican",
                "country_arNationality" => "كوستاريكي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "HR",
                "country_enName" => "Croatia",
                "country_arName" => "كرواتيا",
                "country_enNationality" => "Croatian",
                "country_arNationality" => "كوراتي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "CU",
                "country_enName" => "Cuba",
                "country_arName" => "كوبا",
                "country_enNationality" => "Cuban",
                "country_arNationality" => "كوبي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "CY",
                "country_enName" => "Cyprus",
                "country_arName" => "قبرص",
                "country_enNationality" => "Cypriot",
                "country_arNationality" => "قبرصي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "CW",
                "country_enName" => "Curaçao",
                "country_arName" => "كوراساو",
                "country_enNationality" => "Curacian",
                "country_arNationality" => "كوراساوي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "CZ",
                "country_enName" => "Czech Republic",
                "country_arName" => "الجمهورية التشيكية",
                "country_enNationality" => "Czech",
                "country_arNationality" => "تشيكي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "DK",
                "country_enName" => "Denmark",
                "country_arName" => "الدانمارك",
                "country_enNationality" => "Danish",
                "country_arNationality" => "دنماركي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "DJ",
                "country_enName" => "Djibouti",
                "country_arName" => "جيبوتي",
                "country_enNationality" => "Djiboutian",
                "country_arNationality" => "جيبوتي",
                "order" => 17
            ],
            [
                "parent_id" => null,
                "country_code" => "DM",
                "country_enName" => "Dominica",
                "country_arName" => "دومينيكا",
                "country_enNationality" => "Dominican",
                "country_arNationality" => "دومينيكي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "DO",
                "country_enName" => "Dominican Republic",
                "country_arName" => "الجمهورية الدومينيكية",
                "country_enNationality" => "Dominican",
                "country_arNationality" => "دومينيكي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "EC",
                "country_enName" => "Ecuador",
                "country_arName" => "إكوادور",
                "country_enNationality" => "Ecuadorian",
                "country_arNationality" => "إكوادوري",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "EG",
                "country_enName" => "Egypt",
                "country_arName" => "مصر",
                "country_enNationality" => "Egyptian",
                "country_arNationality" => "مصري",
                "order" => 22
            ],
            [
                "parent_id" => null,
                "country_code" => "SV",
                "country_enName" => "El Salvador",
                "country_arName" => "إلسلفادور",
                "country_enNationality" => "Salvadoran",
                "country_arNationality" => "سلفادوري",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "GQ",
                "country_enName" => "Equatorial Guinea",
                "country_arName" => "غينيا الاستوائي",
                "country_enNationality" => "Equatorial Guinean",
                "country_arNationality" => "غيني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "ER",
                "country_enName" => "Eritrea",
                "country_arName" => "إريتريا",
                "country_enNationality" => "Eritrean",
                "country_arNationality" => "إريتيري",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "EE",
                "country_enName" => "Estonia",
                "country_arName" => "استونيا",
                "country_enNationality" => "Estonian",
                "country_arNationality" => "استوني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "ET",
                "country_enName" => "Ethiopia",
                "country_arName" => "أثيوبيا",
                "country_enNationality" => "Ethiopian",
                "country_arNationality" => "أثيوبي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "FK",
                "country_enName" => "Falkland Islands (Malvinas)",
                "country_arName" => "جزر فوكلاند",
                "country_enNationality" => "Falkland Islander",
                "country_arNationality" => "فوكلاندي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "FO",
                "country_enName" => "Faroe Islands",
                "country_arName" => "جزر فارو",
                "country_enNationality" => "Faroese",
                "country_arNationality" => "جزر فارو",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "FJ",
                "country_enName" => "Fiji",
                "country_arName" => "فيجي",
                "country_enNationality" => "Fijian",
                "country_arNationality" => "فيجي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "FI",
                "country_enName" => "Finland",
                "country_arName" => "فنلندا",
                "country_enNationality" => "Finnish",
                "country_arNationality" => "فنلندي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "FR",
                "country_enName" => "France",
                "country_arName" => "فرنسا",
                "country_enNationality" => "French",
                "country_arNationality" => "فرنسي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "GF",
                "country_enName" => "French Guiana",
                "country_arName" => "غويانا الفرنسية",
                "country_enNationality" => "French Guianese",
                "country_arNationality" => "غويانا الفرنسية",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "PF",
                "country_enName" => "French Polynesia",
                "country_arName" => "بولينيزيا الفرنسية",
                "country_enNationality" => "French Polynesian",
                "country_arNationality" => "بولينيزيي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "TF",
                "country_enName" => "French Southern and Antarctic Lands",
                "country_arName" => "أراض فرنسية جنوبية وأنتارتيكية",
                "country_enNationality" => "French",
                "country_arNationality" => "أراض فرنسية جنوبية وأنتارتيكية",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "GA",
                "country_enName" => "Gabon",
                "country_arName" => "الغابون",
                "country_enNationality" => "Gabonese",
                "country_arNationality" => "غابوني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "GM",
                "country_enName" => "Gambia",
                "country_arName" => "غامبيا",
                "country_enNationality" => "Gambian",
                "country_arNationality" => "غامبي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "GE",
                "country_enName" => "Georgia",
                "country_arName" => "جيورجيا",
                "country_enNationality" => "Georgian",
                "country_arNationality" => "جيورجي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "DE",
                "country_enName" => "Germany",
                "country_arName" => "ألمانيا",
                "country_enNationality" => "German",
                "country_arNationality" => "ألماني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "GH",
                "country_enName" => "Ghana",
                "country_arName" => "غانا",
                "country_enNationality" => "Ghanaian",
                "country_arNationality" => "غاني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "GI",
                "country_enName" => "Gibraltar",
                "country_arName" => "جبل طارق",
                "country_enNationality" => "Gibraltar",
                "country_arNationality" => "جبل طارق",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "GG",
                "country_enName" => "Guernsey",
                "country_arName" => "غيرنزي",
                "country_enNationality" => "Guernsian",
                "country_arNationality" => "غيرنزي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "GR",
                "country_enName" => "Greece",
                "country_arName" => "اليونان",
                "country_enNationality" => "Greek",
                "country_arNationality" => "يوناني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "GL",
                "country_enName" => "Greenland",
                "country_arName" => "جرينلاند",
                "country_enNationality" => "Greenlandic",
                "country_arNationality" => "جرينلاندي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "GD",
                "country_enName" => "Grenada",
                "country_arName" => "غرينادا",
                "country_enNationality" => "Grenadian",
                "country_arNationality" => "غرينادي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "GP",
                "country_enName" => "Guadeloupe",
                "country_arName" => "جزر جوادلوب",
                "country_enNationality" => "Guadeloupe",
                "country_arNationality" => "جزر جوادلوب",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "GU",
                "country_enName" => "Guam",
                "country_arName" => "جوام",
                "country_enNationality" => "Guamanian",
                "country_arNationality" => "جوامي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "GT",
                "country_enName" => "Guatemala",
                "country_arName" => "غواتيمال",
                "country_enNationality" => "Guatemalan",
                "country_arNationality" => "غواتيمالي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "GN",
                "country_enName" => "Guinea",
                "country_arName" => "غينيا",
                "country_enNationality" => "Guinean",
                "country_arNationality" => "غيني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "GW",
                "country_enName" => "Guinea-Bissau",
                "country_arName" => "غينيا-بيساو",
                "country_enNationality" => "Guinea-Bissauan",
                "country_arNationality" => "غيني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "GY",
                "country_enName" => "Guyana",
                "country_arName" => "غيانا",
                "country_enNationality" => "Guyanese",
                "country_arNationality" => "غياني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "HT",
                "country_enName" => "Haiti",
                "country_arName" => "هايتي",
                "country_enNationality" => "Haitian",
                "country_arNationality" => "هايتي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "HM",
                "country_enName" => "Heard and Mc Donald Islands",
                "country_arName" => "جزيرة هيرد وجزر ماكدونالد",
                "country_enNationality" => "Heard and Mc Donald Islanders",
                "country_arNationality" => "جزيرة هيرد وجزر ماكدونالد",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "HN",
                "country_enName" => "Honduras",
                "country_arName" => "هندوراس",
                "country_enNationality" => "Honduran",
                "country_arNationality" => "هندوراسي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "HK",
                "country_enName" => "Hong Kong",
                "country_arName" => "هونغ كونغ",
                "country_enNationality" => "Hongkongese",
                "country_arNationality" => "هونغ كونغي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "HU",
                "country_enName" => "Hungary",
                "country_arName" => "المجر",
                "country_enNationality" => "Hungarian",
                "country_arNationality" => "مجري",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "IS",
                "country_enName" => "Iceland",
                "country_arName" => "آيسلندا",
                "country_enNationality" => "Icelandic",
                "country_arNationality" => "آيسلندي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "IN",
                "country_enName" => "India",
                "country_arName" => "الهند",
                "country_enNationality" => "Indian",
                "country_arNationality" => "هندي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "IM",
                "country_enName" => "Isle of Man",
                "country_arName" => "جزيرة مان",
                "country_enNationality" => "Manx",
                "country_arNationality" => "ماني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "ID",
                "country_enName" => "Indonesia",
                "country_arName" => "أندونيسيا",
                "country_enNationality" => "Indonesian",
                "country_arNationality" => "أندونيسيي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "IR",
                "country_enName" => "Iran",
                "country_arName" => "إيران",
                "country_enNationality" => "Iranian",
                "country_arNationality" => "إيراني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "IQ",
                "country_enName" => "Iraq",
                "country_arName" => "العراق",
                "country_enNationality" => "Iraqi",
                "country_arNationality" => "عراقي",
                "order" => 12
            ],
            [
                "parent_id" => null,
                "country_code" => "IE",
                "country_enName" => "Ireland",
                "country_arName" => "إيرلندا",
                "country_enNationality" => "Irish",
                "country_arNationality" => "إيرلندي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "IL",
                "country_enName" => "Israel",
                "country_arName" => "إسرائيل",
                "country_enNationality" => "Israeli",
                "country_arNationality" => "إسرائيلي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "IT",
                "country_enName" => "Italy",
                "country_arName" => "إيطاليا",
                "country_enNationality" => "Italian",
                "country_arNationality" => "إيطالي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "CI",
                "country_enName" => "Ivory Coast",
                "country_arName" => "ساحل العاج",
                "country_enNationality" => "Ivory Coastian",
                "country_arNationality" => "ساحل العاج",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "JE",
                "country_enName" => "Jersey",
                "country_arName" => "جيرزي",
                "country_enNationality" => "Jersian",
                "country_arNationality" => "جيرزي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "JM",
                "country_enName" => "Jamaica",
                "country_arName" => "جمايكا",
                "country_enNationality" => "Jamaican",
                "country_arNationality" => "جمايكي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "JP",
                "country_enName" => "Japan",
                "country_arName" => "اليابان",
                "country_enNationality" => "Japanese",
                "country_arNationality" => "ياباني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "JO",
                "country_enName" => "Jordan",
                "country_arName" => "الأردن",
                "country_enNationality" => "Jordanian",
                "country_arNationality" => "أردني",
                "order" => 7
            ],
            [
                "parent_id" => null,
                "country_code" => "KZ",
                "country_enName" => "Kazakhstan",
                "country_arName" => "كازاخستان",
                "country_enNationality" => "Kazakh",
                "country_arNationality" => "كازاخستاني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "KE",
                "country_enName" => "Kenya",
                "country_arName" => "كينيا",
                "country_enNationality" => "Kenyan",
                "country_arNationality" => "كيني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "KI",
                "country_enName" => "Kiribati",
                "country_arName" => "كيريباتي",
                "country_enNationality" => "I-Kiribati",
                "country_arNationality" => "كيريباتي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "KP",
                "country_enName" => "Korea(North Korea)",
                "country_arName" => "كوريا الشمالية",
                "country_enNationality" => "North Korean",
                "country_arNationality" => "كوري",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "KR",
                "country_enName" => "Korea(South Korea)",
                "country_arName" => "كوريا الجنوبية",
                "country_enNationality" => "South Korean",
                "country_arNationality" => "كوري",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "XK",
                "country_enName" => "Kosovo",
                "country_arName" => "كوسوفو",
                "country_enNationality" => "Kosovar",
                "country_arNationality" => "كوسيفي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "KW",
                "country_enName" => "Kuwait",
                "country_arName" => "الكويت",
                "country_enNationality" => "Kuwaiti",
                "country_arNationality" => "كويتي",
                "order" => 3
            ],
            [
                "parent_id" => null,
                "country_code" => "KG",
                "country_enName" => "Kyrgyzstan",
                "country_arName" => "قيرغيزستان",
                "country_enNationality" => "Kyrgyzstani",
                "country_arNationality" => "قيرغيزستاني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "LA",
                "country_enName" => "Lao PDR",
                "country_arName" => "لاوس",
                "country_enNationality" => "Laotian",
                "country_arNationality" => "لاوسي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "LV",
                "country_enName" => "Latvia",
                "country_arName" => "لاتفيا",
                "country_enNationality" => "Latvian",
                "country_arNationality" => "لاتيفي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "LB",
                "country_enName" => "Lebanon",
                "country_arName" => "لبنان",
                "country_enNationality" => "Lebanese",
                "country_arNationality" => "لبناني",
                "order" => 20
            ],
            [
                "parent_id" => null,
                "country_code" => "LS",
                "country_enName" => "Lesotho",
                "country_arName" => "ليسوتو",
                "country_enNationality" => "Basotho",
                "country_arNationality" => "ليوسيتي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "LR",
                "country_enName" => "Liberia",
                "country_arName" => "ليبيريا",
                "country_enNationality" => "Liberian",
                "country_arNationality" => "ليبيري",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "LY",
                "country_enName" => "Libya",
                "country_arName" => "ليبيا",
                "country_enNationality" => "Libyan",
                "country_arNationality" => "ليبي",
                "order" => 21
            ],
            [
                "parent_id" => null,
                "country_code" => "LI",
                "country_enName" => "Liechtenstein",
                "country_arName" => "ليختنشتين",
                "country_enNationality" => "Liechtenstein",
                "country_arNationality" => "ليختنشتيني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "LT",
                "country_enName" => "Lithuania",
                "country_arName" => "لتوانيا",
                "country_enNationality" => "Lithuanian",
                "country_arNationality" => "لتوانيي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "LU",
                "country_enName" => "Luxembourg",
                "country_arName" => "لوكسمبورغ",
                "country_enNationality" => "Luxembourger",
                "country_arNationality" => "لوكسمبورغي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "LK",
                "country_enName" => "Sri Lanka",
                "country_arName" => "سريلانكا",
                "country_enNationality" => "Sri Lankian",
                "country_arNationality" => "سريلانكي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "MO",
                "country_enName" => "Macau",
                "country_arName" => "ماكاو",
                "country_enNationality" => "Macanese",
                "country_arNationality" => "ماكاوي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "MK",
                "country_enName" => "Macedonia",
                "country_arName" => "مقدونيا",
                "country_enNationality" => "Macedonian",
                "country_arNationality" => "مقدوني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "MG",
                "country_enName" => "Madagascar",
                "country_arName" => "مدغشقر",
                "country_enNationality" => "Malagasy",
                "country_arNationality" => "مدغشقري",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "MW",
                "country_enName" => "Malawi",
                "country_arName" => "مالاوي",
                "country_enNationality" => "Malawian",
                "country_arNationality" => "مالاوي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "MY",
                "country_enName" => "Malaysia",
                "country_arName" => "ماليزيا",
                "country_enNationality" => "Malaysian",
                "country_arNationality" => "ماليزي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "MV",
                "country_enName" => "Maldives",
                "country_arName" => "المالديف",
                "country_enNationality" => "Maldivian",
                "country_arNationality" => "مالديفي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "ML",
                "country_enName" => "Mali",
                "country_arName" => "مالي",
                "country_enNationality" => "Malian",
                "country_arNationality" => "مالي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "MT",
                "country_enName" => "Malta",
                "country_arName" => "مالطا",
                "country_enNationality" => "Maltese",
                "country_arNationality" => "مالطي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "MH",
                "country_enName" => "Marshall Islands",
                "country_arName" => "جزر مارشال",
                "country_enNationality" => "Marshallese",
                "country_arNationality" => "مارشالي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "MQ",
                "country_enName" => "Martinique",
                "country_arName" => "مارتينيك",
                "country_enNationality" => "Martiniquais",
                "country_arNationality" => "مارتينيكي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "MR",
                "country_enName" => "Mauritania",
                "country_arName" => "موريتانيا",
                "country_enNationality" => "Mauritanian",
                "country_arNationality" => "موريتانيي",
                "order" => 23
            ],
            [
                "parent_id" => null,
                "country_code" => "MU",
                "country_enName" => "Mauritius",
                "country_arName" => "موريشيوس",
                "country_enNationality" => "Mauritian",
                "country_arNationality" => "موريشيوسي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "YT",
                "country_enName" => "Mayotte",
                "country_arName" => "مايوت",
                "country_enNationality" => "Mahoran",
                "country_arNationality" => "مايوتي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "MX",
                "country_enName" => "Mexico",
                "country_arName" => "المكسيك",
                "country_enNationality" => "Mexican",
                "country_arNationality" => "مكسيكي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "FM",
                "country_enName" => "Micronesia",
                "country_arName" => "مايكرونيزيا",
                "country_enNationality" => "Micronesian",
                "country_arNationality" => "مايكرونيزيي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "MD",
                "country_enName" => "Moldova",
                "country_arName" => "مولدافيا",
                "country_enNationality" => "Moldovan",
                "country_arNationality" => "مولديفي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "MC",
                "country_enName" => "Monaco",
                "country_arName" => "موناكو",
                "country_enNationality" => "Monacan",
                "country_arNationality" => "مونيكي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "MN",
                "country_enName" => "Mongolia",
                "country_arName" => "منغوليا",
                "country_enNationality" => "Mongolian",
                "country_arNationality" => "منغولي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "ME",
                "country_enName" => "Montenegro",
                "country_arName" => "الجبل الأسود",
                "country_enNationality" => "Montenegrin",
                "country_arNationality" => "الجبل الأسود",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "MS",
                "country_enName" => "Montserrat",
                "country_arName" => "مونتسيرات",
                "country_enNationality" => "Montserratian",
                "country_arNationality" => "مونتسيراتي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "MA",
                "country_enName" => "Morocco",
                "country_arName" => "المغرب",
                "country_enNationality" => "Moroccan",
                "country_arNationality" => "مغربي",
                "order" => 13
            ],
            [
                "parent_id" => null,
                "country_code" => "MZ",
                "country_enName" => "Mozambique",
                "country_arName" => "موزمبيق",
                "country_enNationality" => "Mozambican",
                "country_arNationality" => "موزمبيقي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "MM",
                "country_enName" => "Myanmar",
                "country_arName" => "ميانمار",
                "country_enNationality" => "Myanmarian",
                "country_arNationality" => "ميانماري",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "NA",
                "country_enName" => "Namibia",
                "country_arName" => "ناميبيا",
                "country_enNationality" => "Namibian",
                "country_arNationality" => "ناميبي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "NR",
                "country_enName" => "Nauru",
                "country_arName" => "نورو",
                "country_enNationality" => "Nauruan",
                "country_arNationality" => "نوري",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "NP",
                "country_enName" => "Nepal",
                "country_arName" => "نيبال",
                "country_enNationality" => "Nepalese",
                "country_arNationality" => "نيبالي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "NL",
                "country_enName" => "Netherlands",
                "country_arName" => "هولندا",
                "country_enNationality" => "Dutch",
                "country_arNationality" => "هولندي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "AN",
                "country_enName" => "Netherlands Antilles",
                "country_arName" => "جزر الأنتيل الهولندي",
                "country_enNationality" => "Dutch Antilier",
                "country_arNationality" => "هولندي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "NC",
                "country_enName" => "New Caledonia",
                "country_arName" => "كاليدونيا الجديدة",
                "country_enNationality" => "New Caledonian",
                "country_arNationality" => "كاليدوني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "NZ",
                "country_enName" => "New Zealand",
                "country_arName" => "نيوزيلندا",
                "country_enNationality" => "New Zealander",
                "country_arNationality" => "نيوزيلندي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "NI",
                "country_enName" => "Nicaragua",
                "country_arName" => "نيكاراجوا",
                "country_enNationality" => "Nicaraguan",
                "country_arNationality" => "نيكاراجوي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "NE",
                "country_enName" => "Niger",
                "country_arName" => "النيجر",
                "country_enNationality" => "Nigerien",
                "country_arNationality" => "نيجيري",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "NG",
                "country_enName" => "Nigeria",
                "country_arName" => "نيجيريا",
                "country_enNationality" => "Nigerian",
                "country_arNationality" => "نيجيري",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "NU",
                "country_enName" => "Niue",
                "country_arName" => "ني",
                "country_enNationality" => "Niuean",
                "country_arNationality" => "ني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "NF",
                "country_enName" => "Norfolk Island",
                "country_arName" => "جزيرة نورفولك",
                "country_enNationality" => "Norfolk Islander",
                "country_arNationality" => "نورفوليكي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "MP",
                "country_enName" => "Northern Mariana Islands",
                "country_arName" => "جزر ماريانا الشمالية",
                "country_enNationality" => "Northern Marianan",
                "country_arNationality" => "ماريني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "NO",
                "country_enName" => "Norway",
                "country_arName" => "النرويج",
                "country_enNationality" => "Norwegian",
                "country_arNationality" => "نرويجي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "OM",
                "country_enName" => "Oman",
                "country_arName" => "عمان",
                "country_enNationality" => "Omani",
                "country_arNationality" => "عماني",
                "order" => 4
            ],
            [
                "parent_id" => null,
                "country_code" => "PK",
                "country_enName" => "Pakistan",
                "country_arName" => "باكستان",
                "country_enNationality" => "Pakistani",
                "country_arNationality" => "باكستاني",
                "order" => 25
            ],
            [
                "parent_id" => null,
                "country_code" => "PW",
                "country_enName" => "Palau",
                "country_arName" => "بالاو",
                "country_enNationality" => "Palauan",
                "country_arNationality" => "بالاوي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "PS",
                "country_enName" => "Palestine",
                "country_arName" => "فلسطين",
                "country_enNationality" => "Palestinian",
                "country_arNationality" => "فلسطيني",
                "order" => 19
            ],
            [
                "parent_id" => null,
                "country_code" => "PA",
                "country_enName" => "Panama",
                "country_arName" => "بنما",
                "country_enNationality" => "Panamanian",
                "country_arNationality" => "بنمي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "PG",
                "country_enName" => "Papua New Guinea",
                "country_arName" => "بابوا غينيا الجديدة",
                "country_enNationality" => "Papua New Guinean",
                "country_arNationality" => "بابوي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "PY",
                "country_enName" => "Paraguay",
                "country_arName" => "باراغواي",
                "country_enNationality" => "Paraguayan",
                "country_arNationality" => "بارغاوي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "PE",
                "country_enName" => "Peru",
                "country_arName" => "بيرو",
                "country_enNationality" => "Peruvian",
                "country_arNationality" => "بيري",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "PH",
                "country_enName" => "Philippines",
                "country_arName" => "الفليبين",
                "country_enNationality" => "Filipino",
                "country_arNationality" => "فلبيني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "PN",
                "country_enName" => "Pitcairn",
                "country_arName" => "بيتكيرن",
                "country_enNationality" => "Pitcairn Islander",
                "country_arNationality" => "بيتكيرني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "PL",
                "country_enName" => "Poland",
                "country_arName" => "بولندا",
                "country_enNationality" => "Polish",
                "country_arNationality" => "بولندي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "PT",
                "country_enName" => "Portugal",
                "country_arName" => "البرتغال",
                "country_enNationality" => "Portuguese",
                "country_arNationality" => "برتغالي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "PR",
                "country_enName" => "Puerto Rico",
                "country_arName" => "بورتو ريكو",
                "country_enNationality" => "Puerto Rican",
                "country_arNationality" => "بورتي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "QA",
                "country_enName" => "Qatar",
                "country_arName" => "قطر",
                "country_enNationality" => "Qatari",
                "country_arNationality" => "قطري",
                "order" => 6
            ],
            [
                "parent_id" => null,
                "country_code" => "RE",
                "country_enName" => "Reunion Island",
                "country_arName" => "ريونيون",
                "country_enNationality" => "Reunionese",
                "country_arNationality" => "ريونيوني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "RO",
                "country_enName" => "Romania",
                "country_arName" => "رومانيا",
                "country_enNationality" => "Romanian",
                "country_arNationality" => "روماني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "RU",
                "country_enName" => "Russian",
                "country_arName" => "روسيا",
                "country_enNationality" => "Russian",
                "country_arNationality" => "روسي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "RW",
                "country_enName" => "Rwanda",
                "country_arName" => "رواندا",
                "country_enNationality" => "Rwandan",
                "country_arNationality" => "رواندا",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "KN",
                "country_enName" => "Saint Kitts and Nevis",
                "country_arName" => "سانت كيتس ونيفس,",
                "country_enNationality" => "Kittitian/Nevisian",
                "country_arNationality" => "سانت كيتس ونيفس",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "MF",
                "country_enName" => "Saint Martin (French part)",
                "country_arName" => "ساينت مارتن فرنسي",
                "country_enNationality" => "St. Martian(French)",
                "country_arNationality" => "ساينت مارتني فرنسي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "SX",
                "country_enName" => "Sint Maarten (Dutch part)",
                "country_arName" => "ساينت مارتن هولندي",
                "country_enNationality" => "St. Martian(Dutch)",
                "country_arNationality" => "ساينت مارتني هولندي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "LC",
                "country_enName" => "Saint Pierre and Miquelon",
                "country_arName" => "سان بيير وميكلون",
                "country_enNationality" => "St. Pierre and Miquelon",
                "country_arNationality" => "سان بيير وميكلوني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "VC",
                "country_enName" => "Saint Vincent and the Grenadines",
                "country_arName" => "سانت فنسنت وجزر غرينادين",
                "country_enNationality" => "Saint Vincent and the Grenadines",
                "country_arNationality" => "سانت فنسنت وجزر غرينادين",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "WS",
                "country_enName" => "Samoa",
                "country_arName" => "ساموا",
                "country_enNationality" => "Samoan",
                "country_arNationality" => "ساموي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "SM",
                "country_enName" => "San Marino",
                "country_arName" => "سان مارينو",
                "country_enNationality" => "Sammarinese",
                "country_arNationality" => "ماريني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "ST",
                "country_enName" => "Sao Tome and Principe",
                "country_arName" => "ساو تومي وبرينسيبي",
                "country_enNationality" => "Sao Tomean",
                "country_arNationality" => "ساو تومي وبرينسيبي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "SA",
                "country_enName" => "Saudi Arabia",
                "country_arName" => "المملكة العربية السعودية",
                "country_enNationality" => "Saudi Arabian",
                "country_arNationality" => "سعودي",
                "order" => 1
            ],
            [
                "parent_id" => null,
                "country_code" => "SN",
                "country_enName" => "Senegal",
                "country_arName" => "السنغال",
                "country_enNationality" => "Senegalese",
                "country_arNationality" => "سنغالي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "RS",
                "country_enName" => "Serbia",
                "country_arName" => "صربيا",
                "country_enNationality" => "Serbian",
                "country_arNationality" => "صربي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "SC",
                "country_enName" => "Seychelles",
                "country_arName" => "سيشيل",
                "country_enNationality" => "Seychellois",
                "country_arNationality" => "سيشيلي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "SL",
                "country_enName" => "Sierra Leone",
                "country_arName" => "سيراليون",
                "country_enNationality" => "Sierra Leonean",
                "country_arNationality" => "سيراليوني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "SG",
                "country_enName" => "Singapore",
                "country_arName" => "سنغافورة",
                "country_enNationality" => "Singaporean",
                "country_arNationality" => "سنغافوري",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "SK",
                "country_enName" => "Slovakia",
                "country_arName" => "سلوفاكيا",
                "country_enNationality" => "Slovak",
                "country_arNationality" => "سولفاكي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "SI",
                "country_enName" => "Slovenia",
                "country_arName" => "سلوفينيا",
                "country_enNationality" => "Slovenian",
                "country_arNationality" => "سولفيني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "SB",
                "country_enName" => "Solomon Islands",
                "country_arName" => "جزر سليمان",
                "country_enNationality" => "Solomon Island",
                "country_arNationality" => "جزر سليمان",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "SO",
                "country_enName" => "Somalia",
                "country_arName" => "الصومال",
                "country_enNationality" => "Somali",
                "country_arNationality" => "صومالي",
                "order" => 11
            ],
            [
                "parent_id" => null,
                "country_code" => "ZA",
                "country_enName" => "South Africa",
                "country_arName" => "جنوب أفريقيا",
                "country_enNationality" => "South African",
                "country_arNationality" => "أفريقي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "GS",
                "country_enName" => "South Georgia and the South Sandwich",
                "country_arName" => "المنطقة القطبية الجنوبية",
                "country_enNationality" => "South Georgia and the South Sandwich",
                "country_arNationality" => "لمنطقة القطبية الجنوبية",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "ES",
                "country_enName" => "Spain",
                "country_arName" => "إسبانيا",
                "country_enNationality" => "Spanish",
                "country_arNationality" => "إسباني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "SH",
                "country_enName" => "Saint Helena",
                "country_arName" => "سانت هيلانة",
                "country_enNationality" => "St. Helenian",
                "country_arNationality" => "هيلاني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "SD",
                "country_enName" => "Sudan",
                "country_arName" => "السودان",
                "country_enNationality" => "Sudanese",
                "country_arNationality" => "سوداني",
                "order" => 9
            ],
            [
                "parent_id" => null,
                "country_code" => "SR",
                "country_enName" => "Suriname",
                "country_arName" => "سورينام",
                "country_enNationality" => "Surinamese",
                "country_arNationality" => "سورينامي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "SJ",
                "country_enName" => "Svalbard and Jan Mayen",
                "country_arName" => "سفالبارد ويان ماين",
                "country_enNationality" => "Svalbardian/Jan Mayenian",
                "country_arNationality" => "سفالبارد ويان ماين",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "SZ",
                "country_enName" => "Swaziland",
                "country_arName" => "سوازيلند",
                "country_enNationality" => "Swazi",
                "country_arNationality" => "سوازيلندي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "SE",
                "country_enName" => "Sweden",
                "country_arName" => "السويد",
                "country_enNationality" => "Swedish",
                "country_arNationality" => "سويدي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "CH",
                "country_enName" => "Switzerland",
                "country_arName" => "سويسرا",
                "country_enNationality" => "Swiss",
                "country_arNationality" => "سويسري",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "SY",
                "country_enName" => "Syria",
                "country_arName" => "سوريا",
                "country_enNationality" => "Syrian",
                "country_arNationality" => "سوري",
                "order" => 18
            ],
            [
                "parent_id" => null,
                "country_code" => "TW",
                "country_enName" => "Taiwan",
                "country_arName" => "تايوان",
                "country_enNationality" => "Taiwanese",
                "country_arNationality" => "تايواني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "TJ",
                "country_enName" => "Tajikistan",
                "country_arName" => "طاجيكستان",
                "country_enNationality" => "Tajikistani",
                "country_arNationality" => "طاجيكستاني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "TZ",
                "country_enName" => "Tanzania",
                "country_arName" => "تنزانيا",
                "country_enNationality" => "Tanzanian",
                "country_arNationality" => "تنزانيي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "TH",
                "country_enName" => "Thailand",
                "country_arName" => "تايلندا",
                "country_enNationality" => "Thai",
                "country_arNationality" => "تايلندي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "TL",
                "country_enName" => "Timor-Leste",
                "country_arName" => "تيمور الشرقية",
                "country_enNationality" => "Timor-Lestian",
                "country_arNationality" => "تيموري",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "TG",
                "country_enName" => "Togo",
                "country_arName" => "توغو",
                "country_enNationality" => "Togolese",
                "country_arNationality" => "توغي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "TK",
                "country_enName" => "Tokelau",
                "country_arName" => "توكيلاو",
                "country_enNationality" => "Tokelaian",
                "country_arNationality" => "توكيلاوي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "TO",
                "country_enName" => "Tonga",
                "country_arName" => "تونغا",
                "country_enNationality" => "Tongan",
                "country_arNationality" => "تونغي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "TT",
                "country_enName" => "Trinidad and Tobago",
                "country_arName" => "ترينيداد وتوباغو",
                "country_enNationality" => "Trinidadian/Tobagonian",
                "country_arNationality" => "ترينيداد وتوباغو",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "TN",
                "country_enName" => "Tunisia",
                "country_arName" => "تونس",
                "country_enNationality" => "Tunisian",
                "country_arNationality" => "تونسي",
                "order" => 15
            ],
            [
                "parent_id" => null,
                "country_code" => "TR",
                "country_enName" => "Turkey",
                "country_arName" => "تركيا",
                "country_enNationality" => "Turkish",
                "country_arNationality" => "تركي",
                "order" => 24
            ],
            [
                "parent_id" => null,
                "country_code" => "TM",
                "country_enName" => "Turkmenistan",
                "country_arName" => "تركمانستان",
                "country_enNationality" => "Turkmen",
                "country_arNationality" => "تركمانستاني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "TC",
                "country_enName" => "Turks and Caicos Islands",
                "country_arName" => "جزر توركس وكايكوس",
                "country_enNationality" => "Turks and Caicos Islands",
                "country_arNationality" => "جزر توركس وكايكوس",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "TV",
                "country_enName" => "Tuvalu",
                "country_arName" => "توفالو",
                "country_enNationality" => "Tuvaluan",
                "country_arNationality" => "توفالي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "UG",
                "country_enName" => "Uganda",
                "country_arName" => "أوغندا",
                "country_enNationality" => "Ugandan",
                "country_arNationality" => "أوغندي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "UA",
                "country_enName" => "Ukraine",
                "country_arName" => "أوكرانيا",
                "country_enNationality" => "Ukrainian",
                "country_arNationality" => "أوكراني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "AE",
                "country_enName" => "United Arab Emirates",
                "country_arName" => "الإمارات العربية المتحدة",
                "country_enNationality" => "Emirati",
                "country_arNationality" => "إماراتي",
                "order" => 2
            ],
            [
                "parent_id" => null,
                "country_code" => "GB",
                "country_enName" => "United Kingdom",
                "country_arName" => "المملكة المتحدة",
                "country_enNationality" => "British",
                "country_arNationality" => "بريطاني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "US",
                "country_enName" => "United States",
                "country_arName" => "الولايات المتحدة",
                "country_enNationality" => "American",
                "country_arNationality" => "أمريكي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "UM",
                "country_enName" => "US Minor Outlying Islands",
                "country_arName" => "قائمة الولايات والمناطق الأمريكية",
                "country_enNationality" => "US Minor Outlying Islander",
                "country_arNationality" => "أمريكي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "UY",
                "country_enName" => "Uruguay",
                "country_arName" => "أورغواي",
                "country_enNationality" => "Uruguayan",
                "country_arNationality" => "أورغواي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "UZ",
                "country_enName" => "Uzbekistan",
                "country_arName" => "أوزباكستان",
                "country_enNationality" => "Uzbek",
                "country_arNationality" => "أوزباكستاني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "VU",
                "country_enName" => "Vanuatu",
                "country_arName" => "فانواتو",
                "country_enNationality" => "Vanuatuan",
                "country_arNationality" => "فانواتي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "VE",
                "country_enName" => "Venezuela",
                "country_arName" => "فنزويلا",
                "country_enNationality" => "Venezuelan",
                "country_arNationality" => "فنزويلي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "VN",
                "country_enName" => "Vietnam",
                "country_arName" => "فيتنام",
                "country_enNationality" => "Vietnamese",
                "country_arNationality" => "فيتنامي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "VI",
                "country_enName" => "Virgin Islands (U.S.)",
                "country_arName" => "الجزر العذراء الأمريكي",
                "country_enNationality" => "American Virgin Islander",
                "country_arNationality" => "أمريكي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "VA",
                "country_enName" => "Vatican City",
                "country_arName" => "فنزويلا",
                "country_enNationality" => "Vatican",
                "country_arNationality" => "فاتيكاني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "WF",
                "country_enName" => "Wallis and Futuna Islands",
                "country_arName" => "والس وفوتونا",
                "country_enNationality" => "Wallisian/Futunan",
                "country_arNationality" => "فوتوني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "EH",
                "country_enName" => "Western Sahara",
                "country_arName" => "الصحراء الغربية",
                "country_enNationality" => "Sahrawian",
                "country_arNationality" => "صحراوي",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "YE",
                "country_enName" => "Yemen",
                "country_arName" => "اليمن",
                "country_enNationality" => "Yemeni",
                "country_arNationality" => "يمني",
                "order" => 14
            ],
            [
                "parent_id" => null,
                "country_code" => "ZM",
                "country_enName" => "Zambia",
                "country_arName" => "زامبيا",
                "country_enNationality" => "Zambian",
                "country_arNationality" => "زامبياني",
                "order" => 300
            ],
            [
                "parent_id" => null,
                "country_code" => "ZW",
                "country_enName" => "Zimbabwe",
                "country_arName" => "زمبابوي",
                "country_enNationality" => "Zimbabwean",
                "country_arNationality" => "زمبابوي",
                "order" => 300
            ],

            [
                "parent_id" => "64",
                "country_enName" => "Cairo",
                "country_arName" => "Cairo",
                "country_enNationality" => "Cairo",
                "country_arNationality" => "Cairo",
                "country_code" => "cairo",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Alexandria",
                "country_arName" => "Alexandria",
                "country_enNationality" => "Alexandria",
                "country_arNationality" => "Alexandria",
                "country_code" => "alexandria",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Asyut",
                "country_arName" => "Asyut",
                "country_enNationality" => "Asyut",
                "country_arNationality" => "Asyut",
                "country_code" => "asyut",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Aswan",
                "country_arName" => "Aswan",
                "country_enNationality" => "Aswan",
                "country_arNationality" => "Aswan",
                "country_code" => "aswan",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Dahab",
                "country_arName" => "Dahab",
                "country_enNationality" => "Dahab",
                "country_arNationality" => "Dahab",
                "country_code" => "dahab",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Damietta",
                "country_arName" => "Damietta",
                "country_enNationality" => "Damietta",
                "country_arNationality" => "Damietta",
                "country_code" => "damietta",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Ein-Sokhna",
                "country_arName" => "Ein-Sokhna",
                "country_enNationality" => "Ein-Sokhna",
                "country_arNationality" => "Ein-Sokhna",
                "country_code" => "ein-sokhna",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Hurghada",
                "country_arName" => "Hurghada",
                "country_enNationality" => "Hurghada",
                "country_arNationality" => "Hurghada",
                "country_code" => "hurghada",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Luxor",
                "country_arName" => "Luxor",
                "country_enNationality" => "Luxor",
                "country_arNationality" => "Luxor",
                "country_code" => "luxor",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Marsa Alam",
                "country_arName" => "Marsa Alam",
                "country_enNationality" => "Marsa Alam",
                "country_arNationality" => "Marsa Alam",
                "country_code" => "marsa-alam",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Matruh",
                "country_arName" => "Matruh",
                "country_enNationality" => "Matruh",
                "country_arNationality" => "Matruh",
                "country_code" => "matruh",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Beni Suef",
                "country_arName" => "Beni Suef",
                "country_enNationality" => "Beni Suef",
                "country_arNationality" => "Beni Suef",
                "country_code" => "beni-suef",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Beheira",
                "country_arName" => "Beheira",
                "country_enNationality" => "Beheira",
                "country_arNationality" => "Beheira",
                "country_code" => "beheira",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Fayoum",
                "country_arName" => "Fayoum",
                "country_enNationality" => "Fayoum",
                "country_arNationality" => "Fayoum",
                "country_code" => "fayoum",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Minya",
                "country_arName" => "Minya",
                "country_enNationality" => "Minya",
                "country_arNationality" => "Minya",
                "country_code" => "minya",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Gharbiya",
                "country_arName" => "Gharbiya",
                "country_enNationality" => "Gharbiya",
                "country_arNationality" => "Gharbiya",
                "country_code" => "gharbiya",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Monufia",
                "country_arName" => "Monufia",
                "country_enNationality" => "Monufia",
                "country_arNationality" => "Monufia",
                "country_code" => "monufia",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Sharqia",
                "country_arName" => "Sharqia",
                "country_enNationality" => "Sharqia",
                "country_arNationality" => "Sharqia",
                "country_code" => "sharqia",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Al-Wadi El-Gadeed",
                "country_arName" => "Al-Wadi El-Gadeed",
                "country_enNationality" => "Al-Wadi El-Gadeed",
                "country_arNationality" => "Al-Wadi El-Gadeed",
                "country_code" => "al-wadi-el-gadeed",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Ismaeliya",
                "country_arName" => "Ismaeliya",
                "country_enNationality" => "Ismaeliya",
                "country_arNationality" => "Ismaeliya",
                "country_code" => "ismaeliya",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Kafr El-Sheikh",
                "country_arName" => "Kafr El-Sheikh",
                "country_enNationality" => "Kafr El-Sheikh",
                "country_arNationality" => "Kafr El-Sheikh",
                "country_code" => "kafr-el-sheikh",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Port Said",
                "country_arName" => "Port Said",
                "country_enNationality" => "Port Said",
                "country_arNationality" => "Port Said",
                "country_code" => "port-said",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Qena",
                "country_arName" => "Qena",
                "country_enNationality" => "Qena",
                "country_arNationality" => "Qena",
                "country_code" => "qena",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Sohaj",
                "country_arName" => "Sohaj",
                "country_enNationality" => "Sohaj",
                "country_arNationality" => "Sohaj",
                "country_code" => "sohaj",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Suez",
                "country_arName" => "Suez",
                "country_enNationality" => "Suez",
                "country_arNationality" => "Suez",
                "country_code" => "suez",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "North Coast",
                "country_arName" => "North Coast",
                "country_enNationality" => "North Coast",
                "country_arNationality" => "North Coast",
                "country_code" => "north-coast",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Mansoura",
                "country_arName" => "Mansoura",
                "country_enNationality" => "Mansoura",
                "country_arNationality" => "Mansoura",
                "country_code" => "mansoura",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Dakahlia",
                "country_arName" => "Dakahlia",
                "country_enNationality" => "Dakahlia",
                "country_arNationality" => "Dakahlia",
                "country_code" => "dakahlia",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Giza",
                "country_arName" => "Giza",
                "country_enNationality" => "Giza",
                "country_arNationality" => "Giza",
                "country_code" => "giza",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Qalyubia",
                "country_arName" => "Qalyubia",
                "country_enNationality" => "Qalyubia",
                "country_arNationality" => "Qalyubia",
                "country_code" => "qalyubia",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Red Sea",
                "country_arName" => "Red Sea",
                "country_enNationality" => "Red Sea",
                "country_arNationality" => "Red Sea",
                "country_code" => "red-sea",
                "order" => 300
            ],
            [
                "parent_id" => "64",
                "country_enName" => "Sinai",
                "country_arName" => "Sinai",
                "country_enNationality" => "Sinai",
                "country_arNationality" => "Sinai",
                "country_code" => "sinai",
                "order" => 300
            ],
            [

                "parent_id" => "194",
                "country_enName" => "Al Khobar",
                "country_arName" => "Al Khobar",
                "country_enNationality" => "Al Khobar",
                "country_arNationality" => "Al Khobar",
                "country_code" => "al-khobar",
                "order" => 300
            ],
            [

                "parent_id" => "194",
                "country_enName" => "Aseer",
                "country_arName" => "Aseer",
                "country_enNationality" => "Aseer",
                "country_arNationality" => "Aseer",
                "country_code" => "aseer",
                "order" => 300
            ],
            [

                "parent_id" => "194",
                "country_enName" => "Ash Sharqiyah",
                "country_arName" => "Ash Sharqiyah",
                "country_enNationality" => "Ash Sharqiyah",
                "country_arNationality" => "Ash Sharqiyah",
                "country_code" => "ash-sharqiyah",
                "order" => 300
            ],
            [

                "parent_id" => "194",
                "country_enName" => "Asir",
                "country_arName" => "Asir",
                "country_enNationality" => "Asir",
                "country_arNationality" => "Asir",
                "country_code" => "asir",
                "order" => 300
            ],
            [

                "parent_id" => "194",
                "country_enName" => "Central Province",
                "country_arName" => "Central Province",
                "country_enNationality" => "Central Province",
                "country_arNationality" => "Central Province",
                "country_code" => "central-province",
                "order" => 300
            ],
            [

                "parent_id" => "194",
                "country_enName" => "Eastern Province",
                "country_arName" => "Eastern Province",
                "country_enNationality" => "Eastern Province",
                "country_arNationality" => "Eastern Province",
                "country_code" => "eastern-province",
                "order" => 300
            ],
            [

                "parent_id" => "194",
                "country_enName" => "Ha\\'il",
                "country_arName" => "Ha\\'il",
                "country_enNationality" => "Ha\\'il",
                "country_arNationality" => "Ha\\'il",
                "country_code" => "ha\\'il",
                "order" => 300
            ],
            [

                "parent_id" => "194",
                "country_enName" => "Jawf",
                "country_arName" => "Jawf",
                "country_enNationality" => "Jawf",
                "country_arNationality" => "Jawf",
                "country_code" => "jawf",
                "order" => 300
            ],
            [

                "parent_id" => "194",
                "country_enName" => "Jizan",
                "country_arName" => "Jizan",
                "country_enNationality" => "Jizan",
                "country_arNationality" => "Jizan",
                "country_code" => "jizan",
                "order" => 300
            ],
            [

                "parent_id" => "194",
                "country_enName" => "Makkah",
                "country_arName" => "Makkah",
                "country_enNationality" => "Makkah",
                "country_arNationality" => "Makkah",
                "country_code" => "makkah",
                "order" => 300
            ],
            [

                "parent_id" => "194",
                "country_enName" => "Najran",
                "country_arName" => "Najran",
                "country_enNationality" => "Najran",
                "country_arNationality" => "Najran",
                "country_code" => "najran",
                "order" => 300
            ],
            [

                "parent_id" => "194",
                "country_enName" => "Qasim",
                "country_arName" => "Qasim",
                "country_enNationality" => "Qasim",
                "country_arNationality" => "Qasim",
                "country_code" => "qasim",
                "order" => 300
            ],
            [
                "parent_id" => "194",
                "country_enName" => "Tabuk",
                "country_arName" => "Tabuk",
                "country_enNationality" => "Tabuk",
                "country_arNationality" => "Tabuk",
                "country_code" => "tabuk",
                "order" => 300
            ],
            [
                "parent_id" => "194",
                "country_enName" => "Western Province",
                "country_arName" => "Western Province",
                "country_enNationality" => "Western Province",
                "country_arNationality" => "Western Province",
                "country_code" => "western-province",
                "order" => 300
            ],
            [
                "parent_id" => "194",
                "country_enName" => "Al Bahah",
                "country_arName" => "Al Bahah",
                "country_enNationality" => "Al Bahah",
                "country_arNationality" => "Al Bahah",
                "country_code" => "al-bahah",
                "order" => 300
            ],
            [
                "parent_id" => "194",
                "country_enName" => "Al Hudud Ash Shamaliyah",
                "country_arName" => "Al Hudud Ash Shamaliyah",
                "country_enNationality" => "Al Hudud Ash Shamaliyah",
                "country_arNationality" => "Al Hudud Ash Shamaliyah",
                "country_code" => "al-hudud-ash-shamaliyah",
                "order" => 300
            ],
            [
                "parent_id" => "194",
                "country_enName" => "Al Madinah",
                "country_arName" => "Al Madinah",
                "country_enNationality" => "Al Madinah",
                "country_arNationality" => "Al Madinah",
                "country_code" => "al-madinah",
                "order" => 300
            ],
            [
                "parent_id" => "194",
                "country_enName" => "Ar Riyad",
                "country_arName" => "Ar Riyad",
                "country_enNationality" => "Ar Riyad",
                "country_arNationality" => "Ar Riyad",
                "country_code" => "ar-riyad",
                "order" => 300
            ],
        ];

        Country::insert($data);
    }
}
