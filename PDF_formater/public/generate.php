<?php
require '../vendor/autoload.php'; // Підключення бібліотеки TCPDF


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Обробка даних з форми
    $invoiceNumber = htmlspecialchars($_POST['invoice_number']);
    $date = htmlspecialchars($_POST['date']);
    $amount = htmlspecialchars($_POST['amount']);
    $description = htmlspecialchars($_POST['description']);
    $companyAddress = htmlspecialchars($_POST['company_address']);

    // Форматування дати
    $date = DateTime::createFromFormat('d-m-Y', $date);
    if (!$date) {
        die("Невірний формат дати. Використовуйте ДД-ММ-РРРР.");
    }
    $formattedDate = $date->format('d-m-Y');

    // Створення PDF за допомогою TCPDF
    $pdf = new TCPDF();
    $pdf->AddPage();


    // Додавання контенту
    $html = "<h1>Рахунок-фактура</h1>";
    $html .= "<p><strong>Номер рахунку:</strong> $invoiceNumber</p>";
    $html .= "<p><strong>Дата:</strong> $formattedDate</p>";
    $html .= "<p><strong>Сума:</strong> $amount</p>";
    $html .= "<p><strong>Опис:</strong> $description</p>";
    $html .= "<p><strong>Адреса компанії:</strong> $companyAddress</p>";

    // Генерація PDF
    $pdf->writeHTML($html);
    $pdf->Output('invoice.pdf', 'I'); // Виведення PDF на екран
}
?>
