<?php
namespace OP\Tasks\Http;

class Response
{
    private $phrases = [
        // SUCCESS CODES
        200 => 'OK',
        // CLIENT ERROR
        400 => 'Bad Request',
        404 => 'Not Found',
    ];

    private $reasonPhrase;
    private $statusCode;
    private $content;
    private $params;

    public function __construct($content = '', $params = '',  $status = 200, array $headers = [])
    {
        $this->setStatusCode($status);
        $this->setContent($content);
        $this->setParams($params);
        $this->setHeaders($headers);
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getReasonPhrase()
    {
        return $this->reasonPhrase;
    }

    public function getBody()
    {
        return $this->content;
    }

    public function withStatus($code, $reasonPhrase = '')
    {
        $new = clone $this;
        $new->setStatusCode($code, $reasonPhrase);
        return $new;
    }

    private function setStatusCode($code, $reasonPhrase = '')
    {
        if ($reasonPhrase === '' && isset($this->phrases[$code])) {
            $reasonPhrase = $this->phrases[$code];
        }

        $this->reasonPhrase = $reasonPhrase;
        $this->statusCode = (int) $code;
    }

    private function setContent($content)
    {
      $this->content = $content;
    }

    private function setParams($params)
    {
      $this->params = $params;
    }

    private function setHeaders($headers)
    {
      $this->headers = $headers;
    }

    public function send()
    {
        extract($this->params);
        include('../templates/'.$this->content);
    }
}
