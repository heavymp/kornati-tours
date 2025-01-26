<?php

namespace App\Mail\Transport;

use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mime\MessageConverter;
use GuzzleHttp\Client;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;

class BrevoTransport extends AbstractTransport
{
    protected Client $client;
    protected string $key;

    public function __construct(Client $client, string $key)
    {
        parent::__construct();
        
        $this->client = $client;
        $this->key = $key;
    }

    protected function doSend(SentMessage $message): void
    {
        $email = MessageConverter::toEmail($message->getOriginalMessage());
        
        $payload = [
            'sender' => $this->getSender($email),
            'to' => $this->getRecipients($email->getTo()),
            'subject' => $email->getSubject(),
        ];

        if ($htmlBody = $email->getHtmlBody()) {
            $payload['htmlContent'] = $htmlBody;
        }

        if ($textBody = $email->getTextBody()) {
            $payload['textContent'] = $textBody;
        }

        if ($replyTo = $email->getReplyTo()) {
            $payload['replyTo'] = $this->getAddress(current($replyTo));
        }

        if ($cc = $email->getCc()) {
            $payload['cc'] = $this->getRecipients($cc);
        }

        if ($bcc = $email->getBcc()) {
            $payload['bcc'] = $this->getRecipients($bcc);
        }

        try {
            $response = $this->client->post('https://api.brevo.com/v3/smtp/email', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'api-key' => $this->key,
                ],
                'json' => $payload,
            ]);

            if ($response->getStatusCode() !== 201) {
                throw new \Exception('Failed to send email through Brevo API: ' . $response->getBody());
            }
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $errorBody = json_decode($response->getBody()->getContents(), true);
            throw new \Exception('Brevo API Error: ' . ($errorBody['message'] ?? 'Unknown error'));
        }
    }

    private function getSender(Email $email): array
    {
        $sender = $email->getFrom()[0];
        return $this->getAddress($sender);
    }

    private function getRecipients(array $recipients): array
    {
        return array_map([$this, 'getAddress'], $recipients);
    }

    private function getAddress(Address $address): array
    {
        return [
            'email' => $address->getAddress(),
            'name' => $address->getName() ?: '',
        ];
    }

    public function __toString(): string
    {
        return 'brevo';
    }
} 