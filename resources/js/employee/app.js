import Alpine from 'alpinejs';
import Tagify from '@yaireo/tagify';
import swal from 'sweetalert';
import "./datatable";
import $ from "jquery";

var input = document.querySelector('input[name=meta_keywords]');
new Tagify(input);

var input = document.querySelector('input[name=tags]');
new Tagify(input);

window.Alpine = Alpine;

window.jQuery = window.$ = $

const feather = require('feather-icons');
feather.replace();

Alpine.start();

$(document).ready( function () {
    $('table').DataTable({ "order": [[ 0, "desc" ]], });
});

$('.table-dropdown button').click(function() {
    $(this).parent().toggleClass('active');
})
$('.table-dropdown button').blur(function(event) {
    if (!$(this).parent().contains(event.relatedTarget)) {
        $(this).parent().removeClass('active');
    }
});