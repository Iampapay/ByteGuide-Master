<?php

namespace App\Imports;

use App\Models\StudentBasicDetails;
use App\Models\StudentContactDetails;
use App\Models\StudentEducationDetails;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToCollection
{
    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        // Skip the first row (header row) and iterate through the rest of the rows
        foreach ($rows->skip(1) as $row) {
            if (empty($row[3]) || empty($row[4]) || empty($row[2])) {
                continue; // Skip the row if any of the required fields is empty
            }
            // Find the user by name in the users table
            $user = User::where('name', $row[9])->first();
            // Split full name into parts (first name, middle name, last name) using space as separator
            $fullName = $row[3];
            $nameParts = explode(' ', $fullName);
            $firstName = $nameParts[0];
            $lastName = end($nameParts);
            // Check if there is a middle name (more than 2 name parts)
            $middleName = '';
            if (count($nameParts) > 2) {
                // Concatenate middle name from the name parts (excluding first name and last name)
                $middleName = implode(' ', array_slice($nameParts, 1, -1));
            }
            $studentBasicDetails = new StudentBasicDetails();
            if($user) {
                $studentBasicDetails->created_by = $user->id; // Set the user ID from the users table;
            }
            $studentBasicDetails->s_f_name = $firstName;
            $studentBasicDetails->s_m_name = $middleName; // Save the middle name (if available)
            $studentBasicDetails->s_l_name = $lastName;
            $studentBasicDetails->gender = $row[4];
            // Convert Excel serial number to date format
            $studentBasicDetails->dob = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5])->format('Y-m-d');
            $studentBasicDetails->save();

            $studentContactDetails = new StudentContactDetails();
            $studentContactDetails->stud_unq_id = $studentBasicDetails->id;
            $studentContactDetails->pri_mbl_no = $row[7];
            $studentContactDetails->save();

            $studentEducationalDetails = new StudentEducationDetails();
            $studentEducationalDetails->stud_unq_id = $studentBasicDetails->id;
            $studentEducationalDetails->edu_qlf = $row[8];
            $studentEducationalDetails->course = $row[1];
            $studentEducationalDetails->save();
        }
    }
}
