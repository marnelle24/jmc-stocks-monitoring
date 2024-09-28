<?php

namespace App\Livewire\Sales;

use Carbon\Carbon;
use App\Models\Sales;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class All extends Component
{
    use WithPagination;

    #[Computed]
    public function sales()
    {
        $sales = Sales::with('salesItem')
            ->latest()
            ->paginate(10);
        return $sales;
    }

    public function date_format($timestamp)
    {
        return Carbon::parse($timestamp)->format('M j, Y');
    }
}
