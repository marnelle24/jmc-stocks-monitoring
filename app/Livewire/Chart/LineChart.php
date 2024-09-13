<?php

namespace App\Livewire\Chart;

use Livewire\Component;
use Asantibanez\LivewireCharts\Models\LineChartModel;

class LineChart extends Component
{
    public function chartSetup()
    {
        $lineChart = (new LineChartModel());
        $lineChart->setAnimated(true);
        $lineChart->addPoint('Jan', 150);
        $lineChart->addPoint('Feb', 450);
        $lineChart->addPoint('Mar', 600);
        $lineChart->addPoint('Apr', 900);
        $lineChart->addPoint('May', 800);
        $lineChart->addPoint('June', 500);
        $lineChart->addPoint('July', 400);
        $lineChart->addPoint('Aug',500);
        $lineChart->addPoint('Sept', 500);
        $lineChart->addPoint('Oct', 1000);
        $lineChart->addPoint('Nov', 700);
        $lineChart->addPoint('Dec', 1800);
        $lineChart->setColors(['#90cdf4']);
        $lineChart->setXAxisVisible(true);
        $lineChart->setYAxisVisible(true);

        return $lineChart;
    }
    
    public function render()
    {
        return view('livewire.chart.line-chart', [
            'chart' => $this->chartSetup()
        ]);
    }
}
