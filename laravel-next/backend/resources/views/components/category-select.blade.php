@props(['name', 'label', 'errors', 'data'])

<div>
    <label for="{{ $name }}">{{ $label }}:</label>
    <select name="{{ $name }}" {{ $attributes->merge(['class' => 'form-control ']) }}>
        @foreach ($kategorilerOptions as $key => $value)
            <option value="{{ $key }}" @if (($data != '' && $data == $key) || old($name) == $key) selected @endif>
                {{ $value }}
            </option>
        @endforeach
    </select>
    @if ($errors->has('kategori_id'))
        <span class="text-danger">{{ $errors->first('kategori_id') }}</span><br>
    @endif
</div>
