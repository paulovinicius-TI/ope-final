/* Busca e paginação */
function ativaBuscaPaginacao(lista, o) {
    var paginaAtual = 0;
    var encontrados;
    var qtdPaginas;

    var paginar = function () {
        if (encontrados == 0) {
            $(lista).find('> tbody > .nenhum-registro').show();
		}
        else {
            $(lista).find('> tbody > .nenhum-registro').hide();
		}

        if (o.elPaginacao) {
            $(o.elPaginacao).show();
            if (encontrados <= o.itensPorPag) {
                $(o.elPaginacao).hide();
            } else {
                $(o.elPaginacao).show();
                qtdPaginas = Math.ceil(encontrados / o.itensPorPag);
                $(o.elPaginacao).find('ul').empty();
                for (var i = 1; i <= qtdPaginas; i++) {
                    $(o.elPaginacao).find('ul').append('<li><a href="javascript:void(0);">' + (i) + '</a></li>');
                }
                $(o.elPaginacao).find('ul li').click(function () {
                    paginaAtual = parseInt($(this).index());
                    $(lista).find('> tbody > tr').not('.nenhum-registro').hide();
                    for (var i = 0; i < o.itensPorPag; i++) {
                        $(lista).find('> tbody > tr').not('.nenhum-registro').eq(o.itensPorPag * paginaAtual + i).show();
                    }
                    $(this).find('a').addClass('marcado').parent().siblings().find('a').removeClass('marcado');
                })
                .eq(0).click().find('a').addClass('marcado');
            }
        }
    }

    var paginarTudo = function () {
        encontrados = 0;
        $(lista).find('> tbody > tr').not('.nenhum-registro').each(function () {
            encontrados++;
        });
        paginar();
    };

    $(lista).get(0).paginar = paginarTudo;

    if (o.elInput) {
        $(o.elInput).keyup(function () {
            encontrados = 0;
            var val = $(this).val().toLowerCase();
            $(lista).find('> tbody > tr').not('.nenhum-registro').each(function () {
                if ($(this).text().toLowerCase().indexOf(val) != -1) {
                    $(this).show();
                    encontrados++;
                } else {
                    $(this).hide();
                }
            });
            paginar();
        }).keyup();
    } else {
        paginarTudo();
    }
}


function pagination(qtd,tabela,pesquisa){
    ativaBuscaPaginacao(tabela,
        {
            elPaginacao: '#paginacao', 
            itensPorPag: +qtd.value, 
            elInput: pesquisa
        }
    );
}