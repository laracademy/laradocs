<div class="form-group">
    <label>
        Version Title
    </label>
    <input type="text" class="form-control" name="tag" value="{{ old('tag', $version->tag) }}">
</div>

<div class="form-group">
    <label>
        Is Default
    </label>
    <select name="is_default" id="" class="form-control">
        <option value="0" {{ old('is_default', $version->is_default) ? old('is_default', $version->is_default) == 0 ? 'selected' : '' : '' }}>No</option>
        <option value="1" {{ old('is_default', $version->is_default) ? old('is_default', $version->is_default) == 1 ? 'selected' : '' : '' }}>Yes</option>
    </select>
</div>

<div class="form-group">
    <label>
        Is Active
    </label>
    <select name="active" id="" class="form-control">
        <option value="0" {{ old('active', $version->active) ? old('active', $version->active) == 0 ? 'selected' : '' : '' }}>No</option>
        <option value="1" {{ old('active', $version->active) ? old('active', $version->active) == 1 ? 'selected' : '' : '' }}>Yes</option>
    </select>
</div>