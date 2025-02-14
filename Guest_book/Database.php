<?php
class Database
{
  private $connecion;

  public function __construct($config)
  {
    $this->connecion = new mysqli(
      $config['host'],
      $config['username'],
      $config['password'],
      $config['database']
    );

    if ($this->connecion->connect_error) {
      die("Помика підключення" . $this->connecion->connect_error);
    }
  }

  public function query($sql, $params = [])
  {
    $data = $this->connecion->prepare($sql);

    if ($params) {
      $types = str_repeat('s', count($params));
      $data->bind_param($types, ...$params);
    }
    $data->execute();
    return $data->get_result();
  }

  public function closeConnect()
  {
    $this->connecion->close();
  }

}