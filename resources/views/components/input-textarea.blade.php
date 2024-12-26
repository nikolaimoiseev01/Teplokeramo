<div class="flex flex-col flex-1 gap-1 group w-full">
    @if(strlen($title) > 0)
        <label class="text-md font-light" for="">{{$title}}</label>
    @endif
    <textarea  {{ $attributes->merge(['class' => 'text-sm flex-1 w-full text-black-main border-transparent focus:border-transparent focus:ring-0 z-10 relative']) }}></textarea>
</div>
