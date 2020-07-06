<?php

namespace App\Http\Controllers;
use MongoDB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function Index() {
        $collection = (new MongoDB\Client)->FiveDStore->Products;
        $products = $collection->find();
        return view('Admin.Products.index', ['products' => $products]);
    }

    public function ProductStore() {
        $collection = (new MongoDB\Client)->FiveDStore->Products;
        $productCount = $collection->count();
        $page = request("pg") == 0 ? 1 : request("pg") ;
        $products = $collection->find([], [ "limit" => 12, "skip" => ($page-1) * 12 ]);
        return view('Products.index', ['products' => $products, 'productCount' => $productCount]);
    }

    public function Show($id) { // Details
        $collection = (new MongoDB\Client)->FiveDStore->Products;
        $product = $collection->findOne([ "_id" => new MongoDB\BSON\ObjectID($id) ]);
        return view('Admin.Products.Details', [ "product" => $product ]);
    }

    public function Create() {
        $collection = (new MongoDB\Client)->FiveDStore->Categories;
        $categories = $collection->find();
        return view('Admin.Products.Create', [ "categories" => $categories ]);
    }

    public function Store() {
        $product = [
            "product_name" => request("product_name"),
            "category_id" => request("category"),
            "description" => request("description"),
            "price" => request("price"),
            "currency" => request("currency"),
            "specification" => [],
            "rating" => [],
            "comments" => []
        ];
        $collection = (new MongoDB\Client)->FiveDStore->Products;
        $insertOneResult = $collection->insertOne($product);
        return redirect("/admin/products");
    }

    public function Edit($id) {
        $collection = (new MongoDB\Client)->FiveDStore->Products;
        $collectionC = (new MongoDB\Client)->FiveDStore->Categories;
        $categories = $collectionC->find();
        $product = $collection->findOne([ "_id" => new MongoDB\BSON\ObjectID($id) ]);
        return view('/admin/Products.Edit', [ "product" => $product, "categories" => $categories ]);
    }

    public function Update() {
        $collection = (new MongoDB\Client)->FiveDStore->Products;
        $product = [
            "product_name" => request("product_name"),
            "category_id" => request("category"),
            "description" => request("description"),
            "price" => request("price"),
            "currency" => request("currency"),
            "specification" => [],
            "rating" => [],
            "comments" => []
        ];
        $updateOneResult = $collection->updateOne([
            "_id" => new \MongoDB\BSON\ObjectId(request("productid"))
        ], [
            '$set' => $product
        ]);
        return redirect('/admin/products/'.request("productid"));
    }

    public function Delete($id) {
        $collection = (new MongoDB\Client)->FiveDStore->Products;
        $collectionC = (new MongoDB\Client)->FiveDStore->Categories;
        $categories = $collectionC->find();
        $product = $collection->findOne([ "_id" => new MongoDB\BSON\ObjectID($id) ]);
        return view('Admin.Products.Delete', [ "product" => $product, "categories" => $categories ]);
    }

    public function Remove() {
        $collection = (new MongoDB\Client)->FiveDStore->Products;
        $deleteOneResult = $collection->deleteOne([
            "_id" => new \MongoDB\BSON\ObjectId(request('productid'))
        ]);
        return redirect('/admin/products');
    }

    public function AddComment() {
        $collection = (new MongoDB\Client)->FiveDStore->Products;
        $comment = [
            "user_id" => request('userid'),
            "comment" => request('comment'),
            "date" => date("Y-m-d H:i:s")
        ];
        $product = $collection->findOne([ "_id" => new MongoDB\BSON\ObjectId(request('productid')) ]);
        $comments = $product->comments;
        if (count($comments) == 0 || $comments == null || empty($comments)) {
            $comments = [$comment];
        } else {
            $comments = [$comment, ...$comments];
        }
        $updateOneResult = $collection->updateOne([
            "_id" => new MongoDB\BSON\ObjectId(request('productid'))
        ],[
            '$set' => [ 'comments' => $comments ]
        ]);

        return redirect("/products/".request('productid'));
    }

    public function Details($id) {
        $collection = (new MongoDB\Client)->FiveDStore->Products;
        $product = $collection->findOne(["_id" => new MongoDB\BSON\ObjectId($id)]);
        return view('Products.Details', [ "product" => $product]);
    }
}
