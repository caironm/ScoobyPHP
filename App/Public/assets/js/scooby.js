document.addEventListener('DOMContentLoaded', function(){
    $('.modal').modal()
    $('.sidenav').sidenav()
    $('.parallax').parallax()
    $('.fixed-action-btn').floatingActionButton()
    $('.counter').characterCounter()
    $('.materialboxed').materialbox()
    $('.datepicker').datepicker({
        selectMonths: true,
        selectYears: 20,
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        i18n: {
            today: 'Hoje',
            clear: 'Limpar',
            done: 'Ok',
            nextMonth: 'Próximo mês',
            previousMonth: 'Mês anterior',
            weekdaysAbbrev: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
            weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
            weekdays: ['Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'],
            monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']
        },
        format: 'dd-mm-yyyy',
        closeOnSelect: true,
        container: 'body'
    });
    $('.select').formSelect();
    $(document).on('scroll', function() {
        if($(window).scrollTop() > 35) {
            $('nav').css('border-bottom', '1px solid #f0f0f0')
            $('#lg').css('transform', 'scale(1.2)')
            $('.icon').css('transform', 'rotate(15deg) scale(.9)')
            $('.cover-img').css('transform', 'rotate(15deg)')
            $('.cover-img').css('transition', '1s')
            $('#lg').css('transition', '.2s')
            $('.btn-login').css('transform', 'scale(1.2)')
            $('.btn-login').css('transition', '.2s')
            $('.btn-project').css('background', 'red')
            $('.btn-project').addClass('btn-floating')
            $('.btn-project').addClass('btn-project-scrool')
            $('.btn-project').addClass('btn-large')
            $('.new-project-text-buttom').hide()
        } else {
            $('nav').css('border-bottom', '0px solid #fff')
            $('#lg').css('transform', 'scale(1.0)')
            $('#lg').css('transition', '.2s')
            $('.btn-login').css('transform', 'scale(1.0)')
            $('.btn-login').css('transition', '.2s')
            $('.cover-img').css('transform', 'rotate(10deg)')
            $('.cover-img').css('transition', '.5s')
            $('.btn-project').removeClass('btn-floating')
            $('.btn-project').removeClass('btn-project-scrool')
            $('.btn-project').removeClass('btn-large')
            $('.new-project-text-buttom').show()
            $('.icon').css('transform', 'rotate(15deg) scale(1)')

        }
     });
})
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

function isOnline(titleFailure, msgFailure, titleSuccess, msgSuccess){
   window.addEventListener('online', function() {
        Toast.fire(
            titleSuccess,
            msgSuccess,
            'success'
        );
    })
    window.addEventListener('offline', function(){
        Toast.fire(
            titleFailure,
            msgFailure,
            'warning'
        );
    })
}
function deleteConfirm(url, csrfToken = '', redirect = '', data = {}){
      swal.fire({
        title: 'Você esta certo disso?',
        text: "Esta ação não poderá ser revertida!",
        showCancelButton: true,
        confirmButtonText: 'Deletar!',
        cancelButtonText: 'Cancelar!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
            $.ajax({
                method: 'delete',
                url: url,
                data: {csrfToken:csrfToken, data:data},
                success: function(data) {
                }
              });
          Toast.fire(
            '💔 Deletado!',
            'Deletado com sucesso.',
            'success'
          ).then(function (){
                window.location.href=redirect;
          })
        } else if (
          result.dismiss === Swal.DismissReason.cancel
        ) {
          Toast.fire(
            'Cancelado',
            'Cancelado com sucesso :)',
            'error'
          )
        }
      })
  }
function logout(token) {
    $.ajax({
        method: 'get',
        url: 'http://scoobytasks.com.br/logout',
        data: { csrfToken: csrfToken },
        success: function (data) {
            console.log(data)
        },
        error: function(){
            console.log('erro')
        }
    });
}
function closeModal(modal) {
    $(modal).modal('close');
}
function share(id, name) {
    $('#modal-share').modal('open')
    $('#input-project-name-share').val(name)
    $('#project_share_id').val(id)
}
