<?php
namespace App\Http\Controllers\Api;

use App\Models\Library;
use Illuminate\Http\Request;

class LibraryController extends Controller
{

    public function index()
    {
        return Library::with("media")->paginate(10);
    }


    public function create()
    {

    }


    public function store(Request $request)
    {

    }


    public function show(Library $library)
    {
        //
    }


    public function edit(Library $library)
    {

    }


    public function update(Request $request, Library $library)
    {

    }


    public function destroy(Library $library)
    {

    }
}
