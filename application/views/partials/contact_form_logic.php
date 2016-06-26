<?php
if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $human = intval($_POST['human']);
    $from = 'Formularz kontaktowy';
    $to = 'example@domain.com';
    $subject = 'Wiadomość kontaktowa wysłana z bloga';

    $body ="From: $name\n E-Mail: $email\n Message:\n $message";
    if (!$_POST['name']) {
        $errName = 'Proszę wprowadzić imię';
    }

    if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errEmail = 'Proszę wprowadzić adres e-mail';
    }

    if (!$_POST['message']) {
        $errMessage = 'Proszę wprowadzić tekst wiadomości';
    }

    if ($human !== 5) {
        $errHuman = 'Zła odpowiedź!';
    }

    if (!$errName && !$errEmail && !$errMessage && !$errHuman) {
        if (mail ($to, $subject, $body, $from)) {
            $result='<div class="alert alert-success">Dziękuję za wysłanie wiadomości!</div>';
        } else {
            $result='<div class="alert alert-danger">Przepraszam, ale pojawił się jakiś problem z wysłaniem wiadomości. Proszę spróbować ponownie później.</div>';
        }
    }
}