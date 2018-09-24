<div class="card-title mt-5 text-center">
   <h1>Cadastrar Pedido </h1>
   <table class="container-fluid">
   <tbody>
      <tr>
         <td>
            <form method="post" class="formatar">
               <input type="hidden" name="formulario" value="funcionario">
               <input type="hidden" name="acao" value="cadastrarF">
               <fieldset>
                  <table>
                     <tr>
                        <td> <label class="col-md-4 control-label">Cliente cadastrado?</label></td>
                        <td>
                              <label for="s">Sim</label><input placeholder="Nome" name="cadastrado" class="form-control" id="s" type="radio" value="1">
                        <td>
                        <td>
                           <label for="n">Não</label><input placeholder="Nome" name="cadastrado" class="form-control" id="n" type="radio" onclick="ativarCliente()" value="0"></div>
                        </td>
                     </tr>
                     <tr>
                     
                        <td>
                           <form class="cadastro">
                              <input type="" name="cliente">
                              <input type="submit" name="pesquisar" value="Pesquisar">
                           </form>
                        </td>
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