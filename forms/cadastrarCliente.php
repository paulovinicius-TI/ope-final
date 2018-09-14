<div class="card-title mt-5 text-center">
   <h1>Cadastro de Cliente</h1>
   <table class="container-fluid">
   <tbody>
      <tr>
         <td>
            <form method="post" class="formatar">
               <input type="hidden" name="formulario" value="cliente">
               <input type="hidden" name="acao" value="cadastrarC">
               <fieldset>
                  <table>
                     <tr>
                        <td>
                           <div class="form-group">
                              <label class="col-md-4 control-label">Nome</label>
                              <div class="col-md-8 inputGroupContainer">
                              <input placeholder="Nome" name="nome" class="form-control" type="text"></div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-4 control-label">CPF</label>
                              <div class="col-md-8 inputGroupContainer" >
                              <input placeholder="CPF" name="cpf" class="form-control" type="text" maxlength="14" OnKeyPress="formatar('###.###.###-##', this)"></div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-4 control-label">Endereço</label>
                              <div class="col-md-8 inputGroupContainer">
                              <input placeholder="Endereço" name="endereco" class="form-control" type="text"></div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-4 control-label">Cidade</label>
                              <div class="col-md-8 inputGroupContainer">
                              <input placeholder="Cidade" name="cidade" class="form-control" type="text"></div>
                           </div>
                        </td>
                        <td>
                           <div class="form-group">
                              <label class="col-md-4 control-label">Sobrenome</label>
                              <div class="col-md-8 inputGroupContainer">
                              <input placeholder="Sobrenome" name="sobrenome" class="form-control" type="text"></div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-4 control-label">Telefone</label>
                              <div class="col-md-8 inputGroupContainer">
                              <input placeholder="Telefone" name="telefone" class="form-control" type="text"  maxlength="13" OnKeyPress="formatar('##-#####-####', this)"></div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-4 control-label">Número</label>
                              <div class="col-md-8 inputGroupContainer">
                              <input placeholder="Número" name="numero" class="form-control" type="text"></div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-4 control-label">Bairro</label>
                              <div class="col-md-8 inputGroupContainer">
                              <input placeholder="Bairro" name="bairro" class="form-control" type="text"></div>
                           </div> 
                        <td>
                     </tr>
                  </table>
               </fieldset>
               <button type="submit" class="btn btn-primary salvar">Salvar</button>
            </form>
         </td>
          </tr>
   </tbody>
   </table>
</div>