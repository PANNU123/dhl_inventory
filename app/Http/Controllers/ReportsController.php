<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function reportsPackagingMaterial()
    {
        return view('pages.reports.packaging-material');
    }
    public function reportsQuantityMovement()
    {
        return view('pages.reports.quantity-movement');
    }
    public function reportsValueMovement()
    {
        return view('pages.reports.value-movement');
    }
    public function reportsProductMovement()
    {
        return view('pages.reports.product-movement');
    }
    public function reportsVendor()
    {
        return view('pages.reports.reports-vendor');
    }
    public function reportsRequest()
    {
        return view('pages.reports.reports-request');
    }
    public function reportsPriceFluctuation()
    {
        return view('pages.reports.price-fluctuation');
    }
    public function reportsStock()
    {
        return view('pages.reports.reports-stock');
    }
    public function reportsAnalysis()
    {
        return view('pages.reports.reports-analysis');
    }
}
