@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h2>Termo de Aceite</h2>
@stop

@section('content')
<!-- Termo de Aceite Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Termo de Uso para Utilização do Sistema</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6><strong>1. Aceitação dos Termos</strong></h6>
                <p>Ao utilizar o sistema de software online disponibilizado pela [Nome da Empresa], você, doravante denominado "Usuário", concorda integralmente com os Termos de Uso descritos abaixo. Este Termo constitui um contrato legal entre você e [Nome da Empresa] e rege o acesso e a utilização das funcionalidades oferecidas, incluindo cadastro de clientes, fichas de atendimento, calendário interno e módulo financeiro.</p>

                <h6><strong>2. Objeto do Termo</strong></h6>
                <p>O presente Termo estabelece as condições para o uso do sistema de software online, que compreende as funcionalidades de cadastro de clientes, fichas de atendimento, calendário interno para organização de atividades e agendamentos, e controle financeiro.</p>

                <h6><strong>3. Uso Permitido</strong></h6>
                <ul>
                    <li><strong>Cadastro de Clientes:</strong> Inserção, edição e consulta de dados cadastrais dos clientes para fins de gestão e acompanhamento.</li>
                    <li><strong>Ficha de Atendimento:</strong> Registro de informações relativas ao atendimento de clientes, incluindo dados relevantes sobre o histórico de atendimento.</li>
                    <li><strong>Calendário Interno:</strong> Organização de compromissos e agendamentos de forma integrada para o acompanhamento de atividades internas.</li>
                    <li><strong>Financeiro:</strong> Controle de informações financeiras pertinentes ao atendimento e gestão interna.</li>
                </ul>

                <h6><strong>4. Obrigações do Usuário</strong></h6>
                <ul>
                    <li>O Usuário é responsável por fornecer informações precisas, verídicas e completas no sistema.</li>
                    <li>O Usuário deverá manter suas credenciais de acesso (usuário e senha) em segurança, sendo proibida a sua cessão a terceiros.</li>
                    <li>O Usuário compromete-se a utilizar o sistema em conformidade com todas as normas e regulamentações aplicáveis, incluindo, mas não se limitando, à Lei Geral de Proteção de Dados Pessoais (LGPD - Lei nº 13.709/2018).</li>
                </ul>

                <h6><strong>5. Privacidade e Proteção de Dados</strong></h6>
                <ul>
                    <li>Os dados inseridos no sistema serão tratados em conformidade com a LGPD e serão utilizados exclusivamente para as finalidades previstas neste Termo.</li>
                    <li>[Nome da Empresa] compromete-se a adotar as medidas de segurança necessárias para proteger os dados armazenados no sistema contra acessos não autorizados, perda ou divulgação indevida.</li>
                    <li>Para mais informações sobre o tratamento de dados pessoais, consulte nossa Política de Privacidade.</li>
                </ul>

                <h6><strong>6. Limitações de Responsabilidade</strong></h6>
                <ul>
                    <li>[Nome da Empresa] não se responsabiliza por danos diretos, indiretos, incidentais, especiais ou consequenciais resultantes do uso ou da incapacidade de uso do sistema.</li>
                    <li>[Nome da Empresa] não se responsabiliza por eventuais falhas de conexão, erros de transmissão de dados, ou quaisquer outros problemas relacionados a provedores de serviços de internet do Usuário.</li>
                </ul>

                <h6><strong>7. Propriedade Intelectual</strong></h6>
                <ul>
                    <li>Todos os direitos de propriedade intelectual sobre o sistema, incluindo layout, design, funcionalidades, marca e demais conteúdos, são de propriedade exclusiva de [Nome da Empresa]. O Usuário não tem permissão para copiar, distribuir, modificar ou utilizar tais conteúdos para quaisquer finalidades não autorizadas.</li>
                </ul>

                <h6><strong>8. Alterações no Termo de Uso</strong></h6>
                <ul>
                    <li>[Nome da Empresa] reserva-se o direito de alterar este Termo a qualquer momento, notificando o Usuário através de mensagem no sistema ou pelo e-mail cadastrado. O uso contínuo do sistema após alterações no Termo constitui aceitação tácita das modificações realizadas.</li>
                </ul>

                <h6><strong>9. Backup e Recuperação de Dados</strong></h6>
                <ul>
                    <li>Será realizado um backup mensal de toda a base de dados, visando a segurança e preservação das informações armazenadas.</li>
                    <li>Caso o Usuário necessite de recuperação de dados de um backup anterior devido a erro próprio, será cobrada a hora técnica para a realização desse serviço. No entanto, em situações onde a necessidade de recuperação de backup decorra de falhas da plataforma, tal serviço será prestado sem qualquer ônus ao Usuário.</li>
                    <li>Caso o Usuário deseje backups em intervalos mais frequentes que o mensal, o valor do serviço será acordado entre as partes e adicionado aos encargos contratuais.</li>
                </ul>

                <h6><strong>10. Vigência e Rescisão</strong></h6>
                <ul>
                    <li>Este Termo é válido por tempo indeterminado, enquanto o Usuário utilizar o sistema.</li>
                    <li>O não cumprimento das obrigações descritas neste Termo poderá acarretar na suspensão ou cancelamento imediato do acesso ao sistema, sem prejuízo das medidas legais cabíveis.</li>
                </ul>

                <h6><strong>11. Lei Aplicável e Foro</strong></h6>
                <p>Este Termo será regido e interpretado de acordo com as leis brasileiras. Para dirimir quaisquer controvérsias oriundas deste Termo, as partes elegem o foro da comarca de [Cidade e Estado], renunciando a qualquer outro, por mais privilegiado que seja.</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('terms.accept') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary">Aceitar Termo</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- Link to trigger the modal -->
<button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#termsModal">
    Leia o Termo de Uso
</button>

@stop

@section('css')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
