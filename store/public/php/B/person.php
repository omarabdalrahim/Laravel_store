<?php
namespace B ;
// تغير اسمه في هذا المنطقه لتفادي التعارض في حالة عندي كلاس بنفس الاسم
use A\person  as personA;
// الفرق بين define ,const
// define تعرف متغير  ثابت خارج النيم اسبيس ويطلق عليه Global name space
define('AJAl',true);
// لازم يكون تابع ل النيم اسبيس
const laravel = 'laravel B';
function Hello()
{
    echo 'Hello B';
}
class person extends \A\person
{
    //  can make the const  protected or private
    const MALE = 'm';
    const FMALE = 'f';
    //   access modifier to php var  in classes
    // من اي مكان داخل الكلاس او خارجه
    public $name ;
    // داخل الكلاس او ابناءها فقط
    protected $gender;
    //   من نفس الكلاس فقط
    private $age;
    // يعني ايه استاتك يعني قيمتها يمكن الوصول اليها من خلال الكلاس ليس اوبجكت
    public static $country ;

    public function __construct()
    {
      echo __CLASS__;
    }

    public function setAge($age){
    //  -> هذا الرمز يستخدم لوصول الي اي متغير او دالة داخل الكلاس
        $this->age = $age;
        return $this;
    }
    public function setGender($gender){
    //   $ عدم استخدام مع المتغير
        $this->gender = $gender;
        return $this;
    }

    public static function setCountry($country){
        //داخل هذه الدالة  this لايكمن استحدام
        self::$country =$country;
        self::MALE;

    }


}
?>
