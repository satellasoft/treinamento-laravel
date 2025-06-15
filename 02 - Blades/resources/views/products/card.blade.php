<div class="card mb-3">
    <div class="card-body">
        <h2>{{ $product['name'] }}</h2>
        <p class="card-text">{{ $product['description'] }}</p>

        <div class="d-flex">
            <button class="btn btn-outline-primary ms-auto" data-id="{{ $product['id'] }}">
                Veja mais
            </button>
        </div>
    </div>
</div>
