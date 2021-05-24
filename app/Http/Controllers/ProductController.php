<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublishedProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    const PERPAGE = 15;
    const CATEGORY_PERPAGE = 16;
    /**
     * @var ProductRepository
     */
    private $productRepository;


    /**
     * ProductController constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
        $this->authorizeResource(Product::class,'product');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->is_seller_admin){
            $products = Product::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->simplePaginate(self::PERPAGE);
        }else{
            $products = Product::orderBy('created_at', 'DESC')->simplePaginate(self::PERPAGE);
        }

        return view("admin.products.index", compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name')->pluck('name', 'id');
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product = $this->productRepository->store($request->all());

        session()->flash('success', 'Product created successfully');
        return $request->ajax()
            ? response()->json(['route' => route('products.show', $product)])
            : redirect()->route('products.show', $product);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->load('images');
        $product->loadUser();

        $count = $product->images()->count();
        return view("admin.products.show", compact('product', 'count'));
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function shop($slug, Product $product)
    {
        $product->load('images');
        $image_count = $product->images()->count();
        return view("client.products.show", compact('product', 'image_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $product->withCategory();

        $categories = Category::orderBy('name')->pluck('name', 'id');
        return view('admin.products.create', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->productRepository->update($product, $request->all());

        session()->flash('success', 'Article Updated successfully');
        return $request->ajax()
            ? response()->json(['route' => route("products.show", $product)])
            : redirect()->route("products.show", $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $this->productRepository->destroy($product);

        session()->flash('success', 'Article deleted succesfuly');
        return redirect()->route("products.index");
    }

    public function online(Request $request, Product $product)
    {
        $this->authorize('published');

        if($product->qty_available > 0){
            $this->productRepository->online($product, $request->only('online'));
            $message = $request->online ? 'Article published.' : 'Article offline.';

            return $request->ajax()
                ? response()->json(["message" => $message, "status" => "success"])
                : redirect()->route('products.show', $product)->withSuccess($message);
        }
        else{
            $message = "Article can't be published because quantity equal 0";
            return $request->ajax()
                ? response()->json(["message" => $message, "status" => "danger"])
                : redirect()->route('products.show', $product)->withDanger($message);
        }

    }

    public function all()
    {
        $products = Product::orderBy('created_at', 'DESC')->published()->simplePaginate(self::CATEGORY_PERPAGE);
        $products->load('category');
        $products->load("images");
        $title = "All catégories";

        return view("client.products.index", compact('products', "title"));
    }


    public function categories(Category $category)
    {
        $products = Product::where('category_id', $category->id)
            ->published()
            ->orderBy('created_at', 'DESC')
            ->simplePaginate(self::CATEGORY_PERPAGE);

        $products->load('images');

        $title = $category->name.' category';

        return view('client.products.index', compact('products', 'title', 'category'));
    }
}
