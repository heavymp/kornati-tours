<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use Dotenv\Dotenv;

class EmailSettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Email Settings';
    protected static ?int $navigationSort = 1;
    protected static string $view = 'filament.pages.email-settings';
    protected static ?string $title = 'Email Configuration';

    public ?string $mail_mailer = 'brevo';
    public ?string $brevo_key = null;
    public ?string $mail_from_address = null;
    public ?string $mail_from_name = null;
    public ?string $test_email = null;

    public function mount(): void
    {
        $this->brevo_key = config('mail.mailers.brevo.key');
        $this->mail_from_address = config('mail.from.address');
        $this->mail_from_name = config('mail.from.name');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Brevo API Configuration')
                    ->description('Configure your Brevo API settings')
                    ->schema([
                        TextInput::make('brevo_key')
                            ->label('Brevo API Key')
                            ->required()
                            ->password()
                            ->hint('Get your API key from Brevo dashboard > Settings > API Keys & IDs > Create a New API Key')
                            ->hintIcon('heroicon-m-question-mark-circle'),
                        TextInput::make('mail_from_address')
                            ->label('From Address')
                            ->email()
                            ->required(),
                        TextInput::make('mail_from_name')
                            ->label('From Name')
                            ->required(),
                        \Filament\Forms\Components\Actions::make([
                            \Filament\Forms\Components\Actions\Action::make('save')
                                ->label('Save Settings')
                                ->action(function () {
                                    try {
                                        $this->updateEnvironmentFile([
                                            'MAIL_MAILER' => $this->mail_mailer,
                                            'BREVO_KEY' => $this->brevo_key,
                                            'MAIL_FROM_ADDRESS' => $this->mail_from_address,
                                            'MAIL_FROM_NAME' => $this->mail_from_name,
                                        ]);

                                        // Update the configuration immediately after saving
                                        config([
                                            'mail.mailers.brevo.key' => $this->brevo_key,
                                            'mail.from.address' => $this->mail_from_address,
                                            'mail.from.name' => $this->mail_from_name,
                                            'mail.default' => 'brevo'
                                        ]);

                                        Notification::make()
                                            ->title('Email settings saved successfully!')
                                            ->success()
                                            ->send();
                                    } catch (\Exception $e) {
                                        Notification::make()
                                            ->title('Failed to save settings')
                                            ->body($e->getMessage())
                                            ->danger()
                                            ->send();
                                    }
                                })
                                ->color('primary')
                                ->icon('heroicon-m-check'),
                        ]),
                    ]),

                Section::make('Test Email')
                    ->description('Send a test email to verify your configuration')
                    ->schema([
                        TextInput::make('test_email')
                            ->label('Test Email Address')
                            ->email()
                            ->placeholder('Enter email address to send test'),
                        \Filament\Forms\Components\Actions::make([
                            \Filament\Forms\Components\Actions\Action::make('test')
                                ->label('Send Test Email')
                                ->action(fn () => $this->sendTestEmail())
                                ->color('success')
                                ->icon('heroicon-m-paper-airplane'),
                        ]),
                    ]),
            ]);
    }

    protected function sendTestEmail(): void
    {
        if (!$this->test_email) {
            Notification::make()
                ->title('Please enter a test email address')
                ->danger()
                ->send();
            return;
        }

        try {
            // Force configuration update before sending
            config([
                'mail.mailers.brevo.key' => $this->brevo_key,
                'mail.from.address' => $this->mail_from_address,
                'mail.from.name' => $this->mail_from_name,
                'mail.default' => 'brevo'
            ]);

            Mail::raw('This is a test email from Kornati Tours.', function ($message) {
                $message->to($this->test_email, 'Test Recipient')
                    ->subject('Test Email from Kornati Tours');
            });

            Notification::make()
                ->success()
                ->title('Test email sent successfully!')
                ->body('Please check your inbox.')
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->danger()
                ->title('Failed to send test email')
                ->body($e->getMessage())
                ->send();

            // Log the error for debugging
            \Log::error('Email sending failed: ' . $e->getMessage(), [
                'error' => $e,
                'mailer' => config('mail.default'),
                'from_address' => config('mail.from.address'),
            ]);
        }
    }

    protected function updateEnvironmentFile(array $values): void
    {
        $path = base_path('.env');
        $content = file_get_contents($path);

        foreach ($values as $key => $value) {
            // Check if value contains spaces or special characters
            $needsQuotes = strpos($value, ' ') !== false || preg_match('/[^A-Za-z0-9_.-]/', $value);
            
            if ($needsQuotes) {
                // Escape any existing quotes and wrap in quotes
                $value = '"' . str_replace('"', '\\"', $value) . '"';
            }
            
            // Check if the key exists in the file
            if (preg_match("/^{$key}=/m", $content)) {
                // Update existing key
                $content = preg_replace(
                    "/^{$key}=.*/m",
                    "{$key}={$value}",
                    $content
                );
            } else {
                // Add new key at the end of the file
                $content .= PHP_EOL . "{$key}={$value}";
            }
        }

        // Create a backup of the current .env
        copy($path, $path . '.backup');

        try {
            file_put_contents($path, $content);
            
            // Test if the new .env is valid
            Dotenv::createImmutable(base_path())->load();
            
            // If successful, clear config cache
            Artisan::call('config:clear');
        } catch (\Exception $e) {
            // If there's an error, restore the backup
            copy($path . '.backup', $path);
            throw $e;
        } finally {
            // Clean up backup
            if (file_exists($path . '.backup')) {
                unlink($path . '.backup');
            }
        }
    }

    protected function getFormActions(): array
    {
        return [];
    }
} 