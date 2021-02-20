<?php

namespace Mook\Core\Http;

use Mook\Core\Model;

final class MoodleRequest
{
    private $key;

    private $action;

    private $data = [];

    public function __construct(string $key, string $action)
    {
        $this->key = $key;
        $this->action = $action;
    }

    public function key(): string
    {
        return $this->key;
    }

    public function action(): string
    {
        return $this->action;
    }

    public function data(array $data)
    {
        $this->data = $data;
        return $this;
    }

    public function body(): array
    {
        return [
            $this->key => collect($this->data)->map(function($item) {
                if ($item instanceof Model) {
                    return $item->mapToRequest();
                }
                return $item;
            })->toArray()
        ];
    }
}