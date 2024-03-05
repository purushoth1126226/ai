<?php

namespace App\Ai;

use Illuminate\Support\Facades\Http;

class Chat
{
    protected array $message = [];

    public function send(string $message): string
    {

        // $message = [
        //     [
        //         "role" => "system",
        //         "content" => "You are a poetic assistant, skilled in explaining complex programming concepts with creative flair.",
        //     ],
        //     [
        //         "role" => "user",
        //         "content" => "Compose a poem that explains the concept of recursion in programming.",
        //     ],
        // ];

        $this->message[] = [
            'role' => 'user',
            'content' => $message,
        ];

        $response = Http::withToken(config('services.openai.secret'))
            ->post('https://api.openai.com/v1/chat/completions',
                [
                    "model" => "gpt-3.5-turbo",
                    "messages" => $this->message,
                ])
            ->json('choices.0.message.content');

        $this->assistance[] = [
            'role' => 'user',
            'content' => $response,
        ];

        return $response;
    }

    public function message()
    {
        return $this->message();
    }

}
