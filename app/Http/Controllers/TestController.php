<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\purchase;
use App\Models\PurchaseDetail;
use App\Models\Quotation;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestController extends Controller
{
    public function customerRetrive(){
        $customers = Customer::all();
        return response()->json($customers);
    }

    public function supplierRetrive(){
        $suppliers = Supplier::all();
        return response()->json($suppliers);
    }
    public function categoryRetrive(){
        $categories = Category::all();
        return response()->json($categories);
    }
    public function unitRetrive(){
        $units = Unit::all();
        return response()->json($units);
    }
    public function productRetrive(){
        $products = Product::all();
        return response()->json($products);
    }
    // public function productRetrive(){
    //     $products = Unit::all();
    //     return response()->json($products);
    // }

    public function getProductsWithCategories($categoryId){
        // Validate the category ID (optional)
        if (!is_numeric($categoryId) || $categoryId <= 0) {
            return response()->json([
                'message' => 'Invalid category ID provided.'
            ], 400); // Bad Request
        }

        // Attempt to find the category by ID
        $category = Category::find($categoryId);

        // Check if the category exists
        if (!$category) {
            return response()->json([
                'message' => 'Category not found.'
            ], 404); // Not Found
        }

        // Retrieve products associated with the found category
        $products = $category->products;

        // Return a successful response with the category and its products
        return response()->json([
            'category' => [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
            ],
            'products' => $products,
        ], 200); // OK
    }
    public function getProductByCategory($categoryIdentifier, $productId)
    {
        $category = is_numeric($categoryIdentifier) ? Category::find($categoryIdentifier) : Category::where('slug',$categoryIdentifier)->orWhere('name', $categoryIdentifier)->first();

        if(!$category){
            return response()->json([
                'message' => 'Category not found'
            ],404);
        }

        // 
        $product = Product::where('id', $productId)
        ->where('category_id', $category->id)->first();
        if (!$product) {
            return response()->json([
                'message' => 'Product not found in this category.'
            ], 404); // Not Found
        }

        // Return a successful response with the product details
        return response()->json([
            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'code' => $product->code,
                'quantity' => $product->quantity,
                'buying_price' => $product->buying_price,
                'selling_price' => $product->selling_price,
                // Add any other fields you want to return
            ],
            'category' => [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
            ],
        ], 200); // OK
    }

    public function getOrdersWithCustomers(): JsonResponse
    {
        // Retrieve all orders with customer details
        $orders = Order::with('customer')->get();

        return response()->json($orders);
    }
    public function getOrderWithCustomer($orderId): JsonResponse
    {
        // Attempt to find the order by ID with customer details
        $order = Order::with('customer')->find($orderId);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json($order);
    }

    public function getAllOrderDetails(): JsonResponse
    {
        // Retrieve all order details with associated orders and products
        $orderDetails = OrderDetail::with(['order.customer', 'product'])->get();

        return response()->json($orderDetails);
    }

    public function getOrderDetail($orderDetailId): JsonResponse
    {
        // Attempt to find the order detail by ID with associated order and product
        $orderDetail = OrderDetail::with(['order.customer', 'product'])->find($orderDetailId);

        if (!$orderDetail) {
            return response()->json(['message' => 'Order detail not found'], 404);
        }

        return response()->json($orderDetail);
    }
    public function getAllPurchases(): JsonResponse
    {
        // Retrieve all purchases with associated supplier details
        $purchases = purchase::with('supplier')->get();

        return response()->json($purchases);
    }

    public function getPurchase($purchaseId): JsonResponse
    {
        // Attempt to find the purchase by ID with supplier details
        $purchase = Purchase::with('supplier')->find($purchaseId);

        if (!$purchase) {
            return response()->json(['message' => 'Purchase not found'], 404);
        }

        return response()->json($purchase);
    }

    public function getAllPurchaseDetails(): JsonResponse
    {
        // Retrieve all purchase details with associated purchases and products
        $purchaseDetails = PurchaseDetail::with(['purchase.supplier', 'product'])->get();

        return response()->json($purchaseDetails);
    }

    public function getPurchaseDetail($purchaseDetailId): JsonResponse
    {
        // Attempt to find the purchase detail by ID with associated purchase and product
        $purchaseDetail = PurchaseDetail::with(['purchase.supplier', 'product'])->find($purchaseDetailId);

        if (!$purchaseDetail) {
            return response()->json(['message' => 'Purchase detail not found'], 404);
        }

        return response()->json($purchaseDetail);
    }
    public function index()
    {
        $orders = Order::count();
        $completedOrders = Order::where('order_status', OrderStatus::COMPLETE)->count();
        $products = Product::count();
        $purchases = Purchase::count();
        
        $todayPurchases = Purchase::whereDate('date', today())->count(); // Use count() directly
        $categories = Category::count();
        
        $quotations = Quotation::count();
        $todayQuotations = Quotation::whereDate('date', today())->count(); // Use count() directly
    
        // return response()->json([
        //     'products' => $products,
        //     'orders' => $orders,
        //     'completedOrders' => $completedOrders,
        //     'purchases' => $purchases,
        //     'todayPurchases' => $todayPurchases,
        //     'categories' => $categories,
        //     'quotations' => $quotations,
        //     'todayQuotations' => $todayQuotations,
        // ]);
        return view('test', [
            'products' => $products,
            'orders' => $orders,
            'completedOrders' => $completedOrders,
            'purchases' => $purchases,
            'todayPurchases' => $todayPurchases,
            'categories' => $categories,
            'quotations' => $quotations,
            'todayQuotations' => $todayQuotations,
        ]);
    }
}
