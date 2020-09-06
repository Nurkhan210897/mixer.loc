<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\Product;
use DB;

class SubCategory extends Model
{

    protected $fillable = ['name', 'category_id', 'serial_number', 'in_index', 'avatar'];
    public $timestamps = false;

    private $directoryTypes;

    public function category()
    {
        return $this->belongsTo('App\Models\Admin\Category');
    }

    public function directoryTypes()
    {
        return $this->belongsToMany(
            'App\Models\Admin\DirectoryType',
            'sub_category_directories',
            'sub_category_id',
            'directory_type_id'
        );
    }

    public function products()
    {
        return $this->hasMany('App\Models\Admin\Product');
    }

    public static function updData($request, $id)
    {
        $updData = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'serial_number' => $request->serial_number,
            'in_index' => (int)$request->in_index
        ];
        if ($request->has('delAvatar')) {
            $updData['avatar'] = $request->file('updAvatar')->store('images/subCategories');
            $updData['avatar'] = '';
        }
        if ($request->has('updAvatar')) {
            $updData['avatar'] = $request->file('updAvatar')->store('images/subCategories');
            if ($request->avatar) {
                Storage::delete($request->avatar);
            }
        }

        $subCategory = SubCategory::where('id', $id)->update($updData);
    }

    public function getProducts($id, $data = [], $count = 24)
    {
        $products = DB::table('products')
            ->join('product_directory', 'products.id', '=', 'product_directory.product_id')
            ->join('images', 'products.id', '=', 'images.product_id')
            ->select(
                'products.id',
                'products.name',
                'products.code',
                'products.price',
                'images.path as image'
            )->where('images.avatar', 1)
            ->where('products.sub_category_id', $id);

        if (!empty($data['dir'])) {
            $products = $products->whereIn('product_directory.directory_id', $this->getDirectoryIdsFromRequest($data['dir']));
        }

        if (!empty($data['sort'])) {
            $sort = $data['sort'];
        } else {
            $sort = 'ASC';
        }

        $products = $products->orderBy('products.price', $sort)->distinct('products.id')->paginate($count);

        return $products;
    }

    private function getDirectoryIdsFromRequest($data)
    {
        $ids = [];
        foreach ($data as $value) {
            $ids[] = $value;
        }

        return $ids;
    }

    public function getPageInfo($id)
    {
        $products = Product::with([
            'directories' => function ($query) {
                $query->with('directoryTypes')->get();
            }
        ])->select('id', 'name', 'price')
            ->where('products.sub_category_id', $id)->get();

        $data['productCount'] = count($products);
        $data['directoryTypes'] = $this->setProductsDirectoryTypesWithDirectories($products);
        return $data;
    }
    // Данный метод нужен для того чтобы 
    // использовать только те справочники которые относятся
    // к существующим товарам подкатегории
    private function setProductsDirectoryTypesWithDirectories($products)
    {
        $directoryTypes = [];

        foreach ($products as $product) {
            foreach ($product->directories as $i => $directory) {
                $dirType = $directory->directoryTypes;
                $directoryTypes[$dirType->id]['name'] = $dirType->name;
                $directoryTypes[$dirType->id]['directories'][$directory->id]['id'] = $directory->id;
                $directoryTypes[$dirType->id]['directories'][$directory->id]['name'] = $directory->name;
            }
        }

        return $directoryTypes;
    }
}
