<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Log;

class TestEmail extends Command
{
    protected $signature = 'email:test {email? : The email address to send the test to}';
    protected $description = 'Send a test email to verify SMTP configuration';

    public function handle()
    {
        $email = $this->argument('email') ?? 'soporte@redgia.org';
        $this->info('Attempting to send test email to: ' . $email);
        
        try {
            // Activar el modo debug para SMTP
            config(['mail.mailers.smtp.debug' => true]);
            
            $this->info('Using SMTP configuration:');
            $this->info('Host: ' . config('mail.mailers.smtp.host'));
            $this->info('Port: ' . config('mail.mailers.smtp.port'));
            $this->info('Encryption: ' . config('mail.mailers.smtp.encryption'));
            $this->info('From Address: ' . config('mail.from.address'));
            
            Mail::raw('This is a test email from your Laravel application sent at ' . now(), function (Message $message) use ($email) {
                $message->to($email)
                        ->subject('Test Email ' . now());
                
                // Log los detalles del mensaje
                Log::info('Email details:', [
                    'to' => $email,
                    'from' => config('mail.from.address'),
                    'subject' => 'Test Email ' . now()
                ]);
            });
            
            $this->info('Test email sent successfully!');
            $this->info('Please check both inbox and spam folders.');
            
        } catch (\Exception $e) {
            $this->error('Error sending email: ' . $e->getMessage());
            $this->error('Full error: ' . $e->getTraceAsString());
            Log::error('Email sending failed:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
}
