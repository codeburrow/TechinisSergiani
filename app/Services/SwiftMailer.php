<?php
/**
 * Created by PhpStorm.
 * User: antony
 * Date: 7/11/16
 * Time: 2:02 PM
 */
namespace Kourtis\Services;

use Swift_Mailer;
use Swift_Message;
use Swift_RfcComplianceException;
use Swift_SmtpTransport;

class SwiftMailer
{
    public function __construct()
    {
    }

    public function sendEmail($data)
    {
        $result = array();

        //Check if $_POST is empty and sanitize
        $name = $data['fullName'];
        $email = $data['email'];
        $subject = $data['subject'];
        $message = $data['message'];

        if(!empty($name) && !empty($email) && !empty($message) && !empty($subject)) {
            $cleanName = filter_var($name, FILTER_SANITIZE_STRING);
            $cleanEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
            $cleanMessage = filter_var($message, FILTER_SANITIZE_STRING);
            $cleanSubject = filter_var($subject, FILTER_SANITIZE_STRING);
        } else {
            $result['success'] = 0;
            $result['message'] = "Error: You need to fill in all the fields.";

            return $result;
        }

        // Create the Transport
        $transport = Swift_SmtpTransport::newInstance('mail.texnisergiani.gr')
			->setUsername(getenv('EMAIL'))
			->setPassword(getenv('EMAIL_PASS'))
        ;

        // Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);

        try {
            // Create the message
            $message = Swift_Message::newInstance()
                // Give the message a subject
                ->setSubject('texnisergiani.gr: ' . $cleanSubject)
                // Set the From address with an associative array
                ->setFrom(array($cleanEmail => $cleanName))
                // Set the To addresses with an associative array
                ->setTo(array( getenv('EMAIL') => 'Texnis Sergiani Support Team'))
                // Give it a body
                ->setBody("Sender's Email: " . $cleanEmail . "\n\n" . $cleanMessage);

            // Optionally add any attachments
//			->attach(Swift_Attachment::fromPath('my-document.pdf'))

            // Send the message
            /**
             * @var \Swift_Mime_Message $message
             */
            $messageSent = $mailer->send($message);

        } catch (Swift_RfcComplianceException $e ) {
            $result['success'] = 0;
            $result['message'] = $e->getMessage();

            return $result;
        }

        //Confirm Email Sent
        if ($messageSent > 0){
            $result['success'] = 1;
            $result['message'] = "Ευχαριστουμε για την επικοινωνια.\n Θα σας απαντησουμε συντομα.";

            return $result;
        } else {
            $result['success'] = 0;
            $result['message'] = "Σφαλμα. Κατι δεν πηγε καλα. \n Παρακαλω επικοινωνηστε μαζι μας στο 'support@texnisergiani.gr'.";

            return $result;
        }
    }

    public function sendEmailForComppetition($data)
    {
        $result = array();

        //Check if $_POST is empty and sanitize
        $firstName = $data['firstName'];
        $lastName = $data['lastName'];
        $email = $data['email'];
        $mobile = $data['mobile'];

        if(!empty($firstName) && !empty($lastName) && !empty($email) && !empty($mobile)) {
            $cleanFirstName = filter_var($firstName, FILTER_SANITIZE_STRING);
            $cleanLastName = filter_var($lastName, FILTER_SANITIZE_STRING);
            $cleanEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
            $cleanMobile = filter_var($mobile, FILTER_SANITIZE_NUMBER_INT);
        } else {
            $result['success'] = 0;
            $result['message'] = "Error: You need to fill in all the fields.";

            return $result;
        }

        // Create the Transport
        $transport = Swift_SmtpTransport::newInstance('mail.texnisergiani.gr')
            ->setUsername(getenv('EMAIL'))
            ->setPassword(getenv('EMAIL_PASS'))
        ;

        // Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);

        try {
            // Create the message
            $message = Swift_Message::newInstance()
                // Give the message a subject
                ->setSubject('texnisergiani.gr: Competition') //ToDo: Name of competition
                // Set the From address with an associative array
                ->setFrom(array($cleanEmail => $cleanFirstName . ' ' .$cleanLastName))
                // Set the To addresses with an associative array
                ->setTo(array( getenv('EMAIL') => 'Texnis Sergiani Support Team'))
                // Give it a body
                ->setBody("Sender's Email: " . $cleanEmail . "\n\n" . 'Αριθμός τηλεφώνου: ' . $cleanMobile . "\n\n" . 'ID διαγωνισμού: ' . $_POST['postID'] . "\n\n" . 'Τίτλος Διαγωνισμού: ' . $_POST['postTitle'] );

            // Optionally add any attachments
//			->attach(Swift_Attachment::fromPath('my-document.pdf'))

            // Send the message
            /**
             * @var \Swift_Mime_Message $message
             */
            $messageSent = $mailer->send($message);

        } catch (Swift_RfcComplianceException $e ) {
            $result['success'] = 0;
            $result['message'] = $e->getMessage();

            return $result;
        }

        //Confirm Email Sent
        if ($messageSent > 0){
            $result['success'] = 1;
            $result['message'] = "Ευχαριστουμε για την επικοινωνια.\n Η συμμετοχη σας είναι εγκυρη.";

            return $result;
        } else {
            $result['success'] = 0;
            $result['message'] = "Σφαλμα. Κατι δεν πηγε καλα. \n Παρακαλω επικοινωνηστε μαζι μας στο 'support@texnisergiani.gr'.";

            return $result;
        }
    }

    public function sendEmailToSupport($data)
    {
        $result = array();

        //Check if $_POST is empty and sanitize
        $mobile = $data['mobile'];
        $subject = $data['subject'];
        $message = $data['message'];

        if(!empty($mobile) && !empty($message) && !empty($subject)) {
            $cleanMessage = filter_var($message, FILTER_SANITIZE_STRING);
            $cleanSubject = filter_var($subject, FILTER_SANITIZE_STRING);
        } else {
            $result['success'] = 0;
            $result['message'] = "Error: You need to fill in all the fields.";

            return $result;
        }

        // Create the Transport
        $transport = Swift_SmtpTransport::newInstance('mail.texnisergiani.gr')
			->setUsername(getenv('MAIL'))
			->setPassword(getenv('MAIL_PASS'))
        ;

        // Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);

        try {
            // Create the message
            $message = Swift_Message::newInstance()
                // Give the message a subject
                ->setSubject('Email from texnisergiani.gr: ' . $cleanSubject)
                // Set the From address with an associative array
                ->setFrom(array( getenv('MAIL') => 'Alex Kourtis'))
                // Set the To addresses with an associative array
                ->setTo(array('support@codeburrow.com' => 'CodeBurrow Support Team'))
                // Give it a body
                ->setBody($cleanMessage . "\n\nMobile Number: " . $mobile);

            // Optionally add any attachments
//			->attach(Swift_Attachment::fromPath('my-document.pdf'))

            // Send the message
            /**
             * @var \Swift_Mime_Message $message
             */
            $messageSent = $mailer->send($message);

        } catch (Swift_RfcComplianceException $e ) {
            $result['success'] = 0;
            $result['message'] = $e->getMessage();

            return $result;
        }

        //Confirm Email Sent
        if ($messageSent > 0){
            $result['success'] = 1;
            $result['message'] = "Thank you for your email.\n We'll be in touch soon.";

            return $result;
        } else {
            $result['success'] = 0;
            $result['message'] = "Error: We couldn't send your email. \n Please contact us at 'support@codeburrow.com'.";

            return $result;
        }
    }


}