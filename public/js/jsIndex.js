$(document).ready(function () {
    // Alterna visualização de senha
    $(".toggle-password").click(function () {
        const input = $($(this).attr("toggle"));
        const type = input.attr("type") === "password" ? "text" : "password";
        input.attr("type", type);
        $(this).toggleClass("fa-eye fa-eye-slash");
    });

    // Login via AJAX
    $("#formLogin").on("submit", function (e) {
        e.preventDefault(); // evita envio padrão

        const cpf = $("#Funcionario_CPF").val().trim();
        const senha = $("#Funcionario_Senha").val().trim();

        if (!cpf || !senha) {
            Swal.fire({
                icon: "warning",
                title: "Campos em branco",
                text: "Por favor, preencha todos os campos.",
                confirmButtonColor: "#007BFF"
            });
            return;
        }

        // Dados do formulário
        const formData = {
            Funcionario_CPF: cpf,
            Funcionario_Senha: senha
        };

        $.ajax({
            type: "POST",
            url: "/login", // <-- rota do MVC
            data: formData,
            dataType: "json",
            beforeSend: function () {
                $(".btn[type='submit']").prop("disabled", true).text("Conectando...");
            },
            success: function (response) {
                $(".btn[type='submit']").prop("disabled", false).text("Entrar");

                if (response.status === "success") {
                    // Força troca de senha se senha for os 3 primeiros dígitos do CPF
                    if (senha === cpf.substring(0, 3)) {
                        const encodedCPF = btoa(cpf);
                        window.location.href = `/alterar_senha?cod=${encodedCPF}`;
                    } else {
                        localStorage.setItem("Funcionario_CPF", cpf);
                        window.location.href = "/home";
                    }
                } else if (response.status === "cpf_error") {
                    Swal.fire("CPF inválido", "CPF não encontrado ou incorreto.", "error");
                } else if (response.status === "senha_error") {
                    Swal.fire("Senha incorreta", "A senha digitada está errada.", "error");
                } else if (response.status === "empty") {
                    Swal.fire("Campos em branco", "Por favor, preencha todos os campos.", "warning");
                } else {
                    Swal.fire("Erro desconhecido", "Tente novamente mais tarde.", "error");
                }
            },
            error: function (xhr, status, error) {
                $(".btn[type='submit']").prop("disabled", false).text("Entrar");
                Swal.fire("Erro na conexão", "Não foi possível conectar. Entre em contato com a empresa.", "error");
                console.error("Erro AJAX:", status, error);
            }
        });
    });
});
