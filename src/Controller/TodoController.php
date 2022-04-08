<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Repository\TodoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/api/todo", name="api_todo")
 */
class TodoController extends AbstractController
{
    private $entityManager;
    private $todoRepository;
    public function __construct(EntityManagerInterface $entityManager, TodoRepository $todoRepository)
    {
        $this->entityManager = $entityManager;
        $this->todoRepository = $todoRepository;
    }


    // Create function where the user will be able to add in information to the database.

    /**
     * @Route("/create", name="api_todo_create", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $content = json_decode($request->getContent());

        $todo = new Todo();

        $todo->setName($content->name);

        try {
            $this->entityManager->persist($todo);
            $this->entityManager->flush();
            return $this->json([
                'todo' => $todo->toArray(),
            ]);

        } catch (Exception $exception) {
            //error
        }
        return;
    }

    // read function so that it allows the user to read the contents of the database.
    /**
     * @Route("/read", name="api_todo_read", methods={"GET"})
     */
    public function read()
    {
        $todos = $this->todoRepository->findAll();

        $arrayOfTodos = [];
        foreach ($todos as $todo) {
            $arrayOfTodos[] = $todo->toArray();
        }
        return $this->json($arrayOfTodos);

    }

    // update function allows the user to change the contents of the database.

    /**
     * @Route("/update/{id}", name="api_todo_update", methods={"PUT"})
     * @param Request $request
     * @param Todo $todo
     * @return JsonResponse
     */
    public function update(Request $request, Todo $todo)
    {
        $content = json_decode($request->getContent());

        $todo->setName($content->name);

        try {
            $this->entityManager->flush();
        } catch (Exception $exception) {
            //error
        }

        return $this->json([
            'message' => 'todo has been updated'
        ]);

    }



    // Delete function allows user to delete content.

    /**
     * @Route("/delete/{id}", name="api_todo_delete", methods={"DELETE"})
     * @param Todo $todo
     * @return JsonResponse
     */
    public function delete(Todo $todo)
    {
        try {
            $this->entityManager->remove($todo);
            $this->entityManager->flush();
        } catch (Exception $exception) {
            return $this->json([
                'message' => ['text' => 'Could not reach database when attempting to delete a To-Do.', 'level' => 'error']
            ]);

        }

        return $this->json([
            'message' => ['text' => 'Task has successfully been deleted!', 'level' => 'success']
        ]);

    }


}