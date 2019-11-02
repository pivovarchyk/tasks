<?php
declare(strict_types=1);

namespace OP\Tasks\Controller;

use OP\Tasks\Http\Request;
use OP\Tasks\Entity\Task;
use OP\Tasks\Entity\User;

class IndexController
{
    public function show(Request $request)
    {
        session_start();
        if ($request->getPost()['singin']) {
            $user = new User();
            $user = $user->authorization($request->getPost()['inputName'], $request->getPost()['inputPassword']);

            if ($user) {
                $request->setSession('admin', $request->getPost()['inputName']);
            } else {
                session_destroy();
            }
        }

        if ($request->getPost()['singout']) {
            session_destroy();
        }

        $tasks = new Task();
        if ($request->getPost()['savetask']) {
            $tasks->AddItem($request->getPost());
        }
        if ($request->getPost()['edittask']) {
            var_dump($request->getPost());
            $tasks->editItem($request->getPost());
        }
        //to former array content with tasks
        $sort = isset($request->getPost()['sort']) ? $request->getPost()['sort'] : 'name_desc';
        $blocksOfTasks = [];
        $blocksOfTasks = $tasks->getAllItems3($sort);

        if (isset($request->getSession()['admin'])) {
            $user = ['admin'=>$request->getSession()['admin']];
        } else {
            $user = ['guest' => ''];
        }
        // return content
        return [
            'params' =>
                [
                    'blocksOfTasks' => $blocksOfTasks,
                    'sort' => $sort,
                    'user' => $user
                ],
            'content' => 'userview.php'
        ];
    }
}
