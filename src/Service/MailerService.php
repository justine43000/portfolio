<?php
// src/Service/EmailService.php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    private $mailer;
    private $from;

    public function __construct(MailerInterface $mailer, string $from)
    {
        $this->mailer = $mailer;
        $this->from = $from;
    }

    public function sendEmail(Email $email, string $subject, string $to)
    {
        $email->subject($subject);
        $email->to($to);
        $email->from($this->getFromEmail());
        $this->mailer->send($email);
    }

    public function getFromEmail(): string
    {
        return $this->from;
    }
}
