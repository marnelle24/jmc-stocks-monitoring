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
            DB::raw('YEAR(sale_date) as year'), 
            DB::raw('MONTH(sale_date) as month'),
            DB::raw('SUM(total) as total_sales') 
        )
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'asc')
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
                    $val = $sale->total_sales;
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
