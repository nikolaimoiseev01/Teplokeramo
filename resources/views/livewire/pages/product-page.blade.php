<main class="content flex-1">
    <h1 class="text-3xl">{{$product['name']}}</h1>
    @if(Auth::check())
        <a href="/admin/products/{{$product['id']}}/edit"  target="_blank" class="link mb-8 block">Товар в Админке</a>
    @endif
</main>
