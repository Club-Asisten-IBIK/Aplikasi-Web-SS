<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index()
    {
        $students = [
            ['id' => 'STU001', 'name' => 'Emma Johnson', 'class' => 'Grade 10-A', 'dob' => '2008-03-15', 'gender' => 'Female', 'parent' => 'Sarah Johnson', 'contact' => '(555) 123-4567', 'status' => 'Active'],
            ['id' => 'STU002', 'name' => 'Michael Brown', 'class' => 'Grade 9-B', 'dob' => '2009-07-22', 'gender' => 'Male', 'parent' => 'David Brown', 'contact' => '(555) 234-5678', 'status' => 'Active'],
            ['id' => 'STU003', 'name' => 'Sarah Davis', 'class' => 'Grade 11-A', 'dob' => '2007-11-08', 'gender' => 'Female', 'parent' => 'Lisa Davis', 'contact' => '(555) 345-6789', 'status' => 'Inactive'],
        ];

        $classes = [
            ['id' => 'CLS001', 'name' => 'Grade 10-A', 'level' => 'Grade 10', 'teacher' => 'John Smith', 'capacity' => 30, 'enrolled' => 28],
            ['id' => 'CLS002', 'name' => 'Grade 9-B', 'level' => 'Grade 9', 'teacher' => 'Mary Wilson', 'capacity' => 25, 'enrolled' => 23],
            ['id' => 'CLS003', 'name' => 'Grade 11-A', 'level' => 'Grade 11', 'teacher' => 'Robert Jones', 'capacity' => 28, 'enrolled' => 26],
        ];

        $staff = [
            ['id' => 'STF001', 'name' => 'John Smith', 'position' => 'Teacher', 'subject' => 'Mathematics', 'contact' => '(555) 111-2222', 'status' => 'Active'],
            ['id' => 'STF002', 'name' => 'Mary Wilson', 'position' => 'Teacher', 'subject' => 'English Literature', 'contact' => '(555) 222-3333', 'status' => 'Active'],
            ['id' => 'STF003', 'name' => 'Robert Jones', 'position' => 'Administrator', 'subject' => 'N/A', 'contact' => '(555) 333-4444', 'status' => 'Active'],
        ];

        $subjects = [
            ['id' => 'SUB001', 'name' => 'Mathematics', 'teacher' => 'John Smith'],
            ['id' => 'SUB002', 'name' => 'English Literature', 'teacher' => 'Mary Wilson'],
            ['id' => 'SUB003', 'name' => 'Physics', 'teacher' => 'Dr. Anderson'],
            ['id' => 'SUB004', 'name' => 'Chemistry', 'teacher' => 'Prof. Carter'],
        ];

        $attendanceData = [
            ['studentName' => 'Emma Johnson', 'class' => 'Grade 10-A', 'totalPresent' => 18, 'totalAbsent' => 2, 'totalExcused' => 1, 'attendanceRate' => '86%'],
            ['studentName' => 'Michael Brown', 'class' => 'Grade 9-B', 'totalPresent' => 20, 'totalAbsent' => 1, 'totalExcused' => 0, 'attendanceRate' => '95%'],
            ['studentName' => 'Sarah Davis', 'class' => 'Grade 11-A', 'totalPresent' => 17, 'totalAbsent' => 3, 'totalExcused' => 1, 'attendanceRate' => '81%'],
        ];

        return view('user-management.index', compact('students', 'classes', 'staff', 'subjects', 'attendanceData'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:100',
            'password' => 'required|string',
            'roleid'   => 'required|integer',
            'isactive' => 'required|boolean',
        ]);

        $userid = DB::table('users')->insertGetId([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'isactive' => $request->isactive,
        ]);

        DB::table('userrole')->insert([
            'userid' => $userid,
            'roleid' => $request->roleid,
        ]);

        return redirect()->route('user.index')->with('added', true);
    }

    public function update(Request $request, $userid)
    {
        $request->validate([
            'username' => 'required|string|max:100',
            'roleid'   => 'required|integer',
            'isactive' => 'required|boolean',
        ]);

        $updateData = [
            'username' => $request->username,
            'isactive' => $request->isactive,
        ];
        if ($request->filled('password')) {
            $updateData['password'] = bcrypt($request->password);
        }

        DB::table('users')->where('userid', $userid)->update($updateData);

        DB::table('userrole')->updateOrInsert(
            ['userid' => $userid],
            ['roleid' => $request->roleid]
        );

        return redirect()->route('user.index')->with('edited', true);
    }

    public function destroy($userid)
    {
        DB::table('userrole')->where('userid', $userid)->delete();
        DB::table('users')->where('userid', $userid)->delete();
        return redirect()->route('user.index')->with('deleted', true);
    }
}
