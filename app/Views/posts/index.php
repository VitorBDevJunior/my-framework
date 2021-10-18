

<div class="container ">
<?= Session::msgAlerta('posts') ?>
    <div class="card">
<nav class="navbar navbar-light" style="background-color:rgba(117, 190, 218, 0.5);">

    <h5> POSTAGENS<h5>
            <div class="">
                <a href="<?= URL ?>/Posts/cadastrarPost" class="btn btn-primary">Escrever</a>
            </div>
           
</nav>
<div class="card-body">
    <?php foreach ($dados['posts'] as $post) : ?>
        <div class="card my-5">
            <div class="card-header">
            <div class="alert alert-dark" role="alert">
            <?= $post->titulo ?>   
            </div>
            <div class="card-body">
                <p class="card-text"><?= $post->texto ?></p>
                <a href="<?=URL.'/Posts/show/'. $post->postId?>" class="btn btn-outline-primary">Ler mais...</a>
            </div>
            <div class="alert alert-primary">
                Escrito por:  <?= $post->nome ?> | Criado em: <?=Validate::dataBr($post->postDataCadastro)?>
            </div>
        </div>

        
    <?php endforeach; ?>
</div>
</div>
</div>
    </div>
