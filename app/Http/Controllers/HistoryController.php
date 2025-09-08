<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;


class HistoryController extends Controller
{
    public function index()
    {
        $histories = History::orderBy('created_at', 'desc')->paginate(10);
        return view('history.index', compact('histories'));
    }
}
