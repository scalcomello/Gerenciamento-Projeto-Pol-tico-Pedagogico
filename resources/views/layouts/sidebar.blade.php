<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">


        <script>
            /** add active class and stay opened when selected */
            var url = window.location;

            // for sidebar menu entirely but not cover treeview
            $('ul.sidebar-menu a').filter(function() {
                return this.href == url;
            }).parent().addClass('active');



        </script>


        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">


            <li class="header">NAVEGAÇÃO PRINCIPAL</li>
            <!-- Optionally, you can add icons to the links -->

            @if(Request::is('*/identificacao'))
                <?php $status = 'active treeview';?>
                @elseif(Request::is('*/historico'))
                <?php $status = 'active treeview';?>
                @elseif(Request::is('*/caracterizacao'))
                <?php $status = 'active treeview';?>
                @else
                <?php $status= ' ';?>
                @endif






            <li {{ (Request::is('home') ? 'class=active': '') }}><a href="/home"><i class="fa fa-home"></i><span>Início</span></a></li>
            <li {{ (Request::is('usuarios') ? 'class=active': '') }}><a href="/usuarios"><i class="fa fa-user"></i><span>Usuários</span></a></li>
            <li {{ (Request::is('cursos') ? 'class=active': '') }}><a href="/cursos"><i class="fa fa-graduation-cap"></i><span>Cursos</span></a></li>
            <li class="header">Configurações Gerais</li>
            <li {{ (Request::is('colaboradores') ? 'class=active': '') }}><a href="/colaboradores"><i class="fa fa-male"></i><span>Colaboradores</span></a></li>
            <li {{ (Request::is('ministerio_da_educacao') ? 'class=active': '') }}><a href="/ministerio_da_educacao"><i class="fa fa-asterisk"></i><span>Ministério da Educação</span></a></li>
            <li {{ (Request::is('conselhosuperior') ? 'class=active': '') }}><a href="/conselhosuperior"><i class="fa fa-bookmark-o"></i><span>Conselho Superior</span></a></li>

            <li class="{{$status}}"><a href="#"><i class="fa fa-building-o"></i><span>Caracteriação Isntitucional</span>
              <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul class="treeview-menu">
                    <li {{ (Request::is('caracterizacao_institucional/identificacao') ? 'class=active': '') }}><a href="/caracterizacao_institucional/identificacao"><i class="fa fa-circle-o"></i> Identificação</a></li>
                    <li {{ (Request::is('caracterizacao_institucional/historico') ? 'class=active': '') }}><a href="/caracterizacao_institucional/historico"><i class="fa fa-circle-o"></i> Histórico</a></li>
                    <li {{ (Request::is('caracterizacao_institucional/caracterizacao') ? 'class=active': '') }}><a href="/caracterizacao_institucional/caracterizacao"><i class="fa fa-circle-o"></i> Caracterização</a></li>
                </ul>
            </li>

            <li {{ (Request::is('diretores_de_campi') ? 'class=active': '') }}><a href="/diretores_de_campi"><i class="fa fa-bank"></i><span>Campi</span></a></li>
            <li {{ (Request::is('equipe_gestora') ? 'class=active': '') }}><a href="/equipe_gestora"><i class="fa fa-group"></i><span>Equipe Gestora</span></a></li>
            <li {{ (Request::is('corpo_administrativo') ? 'class=active': '') }}><a href="/corpo_administrativo"><i class="fa fa-file-text-o"></i><span>Corpo Administrativo</span></a></li>
            <li {{ (Request::is('legislacao') ? 'class=active': '') }}><a href="/legislacao"><i class="fa fa-balance-scale"></i><span>Legislação</span></a></li>
            <li {{ (Request::is('bibliografia') ? 'class=active': '') }}><a href="/bibliografia"><i class="fa fa-book"></i><span>Bibliografia</span></a></li>
            <li {{ (Request::is('disciplina') ? 'class=active': '') }}><a href="/disciplina"><i class="fa fa-list-alt"></i><span>Disciplina</span></a></li>


        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>


