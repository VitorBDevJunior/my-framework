<div class="col-sm-3 col-md-5 mx-auto p-3">
<div class="card">
<div class="card-header bg-secondary text-white">
      <h2>Login</h2>
      <?=Session::msgAlerta('usuario')?>
</div>
<div class="card">
<div class="card-body">
<p class="card-text"> <small><strong>Informe seus dados para fazer login</strong></small>  
<form class="form-control form-control-sm" name="login" method="POST" action="<?=URL?>/Users/login">
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

<div class="row">
    <div class="col">
    <input type="submit" value="Login" class="btn btn-primary">
    </div>
    <div class="col">
    <a href="<?=URL?>/Users/cadastrar">Não tem uma conta? cadastre-se</a>
    </div>
</div>
    
    </form>
    </div>
</div>
</div>

</div>