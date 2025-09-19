//SUGESTÃO
document.getElementById("formSugestao").addEventListener("submit", function(e) {
    e.preventDefault();

    let form = this;
    let formData = new FormData(form);

    fetch(form.action, {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success") {
            toastr.success(data.message);

            // fecha o modal
            var modal = bootstrap.Modal.getInstance(document.getElementById('modalSugestoes'));
            modal.hide();

            // limpa o formulário
            form.reset();
        } else {
            toastr.error(data.message);
        }
    })
    .catch(() => {
        toastr.error("Erro inesperado ao enviar sugestão.");
    });
});

//REEMBOLSO
$("#formReembolso").on("submit", function(e) {
    e.preventDefault();

    let form = this;
    let formData = new FormData(form);

    $.ajax({
        url: form.action,
        type: form.method,
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if(response.status === "success") {
                toastr.success(response.message);

                // fecha modal
                let modal = bootstrap.Modal.getInstance(document.getElementById('reembolsoModal'));
                modal.hide();

                // reseta form
                form.reset();
                $("#totalConvertido").text("0,00");
            } else {
                toastr.error(response.message);
            }
        },
        error: function() {
            toastr.error("Erro inesperado ao enviar reembolso.");
        }
    });
});

//ALTERAR SENHA
$("#formSenha").on("submit", function(e) {
    e.preventDefault();

    let form = this;
    let formData = new FormData(form);

    $.ajax({
        url: form.action,
        type: form.method,
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if(response.status === "success") {
                toastr.success(response.message);
                form.reset();
            } else {
                toastr.error(response.message);
            }
        },
        error: function() {
            toastr.error("Erro inesperado ao atualizar a senha.");
        }
    });
});
