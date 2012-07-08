<div id="tudo">
    <img src="recursos/imagens/logo.gif" height="100" width="300"/> 
    <!--    <div id="titulo"><a>CECAE</a></div>-->
    <div id="barraLinkSuperior">
        <ul id="nav" class="navega">
            <li><a href="#" title="P&aacute;gina pricipal">Home</a></li>
            <li><a href="#" title="Sobre a escola">O Col&eacute;gio</a>
                <ul class="subMenu">
                    <li><a href="#" class="subitem">Hist&oacute;ria</a></li>
                    <li><a href="#" class="subitem">Localiza&ccedil;&atilde;o</a></li>
                    <li><a href="#" class="subitem">Mensagem do diretor</a></li>
                    <li><a href="#" class="subitem">Dire&ccedil;&atilde;o</a></li>
                    <li><a href="#" class="subitem">Funcion&aacute;rios</a></li>
                    <li><a href="#" class="subitem">Secret&aacute;ria</a></li>
                    <li><a href="#" class="subitem">Professores</a></li>
                    <li><a href="#" class="subitem">Ambiente escolar</a></li>
                    <li><a href="#" class="subitem">Regimento interno</a></li>
                    <li><a href="#" class="subitem">Certificados</a></li>
                </ul>
            </li>
            <li><a href="#" title="Projetos pedag&oacute;gicos">Projeto Pedag&oacute;gico</a></li>
            <li><a href="#" title="Calend&aacute;rio escolar">Calend&aacute;rio</a></li>
            <li><a href="#" title="Fale conosco">Contato</a></li>
        </ul>
    </div>
    <div id="bannerSuperior"> 
    </div>
    <div id="barraLinkInferior">
        <ul id="navegaInferior" class="navega" >
            <li><a href="fotos.html" title="Galeria de fotos">Fotos</a></li>
            <li><a href="recados.php" title="Recados">Recados</a></li>
            <li><a href="videos.html" title="Galeria de v&iacute;deos">V&iacute;deos</a></li>
            <li><a href="alunos.html" title="Alunos">Alunos</a></li>
        </ul>
    </div>
    <div id="conteudo">
        <div id="conteudoEsquerda"></div>
        <div id="conteudoDireita">
            <div id="avisos"><h4>Avisos<a href="">mais</a></h4>
                <table>
                    <tbody>
                        <?php
                        $todosAvisos = unserialize($todosAvisos);
                        for ($i = 1; $i <= count($todosAvisos) || $i == 3; $i++) {
                            ?>
                            <tr>
                                <td><?php echo $todosAvisos[$i]->getData(); ?></td>
                                <td><?php echo $todosAvisos[$i]->getAviso(); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>    
                </table>
            </div>
            <div id="aprovados"><h4>Aprovados</h4></div>
            <div id="responsaveis"><h4>Respons&aacute;veis</h4></div>
            <div id="parceirosColegio"><h4>Parceiros do col&eacute;gio</h4></div>
        </div>
    </div>
    <div id="bannerInferior"></div>
    <div id="rodape"><a>Todos os direitos reservados a SapuKaia Sistemas &COPY; 2011-2012 </a></div>
</div>

