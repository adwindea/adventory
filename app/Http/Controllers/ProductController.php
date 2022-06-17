<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;

class ProductController extends Controller
{
    function index(Request $request){

        $tableHeader = [
            [
                'text' => 'SKU',
                'value' => 'sku',
                'sortable'=> true,
                'class' => 'text-center',
            ],[
                'text' => 'Name',
                'value' => 'name',
                'sortable'=> true,
                'class' => 'text-center',
            ],[
                'text' => 'Quantity',
                'value' => 'quantity',
                'sortable'=> true,
                'class' => 'text-center',
            ],[
                'text' => 'Price',
                'value' => 'price',
                'sortable'=> true,
                'class' => 'text-center',
            ]
        ];

        $customFilter = [
            [
                'title' => 'Name',
                'key' => 'name',
                'type' => 'select',
                'options' => [
                    ['text' => 'Barang Baru', 'value' => 'Barang Baru'],
                    ['text' => 'Tes Barang', 'value' => 'Tes Barang'],
                ]
            ]
        ];

        $defaultFilter = new \stdClass();
        if(!empty($customFilter)){
            foreach($customFilter as $filter){
                $defaultFilter->{$filter['key']} = [];
            }
        }

        (empty($request->sort)) ? $request->sort = 'name' : '';
        (empty($request->direction)) ? $request->direction = 'asc' : '';
        (empty($request->perPage)) ? $request->perPage = 10 : '';
        (empty($request->filtering)) ? $request->filtering = $defaultFilter : '';

        $products = Product::orderBy($request->sort, $request->direction)
        ->when(!empty($request->search), function ($query) use ($request){
            return $query->where('name', 'LIKE', '%'.$request->search.'%')
                ->orWhere('sku', 'LIKE', '%'.$request->search.'%');
        });
        if(!empty($request->filter)){
            foreach($request->filter as $key=>$filter){
                $products = $products->whereIn($key, $filter);
            }
        }
        $products = $products->paginate($request->perPage)
        ->onEachSide(-1)
        ->withQueryString()
        ->through(fn ($product) => [
            'xid' => $product->xid,
            'sku' => $product->sku,
            'name' => $product->name,
            'quantity' => decToCur($product->quantity),
            'price' => decToCur($product->price),
        ]);

        return Inertia::render('Product/Products', [
            'filters' => [
                'search' => $request->form,
                'perPage' => $request->perPage,
                'sort' => $request->sort,
                'direction' => $request->direction,
            ],
            'filtering' => $request->filtering,
            'tableHeader' => $tableHeader,
            'customFilter' => $customFilter,
            'products' => $products,
        ]);
    }

}
