document.addEventListener('DOMContentLoaded', function(){
    $('.sidenav').sidenav()
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
