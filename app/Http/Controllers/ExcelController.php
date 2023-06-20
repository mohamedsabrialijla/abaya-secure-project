<?php

namespace App\Http\Controllers;

use App\Exports\CustomersExport;
use App\Exports\StoresExport;
use App\Exports\OrdersExport;
use App\Exports\ProductsExport;
use App\Exports\SalesExport;
use App\Exports\SizeExport;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function exportcustomer()
    {
        return Excel::download(new CustomersExport, 'customers.xlsx');
    }
    public function exportstore()
    {
        return Excel::download(new StoresExport, 'stores.xlsx');
    }
    public function exportproduct()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }
    public function exportorder()
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }
    public function exportsales(Request $request)
    {
        return Excel::download(new SalesExport, 'sales.xlsx');
    }
    public function exportsize(Request $request)
    {
        return Excel::download(new SizeExport, 'productsize.xlsx');
    }
}
