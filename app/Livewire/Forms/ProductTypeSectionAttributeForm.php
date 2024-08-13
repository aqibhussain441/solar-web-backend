<?php

namespace App\Livewire\Forms;

use App\Models\ProductTypeSection;
use Livewire\Form;
use App\Models\ProductTypeSectionAttribute;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;

class ProductTypeSectionAttributeForm extends Form
{

    public ?ProductTypeSectionAttribute $typeSectionAttribute;

    #[Locked]
    public int|null $id;

    public string|null $name = '';

    public string|null $type = '';

    public string|null $options = '';

    public bool $is_required = false;

    public bool $is_active = false;

    public null|string $default_value = '';

    public null|int $order;

    public null|int $product_type_section_id;

    public function rules()
    {
        return [
            'name' => [
                'required',
                'min:5',
                'max:255',
                Rule::unique(ProductTypeSectionAttribute::class)->ignore($this->typeSectionAttribute),
            ],
            'type' =>  'required',
            'options' => [
                'nullable',
                function ($attribute, $value, $fail) {

                    if (in_array($this->type, ['checkbox', 'dropdown', 'radio']) && empty($value)) {
                        $fail('The options field is required when type is checkbox, dropdown, or radio.');
                    }
                    //
                }
            ],
            'is_required' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'default_value' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) {
                    // default value must be in options array when type is dropdown, checkbox or radio
                    if (in_array($this->type, ['dropdown', 'checkbox', 'radio']) && $value && !in_array($value, explode(',', $this->options))) {
                        $fail('The default value must be in options array when type is dropdown, checkbox or radio.');
                    }
                    // default value must be date when type is date
                    if ($this->type === 'date' && $value && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
                        $fail('The default value must be in YYYY-MM-DD format when type is date.');
                    }
                    // default value must be a number when type is number
                    if ($this->type === 'number' && $value && !is_numeric($value)) {
                        $fail('The default value must be a number when type is number.');
                    }
                    // default value must be a valid email when type is email
                    if ($this->type === 'email' && $value && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $fail('The default value must be a valid email address when type is email.');
                    }
                    // default value must be a valid url when type is url
                    if ($this->type === 'url' && $value && !filter_var($value, FILTER_VALIDATE_URL)) {
                        $fail('The default value must be a valid URL when type is url.');
                    }
                }
            ],
            'order' => 'nullable|integer',
            'product_type_section_id' => [
                'required',
                Rule::exists(ProductTypeSection::class, 'id'),
            ]
        ];
    }


    public function initializeForm(ProductTypeSectionAttribute $typeSectionAttribute)
    {
        $this->typeSectionAttribute = $typeSectionAttribute;
        $this->fill($typeSectionAttribute->only('id', 'name', 'type', 'default_value', 'order', 'product_type_section_id'));

        $this->options = implode(',', ($typeSectionAttribute->options ?? []));

        $this->is_required = (bool) $typeSectionAttribute->is_required;
        $this->is_active = (bool) $typeSectionAttribute->is_active;
    }

    public function save()
    {
        $this->validate();

        $this->typeSectionAttribute->options = explode(',', $this->options);

        $this->typeSectionAttribute->fill($this->only('name', 'type', 'is_required', 'is_active', 'default_value', 'order', 'product_type_section_id'));

        $this->typeSectionAttribute->save();

        $this->reset(['name', 'type', 'options', 'is_required', 'is_active', 'default_value', 'order', 'product_type_section_id']);
    }
}
