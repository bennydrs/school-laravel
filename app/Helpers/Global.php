<?php

use App\Admin;
use App\ClassRoom;
use App\Student;
use App\Teacher;

function totalSiswa()
{
    return Student::count();
}

function totalGuru()
{
    return Teacher::count();
}

function totalAdmin()
{
    return Admin::count();
}

function totalKelas()
{
    return ClassRoom::count();
}
