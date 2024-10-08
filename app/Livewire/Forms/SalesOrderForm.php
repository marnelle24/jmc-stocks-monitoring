<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Sales;
use App\Models\SalesItem;
use Livewire\Attributes\Validate;

class SalesOrderForm extends Form
{
    public ?Sales $salesForm;

    public $salesOrder = [
        'sales_order_no' => '',
        'customer_name'  => '',
        'total_discount' => '',
        'total_amount'   => '',
        'sale_date'      => '',
        'payment_method' => 'cash',
        'status'         => 'completed',
        'created_by'     => '',
        'approved_by'    => '',
        'remarks'        => '',
        'salesItems'     => []
    ];
    public function save()
    {
        $this->validate();

        $so = Sales::create([
            'sales_order_no' => $this->salesOrder['sales_order_no'],
            'customer_name'  => $this->salesOrder['customer_name'],
            'total_discount' => $this->salesOrder['total_discount'],
            'total_amount'   => $this->salesOrder['total_amount'],
            'sale_date'      => $this->salesOrder['sale_date'],
            'payment_method' => $this->salesOrder['payment_method'],
            'status'         => $this->salesOrder['status'],
            'created_by'     => $this->salesOrder['created_by'],
            'approved_by'    => $this->salesOrder['approved_by'],
            'remarks'        => $this->salesOrder['remarks'],
        ]);

        // store the sales item after the creation of the sales order
        foreach ($this->salesOrder['salesItems'] as $key => $item) 
        {
            SalesItem::create([
                'sale_id'           => $so->id,
                'product_id'        => $item['id'],
                'quantity'          => $item['quantity'],
                'productCost'       => $item['buying_price'],
                'sellingPrice'      => $item['selling_price'],
                'profitPerProduct'  => $item['profitPerProduct'],
                'tax_amount'        => $item['taxAmount'],
                'totalProfit'       => $item['netProfit'],
                'status'            => $so->status,
            ]);
        }

        return redirect()->to('/sales')->with('message', 'Sales Order transaction added successfully.');

    }

    public function rules()
    {
        $rules = [
            'salesOrder.customer_name' => 'required|string|max:255',
            'salesOrder.total_amount' => 'required|numeric|min:0.01',
            'salesOrder.sale_date' => 'required|date',
            'salesOrder.salesItems' => 'required|array|min:1',
        ];

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'salesOrder.customer_name.required'    => 'Name must not be empty',
            'salesOrder.total_amount.required'     => 'Total amount is required.',
            'salesOrder.total_amount.min'          => 'Must not be below 0.01',
            'salesOrder.sale_date.required'        => 'Sales date is required.',
            'salesOrder.salesItems.required'       => 'Sales Order must have atleast 1 item.',
        ];

        return $messages;
    }
}
