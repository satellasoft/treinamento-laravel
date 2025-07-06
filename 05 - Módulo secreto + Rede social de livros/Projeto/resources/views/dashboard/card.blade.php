<!-- Card Post -->
<div class="card card-post shadow-sm">
    <div class="position-relative">
        <img id="imagem-post" src="{{ $book->cover }}" class="w-100" alt="The Witcher">
        <button class="icon-btn edit-icon" onclick="abrirModalImagem(document.getElementById('imagem-post').src)">
            <i class="bi bi-pencil-square"></i>
        </button>
    </div>
    <div class="p-3">
        <h5 class="mb-1">{{ $book->title }}</h5>
        <small class="text-muted">{{ $book->author }} - {{ $book->category->name }}<br>Publicado em:
            {{ $book->created_at }}</small>
        <p class="mt-2 mb-3">{{ $book->description }}</p>
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <i class="bi {{ $book->favorite ? 'bi-hand-thumbs-up' : 'bi-hand-thumbs-down' }}"></i>
                {{ $book->favorite ? 'Gostou' : 'Não gostou' }}

                <span class="ms-3">
                    <i class="bi {{ $book->complete ? 'bi-check2-circle' : 'bi-x-circle' }}"></i>
                    {{ $book->complete ? 'Finalizado' : 'Não finalizado' }}
                </span>
            </div>

            <div class="text-warning">
                @for ($i = 1; $i <= 5; $i++)
                    {{ $i <= $book->stars ? '★' : '☆' }}
                @endfor
            </div>
        </div>
        <div class="text-center mt-3">
            <button class="btn btn-secondary btn-sm" onclick="abrirModalEdicao()">Editar</button>
        </div>
    </div>
</div>

<!-- Modal Alterar Imagem -->
<div class="modal fade" id="modalImagem" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alterar Imagem</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <img id="previewImagem" src="" class="img-fluid mb-3" alt="Preview">
                <input type="text" id="novaImagemUrl" class="form-control" placeholder="Cole a nova URL da imagem">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="trocarImagem()">Salvar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Livro -->
<div class="modal fade" id="modalEdicao" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Livro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control mb-2" placeholder="Título" value="The Witcher">
                <input type="text" class="form-control mb-2" placeholder="Autor" value="Fulano de tal">
                <textarea class="form-control mb-2" rows="3">Lorem Ipsum is simply dummy text...</textarea>
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="edit-completo" checked>
                        <label class="form-check-label" for="edit-completo">Completou</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="edit-favorito">
                        <label class="form-check-label" for="edit-favorito">Favorito</label>
                    </div>
                    <label class="ms-auto me-1 mb-0">Estrelas</label>
                    <input type="number" class="form-control" value="4" style="width: 60px;">
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button class="btn btn-danger" onclick="confirmarRemocao()">Remover</button>
                <div>
                    <button type="button" class="btn btn-primary">Salvar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirmar Remoção -->
<div class="modal fade" id="modalConfirmarRemocao" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-danger">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Confirmar Remoção</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja remover este livro?
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger">Sim, remover</button>
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function abrirModalImagem(imagemAtual) {
        document.getElementById('previewImagem').src = imagemAtual;
        document.getElementById('novaImagemUrl').value = imagemAtual;
        const modal = new bootstrap.Modal(document.getElementById('modalImagem'));
        modal.show();
    }

    function trocarImagem() {
        const novaUrl = document.getElementById('novaImagemUrl').value;
        document.getElementById('imagem-post').src = novaUrl;
        bootstrap.Modal.getInstance(document.getElementById('modalImagem')).hide();
    }

    function abrirModalEdicao() {
        const modal = new bootstrap.Modal(document.getElementById('modalEdicao'));
        modal.show();
    }

    function confirmarRemocao() {
        const modal = new bootstrap.Modal(document.getElementById('modalConfirmarRemocao'));
        modal.show();
    }
</script>
