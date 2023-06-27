<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CharitiesMeta;
use App\Models\charity;
use App\Models\Darkhast;
use App\Models\darkhast_status;
use App\Models\DarkhastStatus;
use App\Models\DarkhastType;
use App\Models\Faktoor;
use App\Models\Hadis;
use App\Models\HomeItem;
use App\Models\Marasem;
use App\Models\Pooyesh;
use App\Models\Post;
use App\Models\Project;
use App\Models\Slider;
use App\Models\Tag;
use App\Models\TagTarh;
use App\Models\TagType;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'id' => 0,
            'fullname' => 'سراسری',
            'shortname' => 'سراسری',
            'is_active' => 1,
        ]);

        charity::insert([
            'fullname' => 'خیریه امام علی ابن ابیطالب علیه السلام شهر گرگاب',
            'shortname' => 'خیریه امام علی (ع) گرگاب',
            'is_active' => 1,
        ]);

        CharitiesMeta::query()->insert(
            [
                'about' => ' خیریه امام علی ابن ابیطالب علیه السلام شهر گرگاب
فعالیت خود را به صورت رسمی از تاریخ 1392/01/26 با هدف کمک به نیاز مندان و انجام امور خیر در حوزه های حمایتی و عمرانی و... آغاز کرده است . ',
                'phone' => '03145753131',
                'logo' => '/',
                'terminal_id' => '21486240',
                'charity' => 1,
            ]
        );

        HomeItem::Insert([
          [
          'title' => 'دکمه اول',
          'icon' => 'https://kheiriehemamali.ir/css/images/مددجو.svg',
          'action' => '{"fnName" : "openUrl","params" : {"url" : "https://kheiriehemamali.ir"}}',
          'charity' => 1,
      ], [
          'title' => 'دکمه دوم',
          'icon' => url('charities/1/icons/charity.png'),
          'action' => '{"fnName" : "openPayment","params" : {"type" : "1"}}',
          'charity' => 1,
      ]]);

      Type::insert([
          'slug' => 'projects',
          'title' => 'پروژه های عمرانی',
          'charity' => 1,
      ]);

        Type::insert([
                [
                    'slug' => 'alamdar',
                    'title' => 'پروژه علمدار',
                    'charity' => 1,
                    'sub' => 1,
                ],[
                'slug' => 'ezdevaj',
                'title' => 'پروژه مسکن ازدواج',
                'charity' => 1,
                'sub' => 1,
            ],
        ]);
        Type::query()->insert([
            'slug' => 'tag',
            'title' => 'تاج گل',
            'charity' => 1,
            'is_active' => 0,
        ]);

      Pooyesh::insert([
          [
              'title' => 'مشارکت در ساخت پروژه علمدار',
              'description' => 'پروژه عظیم مجموعه فرهنگی علمدار با زیر بنای بیشر از 3200 متر مربع با هدف ارائه خدمات فرهنگی احداث شد ، این مجموعه شامل سالن همایش با سقف یک پارچه بتنی با مساحتی بالغ بر 900 متر مربع و... می باشد.',
              'image' => 'https://kheiriehemamali.ir/css/images/alamdar/%D8%A8%DB%8C%D8%AA%20%D8%A7%D9%84%D8%B9%D8%A8%D8%A7%D8%B3.jpg',
              'amount' => 10000000,
              'type_pay' => 2,
              'charity' => 1,
          ],
      ]);

      Slider::insert([[
          'image' => 'https://kheiriehemamali.ir/css/images/orzans-115/%D8%A7%D9%88%D8%B1%DA%98%D8%A7%D9%86%D8%B3.jpg',
          'charity' => 1,
      ],[
          'image' => 'https://kheiriehemamali.ir/css/images/salamat/%D9%85%D8%B1%DA%A9%D8%B2%20%D8%AC%D8%A7%D9%85%D8%B9%20%D8%B3%D9%84%D8%A7%D9%85%D8%AA.jpg',
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
              'type_pay' => null,
          ],
          [
              'title' => 'پروژه بزرگ علمدار',
              'slug' => 'alamdar',
              'pishraft'=> 30,
              'image_head' => 'https://kheiriehemamali.ir/css/images/alamdar/%D8%A8%DB%8C%D8%AA%20%D8%A7%D9%84%D8%B9%D8%A8%D8%A7%D8%B3.jpg',
              'description' => 'پروژه عظیم مجموعه فرهنگی علمدار با زیر بنای بیشر از 3200 متر مربع با هدف ارائه خدمات فرهنگی احداث شد ، این مجموعه شامل سالن همایش با سقف یک پارچه بتنی با مساحتی بالغ بر 900 متر مربع و... می باشد.',
              'charity' => 1,
              'type_pay' => 2,
          ]
      ]);

      DB::table('hadis_groups')->insert([
          'title' => 'صدقه دادن',
          'charity' => 1,
      ]);

      Hadis::insert([
          'gala' => 'امام باقر علیه السلام',
          'arabi' => 'اَلبِرُّ وَ الصَّدَقَةُ يَنفيانِ الفَقرَ وَ يَزيدانِ فِى العُمرِ وَ يَدفَعانِ عَن صاحِبِهِما سَبعينَ ميتَةَ سوءٍ',
          'farsi' => 'كار خير و صدقه، فقر را می بَرند، بر عمر می افزايند و هفتاد مرگ بد را از صاحب خود دور مى كنند.',
          'charity' => 1,
      ]);

      User::query()->insert([
          'name' => 'محمد مهدی حق شناس',
          'email' => 'mhgorgab@gmail.com',
          'phone' => '09137021061',
          'address' => 'گرگاب ، بلوار امام ، خیابان آزادگان ، پلاک 75',
          'password' => Hash::make('@123456789'),
          'charity' => 1,
          'access_level' => 0,
      ]);

      Faktoor::query()->insert([
          [
              'userid' => 1,
              'amount' => 50000,
              'type' => 1,
              'sabtid' => '110-1245454',
              'is_pardakht' => 1,
              'charity' => 1,
          ],
          [
              'userid' => 1,
              'amount' => 10000,
              'type' => 2,
              'sabtid' => '110-1278755',
              'is_pardakht' => 0,
              'charity' => 1,
          ]
      ]);

      DarkhastType::query()->insert(
          [
              'title' => 'صندوق صدقات',
              'description' => 'این مورد جهت درخواست صندوق صدقات است',
              'charity' => 1,
          ]
      );

      DarkhastStatus::query()->insert([
          [
              'status_title' => 'ثبت شده'
          ],
          [
              'status_title' => 'در حال بررسی'
          ],
          [
              'status_title' => 'بسته شده'
          ]
      ]);

      DarkhastType::query()->insert([
          [
              'title' => 'صندوق کوچک خودرو',
              'description' => 'صندوق کوچک مناسب خودرو',
              'charity' => 1,
              'sub' => 1,
          ],
          [
              'title' => 'صندوق بزرگ',
              'description' => 'صندوق مناسب منزل و محیط کار',
              'charity' => 1,
              'sub' => 1,
          ]
      ]);

      Darkhast::query()->insert([
          'type' => 2,
          'user' => 1,
          'description' => 'قبل از ارسال صندوق با بنده تماس بگیرید',
          'charity' => 1,
      ]);

      TagType::query()->insert([
          [
              'charity' => 1,
              'title' => 'ایستاده بزرگ ',
              'img' => 'https://rezvanflower.ir/wp-content/uploads/2018/08/TT-tarhim-149.jpg',
              'amount' => 250000,
              'count' => 20,
          ],
          [
              'charity' => 1,
              'title' => 'ایستاده بزرگ 2',
              'img' => 'https://bakhtarflower.com/wp-content/uploads/2022/10/%DB%B2%DB%B0%DB%B2%DB%B2%DB%B0%DB%B5%DB%B1%DB%B2_%DB%B1%DB%B7%DB%B3%DB%B7%DB%B4%DB%B0.jpg',
              'amount' => 200000,
              'count' => 1,
          ]
      ]);

      TagTarh::query()->insert([
          'charity' => 1,
          'name' => 'طرح طلایی رنگ',
          'img' => 'https://www.cafepsd.com/wp-content/uploads/2018/05/Tarhim3797.jpg',
      ]);

      Marasem::query()->insert([
          [
              'charity' => 1,
              'created_by' => 1,
              'location' => 'مسجد جامع شهر گرگاب',
              'marhoom_name' => 'فلانی ابن فلانی',
              'date' => now(),
              'is_active' => 1,
          ],
          [
              'charity' => 1,
              'created_by' => 1,
              'location' => 'مسجد جامع شهر گرگاب',
              'marhoom_name' => 'یه بنده خدا',
              'date' => now(),
              'is_active' => 0,
          ]
      ]);

      Tag::query()->insert([
          [
              'bename' => 'محمد مهدی حق شناس',
              'user' => 1,
              'marasem' => 1,
              'type' => 1,
              'tarh' => 1,
              'charity' => 1,
          ],
          [
              'bename' => 'محمد جواد بیدرام',
              'user' => 1,
              'marasem' => 2,
              'type' => 2,
              'tarh' => 1,
              'charity' => 1,
          ]
      ]);

      Post::query()->insert([
          'title' => 'عنوان پست',
          'img' => 'https://kheiriehemamali.ir/blog/wp-content/uploads/2022/07/photo_2022-07-17_10-17-36.jpg?v=1660229049',
          'charity' => 1,
          'body' => '
<p>به مناسبت عید غدیر خم بین ۹۰ خانواده نیازمند تحت پوشش خیریه سبد های غذایی به ارزش ۶/۵۰۰/۰۰۰ ریال توزیع گردید .<br>این سبد های غذایی شامل اقلامی چون برنج ، گوشت ، شکر ، نبات ، رب ، ماکارونی و سویا می باشد .</p>



<p>👈 راه های مشارکت در کار های خیر به واسطه خیریه امام علی ابن ابیطالب (ع) شهر گرگاب :<br>✅ شماره کارت خیریه : ۶۰۳۷۷۰۷۰۰۰۰۳۲۷۹۱<br>✅ شماره حساب خیریه نزد صندوق انصار المهدی شهر گرگاب : ۱۱۸۷۹۴۳۱<br>✅ درگاه پرداخت آنلاین : <a href="http://yun.ir/khgd" target="_blank" rel="noreferrer noopener" dideo-checked="true">http://yun.ir/khgd</a></p>',

      ]);

    }
}
