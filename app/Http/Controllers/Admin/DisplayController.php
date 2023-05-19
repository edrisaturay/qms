<?php

namespace App\Http\Controllers\Admin;

use App\Models\Queue;
use Illuminate\Routing\Controller;

/**
 * Class DisplayController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DisplayController extends Controller
{
    public function index()
    {
        $counters = \App\Models\Counter::all();
        $queuedItems = Queue::where('status', Queue::$_QUEUE_STATUS_LINEUP)->get();

        return view('admin.display', [
            'title' => 'Display',
            'breadcrumbs' => [
                trans('backpack::crud.admin') => backpack_url('dashboard'),
                'Display' => false,
            ],
            'reload_interval' => 1000,
            'page' => 'resources/views/admin/display.blade.php',
            'controller' => 'app/Http/Controllers/Admin/DisplayController.php',
            'counters' => $counters,
            'queued_items' => $queuedItems,
        ]);
    }
}
