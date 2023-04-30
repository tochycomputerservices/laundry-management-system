<?php
namespace App\Http\Livewire\Admin\Reports\PrintReport;
use Livewire\Component;
class TaxReport extends Component
{
    public $from_date,$to_date,$reports,$category=1;
    /* render the page */
    public function render()
    {
        return view('livewire.admin.reports.print-report.tax-report')
        ->extends('layouts.print-layout')
        ->section('content');
    }
    /* process before render */
    public function mount($from_date = null,$to_date = null, $category = null) {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->category = $category;
        /* sales */
        if($this->category==1) {
            $this->reports = \App\Models\Order::whereDate('order_date','>=',$this->from_date)->whereDate('order_date','<=',$this->to_date)->where('status',3)->latest()->get();
        } 
        /* expense */
        if($this->category==2) {
        $this->reports = \App\Models\Expense::whereDate('expense_date','>=',$this->from_date)->whereDate('expense_date','<=',$this->to_date)->latest()->get();
        }
    }
}