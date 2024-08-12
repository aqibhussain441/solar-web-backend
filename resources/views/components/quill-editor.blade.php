<div x-data="{ content: '' }" x-modelable='content' x-init="quill = new Quill($refs.quillEditor, {
    theme: 'snow'
});

quill.format('direction', 'ltr');

// Update AlpineJS content on Quill text change
quill.on('text-change', function() {
    content = quill.root.innerHTML;
});

// Update Quill content when AlpineJS content changes
$watch('content', value => {
    if (quill.root.innerHTML !== value) {
        quill.root.innerHTML = value;
    }
});" {{ $attributes }}>

    <div wire:ignore>
        <div x-ref="quillEditor" style="min-height: 200px;"></div>
    </div>
</div>
