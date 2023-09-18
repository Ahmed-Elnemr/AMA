<?php

namespace App\Http\Controllers\Api;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{

    public function index()
    {
        return Organization::with('media')->paginate(10);
    }


    public function create()
    {

    }


    public function store(Request $request)
    {

    }


    public function show(Organization $organization)
    {

    }


    public function edit(Organization $organization)
    {

    }


    public function update(Request $request, Organization $organization)
    {

    }


    public function destroy(Organization $organization)
    {

    }
}
