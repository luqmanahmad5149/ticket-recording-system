<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Summary')
            ->description('Reports')
            ->row(function (Row $row) {

                $tickets = DB::table('tickets')
                ->select('currency', 'date', DB::raw('Count(*) as tickets'))
                ->groupBy('date')
                ->groupBy('currency')
                ->get();

                $currencies = DB::table('tickets')
                ->select('currency')
                ->groupBy('currency')
                ->get();

                $data = [
                    "title" => 'Weekly Tickets Summary',
                    "tickets" => $tickets,
                    "currencies" => $currencies,
                ];
                $row->column(5, view('admin.charts.bar', $data));
            });
    }
}
