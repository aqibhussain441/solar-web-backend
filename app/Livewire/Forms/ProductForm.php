<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Product;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ProductForm extends Form
{
    use WithFileUploads;

    public ?Product $product;

    public int|null $id;
    public string|null $name = '';
    public string|null $slug = '';
    public string|null $dimensions = '';
    public float|null $price;
    public float|null $weight;
    public string|null $description = '';
    public bool|null $is_active = true;
    public bool|null $add_in_footer = false;
    public bool|null $show_latest = false;
    public int|null $product_type_id;
    public TemporaryUploadedFile|string|null $main_image;
    public string|null $main_thumbnail = '';
    public int|null $product_category_id = null;
    public int|null $product_sub_category_id = null;

    public function rules()
    {
        return [
            'name' => [
                'required',
                'min:5',
                'max:255',
                Rule::unique(Product::class)->ignore($this->product),
            ],
            'slug' => [
                'required',
                'min:5',
                'max:255',
                Rule::unique(Product::class)->ignore($this->product),
            ],
            'dimensions' => 'nullable|string',
            'price' => 'required|numeric',
            'weight' => 'required|numeric',
            'description' => 'required|min:5',
            'is_active' => 'required|boolean',
            'add_in_footer' => 'required|boolean',
            'show_latest' => 'required|boolean',
            'product_type_id' => [
                'required',
                Rule::exists('product_types', 'id'),
            ],
            'product_category_id' => [
                'required',
                Rule::exists('product_categories', 'id'),
            ],
            'product_sub_category_id' => [
                'required',
                Rule::exists('product_sub_categories', 'id'),
            ],
            'main_image' => 'required',
        ];
    }

    public function removeImage()
    {
        if (!$this->main_image instanceof TemporaryUploadedFile) {
            Storage::disk('public')->delete($this->main_image);
            Storage::disk('public')->delete($this->main_thumbnail);
        }
        $this->reset([
            'main_image',
            'main_thumbnail'
        ]);
    }

    public function initializeForm(Product $product)
    {
        $this->product = $product;
        $this->fill($product->only(
            'name',
            'slug',
            'dimensions',
            'price',
            'weight',
            'description',
            'product_type_id',
            'main_image',
            'main_thumbnail',
            'product_sub_category_id',
        ));
        $this->product_category_id = $this->product->sub_category->product_category_id ?? null;
        $this->is_active = $product->is_active ?? false;
        $this->add_in_footer = $product->add_in_footer ?? false;
        $this->show_latest = $product->show_latest ?? false;
    }

    public function save()
    {
        $this->validate();

        // Fill product attributes with form data
        $this->product->fill($this->only(
            'name',
            'slug',
            'dimensions',
            'price',
            'weight',
            'description',
            'is_active',
            'add_in_footer',
            'show_latest',
            'product_type_id',
            'product_sub_category_id',
        ));

        if ($this->main_image instanceof TemporaryUploadedFile) {
            $this->validate([
                'main_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            [$image, $thumbnail] = $this->processImage($this->main_image);

            $this->product->main_image = $image;
            $this->product->main_thumbnail = $thumbnail;
        }


        $this->product->save();

        $this->resetForm();
    }


    protected function processImage(TemporaryUploadedFile $image)
    {
        $imageDirectory = config('constants.product.image_path');
        $thumbnailDirectory = config('constants.product.thumbnail_path');

        $imagePath = $imageDirectory . $image->hashName();
        $thumbnailPath = $thumbnailDirectory . $image->hashName();

        $this->resizeAndStoreImage($image, $imagePath, config('constants.product.image_width'));
        $this->resizeAndStoreImage($image, $thumbnailPath, config('constants.product.thumbnail_width'));

        return [$imagePath, $thumbnailPath];
    }

    protected function resizeAndStoreImage(TemporaryUploadedFile $image, string $path, int $width)
    {
        $resizedImage = Image::read($image->getRealPath())->scale($width);

        Storage::disk('public')->put($path, (string) $resizedImage->encode());
    }

    protected function resetForm()
    {
        $this->reset([
            'name',
            'slug',
            'dimensions',
            'price',
            'weight',
            'description',
            'is_active',
            'add_in_footer',
            'show_latest',
            'product_type_id',
            'product_sub_category_id',
            'images'
        ]);
    }
}
