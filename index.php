<?php


function calculateAgeDetails(string $birthdate_string): array|string
{
    try {
        $birthdate_obj = new DateTime($birthdate_string);
        $today_obj = new DateTime('today');

        // التحقق من تاريخ المستقبل
        if ($birthdate_obj > $today_obj) {
            return "لا يمكن أن يكون تاريخ الميلاد في المستقبل.";
        }

        // 1. حساب العمر
        $age_interval = $today_obj->diff($birthdate_obj);
        
        // 2. حساب عيد الميلاد القادم
        $next_birthday = new DateTime(date('Y') . '-' . $birthdate_obj->format('m-d'));
        // إذا كان عيد الميلاد هذا العام قد فات  احسب للعام القادم
        if ($next_birthday < $today_obj) {
            $next_birthday->modify('+1 year');
        }
        
        $days_to_birthday = $today_obj->diff($next_birthday)->days;


        return [
            'years' => $age_interval->y,
            'months' => $age_interval->m,
            'days' => $age_interval->d,
            'next_birthday_days' => $days_to_birthday
        ];

    } catch (Exception $e) {
        return "الرجاء إدخال تاريخ ميلاد صالح.";
    }
}


$result_data = null;
$error_message = '';


if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['birthdate'])) {
    
    $birthdate = $_POST['birthdate'];
    $result = calculateAgeDetails($birthdate);

   
    if (is_array($result)) {
        $result_data = $result;
    } else {
        $error_message = $result;
    }
}


include 'view.php';