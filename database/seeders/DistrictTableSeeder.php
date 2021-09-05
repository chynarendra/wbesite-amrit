<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('district')->truncate();
        $rows = [
            [
                'province_id' => 1,
                'name_en' => 'Taplejung',
                'name_np' => 'ताप्लेजुङ',
                'code' => '101'
            ],
            [
                'province_id' => 1,
                'name_en' => 'Sankhuwasabha',
                'name_np' => 'संखुवासभा',
                'code' => '102'
            ],
            [
                'province_id' => 1,
                'name_en' => 'Solukhumbu',
                'name_np' => 'सोलुखुम्बु',
                'code' => '103'
            ],
            [
                'province_id' => 1,
                'name_en' => 'Okhaldhunga',
                'name_np' => 'ओखलढुंगा',
                'code' => '104'
            ],
            [
                'province_id' => 1,
                'name_en' => 'Khotang',
                'name_np' => 'खोटाङ',
                'code' => '105'
            ],
            [
                'province_id' => 1,
                'name_en' => 'Bhojpur',
                'name_np' => 'भोजपुर',
                'code' => '106'
            ],
            [
                'province_id' => 1,
                'name_en' => 'Dhankuta',
                'name_np' => 'धनकुटा',
                'code' => '107'
            ],
            [
                'province_id' => 1,
                'name_en' => 'Terhathum',
                'name_np' => 'तेहथुम',
                'code' => '108'
            ],
            [
                'province_id' => 1,
                'name_en' => 'Panchthar',
                'name_np' => 'पाँचथर',
                'code' => '109'
            ],
            [
                'province_id' => 1,
                'name_en' => 'Illam',
                'name_np' => 'ईलाम',
                'code' => '110'
            ],
            [
                'province_id' => 1,
                'name_en' => 'Jhapa',
                'name_np' => 'झापा',
                'code' => '111'
            ],
            [
                'province_id' => 1,
                'name_en' => 'Morang',
                'name_np' => 'मोरंग',
                'code' => '112'
            ],
            [
                'province_id' => 1,
                'name_en' => 'Sunsari',
                'name_np' => 'सुनसरी',
                'code' => '113'
            ],
            [
                'province_id' => 1,
                'name_en' => 'Udayapur',
                'name_np' => 'उदयपुर',
                'code' => '114'
            ],
            [
                'province_id' => 2,
                'name_en' => 'Saptari',
                'name_np' => 'सप्तरी',
                'code' => '201'
            ],
            [
                'province_id' => 2,
                'name_en' => 'Siraha',
                'name_np' => 'सिराहा',
                'code' => '202'
            ],
            [
                'province_id' => 2,
                'name_en' => 'Dhanusa',
                'name_np' => 'धनुषा',
                'code' => '203'
            ],
            [
                'province_id' => 2,
                'name_en' => 'Mahottari',
                'name_np' => 'महोत्तरी',
                'code' => '204'
            ],
            [
                'province_id' => 2,
                'name_en' => 'Sarlahi',
                'name_np' => 'सर्लाही',
                'code' => '205'
            ],
            [
                'province_id' => 2,
                'name_en' => 'Rautahat',
                'name_np' => 'रौतहट',
                'code' => '206'
            ],
            [
                'province_id' => 2,
                'name_en' => 'Bara',
                'name_np' => 'वारा',
                'code' => '207'
            ],
            [
                'province_id' => 2,
                'name_en' => 'Parsa',
                'name_np' => 'पर्सा',
                'code' => '208'
            ],
            [
                'province_id' => 3,
                'name_en' => 'Dolakha',
                'name_np' => 'दोलखा',
                'code' => '301'
            ],
            [
                'province_id' => 3,
                'name_en' => 'Sindhupalchowk',
                'name_np' => 'सिन्धुपाल्चोक',
                'code' => '302'
            ],
            [
                'province_id' => 3,
                'name_en' => 'Rasuwa',
                'name_np' => 'रसुवा',
                'code' => '303'
            ],
            [
                'province_id' => 3,
                'name_en' => 'Dhading',
                'name_np' => 'धादिङ',
                'code' => '304'
            ],
            [
                'province_id' => 3,
                'name_en' => 'Nuwakot',
                'name_np' => 'नुवाकोट',
                'code' => '305'
            ],
            [
                'province_id' => 3,
                'name_en' => 'Kathmandu',
                'name_np' => 'काठमाण्डौ',
                'code' => '306'
            ],
            [
                'province_id' => 3,
                'name_en' => 'Bhaktapur',
                'name_np' => 'भक्तपुर',
                'code' => '307'
            ],
            [
                'province_id' => 3,
                'name_en' => 'Lalitpur',
                'name_np' => 'ललितपुर',
                'code' => '308'
            ],
            [
                'province_id' => 3,
                'name_en' => 'Kavrepalanchowk',
                'name_np' => 'काभ्रेपलान्चोक',
                'code' => '309'
            ],
            [
                'province_id' => 3,
                'name_en' => 'Ramechhap',
                'name_np' => 'रामेछाप',
                'code' => '310'
            ],
            [
                'province_id' => 3,
                'name_en' => 'Sindhuli',
                'name_np' => 'सिन्धुली',
                'code' => '311'
            ],
            [
                'province_id' => 3,
                'name_en' => 'Makwanpur',
                'name_np' => 'मकवानपुर',
                'code' => '312'
            ],
            [
                'province_id' => 3,
                'name_en' => 'Chitwan',
                'name_np' => 'चितवन',
                'code' => '313'
            ],
            [
                'province_id' => 4,
                'name_en' => 'Gorkha',
                'name_np' => 'गोरखा',
                'code' => '401'
            ],
            [
                'province_id' => 4,
                'name_en' => 'Manang',
                'name_np' => 'मनाङ',
                'code' => '402'
            ],
            [
                'province_id' => 4,
                'name_en' => 'Mustang',
                'name_np' => 'मुस्ताङ',
                'code' => '403'
            ],
            [
                'province_id' => 4,
                'name_en' => 'Myagdi',
                'name_np' => 'म्याग्दी',
                'code' => '404'
            ],
            [
                'province_id' => 4,
                'name_en' => 'Kaski',
                'name_np' => 'कास्की',
                'code' => '405'
            ],
            [
                'province_id' => 4,
                'name_en' => 'Lamjung',
                'name_np' => 'लमजुङ',
                'code' => '406'
            ],
            [
                'province_id' => 4,
                'name_en' => 'Tanahu',
                'name_np' => 'तनहुँ',
                'code' => '407'
            ],
            [
                'province_id' => 4,
                'name_en' => 'Nawalpur',
                'name_np' => 'नवलपरासी (बर्दघाट सुस्ता पूर्व)',
                'code' => '408'
            ],
            [
                'province_id' => 4,
                'name_en' => 'Syangja',
                'name_np' => 'स्याङजा',
                'code' => '409'
            ],
            [
                'province_id' => 4,
                'name_en' => 'Parbat',
                'name_np' => 'पर्वत',
                'code' => '410'
            ],
            [
                'province_id' => 4,
                'name_en' => 'Baglung',
                'name_np' => 'वाग्लुङ',
                'code' => '411'
            ],
            [
                'province_id' => 5,
                'name_en' => 'Rukum East',
                'name_np' => 'रुकुम (पूर्वी भाग)',
                'code' => '501'
            ],
            [
                'province_id' => 5,
                'name_en' => 'Rolpa',
                'name_np' => 'रोल्पा',
                'code' => '502'
            ],
            [
                'province_id' => 5,
                'name_en' => 'Pyuthan',
                'name_np' => 'प्यूठान',
                'code' => '503'
            ],
            [
                'province_id' => 5,
                'name_en' => 'Gulmi',
                'name_np' => 'गुल्मी',
                'code' => '504'
            ],
            [
                'province_id' => 5,
                'name_en' => 'Arghakhanchi',
                'name_np' => 'अर्घाखाँची',
                'code' => '505'
            ],
            [
                'province_id' => 5,
                'name_en' => 'Palpa',
                'name_np' => 'पाल्पा',
                'code' => '506'
            ],
            [
                'province_id' => 5,
                'name_en' => 'Parasi',
                'name_np' => 'नवलपरासी (बर्दघाट सुस्ता पश्चिम)',
                'code' => '507'
            ],
            [
                'province_id' => 5,
                'name_en' => 'Rupandehi',
                'name_np' => 'रुपन्देही',
                'code' => '508'
            ],
            [
                'province_id' => 5,
                'name_en' => 'Kapilbastu',
                'name_np' => 'कपिलबस्तु',
                'code' => '509'
            ],
            [
                'province_id' => 5,
                'name_en' => 'Dang',
                'name_np' => 'दाङ',
                'code' => '510'
            ],
            [
                'province_id' => 5,
                'name_en' => 'Banke',
                'name_np' => 'बाँके',
                'code' => '511'
            ],
            [
                'province_id' => 5,
                'name_en' => 'Bardiya',
                'name_np' => 'बर्दिया',
                'code' => '512'
            ],
            [
                'province_id' => 6,
                'name_en' => 'Dolpa',
                'name_np' => 'डोल्पा',
                'code' => '601'
            ],
            [
                'province_id' => 6,
                'name_en' => 'Mugu',
                'name_np' => 'मुगु',
                'code' => '602'
            ],
            [
                'province_id' => 6,
                'name_en' => 'Humla',
                'name_np' => 'हुम्ला',
                'code' => '603'
            ],
            [
                'province_id' => 6,
                'name_en' => 'Jumla',
                'name_np' => 'जुम्ला',
                'code' => '604'
            ],
            [
                'province_id' => 6,
                'name_en' => 'Kalikot',
                'name_np' => 'कालिकोट',
                'code' => '605'
            ],
            [
                'province_id' => 6,
                'name_en' => 'Dailekh',
                'name_np' => 'दैलेख',
                'code' => '606'
            ],
            [
                'province_id' => 6,
                'name_en' => 'Jajarkot',
                'name_np' => 'जाजरकोट',
                'code' => '607'
            ],
            [
                'province_id' => 6,
                'name_en' => 'Rukum West',
                'name_np' => 'रुकुम (पश्चिम भाग)',
                'code' => '608'
            ],
            [
                'province_id' => 6,
                'name_en' => 'Salyan',
                'name_np' => 'सल्यान',
                'code' => '609'
            ],
            [
                'province_id' => 6,
                'name_en' => 'Surkhet',
                'name_np' => 'सुर्खेत',
                'code' => '610'
            ],
            [
                'province_id' => 7,
                'name_en' => 'Bajura',
                'name_np' => 'बाजुरा',
                'code' => '701'
            ],
            [
                'province_id' => 7,
                'name_en' => 'Bajhang',
                'name_np' => 'बझाङ',
                'code' => '702'
            ],
            [
                'province_id' => 7,
                'name_en' => 'Darchula',
                'name_np' => 'दार्चुला',
                'code' => '703'
            ],
            [
                'province_id' => 7,
                'name_en' => 'Baitadi',
                'name_np' => 'बैतडी',
                'code' => '704'
            ],
            [
                'province_id' => 7,
                'name_en' => 'Dadeldhura',
                'name_np' => 'डडेलधुरा',
                'code' => '705'
            ],
            [
                'province_id' => 7,
                'name_en' => 'Doti',
                'name_np' => 'डोटी',
                'code' => '706'
            ],
            [
                'province_id' => 7,
                'name_en' => 'Achham',
                'name_np' => 'अछाम',
                'code' => '707'
            ],
            [
                'province_id' => 7,
                'name_en' => 'Kailali',
                'name_np' => 'कैलाली',
                'code' => '708'
            ],
            [
                'province_id' => 7,
                'name_en' => 'Kanchanpur',
                'name_np' => 'कञ्चनपुर',
                'code' => '709'
            ],

        ];
        DB::table('district')->insert($rows);
    }
}
