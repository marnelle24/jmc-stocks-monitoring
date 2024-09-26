<?php

namespace App\Livewire\Chart;

use App\Models\Sales;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Asantibanez\LivewireCharts\Models\LineChartModel;

class LineChart extends Component
{
    public function chartSetup()
    {
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];

        $salesData = Sales::select(
                DB::raw('YEAR(sale_date) as year'),  // Extract year from sale_date
                DB::raw('MONTH(sale_date) as month'),  // Extract month from sale_date
                DB::raw('COUNT(sales.id) as total_sales'),  // Total sales count
                DB::raw('SUM(sales_items.quantity * sales_items.sellingPrice) as total_revenue')  // Sum of total revenue
            )
            ->join('sales_items', 'sales_items.id', '=', 'sales_items.sale_id')  // Join with sales_order_items
            ->groupBy(DB::raw('YEAR(sale_date), MONTH(sale_date)'))  // Group by year and month
            ->orderBy(DB::raw('YEAR(sale_date), MONTH(sale_date)'))  // Order by year and month
            ->get();
        
        $lineChart = (new LineChartModel());
        $lineChart->setAnimated(true);
        $lineChart->setColors(['#90cdf4']);
        $lineChart->setXAxisVisible(true);
        $lineChart->setYAxisVisible(true);

        $val = 0;
        foreach ($months as $month)
        {
            foreach($salesData as $sale)
            {
                if($month == $months[$sale->month]) 
                    $val = $sale->total_revenue;
            }
            $lineChart->addPoint($month, $val);
        }
        return $lineChart;
    }
    
    public function render()
    {
        return view('livewire.chart.line-chart', [
            'chart' => $this->chartSetup()
        ]);
    }
}
