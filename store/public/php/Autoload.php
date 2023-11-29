<?php
// function loadClass($classname){
//      include __DIR__."/$classname.php";
// }
// طريقة استدعاء دالة من خلال دالة اخري تمسي callback functoin
// spl_autoload_register('loadClass');



/////////////////////طريقة اخري /////////////////////////////////

// طريقة استدعاء دالة داخل دالة اخري بدون كتابة اسم الدالة تمسي Anonymous function

// دالة تقوم ارجاع الاخطاء اللي تحدث بسبب الاسماء ثم تمرر الاسم ده ل الداله ثم يعمل استداعاء لهذه الادالة
spl_autoload_register(function ($classname){

    include __DIR__."/$classname.php";
}
)




?>
