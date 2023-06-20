<?php

namespace App\Exports;

use App\Models\Store;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Session;

class StoresExport implements FromView
{
    public function view(): View
    {
        return view('system_admin.stores.export', [
            'stores' => Store::all()
        ]);
    }
}
