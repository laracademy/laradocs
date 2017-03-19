<div class="form-group">
    <label>Name</label>
    <input type="text" class="form-control" name="name" value="{{ old('name', $version->name) }}">
    <p class="text-muted">The name of the version, examples: master, 5.4, 5.3-alpha</p>
</div>

<div class="form-group">
    <label>Landing Page</label>
    <select name="default_document_id" class="form-control">
        <option value="">Please select a default document to display</option>
        @if(isset($documents))
            @foreach($documents as $id => $title)
                <option value="{{ $id }}" {{ $id == $version->default_document_id ? 'selected' : '' }}>
                    {{ $title }}
                </option>
            @endforeach
        @endif
    </select>
    <p class="text-muted">The default page that the user will land on when first viewing the documentation.</p>
</div>

<div class="form-group">
    <label>
        Default Version
    </label>
    <select name="is_default" id="" class="form-control">
        <option value="0" {{ old('is_default', $version->is_default) ? old('is_default', $version->is_default) == 0 ? 'selected' : '' : '' }}>No</option>
        <option value="1" {{ old('is_default', $version->is_default) ? old('is_default', $version->is_default) == 1 ? 'selected' : '' : '' }}>Yes</option>
    </select>
    <p class="text-muted">
        Is this version the default that will be displayed (unless directed via link)?
    </p>
</div>

<div class="form-group">
    <label>
        Is Active
    </label>
    <select name="active" id="" class="form-control">
        <option value="0" {{ old('active', $version->active) ? old('active', $version->active) == 0 ? 'selected' : '' : '' }}>No</option>
        <option value="1" {{ old('active', $version->active) ? old('active', $version->active) == 1 ? 'selected' : '' : '' }}>Yes</option>
    </select>
    <p class="text-muted">
        Is this version active? Meaning will it show on the site? You can have an inactive version to get ready before publishing online.
    </p>
</div>