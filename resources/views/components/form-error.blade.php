@props(['name'])

@error($name)
<p class="text-red-500 italic mt-2 font-bold text-xs">{{ $message }}</p>
@enderror
