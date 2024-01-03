<?php

$WabLink = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]";

use Chargily\ePay\Chargily;
use Rakit\Validation\Validator;

require './vendor/autoload.php';

$epay_config = require 'epay_config.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // إنشاء مثيل Validator
        $validator = new Validator();

        // تحديد قواعد التحقق
        $validation = $validator->validate($_POST, [
            'mode' => 'required',
            'name' => 'required',
            'emon' => 'required|numeric|min:75', // يجب أن يكون الرقم أكبر من أو يساوي 75
            'email' => 'required|email',
            'wsf' => 'required',
        ]);

        // التحقق من نجاح التحقق
        if ($validation->fails()) {
            throw new Exception("يرجى تعبئة جميع الحقول المطلوبة بشكل صحيح.");
        }
      //...

      $mode = $_POST['mode'];
      $name = $_POST["name"];
      $emon = $_POST["emon"];
      $email = $_POST["email"];
      $wsf = $_POST["wsf"];

      // إنشاء رقم عشوائي
      $randomNumber = rand(10000, 99999); // يمكنك تعديل نطاق الأرقام حسب الحاجة

      // تقليل قيمة المبلغ بنسبة 2.5٪
      $discountPercentage = 2.1;
      $discountAmount = ($emon * $discountPercentage) / 100;
      $emon -= $discountAmount;

      //...

      $chargily = new Chargily([
          'api_key' => $epay_config['key'],
          'api_secret' => $epay_config['secret'],
          'urls' => [
              'back_url' => "$WabLink/index.php",
              'webhook_url' => "$WabLink/process.php",
          ],
          'mode' => $mode,
          'payment' => [
              'number' => $randomNumber,
              'client_name' => $name,
              'client_email' => $email,
              'amount' => $emon,
              'discount' => 0, // لا داعي لتخصيص هذه القيمة، حيث تم التخفيض مسبقًا
              'description' => $wsf,
          ],
      ]);

      //...


        $redirectUrl = $chargily->getRedirectUrl();

        if ($redirectUrl) {
            // توجيه المستخدم إلى صفحة الدفع
            header('Location: ' . $redirectUrl);
        } else {
            throw new Exception("تعذر إنشاء عنوان URL للتوجيه");
        }
    }
} catch (Exception $e) {
    // التعامل مع الاستثناء (على سبيل المثال، تسجيله، عرض رسالة ودية للمستخدم)
    echo "حدث خطأ: " . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="fr">
<!-- ... شيفرتك HTML ... -->
</html>


<!DOCTYPE html>
<html lang="fr">
<!-- ... شيفرتك HTML ... -->
</html>





<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="Logo.png">

    <title>تبرع</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="stayl.css">
    <link rel="stylesheet" href="code.js">
</head>
<body background="backg.png">
<header>
        <div class="logo">
            <img src="Logo.png" alt="Logo">
        </div>
        <nav class="mune">
            <a href="index.html" class="ris">صفحة رئيسية</a>
            <a href="index.html#info" class="ris2">تواصل معنا</a>
        </nav>
    </header>
    <section>
 <div class="ctn">
 <div class="card text-center">
  <div class="card-header">
     جمعية كافل اليتيم فرع صيادة ولاية مستغانم
  </div>
  <div class="card-body">
    <h5 class="card-title">أكفلني_ولك_الجنة#</h5>
    <p class="card-text">تبرع اليوم لجمعية كافل يتيم وكن سببًا في تغيير حياة طفل</p>
    <div>
    <button class="btn btn-primary btn-emo">100</button>
   <button class="btn btn-primary btn-emo">500</button>
   <button class="btn btn-primary btn-emo">1000</button>
    </div>
    <form class="my-4" method="POST">
    <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">مبلغ</label>
  <input id="Emo" type="number" name="emon" oninput="limitInputLength(this)" class="form-control"  placeholder="75 DA" min="75" maxlength="15" style="text-align: center;">
</div>

<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">اسم</label>
  <input name="name" type="text" class="form-control" id="exampleFormControlTextarea1" rows="3" style="text-align: center;"></input>
</div>

<div class="mb-5">
  <label for="exampleFormControlTextarea1" class="form-label">بريد الكتروني</label>
  <input name="email" type="email" class="form-control" id="exampleFormControlTextarea1" placeholder="example@example.com" rows="3" style="text-align: center;"</input>
</div>

<div class="mb-2">
  <label for="exampleFormControlTextarea1" class="form-label">صلي على نبي</label>
  <textarea name="wsf" class="form-control" id="exampleFormControlTextarea1" style="text-align: center;" placeholder="صلي على حبيب قلبك يطيب" rows="3"></textarea>
</div>
    <div class="mod">
      <label for="mode">اختر وسيلة دفع</label>
      <select name="mode" id="mode" class = "mode">
          <option value="EDAHABIA">EDAHABIA</option>
          <option value="CIB">CIB</option>

    </div>

<div>
  <input type="submit" class="btn btn-primary"  value="valider" id="sub">
</div>
    </form>
  </div>
  <div class="card-footer text-body-secondary">
    <a href="https://rebrand.ly/masjed-kbs">تبرع لجمعية مسجد خالد بن سعيد</a>
  </div>
</div>
 </div>
                <div class="ccpba">
                    <div class="textone" id="ccp">
                        <h2>:تبرع عن طريق</h2>
                    </div>
                    <p class="li1">CCP :</p>
                    <p class="p1">001311880489</p>
                    <p class="li1">Baridimob</p>
                    <p class="p1">0079999007311880489</p>
                </div>

      <p class="progr">
  <a href="https://www.facebook.com/fantiskomeryole/">
    HadjiElmeriah موقع من تطوير وبرمجة
  </a>
      </p>
    </section>
    <script src="code.js">


    </script>
    
    
</body>

</html>