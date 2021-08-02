<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Order;


class EmployeeController extends Controller
{


    public function show($id)
    {
        $employee = Employee::find($id);
        return $employee;
    }

    public function getCurrentMonthSalary($employee_id)
    {

        if (Employee::where('id', $employee_id)->exists()) {
            $orderBonus = config('finance.salary_order_bonus_percentage');
            $salaryBase = config('finance.salary_base');

            $firstMonthDay = new Carbon('first day of this month');
            $lastMonthDay = new Carbon('last day of this month');

            $currentMonthSalesSum = Order::where('employee_id', $employee_id)
                ->where('created_at', '>', $firstMonthDay)
                ->where('created_at', '<', $lastMonthDay)
                -> sum('total_amount');

            $salary = $currentMonthSalesSum * $orderBonus + $salaryBase;

            return response()->json([
                'salary' => $salary,
            ]);
        }
        else {
            return abort(404, 'Employee does not exist');
        }


    }

}
