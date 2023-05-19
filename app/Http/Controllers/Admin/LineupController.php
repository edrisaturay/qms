<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class LineupController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LineupController extends Controller
{
    public function index()
    {
        $visa_types = \App\Models\VisaType::all();
        return view('admin.lineup', [
            'title' => 'Lineup',
            'breadcrumbs' => [
                trans('backpack::crud.admin') => backpack_url('dashboard'),
                'Lineup' => false,
            ],
            'visa_types' => $visa_types,
            'page' => 'resources/views/admin/lineup.blade.php',
            'controller' => 'app/Http/Controllers/Admin/LineupController.php',
        ]);
    }
}
