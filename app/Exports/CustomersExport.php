<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

// class CustomersExport implements FromCollection
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */

//     public function collection()
//     {
//         return Customer::all();
//     }
// }

class CustomersExport implements FromView
{
    public function view(): View
    {
        return view('system_admin.customers.export', [
            'customers' => Customer::all()
        ]);
    }
}
