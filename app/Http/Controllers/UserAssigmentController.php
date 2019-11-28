<?php

namespace App\Http\Controllers;

use App\Repository\UserAssigmentRepositoryInterface;
use Illuminate\Http\Request;

class UserAssigmentController extends Controller
{
    protected $assigment;

    public function __construct(UserAssigmentRepositoryInterface $assigment)
    {
        $this->assigment = $assigment;
    }
}
