<?php

namespace App\Observers;
use App\Mail\WelcomeMail;
use App\Models\Employee;
use Mail;
class EmployeeObserver
{
    /**
     * Handle the Employee "created" event.
     *
     * @param  \App\Models\Employee  $employee
     * @return void
     */
    public function created(Employee $employee)
    {
      Mail::to($employee->email)->send(new WelcomeMail());
    }

}
