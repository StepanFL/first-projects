<?php
header('Content-Type: application/json');

require_once 'Chat.php';

$chat = new Chat();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === "POST") {
  $name = trim($_POST['name'] ?? '');
  $message = trim($_POST['message'] ?? '');

  if (empty($name)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Ім\'я не може бути порожнім'], JSON_UNESCAPED_UNICODE);
    exit;
  }

  if (mb_strlen($name) > 50) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Ім\'я не повинно перевищувати 50 символів'], JSON_UNESCAPED_UNICODE);
    exit;
  }

  if (empty($message)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Повідомлення не може бути порожнім'], JSON_UNESCAPED_UNICODE);
    exit;
  }

  if (mb_strlen($message) > 500) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Повідомлення не повинно перевищувати 500 символів'], JSON_UNESCAPED_UNICODE);
    exit;
  }

  $name = strip_tags($name);
  $message = strip_tags($message);

  if ($chat->postMessage($name, $message)) {
    http_response_code(201);
    echo json_encode(['status' => 'success', 'message' => 'Повідомлення надіслано'], JSON_UNESCAPED_UNICODE);
  } else {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Не вдалося надіслати повідомлення'], JSON_UNESCAPED_UNICODE);
  }

} elseif ($method === "GET") {
  $messages = $chat->getMessage();
  http_response_code(200);
  echo json_encode(['status' => 'success', 'messages' => $messages], JSON_UNESCAPED_UNICODE);

} else {
  http_response_code(405);
  echo json_encode(['status' => 'error', 'message' => 'Непідтримуваний метод'], JSON_UNESCAPED_UNICODE);
}
