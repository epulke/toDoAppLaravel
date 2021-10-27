<?php

namespace App\Http\Controllers;

use App\Models\Repositories\MySqlTasksRepository;
use App\Models\Repositories\TasksRepository;
use App\Models\Task;
use App\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class TasksController extends Controller
{
    private MySqlTasksRepository $repository;

    public function __construct(MySqlTasksRepository $repository)
    {
        $this->repository = $repository;
    }

    public function showTasks()
    {
        $tasks = $this->repository->downloadTasks();

        if (isset($_SESSION["userName"])) {
            $user = "Hello, " . $_SESSION["userName"] . "!";
        } else {
            $user = "";
        }

        return view("tasks", ["tasks" => $tasks->getTasks(), "user" => $user]);
    }

    public function store(Request $request)
    {
        $request->input("description");
        $request->input("id");
    }

    public function addNewTask(Request $request)
    {
        $post = $request->post();
        if (isset($post["submit"])) {
            $this->repository->uploadNewTask($post["number"], $post["description"]);
        }
        //TODO jāsaprot kā tas laravel redirect strādā
//        Route::redirect("/tasks" );
        Redirect::url("/tasks");
    }

    public function showSelectedTask(Request $request, $id)
    {
        //TODO pielikt useri klāt
//        if (isset($_SESSION["userName"])) {
//            $user = "Hello, " . $_SESSION["userName"] . "!";
//        } else {
//            $user ="";
//        }

        $user = "";

        $search = $this->repository
            ->searchTask((int)$request->get("numberSearch"));
        return view("taskedit", ["search" => $search, "user" => $user]);
    }

    public function editTask()
    {   //TODO to finish this method
        $search = $this->repository
            ->editTask((int)$_POST["editNumber"], $_POST["description"]);
        Redirect::url("/tasks");
    }

    public function searchTask(Request $request)
    {
        $search = $this->repository
            ->searchTask((int)$request->get("numberSearch"));

        return view("search", ["search" => $search]);
    }

    public function deleteTask(Request $request)
    {
        $this->repository
            ->deleteTask($request->post("deleteNumber"));

        Redirect::url("/tasks");
    }

}
