<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use DataTables;


class ProductController extends Controller
{

    public function __construct()
    {
        $this->repository = new ProductRepository();
    }

    public function index()
    {

        $product_data = $this->repository->index();
        return view('Product.index', compact('product_data'));
    }
    public function addProduct()
    {
        return view('Product.add');
    }
    public function store(Request $request)
    {

        $result = $this->repository->store($request->all());
        if ($result['success'] == true) {
            return  redirect('product/index');
        } else {
            return back();
        }
    }

    public function edit($product_id)
    {


        $data = $this->repository->edit($product_id);

        return response()->json($data);
    }

    public function updateProduct(Request $request)
    {
        $data = $this->repository->productUpdate($request->all());
        if ($data['success'] == true) {
            return response()->json('success');
        }
    }

    public function delete($product_id)
    {
        $data = $this->repository->delete($product_id);
        if ($data['success'] == true) {
            return response()->json(['success' => true]);
        }
    }

    public function order()
    {

        $products = $this->repository->getAllProduct();
        return view('Product.order', compact('products'));
    }

    public function saveOrder(Request $request)
    {

        $this->repository->storeOrder($request->all());;
        return redirect('/product/order-list');
    }

    public function orderList()
    {


        return view('Product.order-list');
    }

    public function getOrders()
    {
        $data = $this->repository->getAllOrders();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $action_btn = '<a   id="edit" data-id="' . $row['id'] . '" class="btn btn-primary">Edit</a>
             <a  class="btn btn-danger" data-id="' . $row['id'] . '">Delete</a>
             <a  href="/product/get-invoice/' . $row['id'] . '" data-id="' . $row['id'] . '" class="btn btn-dark ">Invoice</a>';
                return $action_btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function orderEdit($id)
    {
        $data = $this->repository->getOrder($id);

        return response()->json($data);
    }
    public function deleteOrder($id)
    {
        $result = $this->repository->deleteOrder($id);
        if ($result['success'] == true) {
            return "success";
        }
    }

    public function updateOrder(Request $request)
    {

        $data = $this->repository->orderUpdadte($request->all());
        if ($data['success'] == true) {
            return response()->json("success");
        }
    }

    public function getInvoice($id)
    {
        $data = $this->repository->getInvoice($id);
        return view('Product.invoice', compact('data'));
    }
}
