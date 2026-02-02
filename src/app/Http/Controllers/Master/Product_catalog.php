<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Product_catalog_md;
use Illuminate\View\View;

class Product_catalog extends Controller
{
    
    public function index(): View
    {
        $data = [
            'page' => [
                'title' => 'Product Catalog'
            ],
            'table' => [
                'columns' => queryToCol(Product_catalog_md::get_query()),
                'data' => Product_catalog_md::get_all(),
                'key_cols' => ['id', 'Name'],
                'formatting_cols' => ['Last Purchase Price' => 'money']
            ],
            'extensions' => ['datatable', 'select2'],
            'scripts' => [
                'js/master/product_catalog.js'
            ],
            'modals' => [
                draw_modal(['id'=> 'modal_input', 'size' => 'modal-xl', 'buttons' => ['close', 'save']]),
                draw_modal(['id'=> 'modal_lihat', 'size' => 'modal-lg', 'buttons' => ['close']])
            ],
        ];

        $data['content'] = view('master/product_catalog/table', $data)->render();

        return view('frame/main', $data);
    }

    public function table()
    {
        $table = [
            'columns' => queryToCol(Product_catalog_md::get_query()),
            'data' => Product_catalog_md::get_all(),
            'key_cols' => ['id', 'Name'],
            'formatting_cols' => ['Last Purchase Price' => 'money']
        ];

        echo draw_table($table);
    }

    public function view(Request $request): View
    {
        $query = $request->query();

        $data = [
            'data' => Product_catalog_md::get_one_formatted($query['id']),
        ];
        
        return view('master/cabang/view', $data);
    }

    public function form(Request $request): View
    {
        $query = $request->query();

        $data = [
            'options' => [
                'category' => get_htmlSelectOptions(Product_catalog_md::get_category_options()),
            ]
        ];

        if(!empty($query['id'])){
            $data['form_data'] = Product_catalog_md::get_one($query['id']);
        }
        
        return view('master/product_catalog/form', $data);
    }

    public function get(Request $request)
    {
        $id = $request->input('id');
        $result = Product_catalog_md::get_one($id);
        echo json_encode($result);
    }

    public function store(Request $request)
    {
        $form_data = $request->all();
        
        $result = Product_catalog_md::set_data($form_data);
        echo json_encode($result);
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $result = Product_catalog_md::set_delete($id);
        echo json_encode($result);
    }
}