<?php

namespace App\Livewire\Chart;

use Livewire\Component;
use App\Models\Category;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class ProductByCategory extends Component
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
            $category->name = ucfirst($category->name);
            if($category->products_count > 0)
                $columnChartModel->addColumn($category->name, $category->products_count, $this->colors[$_color]);
        }

        return $columnChartModel;

    }

    public function render()
    {
        return view('livewire.chart.product-by-category', [
            'chart' => $this->chartDetails()
        ]);
    }
}
