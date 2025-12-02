<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use stdClass;
use Exception;

class TaskController extends Controller
{
    public function tasks()
    {
        $tasks = Task::all();
        return view('tasks', ['tasks' => $tasks]);
    }

    public function addTask(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        try {
            $task = new Task();
            $task->title = $request->input('title');
            $task->description = $request->input('description', '');
            $task->is_completed = false;
            $task->save();

            return redirect()->back()->with('success', 'Hozzadva');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'DB hiba' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Nem DB hiba ' . $e->getMessage());
        }
    }

    public function completeTask($id)
    {
        try {
            $task = Task::findOrFail($id);
            if ($task->is_completed) {
                $task->is_completed = false;
            }
            else {
                $task->is_completed = true;
            }
            $task->save();

            return redirect()->back()->with('success', 'Complete sikerult');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'DB hiba' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Nem DB hiba ' . $e->getMessage());
        }
    }

    public function deleteTask($id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->delete();

            return redirect()->back()->with('success', 'Torolve');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'DB hiba' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Nem DB hiba ' . $e->getMessage());
        }
    }

    public function updateTask(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        try {
            $task = Task::findOrFail($id);
            $task->title = $request->input('title');
            $task->description = $request->input('description', '');
            $task->save();

            return redirect()->back()->with('success', 'Frissitve');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'DB hiba' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Nem DB hiba ' . $e->getMessage());
        }
    }
}