<?php

namespace App\Services;

use NumberFormatter;
use App\Models\Transaction;
use DataTables;
use App\Services\Banks\CalBank;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
class CDatatable
{

    public function __construct(
        $showroom,
        $date1,
        $date2,
        $transaction_type,
         $period,
    ) { 'r'}
}