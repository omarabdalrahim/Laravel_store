
@if($errors->any())
<div class="alert alert-danger">
    <h3>Error Occured!</h3>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="form-group">
    <label for="">Category Name</label>
    <x-form.input label="Category Name" class="form-control-lg" role="input" name="name" :value="$category->name" />
 </div>
 <div class="form-group">
    <label for="">Category Parent</label>
    <select name="parent_id" class="form-control">
    <option value="">Primary Category</option>

    @foreach($parents as $parent)
        <option value="{{$parent->id}}" {{(old('parent_id', $category->parent_id) == $parent->id)?"selected":""}}>{{$parent->name}}</option>
        @endforeach
    </select>
 </div>
 <div class="form-group">
    <label for="">Description </label>
        <x-form.textarea name="description" :value="$category->description" />
 </div>
 <div class="form-group">
    <x-form.label id="image">Image</x-form.label>
    <x-form.input type="file" name="image"  accept="image/*" />
 </div>
 <div class="form-group">
    <label for="">Status</label>
 <div class="form-check">
     <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="active" {{ (old('status',$category->status) =="active")? "checked" : "" }}>
    <label class="form-check-label" for="exampleRadios1">
        Actived
    </label>
    </div>
    <div class="form-check">
    <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="archived" {{ (old('status',$category->status)=="archived")? "checked" : "" }}>
    <label class="form-check-label" for="exampleRadios2">
        Archived
    </label>
     </div>
 </div>
 <div class="form-group">
    <button type="submit"  class="btn btn-primary">Save</button>
 </div>
