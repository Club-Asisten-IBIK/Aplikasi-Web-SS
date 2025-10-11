<?php

// app/Http/Controllers/GradeController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function store(Request $r)
    {
        $data = $r->validate([
            'class'        => 'required|string',
            'student_id'   => 'required|string',
            'student_name' => 'required|string',
            'subject'      => 'required|string',
            'score'        => 'required|numeric|min:0|max:100',
            'term'         => 'required|string',
        ]);

        // TODO: simpan ke tabel grades
        // Grade::create($data);

        return back()->with('ok', 'Grade saved!');
    }

     public function storeBatch(Request $r)
    {
        $data = $r->validate([
            'class'   => 'required|string',
            'subject' => 'required|string',
            'term'    => 'required|string',
            'grades'  => 'required|array',             // grades[student_id] => [score]
            'grades.*.student_id' => 'required|string',
            'grades.*.score'      => 'nullable|numeric|min:0|max:100',
        ]);

        // Contoh penyimpanan:
        // foreach ($data['grades'] as $row) {
        //     if ($row['score'] === null || $row['score'] === '') continue;
        //     Grade::updateOrCreate(
        //       [
        //         'student_id' => $row['student_id'],
        //         'class'      => $data['class'],
        //         'subject'    => $data['subject'],
        //         'term'       => $data['term'],
        //       ],
        //       ['score' => $row['score']]
        //     );
        // }

        return back()->with('ok', 'Grades saved!');
    }
}
