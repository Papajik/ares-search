<?php

namespace Papajik\AresSearch\Service;

use Papajik\Config\AppConfig;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mail
{
    private static ?Mail $instance = null;
    private PHPMailer $mailer;


    /**
     * @return Mail
     */
    public static function getInstance(): self
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $this->mailer = new PHPMailer(true);
        $this->mailer->isSMTP();
        $this->mailer->Host = AppConfig::MAIL_HOST;
        $this->mailer->Port = AppConfig::MAIL_PORT;
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = AppConfig::MAIL_USER;
        $this->mailer->Password = AppConfig::MAIL_PASS;

    }

    public function sendMail(string $to, string $subject, string $msg): string|bool
    {
        try {
            $this->mailer->setFrom(AppConfig::MAIL_SENDER);
            $this->mailer->addAddress($to);
            $this->mailer->Subject = $subject;
            $this->mailer->isHTML();
            $this->mailer->Body = $msg;
            if (!$this->mailer->send()) {
                return $this->mailer->ErrorInfo;
            }
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function getMailer(): PHPMailer
    {
        return $this->mailer;
    }
}