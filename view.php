<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>حاسبة العمر الاحترافية</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <div class="card">
            <h1>حاسبة العمر الاحترافية</h1>
            <p class="subtitle">أدخل تاريخ ميلادك وشاهد تحليل دقيق لعمرك.</p>
            
            <form action="index.php" method="POST">
                <label for="birthdate">تاريخ الميلاد:</label>
                <input type="date" id="birthdate" name="birthdate" value="<?php echo htmlspecialchars($_POST['birthdate'] ?? ''); ?>" required>
                <button type="submit">احسب الآن</button>
            </form>

            <?php // --- منطقة عرض النتائج --- ?>

            <?php if ($error_message): ?>
                <div class="result-box error">
                    <p><?php echo $error_message; ?></p>
                </div>
            <?php endif; ?>

            <?php if ($result_data): ?>
                <div class="result-box success">
                    <h2>عمرك الحالي:</h2>
                    <div class="age-display">
                        <span><strong><?php echo $result_data['years']; ?></strong> سنة</span>
                        <span><strong><?php echo $result_data['months']; ?></strong> شهر</span>
                        <span><strong><?php echo $result_data['days']; ?></strong> يوم</span>
                    </div>
                    
                    <hr>
                    
                    <div class="birthday-countdown">
                        <?php if ($result_data['next_birthday_days'] == 0): ?>
                            <h3>🎉 عيد ميلاد سعيد!</h3>
                        <?php else: ?>
                            <h3>عيد ميلادك القادم بعد:</h3>
                            <p><strong><?php echo $result_data['next_birthday_days']; ?></strong> يوم</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>

</body>
</html>