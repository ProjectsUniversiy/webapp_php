<?php
// متغير لعرض النتيجة
$result_message = '';

// 1. التحقق مما إذا كان المستخدم قد أرسل النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['birthdate'])) {

    try {
        // 2. الحصول على تاريخ الميلاد المدخل
        $birthdate_string = $_POST['birthdate'];
        
        // 3. استخدام كائنات التاريخ في PHP (الطريقة الاحترافية)
        $birthdate_obj = new DateTime($birthdate_string);
        $today_obj = new DateTime('today'); // تاريخ اليوم

        // 4. التأكد أن تاريخ الميلاد ليس في المستقبل
        if ($birthdate_obj > $today_obj) {
            $result_message = "<span style='color: red;'>تاريخ الميلاد لا يمكن أن يكون في المستقبل!</span>";
        } else {
            // 5. حساب الفرق (العمر)
            $age_interval = $today_obj->diff($birthdate_obj);
            
            // 6. تنسيق رسالة النتيجة
            $years = $age_interval->y;
            $months = $age_interval->m;
            $days = $age_interval->d;
            
            $result_message = "عمرك هو: <strong>$years</strong> سنوات، و <strong>$months</strong> شهور، و <strong>$days</strong> أيام.";
        }
    } catch (Exception $e) {
        // في حال أدخل المستخدم تاريخاً بتنسيق خاطئ
        $result_message = "<span style='color: red;'>الرجاء إدخال تاريخ ميلاد صالح.</span>";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>حاسبة العمر</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f0f2f5; display: grid; place-items: center; min-height: 90vh; }
        .container { background: #fff; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 30px; width: 400px; text-align: center; }
        h1 { margin-top: 0; color: #333; }
        label { font-size: 1.1em; margin-bottom: 10px; display: block; }
        input[type="date"] { width: 95%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; margin-bottom: 20px; font-size: 16px; }
        input[type="submit"] { background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        input[type="submit"]:hover { background-color: #0056b3; }
        #result { margin-top: 25px; font-size: 1.2em; font-weight: bold; min-height: 30px; }
    </style>
</head>
<body>

    <div class="container">
        <h1>حاسبة العمر الدقيقة</h1>
        
        <form action="index.php" method="POST">
            <label for="birthdate">أدخل تاريخ ميلادك:</label>
            <input type="date" id="birthdate" name="birthdate" required>
            <br>
            <input type="submit" value="احسب العمر">
        </form>

        <div id="result">
            <?php echo $result_message; ?>
        </div>
    </div>

</body>
</html>