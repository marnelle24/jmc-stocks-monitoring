<?php

namespace App\Livewire\Chart;

use Livewire\Component;
use App\Models\Category;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class CategoryColumnChart extends Component
{
    public $colors = ['#f6ad55','#fc8181','#90cdf4','#66DA26','#cbd5e0'];

    public function chartDetails()
    {
        $categories = Category::withCount('products')->get();
        
        $columnChartModel = (new ColumnChartModel());

        $columnChartModel->setTitle('Product By Categories');
        $columnChartModel->setAnimated(true);
        $columnChartModel->setDataLabelsEnabled(true);
        $columnChartModel->withGrid();
        $columnChartModel->stacked();
        $columnChartModel->withoutLegend();

        foreach ($categories as $key => $category) 
        {
            $_color = array_rand($this->colors);
            if($category->products_count > 0)
                $columnChartModel->addColumn($category->name, $category->products_count, $this->colors[$_color]);
        }

        return $columnChartModel;

    }

    public function render()
    {
        return view('livewire.chart.category-column-chart', [
            'chart' => $this->chartDetails()
        ]);
    }
}
