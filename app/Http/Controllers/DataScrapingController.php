<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use Session;

class DataScrapingController extends Controller
{
    public function index()
    {
        $data = json_decode(file_get_contents('output.json'));

        return view('node.data-scraping', compact('data'));
    }
}