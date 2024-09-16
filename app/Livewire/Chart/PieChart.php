<?php

namespace App\Livewire\Chart;

use App\Models\Keyword;
use Livewire\Component;
use Asantibanez\LivewireCharts\Models\PieChartModel;

class PieChart extends Component
{
    public $colors = ['#f6ad55','#fc8181','#90cdf4','#66DA26','#cbd5e0'];
    public $number = 4;

    public function chartDetails()
    {
        $topKeywords = Keyword::orderBy('count', 'DESC')
            ->take($this->number)
            ->get();

        $pieChart = (new PieChartModel());
        $pieChart->setAnimated(true); // Enables animation
        $pieChart->setLegendVisibility(true); // Show the legend
        $pieChart->setDataLabelsEnabled(true); // Show data labels on the slices

        foreach ($topKeywords as $value) 
        {
            $_color = array_rand($this->colors);
            $value->keyword = ucfirst($value->keyword);
            $pieChart->addSlice($value->keyword, $value->count, $this->colors[$_color]);
        }

        return $pieChart;
    }
    
    public function render()
    {
        return view('livewire.chart.pie-chart', [
            'chart' => $this->chartDetails()
        ]);
    }
}
