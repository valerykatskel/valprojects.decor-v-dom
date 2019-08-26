<?php
  // User settings
  $to = "apprt78@gmail.com";
  $sitename = "http://decor-v-dom.ru";
  
  $subject = "Заказ телефонного звонка с сайта $sitename";

  $name = isset($_POST["name"]) ? $_POST["name"] : "<Пустое имя>";
  $phone = isset($_POST["phone"]) ? $_POST["phone"] : "<Пустой номер телефона>";
  $time = isset($_POST["time"]) ? $_POST["time"] : "<Время не указано>";

  // Filter and validate fields
  $name = smcf_filter($name);
  $phone = smcf_filter($phone);
  $time = smcf_filter($time);

  $message = "<strong>Имя пользователя: </strong>" . $name . ".<br/><strong>Номер телефона:</strong> " . $phone . ".<br/> <strong>Желаемое время звонка:</strong> " . $time . ".";

  // Set and wordwrap message body
  $body .= "$message";

  // Build header
  $headers = "From: $email\n";
  $headers .= "X-Mailer: PHP/SimpleModalContactForm";

  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

  // Send email
  if (mail($to, $subject, $body, $headers)) {
    print '<div class="form-success"><p>Ваша заявка</p><p>успешно отправлена</p><span>Наши менеджеры свяжутся с вами в ближайшее время.</span></div>';
  } else {
    print '<div class="form-success"><p>Ошибка отправки сообщения</p><span>Мы знаем о проблеме и исправляем ее! Попробуйте позже.</span></div>';
  }

  // Remove any un-safe values to prevent email injection
  function smcf_filter($value) {
    $pattern = array("/\n/","/\r/","/content-type:/i","/to:/i", "/from:/i", "/cc:/i");
    $value = preg_replace($pattern, "", $value);
    return $value;
  }

?>