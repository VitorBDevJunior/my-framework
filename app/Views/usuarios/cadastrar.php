<div class="col-sm-3 col-md-5 mx-auto p-3">
<div class="card">
<div class="card-header bg-secondary text-white">
    <h2>Cadastre-se</h2>
</div>
<div class="card">

<div class="card-body"> 
<p class="card-text"> <small><strong>Preencha o formulário abaixo para realizar seu cadastro</strong></small>  

<form class="form-control form-control-sm" name="cadastrar" method="POST" action="<?=URL?>/Users/cadastrar">

    <div class="form-group">
  <label for="nome"> <strong>Nome:</strong><sup class="text-danger">*</sup></label>
  <input type="text" name="nome" id="nome" class="form-control <?= $dados['nome_erro'] ? 'is-invalid': null ?>"value="<?=$dados['nome']?>">
  <div class="invalid-feedback">
  <?= $dados['nome_erro'] ?>
  </div>
</div>
<div class="form-group">
  <label for="email"> <strong>E-mail:</strong><sup class="text-danger">*</sup></label>
  <input type="email" name="email" id="email" class="form-control <?= $dados['email_erro'] ? 'is-invalid': null ?>" value="<?=$dados['email']?>">
  <div class="invalid-feedback">
  <?= $dados['email_erro'] ?>
  </div>
</div>
<div class="form-group">
  <label for="senha"> <strong>Senha:</strong><sup class="text-danger">*</sup></label>
  <input type="password" name="senha" id="senha" class="form-control <?= $dados['senha_erro'] ? 'is-invalid': null ?>"value="<?=$dados['senha']?>">
  <div class="invalid-feedback">
  <?= $dados['senha_erro'] ?>
  </div>
</div>
<div class="form-group">
  <label for="confirmar_senha"><strong>Confirmação da senha:</strong><sup class="text-danger">*</sup></label>
  <input type="password" name="confirmar_senha" id="confirmar_senha" class="form-control <?= $dados['confirmar_senha_erro'] ? 'is-invalid': null ?>"value="<?=$dados['confirmar_senha']?>">
  <div class="invalid-feedback">
  <?= $dados['confirmar_senha_erro'] ?>
  </div>
</div>
<div class="row">
    <div class="col">
    <input type="submit" value="Cadastrar" class="btn btn-primary">
    </div>
    <div class="col-md-8">
    <a href="<?=URL?>/Users/login">Já tem uma conta? faça login</a>
    </div>
</div>
    
    </form>
    
</div>
</div>
</div>
</div>