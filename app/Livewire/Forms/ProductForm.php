<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Product;
use Livewire\Attributes\Validate;

class ProductForm extends Form
{
    public ?Product $prdct;

    public $product = [
        'supplier_id' => null,
        'productCode' => null,
        'name' => null,
        'selling_price' => null,
        'buying_price' => null,
        'currency' => 'PHP',
        'description' => null,
        'unit' => null,
        'keyword' => null,
        'addedBy' => null,
        'lastUpdatedBy' => null,
        'photo' => null,
        'isActive' => true,
        'isSearchable' => true,
        'categories' => []
    ];

    public function setProduct(Product $product)
    {
        $this->prdct = $product;
        $this->product['productCode'] = $product->productCode;
        $this->product['supplier_id'] = $product->supplier_id;
        $this->product['name'] = $product->name;
        $this->product['buying_price'] = $product->buying_price;
        $this->product['selling_price'] = $product->selling_price;
        $this->product['unit'] = $product->unit;
        $this->product['description'] = $product->description;
        $this->product['keyword'] = $product->keyword;
        $this->product['categories'] = array_map(fn($cat) => $cat['id'], ($product->categories)->toArray());
    }


    public function rules()
    {
        $rules = [
            'product.name' => 'required|min:4|max:255',
            'product.productCode' => 'nullable|unique:products,productCode,'.$this->prdct['id'],
            'product.selling_price' => 'required',
            'product.buying_price' => 'required',
            'product.unit' => 'required',
        ];

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'product.name.required'    => 'Product name must not be empty',
            'product.name.min'         => 'Product Name too short. Atleast 4 characters',
            'product.name.max'         => 'Product Name too long. Atleast 250 characters',
            'product.productCode.unique'=> 'Product code already exist.',
            'product.selling_price.required'=> 'Selling Price is required',
            'product.buying_price.required'=> 'Buying Price is required',
            'product.unit.required'=> 'Unit is required',
        ];

        return $messages;
    }

    public function update()
    {
        $this->validate();
        $this->product['lastUpdatedBy'] = auth()->user()->name;
        $product = Product::find($this->prdct->id);

        $product->update([
            'supplier_id'   => $this->product['supplier_id'],
            'name'          => $this->product['name'],
            'selling_price' => $this->product['selling_price'],
            'buying_price'  => $this->product['buying_price'],
            "currency"      => $this->product['currency'],
            'description'   => $this->product['description'],
            'unit'          => $this->product['unit'],
            'keyword'       => $this->product['keyword'],
            "isActive"      => true,
            "isSearchable"  => true,
        ]);

        // Step 1: Detach all existing categories
        $product->categories()->detach();

        // Step 2: Attach the new selected categories
        foreach ($this->product['categories'] as $cat) {
            $product->categories()->attach($cat);
        }

        return redirect()->to('/products')->with('message', 'Product updated successfully.');
    }

    public function save()
    {
        $this->validate();

        /**
         * If no supplier selected -> set the defauly supplier id (N/A)
         */
        if(!$this->product['supplier_id'])
            $this->product['supplier_id'] = 1;

        if(!$this->product['productCode'])
            $this->product['productCode'] = uniqid(); // default value
        
        $this->product['lastUpdatedBy'] = auth()->user()->name;
        $this->product['addedBy'] = auth()->user()->name;

        $product = Product::create([
            'supplier_id'   => $this->product['supplier_id'],
            'productCode'   => $this->product['productCode'],
            'name'          => $this->product['name'],
            'selling_price' => $this->product['selling_price'],
            'buying_price'  => $this->product['buying_price'],
            'description'   => $this->product['description'],
            'unit'          => $this->product['unit'],
            'keyword'       => $this->product['keyword'],
            'addedBy'       => $this->product['addedBy'],
            'lastUpdatedBy' => $this->product['lastUpdatedBy'],
        ]);

        $product->categories()->sync($this->product['categories'], false);

        return redirect()->to('/products')->with('message', 'New Product successfully added.');

    }
}
