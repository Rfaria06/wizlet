<?php

namespace App\Services;

use App\Models\Flashcard;
use OpenAI;
use OpenAI\Client;
use RuntimeException;
use Str;

readonly final class OpenAIService
{
    private const JSON_SCHEMA = [
        "type" => "object",
        "properties" => [
            "flashcards" => [
                "type" => "array",
                "minItems" => 15,
                "maxItems" => 15,
                "items" => [
                    "type" => "object",
                    "properties" => [
                        "question" => [
                            "type" => "string",
                            "description" => "A clear, concise question",
                        ],
                        "answer" => [
                            "type" => "string",
                            "description" => "A short, correct answer",
                        ],
                    ],
                    "required" => ["question", "answer"],
                    "additionalProperties" => false,
                ],
            ],
        ],
        "required" => ["flashcards"],
        "additionalProperties" => false,
    ];

    private string $promptTemplate;

    private Client $client;

    public function __construct()
    {
        $this->promptTemplate = config("openai.prompt");
        $apiKey = Str::of(config("openai.key"))->toString();
        $this->client = OpenAI::client($apiKey);
    }

    /**
     * Creates exactly 15 flashcards using the user's prompt.
     *
     * @param  string  $userPrompt  The user's prompt
     * @return \Illuminate\Support\Collection<\App\Models\Flashcard>
     */
    public function createFlashcards(string $userPrompt)
    {
        $prompt = $this->promptTemplate . $userPrompt;

        $response = $this->client->responses()->create([
            "model" => "gpt-4o-mini",
            "input" => $prompt,
            "text" => [
                "format" => [
                    "type" => "json_schema",
                    "strict" => true,
                    "schema" => self::JSON_SCHEMA,
                    "name" => "flashcards",
                ],
            ],
        ]);

        $json = $response->output[0]->content[0]->text ?? null;

        if (!$json) {
            throw new RuntimeException("No content returned from OpenAI API");
        }

        $data = json_decode($json, true, flags: JSON_THROW_ON_ERROR);

        return collect($data["flashcards"])->map(function ($flashcard) {
            $model = new Flashcard();
            $model->question = $flashcard["question"];
            $model->answer = $flashcard["answer"];

            return $model;
        });
    }
}
