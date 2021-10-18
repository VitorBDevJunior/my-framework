<div class="container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">

      <li class="breadcrumb-item"><a href="<?= URL ?>/posts">
          <h6>Posts<h6>
        </a></li>
      <li class="alert alert-dark" aria-current="page"> <?= $dados['post']->titulo ?></li>

    </ol>
  </nav>
  <div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
      <p class="card-text"> <?= $dados['post']->texto ?></p>
    </div>
    <div class="card-footer text-light">
      Escrito por: <?= $dados['usuario']->nome ?> | Criado em: <?= Validate::dataBr($dados['post']->created_at) ?>
    </div>

        <?php if ($dados['post']->usuario_id == $_SESSION['usuario_id']):?>
            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="<?= URL.'/Posts/editarPost/'.$dados['post']->id?>"class="btn btn-sm btn-primary">Editar</a> 
                </li>  
                <li class="list-inline-item">
                    <form action="<?= URL.'/Posts/delete/'.$dados['post']->id?>" method="POST">
                    <input type="submit" class="btn btn-sm btn-danger" value="Excluir">
                  </form>
                </li>
            </ul>

        <?php endif; ?>

        </div>
  </div>
</div>