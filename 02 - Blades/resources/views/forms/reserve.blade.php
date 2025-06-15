<div class="card mb-3">
    <div class="card-body">
        <h2>Reserve um produto</h2>

        <form action="{{ route('products.reserve') }}" method="POST">
            @csrf
            <div>
                <label for="name">Nome</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Digite seu nome">
            </div>

            <div class="mt-3">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" class="form-control"
                    placeholder="Digite o seu E-mail">
            </div>

            <div class="mt-3">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Erros encontrados:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <div class="d-flex mt-3">
                <button type="submit" class="btn btn-success ms-auto">
                    Reservar
                </button>
            </div>
        </form>


    </div>
</div>
