function showCustomConfirm(event, formId) {
    // Impede o envio do formulário
    event.preventDefault();

    Swal.fire({
        title: '<strong style="font-size: 20px;">Deseja realmente excluir esta aula?</strong>',
        html: '<span style="font-size: 14px;">Esta operação não poderá ser desfeita.</span>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false, // Impede fechar ao clicar fora do modal
        allowEscapeKey: true // Impede fechar ao pressionar Esc
    }).then((result) => {
        if (result.isConfirmed) {
            // Submete o formulário correto manualmente após a confirmação
            document.getElementById(formId).submit();
        }
    });
}

// Adiciona o evento de clique a todos os botões com a classe "delete-button"
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-classe-button');
    deleteButtons.forEach((button) => {
        button.addEventListener('click', function (event) {
            const formId = this.getAttribute('data-form-id');
            showCustomConfirm(event, formId);
        });
    });
});
