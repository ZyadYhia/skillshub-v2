<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Slack\SlackMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Slack\BlockKit\Blocks\ActionsBlock;
use Illuminate\Notifications\Slack\BlockKit\Blocks\ContextBlock;
use Illuminate\Notifications\Slack\BlockKit\Blocks\SectionBlock;
use Illuminate\Notifications\Slack\BlockKit\Composites\ConfirmObject;

class MessageNotification extends Notification
{
    use Queueable;
    public string $receiver;
    public string $name;
    public string $email;
    public string $subject;
    public string $body;

    /**
     * Create a new notification instance.
     */
    public function __construct( string $receiver,  string $name,  string $email, string $subject, string $body)
    {
        $this->receiver = $receiver;
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail', 'slack'];
    }

    public function toSlack(object $notifiable): SlackMessage
    {
        $blocks = [
            [
                "type" => "header",
                "text" => [
                    "type" => "plain_text",
                    "text" => $this->subject,
                    "emoji" => true
                ]
            ],
            [
                "type" => "section",
                "text" => [
                    "type" => "mrkdwn",
                    "text" => "You have a new Message:\n*<fakeLink.toEmployeeProfile.com|$this->name- $this->email>*"
                ]
            ],
            [
                "type" => "section",
                "fields" => [
                    [
                        "type" => "mrkdwn",
                        "text" => "*Type:*\nComputer (laptop)"
                    ],
                    [
                        "type" => "mrkdwn",
                        "text" => "*When:*\nSubmitted Aut 10"
                    ],
                    [
                        "type" => "mrkdwn",
                        "text" => "*Last Update:*\nMar 10, 2015 (3 years, 5 months)"
                    ],
                    [
                        "type" => "mrkdwn",
                        "text" => "*Reason:*\nAll vowel keys aren't working."
                    ],
                    [
                        "type" => "mrkdwn",
                        "text" => "*Specs:*\n\"Cheetah Pro 15\" - Fast, really fast"
                    ]
                ]
            ],
            [
                "type" => "actions",
                "elements" => [
                    [
                        "type" => "button",
                        "text" => [
                            "type" => "plain_text",
                            "emoji" => true,
                            "text" => "Approve"
                        ],
                        "style" => "primary",
                        "value" => "click_me_123"
                    ],
                    [
                        "type" => "button",
                        "text" => [
                            "type" => "plain_text",
                            "emoji" => true,
                            "text" => "Deny"
                        ],
                        "style" => "danger",
                        "value" => "click_me_123"
                    ]
                ]
            ]
        ];

        $template = json_encode(['blocks' => $blocks], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        return (new SlackMessage)
            // ->to('#skillshub-app')
            ->usingBlockKitTemplate($template);
    }


    // public function toSlack(object $notifiable): SlackMessage
    // {
    //     return (new SlackMessage)
    //         ->to('#skillshub-app')
    //         ->text('New message from ' . $this->name)
    //         ->headerBlock($this->subject)
    //         ->sectionBlock(function (SectionBlock $block) {
    //             $block->text('A New message has been received from ' . $this->name);
    //             $block->field("*Name:*\n$this->name")->markdown();
    //             $block->field("*Email:*\nt$this->email")->markdown();
    //         })
    //         ->dividerBlock()
    //         ->sectionBlock(function (SectionBlock $block) {
    //             $block->text($this->body);
    //         })
    //         ->dividerBlock()
    //         ->sectionBlock(function (SectionBlock $block) {
    //             $block->text('Please keep in touch!');
    //         });
    // }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject($this->subject)
            ->greeting('Hello ' . $this->receiver)
            ->line('You have received a new message from ' . $this->name)
            ->line('Email: ' . $this->email)
            ->line('Message: ' . $this->body);
    }

    public function toArray(object $notifiable): array
    {
        return [
            'name' => $notifiable->name,
            'email' => $notifiable->email,
            'subject' => $notifiable->subject,
            'body' => $notifiable->body,
        ];
    }
}
