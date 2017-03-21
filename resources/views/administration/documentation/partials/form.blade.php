<div class="form-group">
    <label>
        Document Title <i class="fa fa-asterisk text-danger"></i>
    </label>
    <input type="text" class="form-control" name="title" value="{{ old('title', $document->title) }}" autofocus="autofocus">
</div>

<div class="form-group">
    <label>
        Mark Down
    </label>
    <textarea name="markdown" id="markdown" cols="30" rows="10" class="form-control">{{ old('markdown', $document->markdown) }}</textarea>
</div>