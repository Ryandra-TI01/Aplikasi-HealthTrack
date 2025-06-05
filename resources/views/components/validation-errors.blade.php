@props(['field'])

@error($field)
    <span class="text-red-500 text-sm flex items-center mt-2">
        <img src="{{asset('images/error.png')}} " alt="error" class="w-4 inline-block mr-1">
        {{ $message }}
    </span>
@enderror
