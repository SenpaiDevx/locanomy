<?php

namespace Modules\AdminAccess\Http\Controllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
class UsersController extends Controller
{

    public function index()
    {
        return Inertia::render('welcome');
    }
}