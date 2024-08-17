<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\WithFileUploads;
use App\Models\ProductSubCategory;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ProductSubCategoryForm extends Form
{
    use WithFileUploads;
    public ?ProductSubCategory $category;

    #[Locked]
    public int|null $id;

    public string|null $name = '';

    public string|null $slug = '';

    public string|null $details = '';

    public null|bool $is_active = true;

    public null|int $product_category_id;

    public TemporaryUploadedFile|string|null $image;

    public function rules()
    {
        return [
            'name' => [
                'required',
                'min:5',
                'max:255',
                Rule::unique(ProductSubCategory::class)->ignore($this->category),
            ],
            'slug' => [
                'required',
                'min:5',
                'max:255',
                Rule::unique(ProductSubCategory::class)->ignore($this->category),
            ],
            'is_active' => 'required|boolean',
            'details' => 'required|min:5',
            'image' => 'required',
            'product_category_id' => 'required|exists:product_categories,id',
        ];
    }

    public function removeImage()
    {
        $this->image = null;
    }
    public function initializeForm(ProductSubCategory $category)
    {
        $this->category = $category;
        $this->fill($category->only('id', 'image', 'product_category_id', 'name', 'slug', 'details'));
        $this->is_active = $category->is_active ?? false;
    }

    public function save()
    {
        $this->validate();

        $this->category->fill($this->only('name', 'product_category_id', 'slug', 'details', 'is_active'));

        if ($this->image instanceof TemporaryUploadedFile) {
            if ($this->category->image) {
                Storage::disk('public')->delete($this->category->image);
                Storage::disk('public')->delete($this->category->thumbnail);
            }

            $imageDirectory = storage_path('app/public/' . config('constants.product.subcategory.image_path'));

            // Ensure the directory exists
            if (!File::exists($imageDirectory)) {
                File::makeDirectory($imageDirectory, 0755, true);
            }

            $imagePath = $this->image->store(config('constants.product.subcategory.image_path'), 'public');

            $thumbnailDirectory = storage_path('app/public/' . config('constants.product.subcategory.thumbnail_path'));

            // Ensure the directory exists
            if (!File::exists($thumbnailDirectory)) {
                File::makeDirectory($thumbnailDirectory, 0755, true);
            }

            $thumbnailPath = config('constants.product.subcategory.thumbnail_path') . $this->image->hashName();
            $thumbnailImage = Image::read($this->image->getRealPath())->scale(50);

            Storage::disk('public')->put($thumbnailPath, (string) $thumbnailImage->encode());

            $this->category->image = $imagePath;
            $this->category->thumbnail = $thumbnailPath;
        }

        $this->category->save();
        $this->reset(['name', 'product_category_id', 'slug', 'details', 'image']);
    }
}
