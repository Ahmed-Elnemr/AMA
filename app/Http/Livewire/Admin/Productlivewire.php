<?php

namespace App\Http\Livewire\Admin;

use App\Models\Media;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\MainCategory;
use Livewire\WithPagination;
use App\Models\ProductsMediagroup;
use Illuminate\Support\Facades\DB;
use App\Models\BusinessInformation;
use Livewire\WithFileUploads;

class Productlivewire extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $proId, $products_name, $products_unite_name, $products_price, $products_uinites,
        $main_categories_id, $categories_id, $subcategories_id, $business_information_id, $image,
        $lastProduct, $file_name, $lastMedia, $file_image;
        public $search = '';



    // public $proId, $products_name, $products_price, $products_unite_name, $products_uinites;

    public function saveProduct()
    {
        $data = $this->data();
        Product::create($data);

        if ($this->image != null) {
            foreach ($this->image as  $image) {
                $this->file_image = $image;
                $file_extension = $this->file_image->hashName();
                $this->file_name = time() . '.' . $file_extension;
                $this->file_image->storeAs('images', $this->file_name, 'media');
                $this->file_image = url('/') . '/images/' . $this->file_name;
                Media::create(
                    [
                        'path' => $this->file_image,
                    ]
                );
                $last = DB::table('media')->latest()->first();
                $this->lastMedia = $last->id;
                ##
                $last = DB::table('products')->latest()->first();
                $this->lastProduct = $last->id;
                ##
                ProductsMediagroup::create([
                    'product_id' => $this->lastProduct,
                    'media_id' => $this->lastMedia,
                    'order' => 0,
                ]);
            }
        }
        session()->flash('message', 'Product Added Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }




    ################################
    public function data()
    {
        return [
            'products_name' => $this->products_name,
            'products_price' => $this->products_price,
            'products_unite_name' => $this->products_unite_name,
            'products_uinites' => $this->products_uinites,
            ## save product
            'main_categories_id' => $this->main_categories_id,
            'categories_id' => $this->categories_id,
            'subcategories_id' => $this->subcategories_id,
            'users_id' => Auth()->user()->id,
            'business_information_id' => $this->business_information_id,
        ];
    }

    public function updatePro()
    {
        Product::where('id', $this->proId)->update($this->data());
        if ($this->image != null) {
            ProductsMediagroup::where('product_id', $this->proId)->delete();
            foreach ($this->image as  $image) {
                $this->file_image = $image;
                $file_extension = $this->file_image->hashName();
                $this->file_name = time() . '.' . $file_extension;
                $this->file_image->storeAs('images', $this->file_name, 'media');
                $this->file_image = url('/') . '/images/' . $this->file_name;
                Media::create(
                    [
                        'path' => $this->file_image,
                    ]
                );
                $last = DB::table('media')->latest()->first();
                $this->lastMedia = $last->id;
                ##
                $pro = Product::where('id', $this->proId)->first();
                $proid = $pro->id;
                ##
                ProductsMediagroup::create([
                    'product_id' => $proid,
                    'media_id' => $this->lastMedia,
                    'order' => 0,
                ]);
            }
        }
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function editPro(int $proId)
    {
        $this->proId =  $proId;
        $product = Product::find($proId);

        if ($product) {
            $this->products_name = $product->products_name;
            $this->products_price = $product->products_price;
            $this->products_unite_name = $product->products_unite_name;
            $this->products_uinites = $product->products_uinites;
            $this->main_categories_id = $product->main_categories_id;
            $this->categories_id = $product->categories_id;
            $this->subcategories_id = $product->subcategories_id;
            $this->business_information_id = $product->business_information_id;
        } else {
            return redirect()->to('/livewire.productcategory-livewire');
        }
    }

    public function deletepro(int $proId)
    {
        $this->resetInput();
        $this->proId = $proId;
    }


    public function destroyProduct()
    {
        $product = Product::find($this->proId);
        $product->delete();
        session()->flash('message', 'Product Deleted Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->proId = '';
        $this->products_name = '';
        $this->products_price = '';
        $this->products_unite_name = '';
        $this->products_uinites = '';
        $this->main_categories_id = '';
        $this->categories_id = '';
        $this->subcategories_id = '';
        $this->business_information_id = '';
        $this->image = '';
        $this->lastProduct = '';
        $this->file_name = '';
        $this->lastMedia = '';
        $this->file_image = '';
    }

    public function isFeatured(int $id)
    {
        $pro = Product::find($id);
        if ($pro->is_featured == 0) {
            Product::find($id)->update([
                'is_featured' => 1,
            ]);
        } elseif ($pro->is_featured == 1) {
            Product::find($id)->update([
                'is_featured' => 0,
            ]);
        }
    }

    public function render()
    {
        $products = Product::where('products_name', 'like', '%' . $this->search . '%')->orderBy('id', 'DESC')->paginate(10);

        // $products = Product::get();
        $mainCategoreis = MainCategory::get();
        $categoreis = Category::get();
        $subCategoreis = SubCategory::get();
        $businessInformations = BusinessInformation::get();
        $sumProduct = Product::count();
        // dd($products->media);


        return view('livewire.admin.productlivewire', [
            'products' => $products,
            'mainCategoreis' => $mainCategoreis,
            'categoreis' => $categoreis,
            'subCategoreis' => $subCategoreis,
            'businessInformations' => $businessInformations,
            'sumProduct' => $sumProduct,

        ]);
    }
}
