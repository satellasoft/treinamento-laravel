<h5 class="mb-3">Cadastrar</h5>
<form action="{{ route('user.register') }}" method="post">
    @csrf
    <input name="name" type="text" class="form-control mb-2" placeholder="Nome">
    <input name="username" type="text" class="form-control mb-2" placeholder="Username">
    <input name="email" type="email" class="form-control mb-2" placeholder="Email">
    <input name="password" name="password" type="password" class="form-control mb-2" placeholder="Senha">
    <button class="btn btn-success w-100">Registrar</button>
</form>
