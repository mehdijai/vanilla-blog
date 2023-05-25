<?php
require 'ValidationTrait.php';

class Validator
{
    use ValidationTrait;

    private $messages = [];
    private $requirements;
    private $validated = [];

    public function __construct(array $requirements)
    {
        $this->requirements = $requirements;
    }

    public function validate($values)
    {
        foreach ($values as $key => $value) {
            if(!isset($this->requirements[$key])){
                return;
            }
            $reqs = $this->requirements[$key];
            foreach ($reqs as $req) {
                $method = $this->parseRequirement($req);
                if (empty($method['args'])) {
                    if (call_user_func_array([$this, $method['method']], [$value]) == false) {
                        $this->setMessage($method['method'], $key, []);
                        return;
                    }
                } else {
                    if (call_user_func_array([$this, $method['method']], [$value, ...$method['args']]) == false) {
                        $this->setMessage($method['method'], $key, $method['args']);
                        return;
                    }
                }
            }

            $this->validated[$key] = $value;
        }
    }

    public function validated()
    {
        return $this->validated;
    }

    public function isValid(){
        return empty($this->messages);
    }

    private function parseRequirement(string $req)
    {
        $payload = [
            'method' => null,
            'args' => []
        ];
        if (strpos($req, ':') == false) {
            $payload = [
                'method' => $req,
                'args' => []
            ];
        } else {
            $splitted = explode(':', $req);
            $payload['method'] = $splitted[0];
            if (strpos($splitted[1], ',') != false) {
                $payload['args'] = explode(',', $splitted[1]);
            } else {
                array_push($payload['args'], $splitted[1]);
            }
        }

        return $payload;
    }

    public function getMessages()
    {
        return $this->messages;
    }
}
