<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Генератор рахунків</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Генератор рахунків</h1>

    <form action="generate.php" method="POST" enctype="multipart/form-data">
        <label for="invoice_number">Номер рахунку:</label>
        <input type="text" id="invoice_number" name="invoice_number" required><br>

        <label for="date">Дата:</label>
        <input type="text" id="date" name="date" placeholder="ДД-ММ-РРРР" required><br>

        <label for="amount">Сума:</label>
        <input type="number" id="amount" name="amount" required><br>

        <label for="description">Опис:</label>
        <textarea id="description" name="description" rows="4" required></textarea><br>

        <label for="company_address">Адреса компанії:</label>
        <input type="text" id="company_address" name="company_address" required><br>

        <input type="submit" value="Генерувати рахунок">
    </form>

</body>
</html>
