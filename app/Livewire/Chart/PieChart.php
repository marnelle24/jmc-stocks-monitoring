<?php

namespace App\Livewire\Chart;

use Livewire\Component;
use Asantibanez\LivewireCharts\Models\PieChartModel;

class PieChart extends Component
{
    public function chartDetails()
    {
        // Build the pie chart model
        return (new PieChartModel())
            ->setAnimated(true) // Enables animation
            ->addSlice('Kabilya', 45, '#cbd5e0')  // Add a slice (label, value, color)
            ->addSlice('GI', 25, '#fc8181')
            ->addSlice('Cement', 30, '#90cdf4')
            ->addSlice('Wooden Tiles', 20, '#f6ad55')
            ->addSlice('Plant Pot', 16, '#66DA26')
            ->setLegendVisibility(true) // Show the legend
            ->setDataLabelsEnabled(true); // Show data labels on the slices
    }
    
    public function render()
    {
        return view('livewire.chart.pie-chart', [
            'chart' => $this->chartDetails()
        ]);
    }
}
