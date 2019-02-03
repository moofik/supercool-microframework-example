<?php

namespace App\Controller;

use App\DataSource\Task\Task;
use App\DataSource\Task\TaskRecord;
use App\Service\Authorization\Authorization;
use Atlas\Orm\Atlas;
use Moofik\Framework\Http\RedirectResponse;
use Moofik\Framework\Http\Request;
use Moofik\Framework\Http\Response;
use Moofik\Framework\Http\Session;
use Moofik\Framework\Template\ViewRenderer;

class TaskController
{
    /**
     * @param Atlas $atlas
     * @param Session $session
     * @param Authorization $authorization
     * @param ViewRenderer $renderer
     * @return Response
     */
    public function index(Atlas $atlas, Session $session, Authorization $authorization, ViewRenderer $renderer)
    {
        $tasks = $atlas
            ->select(Task::class)
            ->fetchRecordSet();

        $flashes = $session->getFlashData();
        $successMessage = $flashes['success'] ?? null;
        $errorMessage = $flashes['error'] ?? null;

        $content = $renderer->renderView('tasks.php', [
            'tasks' => $tasks,
            'successMessage' => $successMessage,
            'errorMessage' => $errorMessage,
            'isAdmin' => $authorization->isCurrentUserAdmin(),
        ]);

        return new Response($content, 200);
    }

    /**
     * @param ViewRenderer $renderer
     * @return Response
     */
    public function add(ViewRenderer $renderer)
    {
        $content = $renderer->renderView('add.php');

        return new Response($content);
    }

    /**
     * @param Request $request
     * @param Atlas $atlas
     * @param Session $session
     * @return RedirectResponse
     */
    public function create(Request $request, Atlas $atlas, Session $session)
    {
        $task = $atlas->newRecord(Task::class, [
            'author' => $request->get('author'),
            'email' => $request->get('email'),
            'description' => $request->get('description'),
            'is_completed' => $request->get('is_completed'),
        ]);

        $atlas->insert($task);

        $session->setFlashData(['success' => 'Задача успешно создана']);

        return new RedirectResponse('/');
    }

    /**
     * @param Authorization $authorization
     * @param Atlas $atlas
     * @param ViewRenderer $renderer
     * @param int $id
     * @return Response
     */
    public function edit(Authorization $authorization, Atlas $atlas, ViewRenderer $renderer, int $id)
    {
        if (!$authorization->isCurrentUserAdmin()) {
            return new RedirectResponse('/');
        }

        $task = $atlas
            ->select(Task::class)
            ->where('id = ', $id)
            ->fetchRecord();

        $content = $renderer->renderView('edit.php', ['task' => $task]);

        return new Response($content, 200);
    }

    /**
     * @param Request $request
     * @param Atlas $atlas
     * @param Authorization $authorization
     * @param Session $session
     * @param int $id
     * @return RedirectResponse
     */
    public function save(
        Request $request,
        Atlas $atlas,
        Authorization $authorization,
        Session $session,
        int $id
    ) {
        if ($authorization->isCurrentUserAdmin()) {
            /** @var TaskRecord $task */
            $task = $atlas
                ->select(Task::class)
                ->where('id = ', $id)
                ->fetchRecord();
            $task->description = $request->get('description');
            $task->is_completed = $request->get('is_completed') ? true : false;
            $atlas->update($task);

            $session->setFlashData(['success' => 'Задача успешно изменена']);
        }

        return new RedirectResponse('/');
    }
}