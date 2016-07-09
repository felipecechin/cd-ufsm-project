/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function pesquisaEquipamento() {
    $('#menu li').removeClass('active');
    $('#pesquisaEquipamento').addClass('active');
    $("#cont").hide('normal');
    $("#cont").load('pesquisaEquipamento.php', function () {
        $("#cont").show('normal');
    });
}
function registraBaixa() {
    $('#menu li').removeClass('active');
    $('#registraBaixa').addClass('active');
    $("#cont").hide('normal');
    $("#cont").load('registraBaixa.php', function () {
        $("#cont").show('normal');
    });
}
function cadastraEquipamento() {
    $('#menu li').removeClass('active');
    $('#cadastraEquipamento').addClass('active');
    $("#cont").hide('normal');
    $("#cont").load('cadastraEquipamento.php', function () {
        $("#cont").show('normal');
    });
}
function alteraDados() {
    $('#menu li').removeClass('active');
    $('#alteraDados').addClass('active');
    $("#cont").hide('normal');
    $("#cont").load('alteraDados.php', function () {
        $("#cont").show('normal');
    });
}
function cadastraLocal() {
    $('#menu li').removeClass('active');
    $('#cadastraLocal').addClass('active');
    $("#cont").hide('normal');
    $("#cont").load('cadastraLocal.php', function () {
        $("#cont").show('normal');
    });
}
function cadastraUsuario() {
    $('#menu li').removeClass('active');
    $('#cadastraUsuario').addClass('active');
    $("#cont").hide('normal');
    $("#cont").load('cadastraUsuario.php', function () {
        $("#cont").show('normal');
    });
}