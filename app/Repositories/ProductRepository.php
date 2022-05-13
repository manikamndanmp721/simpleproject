<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Order;

use Carbon\Carbon;
use Exception;


class ProductRepository
{


    public function index()
    {
        return Product::all();
    }
    public function store($data)
    {



        $image      = $data['image'];
        $file_name   =  $image->getClientOriginalName();



        $product = new Product();
        $product->product_name = $data['product_name'];
        $product->category = $data['category'];
        $product->price = $data['product_price'];
        $product->product_image = $file_name;
        $product->save();
        $data['image']->move(public_path('images'), $file_name);
        return ['success' => true];
    }

    public function edit($product_id)
    {
        $data = Product::where('id', $product_id)->first();
        return $data;
    }


    public  function getAllProduct()
    {
        $data = Product::all();
        return $data;
    }

    public function storeOrder($data)
    {

        $order_id = 'WAC' . mt_rand(1, 999999);
        $date = Carbon::now()->toDateTimeString();
        $product_deatils = Product::where('id', $data['product_id'])->first();
        $product_price = $product_deatils->price;
        try {

            $order = new Order();
            $order->order_id = $order_id;
            $order->customer_name = $data['customer_name'];
            $order->phone_number = $data['customer_phone'];
            $order->product_id = $data['product_id'];
            $order->net_amount = $product_price * $data['product_qty'];
            $order->qty = $data['product_qty'];
            $order->order_date = $date;
            $order->save();
            return ['success' => true];
        } catch (Exception $e) {
        }
    }
    public function getAllOrders()
    {
        $data = [];
        $orders = Order::all();

        foreach ($orders as $order) {
            $data[] = [
                'id' => $order->id,
                'order_id' => $order->order_id,
                'customer_name' => $order->customer_name,
                'phone_number' => $order->phone_number,
                'net_amount' => $order->net_amount,
                'order_date' => date('d-m-Y', strtotime($order->order_date))
            ];
        }

        return $data;
    }

    public function getOrder($id)
    {




        $data = Order::where('id', $id)->first();
        $product =  Product::all();
        return ['order_data' => $data, 'product_data' => $product];
    }

    public function deleteOrder($id)
    {

        $data = Order::where('id', $id)->first();
        $data->delete();
        return ['success' => true];
    }

    public function orderUpdadte($data)
    {

   
        $product_deatils = Product::where('id', $data['product_id'])->first();
        $product_price = $product_deatils->price;

        $order_id = $data['my_order_id'];

        $order = Order::where('id', $order_id)->first();
        $order->customer_name = $data['customer_name'];
        $order->phone_number = $data['phone'];
        $order->product_id = $data['product_id'];
        $order->net_amount = $product_price * $data['qty'];
        $order->order_date = Carbon::parse($data['order_date'])->toDatetimeString();
        $order->save();
        return ['success' => true];
    }
    public function getInvoice($id)
    {

        $data = Order::with('product')->where('id', $id)->get();
        return $data;
    }
    public function delete($product_id)
    {
        $data = Product::where('id', $product_id)->first();


        $data->delete();
        return ["success" => true];
    }
    public function productUpdate($data)
    {

        $image      = $data['product_image'];
        $file_name   =  $image->getClientOriginalName();
        $product = Product::where('id', $data['product_id'])->first();
        $product->product_name = $data['product_name'];
        $product->price = $data['product_price'];
        $product->category = $data['category'];
        $product->product_image = $file_name;
        $product->save();
        $data['product_image']->move(public_path('images'), $file_name);
        return ['success' => true];
    }
}
