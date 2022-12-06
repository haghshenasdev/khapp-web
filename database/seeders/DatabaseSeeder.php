<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\charity;
use App\Models\hadis;
use App\Models\HomeItem;
use App\Models\Pooyesh;
use App\Models\Project;
use App\Models\Slider;
use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        charity::insert([
            'fullname' => 'خیریه امام علی ابن ابیطالب علیه السلام سهر گرگاب',
            'shortname' => 'خیریه امام علی (ع) گرگاب',
            'about' => ' خیریه امام علی ابن ابیطالب علیه السلام شهر گرگاب
فعالیت خود را به صورت رسمی از تاریخ 1392/01/26 با هدف کمک به نیاز مندان و انجام امور خیر در حوزه های حمایتی و عمرانی و... آغاز کرده است . ',
        ]);

        HomeItem::Insert([
          [
          'title' => 'دکمه اول',
          'icon' => 'http://localhost:8000/charities/1/icons/charity.png',
          'action' => 'page:donaite',
          'charity' => 1,
      ], [
          'title' => 'دکمه دوم',
          'icon' => 'http://localhost:8000/charities/1/icons/charity.png',
          'action' => 'page:donaite',
          'charity' => 1,
      ]]);

      Type::insert([
          'type_name' => 'alamdar',
          'title' => 'پروژه علمدار',
          'charity' => 1,
      ]);

      Pooyesh::insert([
          [
              'title' => 'مشارکت در ساخت پروژه علمدار',
              'description' => 'پروژه عظیم مجموعه فرهنگی علمدار با زیر بنای بیشر از 3200 متر مربع با هدف ارائه خدمات فرهنگی احداث شد ، این مجموعه شامل سالن همایش با سقف یک پارچه بتنی با مساحتی بالغ بر 900 متر مربع و... می باشد.',
              'image' => 'https://kheiriehemamali.ir/css/images/alamdar/%D8%A8%DB%8C%D8%AA%20%D8%A7%D9%84%D8%B9%D8%A8%D8%A7%D8%B3.jpg',
              'amount' => 10000000,
              'type_pay' => 1,
              'charity' => 1,
          ],
      ]);

      Slider::insert([[
          'url' => 'https://kheiriehemamali.ir/css/images/orzans-115/%D8%A7%D9%88%D8%B1%DA%98%D8%A7%D9%86%D8%B3.jpg',
          'charity' => 1,
      ],[
          'url' => 'https://kheiriehemamali.ir/css/images/salamat/%D9%85%D8%B1%DA%A9%D8%B2%20%D8%AC%D8%A7%D9%85%D8%B9%20%D8%B3%D9%84%D8%A7%D9%85%D8%AA.jpg',
          'charity' => 1,
      ]]);

      Project::insert([
          [
              'title' => 'مرکز جامع سلامت',
              'slug' => 'salamat',
              'pishraft'=> 100,
              'image_head' => 'https://kheiriehemamali.ir/css/images/salamat/%D9%85%D8%B1%DA%A9%D8%B2%20%D8%AC%D8%A7%D9%85%D8%B9%20%D8%B3%D9%84%D8%A7%D9%85%D8%AA.jpg',
              'description' => 'مرکز جامع سلامت زنده یاد حاج حسن (منصور) بیدرام شهر گرگاب به همت خیریه امام علی ابن ابیطالب شهر گرگاب در سال 1395 احداث شده است .',
              'charity' => 1,
          ],
          [
              'title' => 'پروژه بزرگ علمدار',
              'slug' => 'alamdar',
              'pishraft'=> 30,
              'image_head' => 'https://kheiriehemamali.ir/css/images/alamdar/%D8%A8%DB%8C%D8%AA%20%D8%A7%D9%84%D8%B9%D8%A8%D8%A7%D8%B3.jpg',
              'description' => 'پروژه عظیم مجموعه فرهنگی علمدار با زیر بنای بیشر از 3200 متر مربع با هدف ارائه خدمات فرهنگی احداث شد ، این مجموعه شامل سالن همایش با سقف یک پارچه بتنی با مساحتی بالغ بر 900 متر مربع و... می باشد.',
              'charity' => 1,
          ]
      ]);

      DB::table('hadis_groups')->insert([
          'title' => 'صدقه دادن',
          'charity' => 1,
      ]);

      hadis::insert([
          'gala' => 'امام باقر علیه السلام',
          'arabi' => 'اَلبِرُّ وَ الصَّدَقَةُ يَنفيانِ الفَقرَ وَ يَزيدانِ فِى العُمرِ وَ يَدفَعانِ عَن صاحِبِهِما سَبعينَ ميتَةَ سوءٍ',
          'farsi' => 'كار خير و صدقه، فقر را می بَرند، بر عمر می افزايند و هفتاد مرگ بد را از صاحب خود دور مى كنند.',
          'charity' => 1,
      ]);
    }
}
