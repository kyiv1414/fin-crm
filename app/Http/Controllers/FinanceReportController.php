<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Order;
use Illuminate\Http\Request;
use DateTime;


class FinanceReportController extends Controller {

    public function calculateExpenses(Request $request)
    {
        $orderBonus = config('finance.salary_order_bonus_percentage');
        $salaryBase = config('finance.salary_base'); //per month

        // to simplify, lets take mean of 30.436875 days per month
        $salaryBasePerDay = $salaryBase / 30.436875;

        $from = $request->get( 'from' );
        $to = $request->get( 'to' );

        //calculating days interval for base salary
        $datetime1 = new DateTime($from);
        $datetime2 = new DateTime($to);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');

        $employees = Employee::all()->count();


        $salaryBaseExpenses = $salaryBasePerDay * $days * $employees;


        $OrdersTotalAmount = Order::where('created_at', '>', $from)
            ->where('created_at', '<', $to)
            ->sum('total_amount');


        $ordersBonusesExpenses = $OrdersTotalAmount * $orderBonus;

        $totalExpenses = $ordersBonusesExpenses + $salaryBaseExpenses;

        return $totalExpenses;
    }
    public function calculateIncomes(Request $request) {


        $from = $request->get( 'from' );
        $to = $request->get( 'to' );

        $OrdersTotalAmount = Order::where('created_at', '>', $from)
            ->where('created_at', '<', $to)
            ->sum('total_amount');

        return $OrdersTotalAmount;
    }
    public function getProfits(Request $request) {

        $incomes = $this->calculateIncomes($request);
        $expenses = $this->calculateExpenses($request);

        $profits = $incomes - $expenses;

        return response()->json([
            'profits' => $profits,
        ]);
    }

    public function getIncomes(Request $request) {

        $incomes = $this->calculateIncomes($request);
        return response()->json([
            'incomes' => $incomes,
        ]);
    }

    public function getExpenses(Request $request) {

        $expenses = $this->calculateExpenses($request);
        return response()->json([
            'expenses' => $expenses,
        ]);
    }


}
