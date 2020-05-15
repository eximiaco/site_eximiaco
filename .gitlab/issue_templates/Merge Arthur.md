## Narrativa
Esta tarefa tem intuito de efetuarmos o processo de *merge* do material desenvolvido pelo programador Arthur em nosso contexto de desenvolvimento.


## Observações técnicas
Deve-se executar o processo de merge do branch `arthur` dentro das etapas especificadas nesta tarefa.

O processo será sempre o mesmo, alterando-se o branch da etapa referida.

```bash
git checkout [branch da etapa]
git merge arthur --squash
git commit -m "Merge branch 'arthur' into '[branch da etapa]'"
git push
```

Nesta tarefa seguimos o restante do nosso workflow, documentando nos comentários os hash dos commits em suas devidas etapas.


## Validação 

Deve-se revisar o código desenvolvido e commitado pelo programador Arthur, a fim de detectarmos quaisquer inconformidades com o padrão de desenvolvimento e eventuais problemas de quebra.


## Etapas

* Especificação
* Deploy em staging
* Deploy em produção
* Fechamento

/label ~"Merge Arthur"
