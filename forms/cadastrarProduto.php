<div class="card-title mt-5 text-center">
   <h1>Cadastro de Produto</h1>
   <table class="container-fluid">
   <tbody>
      <tr>
         <td>
            <form method="post" class="formatar">
               <input type="hidden" name="formulario" value="cadastrar-pessoal">
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
                              <label class="col-md-4 control-label">Preço Unitário</label>
                              <div class="col-md-8 inputGroupContainer">
                              <input placeholder="Preço Unitário" name="endereco" class="form-control" type="text"></div>
                           </div>
                        </td>
                        <tb>
                           <div class="form-group">
                              <label for="sel1">Categoria</label>
                              <select class="form-control" id="sel1" name="cargo">
                                <option value="0">Não informado</option>
                                <option value="1">-</option>
                              </select>
                           </div>
                        </tb>
                        <td>
                           <div class="form-group">
                              <label class="col-md-4 control-label">Quantidade</label>
                              <div class="col-md-8 inputGroupContainer">
                              <input placeholder="Sobrenome" name="sobrenome" class="form-control" type="text"></div>
                           </div>
                           <div class="form-group">
                              <label for="sel1">Fornecedor</label>
                              <select class="form-control" id="sel1" name="cargo">
                                <option value="0">Não informado</option>
                                <option value="1">-</option>
                              </select>
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