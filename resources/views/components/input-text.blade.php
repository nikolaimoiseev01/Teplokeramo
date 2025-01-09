<div class="flex flex-col gap-1 group w-full">
    @if(strlen($title) > 0)
        <label class="text-md" for="">{{$title}}</label>
    
    @endif
    <div class="relative">
        <input
            {{ $attributes->merge(['class' => 'text-sm w-full text-black-main border-transparent focus:border-transparent focus:ring-0 z-10 relative']) }} type="text">
    </div>
</div>
