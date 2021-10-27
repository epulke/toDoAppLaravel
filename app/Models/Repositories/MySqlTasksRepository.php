<?php

namespace App\Models\Repositories;

use App\Models\Collections\TasksCollection;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class MySqlTasksRepository implements TasksRepository
{
    public function downloadTasks(): TasksCollection
    {
        $results = DB::select("select * from tasks");
        $collection = new TasksCollection();

        foreach ($results as $item)
        {
            $collection->addTask(new Task($item->id, $item->description));
        }

        return $collection;
    }

    public function uploadNewTask(int $id, string $description): void
    {
        DB::insert("insert into Tasks (description) values (:description)", [
            ":description" => $description
        ]);
    }

    public function searchTask(int $id): Task
    {
        $results = DB::select("select * from tasks where id={$id}");
        $search = new Task($results[0]->id, $results[0]->description);
        return $search;
    }

    public function deleteTask(int $id): void
    {
        DB::delete("delete from Tasks where id={$id}");
    }
}
