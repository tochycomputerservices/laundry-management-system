<?php

namespace App\Http\Livewire\Admin\Reports;

use Livewire\Component;
use PDF;
use App\Models\Translation;

class OrderReport extends Component
{
    public $from_date, $to_date, $orders, $status = -1, $lang;
    /* render the page */
    public function render()
    {
        return view('livewire.admin.reports.order-report');
    }
    /* processed before render */
    public function mount()
    {
        $this->from_date = \Carbon\Carbon::today()->toDateString();
        $this->to_date = \Carbon\Carbon::today()->toDateString();
        if (session()->has('selected_language')) {
            $this->lang = Translation::where('id', session()->get('selected_language'))->first();
        } else {
            $this->lang = Translation::where('default', 1)->first();
        }
        $this->report();
    }
    /*processed on update of the element */
    public function updated($name, $value)
    {
        $this->report();
    }
    /* report section */
    public function report()
    {
        if ($this->status == -1) {
            $this->orders = \App\Models\Order::whereDate('order_date', '>=', $this->from_date)->whereDate('order_date', '<=', $this->to_date)->latest()->get();
        } else {
            $this->orders = \App\Models\Order::whereDate('order_date', '>=', $this->from_date)->whereDate('order_date', '<=', $this->to_date)->where('status', $this->status)->latest()->get();
        }
    }
    /* download report */
    public function downloadFile()
    {
        $from_date = $this->from_date;
        $to_date = $this->to_date;
        $status = $this->status;
        $pdfContent = PDF::loadView('livewire.admin.reports.download-report.order-report', compact('from_date', 'to_date', 'status'))->output();
        return response()->streamDownload(fn () => print($pdfContent), "OrderReport_from_" . $from_date . ".pdf");
    }
}