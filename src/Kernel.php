<?php
declare(strict_types=1);

namespace OP\Tasks;

use OP\Tasks\Http\Request;
use OP\Tasks\Http\Response;
use OP\Tasks\Controller\IndexController;

class Kernel
{
    public function handle(Request $request) : Response
    {
        $init = new IndexController();
        $content = $init->show($request);
        $response = new Response ($content['content'], $content['params']);
        return $response;
    }
}
