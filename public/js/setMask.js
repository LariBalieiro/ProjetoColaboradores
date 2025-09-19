// CPF
// $('#cpf').simpleMask({
//     'mask': ['###.###.###-##']
// });
$(document).on("keydown",'input[name="Funcionario_CPF"]', function() {
    $('input[name="Funcionario_CPF"]').simpleMask({
        'mask': ["###.###.###-##"]
    });
});

$(document).on("keydown",'input[name="Funcionario_Data_Nascimento"]', function() {
    $('input[name="Funcionario_Data_Nascimento"]').simpleMask({
        'mask': ["##/##/####"]
    });
});

