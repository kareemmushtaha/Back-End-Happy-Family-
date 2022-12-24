<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    // php artisan db:seed --class=SettingsTableSeeder

    public function run()
    {
        $data = [];

        // about us

        $data[0] = [
            'ar' => [
                'value' => "هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق. إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع",
            ],
            'en' => [
                'value' => "This text is an example of a text that can be replaced in the same space. This text was generated from the Arabic text generator, where you can generate such text or many other texts in addition to increasing the number of characters generated by the application. If you need more paragraphs, the Arabic text generator allows you to increase the number of paragraphs as you want, the text will not appear divided and does not contain language errors, the Arabic text generator is useful for web designers in particular, where the customer often needs to see a real picture for website design",
            ],
            'key' => 'about_us',
            'active' => 1,
        ];

        $data[1] = [
            'ar' => [
                'value' => "العنوان الكامل",
            ],
            'en' => [
                'value' => "Full Address",
            ],
            'key' => 'address',
            'active' => 1,
        ];

        $data[2] = [
            'ar' => [
                'value' => "+9256566216526",
            ],
            'en' => [
                'value' => "+9256566216526",
            ],
            'key' => 'phone',
            'active' => 1,
        ];

        $data[3] = [
            'ar' => [
                'value' => "info@al'asrahalsaeiduh.ae",
            ],
            'en' => [
                'value' => "info@al'asrahalsaeiduh.ae",
            ],
            'key' => 'email',
            'active' => 1,
        ];

        $data[4] = [
            'ar' => [
                'value' => "site-domain.com",
            ],
            'en' => [
                'value' => "site-domain.com",
            ],
            'key' => 'website',
            'active' => 1,
        ];

        $data[5] = [
            'ar' => [
                'value' => "الأسرة السعيدة للتوفيق بين الأزواج",
            ],
            'en' => [
                'value' => "The happy family To reconcile couples",
            ],
            'key' => 'title_site',
            'active' => 1,
        ];

        $data[6] = [
            'ar' => [
                'value' => "منصة الأسرة السعيدة منصة للتوفيق  بين الأزواج",
            ],
            'en' => [
                'value' => "Happy family platform between husbands",
            ],
            'key' => 'description_site',
            'active' => 1,
        ];

        $data[7] = [
            'ar' => [
                'value' => "www.facebook.com",
            ],
            'en' => [
                'value' => "www.facebook.com",
            ],
            'key' => 'facebook_link',
            'active' => 1,
        ];

        $data[8] = [
            'ar' => [
                'value' => "www.twitter.com",
            ],
            'en' => [
                'value' => "www.twitter.com",
            ],
            'key' => 'twitter_link',
            'active' => 1,
        ];

        $data[9] = [
            'ar' => [
                'value' => "www.instagram.com",
            ],
            'en' => [
                'value' => "www.instagram.com",
            ],
            'key' => 'instagram_link',
            'active' => 1,
        ];

        // home

        $data[10] = [
            'ar' => [
                'value' => "اعثر على شريك حياتك",
            ],
            'en' => [
                'value' => "Find your partner",
            ],
            'key' => 'home_header_title',
            'active' => 1,
        ];

        $data[11] = [
            'ar' => [
                'value' => "يثق بنا أكثر من 3،0 مليون مسلم ومسلمة من حول العالم",
            ],
            'en' => [
                'value' => "More than 3.0 million Muslims around the world trust us",
            ],
            'key' => 'home_header_description',
            'active' => 1,
        ];

        $data[12] = [
            'ar' => [
                'value' => "  زيجات إسلامية دولية - حائز على ثقة أكثر من 3 مليون مسلم ومسلمة",
            ],
            'en' => [
                'value' => "International Islamic Marriages - Trusted by more than 3 million Muslim men and women",
            ],
            'key' => 'home_section_get_to_know_us_title',
            'active' => 1,
        ];

        $data[13] = [
            'ar' => [
                'value' => " موقعنا مخصص بالكامل لمن يبحث عن عزاب أو عازبات مسلمين للزواج بطريقة تلتزم بالقواعد الإسلامية للتعارف تتكون قاعدة عضويتنا من 3،٥ مليون عازب وعازبة من الولايات المتحدة",
            ],
            'en' => [
                'value' => "Our site is entirely dedicated to those looking for Muslim singles to marry in a way that adheres to Islamic rules for dating. Our membership base consists of 3.5 million singles from the United States.",
            ],
            'key' => 'home_section_get_to_know_us_description',
            'active' => 1,
        ];

        $data[14] = [
            'ar' => [
                'value' => "نتحقق",
            ],
            'en' => [
                'value' => "check",
            ],
            'key' => 'home_section_features_title_1',
            'active' => 1,
        ];

        $data[15] = [
            'ar' => [
                'value' => "يتم تأكد من هوية جميع المستخدمين من قبل موظفينا للتأكد أنهم حقيقين",
            ],
            'en' => [
                'value' => "The identity of all users is verified by our staff to ensure that they are genuine",
            ],
            'key' => 'home_section_features_description_1',
            'active' => 1,
        ];

        $data[16] = [
            'ar' => [
                'value' => "نحمي",
            ],
            'en' => [
                'value' => "protect",
            ],
            'key' => 'home_section_features_title_2',
            'active' => 1,
        ];

        $data[17] = [
            'ar' => [
                'value' => "يتم توفير الحماية للمعلومات الخاصة بالمستخدمين من خلال نظام رائد",
            ],
            'en' => [
                'value' => "Protection of users' information is provided by a leading system",
            ],
            'key' => 'home_section_features_description_2',
            'active' => 1,
        ];

        $data[18] = [
            'ar' => [
                'value' => "نتحقق",
            ],
            'en' => [
                'value' => "check",
            ],
            'key' => 'home_section_features_title_3',
            'active' => 1,
        ];

        $data[19] = [
            'ar' => [
                'value' => "نسهل عليكم عمليات التواصل وارسال الرسائل في ما بينكم بأننا نوفر امكانيه التواصل عبر المنصه",
            ],
            'en' => [
                'value' => "We make it easier for you to communicate and send messages between you by providing the ability to communicate through the platform",
            ],
            'key' => 'home_section_features_description_3',
            'active' => 1,
        ];

        $data[20] = [
            'ar' => [
                'value' => "انشئ حساب شخصي",
            ],
            'en' => [
                'value' => "Create a personal account",
            ],
            'key' => 'home_section_how_to_choose_title_1',
            'active' => 1,
        ];

        $data[21] = [
            'ar' => [
                'value' => "قم بإنشاء حسابك الشخصي في ثواني معدودة مع خيار التسجيل السريع لدينا. لا تنسَ إضافة صورة",
            ],
            'en' => [
                'value' => "Create your personal account in just a few seconds with our quick registration option. Don't forget to add a picture",
            ],
            'key' => 'home_section_how_to_choose_description_1',
            'active' => 1,
        ];

        $data[22] = [
            'ar' => [
                'value' => "أبحث عن شريك حياتك",
            ],
            'en' => [
                'value' => "I am looking for your life partner",
            ],
            'key' => 'home_section_how_to_choose_title_2',
            'active' => 1,
        ];

        $data[23] = [
            'ar' => [
                'value' => "قم بالبحث في قاعدة الأعضاء الكبيرة لدينا بسهولة باستخدام مجموعة من الإعدادات والتفضيلات",
            ],
            'en' => [
                'value' => "Easily search our large member base using a range of settings and preferences",
            ],
            'key' => 'home_section_how_to_choose_description_2',
            'active' => 1,
        ];

        $data[24] = [
            'ar' => [
                'value' => "ابدأ في التواصل",
            ],
            'en' => [
                'value' => "Start communicating",
            ],
            'key' => 'home_section_how_to_choose_title_3',
            'active' => 1,
        ];

        $data[25] = [
            'ar' => [
                'value' => "ارسل رسالة أو رغبة تعارف لتبدأ في التواصل مع الأعضاء حان الوقت لك أن تجد الشريك المناسب",
            ],
            'en' => [
                'value' => "Send a message or a desire to get acquainted to start communicating with members. It is time for you to find the right partner",
            ],
            'key' => 'home_section_how_to_choose_description_3',
            'active' => 1,
        ];

        $data[29] = [
            'ar' => [
                'value' => "سياسة الخصوصية",
            ],
            'en' => [
                'value' => "privacy policy",
            ],
            'key' => 'privacy_policy',
            'active' => 1,
        ];


        foreach ($data as $index => $value) {
            Setting::create($data[$index]);
        }
    }
}















