<div class="container">
<div class="card bg-light">
    <?= Session::msgAlerta('usuario') ?>
    <div class="row">
        <div class="col-md-4">
            <div class="card m-3">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title text-center"><?= $dados['nome'] ?></h5>
                </div>
                <div class="card-body">
           <p class="card text-left"> <?= $dados['biografia']?></p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card m-3">
                <div class="card-header bg-secondary text-white">
                    Dados Pessoais
                </div>
                <div class="card-body">
                <form name="atualizar" method="POST" action="<?= URL ?>/Users/perfil/<?= $dados['id'] ?>">
                        <div class="form-group">
                            <label for="nome">Nome: <sup class="text-danger">*</sup></label>
                            <input type="text" name="nome" id="nome" value="<?= $dados['nome'] ?>" class="form-control <?= $dados['nome_erro'] ? 'is-invalid' : '' ?>">
                            <div class="invalid-feedback">
                                <?= $dados['nome_erro'] ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail: <sup class="text-danger">*</sup></label>
                            <input type="email" name="email" id="email" value="<?= $dados['email'] ?>" class="form-control <?= $dados['email_erro'] ? 'is-invalid' : null ?>">
                            <div class="invalid-feedback">
                                <?= $dados['email_erro'] ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="senha">Senha:</label>
                            <input type="password" name="senha" id="senha" class="form-control  <?= $dados['senha_erro'] ? 'is-invalid' : '' ?>">
                            <div class="invalid-feedback">
                                <?= $dados['senha_erro'] ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="biografia">Biografia:</label>
                            <textarea  rows="5" name="biografia" id="biografia" class="form-control"> <?= $dados['biografia'] ?></textarea>
                        </div>

                        <input type="submit" value="Atualizar" data-toggle="tooltip" title="Atualizar Dados do Perfil" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>