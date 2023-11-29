<?php
namespace A ;
// psr4  : php stander requmention  مجموعه من المطورين عملوا معاير للمطورين يمشوا عليها


// __dir__ يعطيني مسار الفلدر اللي انا فيه
//  namespace ازاي استدعي 2 كلاس او باكدج لهم نفس الاسم او حتي داله عن طريق
include __DIR__.'/A/person.php';
 include __DIR__.'/B/person.php';
// في حالة استخدام الجملة التاليه يكون الاوبجكت تبع نيم اسبيس بي
use B\person;


$person = new person;
// لاحظ تم وضع \ قبل النيم اسبيس علشان يعرفه انها ليست جزاء منه
 $person1 = new \B\person;

$person->name = 'mohamed';
 $person1->name = 'omar';
$person::$country = "Egypt";
 $person1::$country = "USA";

var_dump($person);
//    egypt ولم يتطبع USA  يتم الاحتفاظ با خر تعديل علي الاستاتك ولذلك طبع
echo person::$country;
echo $person::MALE;

?>
