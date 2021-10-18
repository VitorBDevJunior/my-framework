<div class="col-md-8 mx-auto p-5">

<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="<?=URL?>/posts">Posts</a></li>
<li class="breadcrumb-item active" aria-current="page">Escrever</li>
</ol>
</nav>
<div class="card">
<div class="card-header bg-secondary text-white">
    <h4>Escrever Post</h4>
</div>
<div class="card-body bg-light">
    
    <form class="mt-4" name="posts" method="POST" action="<?= URL ?>/Posts/cadastrarPost">
        <div class="form-group">
            <label for="titulo">Título:<sup class="text-danger">*</sup></label>
            <input type="text" name="titulo" id="titulo" class="form-control <?= $dados['titulo_erro'] ? 'is-invalid' : null ?>" value="<?= $dados['titulo'] ?>">
            <div class="invalid-feedback">
                <?= $dados['titulo_erro'] ?>
            </div>
        </div>
        <div class="form-group">
            <label for="texto"> <strong>Texto:</strong><sup class="text-danger">*</sup></label>
            <textarea name="texto" id="texto" cols="30" rows="10" class="form-control <?= $dados['texto_erro'] ? 'is-invalid' : null ?>"><?= $dados['texto'] ?></textarea>
            <div class="invalid-feedback">
                <?= $dados['texto_erro'] ?>
            </div>
        </div>
 <input type="submit" value="Cadastrar" class="btn btn-primary">
</form>
</div>

</div>

</div>