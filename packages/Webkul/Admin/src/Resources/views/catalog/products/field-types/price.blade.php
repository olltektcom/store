@if($attribute->id == 12)
<input
type="text"
v-validate="'{{$validations}}'"
class="control"
id="{{ $attribute->code }}"
name="{{ $attribute->code }}"
value="{{ old($attribute->code) ?: $product[$attribute->code]}}"
placeholder="20.00"
min="1.00"
data-vv-as="&quot;{{ $attribute->admin_name }}&quot;"
/>
@else
<input
type="text"
v-validate="'{{$validations}}'"
class="control"
id="{{ $attribute->code }}"
name="{{ $attribute->code }}"
value="{{ old($attribute->code) ?: $product[$attribute->code]}}"
data-vv-as="&quot;{{ $attribute->admin_name }}&quot;"
/>
@endif